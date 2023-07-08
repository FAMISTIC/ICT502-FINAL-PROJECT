<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['customer_name']) && isset($_SESSION['email'])) {
    // Retrieve the user information from the session variables
    $customer_name = $_SESSION['customer_name'];
    $email = $_SESSION['email'];

    if (isset($_POST['logout'])) {
        // Clear all session variables
        $_SESSION = array();

        // Destroy the session
        session_destroy();

        // Redirect to the login page
        header("Location: index.php");
        exit();
    }
} else {
    // User is not logged in, redirect to the login page

}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Appointment</title>
</head>
<body>
  <h1>Create Appointment</h1>
<?php if (isset($customer_name) && isset($email)) { ?>
        <h2>Welcome, <?php echo $customer_name; ?>!</h2>
        <p>Email: <?php echo $email; ?></p>
        <!-- Add more HTML content or functionality specific to the logged-in user -->
        <form>
          <label for="name">Name</label>
          <br>
          <input type="text" id="customer_name" name="customer_name" value="<?php echo $customer_name; ?>">
          <br>
          <label for="package">Package</label>
          <br>
          <select id="package" name="package">
            <option value="basic">Basic</option>
            <option value="premium">Premium</option>
            <option value="enterprise">Enterprise</option>
            <option value="business">Business</option>
          </select>
          <br>
          Model: <br>
          <input type="text" name="model">
          <br>
          Colour: <br>
          <input type="text" name="colour">
          <br>
          Plate: <br>
          <input type="text" name="plate">
          <br><br>
          <input type="submit" name="save" value="submit">
           <br>
          <label for="date">Date</label>
          <br>
          <input type="date" id="appointment_date" name="appointment_date">
          <input type="submit" name="submit" value="Submit">
        </form>        
        <!-- Logout form -->
        <form method="post">
            <button type="submit" name="logout">Logout</button>
        </form>
    <?php } else { ?>
        <p>You are not logged in.</p>
        <!-- Login button -->
        <a href="login-customer.html">Login</a>
        <a href="register-customer-vehicle.html">Register</a>
    <?php } ?>
</body>
</html>
