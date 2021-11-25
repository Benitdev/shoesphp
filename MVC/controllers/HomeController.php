<?php 
class Home extends Controller {
    var $ProductModel;
    public function __construct()
    {
        // Call Models
        $this->ProductModel = $this->model("ProductModel");
    }
    public function showHome(){      

        // Call Views
        $this->view("home", [
            "productList" =>  $this->ProductModel->getProductList()
        ]);
    }
}
?>