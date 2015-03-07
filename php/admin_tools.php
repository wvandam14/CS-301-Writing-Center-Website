<!DOCTYPE html>
<html>
  <body>
    <h1> Admin, Add a Schedule </h1>
    <?php		
		// Initializes values to connect to the database
		$servername = "127.0.0.1";
		$username = "CS472_2015";
		$password = "WritingCenter";
		// Tries to connect to the database
		$db = new mysqli( $servername, $username, $password, "WritingCenter" );
		// If it fails, output a connection error
		if ( $db->connect_errno ) {
		die( 'Connect Error: ' . $db->connect_errno );
		}
		
		// This takes all the values from the form to be used in the query
		$Date = $_POST["date"];
		
		$InsertSchedule = 'Insert into Schedules (time_slot) VALUES (?);';
		
		if ( $stmt = $db->prepare($InsertSchedule)) {
        // Escape any special characters to prevent monkey business
        $Date = $db->real_escape_string($Date);

        // Bind the cleaned parameters to the pre-prepared query
        $stmt->bind_param("sssssssss", $Date);
        
        // Execute the query
        $stmt->execute();
		
		// Query to get the admin i.d that added the schedule
        $GetAdminID = 'Select S.adminID FROM Schedules S WHERE date_ =?;';
		
		 // Prepare this statement
        $stmt2 = $db->prepare($GetAdminID);

        // Bind the parameters
        $stmt2->bind_param("s", $Date);

        // Execute the query
        $result = $stmt2->execute();

        // Get the result
        $result = $stmt2->get_result();
		

		 // Close the database
        $db->close();
      }
        else {
          die( 'Error in query preparation. error = ' . $db->errno .
          " " . $db->error );
        }
    ?>

  </body>
</html>
