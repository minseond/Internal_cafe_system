<?php
$host = "localhost";
$username = "root";
$password = "sieun119!";
$database = "company_internal_cafe";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['menu_name'])) {
    $menu_name = $_POST['menu_name'];
    $menu_quantity = $_POST['menu_quantity'];

    $query = "SELECT menu_id, menu_name, menu_price FROM menu2 WHERE menu_name = '$menu_name'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $check_query = "SELECT menu_id, quantity FROM cart WHERE menu_name = '$menu_name'";
        $check_result = $conn->query($check_query);

        if ($check_result->num_rows > 0) {
            $row = $check_result->fetch_assoc(); 
            $menu_id = $row["menu_id"];
            $existing_quantity = $row["quantity"];

            $update_quantity = $existing_quantity + $menu_quantity;

            $update_query = "UPDATE cart SET quantity = $update_quantity WHERE menu_id = $menu_id";

        if ($conn->query($update_query) === TRUE) {
            echo "<script>alert('수량이 증가되었습니다.');</script>";
            } else {    
                    echo "Error updating record: " . $conn->error;
                }
        } else {
            $row = $result->fetch_assoc();
            $menu_id = $row["menu_id"];
            $menu_name = $row["menu_name"];
            $menu_price = $row["menu_price"];

            $insert_query = "INSERT INTO cart (menu_id, menu_name, price, quantity, quantity_price) VALUES (
                $menu_id, '$menu_name', '$menu_price', $menu_quantity, $menu_price*$menu_quantity
            )";

            if ($conn->query($insert_query) === TRUE) {
                echo "<script>alert('새로운 메뉴가 추가되었습니다.');</script>";
            } else {
                echo "Error inserting record: " . $conn->error;
            }
        }
    } else {
        echo "해당하는 메뉴가 없습니다.";
    }
}

$conn->close();
?>

<script>
    window.location.href = "main2.php";
</script>