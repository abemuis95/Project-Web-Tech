<?php
	header("Content-type:text/plain");
	header("Access-Control-Allow-Origin: *");

	//include('config.php');

	$jsonString = file_get_contents("php://input");
	$jsonObject = json_decode($jsonString, true);
	echo var_dump($jsonObject);
	echo $students['customer']['name'];


	function SaveOrder() {

	}

	function ListOrder() {

	}
	
	// This method will delete order history in database
	// based from the user choice
	function DeleteOrder() {

	}

?>