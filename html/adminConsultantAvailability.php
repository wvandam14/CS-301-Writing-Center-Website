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
			<div id="tableholder">
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
				      $query =  'select accounts.fname, accounts.lname, consultant_availability_times.times from accounts, consultant_availability_times where accounts.accountId = consultant_availability_times.consultant_Id and Day_Id = 0 Order By accounts.lname, accounts.fname';
				      if ( $stmt = $db->prepare($query)) {
				        // Execute the query
				        $result = $stmt->execute();

				        // Retrieve the query results
				        $result = $stmt->get_result();

				        // This gets the ID from the result (THERE HAS TO BE A BETTER WAY TO DO THIS BUT THIS WORKS FOR NOW)
				        $outp = "";
				        echo "<h1>Sunday</h1>";
				        $table = "<table class = \"schecule\"><tr><th></th><th>8:00-8:30</th><th>8:30-9:00</th><th>9:00-9:30</th><th>9:30-10:00</th><th>10:00-10:30</th><th>10:30-11:00</th><th>11:00-11:30</th><th>11:30-12:00</th><th>12:00-12:30</th><th>12:30-1:00</th><th>1:00-1:30</th><th>1:30-2:00</th><th>2:00-2:30</th><th>2:30-3:00</th><th>3:00-3:30</th><th>3:30-4:00</th><th>4:00-4:30</th><th>4:30-5:00</th><th>5:00-5:30</th><th>5:30-6:00</th></tr>";
				        while ( $row = $result->fetch_array(MYSQLI_ASSOC) ) {
				        	$fullname = $row['fname'] . " " . $row['lname'];
				        	$times = $row['times'];
				        	$table .= "<tr><th class=\"name\">$fullname</th>";
				        	for ($x = 0; $x < 20; $x++) {
							    $table .= "<td ";
							     if($times[$x] == '1'){
							     	$table .= "class=\"available\"";
							     } 
							     else{
							     	$table .= "class=\"unavailable\"";
							     }
							     $table .= "></td>";
							}
				        	$table .= "</tr>";
				        }
				        $table .= "</table>";
				        echo $table;
				        $db->close();
				        }
				      else {
				        die( 'Error in query preparation. error = ' . $db->errno .
				        " " . $db->error );
				      }
				 ?>
			 </div>
		</div>
	</body>
</html>










