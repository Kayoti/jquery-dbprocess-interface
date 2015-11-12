<?php
	include ('../model/common.php');
	include ('classes/dbdisplay.php');
	
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	if(isset($_GET["request"]) && isset($_GET["action"]))
	{
		//get the post vars so we know whats up
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

		
						$newarray["button1"] = "<input data-toggle='modal' href='#form-content' value='Process' class='lock_item btn btn-lg btn-primary' type='button' id='".$listArray["cust_id"]."' />";

					//put in return array
					$output_arr[] = $newarray;
					}
					$return_arr["aaData"] = $output_arr;
				}
				else {	 
					$newarray["firstname"] = "";
					$newarray["lastname"] = "";
					$newarray["email"] = "";
					$newarray["psw"] = "";
					$newarray["initloadamount"] = "";
					$newarray["button1"] = "";
						
					$return_arr["aaData"] = $newarray;
				}
				echo json_encode($return_arr);	
				break;
			case "review":
				
				$list=$dbobj->getclientbyid($cust_id);
				
				$infoAudit_List=$dbobj->getauditdd(1);
				$emtAudit_List=$dbobj->getauditdd(2);
				$contractAudit_List=$dbobj->getauditdd(3);
				
				//build audit dropdown into jason 
				$list['IAL'] = $infoAudit_List; //get the built DD code
				$list['EAL'] = $emtAudit_List; //get the built DD code
				$list['CAL'] = $contractAudit_List; //get the built DD code
				echo json_encode($list);
				break;
			case "edit":
				echo "display info";
				break;
			
			case "change_flag":
				//change app status flag	
				$update=$dbobj->updatestatus($cust_id,$action);
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