<link rel="stylesheet" href="../css/phieunhaphang1.css">
<div class="container pnh">
    <div class="row tieudepnh">
        <div class="col-md-12">Phiếu nhập hàng</div>
    </div>
    <div class="row timkiempnh">
        <div class="col-md-4 col-sm-4">
            <select class="form-select form-select-lg mb-3" id="chonkieutimkiempnh">
                <option value="0" selected>Chọn kiểu tìm kiếm</option>
                <option value="1">Tìm kiếm theo mã nhân viên</option>
                <option value="2">Tìm kiếm theo nhà sản xuất</option>
                <option value="3">Tìm kiếm theo thời gian nhập hàng</option>
            </select>
        </div>
        <div class="col-md-2 col-sm-2">
            <input class="btn btn-info btn-lg" type="button" value="Tìm kiếm" id="nuttimkiempnh" />
        </div>  
        <div class="col-md-3 col-sm-3"></div>
        <div class="col-md-3 col-sm-3">
            <button type="button" class="btn btn-info" id="thempnh">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
                <a href="./quanly.php?xuly=thempnh">Thêm phiếu nhập</a>
            </button>
        </div>      
    </div>
    <div id="kieutimkiempnh">
        
        
        
    </div>    
    <div id="hienpnh">   
        <div class="row">
            <table class="table table-bordered bangpnh">
                <thead>
                    <tr>
                        <th class="tbpnh1">Mã NV</th>
                        <th class="tbpnh2">Nhà sản xuất</th>
                        <th class="tbpnh3">Tổng tiền</th>
                        <th class="tbpnh4">Ngày nhập</th>
                        <th class="tbpnh5">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once("./KetnoiCSDL.php");
                        require_once("./xulydulieu.php");
                        $p=new CheckConnection();
                        $p1=new Xuly();
                        $sql="SELECT pnh.MaPNH,pnh.MaNV,nsx.TenNSX,pnh.TongTien,pnh.NgayNhap 
                        FROM phieu_nhap_hang as pnh, nha_san_xuat as nsx 
                        WHERE pnh.MaNSX=nsx.MaNSX AND pnh.TinhTrang!=0 LIMIT 0,5";
                        $rs=$p->ExcuteQuery($sql);
                        $s="";
                        while($r=mysqli_fetch_array($rs)){
                            $tien=$p1->Chuyentien($r[3]);
                            $ngay=$p1->Chuyenngaythuan($r[4]);
                            $s=$s."<tr>
                                        <td class='pnh1'>$r[1]</td>
                                        <td class='pnh1'>$r[2]</td>
                                        <td class='pnh1'>$tien</td>
                                        <td class='pnh1'>$ngay</td>
                                        <td class='suaxoapnh'>
                                            <a href='./quanly.php?xuly=xempnh&id=$r[0]' class='xempnh'><i class='bx bx-detail'></i></i></a>
                                            <a href='./quanly.php?xuly=suapnh&id=$r[0]' class='suapnh'><i class='bx bx-edit'></i></a>
                                            <span p='$r[0]'><a href='#' class='xoapnh'><i class='bx bx-trash' ></i></a></span>
                                        </td>  
                                    </tr>";
                        }
                        echo $s;
                    ?>                    
                </tbody>
            </table>            
        </div> 
        <div class="row phantrangpnh">
            <div class="col-md-12 col-sm-12 phantrangpnh1">  
                <?php
                    $p=new CheckConnection();
                    $sql="SELECT pnh.MaPNH,pnh.MaNV,nsx.TenNSX,pnh.TongTien,pnh.NgayNhap 
                    FROM phieu_nhap_hang as pnh, nha_san_xuat as nsx 
                    WHERE pnh.MaNSX=nsx.MaNSX AND pnh.TinhTrang!=0";
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
        $(".suaxoapnh span").click(function(){
            var mapnh=$(this).attr('p');
            if (confirm("Bạn có chắc muốn xóa")){
                $.post("./xulypnh.php",{kieu:'xoapnh',mapnh:mapnh},function(data){
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
        $(".phantrangpnh1 div").click(function(){
            var page=$(this).attr('page');            
            $.post("./phantrangpnh.php",{kieu:'phantrangpnh',page:page},function(data){
                $("#hienpnh").html(data);
            });
        });
        $("#nuttimkiempnh").click(function(){
            var kieutk=$("#chonkieutimkiempnh").val();
            if (kieutk==0){
                alert("Chưa chọn kiểu tìm kiếm");
                return false;
            }
            if (kieutk==1){
                var manv=$("#manvpnhtimkiem").val();
                if (manv==""){
                    alert("Chưa nhập nhân viên cần tìm");
                    $("#manvpnhtimkiem").focus();
                    return false;
                }
                $.post("./timkiempnh.php",{kieu:'kieu1',manv:manv},function(data){
                    $("#hienpnh").html(data);
                })
            }
            if (kieutk==2){
                var mansx=$("#nsxpnhtimkiem").val();
                if (mansx==0){
                    alert("Chưa chọn nhà sản xuất cần tìm");
                    $("#nsxpnhtimkiem").focus();
                    return false;
                }
                $.post("./timkiempnh.php",{kieu:'kieu2',mansx:mansx},function(data){
                    $("#hienpnh").html(data);
                })
            }
            if (kieutk==3){
                var tungay=$("#tungaypnhtimkiem").val();
                var denngay=$("#denngaypnhtimkiem").val();
                if (tungay==""){
                    alert("Chưa chọn thời gian cần tìm");
                    $("#tungaypnhtimkiem").focus();
                    return false;
                }
                if (denngay==""){
                    alert("Chưa chọn thời gian cần tìm");
                    $("#denngaypnhtimkiem").focus();
                    return false;
                }
                if (tungay>denngay){
                    alert("Khoảng thòi gian không hợp lệ");
                    return false;
                }
                $.post("./timkiempnh.php",{kieu:'kieu3',tungay:tungay,denngay:denngay},function(data){      
                    console.log(data);              
                    $("#hienpnh").html(data);
                })
            }      
        });
    });
</script>