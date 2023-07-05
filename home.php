<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['customer_name']) && isset($_SESSION['email'])) {
    // Retrieve the user information from the session variables
    $customer_name = $_SESSION['customer_name'];
    $email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
    <!-- Add your CSS styling here -->
    <style>
        /* CSS styles for the page */
    </style>
</head>
<body>
    <h2>Welcome, <?php echo $customer_name; ?>!</h2>
    <p>Email: <?php echo $email; ?></p>
    <p>This is the home page for the logged-in user.</p>
    <!-- Add more HTML content or functionality specific to the logged-in user -->

    <a href="logout.php">Logout</a>
</body>
</html>

<?php
} else {
    // User is not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}
?>

