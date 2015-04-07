<!DOCTYPE html>
<html>
  <body>
    <h1> Successfully Viewing a Schedule </h1>
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
			
		echo '<table>';
		echo '<tr><th>Consultant Name</th>';
		foreach ($timeSlots as $time) {
			echo '<th>'.$time.'</th>';
		}
		echo '</tr>';
		$ViewStatus = 'Select status_ From schedules Where date_ = ? And consultantID = ? And time_slot = ?';
		while ($row = $result->fetch_assoc()) {
			echo '<tr><td>'.$row["fname"].'</td>';
							
				foreach ($timeSlots as $time) {
					
					$stmt = $db->prepare($ViewStatus);
					
					// Escape any special characters to prevent monkey business
					$consultant = $db->real_escape_string($row['accountId']);
					$Date_ = $db->real_escape_string($Date_);
					$time = $db->real_escape_string($time);
					
					// Bind the cleaned parameters to the pre-prepared query
					$stmt->bind_param("sss",$Date_,$consultant,$time);
					
					// Execute the query
					$result2 = $stmt->execute();
					$result2 = $stmt->get_result();
					$row2 = $result2->fetch_assoc();
					$stat = $row2['status_'];
					echo '<td>';
					if ($stat == "unavailable"){
						echo 'X';
					}
					else if ($stat == "booked"){
						echo 'B';
					}
					//if day open
					else {
						echo 'O'; 
					}
					echo '</td>';
				}
			echo '</tr>';
		}
	
		// Close the database
		$db->close();
    ?>

  </body>
</html>
