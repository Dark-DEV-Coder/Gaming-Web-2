<link rel="stylesheet" href="../css/hoadon2.css">
<div class="container hd">
    <div class="row tieudehd">
        <div class="col-md-12">Hóa đơn</div>
    </div>
    <div class="row timkiemhd">
        <div class="col-md-4 col-sm-4">
            <select class="form-select form-select-lg mb-3" id="chonkieutimkiemhd">
                <option value="0" selected>Chọn kiểu tìm kiếm</option>
                <option value="1">Tìm kiếm theo mã nhân viên</option>
                <option value="2">Tìm kiếm theo họ tên khách hàng</option>
                <option value="3">Tìm kiếm theo thời gian</option>
                <option value="4">Tìm kiếm theo tình trạng</option>
            </select>
        </div>
        <div class="col-md-2 col-sm-2">
            <input class="btn btn-info btn-lg" type="button" value="Tìm kiếm" id="nuttimkiemhd" />
        </div>  
        <div class="col-md-3 col-sm-3"></div>    
        <div class="col-md-3 col-sm-3">
            <a href='./quanly.php?xuly=thongkehd'><input class="btn btn-info btn-lg" type="button" value="Thống kê hóa đơn" id="thongkehd" /></a>
        </div>         
    </div>
    <div id="kieutimkiemhd">
           
    </div>    
    <div id="hienhd">   
        <div class="row">
            <table class="table table-bordered banghd">
                <thead>
                    <tr>
                        <th class="tbhd1">Mã hóa đơn</th>
                        <th class="tbhd2">Họ tên khách hàng</th>
                        <th class="tbhd3">Ngày lập hóa đơn</th>
                        <th class="tbhd4">Tổng tiền thanh toán</th>
                        <th class="tbhd5">Tình trạng</th>
                        <th class="tbhd6">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once("./KetnoiCSDL.php");
                        require_once("./xulydulieu.php");
                        $p=new CheckConnection();
                        $p1=new Xuly();
                        $sql="SELECT * FROM hoa_don WHERE TinhTrang!=0 LIMIT 0,5";
                        $rs=$p->ExcuteQuery($sql);
                        $s="";
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
                                            <a href='./quanly.php?xuly=suahd&id=$r[0]' class='suahd' id='suahd1'><i class='bx bx-edit'></i></a>
                                            <span p='$r[0]' p1='$r[12]'><a href='#' class='xoahd'><i class='bx bx-trash' ></i></a></span>
                                        </td>  
                                    </tr>";
                        }
                        echo $s;
                    ?>                    
                </tbody>
            </table>            
        </div> 
        <div class="row phantranghd">
            <div class="col-md-12 col-sm-12 phantranghd1">  
                <?php
                    $p=new CheckConnection();
                    $sql="SELECT * FROM hoa_don WHERE TinhTrang!=0";
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
        $(".suaxoahd span").click(function(){
            var mahd=$(this).attr('p');
            var tt=$(this).attr('p1');
            if (tt==4){
                alert("Hóa đơn đã thanh toán không được xóa");
                return false;
            }
            if (confirm("Bạn có chắc muốn xóa")){
                $.post("./xulyhoadon.php",{kieu:'xoahd',mahd:mahd},function(data){
                    if (data==1){
                        alert("Xóa thành công");
                        location.reload();
                    }
                });
            }
        });
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
        $("#nuttimkiemhd").click(function(){
            var kieutk=$("#chonkieutimkiemhd").val();
            if (kieutk==0){
                alert("Chưa chọn kiểu tìm kiếm");
                return false;
            }
            if (kieutk==1){
                var manv=$("#manvhdtimkiem").val();
                if (manv==""){
                    alert("Chưa nhập nhân viên cần tìm");
                    $("#manvhdtimkiem").focus();
                    return false;
                }
                $.post("./timkiemhd.php",{kieu:'kieu1',manv:manv},function(data){
                    $("#hienhd").html(data);
                })
            }
            if (kieutk==2){
                var tenkh=$("#tenkhhdtimkiem").val();
                if (tenkh==""){
                    alert("Chưa nhập họ tên khách hàng cần tìm");
                    $("#tenkhhdtimkiem").focus();
                    return false;
                }
                $.post("./timkiemhd.php",{kieu:'kieu2',tenkh:tenkh},function(data){
                    $("#hienhd").html(data);
                })
            }
            if (kieutk==3){
                var tungay=$("#tungayhdtimkiem").val();
                var denngay=$("#denngayhdtimkiem").val();
                if (tungay==""){
                    alert("Chưa chọn thời gian cần tìm");
                    $("#tungayhdtimkiem").focus();
                    return false;
                }
                if (denngay==""){
                    alert("Chưa chọn thời gian cần tìm");
                    $("#denngayhdtimkiem").focus();
                    return false;
                }
                if (tungay>denngay){
                    alert("Khoảng thòi gian không hợp lệ");
                    return false;
                }
                $.post("./timkiemhd.php",{kieu:'kieu3',tungay:tungay,denngay:denngay},function(data){               
                    $("#hienhd").html(data);
                })
            } 
            if (kieutk==4){
                var tinhtrang=$("#tinhtranghdtimkiem").val();
                if (tinhtrang==0){
                    alert("Chưa chọn tình trạng cần tìm");
                    $("#tinhtranghdtimkiem").focus();
                    return false;
                }
                $.post("./timkiemhd.php",{kieu:'kieu4',tinhtrang:tinhtrang},function(data){
                    $("#hienhd").html(data);
                })
            }     
        });
    });
</script>