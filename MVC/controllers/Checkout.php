<?php
class Checkout extends Controller
{
    var $ProductModel;
    public function __construct()
    {
        // Call Models
        $this->ProductModel = $this->model('ProductModel');
    }
    function showCheckout()
    {

        // Call Views
        $this->view("product", [
            "component" => "Checkout"
            // "productList" =>  $this->ProductModel->getProductList()
        ]);
    }
}
