<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Consultant Availability</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body>
		<!--This is the main heading of the form-->
		<a href="index.htm">
		<img src="../img/wcc-logo.png" alt="WCC Logo" class='logo'>
		</a>
		<h1>Consultant Availability</h1>
		<!--Have the user input their name and the date-->
		<div class='container'>
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
		</div>
	</body>
</html>










