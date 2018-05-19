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

	if(empty($_REQUEST["id_customer"]))
	    $id_customer = 'FAIL FETCH ID_CUSTOMER';
	else
		$id_customer = $_REQUEST["id_customer"];

	if(empty($_REQUEST["customer"]))
	    $customer = 'FAIL FETCH CUSTOMER';
	else
		$customer = (array) json_decode($_REQUEST["customer"]);

	if(empty($_REQUEST["orderList"]))
	    $orderList = 'FAIL FETCH ORDERLIST';
	else
		$orderList = (array) json_decode($_REQUEST["orderList"]);

	if(empty($_REQUEST["function"]))
	    $function = 'FAIL FETCH FUNCTION';
	else
		$function = $_REQUEST["function"];

	switch ($function) {
		case 'save':
			SaveOrder($customer, $orderList, $connection);
			break;

		case 'list':
			ListOrder($connection);
			break;

		case 'delete':
			DeleteOrder($id_customer, $connection);
			break;
		
		default:
			echo "SYSTEM ERROR!";
			break;
	}


	function SaveOrder($customer, $orderList, $connection) {
		$insertdata = "INSERT INTO customers (name, address, area) VALUES ('" . $customer['name'] . "', '" . $customer['address'] . "', '" . $customer['area'] . "')";
		$queryinsert = mysqli_query($connection, $insertdata) or die(mysqli_error($connection));

		$id = $connection->insert_id;
		if(count($orderList) > 0) {
			$insertdata = "INSERT INTO orders (id_customer, item, price, qty) VALUES ('" . intval($id) . "',  '" . $orderList[0]->item . "', '" . floatval($orderList[0]->price) . "', '" . intval($orderList[0]->qty) . "')";

			if(count($orderList) > 1)
			for($i = 1; $i < sizeOf($orderList); $i++) {
				$insertdata .= ", ('" . intval($id) . "',  '" . $orderList[$i]->item . "', '" . floatval($orderList[$i]->price) . "', '" . intval($orderList[$i]->qty) . "')";
			}
			$queryinsert = mysqli_query($connection, $insertdata) or die(mysqli_error($connection));
		}
		// echo json_encode($queryinsert);
	}

	function ListOrder($connection) {
		$cust = array();
		$order = array();

		$datacustomers = "SELECT * FROM customers";
		$dataorders = "SELECT * FROM orders";

		$querycustomers = mysqli_query($connection, $datacustomers) or die(mysqli_error($connection));
		$queryorders = mysqli_query($connection, $dataorders) or die(mysqli_error($connection));

		if ($querycustomers->num_rows > 0 && $queryorders->num_rows > 0) {

		    while($row = mysqli_fetch_object($querycustomers)) {
		        // echo "id: " . $row->id_customer. " - Name: " . $row->name. " - Address: " . $row->address. " - Area: " . $row->area. "<br>";
		        array_push($cust, $row);
		    }

		    while($row = mysqli_fetch_object($queryorders)) {
		        // echo "id: " . $row->id_order. "id_customer: " . $row->id_customer. " - Item: " . $row->item. " - Price: " . $row->price. " - Qty: " . $row->qty. "<br>";
		        array_push($order, $row);
		    }

		    $array = array();
	        array_push($array, $cust);
	        array_push($array, $order);
		    echo json_encode($array);
		}
	}

	function DeleteOrder($id_customer, $connection) {
		$deletedata = "DELETE FROM customers WHERE id_customer = $id_customer";
		$queryinsert = mysqli_query($connection, $deletedata) or die(mysqli_error($connection));

		$deletedata = "DELETE FROM orders WHERE id_customer = $id_customer";
		$queryinsert = mysqli_query($connection, $deletedata) or die(mysqli_error($connection));

		// echo json_encode($id_customer);
	}

?>