<?php
	include ('config.php');
	//DEFINES
	define('GETNEW_APPS', 'call getapps(%s);'); 
	define('GETCUST_BYID', 'call getappbyid(%s);'); 
	define('UPDATE_STATUS', 'call changeAppStatus(%s,%s);'); 
	define('UPDATE_LOCKSTATUS', 'call lockcust(%s,%s);'); 
	define('GETAUDITDD', 'call getAuditDD(%s);'); 
	//END DEFINES
	
	/***
		DB Query
		$query = SQL query, 
		$params = array of parameters (i, s, d, b), 
		$rs = whether or not a resultset is expected, 
		$newid = whether or not to retrieve the new ID value;
		$onedimensionkey = key required to convert array into simple one dimensional array; 
		$admin = if true, use the admin credentials (used only for logins)
	***/
	function db_query($query, $params, $rs = true, $newid = false, $onedimensionkey = false, $admin = false) {
	  (!$admin) ? $link = mysqli_connect(MYSQL_HOSTNAME, MYSQL_USERNAME, MYSQL_PASSWORD,MYSQL_DATABASE) : $link = mysqli_connect(MYSQL_HOSTNAME, MYSQL_USERNAME, MYSQL_PASSWORD,MYSQL_DATABASE);
	  if (!$link) { 
		print 'Error connecting to MySQL Server. Errorcode: ' . mysqli_connect_error(); 
		exit; 
	  }
	  
	  // Prepare the query and split the parameters array into bound values
	  if ($sql_stmt = mysqli_prepare($link, $query)) {
			if ($params) {
				$types = '';
				$new_params = array();
				$params_ref = array();
				// Split the params array into types string and parameters sub-array
				foreach ($params as $param) {
					$types .= $param['type'];
					$new_params[] = $param['value'];
				}
				// Cycle the new parameters array to make it an array by reference
				foreach ($new_params as $key => $parameter) {
					$params_ref[] = &$new_params[$key];
				}
				call_user_func_array('mysqli_stmt_bind_param', array_merge(array($sql_stmt, $types), $params_ref));
			}
	  }
	  else {
			print 'Error: ' . mysqli_error($link);
			exit();
	  }
		
	  // Execute the query
	  mysqli_stmt_execute($sql_stmt);
		
	  // Store results
	  mysqli_stmt_store_result($sql_stmt);
		
	  // If there are results to retrive, do so
	  if ($rs) {
			$results = array();
			$rows = array();
			$row = array();
			stmt_bind_assoc($sql_stmt, $results);
			while (mysqli_stmt_fetch($sql_stmt)) {
				foreach ($results as $key => $value) {
					$row[$key] = $value;
				}
				$rows[] = $row;
			}
			if ($onedimensionkey) {
				$i = 0;
				foreach ($rows as $row) {
					$simplearray[$i] = $row[$onedimensionkey];
					$i++;
				}
			}
	  }
	  // If there are no results but we need the new ID, save it
	  elseif ($newid) {
			$newid = mysqli_insert_id($link);
	  }
	  
	  // Close objects
	  mysqli_stmt_close($sql_stmt);
	  mysqli_close($link);
		
		// Return necessary arrays/values
		if (isset($rows)) {
			return $rows;
		}
		if (isset($simplearray)) {
			return $simplearray;
		}
		if (isset($newid)) {
			return $newid;
		}
	}
	/***
	 Required By DB_QUERY function!!!
	 Bind results to an array
	 $stmt = sql query, 
	 $out = array to be returned
	***/
	function stmt_bind_assoc (&$stmt, &$out)
	{
	  $data = mysqli_stmt_result_metadata($stmt);
	  $fields = array();
	  $out = array();

	  $fields[0] = $stmt;
	  $count = 1;

	  while($field = mysqli_fetch_field($data)) {
			$fields[$count] = &$out[$field->name];
			$count++;
	  }    
	  call_user_func_array('mysqli_stmt_bind_result', $fields);
	}
?>