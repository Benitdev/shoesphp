<?php
class ProductModel extends DB
{

    function getProductList()
    {
        $qr = "SELECT * FROM product_types, categories, products
             where products.product_type_id = product_types.id
             and products.category_id = categories.id";
        $rows = mysqli_query($this->con, $qr);
        $products = array();
        while ($row = mysqli_fetch_assoc($rows)) {
            $products[] = $row;
        }
        return json_encode($products);
    }

    function getSimilarProductList($id)
    {
        $qr = "SELECT * FROM products
        where id = $id";
        $rows = mysqli_query($this->con, $qr);
        $products = array();
        while ($row = mysqli_fetch_assoc($rows)) {

            $cateId = $row['category_id'];
            $typeId = $row['product_type_id'];
            $qr1 = "SELECT * FROM product_types, categories, products
            where products.product_type_id = product_types.id
            and products.category_id = categories.id
            and products.category_id = '$cateId'
            and products.product_type_id = '$typeId'
            LIMIT 5";

            $rows = mysqli_query($this->con, $qr1);
            while ($row = mysqli_fetch_assoc($rows)) {
                $products[] = $row;
            }
        }

        return json_encode($products);
    }

    function getMenList()
    {
        $qr = "SELECT * FROM categories, product_types, products
            where products.product_type_id = product_types.id
            and products.category_id = categories.id
            and products.category_id = 1";
        $rows = mysqli_query($this->con, $qr);
        $products = array();
        while ($row = mysqli_fetch_assoc($rows)) {
            $products[] = $row;
        }
        return json_encode($products);
    }

    function getWomenList()
    {
        $qr = "SELECT * FROM products, categories, product_types
            where products.product_type_id = product_types.id
            and products.category_id = categories.id
            and products.category_id = 2";
        $rows = mysqli_query($this->con, $qr);
        $products = array();
        while ($row = mysqli_fetch_assoc($rows)) {
            $products[] = $row;
        }
        return json_encode($products);
    }

    function getProductDetail($name, $id)
    {
        if ($id == '') {
            $qr = "SELECT * FROM categories, product_types, products
            where products.product_type_id = product_types.id
            and products.category_id = categories.id
            and products.slug = '$name'";
        } else {
            $qr = "SELECT  * FROM categories, product_types, products
            where products.product_type_id = product_types.id
            and products.category_id = categories.id
            and products.id = $id";
        }
        $row =  mysqli_query($this->con, $qr);
        $info = mysqli_fetch_assoc($row);
        if (empty($info)) {
            echo 'deo co clg';
        } else {
            return json_encode($info);
        }
    }
    function getImages($id)
    {
        $qr = "SELECT * FROM product_images
        where product_id = $id";
        $rows =  mysqli_query($this->con, $qr);
        $images = array();
        while ($row = mysqli_fetch_assoc($rows)) {
            $images[] = $row;
        }
        return json_encode($images);
    }

    function getSizes($id)
    {
        $qr = "SELECT * FROM product_sizes
        where product_id = $id";
        $rows =  mysqli_query($this->con, $qr);
        $sizes = array();
        while ($row = mysqli_fetch_assoc($rows)) {
            $sizes[] = $row;
        }
        return json_encode($sizes);
    }

    function filterPrice($start, $end, $type)
    {
        $qr = "SELECT * FROM product_types, categories, products
        where products.product_type_id = product_types.id
        and products.category_id = categories.id
        and price BETWEEN $start AND $end
        and product_types.typeName like '%$type%'";
        $rows =  mysqli_query($this->con, $qr);
        while ($row = mysqli_fetch_assoc($rows)) {
?>
            <a href="product/detail/<?php echo $row['slug'] ?>?id=<?php echo $row['id'] ?>">
                <div class="product-list-item">
                    <img src=" <?= $row['avatar'] ?> " alt="">
                    <span class="cate-name"><?php echo $row['cateName'] ?></span>
                    <div class="product-info">
                        <h4>
                            <?php echo $row['name'] ?>
                        </h4>
                        <div class="desc">
                            <?php echo $row['typeName'] ?>
                        </div>
                        <span class="price"> <?php echo number_format($row['price']) ?> VNĐ</span>
                    </div>
                </div>
            </a>

        <?php
        }
    }

    function search($value)
    {
        $qr = "SELECT * FROM product_types, categories, products
        where products.product_type_id = product_types.id
        and products.category_id = categories.id
        and products.name like '%$value%'
        LIMIT 5";
        $rows =  mysqli_query($this->con, $qr);
        while ($row = mysqli_fetch_assoc($rows)) {
        ?>
            <a href="product/detail/<?php echo $row['slug'] ?>?id=<?php echo $row['id'] ?>">
                <div class="product-list-item">
                    <img src=" <?= $row['avatar'] ?> " alt="">
                    <!-- <span class="cate-name"><?php echo $row['cateName'] ?></span> -->
                    <div class="product-info">
                        <div>
                            <h4>
                                <?php echo $row['name'] ?>
                            </h4>
                            <p> <?= $row['typeName'] ?></p>

                        </div>
                        <p class="price"> <?php echo $row['price'] ?></p>
                    </div>
                </div>
            </a>

        <?php
        }
    }

    function getComments($id)
    {
        $qr = "SELECT * FROM users, comments
        where comments.product_id = '$id' and comments.user_id = users.id
        ORDER BY comments.create_at DESC";
        $rows =  mysqli_query($this->con, $qr);
        while ($row = mysqli_fetch_assoc($rows)) {
        ?>
        <div class="comment-wrap">
            <input type="hidden" class="numberofstar" value="<?=$row['rating']?>">
            <div class="avatar">
                <img src="" alt="">
            </div>
            <div class="content">
                <small><?=$row['firstName'].' '.$row['lastName']?></small>
                <div class="rating-star">
                            <input type="radio" <?=$row['rating'] == 10?'checked':''?> disabled>
                            <input type="radio" <?=$row['rating'] == 9?'checked':''?> disabled>
                            <input type="radio" <?=$row['rating'] == 8?'checked':''?> disabled>
                            <input type="radio" <?=$row['rating'] == 7?'checked':''?> disabled>
                            <input type="radio" <?=$row['rating'] == 6?'checked':''?> disabled>
                            <input type="radio" <?=$row['rating'] == 5?'checked':''?> disabled>
                            <input type="radio" <?=$row['rating'] == 4?'checked':''?> disabled>
                            <input type="radio" <?=$row['rating'] == 3?'checked':''?> disabled>
                            <input type="radio" <?=$row['rating'] == 2?'checked':''?> disabled>
                            <input type="radio" <?=$row['rating'] == 1?'checked':''?> disabled>
                 </div>
                 <div class="content">
                     <?=$row['content']?>
                 </div>
                <small> <?=$row['create_at']?></small>
            </div>
        </div>
<?php
        }
    }

    function getRatingProduct($id) {
        $qr ="SELECT sum(rating) as rating, COUNT(*) as count FROM comments
        where comments.product_id = '$id'
        ORDER BY comments.create_at DESC";
        $rows =  mysqli_query($this->con, $qr);
        $row = mysqli_fetch_assoc($rows);

        return json_encode($row);
          
    }

    function getCountEachStar($id, $star) {
        $qr ="SELECT  * FROM comments
        where comments.product_id = '$id'
        and rating = '$star'
        ORDER BY comments.create_at DESC";
        $rows =  mysqli_query($this->con, $qr);
        ?>
        <input type="hidden">
        <?php
        while($row = mysqli_fetch_assoc($rows)) {

        };

        return json_encode($row);
          
    }
}
?>