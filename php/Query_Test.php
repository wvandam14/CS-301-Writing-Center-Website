<!DOCTYPE html>
<html>
  <body>
    <h1> You are now registered! </h1>
    <?php
		// Initializes values to connect to the database
		$servername = "cs1";
		$username = "CS472_2015";
		$password = "WritingCenter";

		// Tries to connect to the database
		$db = new mysqli($servername, $username, $password, "WritingCenter" );
		// If it fails, output a connection error
		if ( $db->connect_errno ) {
			die( 'Connect Error: ' . $db->connect_errno );
		}
		else {
			echo "sdfsdbn";
			$InsertSchedule = 'Insert into writingcenter.schedules (date_, time_slot, status_, date_created) VALUES(? ,? ,? ,?)';
			
			//$consultantID = 123;
			$date_ = "2012-4-5";
			$time_slot = "1135";
			$status = "booked";
			//$adminID = 23445;
			$date_created = date("Y-m-d");
			echo $date_created;
			
			$stmt = $db->prepare($InsertSchedule);
			
			//$consultantID = $db->real_escape_string($consultantID);
			$date_ = $db->real_escape_string($date_);
			$time_slot = $db->real_escape_string($time_slot);
			$status = $db->real_escape_string($status);
			//$adminID = $db->real_escape_string($adminID);
			$date_created = $db->real_escape_string($date_created);
			
			$stmt->bind_param("ssss", $date_, $time_slot,$status, $date_created);
			
			
			$stmt->execute();
		}
		
		// Close the database
		$db->close();
    ?>

  </body>
</html>
