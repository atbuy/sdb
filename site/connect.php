<?php 
  // Edit before local usage
  $host = "172.17.0.1";
  $user = "root";
  $pass = "password";
  $name = "specdb";
	
	$conn = mysqli_connect($host, $user, $pass, $name) or die("Connection failed");
?>
