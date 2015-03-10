<?php
	session_start();
	$page_title = 'Log in';
	include('_inc/header.php');



	function validateEntries($post){
		
		$user = new stdClass();
		$user->errors = array();
		
		if(empty($post['email'])){
			$user->errors[] = "Your forgot to enter your user name.";
		}
		else{
			//$user->username = mysqli_real_escape_string($dbs,trim($post['username']));
			$user->email = trim($post['email']);
		}

		if(empty($post['password'])){
			$user->errors[] = "Your forgot to enter your password.";
		}
		else{
			//$user->password = mysqli_real_escape_string($dbs,trim($post['password']));
			$user->password = trim($post['password']);
		}

		return $user;
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

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


				header('location:index.php');
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

<?php include('_inc/footer.php'); ?>