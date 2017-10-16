<?php
/**
 * Building Web Applications using MySQL and PHP (W1FMA)
 *
 * HOE - Uploading Files
 *
 */

require ('includes/config.inc.php');
require ('includes/functions.php');

	if(!isset($_GET['page'])){
		$id = 'home';
	} else
	{
	$id = $_GET['page'];	}

	include_once $config['app_dir'].'/includes/head.html';

	//thumbnails from case 'home' will be added and echoed in a further line
	$content = '';
	switch ($id){
			case 'home' :
				include 'views/gallery.php';
				break;
			case 'image' :
				include 'views/images.php';
				break;
			default:
				include 'views/404.php';
		}


	$link = new mysqli($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);
	if ($link->connect_error) {
		die("Connection failed: " . $link->connect_error);
	}
	
	// Check if the form has been submitted...
	
	
if (isset($_POST['singlefileupload'])) {
	if(empty($description = ($_POST['description']))){
		$description = "-";
	}else{
	$description = ($_POST['description']);
	$description = $link->real_escape_string(sanitize($description));
	}
	// Process the uploaded files here...
	if (is_uploaded_file($_FILES['userfile']['tmp_name']) && ($_FILES['userfile']['type']=='image/jpeg')) {	
	
		//image.jpg
		$filename = basename($_FILES['userfile']['name']);
		$filename =  $link->real_escape_string(sanitize($filename));
		//path/to/jpg
		$newname = $config['upload_dir'].$filename;
		
		//title without .jpg extension
		$title = pathinfo($filename)['filename'];

		///var/temp/12345.jpg
		$tmpname = $_FILES['userfile']['tmp_name'];
		
		//resized large image to path/to/uploads/image.jpg
		resizeIMG($tmpname,$tmpname,600,600);
		list($width,$height) = getimagesize($tmpname);	
		
		if (move_uploaded_file($tmpname, $newname)) {
			$sql = "INSERT INTO images (TITLE,FILEPATH,DESCRIPTION,WIDTH,HEIGHT) 
					VALUES(
					'$title',
					'$filename',
					'$description',
					'$width',
					'$height');";
			if($link->query($sql)===TRUE){
				//create thumbnail
				resizeIMG($newname,$config['thumbs'].$filename,150,150);
				echo $filename." successfully uploaded";
			}else {
				//if mysql insert fails, delete the leftover image in the system as you can't display it when there is no record in the db
				unlink($newname);
				printf("Errormessage: %s\n", $link->error);
				echo 'File upload failed, error in processing';
			}
		}else
		{
			echo "<p>File must be a jpeg</p>";
		}
	}
}
	$link->close();
	//form for uploading
	include_once $config['app_dir'].'/includes/form.html';

	//thumbnails received from gallery.php
	echo $content;

	//footer to close html tags from previous include of head.html
	include_once $config['app_dir'].'/includes/footer.html';

?>