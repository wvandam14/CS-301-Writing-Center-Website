<?php

	$db = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
	if($db->connect_errno) {
		die('Connect error: '.$db->correct_errno);
	}

	$stmt = "SELECT accountdetails from accounts where accountid = ?";
	$id = $db->real_escape_string($_POST['id']);
	$stmt->bind_param('i', $id);
	$stmt->execute();
	$accountDetailsID = $stmt->get_results()->fetch_assoc()['accountdetails'];

	$stmt = "DELETE FROM accounts WHERE accountid = ?";
	$stmt->bind_param('i', $id);
	$stmt->execute();

	$stmt = "DELETE FROM accountdetails WHERE accountdetailsid = ?";
	$stmt->bind_param('i', $accountDetailsID);
	$stmt->execute();