<section class="cart-section">
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
          // if (isset($_SESSION['login'])) {
            if (isset($_SESSION['product'])) {
              foreach ($_SESSION['product'] as $value) {
          ?>
                <div class="item-wrap">
                  <input class="id-cart" <?php if ($value['isChecked']) echo 'checked' ?> type="checkbox" value='<?php echo $value['id'] ?>'>
                  <a href="product/detail/<?php echo $value['slug'] ?>/<?php echo $value['id'] ?>" class="info-wrap">
                    <div class="img-wrap">
                      <img src="<?php echo $value['avatar'] ?>" alt=''>
                    </div>
                    <div class="text-wrap">
                      <p class="name-wrap"><?php echo $value['name'] ?></p>
                      <p class="size-wrap"> Size: <?php echo $value['size'] ?></p>
                    </div>
                  </a>
                  <div class="price">
                    <?php echo number_format($value['price'], 0 , ',' , '.') ?> đ
                  </div>
                  <div class="quantity">
                    <i class="fas fa-sort-down btn-dec"></i>
                    <input type="text" class="quantity-item-cart" value="<?php echo number_format($value['quantity']) ?>">
                    <i class="fas fa-sort-up btn-inc"></i>
                  </div>
                  <div class="total">
                    <?php echo $value['total'] ?>
                  </div>
                  <div class="del">
                    <button class="btn btn-del-cart">
                      <i class="fas fa-trash-alt"></i>
                    </button>
                  </div>
                </div>
          <?php
              }
            }
          // }
          ?>
        </div>
      </div>
      <div class="total-cart">
        <h3> Thông tin giỏ hàng </h3>
        <div class="order-infos">
          <div class="order-products">
            <p class="product-number"> Tạm tính (<?php
                                                  if (isset($_SESSION['login'])) {
                                                    if (isset($_SESSION['product']))
                                                      echo count($_SESSION['product']);
                                                    else
                                                      echo 0;
                                                  } else
                                                    echo 0 ?> sản phẩm): </p>
            <p class="product-total"></p>
          </div>
          <div class="delivery-fee">
            <p> Phí vận chuyển: </p>
            <p class="fee"></p>
          </div>
          <div class="discount">
            <p> Mã giảm giá: </p>
            <form class="discount-input" onsubmit="return false">
              <input type="text" required>
              <button type='submit' class="btn btn-discount"> Áp dụng </button>
            </form>
            <small style="color: red; text-align:center; display: block"></small>
          </div>
          <p class="discount-status"></p>
          <p class="total-order"></p>
          <a href="checkout" class="btn btn-checkout">
            THANH TOÁN
          </a>
          <button class="btn btn-keepshop">
            TIẾP TỤC MUA HÀNG
          </button>
        </div>
      </div>
    </div>
  </div>
</section>