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
		<link rel="stylesheet" type="text/css" href="../css/indexStyle.css"/>
		<?php if(!empty($header_line)) echo $header_line; ?>
		<?php include("navbar.php"); ?>
		<meta http-equiv="content-type" content="text/html"; charset="utf-8" />
	</head>
	<body>
		
		
		<?php require_once("navbar.php"); ?>
		<div id="content">
			<!-- <div id="header"> -->
				<h1><?php echo $_SESSION['type'] == 2 ? "Consultant Calendar" : "Client Calendar"; ?></h1>
			<!-- </div> -->
		<!-- Start of content -->

			<table id="viewConsultantAppointments">
				<col class="col1">
				<col class="col2">
				<col class="col3">
				<col class="col4">
				<col class="col5">
				<thead>
					<th>Assignment Description</th>
					<th>Date</th>
					<th>Time slot</th>
					<th><?php echo $_SESSION['type'] == 2 ? "Client Name" : "Consultant Name"; ?></th>
					<th>Status</th>
				</thead>
				<tbody>
					<?php
					foreach ($data as $v => $d) {
					?>
					<tr>
						<?php for ($i = 0; $i < count($d)-1; $i++) { ?>
							<td><?php echo $d[$i] ?></td>
						<?php } ?>
						<td>
							<button class="editAppointment" name="editAppointment" value="<?php echo $v ?>">
								<?php echo $d[4] == 0 ? "Edit Appointment" : "View Appointment" ?>
							</button>
						</td> 					
					</tr>
					<?php } ?>
				</tbody>
			</table>
<!-- 			<button class="btn" id="redirectViewAppt">Go Back</button> -->
		</div>
		<script src="js/jquery-1.11.0.js"></script>
        <script src="js/appt.js"></script>
	</body>
</html>