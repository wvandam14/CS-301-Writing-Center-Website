<!DOCTYPE html>
<html>
  <body>
    <p> Thank you for your feedback. </p>
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
      $servername = "127.0.0.1";
      $username = "Admin";
      $password = "123";

      // Tries to connect to the database
      $db = new mysqli( $servername, $username, $password, "WritingCenter" );
      // If it fails, output a connection error
      if ( $db->connect_errno ) {
        die( 'Connect Error: ' . $db->connect_errno );
      }

      // Query to get the Consultant ID based on the name given in the form
      $InsertClient = 'Insert into Clients (fname,lname,email_address,class_standing,Graduation_year,major,secondary_major,minor,password) VALUES (?,?,?,?,?,?,?,?,?);';

      if ( $stmt = $db->prepare($InsertClient)) {
        // Escape any special characters to prevent monkey business
        $Email = $db->real_escape_string($Email);
        $Fname = $db->real_escape_string($Fname);
        $Lname = $db->real_escape_string($Lname);
        $Client_Password = $db->real_escape_string($Client_Password);
        $Standing = $db->real_escape_string($Standing);
        $Graduation_Year = $db->real_escape_string($Graduation_Year);
        $Language = $db->real_escape_string($Language);
        $Major = $db->real_escape_string($Major);
        $Secondary_Major = $db->real_escape_string($Secondary_Major);
        $Minor = $db->real_escape_string($Minor);
        $Appointment = $db->real_escape_string($Appointment);
        $Modify = $db->real_escape_string($Modify);
        $Delete = $db->real_escape_string($Delete);
        $Announcement = $db->real_escape_string($Announcement);
        $Remind = $db->real_escape_string($Remind);


        // Bind the cleaned parameters to the pre-prepared query
        $stmt->bind_param("sssssssss", $Fname, $Lname, $Email, $Standing, $Graduation_Year, $Major, $Secondary_Major, $Minor, $Client_Password);
        
        // Execute the query
        $stmt->execute();

        // Query to get the client i.d of the person just added to the database
        $GetClientID = 'Select C.Client_ID FROM Clients C WHERE email_address =?;';

        // Prepare this statement
        $stmt2 = $db->prepare($GetClientID);

        // Bind the parameters
        $stmt2->bind_param("s", $Email);

        // Execute the query
        $result = $stmt2->execute();

        // Get the result
        $result = $stmt2->get_result();

        $outp2 = "";
        while ( $row = $result->fetch_array(MYSQLI_ASSOC) ) {
          $outp2 .= $row['Client_ID'];           
        }
        $outp2 .="";

        // Store the result here to be used in the next query
        $Client_ID = $outp2;

        // This is the final query
        $InsertEmailOptions = 'Insert into email_options (Client_ID, Make_appt, Modify_appt, Delete_appt, Announcement, Reminderof_appt) VALUES (?,?,?,?,?,?);';

        // Prepare this query
        $stmt3 = $db->prepare($InsertEmailOptions);

        // Change all the Yes/No answers into 1's or 0's
        if ($Appointment == "Yes")
          $Appointment = 1;
        else
          $Appointment = 0;
        if ($Modify == "Yes")
          $Modify = 1;
        else
          $Modify = 0;
        if ($Delete == "Yes")
          $Delete = 1;
        else
          $Delete = 0;
        if ($Announcement == "Yes")
          $Announcement = 1;
        else
          $Announcement = 0;
        if ($Remind == "Yes")
          $Remind = 1;
        else
          $Remind = 0;

        // Bind the parameters
        $stmt3->bind_param("siiiii", $Client_ID, $Appointment, $Modify, $Delete, $Announcement, $Remind);
        // Escape any special characters to prevent monkey business

        $stmt3->execute();

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
