<?php
		/***
			@param int  flag number
			returns jason object of db data
			refer to database for flag definitions
			return array
		***/	
	class dbdisplay
	{
		//Properties
		
		
		//Methods
		//constructor
		 public function __construct() 
		{
			
		}
		//private functions 
		
		//protected functions
		
		//public functions
		/***
			@param int  flag number
			returns jason object of db data
			refer to database for flag definitions
			return array
		***/
		public function addAudit($user,$cust,$action,$data) 
		{
			$list=db_query(sprintf(AUDIT,$user,$cust,$action,$data),0);
			
			return $list;
		  
		}
		
		public function getapps($flag) 
		{
			$list=db_query(sprintf(GETNEW_APPS,$flag),0);
			
			return $list;
		  
		}
		/***
			@param int customer id
			@param int flag
			@param string error message
			return array
		***/
		public function updatestatus($id,$flag,$msg) 
		{
			$list=db_query(sprintf(UPDATE_STATUS,$id,$flag,$msg),0,0);
			return $list;
			 
		  
		}
		/***
			@param int customer id
			@param int flag
			return array
		***/
		public function updatelockstatus($id,$flag) 
		{
			$list=db_query(sprintf(UPDATE_LOCKSTATUS,$id,$flag),0,0);
			return $list;
			 
		  
		}
		
		/***
			@param int customer id
			return array
			
		***/
		public function getclientbyid($id) 
		{
			$list=db_query(sprintf(GETCUST_BYID,$id),0);
			return $list[0];
			 
		  
		}
		/***
			@param int customer id
			return array
			
		***/
		public function getauditdd($flag) 
		{
			$list=db_query(sprintf(GETAUDITDD,$flag),0);
			return $list;
			 
		  
		}
		/***
			@param int flag
			return array count
			
		***/
		public function getappcount($flag) 
		{
			$list=db_query(sprintf(GETAPPCOUNT,$flag),0);
			return $list[0];
			 
		  
		}
		/***
			@param string customer info
			return array 
			
		***/
		public function updateApp($info) 
		{
				
				
			$list=db_query(sprintf(UPDATE_APP,$info),0,0);
			return $list;
			 
		  
		}
		public function updateCardInfo($id, $panhash, $wallet, $cardnum, $ref, $bal) 
		{
				
				
			$list=db_query(sprintf(UPDATECARD,$info,$panhash, $wallet, $cardnum, $ref, $bal),0,0);
			return $list;
			 
		  
		}
   
	} // end of class dbdisplay
	
?>