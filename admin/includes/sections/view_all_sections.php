<div class="col-md-12">
		<table>
		
		<tr>
				
			<td>Section ID</td>
			<td>Section Title</td>
			

		</tr>
	<?php 

	if (isset($_GET['delete_section'])) {
		
	$delete_section = $_GET['delete_section'];

	$delete_section_query = "DELETE FROM cv_sections WHERE id = $delete_section";
	$delete_section_run = mysqli_query($conn, $delete_section_query);

	if ($delete_query_run) {
			echo "Section Deleted";
		}


	}

?>


	<?php

	$sections_display = "SELECT * FROM cv_sections";
	$sections_display_run = mysqli_query($conn, $sections_display);

	while ($sections_display_row = mysqli_fetch_assoc($sections_display_run)) {
		
		$sections_display_id = $sections_display_row['id'];
		$sections_display_title = $sections_display_row['section_title'];?>



		<tr>
			
			<td><?= $sections_display_id; ?></td>
			<td><?= $sections_display_title; ?></td>
			<td><a href="includes/sections/edit_section?edit_section=<?php echo $sections_display_id;?>">Edit</a></td>
			<td><a href="index.php?delete_section=<?php echo $sections_display_id;?>">Delete</a></td>


		</tr>


	<?php }; ?>
	</table>	



</div>