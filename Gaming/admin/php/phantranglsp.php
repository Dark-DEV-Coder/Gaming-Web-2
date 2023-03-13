<?php
    require_once("./KetnoiCSDL.php");
    $p=new CheckConnection();
    if (isset($_POST['kieu'])){
        $kieu=$_POST['kieu'];
        if ($kieu=="phantranglsp"){
            $page=$_POST['page'];    
            $tu=($page-1)*5;  
            $sql="SELECT * FROM loai_sp WHERE TinhTrang!=0 LIMIT $tu,5";                                               
            $s="<div class='row'>
                    <table class='table table-bordered banglsp'>
                        <thead>
                            <tr>
                                <th class='tblsp1'>Mã loại</th>
                                <th class='tblsp2'>Tên loại</th>                       
                                <th class='tblsp3'>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>";
            $rs=$p->ExcuteQuery($sql);
            while($r=mysqli_fetch_array($rs)){                           
                $s=$s."<tr>
                            <td class='lsp1'>$r[0]</td>
                            <td class='lsp1'>$r[1]</td>
                            <td class='suaxoalsp'>
                                <a href='./quanly.php?xuly=sualsp&id=$r[0]' p='$r[0]' class='sualsp'><i class='bx bx-edit'></i></a>
                                <span p='$r[0]'><a href='#' class='xoalsp'><i class='bx bx-trash' ></i></a></span>
                            </td> 
                        </tr>";
            }
            $s=$s."</tbody>
                    </table>            
                </div> 
                <div class='row phantranglsp'>
                    <div class='col-md-12 col-sm-12 phantranglsp1'>";  
            $sql="SELECT * FROM loai_sp WHERE TinhTrang!=0";               
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
        $(".suaxoalsp span").click(function(){
            var malsp=$(this).attr('p');
            if (confirm('Bạn có chắc muốn xóa')){
                $.post("./xulyloaisp.php",{kieu:'xoalsp',malsp:malsp},function(data){
                    if (data==1){
                        alert("Xóa thành công");
                        location.reload(); 
                    }                   
                });
            }
        });
        $(".phantranglsp1 div").click(function(){
            var page=$(this).attr('page');
            $.post("./phantranglsp.php",{kieu:'phantranglsp',page:page},function(data){
                $("#hienlsp").html(data);                  
            });            
        });
    });
</script>