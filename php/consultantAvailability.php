<?php
	
	//POST user info
	//POST all variables --probably have the values in an array
	$data = array($_POST["d0"], $_POST["d1"], $_POST["d2"], $_POST["d3"], $_POST["d4"], $_POST["d5"], $_POST["d6"]);
	$user = $_SESSION["user_id"];
	$time_strings = array("", "", "", "", "", "", "");
	$array_size = count($data);	
	//For 0 to 6, take each index in that numbered array and make all into large string
	for($i=0; $i<$array_size; $i++){
		$string = "";
		foreach($data[$i] as $timeslot){
			$string .= $timeslot;
		}
		echo $string."<br>";
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
      
      
		
	//	var_dump($data);
	//var_dump($time_strings);
	
	
?>	
