<?php
    require_once("./KetnoiCSDL.php");
    require_once("./xulydulieu.php");
    $p=new CheckConnection();
    $p1=new Xuly();
    if (isset($_POST['kieu'])){
        $kieu=$_POST['kieu'];
        if ($kieu=="phantranghd"){
            $page=$_POST['page'];    
            $tu=($page-1)*5;  
            $sql="SELECT * FROM hoa_don WHERE TinhTrang!=0 LIMIT $tu,5";                                               
            $s="<div class='row'>
                    <table class='table table-bordered banghd'>
                        <thead>
                            <tr>
                                <th class='tbhd1'>Mã hóa đơn</th>
                                <th class='tbhd2'>Họ tên khách hàng</th>
                                <th class='tbhd3'>Ngày lập hóa đơn</th>
                                <th class='tbhd4'>Tổng tiền thanh toán</th>
                                <th class='tbhd5'>Tình trạng</th>
                                <th class='tbhd6'>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>";
            $rs=$p->ExcuteQuery($sql);
            while($r=mysqli_fetch_array($rs)){                           
                $tenkh=$r[3]." ".$r[4];
                $ngay=$p1->Chuyenngaythuan($r[8]);
                $tien=$p1->Chuyentien($r[11]);
                if ($r[12]==1)
                    $s1="<td class='hd1' style='color:red;font-weight:600;'>Đang chờ xác nhận</td>";
                if ($r[12]==2)
                    $s1="<td class='hd1' style='color:rgb(250, 155, 12);font-weight:600;'>Đã xác nhận</td>";
                if ($r[12]==3)
                    $s1="<td class='hd1' style='color:#c2d32f;font-weight:600;'>Đang giao</td>";
                if ($r[12]==4)
                    $s1="<td class='hd1' style='color:rgb(22, 184, 22);font-weight:600;'>Hoàn thành</td>";
                $s=$s."<tr>
                            <td class='hd1'>$r[0]</td>      
                            <td>$tenkh</td>                                  
                            <td class='hd1'>$ngay</td>
                            <td class='hd1'>$tien</td>"
                            .$s1."
                            <td class='suaxoahd'>
                                <a href='./quanly.php?xuly=xemhd&id=$r[0]' class='xemhd'><i class='bx bx-detail'></i></i></a>
                                <a href='./quanly.php?xuly=suahd&id=$r[0]' class='suahd'><i class='bx bx-edit'></i></a>
                                <span p='$r[0]'><a href='#' class='xoahd'><i class='bx bx-trash' ></i></a></span>
                            </td>  
                        </tr>";
            }
            $s=$s."</tbody>
                    </table>            
                </div> 
                <div class='row phantranghd'>
                    <div class='col-md-12 col-sm-12 phantranghd1'>";  
            $sql="SELECT * FROM hoa_don WHERE TinhTrang!=0";               
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
        // $(".suaxoahd span").click(function(){
        //     var mahd=$(this).attr('p');
        //     if (confirm("Bạn có chắc muốn xóa")){
        //         $.post("./xulyhd.php",{kieu:'xoahd',mahd:mahd},function(data){
        //             if (data==1){
        //                 alert("Xóa thành công");
        //                 location.reload();
        //             }
        //         });
        //     }
        // });
        $("#chonkieutimkiemhd").change(function(){
            var kieutk=$(this).val();            
            $.post("./xulyhoadon.php",{kieu:'timkiemhd',kieutk:kieutk},function(data){
                $("#kieutimkiemhd").html(data);
            });
        });
        $(".phantranghd1 div").click(function(){
            var page=$(this).attr('page');            
            $.post("./phantranghd.php",{kieu:'phantranghd',page:page},function(data){
                $("#hienhd").html(data);
            });
        });
    });
</script>