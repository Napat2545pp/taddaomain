<?php
$servername = "localhost"; 
$username = "root"; 
$password = "";
$dbname = "taddao"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}
?>
