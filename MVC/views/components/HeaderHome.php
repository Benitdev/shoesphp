 <!-- header-nav -->
 <header class="header-home" id="header">
     <div class="header-home-nav">
         <div class="container">
             <div class="nav-main">
                 <div class="menu-wrap">
                     <div class="menu" onclick="openMenu()">
                         <div class="hamburger"></div>
                     </div>
                 </div>
                 <div class="logo">
                     <p>BQ STORE </p>
                 </div>

                 <a href="cart" class="cart">
                     <?php
                        if (isset($_SESSION['login'])) { ?>
                         <p> Xin chào <?php if ($_SESSION['login']['gender'] == 'Nam')
                                            echo 'anh';
                                        else echo 'chị';
                                        ?>
                             </br>
                             <span> <?php echo ' ' . $_SESSION['login']['firstName'] . ' ' . $_SESSION['login']['lastName'] ?></span>
                         </p>
                     <?php } ?>
                     <i class="fas fa-shopping-cart"></i>
                 </a>
             </div>
         </div>
     </div>
     <!-- end header-nav  -->
     <div class="title-home yellow">
         PHAN THIEN
     </div>
     <div class="product-banner">
         <!-- product info  -->
         <div class="product-info">
             <?php
                $products = json_decode($data['productList']);
                foreach ($products as $product) {
                    if ($product->feature == 3) {
                ?>
                     <div class="product-info-main">
                         <h1>
                             <?php $name = explode(" ", filter_var(trim($product->name, "/")));
                             foreach ($name as $key => $value) {
                                if ($key == 2 || $key == 3) {
                                    ?> <span style="color: yellow"> <?php echo $value ?></span>
                             <?php
                               } else
                                    echo $value.' ';
                             }
                            ?>              
                         </h1>
                         <!-- <h1> <span class="yellow">PRO</span>DUCT </h1> -->
                         <h2> <?php echo $product->typeName ?></h2>
                         <p> <?php echo $product->description ?> </p>
                         <a href="product/detail/<?php echo $product->slug ?>">
                             <button class="btn btn-buynow">
                                 SHOP NOW
                                 <i class='icon bx bx-right-arrow-alt'></i>
                             </button>
                         </a>
                     </div>
             <?php }
                } ?>
         </div>
         <!-- end product info  -->
         <!-- product image slide  -->
         <div class="slider">
             <?php
                $index = 1;
                foreach ($products as $product) {
                    if ($product->feature == 3) {
                ?>
                     <div class="slide <?php if ($index == 1) {
                                            echo "active";
                                            $index++;
                                        } ?>">
                         <div class="img-holder" style=" <?php
                                                            echo "background-image: url(http://localhost/shoesphp/" . $product->avatar . ")";
                                                            ?>">
                         </div>
                     </div>
             <?php }
                } ?>

         </div>
     </div>
     <!-- end prodcut image slide  -->
     <button class="slide-control">
         <i class="fas fa-play"></i>
     </button>
 </header>