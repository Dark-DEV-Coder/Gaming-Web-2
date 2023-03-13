<?php
    require_once("./KetnoiCSDL.php");
    $p=new CheckConnection();
    if (isset($_POST['kieu'])){
        $kieu=$_POST['kieu'];
        if ($kieu=="kieu1"){
            $page=1;
            $tentk=$_POST['tentk'];
            if (isset($_POST['page']))
                $page=$_POST['page'];    
            $tu=($page-1)*5;  
            $sql="SELECT tk.MaTK,qtk.TenQuyen,tk.Username 
            FROM tai_khoan as tk,quyen_tk as qtk 
            WHERE qtk.MaQuyen=tk.MaQuyen AND tk.TinhTrang!=0 AND tk.Username like '%$tentk%' LIMIT $tu,5"; 
            $s="<div class='row'>Không có thông tin cần tìm</div>";
            $rs=$p->ExcuteQuery($sql);
            if (mysqli_num_rows($rs)>0){                                              
                $s="<div class='row'>
                        <table class='table table-bordered bangtk'>
                            <thead>
                                <tr>
                                <th class='tbtk1'>Mã tài khoản</th>
                                <th class='tbtk2'>Quyền tài khoản</th>
                                <th class='tbtk3'>Tên tài khoản</th>
                                <th class='tbtk4'>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>";            
                while($r=mysqli_fetch_array($rs)){                           
                    $s=$s."<tr>
                                <td>$r[0]</td>
                                <td class='tk1'>$r[1]</td>
                                <td>$r[2]</td>
                                <td class='suaxoatk'>
                                <a href='./quanly.php?xuly=xemtk&id=$r[0]' class='xemtk'><i class='bx bx-detail'></i></i></a>
                                <a href='./quanly.php?xuly=suatk&id=$r[0]' class='suatk'><i class='bx bx-edit'></i></a>
                                <span p='$r[0]'><a href='#' class='xoatk'><i class='bx bx-trash' ></i></a></span>
                                </td>  
                            </tr>";
                }
                $s=$s."</tbody>
                    </table>            
                </div> 
                <div class='row phantrangtk'>
                    <div class='col-md-12 col-sm-12 phantrangtk1'>";  
                $sql="SELECT tk.MaTK,qtk.TenQuyen,tk.Username 
                FROM tai_khoan as tk,quyen_tk as qtk 
                WHERE qtk.MaQuyen=tk.MaQuyen AND tk.TinhTrang!=0 AND tk.Username like '%$tentk%'";               
                $rs=$p->ExcuteQuery($sql);
                if (mysqli_num_rows($rs)>5){
                    $k=ceil(mysqli_num_rows($rs)/5);                
                    for ($i=1;$i<=$k;$i++){
                        if ($i!=$k){
                            if ($i<$page-4 || $i>$page+4){
                                if ($i==$page-6 || $i==$page+6)
                                    $s=$s."<div>...</div>";                            
                                $s=$s."<div class='pagemenuhide' page='$i'>$i</div>";
                            }
                            if ($i>=$page-4 && $i<=$page+4){
                                if ($i==$page)
                                    $s=$s."<div style='background-color:#0d6efd' page='$i'>$i</div>";
                                else
                                    $s=$s."<div page='$i'>$i</div>";
                            }      
                        } 
                        else{
                            if ($i==$page)
                                $s=$s."<div style='background-color:#0d6efd' page='$i'>$i</div>";
                            else
                                $s=$s."<div page='$i'>$i</div>";
                        }                                
                    }
                }  
                $s=$s."</div>
                </div>"; 
            }            
            echo $s;
        }  
        if ($kieu=="kieu2"){
            $page=1;
            $maq=$_POST['maq'];
            if (isset($_POST['page']))
                $page=$_POST['page'];    
            $tu=($page-1)*5;  
            $sql="SELECT tk.MaTK,qtk.TenQuyen,tk.Username 
            FROM tai_khoan as tk,quyen_tk as qtk 
            WHERE qtk.MaQuyen=tk.MaQuyen AND tk.TinhTrang!=0 AND tk.MaQuyen='$maq' LIMIT $tu,5";  
            $s="<div class='row'>Không có thông tin cần tìm</div>";
            $rs=$p->ExcuteQuery($sql);
            if (mysqli_num_rows($rs)>0){                                             
                $s="<div class='row'>
                        <table class='table table-bordered bangtk'>
                            <thead>
                                <tr>
                                <th class='tbtk1'>Mã tài khoản</th>
                                <th class='tbtk2'>Quyền tài khoản</th>
                                <th class='tbtk3'>Tên tài khoản</th>
                                <th class='tbtk4'>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>";
                while($r=mysqli_fetch_array($rs)){                           
                    $s=$s."<tr>
                                <td>$r[0]</td>
                                <td class='tk1'>$r[1]</td>
                                <td>$r[2]</td>
                                <td class='suaxoatk'>
                                <a href='./quanly.php?xuly=xemtk&id=$r[0]' class='xemtk'><i class='bx bx-detail'></i></i></a>
                                <a href='./quanly.php?xuly=suatk&id=$r[0]' class='suatk'><i class='bx bx-edit'></i></a>
                                <span p='$r[0]'><a href='#' class='xoatk'><i class='bx bx-trash' ></i></a></span>
                                </td>  
                            </tr>";
                }
                $s=$s."</tbody>
                    </table>            
                </div> 
                <div class='row phantrangtk'>
                    <div class='col-md-12 col-sm-12 phantrangtk1'>";  
                $sql="SELECT tk.MaTK,qtk.TenQuyen,tk.Username 
                FROM tai_khoan as tk,quyen_tk as qtk 
                WHERE qtk.MaQuyen=tk.MaQuyen AND tk.TinhTrang!=0 AND tk.MaQuyen='$maq'";               
                $rs=$p->ExcuteQuery($sql);
                if (mysqli_num_rows($rs)>5){
                    $k=ceil(mysqli_num_rows($rs)/5);                
                    for ($i=1;$i<=$k;$i++){
                        if ($i!=$k){
                            if ($i<$page-4 || $i>$page+4){
                                if ($i==$page-6 || $i==$page+6)
                                    $s=$s."<div>...</div>";                            
                                $s=$s."<div class='pagemenuhide' page='$i'>$i</div>";
                            }
                            if ($i>=$page-4 && $i<=$page+4){
                                if ($i==$page)
                                    $s=$s."<div style='background-color:#0d6efd' page='$i'>$i</div>";
                                else
                                    $s=$s."<div page='$i'>$i</div>";
                            }      
                        } 
                        else{
                            if ($i==$page)
                                $s=$s."<div style='background-color:#0d6efd' page='$i'>$i</div>";
                            else
                                $s=$s."<div page='$i'>$i</div>";
                        }                                
                    }
                }  
                $s=$s."</div>
                </div>";  
            }           
            echo $s;
        }      
    }
