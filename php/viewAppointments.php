<?php 
	session_start();
	$page_title = 'View Appointments';
	// if(empty($_SESSION['permission'])){
 //        header('location:login.php');
 //    }
	require_once('db_connection.php');
	
	$data = getAllAppointments($_SESSION['id'], $_SESSION['type']);
	//print_r($data);
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $page_title; ?></title>
		<link rel="stylesheet" href="<?php echo empty($css) ? '../css/style.css':$css; ?>" type="text/css" media="screen"/>
		<?php if(!empty($header_line)) echo $header_line; ?>
		<?php include("navbar.php"); ?>
		<meta http-equiv="content-type" content="text/html"; charset="utf-8" />
	</head>
	<body>
		

		<?php require_once("navbar.php"); ?>
		<div id="content" style="margin-left:auto; margin-right:auto; width: 50%">
			<div id="header">
				<h1>View Consultant Calendar</h1>
			</div>
		<!-- Start of content -->
<!-- 			<?php

				$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
				if($db->connect_error) {
					die('Connect error: '.$db->connect_error);
				}

				$stmt = "SELECT fname, lname, date_, time_slot, status_
						 FROM accounts INNER JOIN schedules ON accountid = consultantid
						 WHERE consultantid IS NOT NULL
						 ORDER BY date_ ASC, fname";

				$result = $db->query($stmt);

				$assoc = array();
				if($result) {
					while($row = $result->fetch_assoc()) {
						array_push($assoc, $row);
					}
				}

				$db->close();

			?> -->

			<table id="viewConsultantAppointments">
				<th>Assignment Description</th>
				<th>Date</th>
				<th>Time slot</th>
				<th><?php echo $_SESSION['type'] == 2 ? "Clint Name" : "Consultant Name"; ?></th>
				<?php
					foreach ($data as $v => $d) {
				?>
				<tr>
					<?php foreach ($d as $value) { ?>
						<td><?php echo $value ?></td>
					<?php } ?>
					<td><button class="editAppointment" name="editAppointment" value="<?php echo $v ?>">Edit Appointment</button></td>
				</tr>
				<?php } ?>
			</table>
		</div>
		<script src="js/jquery-1.11.0.js"></script>
        <script src="js/appt.js"></script>
	</body>
</html>