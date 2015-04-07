<?php 
	session_start();
	$page_title = 'Log in';
	//require_once('db_connection.php');
	$servername = "CS1";
	$username = "CS472_2015";
	$password = "WritingCenter";

	$dbc = new mysqli($servername, $username, $password, "WritingCenter");

	if($dbc->connect_errno){
		die('Connect Error: ' . $dbc->connect_errno);
	}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8">
		<title> Whitworth University Composition Commons</title>
		<link rel = "stylesheet" type = "text/css" href = "../css/style.css">
	</head>
	<body>
<<<<<<< HEAD
		<div id="header">
		<h1></h1>
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
=======
		<img src = "../img/wcc-logo.png" alt = "WCC Logo" class ='logo'>
		<h1 align = "center">Welcome!</h1>
		<div> 
			<form action="" method="post">
				Email Address:<br>
				<input type = "text" name="email"><br>
				Password:<br>
				<input type = "password" name = "password"><br>
				<!--Submit information and log in to the writing center-->
				<!--Stay logged in button-->
				<input type="radio" name="stayLoggedIn" value="login">Check to stay logged in<br><br>
				
				
				<?php
					$email = $dbc->real_escape_string($_POST['email']);
					$password = $dbc->real_escape_string($_POST['password']);
>>>>>>> origin/master


					$stmt = $dbc->prepare("SELECT * FROM accounts WHERE email_address = ? AND password = ?;");
					$stmt->bind_param("ss",$email, $password);
					$stmt->execute();

					$stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7);
				
					$stmt->fetch();

					$stmt->close();

					$dbc->close();


					if($_POST['submit'])
					{
						if ($col1 != NULL){
     						$_SESSION['id'] = $col1;
							$_SESSION['email'] = $col3;
							$_SESSION['type'] = $col6;

						header("location:../html/index.htm");

						exit();
     				}
     					else
     					{
     						echo "<h2>Invalid email/password</h2>";
     					}
					}
				?>
				<input type = "submit" name="submit" value = "Log In" class= 'btn'><!-- onclick = "login($login->email, $login->password)"> -->
				<br><br>

				<a href="../php/register.php">Don't have an account? Click here to register.</a>
			</form>
		</div>
	</body>
</html>
