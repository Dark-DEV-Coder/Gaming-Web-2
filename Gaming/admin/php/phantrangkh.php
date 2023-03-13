<?php
    require_once("./KetnoiCSDL.php");
    require_once("./xulydulieu.php");
    $p=new CheckConnection();
    $p1=new Xuly();
    if (isset($_POST['kieu'])){
        $kieu=$_POST['kieu'];
        if ($kieu=="phantrangkh"){
            $page=$_POST['page'];    
            $tu=($page-1)*5;  
            $sql="SELECT * FROM khach_hang WHERE TinhTrang!=0 LIMIT $tu,5";                                               
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
            $sql="SELECT * FROM khach_hang WHERE TinhTrang!=0";               
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
        $(".suaxoakh span").click(function(){
            var makh=$(this).attr('p');
            //alert(mankh);
            if (confirm('Bạn có chắc muốn xóa')){
                $.post("./xulykh.php",{kieu:'xoakh',makh:makh},function(data){
                    alert(data);
                    if (data==1){
                        alert("Xóa thành công");
                        location.reload(); 
                    }                   
                });
            }
        });
        $("#chonkieutimkiemnkh").change(function(){
            var kieunsx=$("#chonkieutimkiemnsx").val();
            $.post("./xulynsx.php",{kieu:'timkiemnsx',kieunsx:kieunsx},function(data){
                $("#kieutimkiemnsx").html(data);
            });
        });
        $(".phantrangkh1 div").click(function(){
            var page=$(this).attr('page');
            $.post("./phantrangkh.php",{kieu:'phantrangkh',page:page},function(data){
                $("#hienkh").html(data);                  
            });            
        });
    });
</script>