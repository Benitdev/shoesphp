<section class="popular">
    <div class="container">
        <h1>Sản Phẩm Nỗi Bật</h1>
        <div class="product-list">
            <?php
            $products = json_decode($data['productList']);
            foreach ($products as $product) { ?>
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
                        <i class="fas fa-info-circle"></i>
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                </div>
            <?php } ?>
            <a href="product">
            <button class="btn btn-shopnow">
                CỬA HÀNG
            </button>
            </a>
        </div>
    </div>
</section>