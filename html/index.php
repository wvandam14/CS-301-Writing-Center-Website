<?php 
	session_start();
	$page_title = 'Index';
	require_once("../php/auth.php");
	require_once("../php/db_connection.php");
	
	$data = getAllAppointments($_SESSION['user_id'], $_SESSION['permission']);
?>
<html>
<head>
	<meta charset = "utf-8">
	<title><?php echo $page_title; ?></title>
	<link rel="stylesheet" href="<?php echo empty($css) ? '../css/style.css':$css; ?>" type="text/css" media="screen"/>
	<?php if(!empty($header_line)) echo $header_line; ?>
	<meta http-equiv="content-type" content="text/html"; charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/indexStyle.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src = "../js/schedule.js" defer></script>
</head>
<body>
	<?php require_once("../php/navbar.php"); ?>
<h1>Whitworth Composition Commons Schedule</h1>
<h4> Click on schedule timeslots to change consultants' availability!</h4>
<table id="table1">
	<tr>
		<th colspan="2"> Jan. 20: Tuesday </th>
		<th colspan="2"> 10:00 am </th>
		<th colspan="2"> 11:00 am </th>
		<th colspan="2"> 12:00 pm </th>
		<th colspan="2"> 1:00 pm </th>
		<th colspan="2"> 2:00 pm </th>
		<th colspan="2"> 3:00 pm </th>
		<th colspan="2"> 4:00 pm </th>
		<th colspan="2"> 5:00 pm </th>
	</tr>
	<tr>
		<th colspan="2"> Cam </th>
		<td class="notWorking"></td>
		<td class="notWorking"></td>
		<td class="notWorking"></td>
		<td class="notWorking"></td>
		<td class="notWorking"></td>
		<td class="notWorking"></td>
		<td class="available"></td>
		<td class="available"></td>
		<td class="booked"></td>
		<td class="booked"></td>
		<td class="available"></td>
		<td class="available"></td>
		<td class="notWorking"></td>
		<td class="notWorking"></td>
		<td class="notWorking"></td>
		<td class="notWorking"></td>
	</tr>
	<tr>
		<th colspan="2"> Sami </th>
		<td class="booked"></td>
		<td class="booked"></td>
		<td class="booked"></td>
		<td class="booked"></td>
		<td class="available"></td>
		<td class="available"></td>
		<td class="available"></td>
		<td class="available"></td>
		<td class="notWorking"></td>
		<td class="notWorking"></td>
		<td class="notWorking"></td>
		<td class="notWorking"></td>
		<td class="notWorking"></td>
		<td class="notWorking"></td>
		<td class="notWorking"></td>
		<td class="notWorking"></td>
	</tr>
	<tr>
		<th colspan="2"> Katie </th>
		<td class="notWorking"></td>
		<td class="notWorking"></td>
		<td class="notWorking"></td>
		<td class="notWorking"></td>
		<td class="notWorking"></td>
		<td class="notWorking"></td>
		<td class="notWorking"></td>
		<td class="notWorking"></td>
		<td class="booked"></td>
		<td class="booked"></td>
		<td class="booked"></td>
		<td class="booked"></td>
		<td class="available"></td>
		<td class="available"></td>
		<td class="available"></td>
		<td class="available"></td>
	</tr>
	<tr>
		<th colspan="2"> Izze </th>
		<td class="available"></td>
		<td class="available"></td>
		<td class="booked"></td>
		<td class="booked"></td>
		<td class="available"></td>
		<td class="available"></td>
		<td class="available"></td>
		<td class="available"></td>
		<td class="booked"></td>
		<td class="booked"></td>
		<td class="notWorking"></td>
		<td class="notWorking"></td>
		<td class="notWorking"></td>
		<td class="notWorking"></td>
		<td class="notWorking"></td>
		<td class="notWorking"></td>
	</tr>
</body>
</html>
