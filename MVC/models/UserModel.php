<?php
class UserModel extends DB
{

    function insertUser($firstName, $lastName, $gender, $email, $phone, $pass)
    {
        $qr = "INSERT into users VALUE(null, '$firstName', '$lastName',
         '$gender', '$phone','$email', null, '$pass', '2', '1')";
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
}
