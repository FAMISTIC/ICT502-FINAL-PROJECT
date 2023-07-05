<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <link rel="stylesheet" href="header.html">
    <h1>Login</h1>
    <?php 
        if(empty($_POST['customer_login'])) { ?> 
    <div class="container">
        <form action="" method="post">
            <div class="def-input">
                <label for="email" name="email">Email</label>
                <input type="email" name="email" placeholder="name@email.com">
            </div>
                <br>
            <div class="def-input">
                <label for="password" name="password">Password</label>
                <input type="password" name="customer_password" placeholder="Password">
            </div>
            <div class="forget">
                <link href="forgetpassword.php">
            </div>
            <div class="def-input">
                <input type="submit" name="customer_login" value="Login">
            </div>

        </form>
    </div>
    <?php } else{
            $email = $_POST['email'];
            $customer_password = $_POST['customer_password'];

            include 'connection.php';
            $query = "SELECT customer_name, email, phone FROM customer WHERE email='$email' AND password='$customer_password'";
            $keeping = oci_parse($connection, $query);

            $data = oci_fetch_array($keeping);
                    if(!empty($data['email'])){
                        echo "Logged In";
                        $_SESSION['customer_name'] = $data['customer_name'];

                        $_SESSION['email'] = $data['email'];
        
                        $_SESSION['phone'] = $data['phone'];
                        echo "<p>Name: ".$data['customer_name']."</p>";
                        echo "<p>Email:".$data['email']."</p>";
                        echo "<p>Phone:".$data['phone']."</p>";
                    }else{
                        
                      
                     }
                    
                }
            
         ?>
    <link rel="stylesheet" href="footer.html">
    
    
</body>
</html>