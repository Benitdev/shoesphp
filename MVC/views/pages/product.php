<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> BQ Store </title>
  <base href="http://localhost/shoesphp/">
  <!-- <link rel="stylesheet" href="./public/css/all.min.css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer">
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Concert+One&family=Monda:wght@700&family=Rubik:ital,wght@0,500;0,600;0,700;1,800&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="public/css/reset.css">
  <link rel="stylesheet" href="public/css/app.css">
</head>

<body>
  <div class="wrapper">
    <!-- header -->
    <header class="header-product" id="header-product">
      <?php
      require_once('./mvc/views/components/HeaderProduct.php');
      ?>
    </header>
    <!-- end header  -->
    <!-- main -->
    <main>
      <!--   <?php require_once('./mvc/views/components/HomeBanner.php') ?> -->
      <?php
        require_once('./mvc/views/components/'.$data['component'].'.php');
      
      ?>
    </main>
    <!-- end main -->
    <!-- footer  -->
    <footer class="footer">
      <?php require_once("./mvc/views/components/Footer.php") ?>
    </footer> -->
    <!-- end footer  -->
    <button class="back-to-top">
      <i class="fas fa-arrow-up"></i>
    </button>
  </div>
  <!-- <?php require_once("./mvc/views/components/Cart.php") ?> -->
  <!-- Slider -->
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
  <!-- End Slider -->
  <!-- <script src="public/js/app.js"></script> -->
  <script src="public/js/detail.js"></script>
</body>

</html>