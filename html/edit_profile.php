<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/edit_profile.css?after">
    <title>Edit Profile</title>
    <style>
        .btn5 a:hover {
            color: black;
        }
    </style>
</head>

<body>
<?php
$servername = "localhost:3306";
$username = "root";
$password = "sieun119!";
$database = "company_internal_cafe";

$conn = new mysqli($servername, $username, $password, $database);
session_start();
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
include("header2.php");

    $e_id = $_SESSION['e_id'];
    $query = "SELECT * FROM EMPLOYEE WHERE e_id = '$e_id'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $e_name = $row['e_name'];
        $title = $row['title'];
        $phone_number = $row['phone_number'];
        $password = $row['password'];
        }
    }
?>
    <div class="edit_bigbox">
        <div class="edit_box">
            <h2>Edit Profile</h2>
            <form method="post" action="edit_profile_complete.php">
                <label for="e_id">Employee ID:</label>
                <input type="text" name="e_id" value="<?php echo $e_id; ?>" readonly><br>

                <label for="e_name">Employee Name:</label>
                <input type="text" name="e_name" value="<?php echo $e_name; ?>" readonly><br>

                <label for="title">Title:</label>
                <input type="text" name="title" value="<?php echo $title; ?>" readonly><br>

                <label for="new_password">New Password:</label>
                <input type="password" name="new_password" placeholder="Enter new password" value="<?php echo $password; ?>"><br>

                <label for="new_phone_number" >New Phone Number:</label>
                <input type="text" name="new_phone_number"  placeholder="<?php echo $phone_number; ?>" value="<?php echo $phone_number; ?>"><br>
                <div class="btn5" style="width: 100%; margin-top: -3px;
    display: flex;">
                    <a href="my_page2.php" style="height: 35px; text-decoration-line: none;">돌아가기</a>
                    <button class="edit_profile_complete" type="submit" style="height: 35px;">수정하기</button>
                    
                </div> 
            </form>
        </div>
    </div>
</body>
</html>
