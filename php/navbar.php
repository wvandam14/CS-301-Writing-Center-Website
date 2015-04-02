<!-- nav bar -->
<div id="username-display">
	<a href="appointmentPopup.php">Appointment</a>
	<a href="viewAppointments.php">View My Appointments</a>
	<?php if($_SESSION['permission'] == 1) { ?> <a href="manageConsultants.php">Manage Consultants</a><?php } ?>
	<a href="#"><?php echo empty($_SESSION['username']) ? '':$_SESSION['username']; ?></a>
	<a href="logout.php" title="">logout</a>
</div>
