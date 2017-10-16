<?php
require ('includes/config.inc.php');

	$link = new mysqli($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);
	if ($link->connect_error) {
		die("Connection failed: " . $link->connect_error);
	}
	//given the json data from data.php you can pick an id which is unique
	//even if their are duplicate file names
	//and enter it in the url to find an image
	if(isset($_GET['id'])){
		$id=sanitize($_GET['id']);
		$sql="SELECT TITLE,FILEPATH,DESCRIPTION,HEIGHT,WIDTH FROM images where ID = $id ;";
		$result = $link->query($sql);
		if ($result === FALSE) {
			printf("Errormessage: %s\n", $mysqli->error);;
		} 
		else {
			
			//load template
			$file = 'templates/imageTemplate.html';
			$tpl_row = file_get_contents($file);
	 
			if ( $row = $result->fetch_assoc() ){

				 // Use the template 
				 $pass1 = str_replace('[+title+]',sanitize($row['TITLE']),$tpl_row);
				 $pass2 = str_replace('[+description+]',sanitize($row['DESCRIPTION']),$pass1);
				 $pass3 = str_replace('[+height+]',sanitize($row['HEIGHT']),$pass2);
				 $pass4 = str_replace('[+width+]',sanitize($row['WIDTH']),$pass3);
				 $final = str_replace('[+image+]',$config['folder'].sanitize($row['FILEPATH']),$pass4);
				 // Add this HTML to $content
				 $content .= $final;
			}
			/* free result set */
			$result->free();
		}
	}else{
		include_once 'gallery.php';
		};
	//close link
	$link->close();
?>



