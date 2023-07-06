<?php
include_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_name = $_POST['customer_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];

    // Check if the username or email already exists in the database
    $query = "SELECT * FROM customer WHERE customer_name = :customer_name OR email = :email OR phone = :phone OR password = :password";
    $stmt = oci_parse($connection, $query);
    oci_bind_by_name($stmt, ':customer_name', $customer_name);
    oci_bind_by_name($stmt, ':email', $email);
    oci_bind_by_name($stmt, ':phone', $phone);
    oci_bind_by_name($stmt, ':password', $password);
    oci_execute($stmt);

    if (oci_fetch($stmt)) {
        // Username or email already exists
        echo 'Username, email, or phone number already taken.';
    } else {
        // Insert the new user into the database
        $insertQuery = "INSERT INTO customer (customer_name, phone, password, email) VALUES (:customer_name, :phone, :password, :email)";
        $insertStmt = oci_parse($connection, $insertQuery);
        oci_bind_by_name($insertStmt, ':customer_name', $customer_name);
        oci_bind_by_name($insertStmt, ':phone', $phone);
        oci_bind_by_name($insertStmt, ':password', $password);
        oci_bind_by_name($insertStmt, ':email', $email);

        if (oci_execute($insertStmt)) {
            echo "User data added successfully!";
        } else {
            echo "Error adding user data.";
        }
    }

    // Close the Oracle connection
    oci_close($connection);
}
?>
