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
                 <div class="rating-wrap">
                     <u class="rating-average"></u>
                     <div class="rating-star-title">
                         <input type="radio" disabled value="10">
                         <input type="radio" disabled value="9">
                         <input type="radio" disabled value="8">
                         <input type="radio" disabled value="7">
                         <input type="radio" disabled value="6">
                         <input type="radio" disabled value="5">
                         <input type="radio" disabled value="4">
                         <input type="radio" disabled value="3">
                         <input type="radio" disabled value="2">
                         <input type="radio" disabled value="1">

                     </div>
                     <hr style="height: 1rem; margin: 0 .5rem">
                     <!-- <div class="rating-info-wrap"> -->
                     <div class="rating-quantity"></div>

                     <!-- </div> -->
                 </div>
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
         <div class="post-comments">
             <h1> Đánh giá sản phẩm <span style="font-size: .9rem; padding-left: .5rem"> dd</span></h1>
             <small></small>
             <form action='' class="enter-comment" onsubmit="return false">
                 <div class="enter-comment-main">
                     <div class="rating-wrap">
                         <u> <?= $_SESSION['login']['firstName'] . ' ' . $_SESSION['login']['lastName'] . ':' ?></u>
                         <input type="hidden" id="product-id" value="<?= $productInfos->id ?>">
                         <div class="rating-star">
                             <input type="radio" name="rating" value="10">
                             <input type="radio" name="rating" value="9">
                             <input type="radio" name="rating" value="8">
                             <input type="radio" name="rating" value="7">
                             <input type="radio" name="rating" value="6">
                             <input type="radio" name="rating" value="5">
                             <input type="radio" name="rating" value="4">
                             <input type="radio" name="rating" value="3">
                             <input type="radio" name="rating" value="2">
                             <input type="radio" name="rating" value="1" required>
                         </div>
                     </div>
                     <textarea name="" id="content-comment" cols="" rows="" placeholder="Viết đánh giá..." required></textarea>
                     <button class="btn-submit-comment" type="submit"> Đánh giá</button>
                 </div>
             </form>

             <div class="view-comments">
                 <div class="rating-overview">
                     <div class="rating-briefing">
                         <div class="rating-average-overview"></div>
                         <div class="rating-star-title">
                             <input type="radio" disabled value="10">
                             <input type="radio" disabled value="9">
                             <input type="radio" disabled value="8">
                             <input type="radio" disabled value="7">
                             <input type="radio" disabled value="6">
                             <input type="radio" disabled value="5">
                             <input type="radio" disabled value="4">
                             <input type="radio" disabled value="3">
                             <input type="radio" disabled value="2">
                             <input type="radio" disabled value="1">

                         </div>
                     </div>

                     <div class="rating-overview-filter">
                         <div class="rating-filter-item active"> Tất cả </div>
                         <div class="rating-filter-item star"></div>
                         <div class="rating-filter-item star"></div>
                         <div class="rating-filter-item star"></div>
                         <div class="rating-filter-item star"></div>
                         <div class="rating-filter-item star"></div>
                     </div>
                 </div>
                 <div class="user-comment"></div>
             </div>
         </div>
         <div class="similar-product">
             <?php require_once("./mvc/views/components/SimilarProductList.php") ?>
         </div>

         <div>
             <div class="fb-comments" data-href="https://dxdbloger.000webhostapp.com/product/detail/<?= $productInfos->slug ?>/<?= $productInfos->id ?>" data-numposts="5" data-width="700"></div>
         </div>
     </div>
 </section>