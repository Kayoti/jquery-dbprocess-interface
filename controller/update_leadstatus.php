
<?php
include ('../model/common.php');
include ('classes/dbdisplay.php');

//print_r ($_SESSION);exit;
error_reporting(E_ALL);


if(isset($_GET["leadstatus"]) && isset($_GET["custID"]))
{

  $dbobj = new dbdisplay();

  $user = $_SESSION['user'];
  $user_id = $user['id'];

  $finalString = "'".$user_id."',"."'".$_GET["leadstatus"]."',"."'".$_GET["custID"]."'";

  try{
    $update=$dbobj->updateLeadStatus($finalString);
    echo $_GET["leadstatus"];
  }catch(Exception $e){
    echo 'Caught exception: ',  $e->getMessage(), "\n";
  }


  
}

?>
