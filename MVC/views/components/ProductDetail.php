 <?php
    $productInfos = json_decode($data['productInfo']);
    $productImages = json_decode($data['productImages']);
    $productSizes = json_decode($data['productSizes']);
    ?>
 <section class="product-detail">
     <div class="container">
         <div class="title">
             <a href="">Trang chủ </a>
             <a href="product/<?= $productInfos->cateSlug ?>"> <?php echo "/ " . $productInfos->cateName ?> </a>
             <a href="product/detail/<?= $productInfos->slug ?>"> <?php echo "/ " . $productInfos->name; ?> </a>
         </div>
         <div class="product-detail-main">
             <div class="product-images">
                 <div class="main-image">
                     <img src="<?php echo $productInfos->avatar ?>" alt="">
                     <i class="fas fa-chevron-right"></i>
                     <i class="fas fa-chevron-left"></i>
                     <div class="result hide"></div>
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
             <form class="product-info" action="cart/addtocart/<?php echo $productInfos->id ?>" method="POST">
                 <h1 class="product-name"> <?php echo $productInfos->name; ?> <div class="underline"></div>
                 </h1>
                 <h2 class="product-type"> <?php echo $productInfos->typeName ?> - <?php echo $productInfos->cateName ?></h2>

                 <h1 class="price"> <?php echo number_format($productInfos->price, 0, ',', '.') ?>
                     <div class="currency">đ </div>
                 </h1>
                 <h3> Chọn size</h3>
                 <div class="size-detail">
                     <?php
                        foreach ($productSizes as $productSize) {
                        ?>
                         <div class="size-number-wrap">
                             <?php if ($productSize->quantity != '0') { ?>
                                 <input type="radio" value="<?php echo $productSize->size ?>" name="size" required>
                                 <div class="size-number"> <?php echo $productSize->size ?> </div>
                             <?php } else { ?>
                                 <div class="size-number" style="backgroud: gray; color: gray;border: 1px solid gray; "> <?php echo $productSize->size ?> </div>
                             <?php } ?>
                         </div>
                     <?php  } ?>
                 </div>
                 <div class="size"></div>
                 <div class="desc">
                     <h3>Thông tin</h3>
                     <p> <?php echo $productInfos->description ?> </p>
                 </div>
                 <a>
                     <button class="btn btn-buynow" type="submit">
                         MUA NGAY
                         <i class='icon bx bx-right-arrow-alt'></i>
                     </button>
                 </a>

             </form>
         </div>
     </div>
 </section>