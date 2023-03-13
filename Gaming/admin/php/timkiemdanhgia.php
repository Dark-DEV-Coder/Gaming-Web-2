<?php
    require_once("./KetnoiCSDL.php");
    require_once("./xulydulieu.php");
    $p=new CheckConnection();
    $p1=new Xuly();
    if (isset($_POST['kieu'])){
        $kieu=$_POST['kieu'];
        if ($kieu=="kieu1"){
            $page=1;
            $tentk=$_POST['tentk'];
            if (isset($_POST['page']))
                $page=$_POST['page'];    
            $tu=($page-1)*5;  
            $sql="SELECT dg.MaBinhLuan,tk.Username,dg.MaNhomSP,dg.DanhGia 
            FROM danh_gia_sp as dg,tai_khoan as tk 
            WHERE tk.MaTK=dg.MaTK AND dg.TinhTrang!=0 AND tk.Username like '%$tentk%' LIMIT $tu,5"; 
            $s="<div class='row'>Không có thông tin cần tìm</div>";
            $rs=$p->ExcuteQuery($sql);
            if (mysqli_num_rows($rs)>0){                                              
                $s="<div class='row'>
                        <table class='table table-bordered bangdg'>
                            <thead>
                                <tr>
                                    <th class='tbdg1'>Mã bình luận</th>
                                    <th class='tbdg2'>Tên tài khoản</th>
                                    <th class='tbdg3'>Mã nhóm sản phẩm</th>
                                    <th class='tbdg4'>Số sao đánh giá</th>
                                    <th class='tbdg5'>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>";
                $rs=$p->ExcuteQuery($sql);
                while($r=mysqli_fetch_array($rs)){                           
                    $s=$s."<tr>
                                <td class='dg1'>$r[0]</td>      
                                <td>$r[1]</td>                                  
                                <td class='dg1'>$r[2]</td>
                                <td class='dg1'>$r[3]</td>
                                <td class='suaxoadg'>
                                    <a href='./quanly.php?xuly=xemdg&id=$r[0]' class='xemdg'><i class='bx bx-detail'></i></i></a>                                            
                                    <span p='$r[0]'><a href='#' class='xoadg'><i class='bx bx-trash' ></i></a></span>
                                </td>  
                            </tr>";
                }
                $s=$s."</tbody>
                        </table>            
                    </div> 
                    <div class='row phantrangdg'>
                        <div class='col-md-12 col-sm-12 phantrangdg1'>";  
                $sql="SELECT dg.MaBinhLuan,tk.Username,dg.MaNhomSP,dg.DanhGia 
                FROM danh_gia_sp as dg,tai_khoan as tk 
                WHERE tk.MaTK=dg.MaTK AND dg.TinhTrang!=0 AND tk.Username like '%$tentk%'";               
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
            $masp=$_POST['masp'];
            if (isset($_POST['page']))
                $page=$_POST['page'];    
            $tu=($page-1)*5;  
            $sql="SELECT dg.MaBinhLuan,tk.Username,dg.MaNhomSP,dg.DanhGia 
            FROM danh_gia_sp as dg,tai_khoan as tk 
            WHERE tk.MaTK=dg.MaTK AND dg.TinhTrang!=0 AND dg.MaNhomSP like '%$masp%' LIMIT $tu,5"; 
            $s="<div class='row'>Không có thông tin cần tìm</div>";
            $rs=$p->ExcuteQuery($sql);
            if (mysqli_num_rows($rs)>0){                                              
                $s="<div class='row'>
                        <table class='table table-bordered bangdg'>
                            <thead>
                                <tr>
                                    <th class='tbdg1'>Mã bình luận</th>
                                    <th class='tbdg2'>Tên tài khoản</th>
                                    <th class='tbdg3'>Mã nhóm sản phẩm</th>
                                    <th class='tbdg4'>Số sao đánh giá</th>
                                    <th class='tbdg5'>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>";
                $rs=$p->ExcuteQuery($sql);
                while($r=mysqli_fetch_array($rs)){                           
                    $s=$s."<tr>
                                <td class='dg1'>$r[0]</td>      
                                <td>$r[1]</td>                                  
                                <td class='dg1'>$r[2]</td>
                                <td class='dg1'>$r[3]</td>
                                <td class='suaxoadg'>
                                    <a href='./quanly.php?xuly=xemdg&id=$r[0]' class='xemdg'><i class='bx bx-detail'></i></i></a>                                            
                                    <span p='$r[0]'><a href='#' class='xoadg'><i class='bx bx-trash' ></i></a></span>
                                </td>  
                            </tr>";
                }
                $s=$s."</tbody>
                        </table>            
                    </div> 
                    <div class='row phantrangdg'>
                        <div class='col-md-12 col-sm-12 phantrangdg1'>";  
                $sql="SELECT dg.MaBinhLuan,tk.Username,dg.MaNhomSP,dg.DanhGia 
                FROM danh_gia_sp as dg,tai_khoan as tk 
                WHERE tk.MaTK=dg.MaTK AND dg.TinhTrang!=0 AND dg.MaNhomSP like '%$masp%'";               
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
        if ($kieu=="kieu3"){
            $page=1;
            $sao=$_POST['sao'];
            if (isset($_POST['page']))
                $page=$_POST['page'];    
            $tu=($page-1)*5;  
            $sql="SELECT dg.MaBinhLuan,tk.Username,dg.MaNhomSP,dg.DanhGia 
            FROM danh_gia_sp as dg,tai_khoan as tk 
            WHERE tk.MaTK=dg.MaTK AND dg.TinhTrang!=0 AND dg.DanhGia='$sao' LIMIT $tu,5"; 
            $s="<div class='row'>Không có thông tin cần tìm</div>";
            $rs=$p->ExcuteQuery($sql);
            if (mysqli_num_rows($rs)>0){                                              
                $s="<div class='row'>
                        <table class='table table-bordered bangdg'>
                            <thead>
                                <tr>
                                    <th class='tbdg1'>Mã bình luận</th>
                                    <th class='tbdg2'>Tên tài khoản</th>
                                    <th class='tbdg3'>Mã nhóm sản phẩm</th>
                                    <th class='tbdg4'>Số sao đánh giá</th>
                                    <th class='tbdg5'>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>";
                $rs=$p->ExcuteQuery($sql);
                while($r=mysqli_fetch_array($rs)){                           
                    $s=$s."<tr>
                                <td class='dg1'>$r[0]</td>      
                                <td>$r[1]</td>                                  
                                <td class='dg1'>$r[2]</td>
                                <td class='dg1'>$r[3]</td>
                                <td class='suaxoadg'>
                                    <a href='./quanly.php?xuly=xemdg&id=$r[0]' class='xemdg'><i class='bx bx-detail'></i></i></a>                                            
                                    <span p='$r[0]'><a href='#' class='xoadg'><i class='bx bx-trash' ></i></a></span>
                                </td>  
                            </tr>";
                }
                $s=$s."</tbody>
                        </table>            
                    </div> 
                    <div class='row phantrangdg'>
                        <div class='col-md-12 col-sm-12 phantrangdg1'>";  
                $sql="SELECT dg.MaBinhLuan,tk.Username,dg.MaNhomSP,dg.DanhGia 
                FROM danh_gia_sp as dg,tai_khoan as tk 
                WHERE tk.MaTK=dg.MaTK AND dg.TinhTrang!=0 AND dg.DanhGia='$sao'";               
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
        $(".suaxoadg span").click(function(){
            var madg=$(this).attr('p');
            if (confirm('Bạn có chắc muốn xóa')){
                $.post("./xulydanhgia.php",{kieu:'xoadg',madg:madg},function(data){
                    if (data==1){
                        alert("Xóa thành công");
                        location.reload(); 
                    }                   
                });
            }
        });
        $("#chonkieutimkiemdg").change(function(){
            var kieutk=$(this).val();
            $.post("./xulydanhgia.php",{kieu:'timkiemdg',kieutk:kieutk},function(data){
                $("#kieutimkiemdg").html(data);
            });
        });
        $(".phantrangdg1 div").click(function(){
            var page=$(this).attr('page');            
            var kieutk=$("#chonkieutimkiemdg").val();
            if (kieutk==0){
                alert("Chưa chọn kiểu tìm kiếm");
                return false;
            }
            if (kieutk==1){
                var tentk=$("#tentkdgtimkiem").val();
                if (tentk==""){
                    alert("Chưa nhập tên tài khoản");
                    $("#tentkdgtimkiem").focus();
                    return false;
                }
                $.post("./timkiemdanhgia.php",{kieu:'kieu1',tentk:tentk,page:page},function(data){
                    $("#hiendg").html(data);
                });
            }
            if (kieutk==2){
                var masp=$("#maspdgtimkiem").val();
                if (masp==""){
                    alert("Chưa nhập mã sản phẩm");
                    $("#maspdgtimkiem").focus();
                    return false;
                }
                $.post("./timkiemdanhgia.php",{kieu:'kieu2',masp:masp,page:page},function(data){
                    $("#hiendg").html(data);
                });
            }
            if (kieutk==3){
                var sao=$("#tinhtrangdgtimkiem").val();
                if (sao==0){
                    alert("Chưa chọn số sao");
                    $("#tinhtrangdgtimkiem").focus();
                    return false;
                }
                $.post("./timkiemdanhgia.php",{kieu:'kieu3',sao:sao,page:page},function(data){
                    $("#hiendg").html(data);
                });
            }
        });
    });
</script>