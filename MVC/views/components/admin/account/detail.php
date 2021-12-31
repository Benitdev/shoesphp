<?php 
      $user = json_decode($data['userDetail']);
?>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <h2>Mã Tài Khoản: <?=$user->id?></h2>
    <h2>Họ: <?=$user->firstName ?></h2>
    <h2>Tên: <?=$user->lastName?></h2>
    <h2>Giới tính: <?=$user->gender?></h2>
    <h2>Số điện thoại: <?=$user->phone?></h2>
    <h2>Địa chỉ: <?=$user->address?></h2>
    <h2>Quyền hạn:  <?php
          if ($user->permission_id == 2) {
            echo 'Quản trị viên';
          } else {
            if ($user->permission_id == 1) {
              echo 'Nhân viên';
            } else {
              echo 'Khách hàng';
            }
          }
          ?></h2>
</table>