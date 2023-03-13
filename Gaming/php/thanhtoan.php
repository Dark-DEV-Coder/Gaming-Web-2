<?php 
 if(isset($_POST['ho']) && isset($_POST['ten']) && isset($_POST['email']) && isset($_POST['diachi']) && isset($_POST['sdt'])){
    require_once "./KetnoiCSDL.php";
    $p = new CheckConnection();
    session_start();
    $output=true;
    $tk='';
    if(isset($_SESSION['taikhoan'])){
        $tk=$_SESSION['taikhoan']['makhachhang'];
    }else{
        $tk="null";
    }
    if(isset($_SESSION['cart'])){
        if($_SESSION['stt']<1){
            echo 1;
        }else{
            $sel="SELECT * FROM `hoa_don` ";
            $res=$p->ExcuteQuery($sel);
            $sl = mysqli_num_rows($res);
            $mhd="HD".($sl+1);
            $today = date("Y-m-d");
            foreach($_SESSION['cart'] as $key => $value){
                $sqlslsp = "SELECT SoLuong FROM `san_pham` WHERE MaNhomSP = '".$value['MaNhomSP']."'";
                $resslsp = $p->ExcuteQuery($sqlslsp);
                //$p->ExcuteQuery($resslsp);
                $obj1=$resslsp->fetch_object();
                if($obj1->SoLuong<$value['SoLuong']){
                    $_SESSION['stt'] -= $value['SoLuong'];
                    $_SESSION['odertotal']-=$value['TongCong'];
                    $_SESSION['Tongtien']-=$value['GiaBan']*$value['SoLuong'];
                    $_SESSION['Tongtienkm']-=$value['GiaKM']*$value['SoLuong'];
                    unset($_SESSION['cart'][$value['MaNhomSP']]);
                    $output=false;
                }
            }
            if($output==true){
                $sql="INSERT INTO `hoa_don`(`MaHD`, `MaKH`, `MaNV`, `Ho`, `Ten`, `Sdt`, `DiaChi`, `Email`, `NgayLapHD`, `TongTien`, `TongTienKM`, `TongPhaiTra`, `TinhTrang`) 
                        VALUES ('".$mhd."','".$tk."','null','".$_POST['ho']."','".$_POST['ten']."','".$_POST['sdt']."','".$_POST['diachi']."','".$_POST['email']."','".$today."',".$_SESSION['Tongtien'].",".$_SESSION['Tongtienkm'].",".$_SESSION['odertotal'].",1)";
                        $p->ExcuteQuery($sql);
                foreach($_SESSION['cart'] as $key => $value){
                    $makm='null';
                    if($value['GiaKM']>0){
                        $sqlKM = "SELECT km.MaKM FROM `khuyen_mai` km, `chi_tiet_km` ctkm, `san_pham` sp WHERE km.NgayBD <= '".$today."' and km.NgayKT >= '".$today."' and km.MaKM=ctkm.MaKM and ctkm.MaNhomSP = sp.MaNhomSP and sp.MaNhomSP='".$value['MaNhomSP']."'";
                        $rs=$p->ExcuteQuery($sqlKM);
                        $obj=$rs->fetch_object();
                        $makm=$obj->MaKM;
                    }
                    $sqlslsp = "SELECT SoLuong FROM `san_pham` WHERE MaNhomSP = '".$value['MaNhomSP']."'";
                    $resslsp = $p->ExcuteQuery($sqlslsp);
                    //$p->ExcuteQuery($resslsp);
                    $obj1=$resslsp->fetch_object();
                        $query="INSERT INTO `chi_tiet_hoa_don`(`MaHD`, `MaNhomSP`, `MaKM`, `SoLuong`, `DonGia`, `ThanhTien`, `TienKM`) VALUES ('".$mhd."','".$value['MaNhomSP']."','".$makm."','".$value['SoLuong']."','".$value['GiaBan']."','".$value['TongCong']."','".$value['GiaKM']."')";
                        $p->ExcuteQuery($query);
                        $sqlupsl = "UPDATE `san_pham` SET SoLuong=".$obj1->SoLuong-$value['SoLuong']." WHERE MaNhomSP = '".$value['MaNhomSP']."'";
                        $p->ExcuteQuery($sqlupsl);
                    }
                    unset($_SESSION['cart']);
                    unset($_SESSION['Tongtien']);
                    unset($_SESSION['Tongtienkm']);
                    unset($_SESSION['odertotal']);
                    unset($_SESSION['Tongtien']);
                    unset($_SESSION['stt']);
                    echo 0;
            }else{
            // unset($_SESSION['cart']);
            // unset($_SESSION['Tongtien']);
            // unset($_SESSION['Tongtienkm']);
            // unset($_SESSION['odertotal']);
            // unset($_SESSION['Tongtien']);
            // unset($_SESSION['stt']);
            echo 2;
        
            }
        }
            
        }else{
            echo 1;
        }
    }
 
?>