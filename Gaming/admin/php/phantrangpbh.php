<?php
    require_once("./KetnoiCSDL.php");
    $p=new CheckConnection();
    if (isset($_POST['kieu'])){
        $kieu=$_POST['kieu'];
        if ($kieu=="phantrangpbh"){
            $page=$_POST['page'];    
            $tu=($page-1)*5;  
            $sql="SELECT * FROM phieu_bao_hanh WHERE TinhTrang!=0 LIMIT $tu,5";                                               
            $s="<div class='row'>
                    <table class='table table-bordered bangpbh'>
                        <thead>
                            <tr>
                            <th class='tbpbh1'>Mã PBH</th>
                            <th class='tbpbh2'>Mã sản phẩm</th>
                            <th class='tbpbh3'>Từ ngày</th>
                            <th class='tbpbh4'>Đến ngày</th>
                            <th class='tbpbh5'>Tình trạng</th>
                            <th class='tbpbh6'>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>";
            $rs=$p->ExcuteQuery($sql);
            while($r=mysqli_fetch_array($rs)){                           
                $ngay1=$p1->Chuyenngaythuan($r[2]);
                $ngay2=$p1->Chuyenngaythuan($r[3]);
                if ($r[4]==1)
                    $s1="<td class='pbh1' style='color:rgb(22, 184, 22);font-weight:600;'>Còn hạn</td>";
                if ($r[4]==2)
                    $s1="<td class='pbh1' style='color:red;font-weight:600;'>Hết hạn</td>";
                $s=$s."<tr>
                            <td class='pbh1'>$r[0]</td>
                            <td class='pbh1'>$r[1]</td>
                            <td class='pbh1'>$ngay1</td>
                            <td class='pbh1'>$ngay2</td>"
                            .$s1."
                            <td class='suaxoapbh'>                                                                                        
                                <span p='$r[0]' p1='$r[4]'><a href='#' class='xoapbh'><i class='bx bx-trash' ></i></a></span>
                            </td>  
                        </tr>";
            }
            $s=$s."</tbody>
                    </table>            
                </div> 
                <div class='row phantrangpbh'>
                    <div class='col-md-12 col-sm-12 phantrangpbh1'>";  
            $sql="SELECT * FROM phieu_bao_hanh WHERE TinhTrang!=0";               
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
        $(".suaxoapbh span").click(function(){
            var mapbh=$(this).attr('p');
            var tinhtrang=$(this).attr('p1');
            if (tinhtrang==1){
                alert("Phiếu bảo hành còn thời hạn không thể xóa");
                return false;
            }
            else{
                if (confirm('Bạn có chắc muốn xóa')){
                    $.post("./xulypbh.php",{kieu:'xoapbh',mapbh:mapbh},function(data){
                        if (data==1){
                            alert("Xóa thành công");
                            location.reload(); 
                        }                   
                    });
                }
            }
        });
        $(".phantrangpbh1 div").click(function(){
            var page=$(this).attr('page');
            $.post("./phantrangpbh.php",{kieu:'phantrangpbh',page:page},function(data){
                $("#hienpbh").html(data);                  
            });            
        });
    });
</script>