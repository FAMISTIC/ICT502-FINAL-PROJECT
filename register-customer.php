<?php
include_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['customer_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
	$phone = $_POST['phone'];

    // Check if the username or email already exists in the database
    $query = "SELECT * FROM customer WHERE customer_name = :customer_name OR email = :email OR phone = :phone OR password = :password";
    $stmt = oci_parse($connection, $query);
    oci_bind_by_name($stmt, ':customer_name', $customer_name);
    oci_bind_by_name($stmt, ':email', $email);
	oci_bind_by_name($stmt, ':password', $password);
    oci_bind_by_name($stmt, ':phone', $phone);
    oci_execute($stmt);

	
    if (oci_fetch($stmt)) {
        // Username or email already exists
        echo 'Username or email already taken.';
    } else {

		
        // Insert the new user into the database
		if(isset($_POST['save']))
		{	 
		
		
			$query = oci_parse($connection, "INSERT INTO customer(customer_name,phone,password,email) 
			values ('$customer_name','$phone','$password','$email')");

			$result = oci_execute($query);
		
		
			if ($result) {
						echo "User Data added Successfully !";
						exit();
			}
			else{
				echo "Error !";
						exit();
			}
			
		
			
		}
    }

    // Close the Oracle connection
    oci_close($connection);
}


?>