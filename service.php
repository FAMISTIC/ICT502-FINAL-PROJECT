<?php
include_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$model = $_POST['model'];
	$colour = $_POST['colour'];
	$plate = $_POST['plate'];
    $customer_name = $_POST['customer_name'];
    $package = $_POST['package'];
    $appointment_date = $_POST['appointment_date'];
    $price = 0;

    if($package == "basic") {   
        $price = 10;
    } elseif ($package == "premium") { 
        $price = 20;
    }   elseif ($package == "Enterprise") {
        $price = 30;
    }   elseif ($package == "Business") {
        $price = 40;
    }
    $customer_query = "SELECT * FROM customer WHERE customer_name = :customer_name";
    $stmt = oci_parse($connection, $query);
    oci_bind_by_name($stmt, ':customer_name', $customer_name);
    oci_execute($stmt);

    if ($row = oci_fetch_assoc($stmt)) {
        // Login successful
        // Store user information in session variables
        $_SESSION['customer_id'] = $row['CUSTOMER_ID'];
        $customer_id = $row['CUSTOMER_ID'];
        
        // Redirect to the home page or a dashboard
    } else {
        // Login failed
        echo 'Invalid email or password.';
    }
    
    $query2 = "SELECT * FROM vehicle WHERE plate = :plate";
	$stmt2 = oci_parse($connection, $query2);

    $service_query = "INSERT INTO service (price, package, appointment_date,customer_id, vehicle_id, employee_id, receipt_id) VALUES('$price', '$package', '$appointment_date', '$customer_id', '$vehicle_id',  '$employee_id'))";
    $service_stmt = oci_parse($connection, $service_query);
    oci_bind_by_name($service_stmt, ':price', $price);
    oci_bind_by_name($service_stmt, ':package', $package);
    oci_bind_by_name($service_stmt, ':appointment_date', $appointment_date);
    oci_bind_by_name($service_stmt, ':customer_id', $customer_id);
    oci_bind_by_name($service_stmt, ':vehicle_id', $vehicle_id);
    oci_bind_by_name($service_stmt, ':employee_id', $employee_id);

    if (oci_execute($service_stmt)) {
        echo 'Service added successfully';
    } else {
        echo 'Error adding service';
    }
    

    if ( oci_fetch($stmt2)) {
        // Username or email already exists
        echo 'Car plate is already taken..';
    } else {

		
    // Insert the new user into the database
	if(isset($_POST['submit'])){	
    $query2 = oci_parse($connection, "INSERT INTO vehicle(model,colour,plate) 
	values ('$model','$colour','$plate')");
    $result2 = oci_execute($query2);

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
    oci_close($connection);

}
?>