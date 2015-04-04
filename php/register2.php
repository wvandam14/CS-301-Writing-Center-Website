<!DOCTYPE html>
<html>
	<body>
		<h1> You are now registered! </h1>
    <?php
      // This takes all the values from the form to be used in the query
      $Email = $_POST["email"];
      $Fname = $_POST["firstName"];
      $Lname = $_POST["lastName"];
      $Client_Password = $_POST["password"];
      $Standing = $_POST["standing"];
      $Graduation_Year = $_POST["Graduation_Year"];
      $Language = $_POST["Language"];
      $Major = $_POST["Major"];
      $Secondary_Major = $_POST["Secondary_Major"];
      $Minor = $_POST["Minor"];
      $Appointment = $_POST["appointment"];
      $Modify = $_POST["modify"];
      $Delete = $_POST["delete"];
      $Announcement = $_POST["announcement"];
      $Remind = $_POST["remind"];

      // Initializes values to connect to the database
      $servername = "CS1";
      $username = "CS472_2015";
      $password = "WritingCenter";

      // Tries to connect to the database
      $db = new mysqli( $servername, $username, $password, "WritingCenter" );
      // If it fails, output a connection error
      if ( $db->connect_errno ) {
        die( 'Connect Error: ' . $db->connect_errno );
      }

      // Query to get the Consultant ID based on the name given in the form
      //$InsertClient = 'Insert into Clients (fname,lname,email_address,class_standing,Graduation_year,major,secondary_major,minor,password) VALUES (?,?,?,?,?,?,?,?,?);';
      $InsertClientDetails = 'Insert into accountdetails (accountDetailId, class_standing, graduation_year, major, secondary_major, minor, bio, missed_appointments) values(null,?,?,?,?,?,null,null);';
      
      if($stmt = $db->prepare($InsertClientDetails)){
      	//accountDetailId = null;
      	$Standing = $db->real_escape_string($Standing);
      	$Graduation_Year = $db->real_escape_string($Graduation_Year);
      	$Major = $db->real_escape_string($Major);
      	$Secondary_Major = $db->real_escape_string($Secondary_Major);
      	$Minor = $db->real_escape_string($Minor);
      	//bio = null;
      	//miss_appointments = null;

      	// Bind the cleaned parameters to the pre-prepared query
      	$stmt->bind_param("sssssssss", $Standing, $Graduation_Year, $Major, $Secondary_Major, $Minor);

      	// Execute the query
      	$stmt->execute();

      	$GetClientDetailId = 'Select MAX(accountDetailId) FROM accountdetails;';

      	// Prepare this statement
      	$stmt2 = $db->prepare($GetClientDetailId);

      	// Execute the query
      	$result = $stmt2->execute();

      	// Get the result
      	$result = $stmt2->get_result();

      	$outp = "";
      	while($row = $result->fetch_array(MYSQL_ASSOC)) {
      		$outp .= $row['accountDetailId'];
      	}
      	$outp .="";

      	//accountId = null;
      	$Fname = $db->real_escape_string($Fname);
      	$Lname = $db->real_escape_string($Lname);
      	$Email = $db->real_escape_string($Email);
      	$Client_Password = $db->real_escape_string($Client_Password);
      	$AccountDetailId = $$outp;


      	$InsertClient = 'Insert into accounts (accountId, fname, lname, email_address, password, accountTypeId, accountDetails) values (null,?,?,?,?,3,?);';

      	$stmt3 = $db->prepare($InsertClient);

      	$stmt3->bind_param("ssss", $Fname, $Lname, $Email, $Client_Password, $AccountDetailId);

      	$stmt3->excute();

      	/*
			Next is a block of code to execute an insert for email options
      	*/

		$db->close();
      }
        else {
          die( 'Error in query preparation. error = ' . $db->errno .
          " " . $db->error );
        }

    ?>
	</body>
</html>