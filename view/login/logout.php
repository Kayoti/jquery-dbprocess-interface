<?php 
    require("../../model/login_config.php"); 
    unset($_SESSION['user']);
    header("Location: ../../index.php"); 
    die("Redirecting to: ../../index.php");
?>