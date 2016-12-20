<?php
date_default_timezone_set('America/Denver');
ob_start();
session_start();

include ("lib/PHPMailer/PHPMailerAutoload.php");
include ('classes/sanitize.php');


function active_client_sendEmail($firstname,$lastname,$loadAmt,$c_homephone,$c_email){


	$result=true;
	$mail = new PHPMailer;
	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.1and1.com';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'outgoing@canadacreditcard.ca';    // SMTP username
	$mail->Password = 'Hotline67';                           // SMTP password
	$mail->SMTPSecure = 'TLS';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 25;                                    // TCP port to connect to
	$mail->From = 'info@canadacreditcard.ca';
	$mail->FromName = 'canadacreditcard.ca - DC PORTAL Active Client';

//	$mail->addAddress('nirmala-a@creditcanada.net');     // Add a recipient
	$mail->addAddress('brad@creditcanada.net');     // Add a recipient  jeremy@furnitureomni.com
	$mail->addAddress('jeremy@creditspark.ca');


	$mail->isHTML(true);
	                        // Set email format to HTML
	$mailsubjectBody = "%s %s - Changed To Active Client !!! ";
	$mailsubjectBody = sprintf($mailsubjectBody,ucfirst($firstname),$lastname);
	$mail->Subject = $mailsubjectBody;

	$message='<html>
	<table>
	<tr>
	<td colspan="2"><b>Client Card Created In DC BANK</b></td>
	</tr>
	<tr>
	<td colspan="2"><hr /></td>
	</tr>
	<tr>
	<td ><b>Date</b> </td>
	<td >'.date('Y-m-d').'</td>
	</tr>
	<tr>
	<td ><b>First Name</b> </td>
	<td >'.$firstname.'</td>
	</tr>
	<tr>
	<td ><b>Last Name</b> </td>
	<td >'.$lastname.'</td>
	</tr>
	<tr>
	<td ><b>Phone Number</b> </td>
	<td >'.$c_homephone.'</td>
	</tr>
	<tr>
	<td ><b>Email</b> </td>
	<td >'.$c_email.'</td>
	</tr>
	<tr>
	<td ><b>Load Amount</b> </td>
	<td >'.$loadAmt.'</td>
	</tr>
	<tr>
	<td colspan="2"><hr /></td>
	</tr>
	<tr>
	<td colspan="2"><span style="color:red"><b>Card Created Successfully</b></spa></td>
	</tr>
	</table>
	</html>';

	$mail->msgHTML($message);

	if(!$mail->send()) {

		$result=false;
	}

	echo $result;

}



?>
