<div class="container">
    <div class="header-product-main">
        <div class="logo">
            <a href="" class="logo-link">
                <div class="wrap-3d">
                    <img src="public/images/logo/logo.png" alt="">
                </div>
                <h2> BQ Store </h2>
            </a>
        </div>
        <ul class="home-product-menu">
            <li class="menu-item"><a href="product/men" class="menu-link"> NAM </a></li>
            <li class="menu-item"><a href="product/women" class="menu-link"> NỮ </a></li>
            <li class="menu-item"><a href="product/kid" class="menu-link"> TRẺ EM </a></li>
            <li class="menu-item"><a href="product/sport" class="menu-link"> THỂ THAO </a></li>
            <li class="menu-item"><a href="product/sale" class="menu-link"> KHUYẾN MÃI</a></li>
        </ul>
        <div class="header-icon">
            <div class="search-box">
                <i class='bx bx-search'></i>
                <input type="text" placeholder="Tên sản phẩm">
                <i class="fas fa-times btn-close-search"></i>
                <div class="result-search">
                    <div> Kết quả tìm kiếm cho "<span class="search-value"> hihi</span>"</div>
                    <div class="item-search-wrap"></div>
                </div>
            </div>
            <span></span>
            <div class="cart-icon-wrap">
                <i class='bx bxs-cart-alt cart-icon'>
                </i>
                <div class="cart-count">
                    <?php
                    if (isset($_SESSION['product']))
                        echo count($_SESSION['product']);
                    else
                        echo 0
                    ?>
                </div>
                <div class="subcart-item-wrap">
                    <h2> Giỏ Hàng</h2>
                    <?php if (isset($_SESSION['product'])) { ?>
                        <div class="cart-item-scroll">
                            <?php foreach ($_SESSION['product'] as $value) { ?>
                                <div class="cart-item">
                                    <input class="id-subcart" style="display: none" value='<?php echo $value['id'] ?>'>
                                    <a href="product/detail/<?php echo $value['slug'] ?>/<?php echo $value['id'] ?>" class="img-wrap">
                                        <div>
                                            <img src="<?php echo $value['avatar'] ?>" alt=''>
                                        </div>
                                    </a>
                                    <div class="info-wrap">
                                        <p class="name-wrap">
                                            <?php echo $value['name'] ?>
                                            <span class="quantity-subcart" style="color: red; background: transparent"> x
                                                <?php echo number_format($value['quantity']) ?>
                                            </span>
                                        </p>
                                        <div class="total-item">
                                            <?php echo $value['total'] ?>
                                        </div>
                                    </div>
                                    <i class="fas fa-trash-alt" id='del-subcart'></i>
                                </div>
                                <hr>
                            <?php
                            } ?>
                        </div>
                    <?php
                    } ?>
                    <div class="total-cart"> </div>
                    <a href="cart" class="btn link cd-cart"> ĐẾN GIỎ HÀNG </a>
                    <a href="checkout" class="btn link cd-checkout"> THANH TOÁN</a>
                </div>
            </div>
            <div class="user-info-wrap">
                <?php if (isset($_SESSION['login'])) { ?>
                    <i class='bx bxs-user user-icon-logged' style="color: lightgray">
                    </i>
                    <div class="user-info">
                    <div> Xin chào <span style="color: #45a29d; background: none"> <?=$_SESSION['login']['lastName']?> </span></div>
                        <hr>
                        <div class="info-account"> Thông tin tài khoản </div>
                        <hr>
                        <a href="user/logout" class="logout"> Đăng xuất </a>
                    </div>
                <?php } else { ?>
                    <i class='bx bxs-user user-icon'>
                    </i>
                <?php } ?>
            </div>
        </div>
    </div>
</div>