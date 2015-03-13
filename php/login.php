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


			if (!validate($password) || !validate($email)) {
				echo "<h1>Invalid entry</h1>";

			}
			else 
			{

				$email=$_POST['email'];
				$accPassword=$_POST['password'];

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

     			$stmt = $db->prepare("SELECT 1 from Accounts where password = ? AND email_address = ? VALUES (?, ?)");
     			$stmt->bind_param("ss", $pass, $em);

     			$pass = $accPassword;
     			$em = $email;
     			$stmt->execute();

     			$stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7);
     			$stmt->fetch();

     			$stmt->close();


     			$db->close();

     			if ($col1 != NULL){
     				$_SESSION['id'] = $col1;
					$_SESSION['email'] = $col5;
					$_SESSION['type'] = $col6;
     			}
     			else{
     				echo "<h1>Invalid email/password.</h1>";
     			}
     		}
			
		?>
  </body>
</html>