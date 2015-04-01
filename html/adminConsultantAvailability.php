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
					function get_times_for_day($dayId, $db){
					  $query =  "select accounts.fname, accounts.lname, consultant_availability_times.times from accounts, consultant_availability_times where accounts.accountId = consultant_availability_times.consultant_Id and Day_Id = $dayId Order By accounts.lname, accounts.fname";
				      if ( $stmt = $db->prepare($query)) {
				        // Execute the query
				        $result = $stmt->execute();

				        // Retrieve the query results
				        $result = $stmt->get_result();

				        $day;

				        switch ($dayId) {
						    case 0:
						        $day = "Sunday";
						        break;
						    case 1:
						        $day = "Monday";
						        break;
						    case 2:
						        $day = "Tuesday";
						        break;
						    case 3:
						        $day = "Wednesday";
						        break;
						    case 4:
						        $day = "Thursday";
						        break;
						    case 5:
						        $day = "Friday";
						        break;
						    case 6:
						        $day = "Saturday";
						        break;
						    default:
						        $day = "NA";
						}

				        echo "<h2>$day</h2>";
				        //$table = "<table class = \"schecule\"><tr><th></th><th>9:00-9:30</th><th>9:30-10:00</th><th>10:00-10:30</th><th>10:30-11:00</th><th>11:00-11:30</th><th>11:30-12:00</th><th>12:00-12:30</th><th>12:30-1:00</th><th>1:00-1:30</th><th>1:30-2:00</th><th>2:00-2:30</th><th>2:30-3:00</th><th>3:00-3:30</th><th>3:30-4:00</th><th>4:00-4:30</th><th>4:30-5:00</th><th>5:00-5:30</th><th>5:30-6:00</th><th>6:00-6:30</th><th>6:30-7:00</th><th>7:00-7:30</th><th>7:30-8:00</th></tr>";
				        $table = "<table class = \"schecule\"><tr><th></th><th colspan=\"2\">9:00 am</th><th colspan=\"2\">10:00 am</th><th colspan=\"2\">11:00 am</th><th colspan=\"2\">12:00 pm</th><th colspan=\"2\">1:00 pm</th><th colspan=\"2\">2:00 pm</th><th colspan=\"2\">3:00 pm</th><th colspan=\"2\">4:00 pm</th><th colspan=\"2\">5:00 pm</th><th colspan=\"2\">6:00 pm</th><th colspan=\"2\">7:00 pm</th></tr>";
				        while ( $row = $result->fetch_array(MYSQLI_ASSOC) ) {
				        	$fullname = $row['fname'] . " " . $row['lname'];
				        	$times = $row['times'];
				        	$table .= "<tr><th class=\"name\">$fullname</th>";
				        	for ($x = 0; $x < 22; $x++) {
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
				        }
				      else {
				        die( 'Error in query preparation. error = ' . $db->errno .
				        " " . $db->error );
				      }
					}

					  $servername = "CS1";
				      $username = "CS472_2015";
				      $password = "WritingCenter";

				      // Tries to connect to the database
				      $db = new mysqli( $servername, $username, $password, "WritingCenter" );
				      // If it fails, output a connection error
				      if ( $db->connect_error ) {
				        die( 'Connect Error: ' . $db->connect_error );
				      }

				      get_times_for_day(0, $db);
				      get_times_for_day(1, $db);
				      get_times_for_day(2, $db);
				      get_times_for_day(3, $db);
				      get_times_for_day(4, $db);
				      get_times_for_day(5, $db);
				      get_times_for_day(6, $db);

				      $db->close();
				 ?>
			 </div>
		</div>
	</body>
</html>