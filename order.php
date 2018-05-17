<?php

	include('config.php');

	// SQL statement to update event table of status_data to 0 if the date has pass
	$updatedata = "UPDATE event SET status_data = 0 WHERE start_date < '" . $currentdate . "' AND (end_date < '" . $currentdate . "' OR end_date is NULL)";
	$query1 = mysqli_query($connection, $updatedata); // Execute the sql statement

	class SaveOrder() { . . . }
	class ListOrder() { . . . }
	class DeleteOrder() { . . . }

?>