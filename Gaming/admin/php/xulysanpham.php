<?php
    require_once("./KetnoiCSDL.php");
    $p=new CheckConnection();
    if (isset($_POST['kieu'])){
        $kieu=$_POST['kieu'];
        if ($kieu=="themsp"){
            $masp=$_POST['masp'];
            $lsp=$_POST['lsp'];
            $nsx=$_POST['nsx'];
            $tensp=$_POST['tensp'];
            $hinhanh=$_POST['themhinh'];
            $mota=$_POST['mota'];     
            if ($hinhanh=="")
                $hinhanh="logo.png";     
            $sql="SELECT * FROM san_pham WHERE MaNhomSP='$masp'";
            $rs=$p->ExcuteQuery($sql);
            if (mysqli_num_rows($rs)>0)
                echo 0;
            else{
                $sql="INSERT INTO `san_pham`(`MaNhomSP`, `MaLoai`, `MaNSX`, `Ten`, 
                `HinhAnh`, `MoTa`, `SoLuong`, `GiaBan`, `GiaKM`, `GiaGoc`, `TinhTrang`, `DoUuTien`) 
                VALUES ('$masp','$lsp','$nsx','$tensp','$hinhanh','$mota',
                0,0,0,0,1,1)";
                $p->ExcuteQuery($sql);
                $demsl="SELECT * from loi_nhuan";
                $dem=$p->ExcuteQuery($demsl);
                $maln='LN'.(mysqli_num_rows($dem)+1);
                $sql="INSERT INTO `loi_nhuan`(`MaLN`, `MaNhomSP`, `%LN`, `TinhTrang`) 
                VALUES ('$maln','$masp',30,1)";
                $p->ExcuteQuery($sql);
                echo 1;
            }
                       
        }
        if ($kieu=="suasp"){
            $masp=$_POST['masp'];
            $lsp=$_POST['lsp'];
            $nsx=$_POST['nsx'];
            $tensp=$_POST['tensp'];
            $hinhanh=$_POST['suahinh'];
            $mota=$_POST['mota']; 
            $dut=$_POST['douutien'];    
            if ($hinhanh==""){
                $sql="UPDATE `san_pham` SET `MaLoai`='$lsp',`MaNSX`='$nsx',
                `Ten`='$tensp',`MoTa`='$mota',`DoUuTien`='$dut' WHERE `MaNhomSP`='$masp'";
                $p->ExcuteQuery($sql);
            }
            else{ 
                $sql="UPDATE `san_pham` SET `MaLoai`='$lsp',`MaNSX`='$nsx',
                `Ten`='$tensp',`HinhAnh`='$hinhanh',
                `MoTa`='$mota',`DoUuTien`='$dut' WHERE `MaNhomSP`='$masp'";
                $p->ExcuteQuery($sql);
            }
            echo 1;
        }
        if ($kieu=="xoasp"){
            $masp=$_POST['masp'];            
            $sql2="UPDATE `san_pham` SET TinhTrang=0 WHERE MaNhomSP='$masp'";
            $p->ExcuteQuery($sql2);  
            $sql2="UPDATE `loi_nhuan` SET TinhTrang=0 WHERE MaNhomSP='$masp'";
            $p->ExcuteQuery($sql2);           
            echo 1;            
        }  
        if ($kieu=="timkiemsp"){
            $kieutk=$_POST['kieutk'];
            if ($kieutk==0)   
                $s="";
            if ($kieutk==1)   
                $s="<div class='row timkiemtheoma'>
                        <div class='col-md-2 col-sm-2 div1'>Mã sản phẩm:</div>
                        <div class='col-md-4 col-sm-4'>
                            <input class='form-control' type='text' id='masptimkiem' placeholder='Nhập mã sản phẩm cần tìm'  />
                        </div>
                    </div>";
            if ($kieutk==2)   
                $s="<div class='row timkiemtheoten'>
                        <div class='col-md-2 col-sm-2 div1'>Tên sản phẩm:</div>
                        <div class='col-md-4 col-sm-4'>
                            <input class='form-control' type='text' id='tensptimkiem' placeholder='Nhập tên sản phẩm cần tìm'  />
                        </div>
                    </div>";
            if ($kieutk==3){                
                $s="<div class='row timkiemtheoloai'>
                        <div class='col-md-2 col-sm-2 div1'>Loại sản phẩm:</div>
                        <div class='col-md-4 col-sm-4'>
                            <select class='form-select' id='loaisptimkiem'>
                                <option value='0' selected>Chọn loại sản phầm cần tìm</option>";
                $sql="SELECT * FROM loai_sp WHERE TinhTrang!=0";
                $p=new CheckConnection();
                $rs=$p->ExcuteQuery($sql);
                while($r=mysqli_fetch_array($rs)){
                    $s=$s."<option value='$r[0]'>$r[1]</option>";
                }
                $s=$s."     </select>
                        </div>
                    </div>";
            }
            if ($kieutk==4){                
                $s="<div class='row timkiemtheonsx'>
                        <div class='col-md-2 col-sm-2 div1'>Nhà sản xuất:</div>
                        <div class='col-md-4 col-sm-4'>
                            <select class='form-select' id='nsxsptimkiem'>
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
            if ($kieutk==5){
                $s="<div class='row timkiemtheoloainsx'>
                        <div class='col-md-2 col-sm-2 div1'>Loại sản phẩm:</div>
                        <div class='col-md-4 col-sm-4'>
                            <select class='form-select' id='loainsxsptimkiem1'>
                                <option value='0' selected>Chọn loại sản phầm cần tìm</option>";
                $sql="SELECT * FROM loai_sp WHERE TinhTrang!=0";
                $p=new CheckConnection();
                $rs=$p->ExcuteQuery($sql);
                while($r=mysqli_fetch_array($rs)){
                    $s=$s."<option value='$r[0]'>$r[1]</option>";
                }
                $s=$s."    </select>
                </div>
                <div class='col-md-2 col-sm-2 div1'>Nhà sản xuất:</div>
                    <div class='col-md-4 col-sm-4'>
                        <select class='form-select' id='loainsxsptimkiem2'>
                            <option value='0' selected>Chọn nhà sản xuất cần tìm</option>";
                $sql="SELECT * FROM nha_san_xuat WHERE TinhTrang!=0";
                $p=new CheckConnection();
                $rs=$p->ExcuteQuery($sql);
                while($r=mysqli_fetch_array($rs)){
                    $s=$s."<option value='$r[0]'>$r[1]</option>";
                }
                $s=$s."</select>
                </div>
            </div>";
            }
            echo $s;
        } 

    }
?>