   <?php if (isset($_COOKIE['msg'])) { ?>
       <div class="alert alert-success">
           <strong>Thông báo</strong> <?= $_COOKIE['msg'] ?>
       </div>
   <?php } ?>
   <hr>
   <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
       <?php if (isset($_COOKIE['msg'])) { ?>
           <div class="alert alert-warning">
               <strong>Thông báo</strong> <?= $_COOKIE['msg'] ?>
           </div>
       <?php } ?>
       <form action="admin/account/adduser" method="POST" role="form" enctype="multipart/form-data">
           <div class="form-group">
               <label for="">Họ</label>
               <input type="text" class="form-control" required id="" placeholder="" name="Ho">
           </div>
           <div class="form-group">
               <label for="">Tên</label>
               <input type="text" class="form-control" required id="" placeholder="" name="Ten">
           </div>
           <div class="form-group">
               <label for="">Giới tính</label>
               <select id="" name="GioiTinh" class="form-control">
                   <option value="Nam">Nam</option>
                   <option value="Nữ">Nữ</option>
                   <option value="Khác">Khác</option>
               </select>
           </div>
           <div class="form-group">
               <label for="">Số Điện Thoại</label>
               <input type="text" class="form-control" required id="" placeholder="" name="SDT">
           </div>
           <div class="form-group">
               <label for="">Email</label>
               <input type="Email" class="form-control" required id="" placeholder="" name="Email">
           </div>
           <div class="form-group">
               <label for="">Địa chỉ</label>
               <input type="text" class="form-control" id="" placeholder="" name="DiaChi">
           </div>
           <div class="form-group">
               <label for="">Mật Khẩu</label>
               <input type="Password" class="form-control" required id="" placeholder="" name="MatKhau">
           </div>
           <div class="form-group">
               <div class="form-group">
                   <label for="">Mã quyền</label>
                   <select id="" name="MaQuyen" class="form-control">
                       <option value="0"> Khách hàng</option>
                       <option value="1"> Nhân viên</option>
                       <option value="2"> Quản trị viên</option>
                   </select>
               </div>
           </div>
           <div class="form-group">
               <label for="">Trạng Thái</label>
               <select id="" name="TrangThai" class="form-control">
                   <option value="1"> Đang sử dụng</option>
                   <option value="2"> Bị tạm khóa</option>
                   <option value="3"> Khóa vĩnh viễn</option>
               </select>
           </div>
           <button type="submit" class="btn btn-primary">Create</button>
       </form>
   </table>