<?php
class ProductModel extends DB{
    
    function getProductList() {
        $qr = "SELECT * FROM products, product_types, categories
             where products.product_type_id = product_types.id
             and products.category_id = categories.id";
        $rows = mysqli_query($this->con, $qr);
        $products = array();
        while ( $row = mysqli_fetch_assoc($rows)) {
            $products[] = $row;
        }
        return json_encode($products);
    } 

    function getMenList() {
        $qr = "SELECT * FROM categories, product_types, products
            where products.product_type_id = product_types.id
            and products.category_id = categories.id
            and products.category_id = 1";
        $rows = mysqli_query($this->con, $qr);
        $products = array();
        while ( $row = mysqli_fetch_assoc($rows)) {
            $products[] = $row;
        }
        return json_encode($products);
        
    }

    function getWomenList() {
        $qr = "SELECT * FROM products, categories, product_types
            where products.product_type_id = product_types.id
            and products.category_id = categories.id
            and products.category_id = 2";
        $rows = mysqli_query($this->con, $qr);
        $products = array();
        while ( $row = mysqli_fetch_assoc($rows)) {
            $products[] = $row;
        }
        return json_encode($products);
        
    }

    function getProductDetail($name, $id) {
        if ($id == '') {
             $qr = "SELECT * FROM categories, product_types, products
            where products.product_type_id = product_types.id
            and products.category_id = categories.id
            and products.slug = '$name'";
        }
        else {
            $qr = "SELECT  * FROM categories, product_types, products
            where products.product_type_id = product_types.id
            and products.category_id = categories.id
            and products.id = $id";
        }
        $row =  mysqli_query($this->con, $qr);
        $info = mysqli_fetch_assoc($row);
        if (empty($info)) {
            echo 'deo co clg';
        }
        else {
        return json_encode($info);
        }
        
    }
    function getImages($id) {
        $qr = "SELECT * FROM product_images
        where product_id = $id";
        $rows =  mysqli_query($this->con, $qr);
        $images = array();
        while ( $row = mysqli_fetch_assoc($rows)) {
                $images[] = $row;
        }
        return json_encode($images);
    }
}
?>