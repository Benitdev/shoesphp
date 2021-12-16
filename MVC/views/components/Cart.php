<section class="cart-session">
  <h1> My Cart</h1>
  <div class="container">
    <div class="cart-wrapper">
      <div class="cart-product">
        <div class="cart-title">
          <p class="title-name">Sản Phẩm</p>
          <p class="title-price">Giá</p>
          <p class="title-quantity">Số Lượng</p>
          <p class="title-total">Thành Tiền</p>
          <p class="title-del"></p>
        </div>
        <hr>
        <div class="items-wrap">
          <?php
          if (isset($_SESSION['login'])) {
            if (isset($_SESSION['product'])) {
              foreach ($_SESSION['product'] as $value) {
          ?>
                <div class="item-wrap">
                  <a href="product/detail/<?php echo $value['slug']?>/<?php echo $value['id']?>" class="info-wrap">
                    <input class="id-cart" style="display: none" value='<?php echo $value['id']?>'>
                    <div class="img-wrap">
                      <img src="<?php echo $value['avatar'] ?>" alt=''>
                    </div>
                    <p class="name-wrap"><?php echo $value['name'] ?></p>
                  </a>
                  <div class="price">
                    <?php echo number_format($value['price']) ?> đ
                  </div>
                  <div class="quantity">
                    <button class="btn-dec"></button>
                    <input type="text" id="quantity" value="<?php echo number_format($value['quantity']) ?>">
                    <button class="btn-inc"></button>
                  </div>
                  <div class="total">
                    <?php echo number_format($value['total']) ?> đ
                  </div>
                  <div class="del">
                    <input type="submit" class="btn btn-del-cart" value="Xóa">
                  </div>
                </div>
          <?php
              }
            }
          }
          ?>
        </div>
      </div>
      <div class="total-cart">
        <h3> Thông tin đơn hàng </h3>
        <div class="order-infos">
          <div class="order-products">
            <p class="product-number"> Tạm tính (<?php 
              if (isset($_SESSION['product']))
                  echo count($_SESSION['product']);
              else 
                  echo 0
                ?> sản phẩm): </p>
            <p class="product-total"></p>
          </div>
          <div class="delivery-fee">
              <p> Phí vận chuyển: </p>
              <p class="fee"></p>
          </div>
          <div class="discount">
            <p> Mã giảm giá: </p>
            <div class="discount-input">
              <input type="text">
              <button class="btn btn-discount"> Áp dụng </button>
            </div>
          </div>
          <p class="discount-status"></p>
          <p class="total-order"></p>
          <button class="btn btn-checkout">
            THANH TOÁN
          </button>
          <button class="btn btn-keepshop">
            TIẾP TỤC MUA HÀNG
          </button>
        </div>
      </div>
    </div>
  </div>
</section>