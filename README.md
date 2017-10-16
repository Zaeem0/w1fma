# W1 FMA - Final marked assignment for Building web applications with MySQL and PHP

Config variables in includes/config.inc.php will need to be modified to your database

*Technologies used: HTML, CSS, PHP, MySQL*

This site allows users to upload and view JPEG files accompanied by a description.
It does this by storing information about the upload into a MySQL table called 'images'.
Retrieving the data allows images held on the filesystem to be displayed with their respective description.
A summary of of all thumbnail images exists on the homepage with no image larger than 150px x 150px.
Clicking on a thumbnail takes you to another view where the image is displayed at a maximum of 600px x 600px.
To go back to the thumbnails you may click on the image.
---
View demo here [http://titan.dcs.bbk.ac.uk/~zqadee01/w1fma/index](http://titan.dcs.bbk.ac.uk/~zqadee01/w1fma/index.php)

---

# Installation & Configuration:
Only run the SQL file(setup/install.sql) to create the necessary tables in your database if you haven't already, 
and make sure you havent created a duplicate.

Extract The files in this zip directly to your root directory where you will be deploying your app,
so that you can view the app on /your_root_folder/index.php
Folder structure should remain the same.

Modify the config.inc.php file so you may login to your database.
Also if you wish to use an existing thumbs and uploads folder, set the 
permissions(777) to allow read and write capabilities first then again modify the $config['folder']
and $config['thumbs'] to your image and thumbnail folders respectively.