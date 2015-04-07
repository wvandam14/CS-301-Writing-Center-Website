<!DOCTYPE html>
<html>
  <body>
    <h1> Thank you for your feedback! </h1>
    <?php


      // This takes all the values from the form to be used in the query
      $Email_Instructor = $_POST["emailtoins"];
      $Client_Name = $_POST["Client"];
      $Date = $_POST["date"];
      $Client_Type = $_POST["clientType"];
      $Language = $_POST["Language"];
      $Instructor = $_POST["Instructor"];
      $Class = $_POST["Class"];
      $Consultant = $_POST["Consultant"];
      $projectType = $_POST["projectType"];
      $Comments = $_POST["comments"];
      $Section = $_POST["Section"];

      // This takes all the values from the checkboxes

      $Assignment_ = ($_POST["Assignment"] && $_POST["Assignment"] == 'Yes') ? 1 : 0;
      $Ideas = ($_POST["Ideas"] && $_POST["Ideas"] == 'Yes') ? 'Yes' : 'No';
      $Thesis = ($_POST["Thesis"] && $_POST["Thesis"] == 'Yes') ? 'Yes' : 'No';
      $Subject = ($_POST["Subject"] && $_POST["Subject"] == 'Yes') ? 'Yes' : 'No';
      $Audience = ($_POST["Audience"] && $_POST["Audience"] == 'Yes') ? 'Yes' : 'No';
      $Organization = ($_POST["Organization"] && $_POST["Organization"] == 'Yes') ? 'Yes' : 'No';
      $Content = ($_POST["Content"] && $_POST["Content"] == 'Yes') ? 'Yes' : 'No';
      $Intro = ($_POST["Intro"] && $_POST["Intro"] == 'Yes') ? 'Yes' : 'No';
      $Sources = ($_POST["Sources"] && $_POST["Sources"] == 'Yes') ? 'Yes' : 'No';
      $Citations = ($_POST["Citations"] && $_POST["Citations"] == 'Yes') ? 'Yes' : 'No';
      $Design = ($_POST["Design"] && $_POST["Design"] == 'Yes') ? 'Yes' : 'No';
      $Sentence = ($_POST["Sentence"] && $_POST["Sentence"] == 'Yes') ? 'Yes' : 'No';
      $Grammar = ($_POST["Grammar"] && $_POST["Grammar"] == 'Yes') ? 'Yes' : 'No';

      // $appointment_id = $_SERVER['QUERY_STRING'];

      // Initializes values to connect to the database
      $servername = "CS1";
      $username = "CS472_2015";
      $password = "WritingCenter";

      // DEFINE('DB_USER','root');
      // DEFINE('DB_PASSWORD','');
      // DEFINE('DB_HOST','localhost');
      // DEFINE('DB_NAME','writingcenter');
      // $dbc =  new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
      // Tries to connect to the database
      $db = new mysqli( $servername, $username, $password, "WritingCenter" );
      // If it fails, output a connection error
      if ( $db->connect_errno ) {
        die( 'Connect Error: ' . $db->connect_errno );
      }

      // Query to get the Consultant ID based on the name given in the form
      $GetConsultantID = 'Select accounts.accountId FROM accounts WHERE accounts.fname =? AND accounts.lname =? AND accountTypeId = 2;';
      $GetClientID = 'Select accounts.accountId FROM accounts WHERE accounts.fname =? AND accounts.lname =? AND accountTypeId = 3;';
      if ( $stmt = $db->prepare($GetConsultantID)) {
        // Escape any special characters to prevent monkey business
        $Consultant = $db->real_escape_string($Consultant);

        // Break up the string into a first name and a last name
        $fname_lname = explode(" ", $Consultant);

        // Bind the cleaned parameters to the pre-prepared query
        $stmt->bind_param("ss", $fname_lname[0],$fname_lname[1]);
        
        // Execute the query
        $stmt->execute();

        // Retrieve the query results
        $result = $stmt->get_result();

        // This gets the ID from the result (THERE HAS TO BE A BETTER WAY TO DO THIS BUT THIS WORKS FOR NOW)
        $outp = "";
        while ( $row = $result->fetch_array(MYSQLI_ASSOC) ) {
          $outp .= $row['accountId'];           
        }
        $outp .="";

        // Escape any special characters to prevent monkey business
        $stmt2 = $db->prepare($GetClientID);
        $Client_Name = $db->real_escape_string($Client_Name);

        // Break up the string into a first name and a last name
        $Client_fname_lname = explode(" ", $Client_Name);

        // Bind the cleaned parameters to the pre-prepared query
        $stmt2->bind_param("ss", $Client_fname_lname[0], $Client_fname_lname[1]);

        // Execute the query
        $result2 = $stmt2->execute();

        // Retrieve the query results
        $result2 = $stmt2->get_result();

        // This gets the ID from the result (THERE HAS TO BE A BETTER WAY TO DO THIS BUT THIS WORKS FOR NOW)
        $outp2 = "";
        while ( $row = $result2->fetch_array(MYSQLI_ASSOC) ) {
          $outp2 .= $row['accountId'];           
        }
        $outp2 .="";

        // The results of both queries are stored in more useful names
        $Consultant_ID = $outp;
        $Client_ID = $outp2;

        // Escape any special characters to prevent monkey business
        $Email_Instructor = $db->real_escape_string($Email_Instructor);
        $Date = $db->real_escape_string($Date);
        $Client_Type = $db->real_escape_string($Client_Type);
        $Language = $db->real_escape_string($Language);
        $Instructor = $db->real_escape_string($Instructor);
        $Class = $db->real_escape_string($Class);
        $projectType =$db->real_escape_string($projectType);
        $Comments =$db->real_escape_string($Comments);
        $Section = $db->real_escape_string($Section);

        // Figure out the boolean entry of the table
        if ($Email_Instructor == "true" )
          $Email_Instructor = 1;
        else{
          $Email_Instructor = 0;
        }

        // This inserts all the data into the post_consultation_notes based on the data that was input by the user
        $query1 = "Insert into post_consultation_notes (Client_ID, Consultant_ID, Native_Language, Copy_Sent, Class_, Assignment, Professor, Date_, Understand_Assignment, Generate_Ideas, Thesis, Focusing_Subject, Audience, Organization, Content_Development, Introduction_Conclusion, Sources_Research, Citations, Document_Design, Sentence_Structure, Grammar_Mechanics, Notes) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
        
        // Something about monkey business
        if($stmt3 = $db->prepare($query1)){

          // Bind the cleaned parameters to the pre-prepared query1
          $stmt3->bind_param("sssissssssssssssssssss", $Client_ID, $Consultant_ID, $Language, $Email_Instructor, $Class, $projectType, $Instructor, $Date, $Assignment_, $Ideas, $Thesis, $Subject, $Audience, $Organization, $Content, $Intro, $Sources, $Citations, $Design, $Sentence, $Grammar, $Comments);
          // Execute the insertion
          $stmt3->execute();
        }
        else {
          die( 'Error in query preparation. error = ' . $db->errno .
          " " . $db->error );
        }

        //relation of appointment to post consultation notes

        // $query2 = "UPDATE into appointments (post_consultation_notes_id) VALUES (?);";
        // // Something about monkey business
        // if($stmt4= $db->prepare($query2)){

        //   // Bind the cleaned parameters to the pre-prepared query1
        //   $stmt4->bind_param("i", $appointment_id);
        //   // Execute the insertion
        //   $stmt4->execute();        
        // }
        // else {
        //   die( 'Error in query preparation. error = ' . $db->errno .
        //   " " . $db->error );
        // }


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
