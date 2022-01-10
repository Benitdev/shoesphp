<?php
class OrderModel extends DB
{

    function insertOrder($userId, $subtotal, $coupon, $total, $payMethod, $phone, $address)
    {
        $qr = "INSERT into orders VALUE(null, '$userId', '$subtotal',
         '$coupon', '$total','$payMethod', '$phone', '$address', '0', current_timestamp())";
        $rs = false;
        if (mysqli_query($this->con, $qr)) {
            $rs = true;
            $qr1 = "SELECT id from orders where id = (SELECT max(id) from orders)";
            $rows = mysqli_query($this->con, $qr1);
            $row = mysqli_fetch_assoc($rows);
        }

        $arr = [$rs, $row];
        return json_encode($arr);
    }
    function insertOrderDetail($orderId, $productId, $quantity, $total)
    {
        $qr = "INSERT into order_detail VALUE(null, '$orderId', '$productId', '$quantity', '$total')";
        $rs = false;
        if (mysqli_query($this->con, $qr)) {
            $rs = true;
        }
        return $rs;
    }

    function getOrderItem($id, $status)
    {
        $qr = "SELECT * FROM  coupon, orders WHERE  orders.user_id = '$id' and orders.status = '$status'
        and orders.coupon_id = coupon.id ORDER BY orders.create_at desc";
        $rows = mysqli_query($this->con, $qr);
        while ($row = mysqli_fetch_assoc($rows)) {
            $orderId = $row['id'];
            $qr1 = "SELECT count(*) as number from order_detail where order_id = '$orderId'";
            $rows1 = mysqli_query($this->con, $qr1);
            $id = mysqli_fetch_assoc($rows1);
?>
            <div class="order-item-wrap">
                <!-- <input type="hidden" class="order-id" value=""> -->
                <div class="order-id"> Mã đơn hàng <span><?= $row['id'] ?></span> </div>
                <div class="order-coupon"> Số sản phẩm <span> <?= $id['number'] ?></span> </div>
                <div class="order-total"> Thành tiền
                    <div>
                        <span class="subtotal"><?= $row['subtotal'] ?></span> <span class="total"> <?= $row['total'] ?></span>
                    </div>
                </div>
                <div class="order-address"> Địa chỉ nhận hàng <span> <?= $row['address'] ?></span> </div>
                <div class="order-create-at"><span> <?= $row['create_at'] ?></span></div>
            </div>
        <?php


        }
    }

    function getOrderDetail($id)
    {
        $qr = "SELECT * from  products, order_detail
        where order_detail.product_id = products.id and order_detail.order_id = '$id'";
        $rows = mysqli_query($this->con, $qr);
        while ($row = mysqli_fetch_assoc($rows)) {
        ?>
            <div class="order-detail-item">
                <a href="product/detail/<?php echo $row['slug']?>/<?=$row['product_id']?>" class="img-wrap">
                    <div class="image">
                        <img src="<?php echo $row['avatar'] ?>" alt=''>
                    </div>
                    <div class="info-wrap">
                        <p class="name-wrap">
                            <?php echo $row['name'] ?>
                            <span class="quantity-subcart" style="color: red; background: transparent"> x
                                <?php echo number_format($row['quantity']) ?>
                            </span>
                        </p>
                        <div class="total-item">
                            <?php echo $row['total'] ?>
                        </div>
                    </div>
                </a>
            </div>
<?php
        }
    }
}
