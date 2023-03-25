
<?php 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$project_title = $_POST['project_title'];
  	$project_content = $_POST['project_content'];
  	$project_image = $_FILES['project_image']['name'];
  	$project_image_temp = $_FILES['project_image']['tmp_name'];
  	$project_image_size = $_FILES['project_image']['size'];
  	$project_image_error = $_FILES['project_image']['error'];
  	$project_image_type = $_FILES['project_image']['type'];

  	$project_image_ext = explode('.', $project_image);
  	$project_name_aext = strtolower(end($project_image_ext));

  	$project_image_allowed =  array('jpg', 'jpeg', 'png', 'pdf' );

  	if (in_array($project_name_aext, $project_image_allowed)) {
  		if ($project_image_error === 0) {
  			if ($project_image_size < 50000 ) {
  				$project_image_newname = uniqid('', true).".".$project_name_aext;
  				$project_image_dest = 'includes/images/' . $project_image;
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


  	$project_date = $_POST['project_date'];
	$project_tags = $_POST['project_tags'];



	


	$project_add = "INSERT INTO cv_projects(project_title, project_content, project_image, project_date, project_tags) VALUES ('{$project_title}', '{$project_content}', '{$project_image}' ,now() ,'{$project_tags}') ";

	$project_add_query = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($project_add_query, $project_add)) {
		echo "Connection and Query failed please check project connection query";

	} else {

		mysqli_stmt_execute($project_add_query);
		mysqli_stmt_get_result($project_add_query);

	}
	}


?>


<form action="" method="POST" enctype="multipart/form-data">
	


<input type="text" name="project_title">

<textarea id="tiny_projects" name="project_content"></textarea>


<select>

<?php 

	$project_cat_query  = "SELECT * FROM project_categories ";
	$project_cat_run = mysqli_query($conn, $project_cat_query);

	while ($project_cat_row = mysqli_fetch_assoc($project_cat_run)) {
	 	
		$project_cat_output = $project_cat_row['project_cat_title'];?>

		<option> <?= $project_cat_output; ?> </option>	

	<?php } ?>

</select>

<input class="img" type="file" name="project_image">

<input type="text" name="project_tags">

<button type="submit" name="project_submit">Publish Project</button>

</form>