<?php
    require_once("./KetnoiCSDL.php");
    $p=new CheckConnection();
    if (isset($_POST['kieu'])){
        $kieu=$_POST['kieu'];
        if ($kieu=="thempnh"){
            session_start();
            $mansx=$_POST['mansx'];
            $ngay=$_POST['ngay'];
            $matk=$_SESSION['matk'];
            $sql1="SELECT * FROM nhan_vien WHERE MaTK='$matk'";
            $rs1=$p->ExcuteQuery($sql1);
            $r1=mysqli_fetch_row($rs1);
            $demsl="SELECT * from phieu_nhap_hang";
            $dem=$p->ExcuteQuery($demsl);
            $mapnh='PNH'.(mysqli_num_rows($dem)+1);
            $sql="INSERT INTO `phieu_nhap_hang`(`MaPNH`, `MaNV`, `MaNSX`, `TongTien`, `NgayNhap`, `TinhTrang`) 
            VALUES ('$mapnh','$r1[0]','$mansx','0','$ngay',1)";
            $p->ExcuteQuery($sql);                
            echo 1;            
        }
        if ($kieu=="suapnh"){
            session_start();
            $id=$_POST['id'];
            $mansx=$_POST['mansx'];
            $ngay=$_POST['ngay'];
            $matk=$_SESSION['matk'];
            $sql1="SELECT * FROM nhan_vien WHERE MaTK='$matk'";
            $rs1=$p->ExcuteQuery($sql1);
            $r1=mysqli_fetch_row($rs1);
            $sql="UPDATE `phieu_nhap_hang` SET `MaNV`='$r1[0]',`MaNSX`='$mansx',`NgayNhap`='$ngay' 
            WHERE `MaPNH`='$id'";                    
            $p->ExcuteQuery($sql);
            echo 1;
        }
        if ($kieu=="xoapnh"){
            $mapnh=$_POST['mapnh'];            
            $sql2="UPDATE `phieu_nhap_hang` SET TinhTrang=0 WHERE MaPNH='$mapnh'";
            $p->ExcuteQuery($sql2);            
            echo 1;            
        }  
        if ($kieu=="timkiempnh"){
            $kieutk=$_POST['kieutk'];
            if ($kieutk==0)   
                $s="";
            if ($kieutk==1)   
                $s="<div class='row timkiemtheomanvpnh'>
                        <div class='col-md-2 col-sm-2 div1'>Mã nhân viên:</div>
                        <div class='col-md-4 col-sm-4'>
                            <input class='form-control' type='text' id='manvpnhtimkiem' placeholder='Nhập mã nhân viên cần tìm'  />
                        </div>
                    </div>";
            if ($kieutk==2){                
                $s="<div class='row timkiemtheonsxpnh'>
                        <div class='col-md-2 col-sm-2 div1'>Nhà sản xuất:</div>
                        <div class='col-md-4 col-sm-4'>
                            <select class='form-select' id='nsxpnhtimkiem'>
                                <option value='0' selected>Chọn nhà sản xuất cần tìm</option>";
                $sql="SELECT * FROM nha_san_xuat WHERE TinhTrang!=0";
                $p=new CheckConnection();
                $rs=$p->ExcuteQuery($sql);
                while($r=mysqli_fetch_array($rs)){
                    $s=$s."<option value='$r[0]'>$r[1]</option>";
                }
                $s=$s."     </select>
                        </div>
                    </div>";
            }
            if ($kieutk==3)   
                $s="<div class='row timkiemtheothoigianpnh'>
                        <div class='col-md-3 col-sm-3 div1'>Thời gian nhập hàng:</div>
                        <div class='col-md-3 col-sm-3'>
                            <input class='form-control' type='date' id='tungaypnhtimkiem' />
                        </div>
                        <div class='col-md-1 col-sm-2 div1'>-</div>
                        <div class='col-md-3 col-sm-3'>
                            <input class='form-control' type='date' id='denngaypnhtimkiem' />
                        </div>
                    </div>";
            echo $s;
        } 
        if ($kieu=='themctpnh'){
            $mapnh=$_POST['mapnh'];
            $masp=$_POST['masp'];
            $mansx=$_POST['mansx'];
            $slsp=$_POST['slsp'];
            $dgsp=$_POST['dgsp'];
            $ktrama="SELECT * FROM san_pham WHERE MaNhomSP='$masp' AND MaNSX='$mansx'";
            $kt=$p->ExcuteQuery($ktrama);
            if (mysqli_num_rows($kt)>0){
                $ktratontai="SELECT * FROM chi_tiet_phieu_nhap WHERE MaPNH='$mapnh' AND MaNhomSP='$masp'";
                $kt1=$p->ExcuteQuery($ktratontai);
                if (mysqli_num_rows($kt1)>0){
                    $r1=mysqli_fetch_row($kt1);
                    $slmoi=$slsp+$r1[2];
                    $giagoc=$dgsp;
                    $thanhtien=$slmoi*$giagoc;
                    $sql="UPDATE `chi_tiet_phieu_nhap` SET `SoLuong`='$slmoi',`GiaGoc`='$giagoc',
                    `ThanhTien`='$thanhtien' WHERE `MaPNH`='$mapnh' AND `MaNhomSP`='$masp'";
                    $p->ExcuteQuery($sql);
                    $sp=mysqli_fetch_row($kt);
                    $slspmoi=$slsp+$sp[6];
                    $ln="SELECT * FROM loi_nhuan WHERE MaNhomSP='$masp'";
                    $rs2=$p->ExcuteQuery($ln);
                    $r2=mysqli_fetch_row($rs2);
                    $giaban=$giagoc+(($giagoc*$r2[2])/100);
                    $capnhatsp="UPDATE `san_pham` SET `SoLuong`='$slspmoi',`GiaBan`='$giaban',`GiaGoc`='$giagoc' 
                    WHERE `MaNhomSP`='$masp'";
                    $p->ExcuteQuery($capnhatsp);    
                    $ctpnh="SELECT * FROM chi_tiet_phieu_nhap WHERE MaPNH='$mapnh'";
                    $rs3=$p->ExcuteQuery($ctpnh);
                    $tongtien=0;
                    while($r3=mysqli_fetch_array($rs3)){
                        $tongtien+=$r3[4];
                    }                
                    $capnhatpnh="UPDATE `phieu_nhap_hang` SET `TongTien`='$tongtien' WHERE `MaPNH`='$mapnh'";
                    $p->ExcuteQuery($capnhatpnh);

                    $sql="SELECT * FROM chi_tiet_sp WHERE MaNhomSP='$masp'";
                    $rs=$p->ExcuteQuery($sql);
                    if (mysqli_num_rows($rs)>0){
                        $stt=0;
                        while($r=mysqli_fetch_array($rs)){
                            $stt=$r[3];
                        }
                        for ($i=1;$i<=$slsp;$i++){
                            $ma=$masp.$sp[2].($stt+1);
                            $sql="INSERT INTO `chi_tiet_sp`(`MaSP`, `MaNhomSP`, `TinhTrang`, `Stt`) 
                            VALUES ('$ma','$masp',1,$stt+1)";
                            $p->ExcuteQuery($sql);
                            $stt++;
                        }
                    }
                    else{
                        $stt=0;
                        for ($i=1;$i<=$slsp;$i++){
                            $ma=$masp.$sp[2].($stt+1);
                            $sql="INSERT INTO `chi_tiet_sp`(`MaSP`, `MaNhomSP`, `TinhTrang`, `Stt`) 
                            VALUES ('$ma','$masp',1,$stt+1)";
                            $p->ExcuteQuery($sql);
                            $stt++;
                        }
                    }
                    echo 1;
                }
                else{
                    $giagoc=$dgsp;
                    $thanhtien=$slsp*$giagoc;
                    $sql="INSERT INTO `chi_tiet_phieu_nhap`(`MaPNH`, `MaNhomSP`, `SoLuong`, `GiaGoc`, `ThanhTien`) 
                    VALUES ('$mapnh','$masp','$slsp','$giagoc','$thanhtien')";
                    $p->ExcuteQuery($sql);
                    $sp=mysqli_fetch_row($kt);
                    $slspmoi=$slsp+$sp[6];
                    $ln="SELECT * FROM loi_nhuan WHERE MaNhomSP='$masp'";
                    $rs2=$p->ExcuteQuery($ln);
                    $r2=mysqli_fetch_row($rs2);
                    $giaban=$giagoc+(($giagoc*$r2[2])/100);
                    $capnhatsp="UPDATE `san_pham` SET `SoLuong`='$slspmoi',`GiaBan`='$giaban',`GiaGoc`='$giagoc' 
                    WHERE `MaNhomSP`='$masp'";
                    $p->ExcuteQuery($capnhatsp);    
                    $ctpnh="SELECT * FROM chi_tiet_phieu_nhap WHERE MaPNH='$mapnh'";
                    $rs3=$p->ExcuteQuery($ctpnh);
                    $tongtien=0;
                    while($r3=mysqli_fetch_array($rs3)){
                        $tongtien+=$r3[4];
                    }                
                    $capnhatpnh="UPDATE `phieu_nhap_hang` SET `TongTien`='$tongtien' WHERE `MaPNH`='$mapnh'";
                    $p->ExcuteQuery($capnhatpnh);

                    $sql="SELECT * FROM chi_tiet_sp WHERE MaNhomSP='$masp'";
                    $rs=$p->ExcuteQuery($sql);
                    if (mysqli_num_rows($rs)>0){
                        $stt=0;
                        while($r=mysqli_fetch_array($rs)){
                            $stt=$r[3];
                        }
                        for ($i=1;$i<=$slsp;$i++){
                            $ma=$masp.$sp[2].($stt+1);
                            $sql="INSERT INTO `chi_tiet_sp`(`MaSP`, `MaNhomSP`, `TinhTrang`, `Stt`) 
                            VALUES ('$ma','$masp',1,$stt+1)";
                            $p->ExcuteQuery($sql);
                            $stt++;
                        }
                    }
                    else{
                        $stt=0;
                        for ($i=1;$i<=$slsp;$i++){
                            $ma=$masp.$sp[2].($stt+1);
                            $sql="INSERT INTO `chi_tiet_sp`(`MaSP`, `MaNhomSP`, `TinhTrang`, `Stt`) 
                            VALUES ('$ma','$masp',1,$stt+1)";
                            $p->ExcuteQuery($sql);
                            $stt++;
                        }
                    }
                    echo 1;
                }
                
            }
            else{
                echo 0;
            }
        }
        if ($kieu=='xoactpnh'){
            $mapnh=$_POST['mapnh'];
            $masp=$_POST['masp'];
            $slsp=$_POST['slsp'];
            $ktrama="SELECT * FROM san_pham WHERE MaNhomSP='$masp'";
            $kt=$p->ExcuteQuery($ktrama);
            if (mysqli_num_rows($kt)>0){  
                $xoactpnh="DELETE FROM `chi_tiet_phieu_nhap` WHERE MaPNH='$mapnh' AND MaNhomSP='$masp'";
                $p->ExcuteQuery($xoactpnh);
                $r1=mysqli_fetch_row($kt);
                $slspmoi=$r1[6]-$slsp;      
                $capnhatsp="UPDATE `san_pham` SET `SoLuong`='$slspmoi' WHERE `MaNhomSP`='$masp'";
                $p->ExcuteQuery($capnhatsp);    
                $ctpnh="SELECT * FROM chi_tiet_phieu_nhap WHERE MaPNH='$mapnh'";
                $rs3=$p->ExcuteQuery($ctpnh);
                $tongtien=0;
                while($r3=mysqli_fetch_array($rs3)){
                    $tongtien+=$r3[4];
                }                
                $capnhatpnh="UPDATE `phieu_nhap_hang` SET `TongTien`='$tongtien' WHERE `MaPNH`='$mapnh'";
                $p->ExcuteQuery($capnhatpnh);                
                echo 1;
            }
            else{
                echo 0;
            }
        }
    }
?>