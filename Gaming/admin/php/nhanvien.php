<link rel="stylesheet" href="../css/nhanvien1.css">
<div class="container nv">
    <div class="row tieudenv">
        <div class="col-md-12">Nhân viên</div>
    </div>
    <div class="row timkiemnv">
        <div class="col-md-4 col-sm-4">
            <select class="form-select form-select-lg mb-3" id="chonkieutimkiemnv">
                <option value="0" selected>Chọn kiểu tìm kiếm</option>
                <option value="1">Tìm kiếm theo họ tên</option>
                <option value="2">Tìm kiếm theo giới tính</option>
                <option value="3">Tìm kiếm theo số điện thoại</option>
                <option value="4">Tìm kiếm theo ngày sinh</option>
            </select>
        </div>
        <div class="col-md-2 col-sm-2">
            <input class="btn btn-info btn-lg" type="button" value="Tìm kiếm" id="nuttimkiemnv" />
        </div>
        <div class="col-md-3 col-sm-3"></div>
        <div class="col-md-3 col-sm-3">
            <button type="button" class="btn btn-info" id="themnv">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
                <a href="./quanly.php?xuly=themnv">Thêm nhân viên</a>
            </button>
        </div>
    </div>
    <div id="kieutimkiemnv">
        <!-- <div class="row timkiemtheohoten">
            <div class="col-md-2 col-sm-2 div1">Họ tên:</div>
            <div class="col-md-4 col-sm-4">
                <input class="form-control" type="text" id="hotennvtimkiem" placeholder="Nhập họ tên nhân viên cần tìm"  />
            </div>
        </div> -->
        <!-- <div class="row timkiemtheosdt">
            <div class="col-md-2 col-sm-2 div1">Số điện thoại:</div>
            <div class="col-md-4 col-sm-4">
                <input class="form-control" type="text" id="sdtnvtimkiem" placeholder="Nhập số điện thoại cần tìm"  />
            </div>
        </div> -->
        <!-- <div class="row timkiemtheogioitinh">
            <div class="col-md-2 col-sm-2 div1">Giới tính:</div>
            <div class="col-md-4 col-sm-4">
                <select class="form-select" id="gioitinhnvtimkiem">
                    <option value="-1" selected>Chọn giới tính cần tìm</option>
                    <option value="0" selected>Nam</option>
                    <option value="1" selected>Nữ</option>
                </select>
            </div>
        </div> -->
        <!-- <div class="row timkiemtheongaysinh">
            <div class="col-md-2 col-sm-2 div1">Ngày sinh:</div>
            <div class="col-md-4 col-sm-4">
                <input class="form-control" type="date" id="tungaysinhnvtimkiem" />
            </div>
            <div class="col-md-1 col-sm-2 div1">-</div>
            <div class="col-md-4 col-sm-4">
                <input class="form-control" type="date" id="denngaysinhnvtimkiem" />
            </div>
        </div> -->
        
    </div>    
    <div id="hiennv">   
        <div class="row">
            <table class="table table-bordered bangnv">
                <thead>
                    <tr>
                        <th class="tbnv1">Họ tên</th>
                        <th class="tbnv2">Ngày sinh</th>
                        <th class="tbnv3">Giới tính</th>
                        <th class="tbnv4">Số điện thoại</th>
                        <th class="tbnv5">Tiền lương</th>
                        <th class="tbnv6">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once("./KetnoiCSDL.php");
                        require_once("./xulydulieu.php");
                        $p=new CheckConnection();
                        $p1=new Xuly();
                        $sql="SELECT * FROM nhan_vien WHERE TinhTrang!=0 LIMIT 0,5";
                        $rs=$p->ExcuteQuery($sql);
                        $s="";
                        while($r=mysqli_fetch_array($rs)){
                            $ten=$r[2]." ".$r[3];
                            if ($r[5]==0)
                                $gt="Nam";
                            else
                                $gt="Nữ";
                            $ngs=$p1->Chuyenngaythuan($r[4]);
                            $tien=$p1->Chuyentien($r[8]);
                            $s=$s."<tr>
                                        <td>$ten</td>
                                        <td class='nv1'>$ngs</td>
                                        <td class='nv1'>$gt</td>
                                        <td class='nv1'>$r[7]</td>
                                        <td class='nv1'>$tien</td>
                                        <td class='suaxoanv'>
                                            <a href='./quanly.php?xuly=xemnv&id=$r[0]' class='xemnv'><i class='bx bx-detail'></i></i></a>
                                            <a href='./quanly.php?xuly=suanv&id=$r[0]' class='suanv'><i class='bx bx-edit'></i></a>
                                            <span p='$r[0]'><a href='#' class='xoanv'><i class='bx bx-trash' ></i></a></span>
                                        </td>  
                                    </tr>";
                        }
                        echo $s;
                    ?>                    
                </tbody>
            </table>            
        </div> 
        <div class="row phantrangnv">
            <div class="col-md-12 col-sm-12 phantrangnv1">  
                <?php
                    $p=new CheckConnection();
                    $sql="SELECT * FROM nhan_vien WHERE TinhTrang!=0";
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
    $(".suaxoanv span").click(function(){
        var manv=$(this).attr('p');
        //alert(manv);
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
        //alert(page);
        $.post("./phantrangnhanvien.php",{kieu:'phantrangnv',page:page},function(data){
            $("#hiennv").html(data);                  
        });            
    });
    $("#chonkieutimkiemnv").change(function(){
        var kieunv=$("#chonkieutimkiemnv").val();
        //alert(kieukh);
        $.post("./xulynhanvien.php",{kieu:'timkiemnv',kieutk:kieunv},function(data){
            $("#kieutimkiemnv").html(data);
        });
    });
    $("#nuttimkiemnv").click(function(){
        var kieunv=$("#chonkieutimkiemnv").val();
        var page=$(this).attr('page');
        if (kieunv==0){
            alert("Chưa chọn kiểu tìm kiếm");
            return false;
        }
        if (kieunv==1){
            var hotennv=$("#hotennvtimkiem").val();
            if (hotennv==""){
                alert("Chưa nhập họ tên nhân viên cần tìm");
                $("#hotennvtimkiem").focus();
                return false;
            }
            $.post("./timkiemnhanvien.php",{kieu:'kieu1',hotennv:hotennv,page:page},function(data){
                $("#hiennv").html(data);                  
            });
        }
        if (kieunv==2){
            var gtnv=$("#gioitinhnvtimkiem").val();
            //alert(gtkh);
            if (gtnv==-1){
                alert("Chưa chọn giới tính nhân viên cần tìm");
                $("#gioitinhnvtimkiem").focus();
                return false;
            }
            $.post("./timkiemnhanvien.php",{kieu:'kieu2',gtnv:gtnv,page:page},function(data){
                //alert(data);
                $("#hiennv").html(data);                  
            });
        }
        if (kieunv==3){
            var sdt=$("#sdtnvtimkiem").val();
            //alert(sdt);
            if (sdt==""){
                alert("Chưa nhập số điện thoại cần tìm");
                $("#sdtnvtimkiem").focus();
                return false;
            }
            $.post("./timkiemnhanvien.php",{kieu:'kieu3',sdt:sdt,page:page},function(data){
                $("#hiennv").html(data);                  
            });
        }
        if (kieunv==4){
            var ngaytu=$("#tungaysinhnvtimkiem").val();
            var ngayden=$("#denngaysinhnvtimkiem").val();
            if (ngaytu==""){
                alert("Chưa nhập ngày sinh từ cần tìm");
                $("#tungaysinhnvtimkiem").focus();
                return false;
            }
            if(ngayden==""){
                alert("Chưa nhập ngày sinh đến cần tìm");
                $("#denngaysinhnvtimkiem").focus();
                return false;
            }
            $.post("./timkiemnhanvien.php",{kieu:'kieu4',ngaytu:ngaytu,ngayden:ngayden,page:page},function(data){
                $("#hiennv").html(data);                  
            });
        }
    });
});
</script>