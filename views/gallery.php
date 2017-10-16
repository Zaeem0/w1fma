<?php
/**
 * Building Web Applications using MySQL and PHP (W1)
 *
 * HOE - Uploading Files
 *
 * This file contains the file upload form, which submits to the same page
 *
 */

// Include the config file (this is where the upload directory is defined)
// Note: file is included with absolute path to avoid strange behaviour
// with __FILE__ when used in the include file

require ('includes/config.inc.php');

	$link = new mysqli($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);
	if ($link->connect_error) {
		die("Connection failed: " . $link->connect_error);
	}

	$sql="SELECT ID,TITLE,FILEPATH,DESCRIPTION FROM images ;";

        $content = '';
		// </table> start outside of the loop(else:while:) in case no content
        $file = 'templates/imgTable.html';
        $tpl_table = file_get_contents($file);
        $content .= $tpl_table;

	$result = $link->query($sql);

	if ($result===FALSE) {
		printf("Errormessage: %s\n", $mysqli->error);

	} 
	else {
        
        //load template
        $file = 'templates/imgRow.html';
        $tpl_row = file_get_contents($file);
        
        //<td>        
        /* fetch associative array */
		while ( $row = $result->fetch_assoc() ) {
             // Use the template for each author
			 $pass0 = str_replace('[+imageID+]',sanitize($row['ID']),$tpl_row);
             $pass1 = str_replace('[+title+]',sanitize($row['TITLE']),$pass0);
             $pass2 = str_replace('[+description+]',sanitize($row['DESCRIPTION']),$pass1);
			 $final = str_replace('[+image+]',$config['thumbs'].sanitize($row['FILEPATH']),$pass2);
             // Add this author's HTML to $content
             $content .= $final;
		}
		/* free result set */
		$result->free();
	}

        //closing table and conn
        $file = 'templates/tableEnd.html';
        $tpl_endTable = file_get_contents($file);
        $content .= $tpl_endTable;
		$link->close();
?>
