<?php
    require_once("./KetnoiCSDL.php");
    require_once("./xulydulieu.php");
    $p=new CheckConnection();
    $p1=new Xuly();
    if (isset($_POST['kieu'])){
        $kieu=$_POST['kieu'];
        if ($kieu=="kieu1"){
            $page=1;
            $tenkm=$_POST['tenkm'];
            if (isset($_POST['page']))
                $page=$_POST['page'];    
            $tu=($page-1)*5;  
            $sql="SELECT * FROM khuyen_mai WHERE TinhTrang!=0 AND TenKM like '%$tenkm%' LIMIT $tu,5"; 
            $s="<div class='row'>
                <table class='table table-bordered bangkm'>
                    <thead>
                        <tr>
                            <th class='tbkm1'>Tên chương trình khuyến mãi</th>
                            <th class='tbkm2'>Ngày bắt đầu</th>
                            <th class='tbkm3'>Ngày kết thúc</th>
                            <th class='tbkm4'>Tình trạng</th>
                            <th class='tbkm5'>Chức năng</th>
                        </tr>
                    </thead>
                <tbody>";
                $rs=$p->ExcuteQuery($sql);
                while($r=mysqli_fetch_array($rs)){
                    $ngay1=$p1->Chuyenngaythuan($r[2]);
                    $ngay2=$p1->Chuyenngaythuan($r[3]);
                    if ($r[4]==1)
                        $s1="<td class='km1' style='color:rgb(22, 184, 22);font-weight:600;'>Đang thực hiện</td>";
                    if ($r[4]==2)
                        $s1="<td class='km1' style='color:red;font-weight:600;'>Hết hạn</td>";
                    if ($r[4]==3)
                        $s1="<td class='km1' style='font-weight:600;'>Chưa tới hạn</td>";
                    $s=$s."<tr>
                                <td>$r[1]</td>                                        
                                <td class='km1'>$ngay1</td>
                                <td class='km1'>$ngay2</td>"
                                .$s1."
                                <td class='suaxoakm'>
                                    <a href='./quanly.php?xuly=xemkm&id=$r[0]' class='xemkm'><i class='bx bx-detail'></i></i></a>
                                    <a href='./quanly.php?xuly=suakm&id=$r[0]' class='suakm'><i class='bx bx-edit'></i></a>
                                    <span p='$r[0]'><a href='#' class='xoakm'><i class='bx bx-trash' ></i></a></span>
                                </td>  
                            </tr>";
            }
            $s=$s."</tbody>
                    </table>            
                </div> 
                <div class='row phantrangkm'>
                    <div class='col-md-12 col-sm-12 phantrangkm1'>";  
            $sql="";
            $sql="SELECT * FROM khuyen_mai WHERE TinhTrang!=0 AND TenKM like '%$tenkm%'";           
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
            echo $s;
        }  
        if ($kieu=="kieu2"){
            $page=1;
            $ngbd=$_POST['nbd'];
            $ngkt=$_POST['nkt'];
            if (isset($_POST['page']))
                $page=$_POST['page'];    
            $tu=($page-1)*5;  
            $sql="SELECT * FROM khuyen_mai WHERE TinhTrang!=0 AND (NgayBD>='$ngbd' and NgayKT<=$ngkt or 
            NgayBD>='$ngbd'and NgayBD<='$ngkt' and NgayKT>='$ngkt' or NgayBD<='$ngbd' and NgayKT>='$ngbd' and NgayKT<='$ngkt') LIMIT $tu,5"; 
             $s="<div class='row'>
             <table class='table table-bordered bangkm'>
                 <thead>
                     <tr>
                         <th class='tbkm1'>Tên chương trình khuyến mãi</th>
                         <th class='tbkm2'>Ngày bắt đầu</th>
                         <th class='tbkm3'>Ngày kết thúc</th>
                         <th class='tbkm4'>Tình trạng</th>
                         <th class='tbkm5'>Chức năng</th>
                     </tr>
                 </thead>
             <tbody>";
             //echo $sql; 
             $rs=$p->ExcuteQuery($sql);
             while($r=mysqli_fetch_array($rs)){
                 $ngay1=$p1->Chuyenngaythuan($r[2]);
                 $ngay2=$p1->Chuyenngaythuan($r[3]);
                 if ($r[4]==1)
                     $s1="<td class='km1' style='color:rgb(22, 184, 22);font-weight:600;'>Đang thực hiện</td>";
                 if ($r[4]==2)
                     $s1="<td class='km1' style='color:red;font-weight:600;'>Hết hạn</td>";
                 if ($r[4]==3)
                     $s1="<td class='km1' style='font-weight:600;'>Chưa tới hạn</td>";
                 $s=$s."<tr>
                             <td>$r[1]</td>                                        
                             <td class='km1'>$ngay1</td>
                             <td class='km1'>$ngay2</td>"
                             .$s1."
                             <td class='suaxoakm'>
                                 <a href='./quanly.php?xuly=xemkm&id=$r[0]' class='xemkm'><i class='bx bx-detail'></i></i></a>
                                 <a href='./quanly.php?xuly=suakm&id=$r[0]' class='suakm'><i class='bx bx-edit'></i></a>
                                 <span p='$r[0]'><a href='#' class='xoakm'><i class='bx bx-trash' ></i></a></span>
                             </td>  
                         </tr>";
         }
         $s=$s."</tbody>
                 </table>            
             </div> 
             <div class='row phantrangkm'>
                 <div class='col-md-12 col-sm-12 phantrangkm1'>";  
         $sql="";
         $sql="SELECT * FROM khuyen_mai WHERE TinhTrang!=0 AND (NgayBD>='$ngbd' and NgayKT<=$ngkt or 
         NgayBD>='$ngbd'and NgayBD<='$ngkt' and NgayKT>='$ngkt' or NgayBD<='$ngbd' and NgayKT>='$ngbd' and NgayKT<='$ngkt')";           
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
         echo $s;
        }
        if ($kieu=="kieu3"){
            $page=1;
            $tt=$_POST['tt'];
            if (isset($_POST['page']))
                $page=$_POST['page'];    
            $tu=($page-1)*5;  
            $sql="SELECT * FROM khuyen_mai WHERE TinhTrang=$tt LIMIT $tu,5"; 
            $s="<div class='row'>
                <table class='table table-bordered bangkm'>
                    <thead>
                        <tr>
                            <th class='tbkm1'>Tên chương trình khuyến mãi</th>
                            <th class='tbkm2'>Ngày bắt đầu</th>
                            <th class='tbkm3'>Ngày kết thúc</th>
                            <th class='tbkm4'>Tình trạng</th>
                            <th class='tbkm5'>Chức năng</th>
                        </tr>
                    </thead>
                <tbody>";
                $rs=$p->ExcuteQuery($sql);
                while($r=mysqli_fetch_array($rs)){
                    $ngay1=$p1->Chuyenngaythuan($r[2]);
                    $ngay2=$p1->Chuyenngaythuan($r[3]);
                    if ($r[4]==1)
                        $s1="<td class='km1' style='color:rgb(22, 184, 22);font-weight:600;'>Đang thực hiện</td>";
                    if ($r[4]==2)
                        $s1="<td class='km1' style='color:red;font-weight:600;'>Hết hạn</td>";
                    if ($r[4]==3)
                        $s1="<td class='km1' style='font-weight:600;'>Chưa tới hạn</td>";
                    $s=$s."<tr>
                                <td>$r[1]</td>                                        
                                <td class='km1'>$ngay1</td>
                                <td class='km1'>$ngay2</td>"
                                .$s1."
                                <td class='suaxoakm'>
                                    <a href='./quanly.php?xuly=xemkm&id=$r[0]' class='xemkm'><i class='bx bx-detail'></i></i></a>
                                    <a href='./quanly.php?xuly=suakm&id=$r[0]' class='suakm'><i class='bx bx-edit'></i></a>
                                    <span p='$r[0]'><a href='#' class='xoakm'><i class='bx bx-trash' ></i></a></span>
                                </td>  
                            </tr>";
            }
            $s=$s."</tbody>
                    </table>            
                </div> 
                <div class='row phantrangkm'>
                    <div class='col-md-12 col-sm-12 phantrangkm1'>";  
            $sql="";
            $sql="SELECT * FROM khuyen_mai WHERE TinhTrang=$tt";           
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
            echo $s;
        }
    }
