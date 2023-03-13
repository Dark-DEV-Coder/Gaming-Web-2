<?php
    require_once("./KetnoiCSDL.php");
    require_once("./xulydulieu.php");
    $p=new CheckConnection();
    $p1=new Xuly();
    if (isset($_POST['kieu'])){
        $kieu=$_POST['kieu'];
        if ($kieu=="kieu1"){
            $page=1;
            $hotennv=$_POST['hotennv'];
            if (isset($_POST['page']))
                $page=$_POST['page'];    
            $tu=($page-1)*5;  
            $sql="SELECT * FROM nhan_vien WHERE TinhTrang!=0 AND (Ten like '%$hotennv%' OR Ho like '%$hotennv%') LIMIT $tu,5"; 
            $s="<div class='row'>Không có thông tin cần tìm</div>";
            $rs=$p->ExcuteQuery($sql);
            if (mysqli_num_rows($rs)>0){                                              
                $s="<div class='row'>
                    <table class='table table-bordered bangnv'>
                        <thead>
                            <tr>
                                <th class='tbnv1'>Họ tên</th>
                                <th class='tbnv2'>Ngày sinh</th>
                                <th class='tbnv3'>Giới tính</th>
                                <th class='tbnv4'>Số điện thoại</th>
                                <th class='tbnv5'>Tiền lương</th>
                                <th class='tbnv6'>Chức năng</th>
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
                            <td class='nv1'>$ngs</td>
                            <td class='nv1'>$gt</td>
                            <td class='nv1'>$r[7]</td>
                            <td class='nv1'>$r[8]</td>
                            <td class='suaxoanv'>
                                <a href='./quanly.php?xuly=xemnv&id=$r[0]' class='xemnv'><i class='bx bx-detail'></i></i></a>
                                <a href='./quanly.php?xuly=suanv&id=$r[0]' class='suanv'><i class='bx bx-edit'></i></a>
                                <span p='$r[0]'><a href='#' class='xoanv'><i class='bx bx-trash' ></i></a></span>
                            </td>  
                        </tr>";
                }
                $s=$s."</tbody>
                        </table>
                    </div>
                    <div class='row phantrangnv'>
                        <div class='col-md-12 col-sm-12 phantrangnv1'>";  
                $sql="SELECT * FROM nhan_vien WHERE TinhTrang!=0 AND  (Ten like '%$hotennv%' OR Ho like '%$hotennv%')";               
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
            $gtnv=$_POST['gtnv'];
            if (isset($_POST['page']))
                $page=$_POST['page'];    
            $tu=($page-1)*5;  
            $sql="SELECT * FROM nhan_vien WHERE TinhTrang!=0 AND GioiTinh =$gtnv  LIMIT $tu,5"; 
            $s="<div class='row'>Không có thông tin cần tìm</div>";
            $rs=$p->ExcuteQuery($sql);
            if (mysqli_num_rows($rs)>0){                                              
                $s="<div class='row'>
                <table class='table table-bordered bangnv'>
                    <thead>
                        <tr>
                            <th class='tbnv1'>Họ tên</th>
                            <th class='tbnv2'>Ngày sinh</th>
                            <th class='tbnv3'>Giới tính</th>
                            <th class='tbnv4'>Số điện thoại</th>
                            <th class='tbnv5'>Tiền lương</th>
                            <th class='tbnv6'>Chức năng</th>
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
                            <td class='nv1'>$ngs</td>
                            <td class='nv1'>$gt</td>
                            <td class='nv1'>$r[7]</td>
                            <td class='nv1'>$r[8]</td>
                            <td class='suaxoanv'>
                                <a href='./quanly.php?xuly=xemnv&id=$r[0]' class='xemnv'><i class='bx bx-detail'></i></i></a>
                                <a href='./quanly.php?xuly=suanv&id=$r[0]' class='suanv'><i class='bx bx-edit'></i></a>
                                <span p='$r[0]'><a href='#' class='xoanv'><i class='bx bx-trash' ></i></a></span>
                            </td>  
                        </tr>";
                }
                $s=$s."</tbody>
                        </table>
                    </div>
                    <div class='row phantrangnv'>
                        <div class='col-md-12 col-sm-12 phantrangnv1'>";
                $sql="SELECT * FROM nhan_vien WHERE TinhTrang!=0 AND GioiTinh =$gtnv";             
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
            $sql="SELECT * FROM nhan_vien WHERE TinhTrang!=0 AND Sdt LIKE '%$sdt%'  LIMIT $tu,5"; 
            $s="<div class='row'>Không có thông tin cần tìm</div>";
            $rs=$p->ExcuteQuery($sql);
            if (mysqli_num_rows($rs)>0){                                              
                $s="<div class='row'>
                        <table class='table table-bordered bangnv'>
                            <thead>
                                <tr>
                                    <th class='tbnv1'>Họ tên</th>
                                    <th class='tbnv2'>Ngày sinh</th>
                                    <th class='tbnv3'>Giới tính</th>
                                    <th class='tbnv4'>Số điện thoại</th>
                                    <th class='tbnv5'>Tiền lương</th>
                                    <th class='tbnv6'>Chức năng</th>
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
                                <td class='nv1'>$ngs</td>
                                <td class='nv1'>$gt</td>
                                <td class='nv1'>$r[7]</td>
                                <td class='nv1'>$r[8]</td>
                                <td class='suaxoanv'>
                                    <a href='./quanly.php?xuly=xemnv&id=$r[0]' class='xemnv'><i class='bx bx-detail'></i></i></a>
                                    <a href='./quanly.php?xuly=suanv&id=$r[0]' class='suanv'><i class='bx bx-edit'></i></a>
                                    <span p='$r[0]'><a href='#' class='xoanv'><i class='bx bx-trash' ></i></a></span>
                                </td>  
                            </tr>";
                }
                $s=$s."</tbody>
                        </table>
                    </div>
                    <div class='row phantrangnv'>
                        <div class='col-md-12 col-sm-12 phantrangnv1'>";
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
            $sql="SELECT * FROM nhan_vien WHERE TinhTrang!=0 AND (NgaySinh>='$ngaytu' AND NgaySinh<='$ngayden') LIMIT $tu,5"; 
            echo $sql;
            $s="<div class='row'>Không có thông tin cần tìm</div>";
            $rs=$p->ExcuteQuery($sql);
            if (mysqli_num_rows($rs)>0){                                              
                $s="<div class='row'>
                    <table class='table table-bordered bangnv'>
                        <thead>
                            <tr>
                                <th class='tbnv1'>Họ tên</th>
                                <th class='tbnv2'>Ngày sinh</th>
                                <th class='tbnv3'>Giới tính</th>
                                <th class='tbnv4'>Số điện thoại</th>
                                <th class='tbnv5'>Tiền lương</th>
                                <th class='tbnv6'>Chức năng</th>
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
                                <td class='nv1'>$ngs</td>
                                <td class='nv1'>$gt</td>
                                <td class='nv1'>$r[7]</td>
                                <td class='nv1'>$r[8]</td>
                                <td class='suaxoanv'>
                                    <a href='./quanly.php?xuly=xemnv&id=$r[0]' class='xemnv'><i class='bx bx-detail'></i></i></a>
                                    <a href='./quanly.php?xuly=suanv&id=$r[0]' class='suanv'><i class='bx bx-edit'></i></a>
                                    <span p='$r[0]'><a href='#' class='xoanv'><i class='bx bx-trash' ></i></a></span>
                                </td>  
                            </tr>";
                }
                $s=$s."</tbody>
                        </table>
                    </div>
                    <div class='row phantrangnv'>
                        <div class='col-md-12 col-sm-12 phantrangnv1'>";
                $sql="SELECT * FROM nhan_vien WHERE TinhTrang!=0 AND (NgaySinh>='$ngaytu' AND NgaySinh<='$ngayden')";               
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
        $("#chonkieutimkiemnv").change(function(){
            var kieunv=$("#chonkieutimkiemnv").val();
            //alert(kieukh);
            $.post("./xulynhanvien.php",{kieu:'timkiemnv',kieutk:kieunv},function(data){
                $("#kieutimkiemkh").html(data);
            });
        });
        $(".phantrangnv1 div").click(function(){
            //alert("heklko");
            var kieunv=$("#chonkieutimkiemnv").val();
            var page=$(this).attr('page');
            if (kieunv==0){
                alert("Chưa chọn kiểu tìm kiếm");
                return false;
            }
            if (kieunv==1){
                var hotennv=$("#hotennvtimkiem").val();
                if (hotenv==""){
                    alert("Chưa nhập họ tên nhân viên cần tìm");
                    $("#hotennvtimkiem").focus();
                    return false;
                }
                $.post("./timkiemnhanvien.php",{kieu:'kieu1',hotenv:hotenv,page:page},function(data){
                    $("#hiennv").html(data);                  
                });
            }
            if (kieunv==2){
                var gtnv=$("#gioitinhnvtimkiem").val();
                //alert(gtkh);
                if (gtnv==-1){
                    alert("Chưa chọn giới tính nhân viên cần tìm");
                    $("#gioitinhnvtimkiem").focus();
                    return false;
                }
                $.post("./timkiemnhanvien.php",{kieu:'kieu2',gtnv:gtnv,page:page},function(data){
                    //alert(data);
                    $("#hiennv").html(data);                  
                });
            }
            if (kieunv==3){
                var sdt=$("#sdtnvtimkiem").val();
                //alert(sdt);
                if (sdt==""){
                    alert("Chưa nhập số điện thoại cần tìm");
                    $("#sdtnvtimkiem").focus();
                    return false;
                }
                $.post("./timkiemnhanvien.php",{kieu:'kieu3',sdt:sdt,page:page},function(data){
                    $("#hiennv").html(data);                  
                });
            }
            if (kieunv==4){
                var ngaytu=$("#tungaysinhnvtimkiem").val();
                var ngayden=$("#denngaysinhnvtimkiem").val();
                if (ngaytu==""){
                    alert("Chưa nhập ngày sinh từ cần tìm");
                    $("#tungaysinhnvtimkiem").focus();
                    return false;
                }
                if(ngayden==""){
                    alert("Chưa nhập ngày sinh đến cần tìm");
                    $("#denngaysinhnvtimkiem").focus();
                    return false;
                }
                $.post("./timkiemnhanvien.php",{kieu:'kieu4',ngaytu:ngaytu,ngayden:ngayden,page:page},function(data){
                    $("#hiennv").html(data);                  
                });
            }         
        });
    });
</script>