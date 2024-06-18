<?php
session_start();
$db = mysqli_connect("localhost:3306","root","sieun119!","company_internal_cafe");

  if(!$db)
  {
    echo "DB접속실패";
  }

  function mq($sql)
	{
		global $db;
		return $db->query($sql);
	}

if (!isset($_SESSION['e_id'])) {
    header("location: login.php");
    exit();
}

$e_id = $_SESSION['e_id'];
$query = "SELECT * FROM EMPLOYEE WHERE e_id = '$e_id'";
$result = mq($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $e_name = $row['e_name'];
    $title = $row['title'];
    $phone_number = $row['phone_number'];
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = isset($_POST['new_password']) ? mysqli_real_escape_string($db, $_POST['new_password']) : '';
    $new_phone_number = isset($_POST['new_phone_number']) ? mysqli_real_escape_string($db, $_POST['new_phone_number']) : '';
    $update_query = "UPDATE EMPLOYEE SET password = '$new_password', phone_number = '$new_phone_number' WHERE e_id = '$e_id'";
    mq($update_query);
    echo "<script>alert('Profile updated successfully.');</script>";

}
$db->close();
?>

<script>
    window.location.href = "my_page2.php";
</script>