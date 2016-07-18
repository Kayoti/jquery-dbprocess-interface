<?php
include ('../model/common.php');
include ('classes/dbdisplay.php');

//print_r ($_SESSION);exit;
error_reporting(E_ALL);
ini_set('display_errors', 1);
if(isset($_GET["request"]) && isset($_GET["action"]))
{
    //get the post vars so we know whats up
    //session_start();
    $user = $_SESSION['user'];
    $user_id = $user['id'];
    $request=$_GET["request"];
    $action=$_GET["action"];
    $cust_id='';
    $output_arr = array();
    $return_arr = array();
    if(isset($_GET["cust_id"]))$cust_id=$_GET["cust_id"];
    //$cust_id=1;
    // create the objects
    $dbobj = new dbdisplay();



    switch ($request) {
        //display DB result based on flag
        case "list":
            //list info from DB

            $list=$dbobj->getapps($action);
            //Build Buttons

            if(!empty($list)){
                foreach ($list as $key => $listArray) {
                    //build button
                    $newarray = $listArray;

                    if($action == 9)
                    {
                        $newarray["button1"] = "<input data-toggle='modal' href='#form-content' value='Edit' class='lock_item btn btn-lg btn-primary' type='button' id='".$listArray["cust_id"]."' />";
                        $newarray["button2"] = "<input value='Reload' class='reload btn btn-lg btn-warning' type='button' id='".$listArray["cust_id"]."' />";
                        $newarray["button3"] = "<input value='Disable' class='disable btn btn-lg btn-danger' type='button' id='".$listArray["cust_id"]."' />";
                    }
                    else{
                        $newarray["button1"] = "<input data-toggle='modal' href='#form-content' value='Process' class='lock_item btn btn-lg btn-primary' type='button' id='".$listArray["cust_id"]."' />";

                    }
                    //put in return array
                    $output_arr[] = $newarray;
                }
                $return_arr["aaData"] = $output_arr;
            }
            else {

                if($action == 9)
                {


                    $newarray["firstname"] = "";
                    $newarray["lastname"] = "";
                    $newarray["email"] = "";

                    $newarray["button1"] = "";
                    $newarray["button2"] = "";
                    $newarray["button3"] = "";
                }
                else{
                    $newarray["firstname"] = "";
                    $newarray["lastname"] = "";
                    $newarray["email"] = "";
                    $newarray["emt"] = "";
                    $newarray["personal"] = "";
                    $newarray["contract"] = "";

                    $newarray["button1"] = "";
                }
                $return_arr["aaData"] = $newarray;
            }
            echo json_encode($return_arr);
            break;
        case "review":

            $list=$dbobj->getclientbyid($cust_id);
            $comments_List=$dbobj->getComments($cust_id);

            $tableOutput = "<table width='80%' style='border-collapse: collapse; margin-top:20px;margin-left:15px;' ><col width='70%'><col width='20%'><col width='10%'><tr><th>Comment</th><th>Date</th><th>By</th></th>";
            foreach($comments_List as $value) {
                $tableOutput .= "<tr style='border-bottom: 1px solid; height:80px;' ><td>".$value['comment']."</td><td>".$value['timestamp']."</td><td>".$value['username']."</td></tr>";
            }
            $tableOutput .= "</table>";


            $infoAudit_List=$dbobj->getauditdd(1);
            $emtAudit_List=$dbobj->getauditdd(2);
            $contractAudit_List=$dbobj->getauditdd(3);

            //build audit dropdown into jason
            $list['IAL'] = $infoAudit_List; //get the built DD code
            $list['EAL'] = $emtAudit_List; //get the built DD code
            $list['CAL'] = $contractAudit_List;
            $list['COMMENT'] = $tableOutput; //get the built DD code
            echo json_encode($list);
            break;
        case "add_comment":
            // add the comment
            $comment=$_GET["info_comment"];

            $dbobj->addComment($cust_id,$comment,$user_id);

            //print_r($result);exit;
            //get new list
            $comments_List=$dbobj->getComments($cust_id);

            $tableOutput = "<table width='100%' style='border-collapse: collapse;' ><col width='80%'><col width='10%'><col width='10%'><tr><th>Comment</th><th>Date</th><th>By</th></th>";
            foreach($comments_List as $value) {
                $tableOutput .= "<tr style='border-bottom: 1px solid;  height:80px;' ><td>".$value['comment']."</td><td>".$value['timestamp']."</td><td>".$value['username']."</td></tr>";
            }
            $tableOutput .= "</table>";
            echo $tableOutput;
            break;
        case "get_totals":
            $requests = $dbobj->getappcount(0);
            $counts['NA'] = $requests['num'];
            $requests = $dbobj->getappcount(1);
            $counts['ERR'] = $requests['num'];
            $requests = $dbobj->getappcount(2);
            $counts['IP'] = $requests['num'];
            $requests = $dbobj->getappcount(3);
            $counts['QUE'] = $requests['num'];
            $requests = $dbobj->getappcount(4);
            $counts['DA'] = $requests['num'];
            $requests = $dbobj->getappcount(5);
            $counts['DCA'] = $requests['num'];
            $requests = $dbobj->getappcount(6);
            $counts['RC'] = $requests['num'];
            $requests = $dbobj->getappcount(9);
            $counts['AC'] = $requests['num'];
            $requests = $dbobj->getappcount(11);
            $counts['RELOAD_NEW'] = $requests['num'];
            $requests = $dbobj->getappcount(12);
            $counts['RELOAD_OK'] = $requests['num'];
            $requests = $dbobj->getappcount(13);
            $counts['RELOAD_ERR'] = $requests['num'];
            echo json_encode($counts);
            break;
        case "edit":
            $info = $_GET;
            $output = array();
            foreach($info as $key => $value)
            {
                if( strpos($key,"=") ===  false )
                {
                    $output[$key] = "'".$value."'";
                }
            }
            //$_GET has request and action you must remove them from the array
            unset($output['request']);
            unset($output['action']);
            $finalString = implode(',',$output);
            $finalString = "'".$user_id."',".$finalString;
            $update=$dbobj->updateApp($finalString);

            echo $finalString;
            //echo $update;

            break;


        case "change_flag":
            //change app status flag
            $msg="";
            $update=$dbobj->updatestatus($cust_id,$action,$user_id,$msg);
            echo $update;
            break;
        case "unlock_app":
            //change app status flag
            $update=$dbobj->updatelockstatus($cust_id,$action);
            echo $update;
            break;
        //display DB result based on flag
        case "reloads":
            //list info from DB

            $list=$dbobj->getreloads($action);
            //Build Buttons

            if(!empty($list)){
                foreach ($list as $key => $listArray) {
                    //build button
                    $newarray = $listArray;

                    $newarray["button1"] = "<input  value='Process' class='submit_info btn btn-md btn-primary' type='button' id='".$listArray["reload_id"]."' />";
                    if($action==2){
                        $newarray["button2"] = "<input  value='View' class='err_msg btn btn-md btn-danger' type='button' id='".$listArray["result"]."' />";
                    }
                    $newarray["button3"] = "<input  value='Remind (".$listArray["remind"].")' class='remind btn btn-md btn-warning' type='button' id='".$listArray["reload_id"]."' />";
                    //put in return array
                    $output_arr[] = $newarray;
                }
                $return_arr["aaData"] = $output_arr;
            }
            else {

                $newarray["loaddate"] = "";
                if($action==2){$newarray["button2"] = "";}else{$newarray["comf_no"] = "";}

                $newarray["firstname"] = "";
                $newarray["lastname"] = "";
                $newarray["loadamount"] = "";
                $newarray["secret"] = "";
                $newarray["cardnums"] = "";


                $newarray["button1"] = "";
                $newarray["button3"] = "";

                $return_arr["aaData"] = $newarray;
            }
            echo json_encode($return_arr);
            break;
        case "remind":
            //list info from DB

            $list=$dbobj->updatereminder($action);

            if($list['sendemail'] != 0){
                //client email
                $email_body = file_get_contents('emails/reminder.html');
                $full_name=$list['firstname']." ".$list['lastname'];
                $email_body = str_replace('[NAME]', $full_name, $email_body);

                //MailCode
            	include('lib/PHPMailer/PHPMailerAutoload.php');
                $mail = new PHPMailer;
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.1and1.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'outgoing@canadacreditcard.ca';                 // SMTP username
            	$mail->Password = 'Hotline67';                            // SMTP password
            	$mail->SMTPSecure = 'TLS';                            // Enable TLS encryption, `ssl` also accepted
            	$mail->Port = 25;
                //$mail->SMTPDebug = 1;                          // TCP port to connect to
                $mail->From = 'info@canadacreditcard.ca';
                $mail->FromName = 'canadacreditcard.ca';
                $mail->addAddress($list['email']);

                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'EMT Reminder canadacreditcard.ca';
                $mail->Body    = $email_body;

                if(!$mail->send()) {echo 'Mailer Error: ' . $mail->ErrorInfo;}
                else { echo "Success";}

            }

            break;

        default:// DEFAULT this is where fuck ups go to die
            echo "Error:unknown request! Please Contact Admin";
    }

}


?>
