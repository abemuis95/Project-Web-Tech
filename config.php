<?php

	// EDIT HERE
	// Server or Host name, Database Username, Database Password, Database Name goes in here
	define ('hostname','localhost');
	define ('username','root');
	define ('password','');
	define ('dbname','db_project');

	// Make connection with database
	global $connection;
	$connection = mysqli_connect(hostname,username,password,dbname) or die('Connection could not be made to the SQL Server. Please report this system error to admin.');
	
	if(!$connection) {
	    die('Could not connect: ' . mysqli_error($connection));
	}	

?>