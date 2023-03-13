<?php
    require_once("./KetnoiCSDL.php");
    $p=new CheckConnection();
    if (isset($_POST['kieu'])){
        $kieu=$_POST['kieu'];
        if ($kieu=="phantrangnsx"){
            $page=$_POST['page'];    
            $tu=($page-1)*5;  
            $sql="SELECT * FROM nha_san_xuat WHERE TinhTrang!=0 LIMIT $tu,5";                                               
            $s="<div class='row'>
                    <table class='table table-bordered bangnsx'>
                        <thead>
                            <tr>
                                <th class='tbnsx1'>Mã nhà sản xuất</th>
                                <th class='tbnsx2'>Tên nhà sản xuất</th>
                                <th class='tbnsx3'>Số điện thoại</th>
                                <th class='tbnsx4'>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>";
            $rs=$p->ExcuteQuery($sql);
            while($r=mysqli_fetch_array($rs)){                           
                $s=$s."<tr>
                            <td class='nsx1'>$r[0]</td>
                            <td>$r[1]</td>
                            <td class='nsx1'>$r[2]</td>
                            <td class='suaxoansx'>
                                <a href='./quanly.php?xuly=xemnsx&id=$r[0]'><i class='bx bx-detail'></i></i></a>
                                <a href='./quanly.php?xuly=suansx&id=$r[0]'><i class='bx bx-edit'></i></a>
                                <span p='$r[0]'><a href='#'><i class='bx bx-trash' ></i></a></span>
                            </td>  
                        </tr>";
            }
            $s=$s."</tbody>
                    </table>            
                </div> 
                <div class='row phantrangnsx'>
                    <div class='col-md-12 col-sm-12 phantrangnsx1'>";  
            $sql="SELECT * FROM nha_san_xuat WHERE TinhTrang!=0";               
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
        $("#chonkieutimkiemnsx").change(function(){
            var kieunsx=$("#chonkieutimkiemnsx").val();
            $.post("./xulynsx.php",{kieu:'timkiemnsx',kieunsx:kieunsx},function(data){
                $("#kieutimkiemnsx").html(data);
            });
        });
        $(".phantrangnsx1 div").click(function(){
            var page=$(this).attr('page');
            $.post("./phantrangnsx.php",{kieu:'phantrangnsx',page:page},function(data){
                $("#hiennsx").html(data);                  
            });            
        });
    });
</script>