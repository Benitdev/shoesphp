<?php
class Ajax extends Controller
{
    var $UserModel;
    var $AddressModel;
    var $CouponModel;
    var $OrderModel;
    var $ProductModel;
    public function __construct()
    {
        // Call Models
        $this->UserModel = $this->model("UserModel");
        $this->AddressModel = $this->model('AddressModel');
        $this->CouponModel = $this->model('CouponModel');
        $this->OrderModel = $this->model('OrderModel');
        $this->ProductModel = $this->model("ProductModel");

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

        echo $this->UserModel->insertUser($firstName, $lastName, $gender, $email, $phone, '', $pass);
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
        echo $_SESSION['product'][$id]['total'];
    }

    function selectCart()
    {
        $id = $_POST['id'];
        $_SESSION['product'][$id]['isChecked'] = true;
    }
    function unSelectCart()
    {
        $id = $_POST['id'];
        $_SESSION['product'][$id]['isChecked'] = false;
    }

    function totalOrder()
    {

        $count = 0;
        $fee = 0;
        $totalCart = 0;
        $arr = [0, 0, 0];
        if (isset($_SESSION['product'])) {
            foreach ($_SESSION['product'] as $value) {
                if ($value['isChecked']) {
                    $count += $value['total'];
                    $fee += ($value['total'] * 1 / 200);
                }
                $totalCart += $value['total'];
            }
            $arr = [$count, $fee, $totalCart];
        }
        echo json_encode($arr);
    }

    //get address
    function getDistrict()
    {
        $id = $_POST['id'];
        echo $this->AddressModel->getDistrict($id);
    }
    function getWard()
    {
        $id = $_POST['id'];
        echo $this->AddressModel->getWard($id);
    }

    //check coupon
    function checkCoupon()
    {
        $code = $_POST['code'];
        echo $this->CouponModel->checkCoupon($code);
    }

    //insert order
    function insertOrder()
    {
        $subtotal = $_POST['subtotal'];
        $coupon = $_POST['couponId'];
        $total = $_POST['total'];
        $payMethod = $_POST['method'];
        $phone = $_POST['checkoutPhone'];
        $address = $_POST['address'];

          echo $this->OrderModel->insertOrder($_SESSION['login']['id'], $subtotal, $coupon, $total, $payMethod, $phone, $address);
    }

    function insertOrderDetail()
    {
        $orderId = $_POST['orderId'];
        $id = $_POST['productId'];
        $quantity = $_POST['productQuantity'];
        $total = $_POST['productTotal'];

        echo $this->OrderModel->insertOrderDetail($orderId, $id, $quantity, $total);
    }

    function filter() {
        $start = isset($_POST['start']) ? $_POST['start']: 1000000;
        $end = isset($_POST['end']) ? $_POST['end']: 10000000;
        $type = isset($_POST['type']) ? $_POST['type']: '';
        
        // echo $start, $end, $type;
        $this->ProductModel->filterPrice($start, $end, $type);
    }

    function search() {
        $value = $_POST['value'];
        
        $this->ProductModel->search($value);
    }

    function insertComment() {
        $id = $_POST['productId'];
        $rating = $_POST['rating'];
        $content = $_POST['content'];

        echo $this->UserModel->insertComment($_SESSION['login']['id'], $id, $rating, $content);
    }
    
    function getComments() {
        $id = $_POST['productId'];

        $this->ProductModel->getcomments($id);
    }

    function getRating() {
        $id = $_POST['productId'];

        echo $this->ProductModel->getRatingProduct($id);
    }

    function getCountOrderStatus() {

        echo $this->UserModel->getCountOrderStatus($_SESSION['login']['id']);
    }

    function getOrderItem() {
        $status = $_POST['status'];

        echo $this->OrderModel->getOrderItem($_SESSION['login']['id'], $status);
    }
    function getOrderDetail() {
        $id = $_POST['orderId'];

        echo $this->OrderModel->getOrderDetail($id);
    }
}

