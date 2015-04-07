<?php 
	session_start();
	$page_title = 'Log in';
	//require_once('db_connection.php');
	$servername = "CS1";
	$username = "CS472_2015";
	$password = "WritingCenter";
	$empty = false;
	//$col1 = 1;

	$dbc = new mysqli($servername, $username, $password, "WritingCenter");

	if($dbc->connect_errno){
		die('Connect Error: ' . $dbc->connect_errno);
	}

	function inputCheck($email, $password){
		if($email == null || $password == null){
			$empty = true;
		}
	}
?>
<!--	function login($email, $password)
	{
		$stmt = $dbc->prepare("SELECT * FROM accounts WHERE password = ? AND email_address = ?");
		$stmt->bind_param("ss", $email, $password);
		$stmt->execute();

		$stmt->bind_result($col, $col2, $col3, $col4, $col5, $col6, $col7);
		$stmt->fetch();
		$stmt->close();

		$dbc->close();
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		if(empty($_POST['email']))	|| empty($_POST['password'])){
			echo "Missing required information";
		}
		else{
			$login = new stdClass();

			$login->email = $_POST['email'];
			$login->password = $_POST['password'];
		}
	}

?> -->
<!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8">
		<title> Whitworth University Composition Commons</title>
		<link rel = "stylesheet" type = "text/css" href = "../css/style.css">
	</head>
	<body>
		<img src = "../img/wcc-logo.png" alt = "WCC Logo" class ='logo'>
		<h1>Welcome!</h1>
		<form action="" method="post">
			Email Address:<br>
			<input type = "text" name="email"><br>
			Password:<br>
			<input type = "password" name = "password"><br>
			<!--Submit information and log in to the writing center-->
			<!--Stay logged in button-->
			<input type="radio" name="stayLoggedIn" value="login">Check to stay logged in<br><br>
			<input type = "submit" name="submit" value = "Log In" class= 'btn'><!-- onclick = "login($login->email, $login->password)"> -->
			<?php
				inputCheck();
				$email = $_POST['email'];
				$password = $_POST['password'];

				$stmt = $dbc->prepare("SELECT * FROM accounts WHERE password = ? AND email_address = ?");
				$stmt->bind_param("ss",$email, $password);
				$stmt->execute();

				$stmt->bind_result($col, $col2, $col3, $col4, $col5, $col6, $col7);
				//$empty = true;
				$stmt->fetch();
				$stmt->close();

				$dbc->close();

				if($_POST['submit'])
				{
					if ($col1 != NULL){
     				$_SESSION['id'] = $col1;
					$_SESSION['email'] = $col3;
					$_SESSION['type'] = $col6;
					$empty = true;

					header("Location: http://cs1.whitworth.edu/WritingCenter/FeatureSet1/CS-301-Writing-Center-Website/html/");

					exit();
     				}
     				else
     				{
     					echo "<h2>Invalid email/password</h2>";
     				}
				}
     			//else{
     			//	echo "<h1>Invalid email/password.</h1>";

     			//}
			?>
		</form>
		<div id='footer'>
			<a href="register.html">Don't have an account? Click here to register.</a>
		</div>
	</body>
</html>
