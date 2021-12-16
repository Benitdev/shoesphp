<div class="menu-overlay">
    <!-- <div class="menu-overlay-wrap"> -->
    <ul class="menu">
        <li>
            <a href="product/men"> NAM </a>
            <div class="underline"></div>
        </li>
        <li>
            <a href=""> NỮ </a>
            <div class="underline"></div>
        </li>
        <li>
            <a href=""> TRẺ EM </a>
            <div class="underline"></div>
        </li>
        <li>
            <a href=""> KHUYẾN MÃI </a>
            <div class="underline"></div>
        </li>
        <?php
        if (isset($_SESSION['login']) == false) { ?>
            <li class="li-login">
                Đăng Nhập
                <i class="fas fa-sign-in-alt"></i>
            </li>
        <?php } else { ?>
            <a href='user/logout' class="li-logout">
                Đăng Xuất
                <i class="fas fa-sign-out-alt"></i>
            </a>
        <?php } ?>
    </ul>
    <div class="login-form">
        <div class="login">
            <h2>BQ STORE</h2>
            <h3> ĐĂNG NHẬP</h3>
            <p class="check-login"></p>
            <form class="form-login" onsubmit="return false">
                <div class="txt-field">
                    <input type="text" required id="id-login" name="id-login">
                    <label for="">Username</label>
                    <span></span>
                </div>
                <div class="txt-field">
                    <input type="text" required id="pass-login" name="pass-login">
                    <label for="">Password</label>
                    <span></span>
                </div>
                <input type="submit" class="btn btn-login" value="ĐĂNG NHẬP"> </input>
        </form>
            <p> Chưa có tài khoản ? <span class="cd-register"> Đăng kí</span></p>
            <i class="fas fa-times btn-exit"></i>
        </div>
    </div>
    <div class="register-form">
        <div class="register">
            <h2>BQ STORE</h2>
            <h3> ĐĂNG KÝ</h3>
            <form class="form-register" onsubmit="return false">
                <div class="txt-fullname">
                    <div class="txt-field">
                        <input type="text" required id="reg-firstname" name="reg-firstname">
                        <label for=""> Họ </label>
                        <span></span>
                        <small></small>
                    </div>
                    <div class="txt-field">
                        <input type="text" required id="reg-lastname" name="reg-lastname">
                        <label for=""> Tên </label>
                        <span></span>
                        <small></small>
                    </div>
                </div>
                <div class="radio-field">
                    <input class="btn-radio" type="radio" id="male" name="gender" value="Nam" required>
                    <label for="male"> Nam </label>
                    <input class="btn-radio" type="radio" id="female" name="gender" value="Nữ">
                    <label for="female"> Nữ</label>
                    <input class="btn-radio" type="radio" id="other" name="gender" value="Khác">
                    <label for="other"> Khác </label>
                </div>
                <div class="txt-field">
                    <input type="email" required id="reg-email" name="reg-email">
                    <label for="">Email</label>
                    <span></span>
                    <small></small>
                </div>
                <div class="txt-field">
                    <input type="text" required id="reg-phone" name="reg-phone">
                    <label for="">Số điện thoại</label>
                    <span></span>
                    <small></small>
                </div>
                <div class="txt-field">
                    <input type="password"  required id="reg-pass" name="reg-pass">
                    <label for="">Mật khẩu</label>
                    <span></span>
                    <small></small>
                </div>
                <div class="txt-field">
                    <input type="password" required id="confirm-pass" name="confirm-pass">
                    <label for="">Xác nhận mật khẩu</label>
                    <span></span>
                    <small></small>
                </div>
                <input type="submit" class="btn btn-register" name="btn-register" value="ĐĂNG KÝ"></input>
            </form>
            <div class="register-success">
                <h2> <i class="far fa-check-circle"></i> Chúc Mừng</h2>
                <p> Bạn Đã Đăng Ký Thành Công</p>
                <p> Chào mừng bạn đến với thế giới của <span>BQ Store</span> </p>
            </div>
            <i class="fas fa-times btn-exit"></i>
        </div>
    </div>
    <!-- </div> -->
</div>