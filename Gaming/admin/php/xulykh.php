<?php
    require_once("./KetnoiCSDL.php");
    $p=new CheckConnection();
    if (isset($_POST['kieu'])){
        $kieu=$_POST['kieu'];
        if ($kieu=="themkh"){
            $ho = $_POST['hokh'];
            $ten = $_POST['tenkh'];
            $email = $_POST['emailkh'];
            $sodienthoai = $_POST['sdtkh'];
            $ngaysinh = $_POST['nskh'];
            $diachi = $_POST['dckh'];
            $gt = $_POST['gtkh'];
            $sqlkh = "SELECT * FROM khach_hang";
            $reskh = $p->ExcuteQuery($sqlkh);
            $countkh = mysqli_num_rows($reskh);
            $idkh = "KH".$countkh;
            $qrkh = "INSERT INTO khach_hang VALUES('$idkh', 'null', '$ho','$ten', '$ngaysinh', '$gt', '$diachi', '$sodienthoai', '$email', '1')";
            $p->ExcuteQuery($qrkh);
            echo 1;    
        }
        if ($kieu=="suakh"){
            $kieu=$_POST['kieu'];
            if ($kieu=="suakh"){
                $makh=$_POST['makh'];
                $ho = $_POST['hokh'];
                $ten = $_POST['tenkh'];
                $tk=$_POST['tkkh'];
                $email = $_POST['emailkh'];
                $sodienthoai = $_POST['sdtkh'];
                $ngaysinh = $_POST['nskh'];
                $diachi = $_POST['dckh'];
                $gt = $_POST['gtkh'];
                $sql = "SELECT MaTK from `tai_khoan` where MaTK='$tk' and MaQuyen='KH'";
                $res = $p->ExcuteQuery($sql);
                $count = mysqli_num_rows($res);
                if($count>0){
                    $sql = "SELECT kh.MaKH from tai_khoan tk,khach_hang kh where tk.MaTK='$tk' and tk.MaTK=kh.MaTK";
                    $res = $p->ExcuteQuery($sql);
                    $count = mysqli_num_rows($res);
                    //echo $sql;
                    $obj = $res->fetch_Object();
                    if(($count>0 && $obj->MaKH==$makh) || $count<=0){
                        $sql2="UPDATE `khach_hang` SET `MaTK`='$tk',`Ho`='$ho',`Ten`='$ten',`NgaySinh`='$ngaysinh',`GioiTinh`='$gt',`DiaChi`='$diachi',`Sdt`='$sodienthoai',`Email`='$email' WHERE MaKH='$makh'";
                        $p->ExcuteQuery($sql2);
                        echo 1;
                    }else{
                        echo 3;
                    }
                }else{
                    echo 2;
                }       
            }
        }
        if ($kieu=="xoakh"){
            $makh=$_POST['makh'];            
            $sql2="UPDATE `khach_hang` SET TinhTrang=0 WHERE MaKH='$makh'";
            $p->ExcuteQuery($sql2);
            echo 1;            
        }  
        if ($kieu=="timkiemkh"){
            $kieutk=$_POST['kieutk'];
            if ($kieutk==0)   
                $s="";
            if ($kieutk==1)   
                $s="<div class='row timkiemtheohoten'>
                    <div class='col-md-2 col-sm-2 div1'>Họ tên:</div>
                    <div class='col-md-4 col-sm-4'>
                        <input class='form-control' type='text' id='hotenkhtimkiem' placeholder='Nhập họ tên khách hàng cần tìm'  />
                    </div>
                </div> ";
            if ($kieutk==2){                
                $s="<div class='row timkiemtheogioitinh'>
                        <div class='col-md-2 col-sm-2 div1'>Giới tính:</div>
                        <div class='col-md-4 col-sm-4'>
                            <select class='form-select' id='gioitinhkhtimkiem'>
                                <option value='-1' selected>Chọn giới tính cần tìm</option>
                                <option value='0' selected>Nam</option>
                                <option value='1' selected>Nữ</option>
                            </select>
                        </div>
                    </div> ";                
            }
            if ($kieutk==3){                
                $s="<div class='row timkiemtheosdt'>
                        <div class='col-md-2 col-sm-2 div1'>Số điện thoại:</div>
                        <div class='col-md-4 col-sm-4'>
                            <input class='form-control' type='text' id='sdtkhtimkiem' placeholder='Nhập số điện thoại cần tìm'  />
                        </div>
                    </div>";                
            }
            if ($kieutk==4){                
                $s="<div class='row timkiemtheongaysinh'>
                        <div class='col-md-2 col-sm-2 div1'>Ngày sinh:</div>
                        <div class='col-md-4 col-sm-4'>
                            <input class='form-control' type='date' id='tungaysinhkhtimkiem' />
                        </div>
                        <div class='col-md-1 col-sm-2 div1'>-</div>
                        <div class='col-md-4 col-sm-4'>
                            <input class='form-control' type='date' id='denngaysinhkhtimkiem' />
                        </div>
                    </div>";                
            }
            echo $s;
        }       
    }
?>