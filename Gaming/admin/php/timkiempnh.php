<?php
    require_once("./KetnoiCSDL.php");
    require_once("./xulydulieu.php");
    $p=new CheckConnection();
    $p1=new Xuly();
    if (isset($_POST['kieu'])){
        $kieu=$_POST['kieu'];
        if ($kieu=="kieu1"){
            $page=1;
            $manv=$_POST['manv'];
            if (isset($_POST['page']))
                $page=$_POST['page'];    
            $tu=($page-1)*5;  
            $sql="SELECT pnh.MaPNH,pnh.MaNV,nsx.TenNSX,pnh.TongTien,pnh.NgayNhap 
            FROM phieu_nhap_hang as pnh, nha_san_xuat as nsx 
            WHERE pnh.MaNSX=nsx.MaNSX AND pnh.TinhTrang!=0 AND pnh.MaNV='$manv' LIMIT $tu,5"; 
            $s="<div class='row'>Không có thông tin cần tìm</div>";
            $rs=$p->ExcuteQuery($sql);
            if (mysqli_num_rows($rs)>0){                                              
                $s="<div class='row'>
                    <table class='table table-bordered bangpnh'>
                        <thead>
                            <tr>
                                <th class='tbpnh1'>Mã NV</th>
                                <th class='tbpnh2'>Nhà sản xuất</th>
                                <th class='tbpnh3'>Tổng tiền</th>
                                <th class='tbpnh4'>Ngày nhập</th>
                                <th class='tbpnh5'>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>";
                $rs=$p->ExcuteQuery($sql);
                while($r=mysqli_fetch_array($rs)){                           
                    $tien=$p1->Chuyentien($r[3]);
                    $ngay=$p1->Chuyenngaythuan($r[4]);
                    $s=$s."<tr>
                                <td class='pnh1'>$r[1]</td>
                                <td class='pnh1'>$r[2]</td>
                                <td class='pnh1'>$tien</td>
                                <td class='pnh1'>$ngay</td>
                                <td class='suaxoapnh'>
                                    <a href='./quanly.php?xuly=xempnh&id=$r[0]' class='xempnh'><i class='bx bx-detail'></i></i></a>
                                    <a href='./quanly.php?xuly=suapnh&id=$r[0]' class='suapnh'><i class='bx bx-edit'></i></a>
                                    <span p='$r[0]'><a href='#' class='xoapnh'><i class='bx bx-trash' ></i></a></span>
                                </td>  
                            </tr>";
                }
                $s=$s."</tbody>
                        </table>            
                    </div> 
                    <div class='row phantrangpnh'>
                        <div class='col-md-12 col-sm-12 phantrangpnh1'>";  
                $sql="SELECT pnh.MaPNH,pnh.MaNV,nsx.TenNSX,pnh.TongTien,pnh.NgayNhap 
                FROM phieu_nhap_hang as pnh, nha_san_xuat as nsx 
                WHERE pnh.MaNSX=nsx.MaNSX AND pnh.TinhTrang!=0 AND pnh.MaNV='$manv'";               
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
            $mansx=$_POST['mansx'];
            if (isset($_POST['page']))
                $page=$_POST['page'];    
            $tu=($page-1)*5;  
            $sql="SELECT pnh.MaPNH,pnh.MaNV,nsx.TenNSX,pnh.TongTien,pnh.NgayNhap 
            FROM phieu_nhap_hang as pnh, nha_san_xuat as nsx 
            WHERE pnh.MaNSX=nsx.MaNSX AND pnh.TinhTrang!=0 AND pnh.MaNSX='$mansx' LIMIT $tu,5"; 
            $s="<div class='row'>Không có thông tin cần tìm</div>";
            $rs=$p->ExcuteQuery($sql);
            if (mysqli_num_rows($rs)>0){                                              
                $s="<div class='row'>
                    <table class='table table-bordered bangpnh'>
                        <thead>
                            <tr>
                                <th class='tbpnh1'>Mã NV</th>
                                <th class='tbpnh2'>Nhà sản xuất</th>
                                <th class='tbpnh3'>Tổng tiền</th>
                                <th class='tbpnh4'>Ngày nhập</th>
                                <th class='tbpnh5'>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>";
                $rs=$p->ExcuteQuery($sql);
                while($r=mysqli_fetch_array($rs)){                           
                    $tien=$p1->Chuyentien($r[3]);
                    $ngay=$p1->Chuyenngaythuan($r[4]);
                    $s=$s."<tr>
                                <td class='pnh1'>$r[1]</td>
                                <td class='pnh1'>$r[2]</td>
                                <td class='pnh1'>$tien</td>
                                <td class='pnh1'>$ngay</td>
                                <td class='suaxoapnh'>
                                    <a href='./quanly.php?xuly=xempnh&id=$r[0]' class='xempnh'><i class='bx bx-detail'></i></i></a>
                                    <a href='./quanly.php?xuly=suapnh&id=$r[0]' class='suapnh'><i class='bx bx-edit'></i></a>
                                    <span p='$r[0]'><a href='#' class='xoapnh'><i class='bx bx-trash' ></i></a></span>
                                </td>  
                            </tr>";
                }
                $s=$s."</tbody>
                        </table>            
                    </div> 
                    <div class='row phantrangpnh'>
                        <div class='col-md-12 col-sm-12 phantrangpnh1'>";  
                $sql="SELECT pnh.MaPNH,pnh.MaNV,nsx.TenNSX,pnh.TongTien,pnh.NgayNhap 
                FROM phieu_nhap_hang as pnh, nha_san_xuat as nsx 
                WHERE pnh.MaNSX=nsx.MaNSX AND pnh.TinhTrang!=0 AND pnh.MaNSX='$mansx'";               
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
            $tungay=$_POST['tungay'];
            $denngay=$_POST['denngay'];
            if (isset($_POST['page']))
                $page=$_POST['page'];    
            $tu=($page-1)*5;  
            $sql="SELECT pnh.MaPNH,pnh.MaNV,nsx.TenNSX,pnh.TongTien,pnh.NgayNhap 
            FROM phieu_nhap_hang as pnh, nha_san_xuat as nsx 
            WHERE pnh.MaNSX=nsx.MaNSX AND pnh.TinhTrang!=0 AND pnh.NgayNhap>='$tungay' AND pnh.NgayNhap<='$denngay' 
            LIMIT $tu,5"; 
            $s="<div class='row'>Không có thông tin cần tìm</div>";
            $rs=$p->ExcuteQuery($sql);
            if (mysqli_num_rows($rs)>0){                                              
                $s="<div class='row'>
                    <table class='table table-bordered bangpnh'>
                        <thead>
                            <tr>
                                <th class='tbpnh1'>Mã NV</th>
                                <th class='tbpnh2'>Nhà sản xuất</th>
                                <th class='tbpnh3'>Tổng tiền</th>
                                <th class='tbpnh4'>Ngày nhập</th>
                                <th class='tbpnh5'>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>";
                $rs=$p->ExcuteQuery($sql);
                while($r=mysqli_fetch_array($rs)){                           
                    $tien=$p1->Chuyentien($r[3]);
                    $ngay=$p1->Chuyenngaythuan($r[4]);
                    $s=$s."<tr>
                                <td class='pnh1'>$r[1]</td>
                                <td class='pnh1'>$r[2]</td>
                                <td class='pnh1'>$tien</td>
                                <td class='pnh1'>$ngay</td>
                                <td class='suaxoapnh'>
                                    <a href='./quanly.php?xuly=xempnh&id=$r[0]' class='xempnh'><i class='bx bx-detail'></i></i></a>
                                    <a href='./quanly.php?xuly=suapnh&id=$r[0]' class='suapnh'><i class='bx bx-edit'></i></a>
                                    <span p='$r[0]'><a href='#' class='xoapnh'><i class='bx bx-trash' ></i></a></span>
                                </td>  
                            </tr>";
                }
                $s=$s."</tbody>
                        </table>            
                    </div> 
                    <div class='row phantrangpnh'>
                        <div class='col-md-12 col-sm-12 phantrangpnh1'>";  
                $sql="SELECT pnh.MaPNH,pnh.MaNV,nsx.TenNSX,pnh.TongTien,pnh.NgayNhap 
                FROM phieu_nhap_hang as pnh, nha_san_xuat as nsx 
                WHERE pnh.MaNSX=nsx.MaNSX AND pnh.TinhTrang!=0 AND pnh.NgayNhap>='$tungay' AND pnh.NgayNhap<='$denngay'";               
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
        $(".suaxoapnh span").click(function(){
            var mapnh=$(this).attr('p');
            if (confirm("Bạn có chắc muốn xóa")){
                $.post("./xulypnh.php",{kieu:'xoapnh',mapnh:mapnh},function(data){
                    if (data==1){
                        alert("Xóa thành công");
                        location.reload();
                    }
                });
            }
        });
        $("#chonkieutimkiempnh").change(function(){
            var kieutk=$(this).val();            
            $.post("./xulypnh.php",{kieu:'timkiempnh',kieutk:kieutk},function(data){
                $("#kieutimkiempnh").html(data);
            });
        });
        $(".phantrangpnh1 div").click(function(){
            var page=$(this).attr('page');
            var kieutk=$("#chonkieutimkiempnh").val();
            if (kieutk==0){
                alert("Chưa chọn kiểu tìm kiếm");
                return false;
            }
            if (kieutk==1){
                var manv=$("#manvpnhtimkiem").val();
                if (manv==""){
                    alert("Chưa nhập nhân viên cần tìm");
                    $("#manvpnhtimkiem").focus();
                    return false;
                }
                $.post("./timkiempnh.php",{kieu:'kieu1',manv:manv,page:page},function(data){
                    $("#hienpnh").html(data);
                })
            }
            if (kieutk==2){
                var mansx=$("#nsxpnhtimkiem").val();
                if (mansx==0){
                    alert("Chưa chọn nhà sản xuất cần tìm");
                    $("#nsxpnhtimkiem").focus();
                    return false;
                }
                $.post("./timkiempnh.php",{kieu:'kieu2',mansx:mansx,page:page},function(data){
                    $("#hienpnh").html(data);
                })
            }
            if (kieutk==3){
                var tungay=$("#tungaypnhtimkiem").val();
                var denngay=$("#denngaypnhtimkiem").val();
                if (tungay==""){
                    alert("Chưa chọn thời gian cần tìm");
                    $("#tungaypnhtimkiem").focus();
                    return false;
                }
                if (denngay==""){
                    alert("Chưa chọn thời gian cần tìm");
                    $("#denngaypnhtimkiem").focus();
                    return false;
                }
                if (tungay>denngay){
                    alert("Khoảng thòi gian không hợp lệ");
                    return false;
                }
                $.post("./timkiempnh.php",{kieu:'kieu3',tungay:tungay,denngay:denngay,page:page},function(data){                    
                    $("#hienpnh").html(data);
                })
            }
            
        });
    });
</script>