<?php
    require_once("./xulydulieu.php");
    $p=new CheckConnection();
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $ngayht=date('Y-m-d');
    $sql="UPDATE `phieu_bao_hanh` SET `TinhTrang`=2 WHERE `DenNgay`<'$ngayht'";
    $p->ExcuteQuery($sql);
    $sql1="UPDATE `phieu_bao_hanh` SET `TinhTrang`=1 WHERE `DenNgay`>='$ngayht' AND `TuNgay`<='$ngayht'";
    $p->ExcuteQuery($sql1);
?>
<link rel="stylesheet" href="../css/phieubaohanh1.css"> 
<div class="container pbh">
    <div class="row tieudepbh">
        <div class="col-md-12">Phiếu bảo hành</div>
    </div>
    <div class="row timkiempbh">
        <div class="col-md-4 col-sm-4">
            <select class="form-select form-select-lg mb-3" id="chonkieutimkiempbh">
                <option value="0" selected>Chọn kiểu tìm kiếm</option>
                <option value="1">Tìm kiếm theo riêng mã sản phẩm</option>
                <option value="2">Tìm kiếm theo thời gian</option>
                <option value="3">Tìm kiếm theo tình trạng</option>
            </select>
        </div>
        <div class="col-md-2 col-sm-2">
            <input class="btn btn-info btn-lg" type="button" value="Tìm kiếm" id="nuttimkiempbh" />
        </div>        
    </div>
    <div id="kieutimkiempbh">
                    
        
    </div>    
    <div id="hienpbh">   
        <div class="row">
            <table class="table table-bordered bangpbh">
                <thead>
                    <tr>
                        <th class="tbpbh1">Mã PBH</th>
                        <th class="tbpbh2">Mã sản phẩm</th>
                        <th class="tbpbh3">Từ ngày</th>
                        <th class="tbpbh4">Đến ngày</th>
                        <th class="tbpbh5">Tình trạng</th>
                        <th class="tbpbh6">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once("./KetnoiCSDL.php");
                        require_once("./xulydulieu.php");
                        $p=new CheckConnection();
                        $p1=new Xuly();                    
                        $sql="SELECT * FROM phieu_bao_hanh WHERE TinhTrang!=0 LIMIT 0,5";
                        $rs=$p->ExcuteQuery($sql);
                        $s="";
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
                        echo $s;
                    ?>                    
                </tbody>
            </table>            
        </div> 
        <div class="row phantrangpbh">
            <div class="col-md-12 col-sm-12 phantrangpbh1">  
                <?php
                    $p=new CheckConnection();
                    $sql="SELECT * FROM phieu_bao_hanh WHERE TinhTrang!=0";
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
        $("#chonkieutimkiempbh").change(function(){
            var kieutk=$(this).val();
            $.post("./xulypbh.php",{kieu:'kieutimkiem',kieutk:kieutk},function(data){
                $("#kieutimkiempbh").html(data);
            });
        });
        $("#nuttimkiempbh").click(function(){
            var kieutk=$("#chonkieutimkiempbh").val();
            if (kieutk==0){
                alert("Chưa chọn kiểu tìm kiếm");
                return false;
            }
            if (kieutk==1){
                var masp=$("#masppbhtimkiem").val();
                if (masp==""){
                    alert("Chưa nhập mã sản phẩm cần tìm");
                    $("#masppbhtimkiem").focus();
                    return false;
                }
                $.post("./timkiempbh.php",{kieu:'kieu1',masp:masp},function(data){
                    $("#hienpbh").html(data);
                })
            }
            if (kieutk==2){
                var tungay=$("#tungaypbhtimkiem").val();
                var denngay=$("#denngaypbhtimkiem").val();
                if (tungay==""){
                    alert("Chưa chọn thời gian cần tìm");
                    $("#tungaypbhtimkiem").focus();
                    return false;
                }
                if (denngay==""){
                    alert("Chưa chọn thời gian cần tìm");
                    $("#denngaypbhtimkiem").focus();
                    return false;
                }
                if (tungay>denngay){
                    alert("Khoảng thòi gian không hợp lệ");
                    return false;
                }
                $.post("./timkiempbh.php",{kieu:'kieu2',tungay:tungay,denngay:denngay},function(data){                    
                    $("#hienpbh").html(data);
                })
            }
            if (kieutk==3){
                var tinhtrang=$("#tinhtrangpbhtimkiem").val();
                if (tinhtrang==0){
                    alert("Chưa chọn tình trạng cần tìm");
                    $("#tinhtrangpbhtimkiem").focus();
                    return false;
                }
                $.post("./timkiempbh.php",{kieu:'kieu3',tinhtrang:tinhtrang},function(data){
                    $("#hienpbh").html(data);
                })
            }
        });
    })
</script>