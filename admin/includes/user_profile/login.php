<?php include "../admin_functions.php"; 

conn(); ?>

<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
</head>
<body>

<form action="login.inc.php" method="POST">
	
	<input type="text" name="user_uid" placeholder="Username/Email">
	<input type="password" name="pwd" placeholder="Password">
	<button type="submit">Login</button>

</form>

</body>
</html>