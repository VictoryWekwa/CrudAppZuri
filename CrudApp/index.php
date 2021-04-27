<?php
$servername ="localhost";
$username ="root";
$password ="";
$database ="crudapp";

// create connection
$conn = new mysqli($servername,$username,$password,$database);
// Check connection
if ($conn -> connect_error) {
    die("Failed to Connect: " . $conn->connect_error);
} else 
echo "Connected Successfully";

?>