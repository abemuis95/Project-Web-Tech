<?php

	// EDIT HERE
	// Server or Host name, Database Username, Database Password, Database Name goes in here
	define ('hostnameorservername','localhost');
	define ('serverusername','root');
	define ('serverpassword','');
	define ('databasenamed','db_project');

	// Make connection with database
	global $connection;
	$connection = @mysqli_connect(hostnameorservername,serverusername,serverpassword) or die('1. Connection could not be made to the SQL Server. Please report this system error to admin.');
	@mysqli_select_db($connection, databasenamed) or die('2. Connection could not be made to the database. Please report this system error to admin.');	

?>