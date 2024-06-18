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
<body>
<div style="margin-left: 5%;">
    <div style="display: flex;
        justify-content: right;
        width: 80%;
        margin-left: 20px;">
        <form method="post" style="width: 20%; display: flex; justify-content: space-between; margin-right: 20px; margin-top: 50px;">
            <div class="date-container" >
                <div class="date-input" style="margin-right: 20px;">
                    <label for="start_date">시작 날짜:<input type="date" name="start_date"></label>
                    
                </div>
                <div class="date-input" style="margin-right: 20px;">
                    <label for="end_date">종료 날짜: <input type="date" name="end_date"></label>
                    
                </div>
                <input type="submit" value="조회">
            </div>
            
        </form>
    </div>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $start_date = isset($_POST["start_date"]) ? $_POST["start_date"] : null;
        $end_date = isset($_POST["end_date"]) ? $_POST["end_date"] : null;

$e_id = $_SESSION['e_id'];
$sql = "SELECT * FROM order2 WHERE e_id = '$e_id'
        AND order_num > 12";

if (!empty($start_date) && !empty($end_date)) {
    $end_date = date("Y-m-d", strtotime($end_date . ' +1 day'));
    $sql .= " AND order_date BETWEEN '$start_date' AND '$end_date'";
}

$result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<div style='padding-bottom: 40px; width: 90%;
            padding: 20px;
            background-color: white;
            border-radius: 20px;
            '>";
            echo "<h2 style='font-size: 1.5em;'>주문 내역</h2>";
            echo "<table border='1'>";
            echo "<tr><th style='background-color:#5735327f;'>가격</th><th style='background-color:#5735327f;'>주문 일자</th><th style='background-color:#5735327f;'></th><th style='background-color:#5735327f;'></th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["total_amount"] . "</td>";
                echo "<td>" . $row["order_date"] . "</td>";
        
                $orderNum = $row["order_num"];
                $evaluationCheckSql = "SELECT * FROM satisfaction WHERE order_num = $orderNum";
                $evaluationResult = $conn->query($evaluationCheckSql);

                if ($evaluationResult->num_rows == 0) {
                    echo "<td>";
                    echo "<button onclick=\"viewOrderDetails($orderNum)\">주문 상세 보기</button>";
                    echo "</td>";
                    echo "<td>";
                    echo "<button onclick=\"evaluateOrder($orderNum)\">평가</button>";
                    echo "</td>";
                } else {
                    echo "<td>";
                    echo "<button onclick=\"viewOrderDetails($orderNum)\">주문 상세 보기</button>";
                    echo "</td>";
                    echo "<td>";
                    echo "<button disabled onclick=\"evaluateOrder($orderNum)\" style='background-color: black; color: white'>평가</button>";
                    echo "</td>";
                }
        
                
                echo "</tr>";
            }
        
            echo "</table>";
            echo "<div>";
        } else {
            echo "주문 내역이 없습니다.";
        }
    } else {
        $e_id = $_SESSION['e_id'];
        $sql = "SELECT * FROM order2 WHERE e_id = '$e_id'  
                AND order_num > 12";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<div style='padding-bottom: 40px; width: 90%;
            padding: 20px;
            border-radius: 20px;
            background-color: white;
            '>";
            echo "<h2 style='font-size: 1.5em;'>주문 내역</h2>";
            echo "<table border='1'>";
            echo "<tr><th  style='background-color:#5735327f;'>주문 일자</th><th style='background-color:#5735327f;'>가격</th><th style='background-color:#5735327f;'></th><th style='background-color:#5735327f;'></th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["order_date"] . "</td>";
                echo "<td>" . $row["total_amount"] . "</td>";
                
                $orderNum = $row["order_num"];
                $evaluationCheckSql = "SELECT * FROM satisfaction WHERE order_num = $orderNum";
                $evaluationResult = $conn->query($evaluationCheckSql);

                if ($evaluationResult->num_rows == 0) {
                    echo "<td>";
                    echo "<button onclick=\"viewOrderDetails($orderNum)\">주문 상세 보기</button>";
                    echo "</td>";
                    echo "<td>";
                    echo "<button onclick=\"evaluateOrder($orderNum)\">평가</button>";
                    echo "</td>";
                } else {
                    echo "<td>";
                    echo "<button onclick=\"viewOrderDetails($orderNum)\">주문 상세 보기</button>";
                    echo "</td>";
                    echo "<td>";
                    echo "<button disabled onclick=\"evaluateOrder($orderNum)\" style='background-color: black; color: white'>평가</button>";
                    echo "</td>";
                }
                
                echo "</tr>";
            }

            echo "</table>";
            echo "<div>";
        } else {
            echo "주문 내역이 없습니다.";
        }
        
    }
    
    $conn->close();
    ?>
</div>

<script>
    function viewOrderDetails(orderNum) {
        window.location.href = "order_history_detail.php?order_num=" + orderNum;
    }

    function evaluateOrder(orderNum) {
        window.location.href = "satis2.php?order_num=" + orderNum;
    }
</script>
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
</body>
</html>