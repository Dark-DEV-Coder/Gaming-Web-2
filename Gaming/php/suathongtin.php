<?php
    require_once "./KetnoiCSDL.php";
    $p = new CheckConnection();
    session_start();
    if(isset($_SESSION['taikhoan'])) {
        $ho = $_POST['ho'];
        $ten = $_POST['ten'];
        $email = $_POST['email'];
        $sodienthoai = $_POST['sodienthoai'];
        $ngaysinh = $_POST['ngaysinh'];
        $diachi = $_POST['diachi'];
        $gt = $_POST['gt'];
        $un = $_SESSION['taikhoan']['username'];
        $sql = "SELECT * from `tai_khoan` where Username='$un'";
        $res = $p->ExcuteQuery($sql);
        $count = mysqli_num_rows($res);

        $qr1 =  "SELECT kh.*, tk.MaQuyen, tk.Username FROM tai_khoan tk, khach_hang kh WHERE kh.MaTK=tk.MaTK and Username='$un'";
        $rows1 = $p->ExcuteQuery($qr1);
        $obj1=$rows1->fetch_object();
        $count1 = mysqli_num_rows($rows1);

        $qr2 =  "SELECT nv.*, tk.MaQuyen, tk.Username FROM tai_khoan tk, nhan_vien nv WHERE nv.MaTK=tk.MaTK and Username='$un'";
        $rows2 = $p->ExcuteQuery($qr2);
        $obj2=$rows2->fetch_object();
        $count2 = mysqli_num_rows($rows2);

        if($count == 1) {
            
            if($count1 >= 1) {
                $makh = $_SESSION['taikhoan']['makhachhang'];
                $sql1 = "UPDATE khach_hang SET Ho='$ho', Ten='$ten', NgaySinh='$ngaysinh', GioiTinh='$gt', DiaChi='$diachi', Sdt='$sodienthoai', Email='$email' WHERE MaKH = '$makh'";
                $_SESSION['taikhoan']['ho'] = $ho;
                $_SESSION['taikhoan']['ten'] = $ten;
                $_SESSION['taikhoan']['ngaysinh'] = $ngaysinh;
                $_SESSION['taikhoan']['gioitinh'] = $gt;
                $_SESSION['taikhoan']['diachi'] = $diachi;
                $_SESSION['taikhoan']['sdt'] = $sodienthoai;
                $_SESSION['taikhoan']['email'] = $email;
            } else if($count2 >= 1) {
                $makh = $_SESSION['taikhoan']['makhachhang'];
                $sql1 = "UPDATE nhan_vien SET Ho='$ho', Ten='$ten', NgaySinh='$ngaysinh', GioiTinh='$gt', DiaChi='$diachi', Sdt='$sodienthoai', WHERE MaNV = '$makh'";

                $_SESSION['taikhoan']['ho'] = $ho;
                $_SESSION['taikhoan']['ten'] = $ten;
                $_SESSION['taikhoan']['ngaysinh'] = $ngaysinh;
                $_SESSION['taikhoan']['gioitinh'] = $gt;
                $_SESSION['taikhoan']['diachi'] = $diachi;
                $_SESSION['taikhoan']['sdt'] = $sodienthoai;
            }
            echo '1';
        } else {
            echo '2';
        }
    }
?>