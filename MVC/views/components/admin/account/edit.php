<?php if (isset($_COOKIE['msg'])) { ?>
    <div class="alert alert-success">
        <strong>Thông báo</strong> <?= $_COOKIE['msg'] ?>
    </div>
<?php }
$user = json_decode($data['userDetail'])
?>
<hr>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <form action="admin/account/update&id=<?=$user->id?>" method="POST" role="form" enctype="multipart/form-data">
        <input type="hidden" name="MaND" value="<?= $user->id ?>">
        <div class="form-group">
            <label for="">Họ</label>
            <input type="text" class="form-control" id="" placeholder="" name="Ho" value="<?= $user->firstName ?>">
        </div>
        <div class="form-group">
            <label for="">Tên</label>
            <input type="text" class="form-control" id="" placeholder="" name="Ten" value="<?= $user->lastName ?>">
        </div>
        <div class="form-group">
            <label for="">Giới tính</label>
            <select id="" name="GioiTinh" class="form-control">
                <option <?= ($user->gender == 'Nam') ? 'selected' : '' ?> value="Nam"> Nam</option>
                <option <?= ($user->gender == 'Nữ') ? 'selected' : '' ?> value="Nữ"> Nữ</option>
                <option <?= ($user->gender == 'Khác') ? 'selected' : '' ?> value="Khác"> Khác</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Số Điện Thoại</label>
            <input type="text" class="form-control" id="" placeholder="" name="SDT" value="<?= $user->phone ?>">
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input type="Email" class="form-control" id="" placeholder="" name="Email" value="<?= $user->email ?>">
        </div>
        <div class="form-group">
            <label for="">Địa chỉ</label>
            <input type="text" class="form-control" id="" placeholder="" name="DiaChi" value="<?= $user->address ?>">
        </div>
        <div class="form-group">
            <label for="">Mật Khẩu</label>
            <input type="Password" class="form-control" id="" placeholder="" name="MatKhau" value="<?= $user->password ?>">
        </div>
        <div class="form-group">
            <div class="form-group">
                <label for="">Mã quyền</label>
                <select id="" name="MaQuyen" class="form-control">
                    <option <?= ($user->permission_id == '0') ? 'selected' : '' ?> value="0"> Khách hàng</option>
                    <option <?= ($user->permission_id == '1') ? 'selected' : '' ?> value="1"> Nhân viên</option>
                    <option <?= ($user->permission_id == '2') ? 'selected' : '' ?> value="2"> Quản trị viên</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="">Trạng Thái</label>
             <select id="" name="TrangThai" class="form-control">
                    <option <?= ($user->status == '1') ? 'selected' : '' ?> value="1"> Đang sử dụng</option>
                    <option <?= ($user->status == '2') ? 'selected' : '' ?> value="2"> Bị tạm khóa</option>
                    <option <?= ($user->status == '3') ? 'selected' : '' ?> value="3"> Khóa vĩnh viễn</option>
                </select>
        </div>
        <button type="submit" class="btn btn-primary"> Cập Nhật</button>
    </form>
    </tbody>
</table>