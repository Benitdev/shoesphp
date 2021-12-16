<?php 
class User extends Controller {
    var $UserModel;
    public function __construct()
    {
        // Call Models
        $this->UserModel = $this->model("UserModel");
    }
    function showUser() {      

        // Call Views
        $this->view("product", [
            "component" => "User",
            // "productList" =>  $this->ProductModel->getProductList()
        ]);
    }

    function logOut()
    {
        unset($_SESSION['login']);
        if(isset($_SESSION['isAdmin'])){
            unset($_SESSION['isAdmin']);
        }
        if(isset($_SESSION['isStaff'])){
            unset($_SESSION['isStaff']);
        }
        if(isset($_SESSION['isLogin'])){
            unset($_SESSION['isLogin']);
        }
        unset($_SESSION['product']);
        header('location: http://localhost/shoesphp/');
    }

}
?>