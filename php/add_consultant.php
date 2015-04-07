<?php

	$db = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
	if($db->connect_errno) {
		die('Connect error: '.$db->correct_errno);
	}

	$stmt = $db->prepare("INSERT INTO accountdetails (class_standing, graduation_year, major, secondary_major, minor, bio, missed_appointments) values (?,?,?,?,?,?,?)");
	$classStanding = $db->real_escape_string($_POST['classStanding']);
	$graduationYear = $db->real_escape_string($_POST['graduationYear']);
	$major = $db->real_escape_string($_POST['major']);
	$secondaryMajor = $db->real_escape_string($_POST['secondaryMajor']);
	$minor = $db->real_escape_string($_POST['minor']);
	$bio = $db->real_escape_string($_POST['bio']);
	$missedAppointments = $db->real_escape_string($_POST['missedAppointments']);
	$stmt->bindParams("sissssi", $classStanding, $graduationYear, $major, $secondaryMajor, $minor, $bio, $missedAppointments);
	$stmt->execute();

	$stmt = $db->prepare("INSERT INTO accounts (fname, lname, email_address, password, accounttypeid, accountdetails) values (?,?,?,?,2,?)");
	$fname = $db->real_escape_string($_POST['fname']);
	$lname = $db->real_escape_string($_POST['lname']);
	$email = $db->real_escape_string($_POST['email']);
	$password = $db->real_escape_string($_POST['password']);
	$accountDetailsID = $db->real_escape_string($db->insert_id);
	$stmt->bind_param("ssssi", $fname, $lname, $email, $password, $accountDetailsID);
	$stmt->execute();