<?php
class Product extends Controller {
    var $ProductModel;
    var $CategoryModel;
    public function __construct()
    {
        // Call Models
        $this->ProductModel = $this->model("ProductModel");
        $this->CategoryModel = $this->model("CategoryModel");
    }

    function showProduct() {
        $this->view("product", [
            "component" => "ProductFilter",
            "cate" => "Sản Phẩm",
            "productList" =>  $this->ProductModel->getProductList(),
            "typeList" => $this->CategoryModel->getTypeList()
        ]);
    }
    

    function men() {
        $this->view("product", [
            "component" => "ProductFilter",
            "cate" => "Giày Nam",
            "productList" =>  $this->ProductModel->getMenList(),
            "typeList" => $this->CategoryModel->getTypeList()
        ]);
    }
    function women() {
        $this->view("product", [
            "component" => "ProductFilter",
            "cate" => "Giày Nữ",
            "productList" =>  $this->ProductModel->getWomenList(),
            "typeList" => $this->CategoryModel->getTypeList()
        ]);
    }
    function detail($name = '', $id = '') {
        $info = json_decode($this->ProductModel->getProductDetail($name, $id));
        $this->view("product", [
            "component" => "ProductDetail",
            "productInfo" =>  $this->ProductModel->getProductDetail($name, $id),
            "productImages" =>  $this->ProductModel->getImages($info->id),
            "productSizes" => $this->ProductModel->getSizes($info->id)
        ]);
    }
}
?>
