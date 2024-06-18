<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/my_page.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap">
    <title>Company Internal Cafe System</title>
    
    <style>
.activity-icon {
    text-align: center;
    padding: 20px;
    position: relative;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.activity-icon h3 {
    position: sticky;
    top: 0;
    background-color: #fff;
    z-index: 1;
    margin: 0;
    padding: 10px;
    border-bottom: 1px solid #ddd;
    border-radius: 10px 10px 0 0;
}

.activity-icon a {
    text-decoration: none;
    color: black;
}

.activity-icon a:hover {
    text-decoration: none;
    color: black;
}

.activity-icon table {
    width: 100%; 
    border-collapse: collapse;
    margin-top: 15px;
    margin-bottom: 20px;
    overflow-y: auto;
    
}


.activity-icon th,
.activity-icon td {
    border: 1px solid #ddd;
    padding: 8px;
    font-size: 14px; 
}

.activity-icon td {
    border: 1px solid #ddd;
    padding: 8px;
    font-size: 14px;
    height: 50px; 
    overflow: hidden;
    text-overflow: ellipsis;
}


.activity-icon th {
    background-color: #f2f2f2;
}

.activity-icon td span {
    display: block;
    white-space: normal; 
    overflow: hidden;
    text-overflow: ellipsis;
}



    </style>
</head>

<body>
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
    if ($result) {
        $userData = $result->fetch_assoc();
    } else {
        $userData = null;
    }
    ?>
    <?php include("header2.php"); ?>
    
    <section id="user-info">
        <?php
        if ($userData) { 
            echo '<div class="profile_main">';
            $imagePath = $userData['img'];
            echo '<div class="profile_img">';
            echo '<div id="profile-picture">';
            echo "<img src='$imagePath' alt='Image'>";
            echo '</div>';
            echo '</div>';
            echo '<div id="user-details">';
            echo '<h2 id="e_name">' . $userData['e_name'] . '</h2>';
            echo '<p id="e_id">' . $userData['e_id'] . '</p>';
            echo '<p id="phone_number">' . $userData['phone_number'] . '</p>';
            echo '<p id="title">' . $userData['title'] . '</p>';
            echo '</div>';
            echo '<div class="edit_profile">'; 
            echo '<form action="edit_profile.php" method="post">';
            echo '<button class="edit" type="submit">개인정보 수정</button>';
            echo '</form>';
            echo '</div>';
            echo '<div id="user-links">';
            echo '<form action="main2.php" method="post">';
            echo '<button id="order-button" type="submit"><i class="fas fa-shopping-cart"></i>주문하러 가기</button>';
            echo '</form>';
            echo '</div>';
            echo '</div>';
    } else {
        echo '사용자 정보를 가져오지 못했습니다.';
    }
    ?>
    
    <div class="user-activities-container">
        <div class="user-activities-icon">
            <div class="activity-icon" onclick="toggleSection('mileage-history')">
                <a href="mileageHistory.php">
                    <i class="fas fa-coins"></i>
                    <span>Mileage History</span>
                    <?php
                    $host = "localhost:3306";
                    $username = "root";
                    $password = "sieun119!";
                    $database = "company_internal_cafe";

                    $conn = new mysqli($host, $username, $password, $database);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $e_id = $_SESSION['e_id'];

                    $query = 
                    "SELECT m_id, useTimestamp, current_amount, amount, final_amount
                    FROM (
                        SELECT m_id, useTimestamp, current_amount, amount, final_amount
                        FROM mileage
                        WHERE e_id = '$e_id'
                        ORDER BY useTimestamp DESC
                        LIMIT 6
                    ) AS recent_mileage
                    ORDER BY useTimestamp ASC";

                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        echo "<table border='1'>
                                <tr >
                                    <th style='background-color:#5735327f; color:white;'>Date</th>
                                    <th style='background-color:#5735327f; color:white;'>Use Mileage</th>
                                    <th style='background-color:#5735327f; color:white;'>Final Mileage</th>
                                </tr>";

                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row["useTimestamp"] . "</td>
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
                </a>
            </div>
            <div class="activity-icon" onclick="goToOrderHistory()">
                <a href="order_history.php">   
                    <i class="fas fa-shopping-bag"></i>
                    <span>Order History</span>
                    <?php
                        $host = "localhost:3306";
                        $username = "root";
                        $password = "sieun119!";
                        $database = "company_internal_cafe";
                    
                        $conn = new mysqli($host, $username, $password, $database);
                        
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        
                        $e_id = $_SESSION['e_id'];
                        $sql = 
                        "SELECT recent_orders.order_num, recent_orders.total_amount, recent_orders.order_date, recent_orders.menu_names
                        FROM (
                            SELECT o.order_num, o.total_amount, o.order_date, GROUP_CONCAT(m.menu_name SEPARATOR ', ') AS menu_names
                            FROM includes i
                            JOIN menu2 m ON i.menu_id = m.menu_id
                            JOIN order2 o ON i.order_num = o.order_num
                            AND o.e_id = $e_id
                            GROUP BY o.order_num, o.total_amount, o.order_date
                            ORDER BY o.order_num DESC
                            LIMIT 5
                        ) AS recent_orders
                        ORDER BY recent_orders.order_num ASC
                        ";
                    
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                        echo "<table border='1'>";
                        
                        echo "<tr><th style='background-color:#5735327f; color:white;'>Date</th><th style='background-color:#5735327f; color:white;'>Menu</th><th style='background-color:#5735327f; color:white;'>Price</th></tr>";
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["order_date"] . "</td>";
                            echo "<td><span>" . $row["menu_names"] . "</span></td>";
                            echo "<td>" . $row["total_amount"] . "</td>";
                            echo "</tr>";
                        }
                    
                        echo "</table>";
                    } else {
                        echo "<p style='margin-top: 30px;'>주문 내역이 없습니다.</p>";
                    }
                ?>
                </a>
            </div>
            <div class="activity-icon" onclick="#">
                <a href="satis_look2.php">
                    <i class="fas fa-shopping-bag"></i>
                    <span>Satisfaction 평가</span>
                    <?php
                        $host = "localhost:3306";
                        $username = "root";
                        $password = "sieun119!";
                        $database = "company_internal_cafe";
                    
                        $conn = new mysqli($host, $username, $password, $database);
                        
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        
                        $e_id = $_SESSION['e_id'];
                        $sql = "SELECT recent_satisfaction.satis_id, recent_satisfaction.date, recent_satisfaction.order_num, recent_satisfaction.comment, recent_satisfaction.menu_quantity
                        FROM (
                            SELECT s.satis_id, s.date, s.order_num, c.comment, COUNT(i.quantity) AS menu_quantity
                            FROM satisfaction s
                            JOIN comm c ON s.satis_id = c.satis_id
                            JOIN includes i ON s.order_num = i.order_num
                            WHERE s.e_id = $e_id
                            GROUP BY s.satis_id, s.date, s.order_num, c.comment
                            ORDER BY s.satis_id DESC
                            LIMIT 6
                        ) AS recent_satisfaction
                        ORDER BY recent_satisfaction.satis_id ASC;
                        ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th style='background-color:#5735327f; color:white;'>order Num</th><th style='background-color:#5735327f; color:white;'>Date</th><th style='background-color:#5735327f; color:white;'>Satisfaction</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["order_num"] . "</td>";
            echo "<td>" . $row["date"] . "</td>";
            echo "<td>" . $row["comment"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
        echo "<div>";
    } else {
        echo "<p style='margin-top: 30px;'>만족도 평가 내역이 없습니다.</p>";
    }
?>
</a>

    </div>
    </div>
        </div>
    </div>
    </section>
</body>
</html>

