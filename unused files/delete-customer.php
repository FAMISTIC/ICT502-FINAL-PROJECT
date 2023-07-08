<!DOCTYPE html>
<html>
<head>
    <title>Delete Customer</title>
</head>
<body>
    <h2>Delete Customer</h2>

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

            // Display the customer information
            echo '<p>Are you sure you want to delete the following customer?</p>';
            echo '<p><strong>Customer ID:</strong> ' . $customer_id . '</p>';
            echo '<p><strong>Customer Name:</strong> ' . $customer_name . '</p>';
            echo '<p><strong>Phone:</strong> ' . $phone . '</p>';
            echo '<p><strong>Email:</strong> ' . $email . '</p>';

            // Display the delete confirmation form
            echo '<form action="delete-customer-process.php" method="POST">';
            echo '<input type="hidden" name="customer_id" value="' . $customer_id . '">';
            echo '<input type="submit" value="Delete">';
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
