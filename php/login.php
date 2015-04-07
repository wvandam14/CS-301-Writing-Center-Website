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

		<div id="content">
		<!-- Start of content -->


		<?php 
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
					$email = $_POST['email'];
					$password = $_POST['password'];


					$stmt = $dbc->prepare("SELECT * FROM accounts WHERE email_address = ? AND password = ?;");
					$stmt->bind_param("ss",$email, $password);
					$stmt->execute();
>>>>>>> 49e0979727720a0cf8172a83ef2344a1accc40fd

					$stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7);
				
					$stmt->fetch();

					$stmt->close();

					$dbc->close();


<<<<<<< HEAD
				$user = validateEntries($_POST);
				if(empty($user->errors)){
					require_once('db_connection.php');
					$u = array();
					$u = isValidUser($user);

					if(empty($u)){
						echo '<h1>Error!</h1>
						<p class="error">The following error(s) occured:<br/>';
						echo '</p><p>Invalid user name and password combination</p><p><br/></p>';
					}
					else{
						$_SESSION['user_id'] = $u['id'];
						$_SESSION['username'] = $u['username'];
						$_SESSION['permission'] = $u['permission'];


						header('location:login.php');
						exit();
					}

				}
				else{
					echo '<h1>Error!</h1>
					<p class="error">The following error(s) occured:<br/>';
					foreach($user->errors as $msg){
						echo " - $msg<br/>\n";
					}
					echo '</p><p>Please try again.</p><p><br/></p>';
				}
			}
		?>
		 	
		 	<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="form_login">
				<h1>Log in</h1>
				<p>User Name: <input type="text" name="email" size="15" maxlength="20" value="<?php if(isset($_POST['email'])) echo $_POST['email'] ?>"></p>
				<p>Password: <input type="password" name="password" size="15" maxlength="20" value="<?php if(isset($_POST['password'])) echo $_POST['password'] ?>"></p>
				<p><input type="submit" name="submit" value="Log in"></p>
			</form>
=======
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
>>>>>>> 49e0979727720a0cf8172a83ef2344a1accc40fd

				<a href="register.html">Don't have an account? Click here to register.</a>
			</form>
		</div>
	</body>
</html>
