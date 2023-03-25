

<h1>Projects View</h1>

<table>

	<tr>
		
		<td>Project ID</td>
		<td>Project Title</td>
		<td>Project Date</td>
		<td>Project Image</td>

	</tr>
	
	<?php 


	if ($_SERVER['REQUEST_METHOD'] == "GET") {
		
		$del_project_id = $_GET['del_project'];
		$del_project = "DELETE FROM cv_projects WHERE project_id = $del_project_id";
		$del_project_stmt = mysqli_stmt_init($conn);

		if (!mysqli_stmt_prepare($del_project_stmt, $del_project)) {
			echo "Query failed";
		} else {

			mysqli_stmt_execute($del_project_stmt);
			mysqli_stmt_get_result($del_project_stmt);

		}

	}
	

	?>

	<?php 

		$project_view_query = "SELECT * FROM cv_projects";
		$project_view_run = mysqli_query($conn, $project_view_query);

		while ($project_view_row = mysqli_fetch_assoc($project_view_run)) {
			
			$project_view_id = $project_view_row['project_id'];
			$project_view_title =  $project_view_row['project_title'];
			$project_view_date =  $project_view_row['project_date'];
			$project_view_img =  $project_view_row['project_image'];?>

			<tr>
					
				<td><?= $project_view_id; ?></td>
				<td><?= $project_view_title; ?></td>
				<td><?= $project_view_date; ?></td>
				<td><?= $project_view_img; ?></td>

				<td><a href="includes/projects/edit_project.php?edit_project=<?= $project_view_id; ?>">Edit</a></td>
				<td><a href="index.php?del_project=<?= $project_view_id; ?>">Delete</a></td>

			</tr>	




	<?php } ?>



</table>