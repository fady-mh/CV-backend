<?php error_reporting (E_ALL ^ E_NOTICE); ?>


<?php 
 
include 'admin_functions.php';

conn(); ?> 


<style type="text/css">

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}

</style>

<div class="clearfix"></div>

	<?php 


	if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$insert_menu_title = $_POST['insert_menu_title'];

			$insert_menu_title = filter_var($insert_menu_title, FILTER_SANITIZE_STRING);

			$menu_query = "INSERT INTO menu (menu_title) VALUES ('{$insert_menu_title}') ";

			$menu_stmt = mysqli_stmt_init($conn);

			if (!mysqli_stmt_prepare($menu_stmt, $menu_query)) {
				echo "Connection and Query failed please check menu connection query";
			} else {

				mysqli_stmt_execute($menu_stmt);
				mysqli_stmt_get_result($menu_stmt);

			}

			/*$menu_post_connection = mysqli_query($conn, $menu_query);*/

		}


	?>


<div class="col-md-6">

<form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF']);?>" method="POST">
	
	<div class="form-group">

		<label>Home</label><br>
		
		<input type="text" name="insert_menu_title" placeholder="Add menu item">

	</div>

	
	<div class="form-group">
		<label>Add to Menu</label> <br>
		<input type="submit" name="submit" value="Add to Menu">

	</div>

</form>

		 <?php 

                if (isset($_GET['get_id'])) {
                    
                    $edit_menu_id = $_GET['get_id'];

                    include "edit_menu.php";

                }

               
                 ?>

<?php 
	

	
	if (isset($_GET['edit_menu_item'])) {
		$edit_menu_id = $_GET['edit_menu_item'];
		$edit_menu_query = "SELECT * FROM menu WHERE menu_id='$edit_menu_id' ";
		$edit_menu_conn = mysqli_query($conn, $edit_menu_query);

		$edit_menu_rows = mysqli_fetch_assoc($edit_menu_conn);

		if (mysqli_num_rows($edit_menu_conn) > 0) {


		foreach($edit_menu_rows as $row){

				
					if (is_array($row)) {
						echo $row['menu_title'];
					} else {

						echo "No Record Found";

					}
					
				
			
		}					


		}


	} else {

		mysqli_error($conn);

	}


?>

<form method="GET">
	
	<input type="text" name="edit_menu_item" value="<?php if(isset($_GET['menu_id'])){echo $_GET['menu_title'];} ?>">
	<button type="submit">EDIT</button>

</form>




</div>


<div class="col-md-6">




			<table>
				
				<tr>
					
					<!-- <td>Number</td> -->
					<td>Menu ID</td>
					<td>Menu Title</td>

				</tr>

	<?php 

			$menu_display_query = "SELECT menu_id, menu_title FROM menu";
			$menu_display_conn = mysqli_query($conn, $menu_display_query);

			while ($menu_display_row = mysqli_fetch_assoc($menu_display_conn)) {
				
			$menu_id_output = $menu_display_row['menu_id'];
			$menu_title_output = $menu_display_row['menu_title'];

			?>


				<tr>
					
					<!-- <td><?php $menu_count = count($menu_display_row); echo $menu_count;?></td> -->
					<td><?php echo $menu_id_output?></td>
					<td><?php echo $menu_title_output?></td>
					<td><a href="includes/edit_menu.php?edit_menu_id=<?php echo $menu_id_output;?>">Edit</a></td>
					<td><a href="includes/delete_menu.php?del=<?php echo $menu_id_output?> ">Delete</a></td>

				</tr>


	<?php } ?> 

		


			</table>





</div>


