<?php
$servername = "localhost:3306";
$username = "root";
$password = "sieun119!";
$database = "company_internal_cafe";

$conn = new mysqli($servername, $username, $password);

if($conn->connect_error){
    die("Connection failed: "+$conn->connect_error);
} else {
    // echo "Success! </br>";
}
?>