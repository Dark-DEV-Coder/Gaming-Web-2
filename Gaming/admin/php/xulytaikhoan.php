<?php
    require_once("./KetnoiCSDL.php");
    $p=new CheckConnection();
    if (isset($_POST['kieu'])){
        $kieu=$_POST['kieu'];
        if ($kieu=="themtk"){
            $maq=$_POST['qtk'];
            $tentk=$_POST['tentk'];
            $s="khachsan4D";
            $pass=password_hash($s,PASSWORD_DEFAULT);
            $ktratentk="SELECT * FROM tai_khoan WHERE Username='$tentk'";
            $kt=$p->ExcuteQuery($ktratentk);
            if (mysqli_num_rows($kt)>0)
                echo 0;
            else{
                $demsl="SELECT * from tai_khoan";
                $dem=$p->ExcuteQuery($demsl);
                $matk='TK'.mysqli_num_rows($dem);
                $sql="INSERT INTO `tai_khoan`(`MaTK`, `MaQuyen`, `Username`, `Password`, `TinhTrang`) 
                VALUES ('$matk','$maq','$tentk','$pass',1)";
                $p->ExcuteQuery($sql);                
                echo 1;
            }

        }
        if ($kieu=="suatk"){
            $id=$_POST['id'];
            $maq=$_POST['qtk'];
            $tentk=$_POST['tentk'];
            $pass=$_POST['pass'];
            $tentkcu=$_POST['tentkcu'];
            if ($tentk!=$tentkcu){
                $ktratentk="SELECT * FROM tai_khoan WHERE Username='$tentk'";
                $kt=$p->ExcuteQuery($ktratentk);
                if (mysqli_num_rows($kt)>0)
                    echo 0;
                else{
                    $sql2="UPDATE `tai_khoan` SET `MaQuyen`='$maq',`Username`='$tentk',
                    `Password`='$pass',`TinhTrang`=1 WHERE `MaTK`='$id'";
                    $p->ExcuteQuery($sql2);
                    echo 1;   
                } 
            }
            else{
                $sql2="UPDATE `tai_khoan` SET `MaQuyen`='$maq',`Username`='$tentk',
                `Password`='$pass',`TinhTrang`=1 WHERE `MaTK`='$id'";
                $p->ExcuteQuery($sql2);
                echo 1;   
            }         
        }
        if ($kieu=="khoiphucmk"){
            $s="khachsan4D";
            $pass=password_hash($s,PASSWORD_DEFAULT);
            $s1="<input class='form-control' type='text' id='suamktaikhoan' readonly value='$pass' />";
            echo $s1; 
        }
        if ($kieu=="xoatk"){
            $matk=$_POST['matk'];            
            $sql2="UPDATE `tai_khoan` SET TinhTrang=0 WHERE MaTK='$matk'";
            $p->ExcuteQuery($sql2);            
            echo 1;            
        }  
        if ($kieu=="timkiemtk"){
            $kieutk=$_POST['kieutk'];
            if ($kieutk==0)   
                $s="";
            if ($kieutk==1)   
                $s="<div class='row timkiemtheotentk'>
                        <div class='col-md-2 col-sm-2 div1'>Tên tài khoản:</div>
                        <div class='col-md-4 col-sm-4'>
                            <input class='form-control' type='text' id='tentktimkiem' placeholder='Nhập tên tài khoản cần tìm'  />
                        </div>
                    </div>";
            if ($kieutk==2){                
                $s="<div class='row timkiemtheoquyentk'>
                        <div class='col-md-2 col-sm-2 div1'>Quyền tài khoản:</div>
                        <div class='col-md-4 col-sm-4'>
                            <select class='form-select' id='quyentktktimkiem'>
                                <option value='0' selected>Chọn quyền tài khoản cần tìm</option>";
                $sql="SELECT * FROM quyen_tk WHERE TinhTrang!=0";
                $p=new CheckConnection();
                $rs=$p->ExcuteQuery($sql);
                while($r=mysqli_fetch_array($rs)){
                    $s=$s."<option value='$r[0]'>$r[1]</option>";
                }
                $s=$s."     </select>
                        </div>
                    </div>";
            }
            echo $s;
        }       
    }
?>