<?php include "../admin_functions.php"; 

conn(); ?>

<?php 

if (isset($_POST["submit"])) {
	

	$name = $_POST['name'];
	$email = $_POST['email'];
	$user_name = $_POST['uid'];
	$pwd = $_POST['pwd'];
	$pwd_repeat = $_POST['pwd_repeat'];

	require_once 'functions.inc.php';

	if (empty_input_signup($name, $email, $user_name, $pwd, $pwd_repeat) !== false ) {
		
		header("location: signup.php?error=emptyinput");

		exit();

	}

	if (input_uid($user_name) !== false ) {
		
	header("location: signup.php?error=invaliduid");

	exit();

	}

	if (input_email($email) !== false ) {
		
	header("location: signup.php?error=invaliduid");

	exit();

	}

	// if (input_pwd($pwd) !== false ) {
		
	// header("location: signup.php?error=invalidupwd");

	// exit();

	// }

		if (input_pwd_repeat($pwd, $pwd_repeat) !== false ) {
		
	header("location: signup.php?error=invaliduid");

	exit();

	}

	if (input_uidexist($conn, $user_name, $email) !== false ) {
		
	exit();

	}

	create_user($conn, $name, $email, $user_name, $pwd);

	} else {

	header("location: signup.php");
	exit();
}

