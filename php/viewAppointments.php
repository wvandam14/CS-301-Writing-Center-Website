<?php 
	session_start();
	$page_title = 'View Appointments';
	// if(empty($_SESSION['permission'])){
 //        header('location:login.php');
 //    }
	require_once('db_connection.php');
	
	$data = getAllAppointments($_SESSION['user_id'], $_SESSION['permission']);
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
		<div id="header">
		<h1>View Consultant Calendar</h1>
		</div>
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> origin/master
		<div id="username-display">
			<?php if(!empty($_SESSION['permission'])) {
				if ($_SESSION['permission'] == 3) {
			?>
				<a href="appointmentPopup.php">Appointment</a>
			<?php }} ?>
			<a href="viewAppointments.php">View My Appointments</a>
			<a href="#"><?php echo empty($_SESSION['username']) ? '':$_SESSION['username']; ?></a>
			<a href="logout.php" title="">logout</a>
		</div>
<<<<<<< HEAD
=======
		<?php require_once("navbar.php"); ?>
>>>>>>> origin/master
=======
>>>>>>> origin/master

		<div id="content">
		<!-- Start of content -->
			<?php

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

			?>

			<table>
				<th>Name</th>
				<th>Date</th>
				<th>Time slot</th>
				<th>Status</th>
				<?php
				
					foreach($assoc as $row) {
						echo "<tr>";
						echo "<td>".$row['fname']." ".$row['lname']."</td>";
						echo "<td>".$row['date_']."</td>";
						echo "<td>".$row['time_slot']."</td>";
						echo "<td>".$row['status_']."</td>";
						echo "</tr>";
					}

				?>
			</table>
		</div>
	</body>
</html>