<link rel="stylesheet" href="../css/taikhoan2.css">
<div class="container tk">
    <div class="row tieudetk">
        <div class="col-md-12">Tài tkoản</div>
    </div>
    <div class="row timkiemtk">
        <div class="col-md-4 col-sm-4">
            <select class="form-select form-select-lg mb-3" id="chonkieutimkiemtk">
                <option value="0" selected>Chọn kiểu tìm kiếm</option>
                <option value="1">Tìm kiếm theo tên tài khoản</option>
                <option value="2">Tìm kiếm theo quyền tài khoản</option>
            </select>
        </div>
        <div class="col-md-2 col-sm-2">
            <input class="btn btn-info btn-lg" type="button" value="Tìm kiếm" id="nuttimkiemtk" />
        </div>
        <div class="col-md-3 col-sm-3"></div>
        <div class="col-md-3 col-sm-3">
            <button type="button" class="btn btn-info" id="themtk">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
                <a href="./quanly.php?xuly=themtk">Thêm tài khoản</a>
            </button>
        </div>
    </div>
    <div id="kieutimkiemtk">                                                            
        
    </div>    
    <div id="hientk">   
        <div class="row">
            <table class="table table-bordered bangtk">
                <thead>
                    <tr>
                        <th class="tbtk1">Mã tài khoản</th>
                        <th class="tbtk2">Quyền tài khoản</th>
                        <th class="tbtk3">Tên tài khoản</th>
                        <th class="tbtk4">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once("./KetnoiCSDL.php");
                        require_once("./xulydulieu.php");
                        $p=new CheckConnection();
                        $p1=new Xuly();
                        $sql="SELECT tk.MaTK,qtk.TenQuyen,tk.Username 
                        FROM tai_khoan as tk,quyen_tk as qtk 
                        WHERE qtk.MaQuyen=tk.MaQuyen AND tk.TinhTrang!=0 LIMIT 0,5";
                        $rs=$p->ExcuteQuery($sql);
                        $s="";
                        while($r=mysqli_fetch_array($rs)){

                            $s=$s."<tr>
                                        <td>$r[0]</td>
                                        <td class='tk1'>$r[1]</td>
                                        <td>$r[2]</td>
                                        <td class='suaxoatk'>
                                            <a href='./quanly.php?xuly=xemtk&id=$r[0]' class='xemtk'><i class='bx bx-detail'></i></i></a>
                                            <a href='./quanly.php?xuly=suatk&id=$r[0]' class='suatk'><i class='bx bx-edit'></i></a>
                                            <span p='$r[0]'><a href='#' class='xoatk'><i class='bx bx-trash' ></i></a></span>
                                        </td>  
                                    </tr>";
                        }
                        echo $s;
                    ?>                    
                </tbody>
            </table>            
        </div> 
        <div class="row phantrangtk">
            <div class="col-md-12 col-sm-12 phantrangtk1">  
                <?php
                    $p=new CheckConnection();
                    $sql="SELECT tk.MaTK,qtk.TenQuyen,tk.Username 
                    FROM tai_khoan as tk,quyen_tk as qtk 
                    WHERE qtk.MaQuyen=tk.MaQuyen AND tk.TinhTrang!=0";
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
        $(".suaxoatk span").click(function(){
            var matk=$(this).attr('p');
            if (confirm('Bạn có chắc muốn xóa')){
                $.post("./xulytaikhoan.php",{kieu:'xoatk',matk:matk},function(data){
                    if (data==1){
                        alert("Xóa thành công");
                        location.reload(); 
                    }                   
                });
            }
        });
        $("#chonkieutimkiemtk").change(function(){
            var kieutk=$("#chonkieutimkiemtk").val();
            $.post("./xulytaikhoan.php",{kieu:'timkiemtk',kieutk:kieutk},function(data){
                $("#kieutimkiemtk").html(data);
            });
        });
        $(".phantrangtk1 div").click(function(){
            var page=$(this).attr('page');
            $.post("./phantrangtaikhoan.php",{kieu:'phantrangtk',page:page},function(data){
                $("#hientk").html(data);                  
            });            
        });
        $("#nuttimkiemtk").click(function(){
            var kieutk=$("#chonkieutimkiemtk").val();
            if (kieutk==0){
                alert("Chưa chọn kiểu tìm kiếm");
                return false;
            }
            if (kieutk==1){
                var tentk=$("#tentktimkiem").val();
                if (tentk==""){
                    alert("Chưa nhập tên tài khoản cần tìm");
                    $("#tentktimkiem").focus();
                    return false;
                }
                $.post("./timkiemtaikhoan.php",{kieu:'kieu1',tentk:tentk},function(data){
                    $("#hientk").html(data);                  
                });
            }
            if (kieutk==2){
                var maq=$("#quyentktktimkiem").val();
                if (maq==0){
                    alert("Chưa chọn quyền tài khoản cần tìm");
                    $("#quyentktktimkiem").focus();
                    return false;
                }
                $.post("./timkiemtaikhoan.php",{kieu:'kieu2',maq:maq},function(data){
                    $("#hientk").html(data);                  
                });
            }
        });
    });
</script>