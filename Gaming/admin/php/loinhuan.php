<link rel="stylesheet" href="../css/loinhuan1.css">  
<div class="container ln">
    <div class="row tieudeln">
        <div class="col-md-12">Lợi nhuận</div>
    </div>    
    <div class="row timkiemln">                
        <div class="col-md-9 col-sm-9"></div>
        <div class="col-md-3 col-sm-3">
            
        </div>
    </div>
    <div id="kieutimkiemln">
        <div class="row timkiemtheomaspln">
            <div class="col-md-2 col-sm-2 div1">Mã sản phẩm:</div>
            <div class="col-md-4 col-sm-4">
                <input class="form-control" type="text" id="masplntimkiem" placeholder="Nhập mã sản phẩm cần tìm"  />
            </div>
            <div class="col-md-2 col-sm-2">
                <input class="btn btn-info" type="button" value="Tìm kiếm" id="nuttimkiemln" />
            </div>
        </div>             
    </div>    
    <div id="hienln">   
        <div class="row">
            <table class="table table-bordered bangln">
                <thead>
                    <tr>
                        <th class="tbln1">Mã lợi nhuận</th>
                        <th class="tbln2">Mã nhóm sản phẩm</th>                       
                        <th class="tbln3">% lợi nhuận</th>
                        <th class="tbln4">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once("./KetnoiCSDL.php");
                        require_once("./xulydulieu.php");
                        $p=new CheckConnection();
                        $p1=new Xuly();
                        $sql="SELECT * FROM loi_nhuan WHERE TinhTrang!=0 LIMIT 0,5";
                        $rs=$p->ExcuteQuery($sql);
                        $s="";
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
                        echo $s;
                    ?>                    
                </tbody>
            </table>            
        </div> 
        <div class="row phantrangln">
            <div class="col-md-12 col-sm-12 phantrangln1">  
                <?php
                    $p=new CheckConnection();
                    $sql="SELECT * FROM loi_nhuan WHERE TinhTrang!=0";
                    $rs=$p->ExcuteQuery($sql);
                    $page=0;
                    $s="";
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
                                        $s=$s."<div style='background-color:#0d6efd' page='$i>$i</div>";
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
                    echo $s;
                ?>              
                
            </div>
        </div>                             
    </div>
</div>
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