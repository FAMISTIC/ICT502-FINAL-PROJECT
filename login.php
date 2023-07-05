<?php
// Include your Oracle connection code here
include_once 'connection.php';

// Start the session
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate the username and password
    // You can implement your own validation logic here

    // Query to check if the provided email and password are correct
    $query = "SELECT * FROM customer WHERE email = :email AND password = :password";
    $stmt = oci_parse($connection, $query);
    oci_bind_by_name($stmt, ':email', $email);
    oci_bind_by_name($stmt, ':password', $password);
    oci_execute($stmt);

    // Check if the login is successful
    if ($row = oci_fetch_assoc($stmt)) {
        // Login successful
        // Store user information in session variables
        $_SESSION['customer_name'] = $row['CUSTOMER_NAME'];
        $_SESSION['email'] = $row['EMAIL'];
        
        // Redirect to the home page or a dashboard
        header("Location: home.php");
        exit();
    } else {
        // Login failed
        echo 'Invalid email or password.';
    }
}

// Close the Oracle connection
oci_close($connection);
?>
