<?php
	
	$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if($db->connect_error()) {
		die('Connect error: '.$db->connect_error());
	}

	$stmt = "SELECT fname, lname, date_m, time_slot, status_
			 FROM accounts INNER JOIN schedules ON accountid = consultantid
			 WHERE consultantid IS NOT NULL";

	$result = $db->query($stmt);

	$assoc = array();

	while($row = $result->fetch_assoc()) {
		$assoc[] = $row;
	}

	$db->close();