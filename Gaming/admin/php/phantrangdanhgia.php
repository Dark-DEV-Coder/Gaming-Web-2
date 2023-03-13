<?php
    require_once("./KetnoiCSDL.php");
    require_once("./xulydulieu.php");
    $p=new CheckConnection();
    $p1=new Xuly();
    if (isset($_POST['kieu'])){
        $kieu=$_POST['kieu'];
        if ($kieu=="phantrangdg"){
            $page=$_POST['page'];    
            $tu=($page-1)*5;  
            $sql="SELECT dg.MaBinhLuan,tk.Username,dg.MaNhomSP,dg.DanhGia 
            FROM danh_gia_sp as dg,tai_khoan as tk 
            WHERE tk.MaTK=dg.MaTK AND dg.TinhTrang!=0 LIMIT $tu,5";                                               
            $s="<div class='row'>
                    <table class='table table-bordered bangdg'>
                        <thead>
                            <tr>
                                <th class='tbdg1'>Mã bình luận</th>
                                <th class='tbdg2'>Tên tài khoản</th>
                                <th class='tbdg3'>Mã nhóm sản phẩm</th>
                                <th class='tbdg4'>Số sao đánh giá</th>
                                <th class='tbdg5'>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>";
            $rs=$p->ExcuteQuery($sql);
            while($r=mysqli_fetch_array($rs)){                           
                $s=$s."<tr>
                            <td class='dg1'>$r[0]</td>      
                            <td>$r[1]</td>                                  
                            <td class='dg1'>$r[2]</td>
                            <td class='dg1'>$r[3]</td>
                            <td class='suaxoadg'>
                                <a href='./quanly.php?xuly=xemdg&id=$r[0]' class='xemdg'><i class='bx bx-detail'></i></i></a>                                            
                                <span p='$r[0]'><a href='#' class='xoadg'><i class='bx bx-trash' ></i></a></span>
                            </td>  
                        </tr>";
            }
            $s=$s."</tbody>
                    </table>            
                </div> 
                <div class='row phantrangdg'>
                    <div class='col-md-12 col-sm-12 phantrangdg1'>";  
            $sql="SELECT dg.MaBinhLuan,tk.Username,dg.MaNhomSP,dg.DanhGia 
            FROM danh_gia_sp as dg,tai_khoan as tk 
            WHERE tk.MaTK=dg.MaTK AND dg.TinhTrang!=0";               
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
        $(".suaxoadg span").click(function(){
            var madg=$(this).attr('p');
            if (confirm('Bạn có chắc muốn xóa')){
                $.post("./xulydanhgia.php",{kieu:'xoadg',madg:madg},function(data){
                    if (data==1){
                        alert("Xóa thành công");
                        location.reload(); 
                    }                   
                });
            }
        });
        $("#chonkieutimkiemdg").change(function(){
            var kieutk=$(this).val();
            $.post("./xulydanhgia.php",{kieu:'timkiemdg',kieutk:kieutk},function(data){
                $("#kieutimkiemdg").html(data);
            });
        });
        $(".phantrangdg1 div").click(function(){
            var page=$(this).attr('page');            
            $.post("./phantrangdanhgia.php",{kieu:'phantrangdg',page:page},function(data){
                $("#hiendg").html(data);
            });
        });
    });
</script>