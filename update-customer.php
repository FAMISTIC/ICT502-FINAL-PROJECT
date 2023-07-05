<!DOCTYPE html>
<html>
<head>
    <title>Edit Customer</title>
</head>
<body>
    <h2>Edit Customer</h2>

    <?php
    // Include your Oracle connection code here
    // ...
	include_once 'connection.php';
    // Check if a customer ID is provided
    if (isset($_GET['customer_id'])) {
        $customer_id = $_GET['customer_id'];

        // Retrieve the customer data from the database
        $query = "SELECT * FROM customer WHERE customer_id = :customer_id";
        $stmt = oci_parse($connection, $query);
        oci_bind_by_name($stmt, ':customer_id', $customer_id);
        oci_execute($stmt);

        // Check if the customer exists
        if ($row = oci_fetch_assoc($stmt)) {
            $customer_name = $row['CUSTOMER_NAME'];
            $phone = $row['PHONE'];
            $email = $row['EMAIL'];
            $password = $row['PASSWORD'];

            // Display the customer edit form
            echo '<form action="update-process.php" method="POST">';
            echo '<input type="hidden" name="customer_id" value="' . $customer_id . '">';
            echo 'Customer Name: <input type="text" name="customer_name" value="' . $customer_name . '"><br>';
            echo 'Phone: <input type="text" name="phone" value="' . $phone . '"><br>';
            echo 'Email: <input type="email" name="email" value="' . $email . '"><br>';
            echo 'Password: <input type="password" name="password" value="' . $password . '"><br>';
            echo '<input type="submit" value="Update">';
            echo '</form>';
        } else {
            echo 'Customer not found.';
        }
    } else {
        echo 'Invalid request.';
    }

    // Close the Oracle connection
    oci_close($connection);
    ?>
</body>
</html>
