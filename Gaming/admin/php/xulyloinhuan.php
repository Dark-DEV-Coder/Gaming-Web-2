<?php
    require_once("./KetnoiCSDL.php");
    $p=new CheckConnection();
    if (isset($_POST['kieu'])){
        $kieu=$_POST['kieu'];        
        if ($kieu=="sualn"){
            $id=$_POST['id'];
            $ptln=$_POST['ptln'];  
            $maspln=$_POST['maspln'];             
            $sql2="UPDATE `loi_nhuan` SET `%LN`='$ptln' WHERE `MaLN`='$id'";
            $p->ExcuteQuery($sql2);
            $sql="SELECT * FROM san_pham WHERE MaNhomSP='$maspln'";
            $rs=$p->ExcuteQuery($sql);
            $r=mysqli_fetch_row($rs);
            $giaban=$r[9]+(($r[9]*$ptln)/100);
            $sql1="UPDATE `san_pham` SET `GiaBan`='$giaban' WHERE `MaNhomSP`='$maspln'";
            $p->ExcuteQuery($sql1);
            echo 1;                       
        }      
    }
?>