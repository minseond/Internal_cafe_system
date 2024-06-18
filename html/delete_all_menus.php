<?php
// 데이터베이스 연결 설정
$host = "localhost";
$username = "root";
$password = "sieun119!";
$database = "company_internal_cafe";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 전체 메뉴 삭제
$delete_all_query = "DELETE FROM cart";

if ($conn->query($delete_all_query) === TRUE) {
    echo "<script>alert('모든 메뉴가 장바구니에서 삭제되었습니다.');</script>";} 
    else { "<script>alert('Error deleting records: '); '.  $conn->error; </script>";
    }

$conn->close();
?>

<script>
    window.location.href = "main2.php";
</script>
