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

include("header2.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="../css/login.css">
</head>
<body>
<section class="signin">
  <div class="signin__card">
    <div class="logo" style="text-align: center">
      <img src="./image/internal_cafe_logo.png" >
    </div>

    <form method="post" action="login_sql.php" style="text-align:center;">
    
      <input type="text" name = "e_id" placeholder="Employee ID" style="border: 2px #D3D3D3 solid; border-radius: 10px;">
      <input type="password" name = "password" placeholder="Password" style="border: 2px #D3D3D3 solid; border-radius: 10px;">
      <button class ="sign_in" type="submit" name = "login_btn" value="Sign-UP">Sign In</button>
    </form>
  
    <div class="actions">
      <a href="./Find_PW.php" style="text-align: Right;">Find PW</a>
    </div>
  </div>
</section>
</body>
</html>