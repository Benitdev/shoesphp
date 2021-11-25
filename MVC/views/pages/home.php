<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> BQ Store </title>
    <base href="http://localhost/shoesphp/">
    <link rel="stylesheet" href="public/css/reset.css">
    <!-- <link rel="stylesheet" href="./public/css/all.min.css"> -->
    <link rel="stylesheet" href="public/css/app.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Concert+One&family=Monda:wght@700&family=Rubik:wght@500&display=swap" rel="stylesheet">

    <script src="https://use.fontawesome.com/51b8a0249e.js"></script>
</head>

<body>
    <div class="wrapper">
        <!-- header -->
        <header class="header">
           <?php require_once('./mvc/views/components/Header.php') ?>
        </header>
        <main>
          <?php require_once('./mvc/views/components/HomeBanner.php') ?>
          <?php require_once("./mvc/views/components/ProductList.php") ?>
        </main>
        <!-- <main class-""></main> -->
    </div>
    <!-- Slider -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <!-- End Slider -->
</body>

</html>