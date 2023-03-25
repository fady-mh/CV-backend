
<?php include "../admin_functions.php"; 

conn(); ?>

<?php 

$section_display_title = ""; 

$section_display_content = ""; 

if ($_SERVER['REQUEST_METHOD'] === "GET") {
	
	$section_display_id = $_GET['edit_section'];
	$section_display_query = "SELECT id, section_title, section_content FROM cv_sections WHERE id = '{$section_display_id}' ";
	$section_display = mysqli_query($conn, $section_display_query);

	while ($section_display_row = mysqli_fetch_assoc($section_display)) {
		
		$section_display_title = $section_display_row['section_title'];
		$section_display_content = $section_display_row['section_content'];

	}


}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

	$get_section_id = $_GET['edit_section'];
	$section_title = $_POST['sec_title'];
	$section_content = $_POST['sec_content'];
	$section_stmt_query = "UPDATE cv_sections SET section_title = '{$section_title}', section_content = '{$section_content}' WHERE id = '{$get_section_id}' ";

	$section_stmt_init = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($section_stmt_init, $section_stmt_query)) {
		
		echo "Check Your Query";

	} else {

		mysqli_stmt_execute($section_stmt_init);
		mysqli_stmt_get_result($section_stmt_init);


	}

}




?>

<form action='' method='POST'>
<label> Section Title </label>	<br>
<input type="text" name="sec_title" value="<?=  $section_display_title?>"> <br><br>

<label> Section Content </label>
<textarea name='sec_content' id='default' value=""><?=$section_display_content?></textarea>
<button type='submit' class="btn btn-primary" name='submit_section'>Publish</button>
</form>
