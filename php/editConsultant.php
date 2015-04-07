<<<<<<< HEAD
<?php 

	$error='';
	$col1=NULL;
				
	function validate($value) {
		if (empty($value)) {
			return false;
		}
		else {
			return true;
		}
	}
		$email=$_POST['email'];
		$accPassword=$_POST['password'];

	if (!validate($accPassword) || !validate($email)) {
		echo "<h1>Please do not leave text boxes blank!</h1>";

	}
	else 
	{

		// Initializes values to connect to the database
			$servername = "CS1";
			$username = "CS472_2015";
			$password = "WritingCenter";

		// connect to database
		$db = new mysqli( $servername, $username, $password, "WritingCenter" );

			// If it fails, output a connection error
			if ( $db->connect_errno ) {
				die( 'Connect Error: ' . $db->connect_errno );
			}

			$pass = $accPassword;
			$em = $email;

			$stmt = $db->prepare("SELECT * FROM accounts WHERE email_address = ?");
			$stmt->bind_param("ss", $em);

			$stmt->execute();

			$stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7);
			$stmt->fetch();

			$stmt->close();


			$db->close();


			if ($col1 != NULL){
				$_SESSION['id'] = $col1;
			$_SESSION['email'] = $col5;
			$_SESSION['type'] = $col6;

			header("Location: http://cs1.whitworth.edu/WritingCenter/FeatureSet1/CS-301-Writing-Center-Website/html/");

			exit();
			}
			else{
				echo "<h1>Invalid email/password.</h1>";
			}
		}
	
?>

<!--

TODO: 

	- Get current logged in user from session data
	- Populate form fields from DB
	- cleanse input data
	- separate .php file to push updated form info to DB

-->

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Whitworth University Composition Commons</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body>
		<a href="index.htm">
		<img src="../img/wcc-logo.png" alt="WCC Logo" class='logo'>
		</a>
		<!-- To Do: Find a way to get the text boxes to line up with one another, (floated divs?) -->
		<h1>Update Consultant Account</h1>
		<form action = "../php/register.php" method = "post">
			<!--Personal info-->
			Email Address:
			<input type="text" name="email" value="<? echo $consultant->email; ?>"><br><br>
			First Name:
			<input type="text" name="firstName"><br>
			Last Name:
			<input type="text" name="lastName"><br><br>
			<!--Password info-->
			Password:
			<input type="text" name="password"><br>
			Re-Enter Password:
			<input type="text" name="REpassword"><br><br>
			<!--Student info-->
			Standing:
			<select name = "standing">
				<option value="noSelection1">--Please Select--</option>
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
				<option value="No Selection">--Please Select--</option>
				<option value="2014">2014</option>
				<option value="2015">2015</option>
				<option value="2016">2016</option>
				<option value="2017">2017</option>
				<option value="2018">2018</option>
				<option value="NA">N/A</option>
			</select>
			<br>
			First or Home Language:
			<select name = "Language">
				<option value="No Selection">--Please Select--</option>
				<option value="English">English</option>
				<option value="Arabic">Arabic</option>
				<option value="Chinese">Chinese</option>
				<option value="French">French</option>
				<option value="German">German</option>
				<option value="Japanese">Japanese</option>
				<option value="Korean">Korean</option>
				<option value="Portuguese">Portuguese</option>
				<option value="Russian">Russian</option>
				<option value="Spanish">Spanish</option>
				<option value="Other">Other</option>
			</select>
			<br><br>
			<!--Majors and minors-->
			Major:
			<select name = "Major">
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
			<!--Email options for users-->
			Send an Email:<br><br>
			When I make my appointment.
			<input type="radio" name="appointment" value="Yes">Yes
			<input type="radio" name="appointment" value="No">No
			<br>
			When I modify an appointment.
			<input type="radio" name="modify" value="Yes">Yes
			<input type="radio" name="modify" value="No">No
			<br>
			When I delete an appointment.
			<input type="radio" name="delete" value="Yes">Yes
			<input type="radio" name="delete" value="No">No
			<br>
			When an announcement or mass email is sent.
			<input type="radio" name="announcement" value="Yes">Yes
			<input type="radio" name="announcement" value="No">No
			<br>
			To remind me of my upcoming appointment.
			<input type="radio" name="remind" value="Yes">Yes
			<input type="radio" name="remind" value="No">No
			<br>
			<input type = "submit">
		</form>
	</body>
</html>


 
=======
<?php
    session_start();
  	//require_once('db_connection.php');

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
    <meta charset="utf-8">
    <title>Whitworth University Composition Commons</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
  </head>
  <body>
    <a href="index.htm">
    <img src="../img/wcc-logo.png" alt="WCC Logo" class='logo'>
    </a>
    <!-- To Do: Find a way to get the text boxes to line up with one another, (floated divs?) -->
    <h1>Update Consultant</h1>
    <form action = "../php/register.php" method = "post">
      <!--Personal info-->
      Email Address:
      <input type="text" name="email" value="<?php echo $col4; ?>"><br><br>
      First Name:
      <input type="text" name="firstName" value ="<?php echo $col2; ?>"><br>
      Last Name:
      <input type="text" name="lastName" value ="<?php echo $col3; ?>"><br><br>
      <!--Password info-->
      Password:
      <input type="text" name="password" value ="<?php echo $col5; ?>"><br>
      Re-Enter Password:
      <input type="text" name="REpassword" value ="<?php echo $col5; ?>"><br><br>
      <!--Student info-->
      Standing:
      <select name = "standing">
        <option value="noSelection1"><?php echo $colx2; ?></option>
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
        <option value="No Selection"><?php echo $colx3; ?></option>
        <option value="2014">2014</option>
        <option value="2015">2015</option>
        <option value="2016">2016</option>
        <option value="2017">2017</option>
        <option value="2018">2018</option>
        <option value="NA">N/A</option>
      </select>
      <br>
      <!--First or Home Language:
      <select name = "Language" value =""; ?>">
        <option value="No Selection">Please Select</option>
        <option value="English">English</option>
        <option value="Arabic">Arabic</option>
        <option value="Chinese">Chinese</option>
        <option value="French">French</option>
        <option value="German">German</option>
        <option value="Japanese">Japanese</option>
        <option value="Korean">Korean</option>
        <option value="Portuguese">Portuguese</option>
        <option value="Russian">Russian</option>
        <option value="Spanish">Spanish</option>
        <option value="Other">Other</option>-->
      </select>
      <br><br>
      <!--Majors and minors-->
      Major:
      <select name = "Major">
        <option value="Undeclared"><?php echo $colx4; ?></option>
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
        <option value="Undeclared"><?php echo $colx5; ?></option>
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
        <option value="Undeclared"><?php echo $colx6; ?></option>
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
      <input type = "submit">
    </form>
  </body>
</html>
    
    

>>>>>>> 49e0979727720a0cf8172a83ef2344a1accc40fd
