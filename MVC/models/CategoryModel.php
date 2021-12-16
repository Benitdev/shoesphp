<?php
class CategoryModel extends DB{
    
    function getCateList() {
        $qr = "SELECT * FROM categories";
        $rows = mysqli_query($this->con, $qr);
        $categories = array();
        while ( $row = mysqli_fetch_assoc($rows)) {
            $categories[] = $row;
        }
        return json_encode($categories);
    }   

    function getTypeList() {
        $qr = "SELECT * FROM product_types";
        $rows = mysqli_query($this->con, $qr);
        $types = array();
        while ( $row = mysqli_fetch_assoc($rows)) {
            $types[] = $row;
        }
        return json_encode($types);
    }   

    
    
}
?>