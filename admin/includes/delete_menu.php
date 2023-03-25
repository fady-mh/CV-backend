

<?php $servername = "localhost";
	$username = "root";
	$password = "";
	$db = "cv-cms";

	$conn = mysqli_connect($servername, $username, $password, $db);

	if (!$conn) {
		die("Failed to connect to database" . mysqli_error($conn) );
	} else {

		echo "Database connected successfully";

	} ?>

<?php 

if (isset($_GET['del'])) {

	$menu_id = $_GET['del'];
	
	$delete_query = "DELETE FROM MENU WHERE menu_id= $menu_id";
	$delete_query_result = mysqli_query($conn, $delete_query);

	if ($delete_query_result) {
		header("location: ../index.php");
	} else {

		echo "oooo";

	}
}

 ?>