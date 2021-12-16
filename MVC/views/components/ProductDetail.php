 <?php
    $productInfos = json_decode($data['productInfo']);
    $productImages = json_decode($data['productImages']);
    ?>
 <section class="product-detail">
     <div class="container">
         <div class="title">
             ahihi
         </div>
         <div class="product-detail-main">
             <div class="product-images">
                 <div class="main-image">
                     <img src="<?php echo $productInfos->avatar ?>" alt="">
                 </div>
                 <div class="sub-image">
                     <div>
                         <img src="<?php echo $productInfos->avatar ?>" alt="">
                     </div>
                     <?php
                        foreach ($productImages as $productImage) {
                        ?>
                         <div>
                             <img class="active" src="<?php echo $productImage->imgUrl ?> " alt="">
                         </div>
                     <?php } ?>
                 </div>
             </div>
             <div class="product-info">
                 <h1 class="product-name"> <?php echo $productInfos->name; ?> <div class="underline"></div>
                 </h1>
                 <h2 class="product-type"> <?php echo $productInfos->typeName ?> - <?php echo $productInfos->cateName ?></h2>
                 <h1 class="price"> <?php echo number_format($productInfos->price, 0, ',', '.') ?>
                     <div class="currency">đ </div>
                 </h1>
                 <div class="size"></div>
                 <div class="desc">
                     <p>Thông tin:</p>
                     <p> <?php echo $productInfos->description ?> </p>
                 </div>
                 <a href="cart/addtocart/<?php echo $productInfos->id?>">
                     <button class="btn btn-buynow">
                         MUA NGAY
                         <i class='icon bx bx-right-arrow-alt'></i>
                     </button>
                 </a>
             </div>
         </div>
     </div>
 </section>