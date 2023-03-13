<?php
    require_once("./KetnoiCSDL.php");
    $p=new CheckConnection();
    if (isset($_POST['kieu'])){
        $kieu=$_POST['kieu'];
        if ($kieu=="themnsx"){
            $tennsx=$_POST['tennsx'];
            $sdtnsx=$_POST['sdtnsx'];
            $dcnsx=$_POST['dcnsx'];
            $demsl="SELECT * from nha_san_xuat";
            $dem=$p->ExcuteQuery($demsl);
            $mansx='NSX'.(mysqli_num_rows($dem)+1);
            $sql="INSERT INTO `nha_san_xuat` (`MaNSX`, `TenNSX`, `Sdt`, `DiaChi`, `TinhTrang`) 
            VALUES ('$mansx','$tennsx','$sdtnsx','$dcnsx',1)";
            $p->ExcuteQuery($sql);                
            echo 1;            
        }
        if ($kieu=="suansx"){
            $id=$_POST['id'];
            $tennsx=$_POST['tennsx'];
            $sdtnsx=$_POST['sdtnsx'];
            $dcnsx=$_POST['dcnsx'];            
            $sql2="UPDATE `nha_san_xuat` SET `TenNSX`='$tennsx',`Sdt`='$sdtnsx',
            `DiaChi`='$dcnsx' WHERE `MaNSX`='$id'";
            $p->ExcuteQuery($sql2);
            echo 1;                       
        }
        if ($kieu=="xoansx"){
            $mansx=$_POST['mansx'];            
            $sql2="UPDATE `nha_san_xuat` SET TinhTrang=0 WHERE MaNSX='$mansx'";
            $p->ExcuteQuery($sql2);            
            echo 1;            
        }  
        if ($kieu=="timkiemnsx"){
            $kieutk=$_POST['kieunsx'];
            if ($kieutk==0)   
                $s="";
            if ($kieutk==1)   
                $s="<div class='row timkiemtheotennsx'>
                        <div class='col-md-2 col-sm-2 div1'>Tên:</div>
                        <div class='col-md-4 col-sm-4'>
                            <input class='form-control' type='text' id='tennsxtimkiem' placeholder='Nhập tên nhà sản xuất cần tìm'  />
                        </div>
                    </div>";
            if ($kieutk==2){                
                $s="<div class='row timkiemtheosdt'>
                        <div class='col-md-2 col-sm-2 div1'>Số điện thoại:</div>
                        <div class='col-md-4 col-sm-4'>
                            <input class='form-control' type='text' id='sdtnsxtimkiem' placeholder='Nhập số điện thoại cần tìm'  />
                        </div>
                    </div> ";                
            }
            echo $s;
        }       
    }
?>