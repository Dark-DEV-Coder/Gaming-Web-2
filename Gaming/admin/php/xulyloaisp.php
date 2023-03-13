<?php
    require_once("./KetnoiCSDL.php");
    $p=new CheckConnection();
    if (isset($_POST['kieu'])){
        $kieu=$_POST['kieu'];
        if ($kieu=="themlsp"){
            $tenlsp=$_POST['tenlsp'];
            $demsl="SELECT * from loai_sp";
            $dem=$p->ExcuteQuery($demsl);
            $malsp='L'.(mysqli_num_rows($dem)+1);
            $sql="INSERT INTO `loai_sp`(`MaLoai`, `TenLoai`, `TinhTrang`) 
            VALUES ('$malsp','$tenlsp',1)";
            $p->ExcuteQuery($sql);                
            echo 1;            
        }
        if ($kieu=="sualsp"){
            $id=$_POST['id'];
            $tenlsp=$_POST['tenlsp'];            
            $sql2="UPDATE `loai_sp` SET `TenLoai`='$tenlsp' WHERE `MaLoai`='$id'";
            $p->ExcuteQuery($sql2);
            echo 1;                       
        }
        if ($kieu=="xoalsp"){
            $malsp=$_POST['malsp'];            
            $sql2="UPDATE `loai_sp` SET TinhTrang=0 WHERE MaLoai='$malsp'";
            $p->ExcuteQuery($sql2);            
            echo 1;            
        }               
    }
?>