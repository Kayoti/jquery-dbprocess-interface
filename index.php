<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require("model/login_config.php");
$submitted_username = '';
if(!empty($_POST)){
    $query = "
    SELECT
    id,
    username,
    password,
    salt,
    email,
    level
    FROM users inner join user_level on id = user_id
    WHERE
    username = :username
    ";
    $query_params = array(
        ':username' => $_POST['username']
        );

    try{
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
    $login_ok = false;
    $row = $stmt->fetch();
    if($row){
        $check_password = hash('sha256', $_POST['password'] . $row['salt']);
        for($round = 0; $round < 65536; $round++){
            $check_password = hash('sha256', $check_password . $row['salt']);
        }
        if($check_password === $row['password']){
            $login_ok = true;
        }
    }

    if($login_ok){
        unset($row['salt']);
        unset($row['password']);
        $_SESSION['user'] = $row;
        header("Location: view/dashboard.php");
        die("Redirecting to: index.php");
    }
    else{
       $error_msg="Login Failed!";
        $submitted_username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8');

    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Responsive JQUERY Admin Panel">
    <meta name="author" content="Wael Ali">
    <link rel="icon" type="image/ico" href="view/assets/images/favicon.ico"></link>
    <link rel="shortcut icon" href="view/assets/images/favicon.ico">

    <title>Login Page | Card Services Admin Panel</title>

    <!-- Bootstrap CSS -->
    <link href="view/assets/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- bootstrap theme -->
    <link href="view/assets/css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="view/assets/css/elegant-icons-style.css" rel="stylesheet" />
    <link href="view/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="view/assets/css/style.css" rel="stylesheet">
    <link href="view/assets/css/style-responsive.css" rel="stylesheet" />


</head>

  <body class="login-img3-body">

    <div class="container">

      <form class="login-form" action="index.php" method="post">
        <div class="login-wrap">
            <p class="login-img"><i class="icon_lock_alt"></i></p>
            <div class="input-group">
              <span class="input-group-addon"><i class="icon_profile"></i></span>
              <input value='<?php echo $submitted_username; ?>' name="username" type="text" class="form-control" placeholder="Username" autofocus>
            </div>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                <input name="password" type="password" class="form-control" placeholder="Password">

            </div>
            <div  id="error"><font color="red"><?php if(isset($error_msg)) echo $error_msg; ?></font></div>
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
                <span class="pull-right"> <a href="#"> Forgot Password?</a></span>
            </label>
            <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>

        </div>
      </form>

    </div>


  </body>
</html>
