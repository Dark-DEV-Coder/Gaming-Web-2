<?php
    require_once("./KetnoiCSDL.php");
    require_once("./xulydulieu.php");
    $p=new CheckConnection();
    $p1=new Xuly();
    if (isset($_POST['kieu'])){
        $kieu=$_POST['kieu'];
        if ($kieu=="phantrangnv"){
            $page=$_POST['page'];    
            $tu=($page-1)*5;  
            $sql="SELECT * FROM nhan_vien WHERE TinhTrang!=0 LIMIT $tu,5";                                               
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
            $rs=$p->ExcuteQuery($sql);
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
            $sql="SELECT * FROM nhan_vien WHERE TinhTrang!=0";               
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
        $(".suaxoanv span").click(function(){
            var manv=$(this).attr('p');
            //alert(mankh);
            if (confirm('Bạn có chắc muốn xóa')){
                $.post("./xulynhanvien.php",{kieu:'xoanv',manv:manv},function(data){
                    alert(data);
                    if (data==1){
                        alert("Xóa thành công");
                        location.reload(); 
                    }                   
                });
            }
        });
        $(".phantrangnv1 div").click(function(){
            var page=$(this).attr('page');
            $.post("./phantrangnhanvien.php",{kieu:'phantrangnv',page:page},function(data){
                $("#hiennv").html(data);                  
            });            
        });
        $("#chonkieutimkiemnkh").change(function(){
            var kieunsx=$("#chonkieutimkiemnsx").val();
            $.post("./xulynsx.php",{kieu:'timkiemnsx',kieunsx:kieunsx},function(data){
                $("#kieutimkiemnsx").html(data);
            });
        });
    });
</script>