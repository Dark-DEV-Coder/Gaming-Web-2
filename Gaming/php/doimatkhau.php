<?php
    require_once "./KetnoiCSDL.php";
    $p = new CheckConnection();
    session_start();
    if(isset($_SESSION['taikhoan'])) {
        $mkc = $_POST["matkhaucu"];
        $mkm = $_POST["matkhaumoi"];
        $nlmkm = $_POST["nhaplaimatkhaumoi"];
        $un = $_SESSION['taikhoan']['username'];
        $qr =  "SELECT * FROM tai_khoan WHERE Username='$un'";
        $rows = $p->ExcuteQuery($qr);
        $obj=$rows->fetch_object();
        $hashedPwd = $obj->Password;

        
        if(password_verify($mkc, $hashedPwd)) {
            $hashpwd1 = password_hash($mkm, PASSWORD_DEFAULT);
            $sql1 = "UPDATE `tai_khoan` SET `Password`='$hashpwd1' WHERE Username='$un'";
            $p->ExcuteQuery($sql1);
            echo '1';
        } else {
            echo '2';
        }
    }
    
?>