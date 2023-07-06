<?php
include_once 'connection.php';
if(isset($_POST['save']))
{	 
	$customer_name = $_POST['customer_name'];
	$phone = $_POST['phone'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$query = oci_parse($connection, "INSERT INTO customer(customer_name,phone,password,email) 
	values ('$customer_name','$phone','$password','$email')");
	$result = oci_execute($query);
	if ($result) {
				echo "Data added Successfully !";
				exit();
	}
	else{
		echo "Error !";
				exit();
	}
}
?>