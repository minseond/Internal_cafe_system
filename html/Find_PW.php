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
  <style>
    .find_pw{
      color: white;
      background-color: black;
      border-radius: 20px;
      padding: 10px 20px;
      margin: 2% 0;
      font-size: 10pt;
    }
  </style>
</head>
<body>
  <?php include("header2.php"); ?>
<section class="signin">
  <div class="signin__card">
    <div class="logo" style="text-align: center">
      <img src="image/internal_cafe_logo.png" >
    </div>

    <form method="post" action="Find_PW_server.php" style="text-align:center";>

      <input type="text" name = "e_id" placeholder="Input ID" style="border: 2px #D3D3D3 solid; border-radius: 10px; height: 40px;">
      <input type="tel" name = "phone_number" placeholder="Input Phone Number" style="border: 2px #D3D3D3 solid; border-radius: 10px; height: 40px;">
      <button class="find_pw" type="submit" name = "login_btn" value="Sign-UP" style="border: 2px #D3D3D3 solid; border-radius: 10px;">Find-PW</button>
    </form>
  </div>
</section>

</body>
</html>