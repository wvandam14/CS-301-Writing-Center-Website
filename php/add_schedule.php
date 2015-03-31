<!DOCTYPE html>
<html>
  <body>
    <h1> Successfully Added a Schedule </h1>
    <?php		
		$timeSlots = array(
			'10:00AM', '10:30AM',
			'11:00AM', '11:30AM',
			'12:00AM', '12:30AM',
			'1:00PM', '1:30PM',
			'2:00PM', '2:30PM',
			'3:00PM', '3:30PM',
			'4:00PM', '4:30PM',
			'5:00PM', '5:30PM',
		);
		// Initializes values to connect to the database
		$servername = "CS1";
		$s_username = "CS472_2015";
		$password = "WritingCenter";
		$database = "writingcenter";
		
		$Month = $_POST["month"];
		$Date = $_POST["date"];
		$Year = $_POST["year"];
		
		$Date_ = $Year."-".$Month."-".$Date;
		
		// Tries to connect to the database
		$db = new mysqli($servername, $s_username, $password, $database );
		// If it fails, output a connection error
		if ( $db->connect_errno ) {
			die( 'Connect Error: ' . $db->connect_errno );
		}
		$GetConsultants = 'Select accountId, fname FROM accounts WHERE accountTypeId = 2;';
		
		$stmt2 = $db->prepare($GetConsultants);

        // Execute the query
        $result = $stmt2->execute();

        // Get the result
        $result = $stmt2->get_result();
		$ConsultantArray = array();
		
		while ($row = $result->fetch_assoc()) {
			array_push($ConsultantArray, $row["accountId"]);
		}
		$InsertSchedule = 'INSERT INTO Schedules (consultantID,date_,time_slot,status_) VALUES (?,?,?,?);';
		
		foreach ($ConsultantArray as $consultant) {
					echo '<td><input type="checkbox" name="'.$row["accountId"].$time.'" value=""></td>';
					
					foreach ($timeSlots as $time) {
						$Status = $_POST[$consultant.$time];
						
						$stmt = $db->prepare($InsertSchedule);
						
						// Escape any special characters to prevent monkey business
						$consultant = $db->real_escape_string($consultant);
						$Date_ = $db->real_escape_string($Date_);
						$time = $db->real_escape_string($time);
						$Status = $db->real_escape_string($Status);
						// Bind the cleaned parameters to the pre-prepared query
						$stmt->bind_param("ssss", $consultant,$Date_,$time,$Status);
						
						// Execute the query
						$stmt->execute();
						}
		}
		
		// Close the database
		$db->close();
    ?>

  </body>
</html>
