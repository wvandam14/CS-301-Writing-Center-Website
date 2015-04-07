<!DOCTYPE html>
<?php
	//session checks and stuff necessary?
	//will this have any html or just variable handling? dunno.
		//Gonna need to to continue to navagate site
	session_start();
	//include php/consultantAvailability.php
	include "../php/navbar.php";
	
?>
<html>
<head>
	<title>Availability Confirmed</title>
	<meta charset="uft-8">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
	<h1>Availability Confirmed</h1>
	
	<?php 
		if(!isset($_SESSION['user_id'])){
			echo "You are not logged in. Please <a href='login.html'>log in</a> to continue";
			exit;
		}
		if($_SESSION['permission'] == 3){
			echo "You do not have permission to view this page";
			exit;
		}
	
	
		include "../php/consultantAvailability.php"; 
	?>
</body>
</html>
