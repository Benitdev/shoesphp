<?php
class CouponModel extends DB
{

    function checkCoupon($code)
    {
        $qr = "SELECT * FROM coupon
        where code = '$code'";
        $rows = mysqli_query($this->con, $qr);
        $row = mysqli_fetch_array($rows);
        $arr = [0, '', ''];
        if ($row > 0) {
            if (strtotime($row['date_end']) > strtotime(date("Y-m-d"))) {
                if ($row['type'] == 'percent')
                    $arr = [1, $row['value'], $row['id']];
                else
                    $arr = [2, $row['value'], $row['id']];
            } else
                $arr = [3, '', ''];
        }

        return json_encode($arr);
    }
}
