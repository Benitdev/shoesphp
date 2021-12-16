<?php 
class Home extends Controller {
    var $ProductModel;
    var $UserModel;
    public function __construct()
    {
        // Call Models
        $this->ProductModel = $this->model("ProductModel");
        $this->UserModel = $this->model("UserModel");
    }
    function showHome() {      

        // Call Views
        $this->view("home", [
            "component" => "home",
            "productList" =>  $this->ProductModel->getProductList()
        ]);
    }

}
?>