

<div class="col-md-12">

<?php 

	if (isset($_POST['submit_section'])) {
		
		$sec_title = $_POST['sec_title'];
		$sec_content = $_POST['sec_content'];
		$sec_query = "INSERT INTO cv_sections(section_title, section_content) VALUES ('{$sec_title}','{$sec_content}')";
		$sec_query_run = mysqli_query($conn, $sec_query);

		
	 }  ?>

	 	<form action='index.php' method='post'>
	 	<label> Section Title </label>	<br>
		<input type="text" name="sec_title"> <br><br>
		
		<label> Section Content </label>
		<textarea name='sec_content' id='default'></textarea>
		<button type='submit' class="btn btn-primary" name='submit_section'>Publish</button>
		</form>
	
</div>

