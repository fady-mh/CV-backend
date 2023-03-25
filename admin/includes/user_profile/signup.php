<?php include "../admin_functions.php"; 

conn(); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sing Up</title>
</head>
<body>

<form action="singup.inc.php" method="POST">
	
	<input type="text" name="name" placeholder="Full Name"><br>
	<input type="text" name="email" placeholder="Email"><br>
	<input type="text" name="uid" placeholder="User Name"><br>
	<input type="password" name="pwd" placeholder="User ID"><br>
	<input type="password" name="pwd_repeat" placeholder="Repeat Password"><br>
	<button type="submit" name="submit">Sign Up</button>

</form>



</body>
</html>