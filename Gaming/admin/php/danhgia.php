<link rel="stylesheet" href="../css/danhgia3.css">
<div class="container dg">
    <div class="row tieudedg">
        <div class="col-md-12">Đánh giá sản phẩm</div>
    </div>
    <div class="row timkiemdg">
        <div class="col-md-4 col-sm-4">
            <select class="form-select form-select-lg mb-3" id="chonkieutimkiemdg">
                <option value="0" selected>Chọn kiểu tìm kiếm</option>
                <option value="1">Tìm kiếm theo tên tài khoản</option>
                <option value="2">Tìm kiếm theo mã sản phẩm</option>
                <option value="3">Tìm kiếm theo số sao đánh giá</option>
            </select>
        </div>
        <div class="col-md-2 col-sm-2">
            <input class="btn btn-info btn-lg" type="button" value="Tìm kiếm" id="nuttimkiemdg" />
        </div>              
    </div>
    <div id="kieutimkiemdg">                        
        
    </div>    
    <div id="hiendg">   
        <div class="row">
            <table class="table table-bordered bangdg">
                <thead>
                    <tr>
                        <th class="tbdg1">Mã bình luận</th>
                        <th class="tbdg2">Tên tài khoản</th>
                        <th class="tbdg3">Mã nhóm sản phẩm</th>
                        <th class="tbdg4">Số sao đánh giá</th>
                        <th class="tbdg5">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once("./KetnoiCSDL.php");
                        require_once("./xulydulieu.php");
                        $p=new CheckConnection();
                        $p1=new Xuly();
                        $sql="SELECT dg.MaBinhLuan,tk.Username,dg.MaNhomSP,dg.DanhGia 
                        FROM danh_gia_sp as dg,tai_khoan as tk 
                        WHERE tk.MaTK=dg.MaTK AND dg.TinhTrang!=0 LIMIT 0,5";
                        $rs=$p->ExcuteQuery($sql);
                        $s="";
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
                        echo $s;
                    ?>                    
                </tbody>
            </table>            
        </div> 
        <div class="row phantrangdg">
            <div class="col-md-12 col-sm-12 phantrangdg1">  
                <?php
                    $p=new CheckConnection();
                    $sql="SELECT dg.MaBinhLuan,tk.Username,dg.MaNhomSP,dg.DanhGia 
                        FROM danh_gia_sp as dg,tai_khoan as tk 
                        WHERE tk.MaTK=dg.MaTK AND dg.TinhTrang!=0";
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
        $("#nuttimkiemdg").click(function(){
            var kieutk=$("#chonkieutimkiemdg").val();
            if (kieutk==0){
                alert("Chưa chọn kiểu tìm kiếm");
                return false;
            }
            if (kieutk==1){
                var tentk=$("#tentkdgtimkiem").val();
                if (tentk==""){
                    alert("Chưa nhập tên tài khoản");
                    $("#tentkdgtimkiem").focus();
                    return false;
                }
                $.post("./timkiemdanhgia.php",{kieu:'kieu1',tentk:tentk},function(data){
                    $("#hiendg").html(data);
                });
            }
            if (kieutk==2){
                var masp=$("#maspdgtimkiem").val();
                if (masp==""){
                    alert("Chưa nhập mã sản phẩm");
                    $("#maspdgtimkiem").focus();
                    return false;
                }
                $.post("./timkiemdanhgia.php",{kieu:'kieu2',masp:masp},function(data){
                    $("#hiendg").html(data);
                });
            }
            if (kieutk==3){
                var sao=$("#tinhtrangdgtimkiem").val();
                if (sao==0){
                    alert("Chưa chọn số sao");
                    $("#tinhtrangdgtimkiem").focus();
                    return false;
                }
                $.post("./timkiemdanhgia.php",{kieu:'kieu3',sao:sao},function(data){
                    $("#hiendg").html(data);
                });
            }
        });
    });
</script>