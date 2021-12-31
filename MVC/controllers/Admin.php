<?php
class Admin extends Controller
{
    var $ProductModel;
    var $UserModel;
    var $OrderModel;
    public function __construct()
    {
        // Call Models
        $this->ProductModel = $this->model("ProductModel");
        $this->UserModel = $this->model("UserModel");
        $this->OrderModel = $this->model("OrderModel");
    }
    function showAdmin()
    {

        // Call Views
        $this->view("admin", [
            "component" => "login/admin"
            // "productList" =>  $this->ProductModel->getProductList()
        ]);
    }

    function account($action = "list")
    {
        if ($action == "update") {
            $firstname = $_POST['Ho'];
            $lastname = $_POST['Ten'];
            $gender = $_POST['GioiTinh'];
            $phone = $_POST['SDT'];
            $email = $_POST['Email'];
            $address = $_POST['DiaChi'];
            $permission_id = $_POST['MaQuyen'];
            $status = $_POST['TrangThai'];

            $this->UserModel->updateUser($_GET['id'], $firstname, $lastname, $gender, $phone, $email, $address, $permission_id, $status);
        } else 
        if ($action == "adduser") {
            $firstname = $_POST['Ho'];
            $lastname = $_POST['Ten'];
            $gender = $_POST['GioiTinh'];
            $phone = $_POST['SDT'];
            $email = $_POST['Email'];
            $address = $_POST['DiaChi'];
            $pass =  password_hash($_POST['MatKhau'], PASSWORD_DEFAULT);
            $permission_id = $_POST['MaQuyen'];
            $status = $_POST['TrangThai'];
            if ($this->UserModel->insertUser($firstname, $lastname, $gender, $email, $phone, $address, $pass, $permission_id, $status)) {
                setcookie('msg', 'Them thành công!', time() + 2);
                header('Location: http://localhost/shoesphp/admin/account');
            }
        } else 
        if ($action == "delete") {
            if($this->UserModel->deleteUser($_GET['id'])) {
                setcookie('msg', 'Xóa thành công!', time() + 2);
                header('Location: http://localhost/shoesphp/admin/account');
            };
        } else {
            $this->view("admin", [
                "component" => "account/" . $action,
                "userList" => $this->UserModel->getUserList(),
                "userDetail" => $this->UserModel->getUserDetail(isset($_GET['id']) ? $_GET['id'] : '')
            ]);
        }
    }

    function product($action = "list")
    {
        if ($action == "update") {
            $firstname = $_POST['Ho'];
            $lastname = $_POST['Ten'];
            $gender = $_POST['GioiTinh'];
            $phone = $_POST['SDT'];
            $email = $_POST['Email'];
            $address = $_POST['DiaChi'];
            $permission_id = $_POST['MaQuyen'];
            $status = $_POST['TrangThai'];

            $this->UserModel->updateUser($_GET['id'], $firstname, $lastname, $gender, $phone, $email, $address, $permission_id, $status);
        } else 
        if ($action == "adduser") {
            $firstname = $_POST['Ho'];
            $lastname = $_POST['Ten'];
            $gender = $_POST['GioiTinh'];
            $phone = $_POST['SDT'];
            $email = $_POST['Email'];
            $address = $_POST['DiaChi'];
            $pass =  password_hash($_POST['MatKhau'], PASSWORD_DEFAULT);
            $permission_id = $_POST['MaQuyen'];
            $status = $_POST['TrangThai'];
            if ($this->UserModel->insertUser($firstname, $lastname, $gender, $email, $phone, $address, $pass, $permission_id, $status)) {
                setcookie('msg', 'Them thành công!', time() + 2);
                header('Location: http://localhost/shoesphp/admin/account');
            }
        } else 
        if ($action == "delete") {
            if($this->UserModel->deleteUser($_GET['id'])) {
                setcookie('msg', 'Xóa thành công!', time() + 2);
                header('Location: http://localhost/shoesphp/admin/account');
            };
        } else {
            $this->view("admin", [
                "component" => "product/" . $action,
                "productList" => $this->ProductModel->getProductList(),
                "userDetail" => $this->UserModel->getUserDetail(isset($_GET['id']) ? $_GET['id'] : '')
            ]);
        }
    }
}
