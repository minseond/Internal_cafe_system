<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Detail</title>
    <link rel="stylesheet" href="../css/menu_detail.css?after">
</head>
<body>
<?php include("header2.php"); ?>
<div class="big-box">
<?php
if (isset($_GET['menu_name'])) {
    $menu_name = $_GET['menu_name'];

    $host = "localhost:3306";
    $username = "root";
    $password = "sieun119!";
    $database = "company_internal_cafe";

    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT * FROM menu2 WHERE menu_name = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("s", $menu_name);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $menu_name = $row["menu_name"];
            $menu_img = $row["menu_img"];
            $menu_price = $row["menu_price"];
            $menu_detail = $row["menu_detail"];
            $menu_tag = $row["menu_tag"];

            echo "<div class='small-box'>";
            echo "<div class='menu_name'>";
            echo "<h1>$menu_tag</h1>";
            echo "</div>";
            echo "<div class='menu-detail-box'>";
            echo "<div class='menu_img'>";
            echo "<img src='$menu_img' alt='$menu_name'>";
            echo "</div>";
            echo "<div class='menu_detail'>";
            echo "<h1>$menu_name</h1>";
            echo "<hr>";
            echo "<p>$menu_detail</p>";
            echo "<hr id='hr'>";
            echo "<p id='price'>가격: $menu_price</p>";
            echo "<div class='submit'>";
            echo "<a href='main2.php'>돌아가기</a>";
            echo "<form action='order2.php' method='post'>";
            echo "<input type='hidden' name='menu_name' value='$menu_name'>";
            echo "<label for='menu_quantity'>수량:</label>";
            echo "<select name='menu_quantity' id='quantity'>";
            for ($menu_quantity = 1; $menu_quantity <= 5; $menu_quantity++) {
                echo "<option value='$menu_quantity'>$menu_quantity</option>";
            }
            echo "</select>";
            echo "<input type='submit' value='담기'>";
            echo "</form>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            
        } else {
            echo "<p>메뉴를 찾을 수 없습니다.</p>";
        }

        $stmt->close();
    } else {
        echo "Error in preparing the SQL statement.";
    }
    $conn->close();
} else {
    echo "<p>메뉴를 선택해주세요.</p>";
}
?>
</body>
</html>
