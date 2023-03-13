<?php
    require_once("./KetnoiCSDL.php");
    require_once("./xulydulieu.php");
    $p=new CheckConnection();
    $p1=new Xuly();
    if (isset($_POST['kieu'])){
        $kieu=$_POST['kieu'];
        if ($kieu=="kieu1"){
            $page=1;
            $masp=$_POST['masp'];
            if (isset($_POST['page']))
                $page=$_POST['page'];    
            $tu=($page-1)*5;  
            $sql="SELECT sp.MaNhomSP,sp.HinhAnh,sp.Ten,nsx.TenNSX 
            FROM san_pham as sp, nha_san_xuat as nsx 
            WHERE nsx.MaNSX=sp.MaNSX AND sp.TinhTrang!=0 AND sp.MaNhomSP like '%$masp%' ORDER BY sp.Ten LIMIT $tu,5"; 
            $s="<div class='row'>Không có thông tin cần tìm</div>";
            $rs=$p->ExcuteQuery($sql);
            if (mysqli_num_rows($rs)>0){                                              
                $s="<div class='row'>
                        <table class='table table-bordered bangsp'>
                            <thead>
                                <tr>
                                    <th class='tbsp1'>Mã sản phẩm</th>
                                    <th class='tbsp2'>Hình ảnh</th>
                                    <th class='tbsp3'>Tên sản phẩm</th>
                                    <th class='tbsp4'>Nhà sản xuất</th>
                                    <th class='tbsp5'>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>";
                $rs=$p->ExcuteQuery($sql);
                while($r=mysqli_fetch_array($rs)){                           
                    $s=$s."<tr>
                            <td>$r[0]</td>
                            <td class='imgsp'><img src='../img/$r[1]' /></td>
                            <td>$r[2]</td>
                            <td>$r[3]</td>
                            <td class='suaxoasp'>
                                <a href='./quanly.php?xuly=xemsp&id=$r[0]' class='xemsp'><i class='bx bx-detail'></i></i></a>
                                <a href='./quanly.php?xuly=suasp&id=$r[0]' p='$r[0]' class='suasp'><i class='bx bx-edit'></i></a>
                                <span p='$r[0]'><a href='#' class='xoasp'><i class='bx bx-trash' ></i></a></span>
                            </td>  
                        </tr>";
                }
                $s=$s."</tbody>
                        </table>            
                    </div> 
                    <div class='row phantrangsp'>
                        <div class='col-md-12 col-sm-12 phantrangsp1'>";  
                $sql="SELECT sp.MaNhomSP,sp.HinhAnh,sp.Ten,nsx.TenNSX 
                FROM san_pham as sp, nha_san_xuat as nsx 
                WHERE nsx.MaNSX=sp.MaNSX AND sp.TinhTrang!=0 AND sp.MaNhomSP like '%$masp%' ORDER BY sp.Ten";               
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
            $tensp=$_POST['tensp'];
            if (isset($_POST['page']))
                $page=$_POST['page'];    
            $tu=($page-1)*5;  
            $sql="SELECT sp.MaNhomSP,sp.HinhAnh,sp.Ten,nsx.TenNSX 
            FROM san_pham as sp, nha_san_xuat as nsx 
            WHERE nsx.MaNSX=sp.MaNSX AND sp.TinhTrang!=0 AND sp.Ten like '%$tensp%' ORDER BY sp.Ten LIMIT $tu,5"; 
            $s="<div class='row'>Không có thông tin cần tìm</div>";
            $rs=$p->ExcuteQuery($sql);
            if (mysqli_num_rows($rs)>0){                                              
                $s="<div class='row'>
                        <table class='table table-bordered bangsp'>
                            <thead>
                                <tr>
                                    <th class='tbsp1'>Mã sản phẩm</th>
                                    <th class='tbsp2'>Hình ảnh</th>
                                    <th class='tbsp3'>Tên sản phẩm</th>
                                    <th class='tbsp4'>Nhà sản xuất</th>
                                    <th class='tbsp5'>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>";
                $rs=$p->ExcuteQuery($sql);
                while($r=mysqli_fetch_array($rs)){                           
                    $s=$s."<tr>
                            <td>$r[0]</td>
                            <td class='imgsp'><img src='../img/$r[1]' /></td>
                            <td>$r[2]</td>
                            <td>$r[3]</td>
                            <td class='suaxoasp'>
                                <a href='./quanly.php?xuly=xemsp&id=$r[0]' class='xemsp'><i class='bx bx-detail'></i></i></a>
                                <a href='./quanly.php?xuly=suasp&id=$r[0]' p='$r[0]' class='suasp'><i class='bx bx-edit'></i></a>
                                <span p='$r[0]'><a href='#' class='xoasp'><i class='bx bx-trash' ></i></a></span>
                            </td>  
                        </tr>";
                }
                $s=$s."</tbody>
                        </table>            
                    </div> 
                    <div class='row phantrangsp'>
                        <div class='col-md-12 col-sm-12 phantrangsp1'>";  
                $sql="SELECT sp.MaNhomSP,sp.HinhAnh,sp.Ten,nsx.TenNSX 
                FROM san_pham as sp, nha_san_xuat as nsx 
                WHERE nsx.MaNSX=sp.MaNSX AND sp.TinhTrang!=0 AND sp.Ten like '%$tensp%' ORDER BY sp.Ten";               
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
            $loaisp=$_POST['loaisp'];
            if (isset($_POST['page']))
                $page=$_POST['page'];    
            $tu=($page-1)*5;  
            $sql="SELECT sp.MaNhomSP,sp.HinhAnh,sp.Ten,nsx.TenNSX 
            FROM san_pham as sp, nha_san_xuat as nsx 
            WHERE nsx.MaNSX=sp.MaNSX AND sp.TinhTrang!=0 AND sp.MaLoai='$loaisp' ORDER BY sp.Ten LIMIT $tu,5"; 
            $s="<div class='row'>Không có thông tin cần tìm</div>";
            $rs=$p->ExcuteQuery($sql);
            if (mysqli_num_rows($rs)>0){                                              
                $s="<div class='row'>
                        <table class='table table-bordered bangsp'>
                            <thead>
                                <tr>
                                    <th class='tbsp1'>Mã sản phẩm</th>
                                    <th class='tbsp2'>Hình ảnh</th>
                                    <th class='tbsp3'>Tên sản phẩm</th>
                                    <th class='tbsp4'>Nhà sản xuất</th>
                                    <th class='tbsp5'>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>";
                $rs=$p->ExcuteQuery($sql);
                while($r=mysqli_fetch_array($rs)){                           
                    $s=$s."<tr>
                            <td>$r[0]</td>
                            <td class='imgsp'><img src='../img/$r[1]' /></td>
                            <td>$r[2]</td>
                            <td>$r[3]</td>
                            <td class='suaxoasp'>
                                <a href='./quanly.php?xuly=xemsp&id=$r[0]' class='xemsp'><i class='bx bx-detail'></i></i></a>
                                <a href='./quanly.php?xuly=suasp&id=$r[0]' p='$r[0]' class='suasp'><i class='bx bx-edit'></i></a>
                                <span p='$r[0]'><a href='#' class='xoasp'><i class='bx bx-trash' ></i></a></span>
                            </td>  
                        </tr>";
                }
                $s=$s."</tbody>
                        </table>            
                    </div> 
                    <div class='row phantrangsp'>
                        <div class='col-md-12 col-sm-12 phantrangsp1'>";  
                $sql="SELECT sp.MaNhomSP,sp.HinhAnh,sp.Ten,nsx.TenNSX 
                FROM san_pham as sp, nha_san_xuat as nsx 
                WHERE nsx.MaNSX=sp.MaNSX AND sp.TinhTrang!=0 AND sp.MaLoai='$loaisp' ORDER BY sp.Ten";               
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
        if ($kieu=="kieu4"){
            $page=1;
            $nsxsp=$_POST['nsxsp'];
            if (isset($_POST['page']))
                $page=$_POST['page'];    
            $tu=($page-1)*5;  
            $sql="SELECT sp.MaNhomSP,sp.HinhAnh,sp.Ten,nsx.TenNSX 
            FROM san_pham as sp, nha_san_xuat as nsx 
            WHERE nsx.MaNSX=sp.MaNSX AND sp.TinhTrang!=0 AND sp.MaNSX='$nsxsp' ORDER BY sp.Ten LIMIT $tu,5"; 
            $s="<div class='row'>Không có thông tin cần tìm</div>";
            $rs=$p->ExcuteQuery($sql);
            if (mysqli_num_rows($rs)>0){                                              
                $s="<div class='row'>
                        <table class='table table-bordered bangsp'>
                            <thead>
                                <tr>
                                    <th class='tbsp1'>Mã sản phẩm</th>
                                    <th class='tbsp2'>Hình ảnh</th>
                                    <th class='tbsp3'>Tên sản phẩm</th>
                                    <th class='tbsp4'>Nhà sản xuất</th>
                                    <th class='tbsp5'>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>";
                $rs=$p->ExcuteQuery($sql);
                while($r=mysqli_fetch_array($rs)){                           
                    $s=$s."<tr>
                            <td>$r[0]</td>
                            <td class='imgsp'><img src='../img/$r[1]' /></td>
                            <td>$r[2]</td>
                            <td>$r[3]</td>
                            <td class='suaxoasp'>
                                <a href='./quanly.php?xuly=xemsp&id=$r[0]' class='xemsp'><i class='bx bx-detail'></i></i></a>
                                <a href='./quanly.php?xuly=suasp&id=$r[0]' p='$r[0]' class='suasp'><i class='bx bx-edit'></i></a>
                                <span p='$r[0]'><a href='#' class='xoasp'><i class='bx bx-trash' ></i></a></span>
                            </td>  
                        </tr>";
                }
                $s=$s."</tbody>
                        </table>            
                    </div> 
                    <div class='row phantrangsp'>
                        <div class='col-md-12 col-sm-12 phantrangsp1'>";  
                $sql="SELECT sp.MaNhomSP,sp.HinhAnh,sp.Ten,nsx.TenNSX 
                FROM san_pham as sp, nha_san_xuat as nsx 
                WHERE nsx.MaNSX=sp.MaNSX AND sp.TinhTrang!=0 AND sp.MaNSX='$nsxsp' ORDER BY sp.Ten";               
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
        if ($kieu=="kieu5"){
            $page=1;
            $loaisp=$_POST['loaisp'];
            $nsxsp=$_POST['nsxsp'];
            if (isset($_POST['page']))
                $page=$_POST['page'];    
            $tu=($page-1)*5;  
            $sql="SELECT sp.MaNhomSP,sp.HinhAnh,sp.Ten,nsx.TenNSX 
            FROM san_pham as sp, nha_san_xuat as nsx 
            WHERE nsx.MaNSX=sp.MaNSX AND sp.TinhTrang!=0 AND sp.MaNSX='$nsxsp' AND sp.MaLoai='$loaisp' 
            ORDER BY sp.Ten LIMIT $tu,5"; 
            $s="<div class='row'>Không có thông tin cần tìm</div>";
            $rs=$p->ExcuteQuery($sql);
            if (mysqli_num_rows($rs)>0){                                              
                $s="<div class='row'>
                        <table class='table table-bordered bangsp'>
                            <thead>
                                <tr>
                                    <th class='tbsp1'>Mã sản phẩm</th>
                                    <th class='tbsp2'>Hình ảnh</th>
                                    <th class='tbsp3'>Tên sản phẩm</th>
                                    <th class='tbsp4'>Nhà sản xuất</th>
                                    <th class='tbsp5'>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>";
                $rs=$p->ExcuteQuery($sql);
                while($r=mysqli_fetch_array($rs)){                           
                    $s=$s."<tr>
                            <td>$r[0]</td>
                            <td class='imgsp'><img src='../img/$r[1]' /></td>
                            <td>$r[2]</td>
                            <td>$r[3]</td>
                            <td class='suaxoasp'>
                                <a href='./quanly.php?xuly=xemsp&id=$r[0]' class='xemsp'><i class='bx bx-detail'></i></i></a>
                                <a href='./quanly.php?xuly=suasp&id=$r[0]' p='$r[0]' class='suasp'><i class='bx bx-edit'></i></a>
                                <span p='$r[0]'><a href='#' class='xoasp'><i class='bx bx-trash' ></i></a></span>
                            </td>  
                        </tr>";
                }
                $s=$s."</tbody>
                        </table>            
                    </div> 
                    <div class='row phantrangsp'>
                        <div class='col-md-12 col-sm-12 phantrangsp1'>";  
                $sql="SELECT sp.MaNhomSP,sp.HinhAnh,sp.Ten,nsx.TenNSX 
                FROM san_pham as sp, nha_san_xuat as nsx 
                WHERE nsx.MaNSX=sp.MaNSX AND sp.TinhTrang!=0 AND sp.MaNSX='$nsxsp' AND sp.MaLoai='$loaisp'
                 ORDER BY sp.Ten";               
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
        $(".suaxoasp span").click(function(){
            var masp=$(this).attr('p');
            if (confirm("Bạn có chắc muốn xóa")){
                $.post("./xulysanpham.php",{kieu:'xoasp',masp:masp},function(data){
                    if (data==1){
                        alert("Xóa thành công");
                        location.reload();
                    }
                });
            }
        });
        $("#chonkieutimkiemsp").change(function(){
            var kieutk=$(this).val();
            $.post("./xulysanpham.php",{kieu:'timkiemsp',kieutk:kieutk},function(data){
                $("#kieutimkiemsp").html(data);
            });
        });
        $(".phantrangsp1 div").click(function(){
            var page=$(this).attr('page');            
            var kieutk=$("#chonkieutimkiemsp").val();
            if (kieutk==0){
                alert("Chưa chọn kiểu tìm kiếm");
                return false;
            }
            if (kieutk==1){
                var masp=$("#masptimkiem").val();
                if (masp==""){
                    alert("Chưa nhập mã sản phẩm cần tìm");
                    $("#masptimkiem").focus();
                    return false;
                }
                $.post("./timkiemsanpham.php",{kieu:'kieu1',masp:masp,page:page},function(data){
                    $("#hiensp").html(data);
                })
            }
            if (kieutk==2){
                var tensp=$("#tensptimkiem").val();
                if (tensp==""){
                    alert("Chưa nhập tên sản phẩm cần tìm");
                    $("#tensptimkiem").focus();
                    return false;
                }
                $.post("./timkiemsanpham.php",{kieu:'kieu2',tensp:tensp,page:page},function(data){
                    $("#hiensp").html(data);
                })
            }
            if (kieutk==3){
                var loaisp=$("#loaisptimkiem").val();
                if (loaisp==0){
                    alert("Chưa chọn loại sản phẩm cần tìm");
                    $("#loaisptimkiem").focus();
                    return false;
                }              
                $.post("./timkiemsanpham.php",{kieu:'kieu3',loaisp:loaisp,page:page},function(data){                  
                    $("#hiensp").html(data);
                })
            }  
            if (kieutk==4){
                var nsxsp=$("#nsxsptimkiem").val();
                if (nsxsp==0){
                    alert("Chưa chọn loại sản phẩm cần tìm");
                    $("#nsxsptimkiem").focus();
                    return false;
                }              
                $.post("./timkiemsanpham.php",{kieu:'kieu4',nsxsp:nsxsp,page:page},function(data){                  
                    $("#hiensp").html(data);
                })
            }     
            if (kieutk==5){
                var loaisp=$("#loainsxsptimkiem1").val();
                var nsxsp=$("#loainsxsptimkiem2").val();
                if (loaisp==0){
                    alert("Chưa chọn loại sản phẩm cần tìm");
                    $("#loainsxsptimkiem1").focus();
                    return false;
                }   
                if (nsxsp==0){
                    alert("Chưa chọn nhà sản xuất cần tìm");
                    $("#loainsxsptimkiem2").focus();
                    return false;
                }            
                $.post("./timkiemsanpham.php",{kieu:'kieu5',loaisp:loaisp,nsxsp:nsxsp,page:page},function(data){                  
                    $("#hiensp").html(data);
                })
            }
        });
    });
</script>