<?php
    require_once("./KetnoiCSDL.php");
    require_once("./xulydulieu.php");
    $p=new CheckConnection();
    $p1=new Xuly();
    if (isset($_POST['kieu'])){
        $kieu=$_POST['kieu'];
        if ($kieu=="phantrangkm"){
            $page=$_POST['page'];    
            $tu=($page-1)*5;  
            $sql="SELECT * FROM khuyen_mai WHERE TinhTrang!=0 LIMIT $tu,5";                                               
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
            $sql="SELECT * FROM khuyen_mai WHERE TinhTrang!=0";           
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
        $("#chonkieutimkiempnh").change(function(){
            var kieutk=$(this).val();            
            $.post("./xulypnh.php",{kieu:'timkiempnh',kieutk:kieutk},function(data){
                $("#kieutimkiempnh").html(data);
            });
        });
        $(".phantrangkm1 div").click(function(){
            var page=$(this).attr('page');            
            $.post("./phantrangkm.php",{kieu:'phantrangkm',page:page},function(data){
                $("#hienkm").html(data);
            });
        });
    });
</script>