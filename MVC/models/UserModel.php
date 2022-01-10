<?php
class UserModel extends DB
{

    function getUserList()
    {
        $qr = "SELECT * FROM users";
        $rows = mysqli_query($this->con, $qr);
        $users = array();
        while ($row = mysqli_fetch_assoc($rows)) {
            $users[] = $row;
        }
        return json_encode($users);
    }

    function updateUser($id, $firstName, $lastName, $gender, $phone, $email, $address, $permission_id, $status)
    {
        $qr = "UPDATE users set
                 firstName = '$firstName',
                lastName = '$lastName',
                gender = '$gender',
                phone = '$phone',
                email = '$email',
                address = '$address',
                permission_id = '$permission_id',
                status = '$status'
            where id = '$id'";
        $rs = false;
        if (mysqli_query($this->con, $qr)) {
            $rs = true;
            setcookie('msg', 'Chỉnh sửa thông tin thành công!', time() + 2);
            header('Location: http://localhost/shoesphp/admin/account');
        }
        return $rs;
    }

    function getUserDetail($id = "")
    {
        $qr = "SELECT * FROM users
            where id = '$id'";
        $rows = mysqli_query($this->con, $qr);
        $row = mysqli_fetch_assoc($rows);
        return json_encode($row);
    }

    function insertUser($firstName, $lastName, $gender, $email, $phone, $address = '', $pass,  $permission_id = '0', $status = '1')
    {
        $qr = "INSERT into users VALUE(null, '$firstName', '$lastName',
         '$gender', '$phone','$email', '$address', '$pass', '$permission_id', '$status')";
        $rs = false;
        if (mysqli_query($this->con, $qr)) {
            $rs = true;
        }
        return $rs;
    }
    function deleteUser($id)
    {
        $qr = "DELETE from users where id = '$id'";
        $rs = false;
        if (mysqli_query($this->con, $qr)) {
            $rs = true;
        }
        return $rs;
    }

    function checkEmail($email)
    {
        $qr = "SELECT id from users
        WHERE email = '$email'";

        $rows = mysqli_query($this->con, $qr);
        $rs = false;
        if (mysqli_fetch_array($rows) > 0)
            $rs = true;
        return $rs;
    }

    function checkUser($idLogin, $password)
    {

        $qr = "SELECT * from users
        WHERE email = '$idLogin'
        or phone ='$idLogin'";
        $rows = mysqli_query($this->con, $qr);
        $rs = 0;
        // echo $idLogin;
        $row = mysqli_fetch_assoc($rows);
        if ($row > 0) {
            $rs = 1;
            if (password_verify($password,  $row['password'])) {
                $rs = 2;
                $_SESSION['login'] = $row;
                if ($row['permission_id'] == 2) {
                    $_SESSION['isAdmin'] = true;
                } else {
                    if ($row['permission_id'] == 1) {
                        $_SESSION['isStaff'] = true;
                    } else {
                        $_SESSION['isLogin'] = true;
                    }
                }
            }
        }
        return $rs;
    }

    function insertComment($userId, $productId, $rating, $content)
    {

        $qr = "INSERT into comments VALUE(null, '$userId', '$productId', '$rating', '$content', current_timestamp())";
        $rs = false;
        if (mysqli_query($this->con, $qr)) {
            $rs = true;
        }
        return $rs;
    }

    function getCountOrderStatus($id) {
        $qr = "SELECT count(*) as count FROM `orders`  WHERE user_id = '$id' GROUP BY status";
        $rows =  mysqli_query($this->con, $qr);
        $arr  = array();
        while($row = mysqli_fetch_assoc($rows)) {
            $arr[] = $row;
        };

        return json_encode($arr);
    }

}
