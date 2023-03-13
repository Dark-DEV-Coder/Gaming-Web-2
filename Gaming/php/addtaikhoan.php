<?php
    require_once "./KetnoiCSDL.php";
    $p = new CheckConnection();
    $ho = $_POST['ho'];
    $ten = $_POST['ten'];
    $taikhoan = $_POST['taikhoan'];
    $matkhau = $_POST['matkhau'];
    $nhaplaimatkhau = $_POST['nhaplaimatkhau'];
    $email = $_POST['email'];
    $sodienthoai = $_POST['sodienthoai'];
    $ngaysinh = $_POST['ngaysinh'];
    $diachi = $_POST['diachi'];
    $gt = $_POST['gt'];
    $sql = "SELECT * from `tai_khoan` where Username='$taikhoan'";
    $res = $p->ExcuteQuery($sql);
    $count = mysqli_num_rows($res);
    if($count < 1) {
        $sqlkh = "SELECT * FROM khach_hang";
        $reskh = $p->ExcuteQuery($sqlkh);
        $countkh = mysqli_num_rows($reskh);   
        $idkh = "KH".$countkh;

        $hashpwd = password_hash($matkhau, PASSWORD_DEFAULT);
        
        $sqltk = "SELECT * FROM tai_khoan";  
        $restk = $p->ExcuteQuery($sqltk);
        $counttk = mysqli_num_rows($restk); 
        $idtk = "TK".$counttk;
        $qrtk =   "INSERT INTO tai_khoan VALUES('$idtk', 'KH', '$taikhoan', '$hashpwd', '1')";
        $p->ExcuteQuery($qrtk);
        
        $qrkh = "INSERT INTO khach_hang VALUES('$idkh', '$idtk', '$ho','$ten', '$ngaysinh', '$gt', '$diachi', '$sodienthoai', '$email', '1')";
        $p->ExcuteQuery($qrkh);
        echo '1';
    } else {
        echo '2';
    }
?>