<?php
    $page_title = 'Create Account';
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
    <meta charset="utf-8">
    <title>Whitworth University Composition Commons</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
  </head>
  <body>
    <a href="../html/index.htm">
      <img src="../img/wcc-logo.png" alt="WCC Logo" class='logo'>
    </a>

    <h1>Create a New Account</h1>
    <form action="" method="post">
      <!--Personal info-->
      First Name:
      <input type="text" name="firstName"><br>
      Last Name:
      <input type="text" name="lastName"><br><br>
      <!--Log in info-->
      Email Address:
      <input type="text" name="email"><br>
      Password:
      <input type="password" name="password"><br>
      Re-Enter Password:
      <input type="password" name="Repassword"><br><br>
      <!--Student info-->
      Standing:
      <select name = "standing">
        <option value="noSelection">--Please Select--</option>
        <option value="Freshman">Freshman</option>
        <option value="Sophomore">Sophomore</option>
        <option value="Junior">Junior</option>
        <option value="Senior">Senior</option>
        <option value="GradStudent">Graduate Student</option>
        <option value="Staff">Staff</option>
      </select><br>
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
      <br><br>
      <!--Email options for users-->
      Send an Email:<br>
      When I make my appointment.
      <input type="radio" name="appointment" value="1">Yes
      <input type="radio" name="appointment" value="0">No
      <br>
      When I modify an appointment.
      <input type="radio" name="modify" value="1">Yes
      <input type="radio" name="modify" value="0">No
      <br>
      When I delete an appointment.
      <input type="radio" name="delete" value="1">Yes
      <input type="radio" name="delete" value="0">No
      <br>
      When an announcement or mass email is sent.
      <input type="radio" name="announcement" value="1">Yes
      <input type="radio" name="announcement" value="0">No
      <br>
      To remind me of my upcoming appointment.
      <input type="radio" name="remind" value="1">Yes
      <input type="radio" name="remind" value="0">No
      <br>
      <input type = "submit" name="submit" value = "Register" class = 'btn'>
      <?php
        //accountDetailId = null;
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
        $Repassword = $dbc->real_escape_string($_POST['Repassword']);

        //Email Options
        $Make = $dbc->real_escape_string($_POST['appointment']);
        $Modify = $dbc->real_escape_string($_POST['modify']);
        $Delete = $dbc->real_escape_string($_POST['delete']);
        $Announcement = $dbc->real_escape_string($_POST['announcement']);
        $Remind = $dbc->real_escape_string($_POST['remind']);

        if($_POST['submit'])
        {
          $accCheck = $dbc->prepare("SELECT accountId FROM accounts WHERE email_address = ?;");
          $accCheck->bind_param("s", $Email);
          $accCheck->execute();
          $accCheck->bind_result($res);
          $accCheck->fetch();
          $accCheck->close();

          if($res != null)
          {
            echo '<h2> Account already exists. </h2>';
            exit();
          }
          if($Password != $Repassword)
          {
            echo '<h2> Passwords does not match. </h2>';
            exit();
          }
          if($Make == null)
            $Make = 0;
          if($Modify == null)
            $Modify = 0;
          if($Delete == null)
            $Delete = 0;
          if($Announcement == null)
            $Announcement = 0;
          if($Remind == null)
            $Remind = 0;

          $stmt = $dbc->prepare("INSERT into accountdetails (accountDetailId, class_standing, graduation_year, major, secondary_major, minor, bio, missed_appointments) values (null, ?,?,?,?,?, null, null);");
          $stmt->bind_param("sisss", $Standing, $Graduation_Year, $Major, $Secondary_Major, $Minor);
          $stmt->execute();
          $stmt->close();

          $stmt2 = $dbc->prepare("SELECT MAX(accountDetailId) FROM accountdetails;");
          $stmt2->execute();
          $stmt2->bind_result($accDetId);
          $stmt2->fetch();
          $stmt2->close();

          $stmt3 = $dbc->prepare("INSERT into accounts (accountId, fname, lname, email_address, password, accountTypeId, accountDetails) values (null,?,?,?,?,3,?);");
          $stmt3->bind_param("ssssi", $Fname, $Lname, $Email, md5($Password), $accDetId);
          $stmt3->execute();
          $stmt3->close();

          $stmt4 = $dbc->prepare("SELECT accountId FROM accounts WHERE email_address = ?;");
          $stmt4->bind_param("s", $Email);
          $stmt4->execute();
          $stmt4->bind_result($res2);
          $stmt4->fetch();
          $stmt4->close();

          $stmt5 = $dbc->prepare("INSERT into email_options (Client_ID, Make_appt, Modify_appt, Delete_appt, Announcement, Reminderof_appt, iCal_link) values (?,?,?,?,?,?, null);");
          $stmt5->bind_param("iiiiii", $res2, $Make, $Modify, $Delete, $Announcement, $Remind);
          $stmt5->execute();
          $stmt5->close();

          ?> 
		<script type="text/javascript">
			window.setTimeout(function(){
				// Move to a new location or you can do something else
				window.location.href = "../html/index.htm";
			}, 5000);
		</script>
		<h1>Your account has been updated.</h1> 
		<h3>You will be redirected in 5 seconds. If not, click <a href="../html/index.htm">here</a>.
		<?php
          exit();
        }

        //Bind the cleaned parameters to the pre-prepared query

      ?>


    </form>
  </body>
</html>