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
				
				$update=$dbobj->updateApp($finalString);
				
				echo $finalString;
				//echo $update;
			
				break;	
				
			
			case "change_flag":
				//change app status flag	
			$msg="";
				$update=$dbobj->updatestatus($cust_id,$action,$msg);
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