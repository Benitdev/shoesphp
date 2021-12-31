<?php
class Checkout extends Controller
{
    var $AddressModel;
    public function __construct()
    {
        // Call Models
        $this->AddressModel = $this->model('AddressModel');
    }
    function showCheckout()
    {

        // Call Views
        $this->view("product", [
            "component" => "Checkout",
            // "productList" =>  $this->ProductModel->getProductList()
            "province" => $this->AddressModel->getProvince()
        ]);
    }
}
