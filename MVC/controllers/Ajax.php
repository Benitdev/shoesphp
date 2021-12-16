<?php
class Ajax extends Controller
{
    var $UserModel;
    public function __construct()
    {
        // Call Models
        $this->UserModel = $this->model("UserModel");
    }
    function checkEmail()
    {
        $un = $_POST['un'];
        echo $this->UserModel->checkEmail($un);
    }

    function register()
    {
        $firstName =  $_POST['firstname'];
        $lastName =  $_POST['lastname'];
        $gender =  $_POST['gender'];
        $email =  $_POST['email'];
        $phone =  $_POST['phone'];
        $pass =  password_hash($_POST['pass'], PASSWORD_DEFAULT);

        echo $this->UserModel->insertUser($firstName, $lastName, $gender, $email, $phone, $pass);
    }
    function login()
    {
        $idLogin = $_POST['idlogin'];
        $password = $_POST['password'];
        echo  $this->UserModel->checkUser($idLogin, $password);
    }

    function delCart()
    {
        $id = $_POST['id'];
        unset($_SESSION['product'][$id]);
    }
    function changeQuantityCart()
    {
        $id = $_POST['id'];
        $quantity = $_POST['quantity'];
        $_SESSION['product'][$id]['quantity'] = $quantity;
        $_SESSION['product'][$id]['total'] = $quantity * $_SESSION['product'][$id]['price'];
        echo number_format($_SESSION['product'][$id]['total']);
    }

    function totalOrder() {

        $count = 0;
        $fee = 0;
        foreach ($_SESSION['product'] as $value) {
            $count += $value['total'];
            $fee += ($value['total'] * 1 / 200);
        }
        $total = $count - $fee;
        $arr = [number_format($count), number_format($fee), number_format($total)];
        echo json_encode($arr);
    }
}
