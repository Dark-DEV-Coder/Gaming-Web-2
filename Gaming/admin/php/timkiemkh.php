<?php
    require_once("./KetnoiCSDL.php");
    require_once("./xulydulieu.php");
    $p=new CheckConnection();
    $p1=new Xuly();
    if (isset($_POST['kieu'])){
        $kieu=$_POST['kieu'];
        if ($kieu=="kieu1"){
            $page=1;
            $hotenkh=$_POST['hotenkh'];
            if (isset($_POST['page']))
                $page=$_POST['page'];    
            $tu=($page-1)*5;  
            $sql="SELECT * FROM khach_hang WHERE TinhTrang!=0 AND (Ten like '%$hotenkh%' OR Ho like '%$hotenkh%') LIMIT $tu,5"; 
            $s="<div class='row'>Không có thông tin cần tìm</div>";
            $rs=$p->ExcuteQuery($sql);
            if (mysqli_num_rows($rs)>0){                                              
                $s="<div class='row'>
                    <table class='table table-bordered bangkh'>
                    <thead>
                        <tr>
                            <th class='tbkh1'>Họ tên</th>
                            <th class='tbkh2'>Ngày sinh</th>
                            <th class='tbkh3'>Giới tính</th>
                            <th class='tbkh4'>Số điện thoại</th>
                            <th class='tbkh5'>Email</th>
                            <th class='tbkh6'>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>";            
                while($r=mysqli_fetch_array($rs)){                           
                    $ten=$r[2]." ".$r[3];
                    if ($r[5]==0)
                        $gt="Nam";
                    else
                        $gt="Nữ";
                    $ngs=$p1->Chuyenngaythuan($r[4]);
                    $s=$s."<tr>
                            <td>$ten</td>
                            <td class='kh1'>$ngs</td>
                            <td class='kh1'>$gt</td>
                            <td class='kh1'>$r[7]</td>
                            <td class='kh1'>$r[8]</td>
                            <td class='suaxoakh'>
                                <a href='./quanly.php?xuly=xemkh&id=$r[0]' class='xemkh'><i class='bx bx-detail'></i></i></a>
                                <a href='./quanly.php?xuly=suakh&id=$r[0]' class='suakh'><i class='bx bx-edit'></i></a>
                                <span p='$r[0]'><a href='#' class='xoakh'><i class='bx bx-trash' ></i></a></span>
                            </td>  
                            </tr>";
                }
                $s=$s."</tbody>
                        </table>
                    </div>
                    <div class='row phantrangkh'>
                        <div class='col-md-12 col-sm-12 phantrangkh1'>";  
                $sql="SELECT * FROM khach_hang WHERE TinhTrang!=0 AND  Ten like '%$hotenkh%' OR Ho like '%$hotenkh%'";               
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
            $gtkh=$_POST['gtkh'];
            if (isset($_POST['page']))
                $page=$_POST['page'];    
            $tu=($page-1)*5;  
            $sql="SELECT * FROM khach_hang WHERE TinhTrang!=0 AND GioiTinh =$gtkh  LIMIT $tu,5"; 
            $s="<div class='row'>Không có thông tin cần tìm</div>";
            $rs=$p->ExcuteQuery($sql);
            if (mysqli_num_rows($rs)>0){                                              
                $s="<div class='row'>
                    <table class='table table-bordered bangkh'>
                    <thead>
                        <tr>
                            <th class='tbkh1'>Họ tên</th>
                            <th class='tbkh2'>Ngày sinh</th>
                            <th class='tbkh3'>Giới tính</th>
                            <th class='tbkh4'>Số điện thoại</th>
                            <th class='tbkh5'>Email</th>
                            <th class='tbkh6'>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>";            
                while($r=mysqli_fetch_array($rs)){                           
                    $ten=$r[2]." ".$r[3];
                    if ($r[5]==0)
                        $gt="Nam";
                    else
                        $gt="Nữ";
                    $ngs=$p1->Chuyenngaythuan($r[4]);
                    $s=$s."<tr>
                            <td>$ten</td>
                            <td class='kh1'>$ngs</td>
                            <td class='kh1'>$gt</td>
                            <td class='kh1'>$r[7]</td>
                            <td class='kh1'>$r[8]</td>
                            <td class='suaxoakh'>
                                <a href='./quanly.php?xuly=xemkh&id=$r[0]' class='xemkh'><i class='bx bx-detail'></i></i></a>
                                <a href='./quanly.php?xuly=suakh&id=$r[0]' class='suakh'><i class='bx bx-edit'></i></a>
                                <span p='$r[0]'><a href='#' class='xoakh'><i class='bx bx-trash' ></i></a></span>
                            </td>  
                            </tr>";
                }
                $s=$s."</tbody>
                        </table>
                    </div>
                    <div class='row phantrangkh'>
                        <div class='col-md-12 col-sm-12 phantrangkh1'>";
                $sql="SELECT * FROM khach_hang WHERE TinhTrang!=0 AND GioiTinh =$gtkh";               
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
            $sdt=$_POST['sdt'];
            if (isset($_POST['page']))
                $page=$_POST['page'];    
            $tu=($page-1)*5;  
            $sql="SELECT * FROM khach_hang WHERE TinhTrang!=0 AND Sdt LIKE '%$sdt%'  LIMIT $tu,5"; 
            $s="<div class='row'>Không có thông tin cần tìm</div>";
            $rs=$p->ExcuteQuery($sql);
            if (mysqli_num_rows($rs)>0){                                              
                $s="<div class='row'>
                    <table class='table table-bordered bangkh'>
                    <thead>
                        <tr>
                            <th class='tbkh1'>Họ tên</th>
                            <th class='tbkh2'>Ngày sinh</th>
                            <th class='tbkh3'>Giới tính</th>
                            <th class='tbkh4'>Số điện thoại</th>
                            <th class='tbkh5'>Email</th>
                            <th class='tbkh6'>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>";            
                while($r=mysqli_fetch_array($rs)){                           
                    $ten=$r[2]." ".$r[3];
                    if ($r[5]==0)
                        $gt="Nam";
                    else
                        $gt="Nữ";
                    $ngs=$p1->Chuyenngaythuan($r[4]);
                    $s=$s."<tr>
                            <td>$ten</td>
                            <td class='kh1'>$ngs</td>
                            <td class='kh1'>$gt</td>
                            <td class='kh1'>$r[7]</td>
                            <td class='kh1'>$r[8]</td>
                            <td class='suaxoakh'>
                                <a href='./quanly.php?xuly=xemkh&id=$r[0]' class='xemkh'><i class='bx bx-detail'></i></i></a>
                                <a href='./quanly.php?xuly=suakh&id=$r[0]' class='suakh'><i class='bx bx-edit'></i></a>
                                <span p='$r[0]'><a href='#' class='xoakh'><i class='bx bx-trash' ></i></a></span>
                            </td>  
                            </tr>";
                }
                $s=$s."</tbody>
                        </table>
                    </div>
                    <div class='row phantrangkh'>
                        <div class='col-md-12 col-sm-12 phantrangkh1'>";
                $sql="SELECT * FROM khach_hang WHERE TinhTrang!=0 AND Sdt LIKE '%$sdt%'";               
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
            $ngaytu=$_POST['ngaytu'];
            $ngayden=$_POST['ngayden'];
            if (isset($_POST['page']))
                $page=$_POST['page'];    
            $tu=($page-1)*5;  
            $sql="SELECT * FROM khach_hang WHERE TinhTrang!=0 AND (NgaySinh>='$ngaytu' AND NgaySinh<='$ngayden') LIMIT $tu,5"; 
            echo $sql;
            $s="<div class='row'>Không có thông tin cần tìm</div>";
            $rs=$p->ExcuteQuery($sql);
            if (mysqli_num_rows($rs)>0){                                              
                $s="<div class='row'>
                    <table class='table table-bordered bangkh'>
                    <thead>
                        <tr>
                            <th class='tbkh1'>Họ tên</th>
                            <th class='tbkh2'>Ngày sinh</th>
                            <th class='tbkh3'>Giới tính</th>
                            <th class='tbkh4'>Số điện thoại</th>
                            <th class='tbkh5'>Email</th>
                            <th class='tbkh6'>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>";            
                while($r=mysqli_fetch_array($rs)){                           
                    $ten=$r[2]." ".$r[3];
                    if ($r[5]==0)
                        $gt="Nam";
                    else
                        $gt="Nữ";
                    $ngs=$p1->Chuyenngaythuan($r[4]);
                    $s=$s."<tr>
                            <td>$ten</td>
                            <td class='kh1'>$ngs</td>
                            <td class='kh1'>$gt</td>
                            <td class='kh1'>$r[7]</td>
                            <td class='kh1'>$r[8]</td>
                            <td class='suaxoakh'>
                                <a href='./quanly.php?xuly=xemkh&id=$r[0]' class='xemkh'><i class='bx bx-detail'></i></i></a>
                                <a href='./quanly.php?xuly=suakh&id=$r[0]' class='suakh'><i class='bx bx-edit'></i></a>
                                <span p='$r[0]'><a href='#' class='xoakh'><i class='bx bx-trash' ></i></a></span>
                            </td>  
                            </tr>";
                }
                $s=$s."</tbody>
                        </table>
                    </div>
                    <div class='row phantrangkh'>
                        <div class='col-md-12 col-sm-12 phantrangkh1'>";
                $sql="SELECT * FROM khach_hang WHERE TinhTrang!=0 AND (NgaySinh>='$ngaytu' AND NgaySinh<='$ngayden')";               
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
        $(".suaxoansx span").click(function(){
            var mansx=$(this).attr('p');
            if (confirm('Bạn có chắc muốn xóa')){
                $.post("./xulynsx.php",{kieu:'xoansx',mansx:mansx},function(data){
                    if (data==1){
                        alert("Xóa thành công");
                        location.reload(); 
                    }                   
                });
            }
        });
        $("#chonkieutimkiemkh").change(function(){
            var kieukh=$("#chonkieutimkiemkh").val();
            //alert(kieukh);
            $.post("./xulykh.php",{kieu:'timkiemkh',kieutk:kieukh},function(data){
                $("#kieutimkiemkh").html(data);
            });
        });
        $(".phantrangkh1 div").click(function(){
            //alert("heklko");
            var kieukh=$("#chonkieutimkiemkh").val();
            var page=$(this).attr('page');
            if (kieukh==0){
                alert("Chưa chọn kiểu tìm kiếm");
                return false;
            }
            if (kieukh==1){
                var hotenkh=$("#hotenkhtimkiem").val();
                if (hotenkh==""){
                    alert("Chưa nhập họ tên khách hàng cần tìm");
                    $("#hotenkhtimkiem").focus();
                    return false;
                }
                $.post("./timkiemkh.php",{kieu:'kieu1',hotenkh:hotenkh,page:page},function(data){
                    $("#hienkh").html(data);                  
                });
            }
            if (kieukh==2){
                var gtkh=$("#gioitinhkhtimkiem").val();
                //alert(gtkh);
                if (gtkh==-1){
                    alert("Chưa chọn giới tính khách hàng cần tìm");
                    $("#gioitinhkhtimkiem").focus();
                    return false;
                }
                $.post("./timkiemkh.php",{kieu:'kieu2',gtkh:gtkh,page:page},function(data){
                    //alert(data);
                    $("#hienkh").html(data);                  
                });
            }
            if (kieukh==3){
                var sdt=$("#sdtkhtimkiem").val();
                //alert(sdt);
                if (sdt==""){
                    alert("Chưa nhập số điện thoại cần tìm");
                    $("#sdtkhtimkiem").focus();
                    return false;
                }
                $.post("./timkiemkh.php",{kieu:'kieu3',sdt:sdt,page:page},function(data){
                    $("#hienkh").html(data);                  
                });
            }
            if (kieukh==4){
                var ngaytu=$("#tungaysinhkhtimkiem").val();
                var ngayden=$("#denngaysinhkhtimkiem").val();
                if (ngaytu==""){
                    alert("Chưa nhập ngày sinh từ cần tìm");
                    $("#tungaysinhkhtimkiem").focus();
                    return false;
                }
                if(ngayden==""){
                    alert("Chưa nhập ngày sinh đến cần tìm");
                    $("#denngaysinhkhtimkiem").focus();
                    return false;
                }
                $.post("./timkiemkh.php",{kieu:'kieu4',ngaytu:ngaytu,ngayden:ngayden,page:page},function(data){
                    $("#hienkh").html(data);                  
                });
            }         
        });
    });
</script>