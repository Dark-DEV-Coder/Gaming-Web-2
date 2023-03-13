<?php
    require_once("./KetnoiCSDL.php");
    $p=new CheckConnection();
    if (isset($_POST['kieu'])){
        $kieu=$_POST['kieu'];
        if ($kieu=="phantrangqtk"){
            $page=$_POST['page'];    
            $tu=($page-1)*5;  
            if (isset($_POST['tenqtktimkiem'])){
                $tenq=$_POST['tenqtktimkiem'];
                if ($tenq!="")  
                    $sql="SELECT * FROM quyen_tk WHERE TinhTrang!=0 AND TenQuyen like '$tenq%' LIMIT $tu,5";
                else
                    $sql="SELECT * FROM quyen_tk WHERE TinhTrang!=0 LIMIT $tu,5"; 
            }                                     
            $s="<div class='row'>
                    <table class='table table-bordered bangqtk'>
                        <thead>
                            <tr>
                                <th class='tbqtk1'>Mã quyền</th>
                                <th class='tbqtk2'>Tên quyền tài khoản</th>                       
                                <th class='tbqtk3'>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>";
            $rs=$p->ExcuteQuery($sql);
            while($r=mysqli_fetch_array($rs)){                           
                $s=$s."<tr>
                            <td class='qtk1'>$r[0]</td>
                            <td class='qtk1'>$r[1]</td>
                            <td class='suaxoaqtk'>
                                <a href='./quanly.php?xuly=xemquyentk&id=$r[0]' class='suaqtk'><i class='bx bx-detail'></i></i></a>
                                <a href='./quanly.php?xuly=suaquyentk&id=$r[0]' class='suaqtk'><i class='bx bx-edit'></i></a>
                                <span p='$r[0]'><a href='#' class='xoaqtk'><i class='bx bx-trash' ></i></a></span>
                            </td>  
                        </tr>";
            }
            $s=$s."</tbody>
                </table>            
            </div> 
            <div class='row phantrangqtk'>
                <div class='col-md-12 col-sm-12 phantrangqtk1'>";  
            if (isset($_POST['tenqtktimkiem'])){
                $tenq=$_POST['tenqtktimkiem'];
                if ($tenq!="")  
                    $sql="SELECT * FROM quyen_tk WHERE TinhTrang!=0 AND TenQuyen like '$tenq%'";
                else
                    $sql="SELECT * FROM quyen_tk WHERE TinhTrang!=0"; 
            }   
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
        if ($kieu=="timkiemqtk"){
            $tenq=$_POST['tenqtktimkiem'];            
            $sql="SELECT * FROM quyen_tk WHERE TinhTrang!=0 AND TenQuyen like '%$tenq%' LIMIT 0,5";        
            $s="<div class='row'>
                    <table class='table table-bordered bangqtk'>
                        <thead>
                            <tr>
                                <th class='tbqtk1'>Mã quyền</th>
                                <th class='tbqtk2'>Tên quyền tài khoản</th>                       
                                <th class='tbqtk3'>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>";
            $rs=$p->ExcuteQuery($sql);
            while($r=mysqli_fetch_array($rs)){                           
                $s=$s."<tr>
                            <td class='qtk1'>$r[0]</td>
                            <td class='qtk1'>$r[1]</td>
                            <td class='suaxoaqtk'>
                                <a href='./quanly.php?xuly=xemquyentk&id=$r[0]' class='suaqtk'><i class='bx bx-detail'></i></i></a>
                                <a href='./quanly.php?xuly=suaquyentk&id=$r[0]' class='suaqtk'><i class='bx bx-edit'></i></a>
                                <span p='$r[0]'><a href='#' class='xoaqtk'><i class='bx bx-trash' ></i></a></span>
                            </td>  
                        </tr>";
            }
            $s=$s."</tbody>
                </table>            
            </div> 
            <div class='row phantrangqtk'>
                <div class='col-md-12 col-sm-12 phantrangqtk1'>";    
            $sql="SELECT * FROM quyen_tk WHERE TinhTrang!=0 AND TenQuyen like '%$tenq%'";
            $rs=$p->ExcuteQuery($sql);
            $page=0;
            if (mysqli_num_rows($rs)>5){
                $k=ceil(mysqli_num_rows($rs)/5);
                $s=$s."<div page='1' style='background-color:#0d6efd'>1</div>";
                for ($i=2;$i<=$k;$i++){
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
        $(".suaxoaqtk span").click(function(){
            var maq=$(this).attr('p');
            if (confirm('Bạn có chắc muốn xóa')){
                $.post("./xulyquyentk.php",{kieu:'xoaqtk',maq:maq},function(data){
                    if (data==1){
                        alert("Xóa thành công");
                        location.reload(); 
                    }                   
                });
            }
        });
        $("#nuttimkiemqtk").click(function(){
            var tenqtktimkiem=$("#tenqtktimkiem").val();
            if (tenqtktimkiem==""){
                aler("Chưa nhập tên cần tìm");
                $("#tenqtktimkiem").focus();
                return false;
            }
            $.post("./xulyquyentk.php",{kieu:'timkiemqtk',tenqtktimkiem:tenqtktimkiem},function(data){
                $("#hienqtk").html(data);                  
            });
            
        });
        $(".phantrangqtk1 div").click(function(){
            var page=$(this).attr('page');
            var tenqtktimkiem=$("#tenqtktimkiem").val();
            $.post("./phantrangqtk.php",{kieu:'phantrangqtk',page:page,tenqtktimkiem:tenqtktimkiem},function(data){
                $("#hienqtk").html(data);                  
            });
            
        });
    });
</script>