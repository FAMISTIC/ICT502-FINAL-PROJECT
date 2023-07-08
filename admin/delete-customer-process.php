<?php
// Include your Oracle connection code here
// ...
include_once 'connection.php';

// Check if a customer ID is provided
if (isset($_POST['customer_id'])) {
    $customer_id = $_POST['customer_id'];

    // Delete the customer from the database
    $query = "DELETE FROM customer WHERE customer_id = :customer_id";
    $stmt = oci_parse($connection, $query);
    oci_bind_by_name($stmt, ':customer_id', $customer_id);

    if (oci_execute($stmt)) {
        echo 'Customer deleted successfully.';
    } else {
        echo 'Failed to delete customer.';
    }
} else {
    echo 'Invalid request.';
}

// Close the Oracle connection
oci_close($connection);
?>
