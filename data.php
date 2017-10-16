<?php
require ('includes/config.inc.php');

// Create connection

	$conn = new mysqli($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}


	header('Content-type: application/json');
	$array = array();
	$index=0;
	$sql = "SELECT ID,TITLE,DESCRIPTION,FILEPATH,HEIGHT,WIDTH FROM images;";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$array[$index] = array(
			'ID' => $row['ID'],
			'Title' => $row['TITLE'],
			'Filename' => $row['FILEPATH'],
			'Description' => $row['DESCRIPTION'],
			'Width' => $row['WIDTH'],
			'Height' => $row['HEIGHT']
			);
			$index++;
		}
		echo json_encode($array);
	} else {
		echo "0 results";
	}
	$conn->close();
?>