?>
<script>
    $(document).ready(function(){
        $(".suaxoatk span").click(function(){
            var matk=$(this).attr('p');
            if (confirm('Bạn có chắc muốn xóa')){
                $.post("./xulytaikhoan.php",{kieu:'xoatk',matk:matk},function(data){
                    if (data==1){
                        alert("Xóa thành công");
                        location.reload(); 
                    }                   
                });
            }
        });      
        $("#chonkieutimkiemtk").change(function(){
            var kieutk=$("#chonkieutimkiemtk").val();
            $.post("./xulytaikhoan.php",{kieu:'timkiemtk',kieutk:kieutk},function(data){
                $("#kieutimkiemtk").html(data);
            });
        });  
        $(".phantrangtk1 div").click(function(){
            var page=$(this).attr('page');
            var kieutk=$("#chonkieutimkiemtk").val();
            if (kieutk==1){
                var tentk=$("#tentktimkiem").val();
                if (tentk==""){
                    alert("Chưa nhập tên tài khoản cần tìm");
                    $("#tentktimkiem").focus();
                    return false;
                }
                $.post("./timkiemtaikhoan.php",{kieu:'kieu1',tentk:tentk,page:page},function(data){
                    $("#hientk").html(data);                  
                });
            }
            if (kieutk==2){
                var maq=$("#quyentktktimkiem").val();
                if (maq==0){
                    alert("Chưa chọn quyền tài khoản cần tìm");
                    $("#quyentktktimkiem").focus();
                    return false;
                }
                $.post("./timkiemtaikhoan.php",{kieu:'kieu2',maq:maq,page:page},function(data){
                    $("#hientk").html(data);                  
                });
            }
        });
    });
</script>