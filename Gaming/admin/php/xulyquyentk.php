<?php
    require_once("./KetnoiCSDL.php");
    $p=new CheckConnection();
    if (isset($_POST['kieu'])){
        $kieu=$_POST['kieu'];
        if ($kieu=="themqtk"){
            $maq=$_POST['maq'];
            $tenq=$_POST['tenq'];
            $arr=$_POST['arr'];
            $sl=$_POST['sl'];
            $ktrama="SELECT * FROM quyen_tk WHERE MaQuyen='$maq'";
            $kt=$p->ExcuteQuery($ktrama);
            if (mysqli_num_rows($kt)>0)
                echo 0;
            else{
                $sql="INSERT INTO `quyen_tk`(`MaQuyen`, `TenQuyen`, `TinhTrang`) 
                VALUES ('$maq','$tenq',1)";
                $p->ExcuteQuery($sql);
                for ($i=0;$i<$sl;$i++){
                    $sql1="INSERT INTO `chi_tiet_quyen`(`MaQuyen`, `MaChucNang`) VALUES ('$maq','$arr[$i]')";
                    $p->ExcuteQuery($sql1);
                }
                echo 1;
            }

        }
        if ($kieu=="suaqtk"){
            $maq=$_POST['maq'];
            $tenq=$_POST['tenq'];
            $arr=$_POST['arr'];
            $sl=$_POST['sl'];
            $sql="DELETE FROM `chi_tiet_quyen` WHERE MaQuyen='$maq'";
            $p->ExcuteQuery($sql);
            $sql2="UPDATE `quyen_tk` SET `TenQuyen`='$tenq' WHERE MaQuyen='$maq'";
            $p->ExcuteQuery($sql2);
            for ($i=0;$i<$sl;$i++){
                $sql1="INSERT INTO `chi_tiet_quyen`(`MaQuyen`, `MaChucNang`) VALUES ('$maq','$arr[$i]')";
                $p->ExcuteQuery($sql1);
            }
            echo 1;            
        }
        if ($kieu=="xoaqtk"){
            $maq=$_POST['maq'];            
            $sql2="UPDATE `quyen_tk` SET TinhTrang=0 WHERE MaQuyen='$maq'";
            $p->ExcuteQuery($sql2);            
            echo 1;            
        }        
    }
?>