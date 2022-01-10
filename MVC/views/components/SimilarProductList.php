<section class="popular">
    <div class="container">
        <h1>Sản Phẩm Tương Tự</h1>
        <div class="product-list">
            <div class="product-list-wrap">
                <?php
                $products = json_decode($data['productList']);
                foreach ($products as $product) {
                ?>
                    <div class="product-list-item">
                        <img src=" <?= $product->avatar ?> " alt="">
                        <span class="cate-name"><?php echo $product->cateName; ?></span>
                        <div class="product-info">
                            <h4>
                                <?php echo $product->name; ?>
                            </h4>
                            <div class="desc">
                                <?php echo $product->shortDesc; ?>
                            </div>
                            <span class="price"> <?php echo number_format($product->price) ?> VNĐ</span>
                        </div>
                        <div class="product-list-item-hover">
                            <i class="fas fa-eye eye"></i>
                            <a href="product/detail/<?= $product->slug ?>"><i class="fas fa-info-circle"></i></a>
                            <a href="cart/addtocart/<?= $product->id ?>"><i class="fas fa-shopping-cart"></i> </a>
                        </div>
                    </div>
                <?php  } ?>
            </div>
        </div>
    </div>
</section>