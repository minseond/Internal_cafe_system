<?php
session_start();
include('db.php');

$user_id = mysqli_real_escape_string($db,$_POST['e_id']);
$user_phone = mysqli_real_escape_string($db,$_POST['phone_number']);

$sql = "SELECT * from employee WHERE e_id = '$user_id' and phone_number = '$user_phone'";
$result = mysqli_query($db,$sql);

if(mysqli_num_rows($result) === 1)
{
  $row = mysqli_fetch_assoc($result);
  $hash = $row['password'];
  echo "<script>alert('비밀번호는 {$hash} 입니다.');
  location.replace('./login.php');
  </script>";

}
else
{
  echo "<script>
        alert('아이디 혹은 비밀번호를 확인하세요.');
        location.replace('./login.php');
        </script>";
}
?>