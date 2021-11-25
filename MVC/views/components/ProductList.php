<section class="popular">
    <div class="container">
        <h1>Sản Phẩm Nỗi Bật</h1>
        <div class="product-list">
            <?php
            $products = json_decode($data['productList']);
            foreach ($products as $product) { ?>
                <div class="product-list-item">
                    <img src=" <?= $product->avatar ?> " alt="">
                    <div class="product-info">
                        <h4>
                            <?php echo $product->name; ?>
                        </h4>
                        <span class="price"> <?php echo number_format($product->price) ?> VNĐ</span>
                        <button class="btn btn-add-cart">
                             thêm giỏ hàng
                             <i class='bx bx-cart-alt'></i>
                        </button>
                    </div>
                    <div class="product-list-item-hover">
                   <!--    <i class="fas fa-eye"></i>
                      <i class="fas fa-eye"></i>
                      <i class="fas fa-address-card"></i>
                      <i class="fas fa-american-sign-language-interpreting"></i>
                      <i class="far fa-bell"></i> -->
                   </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>