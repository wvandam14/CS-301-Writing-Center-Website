<?php
	
	//POST user info
	//POST all variables --probably have the values in an array
	$data = array($_POST["d0"], $_POST["d1"], $_POST["d2"], $_POST["d3"], $_POST["d4"], $_POST["d5"], $_POST["d6"]);
	$user = $_SESSION["id"];
	$time_strings = array("", "", "", "", "", "", "");
	$array_size = count($data);	
	//For 0 to 6, take each index in that numbered array and make all into large string
	for($i=0; $i<$array_size; $i++){
		$string = "";
		foreach($data[$i] as $timeslot){
			$string .= $timeslot;
		}
		//echo $string."<br>";
		$time_strings[$i] = $string;
	}
	
	//write user ID, day ID, string into database.
	// Initializes values to connect to the database
      $servername = "CS1";
      $username = "CS472_2015";
      $password = "WritingCenter";

      // Connect to database
      $db = new mysqli( $servername, $username, $password, "WritingCenter" );
      if ( $db->connect_errno ) {
        die( 'Connect Error: ' . $db->connect_errno );
      }
	  $query_check = "Select consultant_Id from consultant_availability_times where consultant_Id = ? and day_Id = ?;";
	  $query1 = "Insert into consultant_availability_times (consultant_Id, day_Id, times) values (?,?,?);";
	  $query2 = "Update consultant_availability_times set consultant_Id = ?, day_Id = ?, times = ? where consultant_Id = ? and day_Id = ?;";
	  for($j=0; $j<$array_size; $j++){
		if($stmt = $db->prepare($query_check)){
			$stmt->bind_param("ii", $user, $j);
			$result = $stmt->execute();
			$stmt->close();
		}
		else {
			echo "query check<br>";
			  die( 'Error in query preparation. error = ' . $db->errno .
			  " " . $db->error );
			}
		//if the user has not entered a schedule for this day
		if($result[0] == NULL){
			if($stmt1 = $db->prepare($query1)){
			  // Bind the cleaned parameters to the pre-prepared query1
			  $stmt1->bind_param("iis", $user, $j, $time_strings[$j]);
			  // Execute the insertion
			  $stmt1->execute();
			  $stmt1->close();
			}
			else {
			  die( 'Error in query preparation. error = ' . $db->errno .
			  " " . $db->error );
			}
		} 
		//else update existing row
		else{
			if($stmt2 = $db->prepare($query2)){
				$stmt2->bind_param("iisii", $user, $j, $time_strings[$j], $user, $j);
				$stmt2->execute();
				$stmt2->close();
			}
			else {
				echo "update<br>";
			  die( 'Error in query preparation. error = ' . $db->errno .
			  " " . $db->error );
			}
		}
	  }
	  
	  $db->close();
	  
      echo "Schedule successfully updated!<br>";
      
		
	//	var_dump($data);
	//var_dump($time_strings);
	
	
?>	
