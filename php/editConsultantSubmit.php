<?php
    session_start();
    $servername = "CS1";
	$username = "CS472_2015";
	$password = "WritingCenter";

	// connect to database
	$dbc = new mysqli($servername, $username, $password, "WritingCenter");

    if ( $dbc->connect_errno ) {
		die( 'Connect Error: ' . $db->connect_errno );
	}
	
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
			<a href="index.htm">
				<img src="../img/wcc-logo.png" alt="WCC Logo" class='logo'>
			</a>
			<h1>Edit Consultant Profile</h1>
		</div>
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
		<div id="content">
		<!-- Start of content -->
		<script type="text/javascript">
			window.setTimeout(function(){
				// Move to a new location or you can do something else
				window.location.href = "../html/index.htm";
			}, 5000);
		</script>
		
		<?php //Allow access to page only if user is Consultant level
			
			$accountId = $_SESSION['id'];
			$Standing = $dbc->real_escape_string($_POST['standing']);
			$Graduation_Year = $dbc->real_escape_string($_POST['Graduation_Year']);
			$Major = $dbc->real_escape_string($_POST['Major']);
			$Secondary_Major = $dbc->real_escape_string($_POST['Secondary_Major']);
			$Minor = $dbc->real_escape_string($_POST['Minor']);
			//bio = null;
			//miss_appointments = null;

			//accountId = null;
			$Fname = $dbc->real_escape_string($_POST['firstName']);
			$Lname = $dbc->real_escape_string($_POST['lastName']);
			$Email = $dbc->real_escape_string($_POST['email']);
			$Password = $dbc->real_escape_string($_POST['password']);
			$Repassword = $dbc->real_escape_string($_POST['REpassword']);

			$accCheck = $dbc->prepare("SELECT accountDetails FROM accounts WHERE email_address = ?;");
			$accCheck->bind_param("s", $Email);
			$accCheck->execute();
			$accCheck->bind_result($res);
			$accCheck->fetch();
			$accCheck->close();
			

			if($Password != $Repassword)
			{
				echo '<h2> Passwords do not match. Try again. </h2>';
				exit();
			}
			
			$stmt = $dbc->prepare("UPDATE accountdetails SET class_standing=?, graduation_year=?, major=?, secondary_major=?, minor=? WHERE accountDetailId=?");
			$stmt->bind_param("sisssi", $Standing, $Graduation_Year, $Major, $Secondary_Major, $Minor, $res);
			$stmt->execute();
			$stmt->close();
			
			//if new password is not set
			if($Password != NULL) {
				$stmt3 = $dbc->prepare("UPDATE accounts SET fname=?, lname=?, email_address=?, password=? WHERE accountId=?");
				$stmt3->bind_param("ssssi", $Fname, $Lname, $Email, md5($Password), $accountId);
				$stmt3->execute();
				$stmt3->close();
			} else {
				$stmt3 = $dbc->prepare("UPDATE accounts SET fname=?, lname=?, email_address=? WHERE accountId=?");
				$stmt3->bind_param("sssi", $Fname, $Lname, $Email, $accountId);
				$stmt3->execute();
				$stmt3->close();
			}

			?> <h1>Your account has been updated.</h1> 
			<h3>You will be redirected in 5 seconds. If not, click <a href="../html/index.htm">here</a>.<?php
			exit();
		?>
		<!-- End of content -->
		</div>
	</body>
	<?php $dbc->close(); ?>
</html>
