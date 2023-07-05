<?php 
include 'connection.php';

$query = "SELECT customer_name, email, phone FROM customer WHERE customer_name='farhat' AND password='farhat14'";
$keeping = oci_parse($connection, $query);
$oci_execute($keeping);

while (oci_fetch($keeping)){
    echo oci_result($keeping, 'customer_name'). " is" ;
    echo oci_result($keeping, 'email'). " is" ;
    echo oci_result($keeping, 'phone'). " is" ;
}

oci_free_statement($keeping);
oci_close($keeping);


?>