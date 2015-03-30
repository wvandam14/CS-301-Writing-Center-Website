<!DOCTYPE html>
<html>
  <body>
    <h1> Thank you for your feedback! </h1>
    <?php
      // This takes all the values from the form to be used in the query
      $Consultant_Name = $_POST["Consultant"];
      $Date = $_POST["Date"];
      $Explained = $_POST["score1"];
      $Addressed = $_POST["score2"];
      $Comfortable = $_POST["score3"];
      $Learn = $_POST["Learn"];
      $Feedback = $_POST["Feedback"];

      
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
      $query =  'Select accounts.accountId FROM accounts WHERE accounts.fname =? AND accounts.lname =? AND accountTypeId = 2;';
      if ( $stmt = $db->prepare($query)) {
        // Escape any special characters to prevent monkey business
        $Consultant_Name = $db->real_escape_string($Consultant_Name);

        // Break up the string into a first name and a last name
        $fname_lname = explode(" ", $Consultant_Name);

        // Bind the cleaned parameters to the pre-prepared query
        $stmt->bind_param("ss", $fname_lname[0],$fname_lname[1]);
        
        // Execute the query
        $result = $stmt->execute();

        // Retrieve the query results
        $result = $stmt->get_result();

        // This gets the ID from the result (THERE HAS TO BE A BETTER WAY TO DO THIS BUT THIS WORKS FOR NOW)
        $outp = "";
        while ( $row = $result->fetch_array(MYSQLI_ASSOC) ) {
          $outp .= $row['Consultant_ID'];           
        }
        $outp .="";

        // Get the result we needed from the first query for the second query
        $Consultant_ID = $outp;

        // Escape any special characters to prevent monkey business
        $Date = $db->real_escape_string($Date);
        $Explained = $db->real_escape_string($Explained);
        $Addressed = $db->real_escape_string($Addressed);
        $Comfortable = $db->real_escape_string($Comfortable);
        $Learn = $db->real_escape_string($Learn);
        $Feedback = $db->real_escape_string($Feedback);

        // This inserts all the data into the Consultant_Evaluation_Form based on the data that was input by the user
        $query1 = "Insert into Consultant_Evaluation_Form (Consultant_ID, Date_, Explained_Ideas, Addressed_Concerns, Comfortable, Learned, Additional_Feedback) VALUES (?,?,?,?,?,?,?);";
        
        // Something about monkey business
        $stmt = $db->prepare($query1);

        // Bind the cleaned parameters to the pre-prepared query1
        $stmt->bind_param("sssssss", $Consultant_ID, $Date, $Explained, $Addressed, $Comfortable, $Learn, $Feedback);
        
        // Execute the insertion
        $stmt->execute();

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
