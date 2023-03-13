<link rel="stylesheet" href="../css/khachhang1.css">
<div class="container kh">
    <div class="row tieudekh">
        <div class="col-md-12">Khách hàng</div>
    </div>
    <div class="row timkiemkh">
        <div class="col-md-4 col-sm-4">
            <select class="form-select form-select-lg mb-3" id="chonkieutimkiemkh">
                <option value="0" selected>Chọn kiểu tìm kiếm</option>
                <option value="1">Tìm kiếm theo họ tên</option>
                <option value="2">Tìm kiếm theo giới tính</option>
                <option value="3">Tìm kiếm theo số điện thoại</option>
                <option value="4">Tìm kiếm theo ngày sinh</option>
            </select>
        </div>
        <div class="col-md-2 col-sm-2">
            <input class="btn btn-info btn-lg" type="button" value="Tìm kiếm" id="nuttimkiemkh" />
        </div>
        <div class="col-md-3 col-sm-3"></div>
        <div class="col-md-3 col-sm-3">
            <button type="button" class="btn btn-info" id="themkh">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
                <a href="./quanly.php?xuly=themkh">Thêm khách hàng</a>
            </button>
        </div>
    </div>
    <div id="kieutimkiemkh">
        <!-- <div class="row timkiemtheohoten">
            <div class="col-md-2 col-sm-2 div1">Họ tên:</div>
            <div class="col-md-4 col-sm-4">
                <input class="form-control" type="text" id="hotenkhtimkiem" placeholder="Nhập họ tên khách hàng cần tìm"  />
            </div>
        </div> 
        <div class="row timkiemtheosdt">
            <div class="col-md-2 col-sm-2 div1">Số điện thoại:</div>
            <div class="col-md-4 col-sm-4">
                <input class="form-control" type="text" id="sdtkhtimkiem" placeholder="Nhập số điện thoại cần tìm"  />
            </div>
        </div> 
        <div class="row timkiemtheogioitinh">
            <div class="col-md-2 col-sm-2 div1">Giới tính:</div>
            <div class="col-md-4 col-sm-4">
                <select class="form-select" id="gioitinhkhtimkiem">
                    <option value="-1" selected>Chọn giới tính cần tìm</option>
                    <option value="0" selected>Nam</option>
                    <option value="1" selected>Nữ</option>
                </select>
            </div>
        </div> -->
        <!-- <div class="row timkiemtheongaysinh">
            <div class="col-md-2 col-sm-2 div1">Ngày sinh:</div>
            <div class="col-md-4 col-sm-4">
                <input class="form-control" type="date" id="tungaysinhkhtimkiem" />
            </div>
            <div class="col-md-1 col-sm-2 div1">-</div>
            <div class="col-md-4 col-sm-4">
                <input class="form-control" type="date" id="denngaysinhkhtimkiem" />
            </div>
        </div> -->
        
    </div>    
    <div id="hienkh">   
        <div class="row">
            <table class="table table-bordered bangkh">
                <thead>
                    <tr>
                        <th class="tbkh1">Họ tên</th>
                        <th class="tbkh2">Ngày sinh</th>
                        <th class="tbkh3">Giới tính</th>
                        <th class="tbkh4">Số điện thoại</th>
                        <th class="tbkh5">Email</th>
                        <th class="tbkh6">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once("./KetnoiCSDL.php");
                        require_once("./xulydulieu.php");
                        $p=new CheckConnection();
                        $p1=new Xuly();
                        $sql="SELECT * FROM khach_hang WHERE TinhTrang!=0 LIMIT 0,5";
                        $rs=$p->ExcuteQuery($sql);
                        $s="";
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
                        echo $s;
                    ?>                    
                </tbody>
            </table>            
        </div> 
        <div class="row phantrangkh">
            <div class="col-md-12 col-sm-12 phantrangkh1">  
                <?php
                    $p=new CheckConnection();
                    $sql="SELECT * FROM khach_hang WHERE TinhTrang!=0";
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
var sdt1=/^0[0-9]{1,9}$/;
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
    $(".phantrangkh1 div").click(function(){
        var page=$(this).attr('page');
        $.post("./phantrangkh.php",{kieu:'phantrangkh',page:page},function(data){
            $("#hienkh").html(data);                  
        });            
    });
    $("#chonkieutimkiemkh").change(function(){
        var kieukh=$("#chonkieutimkiemkh").val();
        //alert(kieukh);
        $.post("./xulykh.php",{kieu:'timkiemkh',kieutk:kieukh},function(data){
            $("#kieutimkiemkh").html(data);
        });
    });
    $("#nuttimkiemkh").click(function(){
        var kieukh=$("#chonkieutimkiemkh").val();
        if (kieukh==0){
            alert("Chưa chọn kiểu tìm kiếm");
            return false;
        }
        if (kieukh==1){
            var hotenkh=$("#hotenkhtimkiem").val();
            if (hotenkh==""){
                alert("Chưa nhập họ tên khách hàng cần tìm");
                $("#hotenkhtimkiem").focus();
                return false;
            }
            $.post("./timkiemkh.php",{kieu:'kieu1',hotenkh:hotenkh},function(data){
                $("#hienkh").html(data);                  
            });
        }
        if (kieukh==2){
            var gtkh=$("#gioitinhkhtimkiem").val();
            //alert(gtkh);
            if (gtkh==-1){
                alert("Chưa chọn giới tính khách hàng cần tìm");
                $("#gioitinhkhtimkiem").focus();
                return false;
            }
            $.post("./timkiemkh.php",{kieu:'kieu2',gtkh:gtkh},function(data){
                $("#hienkh").html(data);                  
            });
        }
        if (kieukh==3){
            var sdt=$("#sdtkhtimkiem").val();
            //alert(sdt);
            if (sdt==""){
                alert("Chưa nhập số điện thoại cần tìm");
                $("#sdtkhtimkiem").focus();
                return false;
            }
            $.post("./timkiemkh.php",{kieu:'kieu3',sdt:sdt},function(data){
                $("#hienkh").html(data);                  
            });
        }
        if (kieukh==4){
            var ngaytu=$("#tungaysinhkhtimkiem").val();
            var ngayden=$("#denngaysinhkhtimkiem").val();
            if (ngaytu==""){
                alert("Chưa nhập ngày sinh từ cần tìm");
                $("#tungaysinhkhtimkiem").focus();
                return false;
            }
            if(ngayden==""){
                alert("Chưa nhập ngày sinh đến cần tìm");
                $("#denngaysinhkhtimkiem").focus();
                return false;
            }
            $.post("./timkiemkh.php",{kieu:'kieu4',ngaytu:ngaytu,ngayden:ngayden},function(data){
                $("#hienkh").html(data);                  
            });
        }
    });
});
</script>