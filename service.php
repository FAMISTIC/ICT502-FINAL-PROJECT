<?php
include_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


	$model = $_POST['model'];
	$colour = $_POST['colour'];
	$plate = $_POST['plate'];
    
    $query2 = "SELECT * FROM vehicle WHERE plate = :plate";
	$stmt2 = oci_parse($connection, $query2);

    if ( oci_fetch($stmt2)) {
        // Username or email already exists
        echo 'Username or email already taken.';
    } else {

		
    // Insert the new user into the database
	if(isset($_POST['save'])){	
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