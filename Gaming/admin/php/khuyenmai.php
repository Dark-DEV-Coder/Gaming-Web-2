<link rel="stylesheet" href="../css/khuyenmai1.css">
<div class="container km">
    <div class="row tieudekm">
        <div class="col-md-12">Chương trình khuyến mãi</div>
    </div>
    <div class="row timkiemkm">
        <div class="col-md-4 col-sm-4">
            <select class="form-select form-select-lg mb-3" id="chonkieutimkiemkm">
                <option value="0" selected>Chọn kiểu tìm kiếm</option>
                <option value="1">Tìm kiếm theo tên</option>
                <option value="2">Tìm kiếm theo thời gian</option>
                <option value="3">Tìm kiếm theo tình trạng</option>
            </select>
        </div>
        <div class="col-md-2 col-sm-2">
            <input class="btn btn-info btn-lg" type="button" value="Tìm kiếm" id="nuttimkiemkm" />
        </div>     
        <div class="col-md-2 col-sm-2"></div>
        <div class="col-md-4 col-sm-4">
            <button type="button" class="btn btn-info" id="themkm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
                <a href="./quanly.php?xuly=themkm">Thêm chương trình khuyến mãi</a>
            </button>
        </div>   
    </div>
    <div id="kieutimkiemkm">
        <!-- <div class="row timkiemtheotenkm">
            <div class="col-md-2 col-sm-2 div1">Tên chương trình:</div>
            <div class="col-md-4 col-sm-4">
                <input class="form-control" type="text" id="tenkmtimkiem" placeholder="Nhập tên chương trình khuyến mãi cần tìm"  />
            </div>
        </div> -->
        <!-- <div class="row timkiemtheotinhtrang">
            <div class="col-md-2 col-sm-2 div1">Tình trạng:</div>
            <div class="col-md-4 col-sm-4">
                <select class="form-select" id="tinhtrangkmtimkiem">
                    <option value="0" selected>Chọn tình trạng cần tìm</option>
                    <option value="1" selected>Đang thực hiện</option>
                    <option value="2" selected>Hết hạn</option>
                    <option value="3" selected>Chưa đến hạn</option>
                </select>
            </div>
        </div> -->
        <!-- <div class="row timkiemtheothoigiankm">
            <div class="col-md-3 col-sm-3 div1">Thời gian khuyến mãi:</div>
            <div class="col-md-4 col-sm-4">
                <input class="form-control" type="date" id="tungaykmtimkiem" />
            </div>
            <div class="col-md-1 col-sm-2 div1">-</div>
            <div class="col-md-4 col-sm-4">
                <input class="form-control" type="date" id="denngaykmtimkiem" />
            </div>
        </div> -->
        
    </div>    
    <div id="hienkm">   
        <div class="row">
            <table class="table table-bordered bangkm">
                <thead>
                    <tr>
                        <th class="tbkm1">Tên chương trình khuyến mãi</th>
                        <th class="tbkm2">Ngày bắt đầu</th>
                        <th class="tbkm3">Ngày kết thúc</th>
                        <th class="tbkm4">Tình trạng</th>
                        <th class="tbkm5">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once("./KetnoiCSDL.php");
                        require_once("./xulydulieu.php");
                        $p=new CheckConnection();
                        $p1=new Xuly();
                        $sql="SELECT * FROM khuyen_mai WHERE TinhTrang!=0 LIMIT 0,5";
                        $rs=$p->ExcuteQuery($sql);
                        $s="";
                        while($r=mysqli_fetch_array($rs)){
                            $ngay1=$p1->Chuyenngaythuan($r[2]);
                            $ngay2=$p1->Chuyenngaythuan($r[3]);
                            if ($r[4]==1)
                                $s1="<td class='km1' style='color:rgb(22, 184, 22);font-weight:600;'>Đang thực hiện</td>";
                            if ($r[4]==2)
                                $s1="<td class='km1' style='color:red;font-weight:600;'>Hết hạn</td>";
                            if ($r[4]==3)
                                $s1="<td class='km1' style='font-weight:600;'>Chưa tới hạn</td>";
                            $s=$s."<tr>
                                        <td>$r[1]</td>                                        
                                        <td class='km1'>$ngay1</td>
                                        <td class='km1'>$ngay2</td>"
                                        .$s1."
                                        <td class='suaxoakm'>
                                            <a href='./quanly.php?xuly=xemkm&id=$r[0]' class='xemkm'><i class='bx bx-detail'></i></i></a>
                                            <a href='./quanly.php?xuly=suakm&id=$r[0]' class='suakm'><i class='bx bx-edit'></i></a>
                                            <span p='$r[0]'><a href='#' class='xoakm'><i class='bx bx-trash' ></i></a></span>
                                        </td>  
                                    </tr>";
                        }
                        echo $s;
                    ?>                    
                </tbody>
            </table>            
        </div> 
        <div class="row phantrangkm">
            <div class="col-md-12 col-sm-12 phantrangkm1">  
                <?php
                    $p=new CheckConnection();
                    $sql="SELECT * FROM khuyen_mai WHERE TinhTrang!=0";
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
    $(".suaxoakm span").click(function(){
        var makm=$(this).attr('p');
        if (confirm("Bạn có chắc muốn xóa")){
            $.post("./xulykm.php",{kieu:'xoakm',makm:makm},function(data){
                if (data==1){
                    alert("Xóa thành công");
                    location.reload();
                }
            });
        }
    });
    $(".phantrangkm1 div").click(function(){
        var page=$(this).attr('page');            
        $.post("./phantrangkm.php",{kieu:'phantrangkm',page:page},function(data){
            $("#hienkm").html(data);
            console.log(data);
        });
    });
    $("#chonkieutimkiemkm").change(function(){
        var kieutk=$(this).val();            
        $.post("./xulykm.php",{kieu:'timkiemkm',kieutk:kieutk},function(data){
            $("#kieutimkiemkm").html(data);
        });
    });
    $("#nuttimkiemkm").click(function(){
        var kieutk=$("#chonkieutimkiemkm").val();
        if (kieutk==0){
            alert("Chưa chọn kiểu tìm kiếm");
            return false;
        }
        if (kieutk==1){
            var tenkm=$("#tenkmtimkiem").val();
            if (tenkm==""){
                alert("Chưa nhập tên khuyến mãi cần tìm");
                $("#tenkmtimkiem").focus();
                return false;
            }
            $.post("./timkiemkm.php",{kieu:'kieu1',tenkm:tenkm},function(data){
                $("#hienkm").html(data);
            })
        }
        if (kieutk==2){
            var nbd=$("#tungaykmtimkiem").val();
            var nkt=$("#denngaykmtimkiem").val();
            if (nbd==""){
                alert("Chưa chọn ngày từ cần tìm");
                $("#tungaykmtimkiem").focus();
                return false;
            }
            if (nkt==""){
                alert("Chưa chọn ngày đến cần tìm");
                $("#denngaykmtimkiem").focus();
                return false;
            }
            $.post("./timkiemkm.php",{kieu:'kieu2',nbd:nbd,nkt:nkt},function(data){
                $("#hienkm").html(data);
            })
        }
        if (kieutk==3){
            var tt=$("#tinhtrangkmtimkiem").val();
            if (tt==0){
                alert("Chưa chọn tình trạng cần tìm");
                $("#tinhtrangkmtimkiem").focus();
                return false;
            }
            $.post("./timkiemkm.php",{kieu:'kieu3',tt:tt},function(data){      
                console.log(data);              
                $("#hienkm").html(data);
            })
        }      
    });
});
</script>
