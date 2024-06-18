
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="../css/home.css">
  <link rel="stylesheet" href="css/footer.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <script src="js/jquery.cycle2.min.js"></script>
  <script defer src="js/main.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.8.0/ScrollToPlugin.min.js" integrity="sha512-eI+25yMAnyrpomQoYCqvHBmY4dLfqKWPnD4j8y0E3Js+yqpF26xncL4t81M1zxC+ISYfRoCN52rN/n0q2UIBZQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.8.0/gsap.min.js" integrity="sha512-eP6ippJojIKXKO8EPLtsUMS+/sAGHGo1UN/38swqZa1ypfcD4I0V/ac5G3VzaHfDaklFmQLEs51lhkkVaqg60Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  
  <script>
    $( document ).ready( function() {
        $( '#main_title' ).fadeIn('slow');
      } );  
  </script>

    <style>
        html {
        width: 100%;
        height: 100%;
        position: fixed;
        overflow-x: hidden;
        overflow-y: auto;
        }

        body {
            background-color: #5735327f;
            width: 100%;
            height: 100%;
        }

        .header1 {
            background-color: #573532;
            height: 50px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }
    </style>

</head>

<header>
    <div class="inner">
                <nav class="navbar navbar-expand-xl navbar-light bg-2-right" style="margin: 0px;">
                <a class="navbar-brand" href="index.php"><img style ="margin-top: -58px;margin-left: 100px;" src="./image/internal_cafe_logo.png" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarSupportedContent" style="padding-left: 200px; display:flex !important; justify-content:space-around !important;">
                    <ul class="navbar-nav" style="margin-top: 40px; height: 60px;">
                        <li class="nav-item mag">
                        <a class="nav-link" href="index.php">HOME</a>
                        </li>
                        <li class="nav-item dropdown">
                    
                        </li>
                        <li class="nav-item mag">
                            <a class="nav-link" href="main2.php">ORDER</a>
                        </li>
                        <li class="nav-item mag">
                            <a class="nav-link" href="order_history.php">ORDER LIST</a>
                        </li>
                        <li class="nav-item mag">
                            <a class="nav-link" href="my_page2.php">MY PAGE</a>
                        </li>
                <?php 
                    if(isset($_SESSION['e_id']))
                    { ?>
                    <li class="nav-item mag">
                            <a class="nav-link" href="logout.php">LOGOUT</a>
                    </li>
                <?php
                    }else{?>
                    <li class="nav-item mag">
                        <a class="nav-link" href="login.php">LOGIN</a>
                <?php }?>
                    </ul>
                </div>
                </nav>   
    </div>
</header>