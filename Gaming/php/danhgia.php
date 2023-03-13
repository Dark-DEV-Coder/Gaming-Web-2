<?php
    require_once "./KetnoiCSDL.php";
    session_start();
    $p = new CheckConnection();
    $idsp = $_POST['idsp'];
    $sosao = $_POST['sosao'];
    $binhluan = $_POST['binhluan'];
    if(isset($_SESSION['taikhoan'])) {
        $taikhoan = $_SESSION['taikhoan']['mataikhoan'];
    }
    

    $sqldg = "SELECT * FROM danh_gia_sp";
    $resdg = $p->ExcuteQuery($sqldg);
    $countdg = mysqli_num_rows($resdg);   
    $iddg = "BL".($countdg+1);
    
    $qrdg = "INSERT INTO danh_gia_sp VALUES('$iddg', '$taikhoan', '$idsp','$sosao', '$binhluan', '1')";
    $p->ExcuteQuery($qrdg);
    echo '1';
?>