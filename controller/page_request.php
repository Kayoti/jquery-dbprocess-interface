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
					$newarray["button2"] = "<input data-toggle='modal' href='#form-reload' value='Reload' class='reload btn btn-lg btn-warning' type='button' id='".$listArray["cust_id"]."' />";
					$newarray["button3"] = "<input data-toggle='modal'  value='Disable' class='disable btn btn-lg btn-danger' type='button' id='".$listArray["cust_id"]."' />";
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
				
				
			default:// DEFAULT this is where fuck ups go to die
			echo "Error:unknown request! Please Contact Admin";
		}
		
	}


	?>