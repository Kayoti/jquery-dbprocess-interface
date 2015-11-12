<?php
	
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
		public function getapps($flag) 
		{
			$list=db_query(sprintf(GETNEW_APPS,$flag),0);
			
			return $list;
		  
		}
		/***
			@param int customer id
			@param int flag
			return array
		***/
		public function updatestatus($id,$flag) 
		{
			$list=db_query(sprintf(UPDATE_STATUS,$id,$flag),0,0);
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

   
	} // end of class dbdisplay
	
?>