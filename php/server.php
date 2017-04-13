<?php
/* This file is where you'll store all server side variables/functions you need.
	 Reason for storing things on the server side is that when the user
	 closes out of their webpage, you'll still have any information
	 that they posted.
*/

/* ***************************************EXAMPLE*************************************** */
/* In this example I have an array and 3 functions
	 The orders array stores all orders from a pizza website */
$orders = array();

// This function counts how many orders we have so far
function getPreviousOrders() {
	return count( $orders );
}

// This function adds an order to the array
function addOrder( $order ) {
	array_push( $orders, $order );
}
?>
