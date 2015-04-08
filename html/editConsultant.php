<?php
	//check if consultant, else die()
    session_start();
    $servername = "CS1";
	$username = "CS472_2015";
	$password = "WritingCenter";
	// connect to database
	$db = new mysqli( $servername, $username, $password, "WritingCenter" );
    if ( $db->connect_errno ) {
		die( 'Connect Error: ' . $db->connect_errno );
	}
	/*Get current user and then query for their current preferences & info */
	$curUser = $_SESSION['id'];
	$curEmail = $_SESSION['email'];
	$curType = $_SESSION['type'];
	$stmt = $db->prepare("SELECT * FROM accounts WHERE accountId = ?");
	$stmt->bind_param("i", $curUser);
	$stmt->execute();
	$stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7);
	$stmt->fetch();
	$stmt->close();
	$stmt = $db->prepare("SELECT * FROM accountDetails WHERE accountDetailId = ?");
	$stmt->bind_param("i", $col7);
	$stmt->execute();
	$stmt->bind_result($colx1, $colx2, $colx3, $colx4, $colx5, $colx6, $colx7, $colx8);
	$stmt->fetch();
	$stmt->close();
	$db->close();
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
				<a href="../php/appointmentPopup.php">Appointment</a>
			<?php }} ?>
			<a href="../php/viewAppointments.php">View My Appointments</a>
			<a href="#"><?php echo empty($_SESSION['username']) ? '':$_SESSION['username']; ?></a>
			<a href="../php/logout.php" title="">logout</a>
		</div>

		<div id="content">
		<?php if ($col6 == 2) { ?>
			<form action = "../php/editConsultantSubmit.php" method = "post">
			  <!--Personal info-->
			  Email Address:
			  <input type="text" name="email" value="<?php echo $col4; ?>"><br><br>
			  First Name:
			  <input type="text" name="firstName" value ="<?php echo $col2; ?>"><br>
			  Last Name:
			  <input type="text" name="lastName" value ="<?php echo $col3; ?>"><br><br>
			  <!--Password info-->
			  Password:
			  <input type="password" name="password" value =""><br>
			  Re-Enter Password:
			  <input type="password" name="REpassword" value =""><br><br>
			  <!--Student info-->
			  Standing:
			  <select name = "standing">
				<option value="<?php echo $colx2; ?>"><?php echo $colx2; ?></option>
				<option value="No Selection">--Please Select--</option>
				<option value="Freshman">Freshman</option>
				<option value="Sophomore">Sophomore</option>
				<option value="Junior">Junior</option>
				<option value="Senior">Senior</option>
				<option value="GradStudent">Graduate Student</option>
				<option value="Staff">Staff</option>
			  </select>
			  <br>
			  Graduation Year:
			  <select name = "Graduation_Year">
				<option value="<?php echo $colx3; ?>"><?php echo $colx3; ?></option>
				<option value="No Selection">--Please Select--</option>
				<option value="2014">2014</option>
				<option value="2015">2015</option>
				<option value="2016">2016</option>
				<option value="2017">2017</option>
				<option value="2018">2018</option>
				<option value="NA">N/A</option>
			  </select>
			  <br>
			  <!--Majors and minors-->
			  Major:
			  <select name = "Major">
				<option value="<?php echo $colx4; ?>"><?php echo $colx4; ?></option>
				<option value="Undeclared">--Undeclared--</option>
				<option value="Accounting">Accounting</option>
				<option value="American Studies">American Studies</option>
				<option value="Applied Physics">Applied Physics</option>
				<option value="Art">Art</option>
				<option value="Art Administration">Art Administration</option>
				<option value="Athletic Training">Athletic Training</option>
				<option value="Bioinformatics">Bioinformatics</option>
				<option value="Biology">Biology</option>
				<option value="Biophysics">Biophysics</option>
				<option value="Business Management">Business Management</option>
				<option value="Chemistry">Chemistry</option>
				<option value="Communication">Communication</option>
				<option value="Computer Science">Computer Science</option>
				<option value="Cross-Cultural Studies, History Emphasis">Cross-Cultural Studies, History Emphasis</option>
				<option value="Cross-Cultural Studies, Political Science Emphasis">Cross-Cultural Studies, Political Science Emphasis</option>
				<option value="Economics">Economics</option>
				<option value="Engineering Physics">Engineering Physics</option>
				<option value="English">English</option>
				<option value="French">French</option>
				<option value="Health Science">Health Science</option>
				<option value="History">History</option>
				<option value="International Business">International Business</option>
				<option value="International Studies, History Emphasis">International Studies, History Emphasis</option>
				<option value="International Studies, Political Science Emphasis">International Studies, Political Science Emphasis</option>
				<option value="Journalism and Mass Communication">Journalism and Mass Communication</option>
				<option value="Kinesiology">Kinesiology</option>
				<option value="Marketing">Marketing</option>
				<option value="Mathematical Economics">Mathematical Economics</option>
				<option value="Mathematics">Mathematics</option>
				<option value="Music">Music</option>
				<option value="Music Education">Music Education</option>
				<option value="Nursing">Nursing</option>
				<option value="Peace Studies">Peace Studies</option>
				<option value="Philosophy">Philosophy</option>
				<option value="Physics">Physics</option>
				<option value="Political Science">Political Science</option>
				<option value="Psychology">Psychology</option>
				<option value="Sociology">Sociology</option>
				<option value="Spanish">Spanish</option>
				<option value="Speech Communication">Speech Communication</option>
				<option value="Theatre">Theatre</option>
				<option value="Theology">Theology</option>
			  </select>
			  <br>
			  Secondary Major:
			  <select name = "Secondary_Major">
				<option value="<?php echo $colx5; ?>"><?php echo $colx5; ?></option>
				<option value="Undeclared">--Undeclared--</option>
				<option value="Accounting">Accounting</option>
				<option value="American Studies">American Studies</option>
				<option value="Applied Physics">Applied Physics</option>
				<option value="Art">Art</option>
				<option value="Art Administration">Art Administration</option>
				<option value="Athletic Training">Athletic Training</option>
				<option value="Bioinformatics">Bioinformatics</option>
				<option value="Biology">Biology</option>
				<option value="Biophysics">Biophysics</option>
				<option value="Business Management">Business Management</option>
				<option value="Chemistry">Chemistry</option>
				<option value="Communication">Communication</option>
				<option value="Computer Science">Computer Science</option>
				<option value="Cross-Cultural Studies, History Emphasis">Cross-Cultural Studies, History Emphasis</option>
				<option value="Cross-Cultural Studies, Political Science Emphasis">Cross-Cultural Studies, Political Science Emphasis</option>
				<option value="Economics">Economics</option>
				<option value="Engineering Physics">Engineering Physics</option>
				<option value="English">English</option>
				<option value="French">French</option>
				<option value="Health Science">Health Science</option>
				<option value="History">History</option>
				<option value="International Business">International Business</option>
				<option value="International Studies, History Emphasis">International Studies, History Emphasis</option>
				<option value="International Studies, Political Science Emphasis">International Studies, Political Science Emphasis</option>
				<option value="Journalism and Mass Communication">Journalism and Mass Communication</option>
				<option value="Kinesiology">Kinesiology</option>
				<option value="Marketing">Marketing</option>
				<option value="Mathematical Economics">Mathematical Economics</option>
				<option value="Mathematics">Mathematics</option>
				<option value="Music">Music</option>
				<option value="Music Education">Music Education</option>
				<option value="Nursing">Nursing</option>
				<option value="Peace Studies">Peace Studies</option>
				<option value="Philosophy">Philosophy</option>
				<option value="Physics">Physics</option>
				<option value="Political Science">Political Science</option>
				<option value="Psychology">Psychology</option>
				<option value="Sociology">Sociology</option>
				<option value="Spanish">Spanish</option>
				<option value="Speech Communication">Speech Communication</option>
				<option value="Theatre">Theatre</option>
				<option value="Theology">Theology</option>
			  </select>
			  <br>
			  Minor:
			  <select name = "Minor">
				<option value="<?php echo $colx6; ?>"><?php echo $colx6; ?></option>
				<option value="Undeclared">--Undeclared--</option>
				<option value="Accounting">Accounting</option>
				<option value="American Studies">American Studies</option>
				<option value="Applied Physics">Applied Physics</option>
				<option value="Art">Art</option>
				<option value="Art Administration">Art Administration</option>
				<option value="Athletic Training">Athletic Training</option>
				<option value="Bioinformatics">Bioinformatics</option>
				<option value="Biology">Biology</option>
				<option value="Biophysics">Biophysics</option>
				<option value="Business Management">Business Management</option>
				<option value="Chemistry">Chemistry</option>
				<option value="Communication">Communication</option>
				<option value="Computer Science">Computer Science</option>
				<option value="Cross-Cultural Studies, History Emphasis">Cross-Cultural Studies, History Emphasis</option>
				<option value="Cross-Cultural Studies, Political Science Emphasis">Cross-Cultural Studies, Political Science Emphasis</option>
				<option value="Economics">Economics</option>
				<option value="Engineering Physics">Engineering Physics</option>
				<option value="English">English</option>
				<option value="French">French</option>
				<option value="Health Science">Health Science</option>
				<option value="History">History</option>
				<option value="International Business">International Business</option>
				<option value="International Studies, History Emphasis">International Studies, History Emphasis</option>
				<option value="International Studies, Political Science Emphasis">International Studies, Political Science Emphasis</option>
				<option value="Journalism and Mass Communication">Journalism and Mass Communication</option>
				<option value="Kinesiology">Kinesiology</option>
				<option value="Marketing">Marketing</option>
				<option value="Mathematical Economics">Mathematical Economics</option>
				<option value="Mathematics">Mathematics</option>
				<option value="Music">Music</option>
				<option value="Music Education">Music Education</option>
				<option value="Nursing">Nursing</option>
				<option value="Peace Studies">Peace Studies</option>
				<option value="Philosophy">Philosophy</option>
				<option value="Physics">Physics</option>
				<option value="Political Science">Political Science</option>
				<option value="Psychology">Psychology</option>
				<option value="Sociology">Sociology</option>
				<option value="Spanish">Spanish</option>
				<option value="Speech Communication">Speech Communication</option>
				<option value="Theatre">Theatre</option>
				<option value="Theology">Theology</option>
			  </select>
			  <br>
			  <br>
			  <input type = "submit" name="submit" value = "Update" class = 'btn'>
			</form>
		<?php } else {
				echo 'You do not have permission to visit this page';
				exit();
			}
		?>
		<!-- End of content -->
		</div>
	</body>
</html>