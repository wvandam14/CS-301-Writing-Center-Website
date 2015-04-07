<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Consultant Evaluation Form</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body>
		<!--This is the main heading of the form-->
		<a href="index.htm">
		<img src="../img/wcc-logo.png" alt="WCC Logo" class='logo'>
		</a>
		<h1>Consultant Evaluation</h1>
		<?php
			session_start();
			//navbar
			include "../php/navbar.php";
			
			//check login
			if(!isset($_SESSION['user_id'])){
				echo "You are not logged in. Please <a href='login.html'>log in</a> to continue";
				exit;
			}
		?>
		<!--Have the user input their name and the date-->
		<div class='container'>
			<form action = "../php/ConsultantEvaluation.php" method ="post">
				<p>Consultant:
					<select name='Consultant'>
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
					Date:
					<input type="date" name="Date" size="20" required="required">
				</p>
			<!--Consultant questions with score response-->
				<p>The consultant explained ideas to me in a way that I can understand and use.<br>
					<select name='score1'>
						<option value="noSelection">--Please Select--</option>
						<option value="1">1 - Strongly Agree</option>
						<option value="2">2 - Agree</option>
						<option value="3">3 - Neither Agree Nor Disagree</option>
						<option value="4">4 - Disagree</option>
						<option value="5">5 - Strongly Disagree</option>
						<option value="unknown">Don't Know</option>
					</select>
				</p>
			<p>The consultant addressed my concerns.<br>
					<select name='score2'>
						<option value="noSelection">--Please Select--</option>
						<option value="1">1 - Strongly Agree</option>
						<option value="2">2 - Agree</option>
						<option value="3">3 - Neither Agree Nor Disagree</option>
						<option value="4">4 - Disagree</option>
						<option value="5">5 - Strongly Disagree</option>
						<option value="unknown">Don't Know</option>
					</select>
				</p>
				<p>The consultant made me feel comfortable and respected during my consultation.<br>
					<select name='score3'>
						<option value="noSelection">--Please Select--</option>
						<option value="1">1 - Strongly Agree</option>
						<option value="2">2 - Agree</option>
						<option value="3">3 - Neither Agree Nor Disagree</option>
						<option value="4">4 - Disagree</option>
						<option value="5">5 - Strongly Disagree</option>
						<option value="unknown">Don't Know</option>
					</select>
				</p>
			<!--Consultation questions with written response-->
				<p>What did you learn to help you with future writing projects?<br>
					<textarea name = "Learn" rows="5" cols="50" placeholder="Write your thoughts here..."></textarea>
				</p>
				<p>Do you have any additional comments or feedback?<br>
					<textarea name = "Feedback" rows="5" cols="50" placeholder="Write your thoughts here..."></textarea>
				</p>
				<input type="submit" value="Submit" class='btn'>
			</form>
		</div>
	</body>
</html>










