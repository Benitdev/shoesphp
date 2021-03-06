<?php
class Cart extends Controller
{
    var $ProductModel;
    public function __construct()
    {
        // Call Models
        $this->ProductModel = $this->model('ProductModel');
    }
    function showCart()
    {

        // Call Views
        $this->view("product", [
            "component" => "Cart"
            // "productList" =>  $this->ProductModel->getProductList()
        ]);
    }
    function addToCart($id) {
        $data = json_decode($this->ProductModel->getProductDetail('', $id));
        if (isset($data)) {
            if (isset($_SESSION['product'][$id]) and $_SESSION['product'][$id]['size'] == $_POST['size']) { 
                $arr = $_SESSION['product'][$id];
                $arr['quantity']++;
                $arr['total'] = $arr['quantity'] * $arr["price"];
                $arr['size'] = $_POST['size'];
                $arr['isChecked'] = true;
                $_SESSION['product'][$id] = $arr;
                $arr['isChecked'] = true;
            } else {
                $arr['id'] = $data->id;
                $arr['name'] = $data->name;
                $arr['price'] = $data->price;
                $arr['quantity'] = 1;
                $arr['slug'] = $data->slug;
                $arr['total'] =  $arr['quantity'] * $arr["price"];
                $arr['avatar'] = $data->avatar;
                $arr['size'] = $_POST['size'];
                $arr['isChecked'] = true;
                $_SESSION['product'][$id] = $arr;
            }

            header('Location: http://localhost/shoesphp/cart');
        }
    }
}
