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
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internal Cafe - 주문 내역 조회</title>
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
    white-space: nowrap; 
    font-size: 16px;
    color: white;
}

.date-input button {
    padding: 5px;
}

.date-container button {
    padding: 8px 10px;
}

button:hover {
    color: black;
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
<body>
<div style="margin-left: 5%;">
<div style="display: flex;
        justify-content: right;
        width: 80%;
        margin-left: 20px;">
    <form method="post" style="width: 20%; display: flex; justify-content: space-between; margin-right: 20px; margin-top: 50px;">
        <div class="date-container" >
            <div class="date-input" style="margin-right: 20px;">
                <button type='submit'  id='comment' name='comment' value='만족' style='display: inline-block;'>만족</button>
            </div>
            <div class="date-input" style="margin-right: 20px;">
                <button type='submit'  id='comment' name='comment' value='보통' style='display: inline-block;'>보통</button>
            </div>
            <div class="date-input" style="margin-right: 20px;">
                <button type='submit'  id='comment' name='comment' value='불만족' style='display: inline-block;'>불만족</button>
            </div>
        </div>
        
    </form>
</div>



<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $comment = isset($_POST["comment"]) ? $_POST["comment"] : null;

    $e_id = $_SESSION['e_id'];
    $sql = "SELECT s.satis_id AS satis_id, s.date AS date, s.order_num AS order_num, c.comment AS comment, COUNT(quantity) AS menu_quantity
    FROM satisfaction s, comm c, includes i
    WHERE s.order_num = i.order_num 
    AND c.satis_id = s.satis_id
    AND c.comment = '$comment'
    AND s.e_id = $e_id
    GROUP BY i.order_num
    ORDER BY s.satis_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<div style='padding-bottom: 40px; width: 90%;
        padding: 20px;
        background-color: white;
        border-radius: 20px;
        '>";
        echo "<h2 style='font-size: 1.5em;'>만족도 평가 내역</h2>";
        echo "<table border='1'>";
        echo "<tr><th style='background-color:#5735327f;'>일시</th><th style='background-color:#5735327f;'>주문 번호</th><th style='background-color:#5735327f;'>메뉴 수량</th><th style='background-color:#5735327f;'>평가</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["date"] . "</td>";
            echo "<td>" . $row["order_num"] . "</td>";
            echo "<td>" . $row["menu_quantity"] . "</td>";
            echo "<td>" . $row["comment"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
        echo "<div>";
    } else {
        echo "<p style='margin-top: 30px;'>만족도 평가 내역이 없습니다.</p>";
    }
} else {
    $e_id = $_SESSION['e_id'];
    $sql = "SELECT s.satis_id AS satis_id, s.date AS date, s.order_num AS order_num, c.comment AS comment, COUNT(quantity) AS menu_quantity
    FROM satisfaction s, comm c, includes i
    WHERE s.order_num = i.order_num 
    AND c.satis_id = s.satis_id
    AND s.e_id = $e_id
    GROUP BY i.order_num
    ORDER BY s.satis_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<div style='padding-bottom: 40px; width: 90%;
        padding: 20px;
        background-color: white;
        border-radius: 20px;
        '>";
        echo "<h2 style='font-size: 1.5em;'>만족도 평가 내역</h2>";
        echo "<table border='1'>";
        echo "<tr><th style='background-color:#5735327f;'>일시</th><th style='background-color:#5735327f;'>주문 번호</th><th style='background-color:#5735327f;'>메뉴 수량</th><th style='background-color:#5735327f;'>평가</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["date"] . "</td>";
            echo "<td>" . $row["order_num"] . "</td>";
            echo "<td>" . $row["menu_quantity"] . "</td>";
            echo "<td>" . $row["comment"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
        echo "<div>";
    } else {
        echo "<p style='margin-top: 30px;'>만족도 평가 내역이 없습니다.</p>";
    }
    
}

$conn->close();
?>
</div>
<div class="btn" style="width: 100%;
    display: flex;
    justify-content: right;">
    <a href="my_page2.php" style="background-color: #5735327f;
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

<script>
    function viewOrderDetails(orderNum) {
        window.location.href = "order_history_detail.php?order_num=" + orderNum;
    }

    function evaluateOrder(orderNum) {
        window.location.href = "satis2.php?order_num=" + orderNum;
    }
</script>


</body>

</html>