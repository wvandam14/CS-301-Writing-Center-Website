<?php 
	session_start();
	$page_title = 'Log in';

?>
<!DOCTYPE html>
<html>
  <body>
    <h1>  </h1>
		<?php 

			$error='';
			$col1=NULL;
						
			function validate($value) {
				if (empty($value)) {
					return false;
				}
				else {
					return true;
				}
			}
				$email=$_POST['email'];
				$accPassword=$_POST['password'];

			if (!validate($accPassword) || !validate($email)) {
				echo "<h1>Please do not leave text boxes blank!</h1>";

			}
			else 
			{

				// Initializes values to connect to the database
     			$servername = "CS1";
     			$username = "CS472_2015";
      			$password = "WritingCenter";

				// connect to database
				$db = new mysqli( $servername, $username, $password, "WritingCenter" );

      			// If it fails, output a connection error
     			if ( $db->connect_errno ) {
      				die( 'Connect Error: ' . $db->connect_errno );
     			}

     			$pass = $accPassword;
     			$em = $email;

     			$stmt = $db->prepare("SELECT * FROM accounts WHERE password = ? AND email_address = ?");
     			$stmt->bind_param("ss", $pass, $em);

     			$stmt->execute();

     			$stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7);
     			$stmt->fetch();

     			$stmt->close();


     			$db->close();


     			if ($col1 != NULL){
     				$_SESSION['id'] = $col1;
					$_SESSION['email'] = $col3;
					$_SESSION['type'] = $col6;

					header("Location: http://cs1.whitworth.edu/WritingCenter/FeatureSet1/CS-301-Writing-Center-Website/html/");

					exit();
     			}
     			else{
     				echo "<h1>Invalid email/password.</h1>";
     			}
     		}
			
		?>
  </body>
</html>