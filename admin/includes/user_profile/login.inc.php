<?php include "../admin_functions.php"; 

conn(); ?>

<?php 


if (isset($_POST['submit'])) {
	
	$user_name = $_POST['user_uid'];
	$pwd = $_POST['pwd'];

	if (empty_input_login($user_name, $pwd) !== false ) {
		
		header("location: login.php?error=emptyinput");

		exit();

	}

	login_user($conn, $user_name, $pwd);



} else {

	header("location: login.php");
	exit();

}