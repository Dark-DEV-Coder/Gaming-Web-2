<?php
    require_once "./KetnoiCSDL.php";
    session_start();
    $p = new CheckConnection();
    $id = $_POST['id'];

    $query = "SELECT * FROM san_pham WHERE MaNhomSP = '$id'";
    $res1=$p->ExcuteQuery($query);
    $obj=$res1->fetch_object();
    if(isset($_POST['id'])) {
        if(isset($_SESSION['cart'])) {
            if(isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id]['SoLuong'] += 1;
                
            } else {
                $_SESSION['cart'][$id]['MaNhomSP'] = $obj->MaNhomSP;
                $_SESSION['cart'][$id]['MaLoai'] = $obj->MaLoai;
                $_SESSION['cart'][$id]['MaNSX'] = $obj->MaNSX;
                $_SESSION['cart'][$id]['Ten'] = $obj->Ten;
                $_SESSION['cart'][$id]['HinhAnh'] = $obj->HinhAnh;
                $_SESSION['cart'][$id]['MoTa'] = $obj->MoTa;
                $_SESSION['cart'][$id]['GiaBan'] = $obj->GiaBan;
                $_SESSION['cart'][$id]['GiaKM'] = $obj->GiaKM;
                $_SESSION['cart'][$id]['SoLuong'] = 1;
               
            }
        }else {
            $_SESSION['cart'][$id]['MaNhomSP'] = $obj->MaNhomSP;
            $_SESSION['cart'][$id]['MaLoai'] = $obj->MaLoai;
            $_SESSION['cart'][$id]['MaNSX'] = $obj->MaNSX;
            $_SESSION['cart'][$id]['Ten'] = $obj->Ten;
            $_SESSION['cart'][$id]['HinhAnh'] = $obj->HinhAnh;
            $_SESSION['cart'][$id]['MoTa'] = $obj->MoTa;
            $_SESSION['cart'][$id]['GiaBan'] = $obj->GiaBan;
            $_SESSION['cart'][$id]['GiaKM'] = $obj->GiaKM;
            $_SESSION['cart'][$id]['SoLuong'] = 1;
           
        }
    }
    $sqlslsl = "SELECT SoLuong FROM `san_pham` WHERE MaNhomSP='$id'";
    $resslsl = $p->ExcuteQuery($sqlslsl);
    $soluong = $resslsl->fetch_object();
    $_SESSION['odertotal']=0;
    $_SESSION['cart'][$id]['TongCong']=0;
    $_SESSION['TongSoLuong']=0;
    $_SESSION['cart'][$id]['TongCong']=0;
    $_SESSION['Tongtien']=0;
    $_SESSION['Tongtienkm']=0;
    $_SESSION['stt']=0;
    if($_SESSION['cart'][$id]['SoLuong'] > $soluong->SoLuong) {
        $_SESSION['cart'][$id]['SoLuong']= (int)$soluong->SoLuong;         
    } else {
        $_SESSION['TongSoLuong']+=$_SESSION['cart'][$id]['SoLuong'];
    }

    foreach($_SESSION['cart'] as $keys => $values) {
        if($values['GiaKM']>0){
            $_SESSION['odertotal']+=$values['GiaKM']*$values['SoLuong'];
            $_SESSION['cart'][$id]['TongCong']=$values['GiaKM']*$values['SoLuong'];
        }else{
            $_SESSION['odertotal']+=$values['GiaBan']*$values['SoLuong'];
            $_SESSION['cart'][$id]['TongCong']=$values['GiaBan'];
        }
        $_SESSION['TongSoLuong']+=$values['SoLuong'];
        $_SESSION['Tongtien']+=$values['GiaBan']*$values['SoLuong'];
        $_SESSION['Tongtienkm']+=$values['GiaKM']*$values['SoLuong'];
        $_SESSION['stt']+=$values['SoLuong'];
    }

    echo 1;
?>