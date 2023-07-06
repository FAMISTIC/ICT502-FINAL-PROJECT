<?php
include_once 'connection.php';
if(isset($_POST['save']))
{	 
	$customer_name = $_POST['customer_name'];
	$phone = $_POST['phone'];
	$password = $_POST['password'];
	$email = $_POST['email'];

	$model = $_POST['model'];
	$colour = $_POST['colour'];
	$plate = $_POST['plate'];

	$query = oci_parse($connection, "INSERT INTO customer(customer_name,phone,password,email) 
	values ('$customer_name','$phone','$password','$email')");
	$query2 = oci_parse($connection, "INSERT INTO vehicle(model,colour,plate) 
	values ('$model','$colour','$plate')");

	$result = oci_execute($query);
	$result2 = oci_execute($query2);


	if ($result && $result2) {
				echo "User Data added Successfully !";
				exit();
	}
	else{
		echo "Error !";
				exit();
	}
	

	
}
?>