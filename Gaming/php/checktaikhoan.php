<?php
    require_once "./KetnoiCSDL.php";
    $p = new CheckConnection();
    session_start();
    if(isset($_POST['un']) && $_POST['un'] && isset($_POST['pwd']) && $_POST['pwd']) {
        $un = $_POST["un"];
        $pwd = $_POST["pwd"];
        $qr =  "SELECT * FROM tai_khoan WHERE Username='$un' and TinhTrang!=0";
        $rows = $p->ExcuteQuery($qr);
        $obj=$rows->fetch_object();
        $hashedPwd="";
        if(mysqli_num_rows($rows)==1) {
            $hashedPwd = $obj->Password;
        }
        $qr1 =  "SELECT kh.*, tk.MaQuyen, tk.Username FROM tai_khoan tk, khach_hang kh WHERE kh.MaTK=tk.MaTK and Username='$un' and kh.TinhTrang!=0";
        $rows1 = $p->ExcuteQuery($qr1);
        $obj1=$rows1->fetch_object();
        $count1 = mysqli_num_rows($rows1);

        $qr2 =  "SELECT nv.*, tk.MaQuyen, tk.Username FROM tai_khoan tk, nhan_vien nv WHERE nv.MaTK=tk.MaTK and Username='$un' and nv.TinhTrang!=0";
        $rows2 = $p->ExcuteQuery($qr2);
        $obj2=$rows2->fetch_object();
        $count2 = mysqli_num_rows($rows2);

        if(password_verify($pwd, $hashedPwd)) {

            if($count1 >= 1) {
                $_SESSION['taikhoan']['makhachhang'] = $obj1->MaKH;
                $_SESSION['taikhoan']['mataikhoan'] = $obj1->MaTK;
                $_SESSION['taikhoan']['ho'] = $obj1->Ho;
                $_SESSION['taikhoan']['ten'] = $obj1->Ten;
                $_SESSION['taikhoan']['ngaysinh'] = $obj1->NgaySinh;
                $_SESSION['taikhoan']['gioitinh'] = $obj1->GioiTinh;
                $_SESSION['taikhoan']['diachi'] = $obj1->DiaChi;
                $_SESSION['taikhoan']['sdt'] = $obj1->Sdt;
                $_SESSION['taikhoan']['email'] = $obj1->Email;
                $_SESSION['taikhoan']['quyen'] = $obj1->MaQuyen;
                $_SESSION['taikhoan']['username'] = $obj1->Username;
            } else if($count2 >= 1) {
                $_SESSION['taikhoan']['makhachhang'] = $obj2->MaNV;
                $_SESSION['taikhoan']['mataikhoan'] = $obj2->MaTK;
                $_SESSION['taikhoan']['ho'] = $obj2->Ho;
                $_SESSION['taikhoan']['ten'] = $obj2->Ten;
                $_SESSION['taikhoan']['ngaysinh'] = $obj2->NgaySinh;
                $_SESSION['taikhoan']['gioitinh'] = $obj2->GioiTinh;
                $_SESSION['taikhoan']['diachi'] = $obj2->DiaChi;
                $_SESSION['taikhoan']['sdt'] = $obj2->Sdt;
                $_SESSION['taikhoan']['tienluong'] = $obj2->TienLuong;
                $_SESSION['taikhoan']['quyen'] = $obj2->MaQuyen;
                $_SESSION['taikhoan']['username'] = $obj2->Username;
            }
            echo '1';
        } else {
            echo '2';
        }
    }
    
?>