?>
<script>
    $(document).ready(function(){
        $(".suaxoakm span").click(function(){
            var makm=$(this).attr('p');
            if (confirm("Bạn có chắc muốn xóa")){
                $.post("./xulykm.php",{kieu:'xoakm',makm:makm},function(data){
                    if (data==1){
                        alert("Xóa thành công");
                        location.reload();
                    }
                });
            }
        });
        $("#chonkieutimkiemkm").change(function(){
            var kieutk=$("#chonkieutimkiemkm").val();
            //alert(kieukh);
            $.post("./xulykm.php",{kieu:'timkiemkm',kieutk:kieutk},function(data){
                $("#kieutimkiemkm").html(data);
            });
        });
        $(".phantrangkm1 div").click(function(){
            var kieutk=$("#chonkieutimkiemkm").val();
            var page=$(this).attr('page');
            if (kieutk==0){
                alert("Chưa chọn kiểu tìm kiếm");
                return false;
            }
            if (kieutk==1){
                var tenkm=$("#tenkmtimkiem").val();
                if (tenkm==""){
                    alert("Chưa nhập tên khuyến mãi cần tìm");
                    $("#tenkmtimkiem").focus();
                    return false;
                }
                $.post("./timkiemkm.php",{kieu:'kieu1',tenkm:tenkm,page:page},function(data){
                    $("#hienkm").html(data);
                })
            }
            if (kieutk==2){
                var nbd=$("#tungaykmtimkiem").val();
                var nkt=$("#denngaykmtimkiem").val();
                if (nbd==""){
                    alert("Chưa chọn ngày từ cần tìm");
                    $("#tungaykmtimkiem").focus();
                    return false;
                }
                if (nkt==""){
                    alert("Chưa chọn ngày đến cần tìm");
                    $("#denngaykmtimkiem").focus();
                    return false;
                }
                $.post("./timkiemkm.php",{kieu:'kieu2',nbd:nbd,nkt:nkt,page:page},function(data){
                    $("#hienkm").html(data);
                })
            }
            if (kieutk==3){
                var tt=$("#tinhtrangkmtimkiem").val();
                if (tt==0){
                    alert("Chưa chọn tình trạng cần tìm");
                    $("#tinhtrangkmtimkiem").focus();
                    return false;
                }
                $.post("./timkiemkm.php",{kieu:'kieu3',tt:tt,page:page},function(data){      
                    //console.log(data);              
                    $("#hienkm").html(data);
                })
            }               
        });
    });
</script>