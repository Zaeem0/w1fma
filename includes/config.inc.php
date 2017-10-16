<?php
$config['app_name'] = 'My App';
$config['db_user'] = 'username';
$config['db_pass'] = 'password';
$config['db_host'] ='localhost';
$config['db_name'] = 'myDB';
 


//change values depending on your folder structure here
//without having to search through all the files and manually change folder/path names
$config['folder'] = 'uploads/';
$config['thumbs'] = 'thumbs/';

/**
 * Absolute path to directory where uploaded files will be stored
 * Using an absolute path to the upload dir can help circumvent security restrictions on some servers
 */
$config['app_dir'] = dirname(dirname(__FILE__));
$config['upload_dir'] = $config['app_dir'] . '/uploads/';

	
?>