<?php

function empty_input_signup($name, $email, $user_name, $pwd, $pwd_repeat) {

	$result; 

	if (empty($name) || empty($email) || empty($user_name) || empty($pwd) || empty($pwd_repeat)) {
		$result = true;

	} else {

		$result = false;

	} 

	return $result;

}


function input_uid($user_name) {

	$result; 

	if (!preg_match("/^[a-zA-Z0-9]*$/", $user_name)) {
		$result = true;

	} else {

		$result = false;

	} 

	return $result;

}


function input_email($email) {

	$result; 

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$result = true;

	} else {

		$result = false;

	} 

	return $result;

}


function input_pwd_repeat($pwd, $pwd_repeat)  {

	$result; 

	if ($pwd !== $pwd_repeat) {
		$result = true;

	} else {

		$result = false;

	} 

	return $result;

}

function input_uidexist($conn, $user_name, $email)  {

	$sql = "SELECT * FROM users WHERE user_uid = ? OR user_email =?; ";
	$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt, $sql)) {
		echo "QUERY Failed";

	} else {

		mysqli_stmt_bind_param($stmt, "ss", $user_name, $email);

		mysqli_stmt_execute($stmt);

		$result_data = mysqli_stmt_get_result($stmt);

		if ($row = mysqli_fetch_assoc($result_data)) {
			
			return $row;

		} else {

			$result = false;
			return $result;

		}

		mysqli_stmt_close($stmt);

	}


}


function create_user($conn, $name, $email, $user_name, $pwd)  {

	$sql = "INSERT INTO users(name, user_email, user_uid, pwd) VALUES(?,?,?,?) ";
	$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: signup.php");
		echo "QUERY Failed";

	} else {

		$hashed_pwd = password_hash($pwd, PASSWORD_DEFAULT);

		mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $user_name, $hashed_pwd);

		mysqli_stmt_execute($stmt);

		mysqli_stmt_close($stmt);


	}




}


/****************************************************************************************************************/


function empty_input_login($user_name, $pwd) {

	$result; 

	if (empty($user_name) || empty($pwd)) {
		$result = true;

	} else {

		$result = false;

	} 

	return $result;

}

function login_user($conn, $user_name, $pwd) {

	$uid_exists = input_uidexist($conn, $user_name, $user_name);

	if ($uid_exists === false) {
		header("location: login.php?error=wronglogin");
		exit();
	}

	$pwd_hashed = $uid_exists['pwd'];
	$check_pwd = password_verify($pwd, $pwd_hashed);

	if ($check_pwd === false) {
		header("location: login.php");
		echo "Didnt work";
	} else if ($check_pwd === true) {

		session_start();
		$_SESSION["user_id"] = $uid_exists["user_id"]; 
		$_SESSION["user_uid"] = $uid_exists["user_uid"]; 
		header("location: ../../index.php");
		exit();

	}

}