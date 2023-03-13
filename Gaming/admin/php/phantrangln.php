<?php
    require_once("./KetnoiCSDL.php");
    $p=new CheckConnection();
    if (isset($_POST['kieu'])){
        $kieu=$_POST['kieu'];
        if ($kieu=="phantrangln"){
            $page=$_POST['page'];    
            $tu=($page-1)*5;  
            $sql="SELECT * FROM loi_nhuan WHERE TinhTrang!=0 LIMIT $tu,5";                                               
            $s="<div class='row'>
                    <table class='table table-bordered bangln'>
                        <thead>
                            <tr>
                                <th class='tbln1'>Mã lợi nhuận</th>
                                <th class='tbln2'>Mã nhóm sản phẩm</th>                       
                                <th class='tbln3'>% lợi nhuận</th>
                                <th class='tbln4'>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>";
            $rs=$p->ExcuteQuery($sql);
            while($r=mysqli_fetch_array($rs)){                           
                $s=$s."<tr>
                            <td class='ln1'>$r[0]</td>
                            <td class='ln1'>$r[1]</td>
                            <td class='ln1'>$r[2]%</td>
                            <td class='suaxoaln'>
                                <a href='./quanly.php?xuly=sualn&id=$r[0]' p='$r[0]' class='sualn'><i class='bx bx-edit'></i></a>
                            </td> 
                        </tr>";
            }
            $s=$s."</tbody>
                    </table>            
                </div> 
                <div class='row phantrangln'>
                    <div class='col-md-12 col-sm-12 phantrangln1'>";  
            $sql="SELECT * FROM loi_nhuan WHERE TinhTrang!=0";               
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
        $(".phantrangln1 div").click(function(){
            var page=$(this).attr('page');
            $.post("./phantrangln.php",{kieu:'phantrangln',page:page},function(data){
                $("#hienln").html(data);                  
            });            
        });
        $("#nuttimkiemln").click(function(){
            var maspln=$("#masplntimkiem").val();
            if (maspln==""){
                alert("Chưa nhập mã sản phẩm cần tìm");
                $("#masplntimkiem").focus();
                return false;
            }
            $.post("./timkiemln.php",{kieu:'timkiemln',maspln:maspln},function(data){
                $("#hienln").html(data);                  
            });            
        });
    });
</script>