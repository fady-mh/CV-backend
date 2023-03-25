<?php 


function conn(){

	global $conn;

	$servername = "localhost";
	$username = "root";
	$password = "";
	$db = "cv-cms";

	$conn = mysqli_connect($servername, $username, $password, $db);

	if (!$conn) {
		die("Failed to connect to database" . mysqli_error($conn) );
	} else {

		echo "Database connected successfully";

	}
 


}

 ?>