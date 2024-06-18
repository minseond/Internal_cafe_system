<?php
$host = "localhost";
$username = "root";
$password = "sieun119!";
$database = "company_internal_cafe";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
$e_id = $_SESSION['e_id'];

$query = "SELECT menu_name, quantity, price, quantity_price, SUM(quantity_price) AS total_amount
        FROM cart
        GROUP BY menu_name"; 
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $total_amount = 0;

    $insert_query_order2 = "INSERT INTO `order2` (total_amount, e_id) 
                 VALUES ('$total_amount', $e_id)";

    if ($conn->query($insert_query_order2) !== TRUE) {
        echo "Error inserting record into order2: " . $conn->error;
    } else {
        $order_num = $conn->insert_id;

        while ($row = $result->fetch_assoc()) {
            $menu_name = $row["menu_name"];
            $quantity = $row["quantity"];
            $price = $row["price"];
            $quantity_price = $row["quantity_price"];

            $insert_query_includes = "INSERT INTO `includes` (order_num, menu_id, quantity) 
                VALUES ('$order_num', (SELECT menu_id FROM menu2 WHERE menu_name = '$menu_name'), '$quantity')";
            if ($conn->query($insert_query_includes) !== TRUE) {
                echo "Error inserting record into includes: " . $conn->error;
            }

            $total_amount += $quantity_price; 
        }

        $update_query_order2 = "UPDATE `order2` SET total_amount = '$total_amount' WHERE order_num = '$order_num'";
        if ($conn->query($update_query_order2) !== TRUE) {
            echo "Error updating record in order2: " . $conn->error;
        }

        $delete_query = "DELETE FROM cart";
        if ($conn->query($delete_query) !== TRUE) {
            echo "Error deleting record from cart: " . $conn->error;
        }

        $current_amount_query = 
            "SELECT final_amount 
            FROM mileage 
            WHERE e_id = '$e_id' 
            ORDER BY useTimestamp 
            DESC LIMIT 1";
        $current_amount_result = $conn->query($current_amount_query);

        if ($current_amount_result->num_rows > 0) {
            $current_amount_row = $current_amount_result->fetch_assoc();
            $current_amount = $current_amount_row["final_amount"];

            $mileage_deduction_query = "INSERT INTO `mileage` (e_id, current_amount, amount, order_num, final_amount) 
                VALUES ($e_id, '$current_amount', '$total_amount', $order_num, $current_amount-$total_amount)";

            if ($conn->query($mileage_deduction_query) !== TRUE) {
                echo "Error inserting mileage deduction record: " . $conn->error;
            }
        } else {
            echo "Error fetching current_amount from mileage: " . $conn->error;
        }

        echo "<script>alert('주문이 성공적으로 완료되었습니다.');</script>";
    }
} else {
    echo "<script>alert('장바구니가 비어있습니다.');</script>";
}

$conn->close();
?>

<script>
    window.location.href = "main2.php";
</script>
