<?php
include_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['customer_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
	$phone = $_POST['phone'];

	$model = $_POST['model'];
	$colour = $_POST['colour'];
	$plate = $_POST['plate'];


    // Check if the username or email already exists in the database
    $query = "SELECT * FROM customer WHERE customer_name = :customer_name OR email = :email OR phone = :phone OR password = :password";
    $stmt = oci_parse($connection, $query);
    oci_bind_by_name($stmt, ':customer_name', $customer_name);
    oci_bind_by_name($stmt, ':email', $email);
	oci_bind_by_name($stmt, ':password', $password);
    oci_bind_by_name($stmt, ':phone', $phone);
    oci_execute($stmt);

	$query2 = "SELECT * FROM vehicle WHERE plate = :plate";
	$stmt2 = oci_parse($connection, $query2);




    if (oci_fetch($stmt) || oci_fetch($stmt2)) {
        // Username or email already exists
        echo 'Username or email already taken.';
    } else {

		
        // Insert the new user into the database
		if(isset($_POST['save']))
		{	 
		
		
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
    }

    // Close the Oracle connection
    oci_close($connection);
}


?>