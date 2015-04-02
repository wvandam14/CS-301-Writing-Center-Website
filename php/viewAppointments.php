<?php 
	session_start();
	$page_title = 'View Appointments';
	if(empty($_SESSION['permission'])){
        header('location:login.php');
    }
	require_once('db_connection.php');
	
	$data = getAllAppointments($_SESSION['user_id'], $_SESSION['permission']);
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $page_title; ?></title>
		<link rel="stylesheet" href="<?php echo empty($css) ? './include/css/style.css':$css; ?>" type="text/css" media="screen"/>
		<?php if(!empty($header_line)) echo $header_line; ?>
		<meta http-equiv="content-type" content="text/html"; charset="utf-8" />
	</head>
	<body>
		<div id="header">
		<h1></h1>
		</div>
		<div id="username-display">
			<a href="appointmentPopup.php">Appointment</a>
			<a href="viewAppointments.php">View My Appointments</a>
			<a href="#"><?php echo empty($_SESSION['username']) ? '':$_SESSION['username']; ?></a>
			<a href="logout.php" title="">logout</a>
		</div>

		<div id="content">
		<!-- Start of content -->
			<ul style="list-style-type: none;">
				<?php foreach ($data as $id => $info) { ?>
				<li><a href="appointmentPopup.php?<?php echo $id ?>">
				<?php for ($i = 0; $i < count($info); $i++) {
							echo $info[$i] . ' ';
					}?>
				</a></li>
				<?php } ?>
			<ul>
		</div>
	</body>
</html>