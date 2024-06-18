<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Internal Cafe System</title>
    <link rel="stylesheet" href="../css/main.css?after">
    <script src="https://kit.fontawesome.com/7667d4618a.js" crossorigin="anonymous"></script>
</head>
<?php 
session_start();
if (!isset($_SESSION['e_id'])) {
    header("location: login.php");
    exit();
    }
include("header2.php");

$conn = mysqli_connect("localhost:3306","root","sieun119!","company_internal_cafe");

if(!$conn)
{
echo "DB접속실패";
}

function mq($sql)
{
    global $conn;
    return $conn->query($sql);
}
?>

<body>

    <div class="main">
        <div class="menu-list">
        <?php
            $sql = "SELECT * FROM menu2";
            $result = $conn->query($sql);
            $count = 0;

            if ($result->num_rows > 0) {
                 echo "<div class='menu-row'>"; 
                 while ($row = $result->fetch_assoc()) {
                     echo "<div class='menu-list-box'>";
                     $menu_name = $row["menu_name"];
                     echo "<a href='menu_detail2.php?menu_name=$menu_name'>";
                     echo "<div class='menu-img'>";
                     $imagePath = $row["menu_img"];
                     echo "<img src='$imagePath' alt='Image'>";
                     echo "</div>";
                     echo "<div class='menu-price' style='font-size: 16px;
                     margin-top: 4px;'>";
                     echo "<span id='name'>" . $row["menu_name"] . "</span>";
                     echo "<span id='price'>" . $row["menu_price"] . "</span>";
                     echo "</div>";
                     echo "</a>";
                     echo "</div>";
             
                     $count++; 
             
                     if ($count % 5 == 0) {
                         echo "</div><div class='menu-row'>";
                     }
                 }
                 echo "</div>"; 
             } else {
                 echo "메뉴가 없습니다.";
            }
            ?>
        </div>
        <div class="order-list">
            <span>product order list</span>
            <div class="order-detail">
                <?php
                $query = "SELECT menu_name, quantity, quantity_price, price
                        FROM cart";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    echo "<table border='1'>";
                    echo "<tr><th>메뉴</th><th>수량</th><th>금액</th></tr>";
                    
                    while ($row = $result->fetch_assoc()) {
                        $menu_name = $row["menu_name"];
                        $quantity = $row["quantity"];
                        $price = $row["price"];
                        
                        echo "<tr>";
                        echo "<td>$menu_name</td>";
                        echo "<td>$quantity</td>";
                        echo "<td>$price</td>";
                        echo "</tr>";
                    }

                    echo "</table>";
                } else {
                    echo "<p style='margin-top: 30px;'>장바구니가 비어 있습니다.</p>";
                }
                ?>
            </div>
            
            <div class="delete_all" >
                <form action="delete_all_menus.php" method="post">
                    <button type="submit">전체 메뉴 삭제</button>
                </form>
            </div>
            
            <?php
            $query = "SELECT SUM(quantity_price) AS total_price
                    FROM cart";

            $result = $conn->query($query);
            
            if ($result->num_rows > 0 ) {
                $row = $result->fetch_assoc();
                $total_price = $row["total_price"];
                if($total_price === NULL) {
                    $total_price = 0;
                }
                echo "<div class='total_price'>$total_price 원</div>";   
            }
            $conn->close();
            ?>

            
            <div class="place-order"> 
                <form action="order_complete2.php" method="post">
                    <button class="order_complete" type="submit">주문하기</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>