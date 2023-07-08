<?php
// Include your Oracle connection code here
// ...
include_once 'connection.php';

// Check if a customer ID and data are provided
if (isset($_POST['customer_id']) && isset($_POST['customer_name']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['password'])) {
    $customer_id = $_POST['customer_id'];
    $customer_name = $_POST['customer_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Update the customer data in the database
    $query = "UPDATE customer SET customer_name = :customer_name, phone = :phone, email = :email, password = :password WHERE customer_id = :customer_id";
    $stmt = oci_parse($connection, $query);
    oci_bind_by_name($stmt, ':customer_name', $customer_name);
    oci_bind_by_name($stmt, ':phone', $phone);
    oci_bind_by_name($stmt, ':email', $email);
    oci_bind_by_name($stmt, ':password', $password);
    oci_bind_by_name($stmt, ':customer_id', $customer_id);

    if (oci_execute($stmt)) {
        echo 'Customer updated successfully.';
    } else {
        echo 'Failed to update customer.';
    }
} else {
    echo 'Invalid request.';
}

// Close the Oracle connection
oci_close($connection);
?>
