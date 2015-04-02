<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Whitworth University Composition Commons</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
<body>
<h1>Edit a Schedule </h1>
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
		
		$GetConsultants = 'Select accountId, fname FROM accounts WHERE accountTypeId = 2;';
		
		if ( $stmt2 = $db->prepare($GetConsultants)) {

        // Execute the query
        $result = $stmt2->execute();

        // Get the result
        $result = $stmt2->get_result();
		
		if ($result->num_rows > 0) {
			echo '<form action = "../php/edit_schedule_db.php" method = "post">';
			echo 'Month <input type="text" name="month" value="mm"> <br>
			Date <input type="text" name="day" value="dd"> <br>
			Year <input type="text" name="year" value="yyyy"><br>';
			
			echo "<select name='Consultant'>";
			while ($row = $result->fetch_assoc()) {
				echo "<option value='" . $row['fname'] . "'>" . $row['fname'] . "</option>";
			}
			echo "</select>";

			echo '<input type="submit">';
			echo '</form>';
		}
		else {
			echo "0 results";
		}
		 // Close the database
        $db->close();
      }
        else {
          die( 'Error in query preparation. error = ' . $db->errno .
          " " . $db->error );
        }
		echo 'BAM'
    ?>

  </body>
</html>
