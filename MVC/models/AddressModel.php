<?php
class AddressModel extends DB{
    
    function getProvince() {
        $qr = "SELECT * FROM province";
        $rows = mysqli_query($this->con, $qr);
        $provinces = array();
        while ( $row = mysqli_fetch_assoc($rows)) {
            $provinces[] = $row;
        }
        return json_encode($provinces);
    }   
    function getDistrict($id) {
        $qr = "SELECT * FROM district
            where district._province_id = $id";
        $rows = mysqli_query($this->con, $qr);
        $districts = array();
        while ( $row = mysqli_fetch_assoc($rows)) {
            $districts[] = $row;
        }
        return json_encode($districts);
    }   
    function getWard($id) {
        $qr = "SELECT * FROM ward
            where  _district_id = $id";
        $rows = mysqli_query($this->con, $qr);
        $wards = array();
        while ( $row = mysqli_fetch_assoc($rows)) {
            $wards[] = $row;
        }
        return json_encode($wards);
    }   
}
?>