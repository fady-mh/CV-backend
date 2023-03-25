<?php include "../admin_functions.php"; 

conn(); ?>

<?php include "../header.php" ?>

    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../css/sb-admin.css" rel="stylesheet">

<?php 

$project_title_display ="";
$project_content_display ="";
$project_image_display ="";
$project_tags_display ="";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	
	$project_edit_display_id = $_GET['edit_project'];

	$project_edit_display = "SELECT project_title, project_content, project_image, project_tags FROM cv_projects WHERE project_id = '{$project_edit_display_id}' ";

	$project_edit_display_query = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($project_edit_display_query, $project_edit_display)) {
		echo "Connection and Query failed please check project connection query";

	} else {

		mysqli_stmt_execute($project_edit_display_query);
		$result = mysqli_stmt_get_result($project_edit_display_query);
		while ($row = mysqli_fetch_assoc($result)) {

			$project_title_display=$row['project_title'];
			$project_content_display=$row['project_content'];
			$project_image_display=$row['project_image'];
			$project_tags_display=$row['project_tags'];
			
		}

	}
	}


?>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	if (isset($_POST['project_submit'])) {
		
	$project_edit_id = $_GET['edit_project'];
	$project_title = $_POST['project_title'];
  	$project_content = $_POST['project_content'];
  	$project_image = $_FILES['project_image']['name'];
  	$project_image_temp = $_FILES['project_image']['tmp_name'];
  	$project_image_size = $_FILES['project_image']['size'];
  	$project_image_error = $_FILES['project_image']['error'];
  	$project_image_type = $_FILES['project_image']['type'];

  	$project_image_ext = explode('.', $project_image);
  	$project_name_aext = strtolower(end($project_image_ext));

  	$project_image_allowed =  array('jpg', 'jpeg', 'png', 'pdf', 'webp' );

  	if (in_array($project_name_aext, $project_image_allowed)) {
  		if ($project_image_error === 0) {
  			if ($project_image_size < 500000 ) {
  				$project_image_newname = uniqid('', true).".".$project_name_aext;
  				$project_image_dest = '../images/' . $project_image;
  				move_uploaded_file($project_image_temp, $project_image_dest);
  			} else {

  				echo "File size too big";

  			}
  		} else {

  			echo "There was an error processing this file";

  		}
  	} else {

  		echo "You can not upload files of this type!";

  	}



	$project_tags = $_POST['project_tags'];


	$project_add = "UPDATE cv_projects SET project_title = '{$project_title}', project_content = '{$project_content}', project_image = '{$project_image}', project_tags ='{$project_tags}' WHERE project_id = '{$project_edit_id}' ";

	$project_add_query = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($project_add_query, $project_add)) {
		echo "Connection and Query failed please check project connection query";

	} else {

		mysqli_stmt_execute($project_add_query);
		mysqli_stmt_get_result($project_add_query);

	}
	}


	}

?>


<form action="" method="POST" enctype="multipart/form-data">
	


<input type="text" name="project_title" value="<?php echo $project_title_display; ?>">

<textarea id="tiny_projects_edit" name="project_content" value="<?php echo $project_content_display; ?>"></textarea>


<input class="img" type="file" name="project_image" value="<?php echo $project_image_display; ?>">

<select>

<?php 

	$project_cat_query  = "SELECT * FROM project_categories ";
	$project_cat_run = mysqli_query($conn, $project_cat_query);

	while ($project_cat_row = mysqli_fetch_assoc($project_cat_run)) {
	 	
		$project_cat_output = $project_cat_row['project_cat_title'];?>

		<option> <?= $project_cat_output; ?> </option>	

	<?php } ?>

</select>

<input type="text" name="project_tags" value="<?php echo $project_tags_display ?>" >

<button type="submit" name="project_submit">Update Project</button>

</form>

<?php include "../footer.php" ?>