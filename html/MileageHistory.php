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
    <title>Mileage Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    
        h2 {
            color: black;
        }

        form {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #000;
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


        
.container {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    border-radius: 10px;
}
.btn a {
    background-color: #5735327f;
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
    margin-top: 20px;
}

.btn {
    width: 100%;
    display: flex;
    justify-content: right;
}
a:hover {
    color: black;
}

.btn:hover { 
    background-color: transparent;
}
    </style>
</head>

<body style="background-color: #5735327f;">
<div class="container" style="background-color: white;     margin-top: 50px;">
<h2 style="display: flex;
    justify-content: center;
    font-size: 1.5em;">Mileage History</h2>
<?php
$e_id = $_SESSION['e_id'];


$query = "SELECT useTimestamp, current_amount, amount, final_amount
          FROM mileage
          WHERE e_id = $e_id
          ORDER BY useTimestamp ASC";

$result = $conn->query($query);


if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                
                <th style='background-color:#5735327f;'>Date</th>
                <th style='background-color:#5735327f;'>Before Usage</th>
                <th style='background-color:#5735327f;'>Use Mileage</th>
                <th style='background-color:#5735327f;'>Remaining Mileage</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>

                <td>" . $row["useTimestamp"] . "</td>
                <td>" . $row["current_amount"] . "</td>
                <td>" . $row["amount"] . "</td>
                <td>" . $row["final_amount"] . "</td>
            </tr>";
    }

    echo "</table>";
} else {
    echo "<p style='margin-top: 30px;'>마일리지 사용 내역이 없습니다.</p>";
}

$conn->close();
?>

</div>
<div class="btn" style="">
    <a href="my_page2.php">돌아가기</a>
</div> 
</body>
</html>
