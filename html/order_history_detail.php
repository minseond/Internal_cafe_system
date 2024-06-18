<?php
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
session_start();
// Check if the user is logged in
if (!isset($_SESSION['e_id'])) {
  header("location: login.php");
  exit();
}
include("header2.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internal Cafe - 주문 상세 내역 조회</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            text-align: center;
        }
        h1 {
            margin: 0;
        }

        .notice {
            background-color: #e6e6e6;
            padding: 10px;
            margin: 20px;
            border-radius: 8px;
        }

        .footer {
            background-color: #333;
            color: white;
            padding: 10px;
        }


        .menu-options-container {
            background-color: #f2f2f2;
            padding: 20px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .menu-options {
            display: flex;
            justify-content: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .menu-options a {
            color: #333;
            text-decoration: none;
            margin: 0 15px;
            font-size: 20px;
            font-weight: bold;
            transition: color 0.3s;
        }


        .menu-options a:hover {
            color: #8B4513;
        }


        form {
            margin: 20px 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .date-container {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
        }

        .date-input {
            text-align: left;
        }

        label {
            display: block;
            font-size: 18px;
            margin-bottom: 5px;
        }

        input[type="date"] {
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            height: 50px;
            font-size: 18px;
            background-color: white;
            color: black;
            border: none;
            border-radius: 5px;
            margin-top: 17px;
            padding: 0px 9px;
        }

        input[type="submit"]:hover {
            color: #5735327f;
        }

    
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #8B4513; 
            color: white;
        }

        td {
            background-color: white;
        }
        button {
            background-color: #5735327f;
            border: 1px solid #5735327f;
            border-radius: 5px;
            padding: 5px;
            margin-right: 20px;
        }

    </style>
</head>
<?php
$orderNum = $_GET['order_num']; 
$e_id = $_SESSION['e_id'];
$sql = "SELECT * FROM order_details_view WHERE order_num = $orderNum";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<div style='width: 95%; margin-left: 40px; display: flex; flex-flow: column; justify-content: center; align-items: center; padding: 20px; border-radius: 20px; background-color: white; margin-top: 9%; padding: 50px 0px;'>";
    echo "<h2 style='font-size: 1.5em;'>주문 상세 내역</h2>";
    echo "<table border='1'>";
    echo "<tr><th style='background-color:#5735327f;'>메뉴 이름</th><th style='background-color:#5735327f;'>메뉴 가격</th><th style='background-color:#5735327f;'>수량</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["menu_name"] . "</td>";
        echo "<td>" . $row["menu_price"] . "</td>";
        echo "<td>" . $row["quantity"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "</div>";
} else {
    echo "<p style='margin-top: 30px;'>주문 내역이 없습니다.</p>";
}

$conn->close();

?>
<div class="btn" style="width: 100%;
    display: flex;
    justify-content: right;">
    <a href="order_history.php" style="background-color: #5735327f;
    color: white;
    border-radius: 5px;
    justify-content: right;
    align-items: center;
    display: flex;
    padding: 8px;
    border: none;
    cursor: pointer;
    font-size: 15px;
    text-decoration: none;
    width: 79px;
    margin-right: 160px;
    margin-top: 20px;">돌아가기</a>
</div> 
</body>
</html>
