
<?php 

	if (isset($_POST['submit_proj_cat'])) {

		$add_proj_cat = $_POST['add_proj_cat'];

		$add_proj_cat_query = "INSERT INTO project_categories(project_cat_title) VALUES ('{$add_proj_cat}')";
		$add_proj_cat_run = mysqli_query($conn,$add_proj_cat_query); 

	}

?>


<form method="POST">

<label>Add Project Category</label><br>
<input type="text" name="add_proj_cat"><br>

<button type="submit" class="btn btn-primary" name="submit_proj_cat" >Add Project Category</button>

</form>

<?php 


	if (isset($_GET['del_proj_cat'])) {
		
		$project_cat_del_id = $_GET['del_proj_cat']; 

		$project_cat_del = "DELETE FROM project_categories WHERE project_cat_id = $project_cat_del_id";
		$project_cat_del_query = mysqli_query($conn, $project_cat_del);
	}
	



?>

<table>		
	<tr>
			
		<td>Category ID</td>
		<td>Category Title</td>
		

	</tr>

<?php 

	$project_cat = "SELECT * FROM project_categories";
	$project_cat_query = mysqli_query($conn, $project_cat);

	while ($project_cat_row = mysqli_fetch_assoc($project_cat_query)) {
		$project_cat_id = $project_cat_row['project_cat_id'];
		$project_cat_title = $project_cat_row['project_cat_title'];?>

		<tr>
				
			<td><?= $project_cat_id; ?></td>
			<td><?= $project_cat_title; ?></td>
			<td>Edit</td>
			<td><a href="index.php?del_proj_cat=<?= $project_cat_id; ?>">Delete</a></td>

		</tr>

	<?php }; ?>

</table>