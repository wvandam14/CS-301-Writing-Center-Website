<?php
	
	$db = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
	if(mysqli_connect_errno()) {
		die('Connect error: '.mysqli_connect_error());
	}

	$stmt = "SELECT fname, lname, date_m, time_slot, status_
			 FROM accounts INNER JOIN schedules ON accountid = consultantid
			 WHERE consultantid IS NOT NULL";

	$result = mysqli_query($db, $stmt);

	$assoc = array();

	while($row = mysql_fetch_array($result, MYSQLI_ASSOC)) {
		$assoc[] = $row;
	}

	mysqli_free_result($result);
	mysqli_close($db);