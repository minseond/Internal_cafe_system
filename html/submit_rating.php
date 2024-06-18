<?php
$servername = "localhost:3306";
$username = "root";
$password = "sieun119!";
$database = "company_internal_cafe";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();
$user_id = $_SESSION['e_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $orderNum = $_POST['order_num']; 
    $satisfactionLevel = $_POST['comment']; 

    $insertSatisfactionQuery = "INSERT INTO satisfaction (order_num, date, e_id) VALUES ('$orderNum', NOW(), $user_id)";

    if ($conn->query($insertSatisfactionQuery) === TRUE) {
        echo "Satisfaction data inserted successfully";
    } else {
        echo "Error: " . $insertSatisfactionQuery . "<br>" . $conn->error;
    }

    $lastInsertId = $conn->insert_id; 


    $insertCommQuery = "INSERT INTO comm (satis_id, comment) VALUES ('$lastInsertId', '$satisfactionLevel')";

    if ($conn->query($insertCommQuery) === TRUE) {
        echo "Comment data inserted successfully";
    } else {
        echo "Error inserting comment data: " . $conn->error;
    }
}

$conn->close();
?>

<script>
    window.location.href = "order_history.php";
</script>
