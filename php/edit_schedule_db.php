<!DOCTYPE html>
<html>
  <body>
    <h1> Successfully Cleared A Consultant's Day </h1>
    <?php		
		// Initializes values to connect to the database
		$servername = "CS1";
		$s_username = "CS472_2015";
		$password = "WritingCenter";
		$database = "writingcenter";
		
		$Month = $_POST["month"];
		$Date = $_POST["day"];
		$Year = $_POST["year"];
		
		$Date_ = $Year."-".$Month."-".$Date;
		
		$Consultant = $_POST["Consultant"];
		
		// Tries to connect to the database
		$db = new mysqli($servername, $s_username, $password, $database );
		// If it fails, output a connection error
		if ( $db->connect_errno ) {
			die( 'Connect Error: ' . $db->connect_errno );
		}
		
		$GetConsultantID = 'Select accountId FROM accounts WHERE fname = ?;';
		
		$stmt1 = $db->prepare($GetConsultantID);
		$Consultant = $db->real_escape_string($Consultant);
		$stmt1->bind_param("s", $Consultant);
	        // Execute the query
	        $result = $stmt1->execute();
	        // Get the result
	        $result = $stmt1->get_result();
		$row = $result->fetch_assoc();
		$ConsID = $row['accountId'];
		//echo $row['accountId'];
		//echo $ConsID;
		
		$UpdateSchedule = 'Update schedules Set status_ = "unavailable" Where consultantID = ? AND date_ = ?';
		$stmt2 = $db->prepare($UpdateSchedule);
			
		
		// Escape any special characters to prevent monkey business
		$ConsID = $db->real_escape_string($ConsID);
		$Date_ = $db->real_escape_string($Date_);
		// Bind the cleaned parameters to the pre-prepared query
		$stmt2->bind_param("ss", $ConsID,$Date_);
		// Execute the query
		$stmt2->execute();
		
		
		
		// Close the database
		$db->close();
    ?>

  </body>
</html>
