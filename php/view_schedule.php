<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Whitworth University Composition Commons</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
<body>
<h1>View a Schedule </h1>
    <?php		
		// Initializes values to connect to the database
		$servername = "cs1";
		$username = "CS472_2015";
		$password = "WritingCenter";
		// Tries to connect to the database
		$db = new mysqli( $servername, $username, $password, "WritingCenter" );
		// If it fails, output a connection error
		if ( $db->connect_errno ) {
			die( 'Connect Error: ' . $db->connect_errno );
		}
		
		// This takes all the values from the form to be used in the query
		
		echo '<form action = "../php/view_schedule_db.php" method = "post">';
		echo 'Month <input type="text" name="month" value="mm"> <br>
		Date <input type="text" name="day" value="dd"> <br>
		Year <input type="text" name="year" value="yyyy"><br>';
		echo '</table>';
		echo '<input type="submit">';
		echo '</form>';
		
		 // Close the database
        $db->close();
    ?>

  </body>
</html>
