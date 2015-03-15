<?php 
	DEFINE('DB_USER','root');
	DEFINE('DB_PASSWORD','');
	DEFINE('DB_HOST','localhost');
	DEFINE('DB_NAME','writingcenter');


	$dbc =  new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

	if($dbc->connect_errno){
		 printf("Connect failed: %s\n", $dbc->connect_error);
    	exit();
	}

	if (!$dbc->set_charset("utf8")) {
	    printf("Error loading character set utf8: %s\n", $dbc->error);
	}

	function isValidUser($client){

		$dbc = $GLOBALS['dbc'];

		$client->email = $dbc->real_escape_string($client->email);
		$client->password = $dbc->real_escape_string($client->password);

		$q = "SELECT u.accountId as id,CONCAT(u.fname,' ',u.lname) as username,u.accountTypeId as permission FROM writingcenter.accounts AS u WHERE u.email_address = '$client->email' AND u.password = '". md5($client->password) ."';";
		$r = $dbc->query($q);

		if($r){

			$u = $r->fetch_assoc();
			$r->close();

			return $u;
		}
		else{
			echo '<h1>System error</h1>
			<p class="error">You could not be logged in due to a system error. We apologize for the inconvenience.</p>';
			echo '<p>' . mysqli_error($dbc) . '<br/><br/>Query: ' . $q . '</p>';
		}
	}

	function getSchedule(){
		$dbc = $GLOBALS['dbc'];

		$today = date("Y-m-d");
		$nextWeek =  date("Y-m-d",mktime(0, 0, 0, date("m"), date("d")+7,  date("Y")));
		$nextMonth =  date("Y-m-d",mktime(0, 0, 0, date("m")+1, date("d"), date("Y")));

		// echo $today."<br/>".$nextWeek."<br/>".$nextMonth."<br/>";
		// die();

		/*$q = "SELECT s.date_ AS date,CONCAT(s.consultantID,'-',GROUP_CONCAT(s.time_slot ORDER BY s.time_slot ASC SEPARATOR ',')) AS time_slots FROM schedules AS s WHERE s.status_ = 'available' GROUP BY s.date_  ORDER BY s.date_ ASC";*/

		$q = "SELECT s.date_ AS date,GROUP_CONCAT(DISTINCT CONCAT(s.scheduleid,'-',s.consultantID,'-',s.time_slot) ORDER BY s.time_slot SEPARATOR ',') AS time_slots FROM schedules AS s WHERE s.status_ = 'available' GROUP BY s.date_ ORDER BY s.date_ ASC";
		$r = $dbc->query($q);

		if($r){

			$schedules = array();
			while($schedule = $r->fetch_object()){
				$schedule->time_slots = explode(",",$schedule->time_slots);
				$schedules[] = $schedule;
			}
			
			$r->close();
			//print_r($schedules);die();

			return $schedules;
		}
		else{
			echo '<h1>System error</h1>
			<p class="error">The schedule could not be retrieved due to a system error. We apologize for the inconvenience.</p>';
			echo '<p>' . mysqli_error($dbc) . '<br/><br/>Query: ' . $q . '</p>';
		}

	}

	function getConsultants(){
		$dbc = $GLOBALS['dbc'];

		$q = "SELECT c.accountID as id,CONCAT(c.fname,' ',c.lname) as name 
			FROM writingcenter.accounts AS c 
			WHERE c.accountTypeId = '2'";
		$r = $dbc->query($q);

		if($r){

			$consultants = array();
			while($consultant = $r->fetch_object()){
				$consultants[$consultant->id] = $consultant->name;
			}
			
			$r->close();
			//print_r($consultants);die();

			return $consultants;
		}
		else{
			echo '<h1>System error</h1>
			<p class="error">The list of consultants could not be retrived due to a system error. We apologize for the inconvenience.</p>';
			echo '<p>' . mysqli_error($dbc) . '<br/><br/>Query: ' . $q . '</p>';
		}
	}

	function scheduleAppointment($app){
		$dbc = $GLOBALS['dbc'];

		$app->course_number = $dbc->real_escape_string(trim($app->course_number));
        $app->course_name = $dbc->real_escape_string(trim( $app->course_name));
        $app->instructor = $dbc->real_escape_string( $app->instructor);
        $app->assignment = $dbc->real_escape_string(trim($app->assignment));
        $app->send_post_consultation_notes = $dbc->real_escape_string(trim($app->send_post_consultation_notes));
        $app->description = $dbc->real_escape_string( $app->description);
        $app->client_id = $dbc->real_escape_string(trim($app->client_id));
        $app->consultant_id = $dbc->real_escape_string(trim($app->consultant_id));
        $app->schedule_id = $dbc->real_escape_string(trim($app->schedule_id));
        $app->date = $dbc->real_escape_string(trim($app->date));
        $app->appointment_missed = $dbc->real_escape_string(trim($app->appointment_missed));
        $app->appointment_cancelled = $dbc->real_escape_string(trim($app->appointment_cancelled));



        $q = "UPDATE schedules AS s SET s.status_ = 'occupied' WHERE s.scheduleID = '$app->schedule_id'";

        if($r = $dbc->query($q)){
        	$q = "INSERT INTO appointments (course_name,course_number,instructor,assignment,send_post_consultation_notes,appointment_missed,appointment_cancelled,description,client_id,consultant_id,schedule_id) VALUES ('$app->course_name','$app->course_number','$app->instructor','$app->assignment','$app->send_post_consultation_notes','$app->appointment_missed','$app->appointment_cancelled','$app->description','$app->client_id','$app->consultant_id','$app->schedule_id');";
        	//die($q);

    		if($r = $dbc->query($q)){
    			return true;
    		}
    		else{
    			die("Error on the insertion");
    			return false;
    		}
        }
        else{
        	die("Error on the update");
			return false;
		}
	}
	
	function getAllAppointments($id, $permission) {
		$dbc = $GLOBALS['dbc'];
		
		if ($permission == 3) {
			$q = "SELECT CONCAT(appt.description, '|', s.date_, '|', s.time_slot, '|', a.fname, '|', a.lname) as info, appt.id as id
					FROM appointments as appt
					inner join schedules as s
					on appt.schedule_id = s.scheduleID
					inner join accounts as a
					on s.consultantID = a.accountId
					WHERE appt.client_id = '$id'
					Order by s.date_";
		} else {
			$q = "SELECT CONCAT(appt.description, '|', s.date_, '|', s.time_slot, '|', a.fname, '|', a.lname) as info, appt.id as id
					FROM appointments as appt
					inner join schedules as s
					on appt.schedule_id = s.scheduleID
					inner join accounts as a
					on appt.client_id = a.accountId
					WHERE appt.consultant_id = '$id' 
					Order by s.date_";
		}
				
		$r = $dbc->query($q);

		if($r){
			$appointments = array();
			while ($appointment = $r->fetch_object()) {
				$appointments[$appointment->id] = explode( '|', $appointment->info);
			}
		
			$r->close();
			//print_r($consultants);die();

			return $appointments;
		}
		else{
			echo '<h1>System error</h1>
			<p class="error">The list of consultants could not be retrived due to a system error. We apologize for the inconvenience.</p>';
			echo '<p>' . mysqli_error($dbc) . '<br/><br/>Query: ' . $q . '</p>';
		}
	}


?>