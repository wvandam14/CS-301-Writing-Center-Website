<?php 
	DEFINE('DB_USER','root');
	DEFINE('DB_PASSWORD','');
	DEFINE('DB_HOST','localhost');
	DEFINE('DB_NAME','writingcenter');


	$dbc =  new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

	if($dbc->connect_errno){
		 printf("Connect failed: %s\n", $dbc->connect_error);
    	exit();
	}

	if (!$dbc->set_charset("utf8")) {
	    printf("Error loading character set utf8: %s\n", $dbc->error);
	}

	function isValidUser($client){

		$dbc = $GLOBALS['dbc'];

		$client->email = $dbc->real_escape_string($client->email);
		$client->password = $dbc->real_escape_string($client->password);

		$q = "SELECT u.accountId as id,CONCAT(u.fname,' ',u.lname) as username,u.accountTypeId as permission FROM writingcenter.accounts AS u WHERE u.email_address = '$client->email' AND u.password = '". md5($client->password) ."';";
		$r = $dbc->query($q);

		if($r){

			$u = $r->fetch_assoc();
			$r->close();

			return $u;
		}
		else{
			echo '<h1>System error</h1>
			<p class="error">You could not be logged in due to a system error. We apologize for the inconvenience.</p>';
			echo '<p>' . mysqli_error($dbc) . '<br/><br/>Query: ' . $q . '</p>';
		}
	}


?>