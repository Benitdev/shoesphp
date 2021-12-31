<section class="checkout-section">
    <div class="checkout-stage">
        <div class="checkout-road">
            <a href="cart" style="color: unset;">
                <div class="stage active">
                    <i> 1 </i>
                    <small> Chi tiết giỏ hàng </small>
                </div>
            </a>
            <span class="active"></span>
            <div class="stage active">
                <i> 2 </i>
                <small> Địa chỉ nhận hàng </small>
            </div>
            <span></span>
            <div class="stage">
                <i> 3 </i>
                <small> Phương thức thanh toán </small>
            </div>
            <span></span>
            <div class="stage">
                <i> 4 </i>
                <small> Xác nhận đơn hàng </small>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="checkout-main">
            <div class="checkout-address">
                <div class="address-form">
                    <h2> ĐỊA CHỈ NHẬN HÀNG</h2>
                    <?php if(isset($_SESSION['login'])) {?>
                    <form onsubmit="return false">
                        <div class="txt-fullname">
                            <div class="txt-field">
                                <input type="text" id="reg-firstname" value='<?php echo $_SESSION['login']['firstName'] ?>'>
                                <label for=""> Họ </label>
                                <span></span>
                                <small></small>
                            </div>
                            <div class="txt-field">
                                <input type="text" id="reg-lastname" name="reg-lastname" value='<?php echo $_SESSION['login']['lastName'] ?>'>
                                <label for=""> Tên </label>
                                <span></span>
                                <small></small>
                            </div>
                        </div>
                        <div class="txt-field">
                            <input type="email" required id="reg-email" name="reg-email" value='<?php echo $_SESSION['login']['email'] ?>'>
                            <label for="">Email</label>
                            <span></span>
                            <small></small>
                        </div>
                        <div class="txt-field">
                            <input type="text" required id="reg-phone" name="reg-phone" value='<?php echo $_SESSION['login']['phone'] ?>'>
                            <label for="">Số điện thoại</label>
                            <span></span>
                            <small></small>
                        </div>
                        <div class="txt-field">
                            <input type="text" required id="reg-address" name="reg-address">
                            <label for="">Địa chỉ</label>
                            <span></span>
                            <small></small>
                        </div>
                        <div class="address-select">
                            <select name="province" id="province" required>
                                <option value=""> Chọn tỉnh thành </option>
                                <?php
                                $provinces = json_decode($data['province']);
                                foreach ($provinces as $province) {
                                    echo '<option>' . $province->_name . '</option>';
                                }
                                ?>
                            </select>
                            <select name="district" id="district">
                                <option value=""> Chọn Quận/Huyện </option>

                            </select>
                            <select name="ward" id="ward">
                                <option value=""> Chọn Phường/Xã </option>

                            </select>
                        </div>
                        <small> Vui lòng điền chính xác thông tin giao hàng!</small>
                        <input type="submit" class="btn btn-checkout-address" name="btn-checkout-address" value="TIẾP TỤC THANH TOÁN"></input>
                    </form>
                    <?php } 
                    else {?>
                        <h3 style="margin-top: 5rem; color: white; text-align: center"> VUI LÒNG ĐĂNG NHẬP ĐỂ THANH TOÁN</h3>
                    <?php }      
                    ?>
                </div>
                <div class="order-cart-detail">
                    <h2> THÔNG TIN GIỎ HÀNG</h2>
                    <div class="items-wrap">
                        <div class="title">
                            <p>Sản Phẩm</p>
                            <hr>
                            <p>Tổng tiền</p>
                        </div>
                        <?php
                        // if (isset($_SESSION['login'])) {
                            if (isset($_SESSION['product'])) {
                                foreach ($_SESSION['product'] as $value) {
                                    if ($value['isChecked']) {
                        ?>
                                        <div class="item-wrap">
                                            <a href="product/detail/<?php echo $value['slug'] ?>/<?php echo $value['id'] ?>" class="info-wrap">
                                                <div class="img-wrap">
                                                    <img src="<?php echo $value['avatar'] ?>" alt=''>
                                                </div>
                                                <p class="name-wrap">
                                                    <?php echo $value['name'] ?>
                                                    <span style="color: red;"> x
                                                        <?php echo number_format($value['quantity']) ?>
                                                    </span>
                                                </p>
                                            </a>
                                            <div class="total">
                                                <?php echo number_format($value['total']) ?> đ
                                            </div>
                                        </div>
                        <?php
                                    }
                                }
                            }
                        // }
                        ?>
                        <div class="total-wrap">
                            <div class="subtotal">
                                <h3> Tổng giá tiền sản phẩm: </h3>
                                <div> </div>
                            </div>
                            <div class="fee">
                                <h3> Phí vận chuyển: </h3>
                                <div> </div>
                            </div>
                            <div class="coupon">
                                <h3> Voucher giảm giá: </h3>
                                <div> </div>
                            </div>
                            <hr>
                            <div class="total" style="color: red">
                                <h3> Tổng thanh toán: </h3>
                                <div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="checkout-payment">
                <div class="payment-form">
                    <h2> THÔNG TIN THANH TOÁN</h2>
                    <form onsubmit="return false">
                        <div>
                            <h3>Phương thức thanh toán</h3>
                            <div class="checkout-method">
                                <div class="method active card">
                                    THANH TOÁN BẰNG THẺ
                                </div>
                                <div class="method">
                                    THANH TOÁN KHI NHẬN HÀNG
                                </div>
                            </div>
                        </div>
                        <div class="card-info">
                            <h4> SỐ THẺ </h4>
                            <input type="text" id="card-number" name="card-number" placeholder="**** **** **** ****">
                            <div class="card-others-info">
                                <div class="card-date">
                                    <h4> NGÀY MỞ THẺ </h4>
                                    <input type="text" id="date-card" name="card-number" placeholder="MM  /  YY">
                                </div>
                                <div class="card-code">
                                    <h4> CCV </h4>
                                    <input type="text" id="code-card" name="card-number" placeholder="Code">
                                </div>
                            </div>
                        </div>
                        <div class="ship-to">
                            <h4> Giao hàng đến địa chỉ: </h3>
                                <p></p>
                        </div>
                        <input type="submit" class="btn btn-checkout-payment" name="btn-checkout-payment" value="TIẾP TỤC THANH TOÁN"></input>
                    </form>
                </div>
                <img src="https://c.static-nike.com/a/images/w_1200,c_limit/bzl2wmsfh7kgdkufrrjq/seo-title.jpg" alt="">
            </div>
            <div class="checkout-confirm"></div>
        </div>
    </div>
</section>