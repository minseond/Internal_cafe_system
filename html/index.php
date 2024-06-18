<?php
  session_start();
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/main.css">
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

  <title>internal_cafe</title>
</head>

<body>
<?php include("header2.php"); ?>


<section class="main-print">
  <div class="container-fluid text-center bg-1">
  </div>
</section>

<section class="notice" style="width:100%; background-color: #f6f5ef;">
  <div class="container-fluid text-center bg-2">  
    <div class="centerImg style='margin-top: 75px;'">
        <div class="prev"><a href=#><div class="material-icons">arrow_back</div></a></div>
      <div style="position: relative;" class="img">
        <div class="cycle-slideshow" 
        data-cycle-prev=".prev"
        data-cycle-next=".next"
        data-cycle-timeout=0
        data-cycle-fx="carousel"
        data-cycle-pager =".pager"
        data-cycle-carousel-visible="3"
        data-cycle-carousel-fluid=true
        >
        <img class = "cycleimg" src="./image/strbr.png" data-cycle-hash="Slide image" role="button">

        
      </div>
      <p class="pager" style="margin-top: -10px;"></p>
      </div>

      <div class="next"><a href=#><div class="material-icons arrow">arrow_forward</div></a></d>
  </div>
</section>
<script>
    function prevSlide() {
        $('#mySlideshow').cycle('prev');
    }

    function nextSlide() {
        $('#mySlideshow').cycle('next');
    }
</script>
 <section class="rewards">
</section>

<section class="favorite">
  <div class="container-fluid text-center bg-3">
    <div class="row">
      <div class="col-sm-5">
        <div class="favorite-text-group">
          <img src="./image/favorite_text1.png" alt="" style="margin-top: 150px;">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-5">
        
      </div>
    </div>
    <div class="row">
      <div class="col-sm-5">
        <div class="favorite-text-group" style="margin-top: 50px;">
          <a href="main2.php" class="btn btn--white">Order Now →</a>
           <div class="row">
      <div class="col-sm-5">
        
      </div>
    </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>

</html>