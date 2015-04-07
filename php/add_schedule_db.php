<!DOCTYPE html>
<html>
  <body>
    <h1> Successfully Added a Schedule </h1>
    <?php		
		$timeSlots = array(
			'1000', '1030',
			'1100', '1130',
			'1200', '1230',
			'100', '130',
			'200', '230',
			'300', '330',
			'400', '430',
			'500', '530',
		);
		// Initializes values to connect to the database
		$servername = "CS1";
		$s_username = "CS472_2015";
		$password = "WritingCenter";
		$database = "writingcenter";
		
		$Month = $_POST["month"];
		$Date = $_POST["day"];
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
					foreach ($timeSlots as $time) {
						if (isset($_POST[$consultant.$time])) {
							$status = "open";
							echo $consultant.$time.' open';
						} else {
							$status = "unavailable";
						}
						
						$stmt = $db->prepare($InsertSchedule);
						
						// Escape any special characters to prevent monkey business
						$consultant = $db->real_escape_string($consultant);
						$Date_ = $db->real_escape_string($Date_);
						$time = $db->real_escape_string($time);
						$status = $db->real_escape_string($status);
						// Bind the cleaned parameters to the pre-prepared query
						$stmt->bind_param("ssss", $consultant,$Date_,$time,$status);
						
						// Execute the query
						$stmt->execute();
						}
		}
		
		// Close the database
		$db->close();
    ?>

  </body>
</html>
