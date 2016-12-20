<?php
header('Access-Control-Allow-Origin: http://canadacreditcard.ca');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Max-Age: 1000');
include ('../model/common.php');
include ('classes/dcbank.php');
include ('classes/dbdisplay.php');
include ('classes/sanitize.php');
date_default_timezone_set("America/Edmonton");
error_reporting(E_ALL);
ini_set('display_errors', 1);

sanitize($mother_Info=$_POST['$mother_Info']);
sanitize($email=$_POST['email']);
sanitize($secret=$_POST['secret']);

$dbobj = new dbdisplay();
$dcobj = new DCBank(0);
$panhash=$dbobj->getPanHash($mother_Info,$email,$secret);
//for testing use this token
//$token="86D71B29CE5056A5C01E599EE07A15D672B04080";
$token=$panhash['PANHash'];
if($activate=$dcobj->updateCardStatus($token)=="Card activated")
{
  echo json_encode("OK");
}
else{
  echo json_encode("ERROR");
}
?>
