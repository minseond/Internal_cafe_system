<?php
session_start();
include('db.php');

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['e_id']; 

$drink_rating = $_POST['drink_rating'];
$comments = $_POST['comments'];

$sql = "INSERT INTO satisfaction_data (user_id, drink_rating, comments) VALUES ('$user_id', '$drink_rating', '$comments')";

if ($conn->query($sql) === TRUE) {
    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>