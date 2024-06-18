<?php
$servername = "localhost:3306";
$username = "root";
$password = "sieun119!";
$database = "company_internal_cafe";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
include("header2.php");
?>

<?php
$orderNum = isset($_GET['order_num']) ? $_GET['order_num'] : null;
$orderNum = $_GET['order_num']; 

$sql = "SELECT * FROM order2;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<div style='width: 95%;
    margin-left: 40px;
    display: flex;
    flex-flow: column;
    justify-content: center;
    align-items: center;
    padding: 20px;
    border-radius: 20px;
    background-color: white;
    margin-top: 12%;
    padding: 50px 0px;
    '>";
    echo "<h2>전반적인 만족도는 어떠셨나요?</h2>";
    echo "<form method='post' action='submit_rating.php'>";
    echo "<input type='hidden' name='order_num' value='" . $orderNum . "'>"; 

    echo "<div class='rating-buttons'>";
    echo "<button type='submit' class='satisfaction-button btn btn--white' id='comment' name='comment' value='만족'>만족</button>";
    echo "<button type='submit' class='satisfaction-button btn btn--white' id='comment' name='comment' value='보통'>보통</button>";
    echo "<button type='submit' class='satisfaction-button btn btn--white' id='comment' name='comment' value='불만족'>불만족</button>";
    echo "</div>";
    echo "</form>";
    echo "</div>";
} else {
    echo "주문 내역이 없습니다.";
}

$conn->close();
?>

<script>
    function satisfaction(satisfactionLevel) {
        document.querySelector('input[name="satisfaction"]').value = satisfactionLevel;

        document.forms[0].submit();
    }
</script>
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



