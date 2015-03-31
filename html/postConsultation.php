<!--
Title: Survey form prototype
Author: August Peverly
Date: 1/22/2015
-->
<html lang="en-US"><head>

	<meta charset="UTF-8">
	
	<title>Public Files</title>
	<!--
	<script src="js/javascript.js" >
	</script><!not using javascript currently-->
	<link rel="stylesheet" type="text/css" href="css/style.css"><!--style sheet, can be changed later-->
</head>
<body>
	<a href="index.htm">
		<img src="../img/wcc-logo.png" alt="WCC Logo" class='logo'>
	</a>
	<h1>Post-Consultation Notes</h1>
	<hr>
	<form action="../php/postConsultation.php" method = "post"><!--attach to a php-->
	<div class="outlined"><!--modeled this form after the paper we used as a reference-->
		<p><b>Send a copy to Instructor?</b>
		<input type="radio" name="emailtoins" value="true" checked="checked" /> Yes
		<input type="radio" name="emailtoins" value="false" /> No</p><!---will be used to decide weather to email to the instructor-->
		<p>Client:
			<input type="text" name="Client" size="25" maxlength="254" required="required"/>
			Date:
			<input type="date" name="date" required="required"/></p>
		<p>
			Client is a: <select name="clientType"><!--origional form had different class standing options-->
				<option>Student</option>
				<option>Faculty</option>
				<option>Staff</option>
				<option>Visiting Professor</option>
			</select>
			Prefered Language <select name="Language"><!--add more as needed-->
				<option>English</option>
				<option>Spanish</option>
				<option>Other</option>
			</select></p>
		<p>
			Instructor Name 
			<input type="text" name="Instructor" size="25" maxlength="254" required="required"/><!--use php to add in instructor names and course names and section numbers-->
			
			Course <input type="text" name="Class" size="10" maxlength="254">
			Section <input type="text" name="Section" size="10" maxlength="254">

			<!--
			Course <select name="Class">
				<option>N/A</option>
				<option>This is</option>
				<option>where the</option>
				<option>class names</option>
				<option>will go</option>
			</select>
			Section <select name="Section">
				<option>N/A</option>
				<option>This is</option>
				<option>where the</option>
				<option>section numbers</option>
				<option>will go</option>
			</select>
			-->

		</p>
		<p>Consultant
			<select name="Consultant">
				<?php
				  $servername = "CS1";
			      $username = "CS472_2015";
			      $password = "WritingCenter";

			      // Tries to connect to the database
			      $db = new mysqli( $servername, $username, $password, "WritingCenter" );
			      // If it fails, output a connection error
			      if ( $db->connect_error ) {
			        die( 'Connect Error: ' . $db->connect_error );
			      }

			      // Query to get the Consultant ID based on the name given in the form
			      $query =  'select fname, lname from accounts where accountTypeId = 2';
			      if ( $stmt = $db->prepare($query)) {
			        // Execute the query
			        $result = $stmt->execute();

			        // Retrieve the query results
			        $result = $stmt->get_result();

			        // This gets the ID from the result (THERE HAS TO BE A BETTER WAY TO DO THIS BUT THIS WORKS FOR NOW)
			        $outp = "";
			        while ( $row = $result->fetch_array(MYSQLI_ASSOC) ) {
			        	$fullname = $row['fname'] . " " . $row['lname'];
			        	
			        	echo "<option value=\"".$fullname."\">".$fullname."</option>";

			        	
			          $outp .= $row['Consultant_ID'];           
			        }
			        $outp .="";

			        $db->close();
			        }
			      else {
			        die( 'Error in query preparation. error = ' . $db->errno .
			        " " . $db->error );
			      }

			 	?>
			</select>
		</p>
	</div>
	<p>
		Document/Project Type <input type="text" name="projectType" size="25" maxlength="254" required="required"/>
	</p>
	<p>
		During the consultation, we focused on the following issues:
	</p>
	<!--<ul class='checkbox'>-->
			<li><input type="checkbox" value="Yes" id='1' name="Assignment"><label for='1'>understanding the assignment/project</label></li>
			<li><input type="checkbox" value="Yes" id='2' name="Ideas"><label for='2'>generating ideas/getting started</label></li>
			<li><input type="checkbox" value="Yes" id='3' name="Thesis"><label for='3'>thesis statement/argument</label></li>
			<li><input type="checkbox" value="Yes" id='4' name="Subject"><label for='4'>focusing the subject</label></li>
			<li><input type="checkbox" value="Yes" id='5'  name="Audience"><label for='5'>addressing an audience</label></li>
			<li><input type="checkbox" value="Yes" id='6' name="Organization"><label for='6'>logical sequences/organization</label></li>
			<li><input type="checkbox" value="Yes" id='7' name="Content"><label for='7'>content development/support of main ideas</label></li>
			<li><input type="checkbox" value="Yes" id='8' name="Intro"><label for='8'>introductions/conclusions</label></li>
			<li><input type="checkbox" value="Yes" id='9' name="Sources"><label for='9'>using sources/research skills</label>
			<li><input type="checkbox" value="Yes" id='10' name="Citations"><label for='10'>citations (APA, MLA, etc.)</label></li>
			<li><input type="checkbox" value="Yes" id='11' name="Design"><label for='11'>document desigm/format</label></li>
			<li><input type="checkbox" value="Yes" id='12' name="Sentence"><label for='12'>sentence structure</label></li>
			<li><input type="checkbox" value="Yes" id='13' name="Grammar"><label for='13'>grammar/mechanics</label></li>
		<!--</ul>-->
	</div>
	<br>
	<div id="placeholder"><!--this is a place holder box so that the comments section is below those options above-->
	</div>
	<textarea name="comments" maxlength="2000" id="comments" placeholder="Comments"></textarea><br /><br />
	<input type="submit" value="Send" />
	</form>
	
</body></html>
