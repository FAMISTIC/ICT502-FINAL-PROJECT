<?php 

$hostname = "localhost/XE";
$username = "system";
$password = "system";

$connection = oci_connect($username, $password, $hostname);

if(!$connection){
    echo "Failed connected to database";

}else{
    echo "Connected to database";

}

?>