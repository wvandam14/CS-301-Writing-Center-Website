<?php 
	session_start();
	/* STILL IN DEV */
	$page_title = 'Manage Consultants';
	require_once("auth.php");
	require_once('db_connection.php');
	
	$data = getAllAppointments($_SESSION['user_id'], $_SESSION['permission']);

	if(isset($_POST['addConsultant'])) {
		$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		if($db->connect_error) {
			die('Connect error: '.$db->connect_error);
		}
		
		$stmt = $db->prepare("INSERT INTO accountdetails (class_standing, graduation_year, major, secondary_major, minor, bio) values (?,?,?,?,?,?)");
		$classStanding = $db->real_escape_string($_POST['classStanding']);
		$graduationYear = $_POST['graduationYear'];
		$major = $db->real_escape_string($_POST['major']);
		$secondaryMajor = $db->real_escape_string($_POST['secondaryMajor']);
		$minor = $db->real_escape_string($_POST['minor']);
		$bio = $db->real_escape_string($_POST['bio']);
		$stmt->bind_param("sissss", $classStanding, $graduationYear, $major, $secondaryMajor, $minor, $bio);
		$stmt->execute();

		$stmt->close();

		$stmt = $db->prepare("INSERT INTO accounts (fname, lname, email_address, password, accounttypeid, accountdetails) values (?,?,?,?,2,?)");
		$fname = $db->real_escape_string($_POST['fname']);
		$lname = $db->real_escape_string($_POST['lname']);
		$email = $db->real_escape_string($_POST['email']);
		$password = $db->real_escape_string($_POST['password']);
		$accountDetailsID = $db->insert_id;
		$stmt->bind_param("ssssi", $fname, $lname, $email, $password, $accountDetailsID);
		$stmt->execute();
		$stmt->close();
		echo "Consultant named ".$fname." ".$lname." created.";
	}
	elseif (isset($_POST['removeConsultant'])) {
		$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		if($db->connect_error) {
			die('Connect error: '.$db->connect_error);
		}

		$stmt = $db->prepare("SELECT accountDetails from accounts where accountId = ?");
		$id = $_POST['id'];
		$stmt->bind_param('i', $id);
		$stmt->execute();
		
		$accountDetailsID;
		$result = $stmt->get_result();
		if($data = $result->fetch_assoc()) {
			$accountDetailsID = $data['accountDetails'];
		}

		$stmt = $db->prepare("DELETE FROM accounts WHERE accountId = ?");
		$stmt->bind_param('i', $id);
		$stmt->execute();

		$stmt = $db->prepare("DELETE FROM accountdetails WHERE accountDetailId = ?");
		$stmt->bind_param('i', $accountDetailsID);
		$stmt->execute();
	}
	

?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $page_title; ?></title>
		<link rel="stylesheet" href="<?php echo empty($css) ? '../css/style.css':$css; ?>" type="text/css" media="screen"/>
		<?php if(!empty($header_line)) echo $header_line; ?>
		<meta http-equiv="content-type" content="text/html"; charset="utf-8" />
	</head>
	<body>
		<?php require_once("navbar.php"); ?>

		<div id="content">
			<?php
				$consultants = getConsultants();
				if(empty($consultants)) {
					echo "There are no consultants to display.";
				}
				else {
					?>
						<h1><i>Manage Consultants</i></h1>

						<h2>Delete Consultants</h2>
						<form name = "removeConsultant" action = "<?php echo $_SERVER['PHP_SELF'] ?>" method = "POST">
							<select name = "id">
								<?php
									$consultants = getConsultantsWithoutModifyingKeyValue(); // because the other function returns specific key values. This will return the general key value
									print_r($consultants);
									foreach($consultants as $c) {
										echo "<option value = ".$c['id'].">".$c['name']."</option>";
									}
								?>
							</select>
							<input type = "radio" name = "delete" required>Delete<br><br>
							<input type = "submit" name = "removeConsultant" value = "Confirm deletion">
						</form>
					<?php
						}
					?>

						<h2>Add Consultants</h2>
						<form name = "addConsultant" action = "<?php echo $_SERVER['PHP_SELF'] ?>" method = "POST">
							First name: <input type = "text" name = "fname" required><br>
							Last name: <input type = "text" name = "lname" required><br>
							Email: <input type = "email" name = "email" required><br>
							Password: <input type = "password" name = "password" required><br>
							Class Standing: <select name = 'classStanding' required>
												<option value = 'freshman'>Freshman</option>
												<option value = 'sophomore'>Sophomore</option>
												<option value = 'junior'>Junior</option>
												<option value = 'senior'>Senior</option>
											</select><br>
							Graduation Year: <input type = "number" name = "graduationYear" value = "2017" required><br>
							Major: <input type = "text" name = "major" required><br>
							Secondary Major: <input type = "text" name = "secondaryMajor"><br>
							Minor: <input type = "text" name = "minor"><br>
							Bio: <textarea name = "bio" rows = "10" col = "20"></textarea><br>
							<input type = "submit" name = "addConsultant" value = "Add consultant">
						</form>
		</div>
	</body>
</html>