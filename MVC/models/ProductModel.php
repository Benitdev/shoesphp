<?php
class ProductModel extends DB{
    
    function getProductList() {
        $qr = "SELECT * FROM products, product_types, categories
             where products.product_type_id = product_types.id
             and product_types.category_id = categories.id";
        $rows = mysqli_query($this->con, $qr);
        $products = array();
        while ( $row = mysqli_fetch_assoc($rows)) {
            $products[] = $row;
        }
        return json_encode($products);
    }   
}
?>