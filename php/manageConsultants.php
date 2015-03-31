<?php 
	session_start();
	/* STILL IN DEV */
	$page_title = 'Manage Consultants';
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
		<?php require_once("navbar.php"); ?>

		<div id="content">
			<?php

				require_once('db_connection.php');
				$consultants = getConsultants();
				if(empty($consultants)) {
					echo "There are no consultants to display.";
				}
				else {
					
				}

			?>
		</div>
	</body>
</html>