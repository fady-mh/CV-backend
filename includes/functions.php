<?php 



function conn(){

	global $conn;

	$servername = "localhost";
	$username = "root";
	$password = "";
	$db = "cv-cms";

	$conn = mysqli_connect($servername, $username, $password, $db);

	if (!$conn) {
		die("Failed to connect to database" . mysqli_error($conn) );
	} else {

		echo "Database connected successfully";

	}
 


}

/**********************upper menu***********************/


function upper_menu(){

	global $conn;

	$um_query = "SELECT * FROM menu_upper";
	$um_stmt = mysqli_stmt_init($conn); // instead of mysqli_connect

//Prepare the prepared statement

if (!mysqli_stmt_prepare($um_stmt, $um_query)) {

	echo "Failed to Establish connection" . mysqli_error();

} else {

	mysqli_stmt_execute($um_stmt);
	
	$get_upper_menu = mysqli_stmt_get_result($um_stmt);
	
	while($row = mysqli_fetch_assoc($get_upper_menu)) {

	$um_tel = $row['tel'];
	$um_email = $row['email'];
	$um_address = $row['address'];	

	echo "<li><a href=''>

			<svg xmlns='http://www.w3.org/2000/svg' width='25' height='25' fill='currentColor' class='bi bi-phone-vibrate' viewBox='0 0 16 16'>
	  <path d='M10 3a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h4zM6 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H6z'/>
	  <path d='M8 12a1 1 0 1 0 0-2 1 1 0 0 0 0 2zM1.599 4.058a.5.5 0 0 1 .208.676A6.967 6.967 0 0 0 1 8c0 1.18.292 2.292.807 3.266a.5.5 0 0 1-.884.468A7.968 7.968 0 0 1 0 8c0-1.347.334-2.619.923-3.734a.5.5 0 0 1 .676-.208zm12.802 0a.5.5 0 0 1 .676.208A7.967 7.967 0 0 1 16 8a7.967 7.967 0 0 1-.923 3.734.5.5 0 0 1-.884-.468A6.967 6.967 0 0 0 15 8c0-1.18-.292-2.292-.807-3.266a.5.5 0 0 1 .208-.676zM3.057 5.534a.5.5 0 0 1 .284.648A4.986 4.986 0 0 0 3 8c0 .642.12 1.255.34 1.818a.5.5 0 1 1-.93.364A5.986 5.986 0 0 1 2 8c0-.769.145-1.505.41-2.182a.5.5 0 0 1 .647-.284zm9.886 0a.5.5 0 0 1 .648.284C13.855 6.495 14 7.231 14 8c0 .769-.145 1.505-.41 2.182a.5.5 0 0 1-.93-.364C12.88 9.255 13 8.642 13 8c0-.642-.12-1.255-.34-1.818a.5.5 0 0 1 .283-.648z'/>
	</svg>{$um_tel} </a></li>";

	echo "<li><a href=''>

			<svg xmlns='http://www.w3.org/2000/svg' width='25' height='25' fill='currentColor' class='bi bi-envelope' viewBox='0 0 16 16'>
			  <path d='M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z'/>
			</svg>

	{$um_email} </a></li>";
	echo "<li><a href=''>

		<svg xmlns='http://www.w3.org/2000/svg' width='25' height='25' fill='currentColor' class='bi bi-geo-alt' viewBox='0 0 16 16'>
	  <path d='M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z'/>
	  <path d='M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z'/>
	</svg>


	{$um_address} </a></li>";


	}


}


}


/**********************menu*****************************/

function main_menu() {
			global $conn;			

		$menu_titles = array() ;
		// Create a template 
		$query = "SELECT * FROM menu";
		// Prepared statement
		$stmt = mysqli_stmt_init($conn);

		//Prepare the prepared statement

		if (!mysqli_stmt_prepare($stmt, $query)) {
			echo "SQL statement Failed";

		} else {

		//bind parameters to the placeholders

		mysqli_stmt_execute($stmt);

		$get_menu = mysqli_stmt_get_result($stmt);

		while($row = mysqli_fetch_assoc($get_menu)){
		 $menu_titles[] = $row;


		}

		 foreach($menu_titles as $menu_title) { 

			echo "<li><a href='#'>" . $menu_title['menu_title'] . "</a> </li>";

		 } 
	   } 


}

/**********************************************Logo *****************************************/

function logo() {

	global $conn;

	$logo_query = "SELECT logo FROM cv_logo ";

	$logo_connect = mysqli_query($conn, $logo_query);

	$row = mysqli_fetch_assoc($logo_connect);

	echo "<a href='index.php'><img width='200px' src='./images/{$row['logo']}'></a>";

 }
/*

 function content_query($section_result){

 	global $conn;
 	// global $section_result;

 	$section_query = "SELECT * FROM cv_sections ";
	$section_stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($section_stmt, $section_query)) {
		
		echo "SQL FAILED";

	} else {

		mysqli_stmt_execute($section_stmt);

		$section_result = mysqli_stmt_get_result($section_stmt);


		}


		return $section_result;		

 }


function section_loop() {


	$section_result = "";
	$have_section = mysqli_num_rows(content_query($section_result));

	echo $have_section;


}

function content_output($row_select) {

	 	$section_result_title = "";

		 $section_output = content_query($section_result_title);
		 
		$row_select = mysqli_fetch_assoc($section_output);

		while ($row_select = mysqli_fetch_assoc($section_output)) {
			 $row_select['section_title'];
			 $row_select['section_title'];}

			 return $row_select;

			}



	function get_title(){

		$row_select_title="";

		$section_title_output = content_output($row_select_title);


			echo $section_title_output['section_title'] . "<br>";
	 	}



	function get_content(){


				// echo $section_content_output . "<br>";
	 	}
		

			

		


	function get_image(){



	}



 function get_title(){

 	$section_result_title = "";

 	$section_output = content_query($section_result_title);
 
	$row_select = mysqli_fetch_assoc($section_output);

		foreach($row_select as $row){

			$section_title_output = $row_select['section_title'];

				echo $section_title_output . "<br>";

		}

			// $row_select['section_img'];
				

	}







 function get_content(){


 	$section_result = "";

 	$section_output = content_query($section_result);
 
	$row_select = mysqli_fetch_assoc($section_output);


			$section_content_output = $row_select['section_content'];

			echo $section_content_output . "<br>";

	}


function get_image(){



}

*/


/**************************************************Get Content**************************************************/

function the_content() {

	global $conn;
 	// global $section_result;

 	$section_query = "SELECT * FROM cv_sections ";
	$section_stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($section_stmt, $section_query)) {
		
		echo "SQL FAILED";

	} else {

		mysqli_stmt_execute($section_stmt);

		$section_result = mysqli_stmt_get_result($section_stmt);

		while ($row = mysqli_fetch_assoc($section_result)) {

			$section_title = $row['section_title'] ;
			$section_content = $row['section_content'] ;

				
				echo "<article id='career-objective-content' class=''>";

				echo"<header id='career-obj-header'>";
						
				echo "<h1> $section_title </h1>";

				echo "</header>";

				echo "<p> $section_content</p>";

				echo "</article>";



					}


		}}