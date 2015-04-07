<?php

  $servername = "cs1";
  $username = "CS472_2015";
  $password = "WritingCenter";

  // Tries to connect to the database
  $db = new mysqli( $servername, $username, $password, "WritingCenter" );
  // If it fails, output a connection error
  if ( $db->connect_errno ) {
    die( 'Connect Error: ' . $db->connect_errno );
  }

?>