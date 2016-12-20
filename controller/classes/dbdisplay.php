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
			returns json object of db data
			refer to database for flag definitions
			return array
		***/
		public function addAudit($user,$cust,$action,$data)
		{
			$list=db_query(sprintf(AUDIT,$user,$cust,$action,$data),0);

			return $list;

		}
		public function addreload($cust,$user,$amount)
		{
			$list=db_query(sprintf(ADDRELOAD,$cust,$amount,0,$user,0,""),0);

			return $list;

		}
		public function addComment($cust_id, $comment, $user_id)
		{
			$list=db_query(sprintf(ADDCOMMENT, $cust_id,$comment,$user_id),0,0);

			return $list;

		}
		public function getapps($flag)
		{
			$list=db_query(sprintf(GETNEW_APPS,$flag),0);

			return $list;

		}

		public function getUser($flag)
		{
			$list=db_query(sprintf(GETUSER,$flag),0);

			return $list;

		}

		public function getComments($cust_id)
		{
			$list=db_query(sprintf(GETCOMMENTS,$cust_id),0);

			return $list;

		}

		public function getreloadinfo($id)
		{
			$list=db_query(sprintf(GETRELOADINFO,$id),0);

			return $list[0];

		}
		/***
			@param string mother_Info (customer mother maiden name)
			@param string email (customer email)
			@param string secret (customer secret code)
			return array PANHASH
		***/
		public function getPanHash($mother_Info,$email,$secret)
		{
			$list=db_query(sprintf(GETACTIVATIONREQ,$mother_Info,$email,$secret),0);
			return $list[0];


		}
		/***
			@param int customer id
			@param int flag
			@param string error message
			return array
		***/
		public function updatestatus($id,$flag,$user,$msg,$code)
		{
			$list=db_query(sprintf(UPDATE_STATUS,$id,$flag,$user,$msg,$code),0,0);
			return $list;


		}
		/***

		sad
			@param int customer id
			@param int flag
			return array
		***/
		public function updatelockstatus($id,$flag)
		{
			$list=db_query(sprintf(UPDATE_LOCKSTATUS,$id,$flag),0,0);
			return $list;


		}


		//MARKRELOADPROCESSED
		/***
			@param int customer id
			return array

		***/
		public function markreloadprocessed($id,$user,$msg)
		{
			$list=db_query(sprintf(MARKRELOADPROCESSED,$id,$user,$msg),0,0);
			return $list;
		}
		public function markReloadError($id,$user,$msg)
		{
			//return sprintf(MARKRELOADERROR,$id,$user,$msg);
			$list=db_query(sprintf(MARKRELOADERROR,$id,$user,$msg),0,0);
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
		public function getQueCustID($flag)
		{
			$list=db_query(sprintf(GETQUECUSTID,$flag),0);
			return $list;


		}
		/***
			@param int customer id
			return array

		***/
		public function getclientcardinfo($id)
		{
			$list=db_query(sprintf(GETCARD,$id),0);
			return $list[0];
		}
		/***
			@param int card id
			@param int Available balance
			return array

		***/
		public function updateclient_availbalance($id,$bal)
		{
			$list=db_query(sprintf(UPDATE_BALANCE,$id,$bal),0,0);
			return $list;
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
			@param int flag
			return array count

		***/
		public function getreloads($flag)
		{
			$list=db_query(sprintf(GETRELOADS,$flag),0);
			return $list;


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
		public function updateLeadStatus($info)
		{

			$list=db_query(sprintf(UPDATE_LeadStatus,$info),0,0);
			return $list;


		}
		/***
			@param string customer id
			@param string customer panhash
			@param int  wallet number
			@param int card number
			@param int card reference number
			@param int card balance
			return array

		***/
		public function updateCardInfo($id, $panhash, $wallet, $cardnum, $ref, $bal)
		{


			$list=db_query(sprintf(UPDATECARD,$id,$panhash, $wallet, $cardnum, $ref, $bal),0,0);
			return $list;


		}
		/***
			@param string reload id

			return array customer info

		***/
		public function updatereminder($id)
		{
			$list=db_query(sprintf(UPDATEREMINDER,$id),0);
			return $list[0];
		}

	} // end of class dbdisplay

?>
