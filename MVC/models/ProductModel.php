<?php
class ProductModel extends DB{
    
    function getProductList() {
        $qr = "SELECT * FROM products";
        $rows = mysqli_query($this->con, $qr);
        $products = array();
        while ( $row = mysqli_fetch_assoc($rows)) {
            $products[] = $row;
        }
        return json_encode($products);
    }   
}
?>