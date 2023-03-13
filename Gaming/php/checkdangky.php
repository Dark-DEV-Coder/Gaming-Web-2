<?php
    require_once "./KetnoiCSDL.php";
    $p = new CheckConnection();
    $taikhoan = $_POST['un'];
    $sql = "SELECT * from `tai_khoan` where Username='$taikhoan'";
    $res = $p->ExcuteQuery($sql);
    $count = mysqli_num_rows($res);
    if($count < 1) {
        echo '1';
    } else {
        echo '2';
    }
?>