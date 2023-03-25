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
	
	$menu_title_row = "";

	if ($_SERVER['REQUEST_METHOD'] == "GET") {
		
		if (isset($_GET['edit_menu_id'])) {
		
			$menu_edit_display = $_GET['edit_menu_id'];

			$menu_edit_display_query = "SELECT menu_id, menu_title FROM menu WHERE menu_id = '{$menu_edit_display}'";
			$menu_edit_display = mysqli_query($conn, $menu_edit_display_query);

			while ($row = mysqli_fetch_assoc($menu_edit_display)) {

						$menu_title_row = $row['menu_title'];


			}

		}

	}


?>

<?php 

	$new_menu_title  = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
		

		$get_edit_id = $_GET['edit_menu_id'];
		$menu_edit_title = $_POST['edit_menu_title'];

		$menu_edit_stmt_query = "UPDATE menu SET menu_title = '{$menu_edit_title}' WHERE menu_id = '{$get_edit_id}' ";
		$edit_menu_stmt = mysqli_stmt_init($conn);

		if (!mysqli_stmt_prepare($edit_menu_stmt, $menu_edit_stmt_query)) {
		 	
			echo "Query failed";

		 } else {

		 	mysqli_stmt_execute($edit_menu_stmt);

 			mysqli_stmt_get_result($edit_menu_stmt);

		 }

	}



?>

<div class="col-md-6">

<form action="" method="POST">
	
	<div class="form-group">

		<label>Edit Menu</label><br>
		
		<input type="text" name="edit_menu_title" placeholder="Edit menu item" value="<?= $menu_title_row;?>">

	</div>

	
	<div class="form-group">
		<label>Edit Menu Item</label> <br>
		<input type="submit" name="submit_edit" value="Edit Menu">

	</div>

</form>
