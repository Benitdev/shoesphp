<?php if (isset($_SESSION['isLogin_Admin']) && $_SESSION['isLogin_Admin'] == true) { ?>
<a href="?mod=sanpham&act=add" type="button" class="btn btn-primary">Thêm mới</a>
<?php } ?>
<?php if (isset($_COOKIE['msg'])) { ?>
  <div class="alert alert-success">
    <strong>Thông báo</strong> <?= $_COOKIE['msg'] ?>
  </div>
<?php } 
  $products = json_decode($data['productList']);
?>
<hr>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
  <thead>
    <tr>
      <th scope="col">Mã sản phẩm</th>
      <th scope="col">Tên sản phẩm</th>
      <th scope="col">Giá thành</th>
      <th scope="col">Số lượng</th>
      <th scope="col">Trạng thái</th>
      <th>#</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($products as $row) { ?>
      <tr>
        <th scope="row"><?= $row->id ?></th>
        <td><?= $row->name ?></td>
        <td><?= $row->price ?> VNĐ</td>
        <td><?= $row->quantity ?></td>
        <td><?= $row->avatar?> </td>
        <td>
          <a href="admin/product/detail&id=<?= $row->id ?>" type="button" class="btn btn-success" target="_blank">Xem</a>
          <?php if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) { ?>
          <a href="admin/product/edit&id=<?= $row->id ?>" type="button" class="btn btn-warning">Sửa</a>
          <a href="admin/product/delete&id=<?= $row->id ?>" onclick="return confirm('Bạn có thật sự muốn xóa ?');" type="button" class="btn btn-danger">Xóa</a>
          <?php } ?>
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