<?php

	include('config.php');

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
			ListOrder();
			break;

		case 'delete':
			DeleteOrder();
			break;
		
		default:
			# code...
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
	}

	function ListOrder() {

	}

	function DeleteOrder() {
		
	}

?>