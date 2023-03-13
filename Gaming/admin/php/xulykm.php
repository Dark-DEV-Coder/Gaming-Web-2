<?php
    require_once("./KetnoiCSDL.php");
    $p=new CheckConnection();
    if (isset($_POST['kieu'])){
        $kieu=$_POST['kieu'];
        if ($kieu=="themkm"){
            $tenkm=$_POST['tenkm'];
            $ngaybd=$_POST['nbd'];
            $ngaykt=$_POST['nkt'];
            $day=date('Y-m-d');
            $tt=1;
            if($day>=$ngaybd && $day>=$ngaykt){
                $tt=1;
            }else{
                $tt=3;
            }
            if($ngaybd>=$day){
                $sql1="SELECT * FROM khuyen_mai";
                $rs1=$p->ExcuteQuery($sql1);
                $count=mysqli_num_rows($rs1);
                $makm='KM'.$count;
                $sql="INSERT INTO `khuyen_mai`(`MaKM`,`TenKM`, `NgayBD`,`NgayKT`,`TinhTrang`) 
                VALUES ('$makm','$tenkm','$ngaybd','$ngaykt',$tt)";
                $p->ExcuteQuery($sql);                
                echo 1; 
            }else{
                echo 2;
            } 
        }
        if ($kieu=="suakm"){
            $kieu=$_POST['kieu'];
            $makm=$_POST['makm'];
            $tenkm=$_POST['tenkm'];
            $ngaybd=$_POST['nbd'];
            $ngaykt=$_POST['nkt'];
            $day=date('Y-m-d');
            $tt=1;
            if($day>=$ngaybd && $day<=$ngaykt){
                $tt=1;
            }else{
                $tt=3;
            }
            if($ngaybd>=$day){
                $sql="UPDATE `khuyen_mai` SET TinhTrang=$tt,TenKM='$tenkm',NgayBD='$ngaybd',NgayKT='$ngaykt' WHERE MaKM='$makm'";
                $p->ExcuteQuery($sql);                
                echo 1;
            }else{
                echo 2;
            }
        }
        if ($kieu=="xoakm"){
            $makm=$_POST['makm'];            
            $sql2="UPDATE `khuyen_mai` SET TinhTrang=0 WHERE MaKM='$makm'";
            $p->ExcuteQuery($sql2);            
            echo 1;            
        }  
        if ($kieu=="timkiemkm"){
            $kieutk=$_POST['kieutk'];
            if ($kieutk==0)   
                $s="";
            if ($kieutk==1)
                $s="<div class='row timkiemtheotenkm'>
                        <div class='col-md-2 col-sm-2 div1'>Tên khuyến mãi:</div>
                        <div class='col-md-4 col-sm-4'>
                            <input class='form-control' type='text' id='tenkmtimkiem' placeholder='Nhập tên chương trình khuyến mãi cần tìm'  />
                        </div>
                    </div>";
            if ($kieutk==3)              
                $s="<div class='row timkiemtheotinhtrang'>
                        <div class='col-md-2 col-sm-2 div1'>Tình trạng:</div>
                        <div class='col-md-4 col-sm-4'>
                            <select class='form-select' id='tinhtrangkmtimkiem'>
                                <option value='0' selected>Chọn tình trạng cần tìm</option>
                                <option value='1' selected>Đang thực hiện</option>
                                <option value='2' selected>Hết hạn</option>
                                <option value='3' selected>Chưa đến hạn</option>
                            </select>
                        </div>
                    </div>";
            if ($kieutk==2)   
                $s="<div class='row timkiemtheothoigiankm'>
                        <div class='col-md-3 col-sm-3 div1'>Thời gian khuyến mãi:</div>
                        <div class='col-md-4 col-sm-4'>
                            <input class='form-control' type='date' id='tungaykmtimkiem' />
                        </div>
                        <div class='col-md-1 col-sm-2 div1'>-</div>
                        <div class='col-md-4 col-sm-4'>
                            <input class='form-control' type='date' id='denngaykmtimkiem' />
                        </div>
                    </div>";
            echo $s;
        } 
        if ($kieu=='themctkm'){
            $makm=$_POST['makm'];
            $masp=$_POST['masp'];
            $ptkm=$_POST['ptkm'];
            $sql="SELECT * FROM chi_tiet_km WHERE MaKM='$makm' and MaNhomSP='$masp'";
            $rs=$p->ExcuteQuery($sql);
            $count=mysqli_num_rows($rs);
            if($count>0){
                echo 2;
            }else{
                $sql="SELECT * FROM san_pham WHERE MaNhomSP='$masp'";
                $rs=$p->ExcuteQuery($sql);
                $count1=mysqli_num_rows($rs);
                if($count1>0){
                    $sql="INSERT INTO `chi_tiet_km`(`MaKM`, `MaNhomSP`, `%KM`) VALUES ('$makm','$masp','$ptkm')";
                    $p->ExcuteQuery($sql);
                    echo 1;
                }else{
                    echo 3;
                }
            }
        }
        if ($kieu=='xoactkm'){
            $makm=$_POST['makm'];
            $masp=$_POST['masp'];
            $ptkm=$_POST['ptkm'];
            $sql="DELETE FROM `chi_tiet_km` WHERE MaKM='$makm' and MaNhomSP='$masp'";
            $p->ExcuteQuery($sql);
            echo 1;
        }
    }
?>