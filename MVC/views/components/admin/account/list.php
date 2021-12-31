<?php if (isset($_SESSION['isLogin_Admin']) && $_SESSION['isLogin_Admin'] == true) { ?>
<a href="admin/account/add" type="button" class="btn btn-primary btn-add">Thêm mới</a>
<?php } ?>
<?php if (isset($_COOKIE['msg'])) { ?>
  <div class="alert alert-success">
    <strong>Thông báo</strong> <?= $_COOKIE['msg'] ?>
  </div>
<?php } ?>
<hr>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Họ</th>
      <th scope="col">Tên</th>
      <th scope="col">Giới tính</th>
      <th scope="col">Số điện thoại</th>
      <th scope="col">Email</th>
      <th scope="col">Địa chỉ</th>
      <th scope="col">Quyền hạn</th>
      <th>#</th>
    </tr>
  </thead>
  <tbody>
    <?php 
      $users = json_decode($data['userList']);
      foreach ($users as $row) { ?>
      <tr">
        <th scope="row"><?= $row->id ?></th>
        <td><?= $row->firstName ?></td>
        <td><?= $row->lastName ?></td>
        <td><?= $row->gender ?></td>
        <td><?= $row->phone ?></td>
        <td><?= $row->email?></td>
        <td><?= $row->address?></td>
        <td>
          <?php
          if ($row->permission_id == 2) {
            echo 'Quản trị viên';
          } else {
            if ($row->permission_id == 1) {
              echo 'Nhan vien';
            } else {
              echo 'Khach hang';
            }
          }
          ?>
        </td>
        <td>
          <a href="admin/account/detail&id=<?= $row->id ?>" type="button" class="btn btn-success">Xem</a>
          <?php if (isset($_SESSION['isLogin_Admin']) && $_SESSION['isLogin_Admin'] == true) { ?>
          <a href="admin/account/edit&id=<?= $row->id ?>" type="button" class="btn btn-warning">Sửa</a>
          <a href="admin/account/delete&id=<?= $row->id ?>" onclick="return confirm('Bạn có thật sự muốn xóa ?');" type="button" class="btn btn-danger">Xóa</a>
          <?php }?>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>
<script>
  $(document).ready(function() {
    $('#dataTable').DataTable();
  });
</script>