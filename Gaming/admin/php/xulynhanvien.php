<?php
    require_once("./KetnoiCSDL.php");
    $p=new CheckConnection();
    if (isset($_POST['kieu'])){
        $kieu=$_POST['kieu'];
        if ($kieu=="themnv"){
            $ho = $_POST['honv'];
            $ten = $_POST['tennv'];
            $tlnv = $_POST['tlnv'];
            $sodienthoai = $_POST['sdtnv'];
            $ngaysinh = $_POST['nsnv'];
            $diachi = $_POST['dcnv'];
            $gt = $_POST['gtnv'];
            $sqlnv = "SELECT * FROM nhan_vien";
            $resnv = $p->ExcuteQuery($sqlnv);
            $countnv = mysqli_num_rows($resnv);
            $idnv = "NV".$countnv;
            $qrnv = "INSERT INTO nhan_vien VALUES('$idnv', 'null', '$ho','$ten', '$ngaysinh', '$gt', '$diachi', '$sodienthoai', '$tlnv', '1')";
            $p->ExcuteQuery($qrnv);
            echo 1;    
        }
        if ($kieu=="suanv"){
            $manv=$_POST['manv'];
            $ho = $_POST['honv'];
            $ten = $_POST['tennv'];
            $tk=$_POST['tknv'];
            $tlnv = $_POST['tlnv'];
            $sodienthoai = $_POST['sdtnv'];
            $ngaysinh = $_POST['nsnv'];
            $diachi = $_POST['dcnv'];
            $gt = $_POST['gtnv'];
            $sql = "SELECT MaTK from `tai_khoan` where MaTK='$tk' and MaQuyen!='KH'";
            $res = $p->ExcuteQuery($sql);
            $count = mysqli_num_rows($res);
            if($count>0){
                $sql = "SELECT nv.MaNV from tai_khoan tk,nhan_vien nv where tk.MaTK='$tk' and tk.MaTK=nv.MaTK";
                $res = $p->ExcuteQuery($sql);
                $count = mysqli_num_rows($res);
                //echo $sql;
                $obj = $res->fetch_Object();
                if(($count>0 && $obj->MaNV==$manv) || $count<=0){
                    $sql2="UPDATE `nhan_vien` SET `MaTK`='$tk',`Ho`='$ho',`Ten`='$ten',`NgaySinh`='$ngaysinh',`GioiTinh`='$gt',`DiaChi`='$diachi',`Sdt`='$sodienthoai',`TienLuong`='$tlnv' WHERE MaNV='$manv'";
                    $p->ExcuteQuery($sql2);
                    echo 1;
                }else{
                    echo 3;
                }
            }else{
                echo 2;
            }
        }
        if ($kieu=="xoanv"){
            $manv=$_POST['manv'];            
            $sql2="UPDATE `nhan_vien` SET TinhTrang=0 WHERE MaNV='$manv'";
            $p->ExcuteQuery($sql2);
            echo 1;            
        }  
        if ($kieu=="timkiemnv"){
            $kieutk=$_POST['kieutk'];
            if ($kieutk==0)   
                $s="";
            if ($kieutk==1){ 
                $s=" <div class='row timkiemtheohoten'>
                        <div class='col-md-2 col-sm-2 div1'>Họ tên:</div>
                        <div class='col-md-4 col-sm-4'>
                            <input class='form-control' type='text' id='hotennvtimkiem' placeholder='Nhập họ tên nhân viên cần tìm'  />
                        </div>
                    </div>";
            }
            if ($kieutk==2){                
                    $s="<div class='row timkiemtheogioitinh'>
                            <div class='col-md-2 col-sm-2 div1'>Giới tính:</div>
                            <div class='col-md-4 col-sm-4'>
                                <select class='form-select' id='gioitinhnvtimkiem'>
                                    <option value='-1' selected>Chọn giới tính cần tìm</option>
                                    <option value='0' selected>Nam</option>
                                    <option value='1' selected>Nữ</option>
                                </select>
                            </div>
                        </div>";                
            }
            if ($kieutk==3){                
                $s="<div class='row timkiemtheosdt'>
                        <div class='col-md-2 col-sm-2 div1'>Số điện thoại:</div>
                        <div class='col-md-4 col-sm-4'>
                            <input class='form-control' type='text' id='sdtnvtimkiem' placeholder='Nhập số điện thoại cần tìm'  />
                        </div>
                    </div>";                
            }
            if ($kieutk==4){                
                $s="<div class='row timkiemtheongaysinh'>
                        <div class='col-md-2 col-sm-2 div1'>Ngày sinh:</div>
                        <div class='col-md-4 col-sm-4'>
                            <input class='form-control' type='date' id='tungaysinhnvtimkiem' />
                        </div>
                        <div class='col-md-1 col-sm-2 div1'>-</div>
                        <div class='col-md-4 col-sm-4'>
                            <input class='form-control' type='date' id='denngaysinhnvtimkiem' />
                        </div>
                    </div>";                
            }
            echo $s;
        }       
    }
?>