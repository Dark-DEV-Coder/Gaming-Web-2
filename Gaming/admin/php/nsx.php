<link rel="stylesheet" href="../css/nsx1.css"> 
<div class="container nsx">
    <div class="row tieudensx">
        <div class="col-md-12">Nhà sản xuất</div>
    </div>
    <div class="row timkiemnsx">
        <div class="col-md-4 col-sm-4">
            <select class="form-select form-select-lg mb-3" id="chonkieutimkiemnsx">
                <option value="0" selected>Chọn kiểu tìm kiếm</option>
                <option value="1">Tìm kiếm theo tên</option>
                <option value="2">Tìm kiếm theo số điện thoại</option>
            </select>
        </div>
        <div class="col-md-2 col-sm-2">
            <input class="btn btn-info btn-lg" type="button" value="Tìm kiếm" id="nuttimkiemnsx" />
        </div>
        <div class="col-md-3 col-sm-3"></div>
        <div class="col-md-3 col-sm-3">
            <button type="button" class="btn btn-info" id="themnsx">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
                <a href="./quanly.php?xuly=themnsx">Thêm nhà sản xuất</a>
            </button>
        </div>
    </div>
    <div id="kieutimkiemnsx">        
                       
    </div>    
    <div id="hiennsx">   
        <div class="row">
            <table class="table table-bordered bangnsx">
                <thead>
                    <tr>
                        <th class="tbnsx1">Mã nhà sản xuất</th>
                        <th class="tbnsx2">Tên nhà sản xuất</th>
                        <th class="tbnsx3">Số điện thoại</th>
                        <th class="tbnsx4">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once("./KetnoiCSDL.php");
                        require_once("./xulydulieu.php");
                        $p=new CheckConnection();
                        $p1=new Xuly();
                        $sql="SELECT * FROM nha_san_xuat WHERE TinhTrang!=0 LIMIT 0,5";
                        $rs=$p->ExcuteQuery($sql);
                        $s="";
                        while($r=mysqli_fetch_array($rs)){
                            $s=$s."<tr>
                                        <td class='nsx1'>$r[0]</td>
                                        <td>$r[1]</td>
                                        <td class='nsx1'>$r[2]</td>
                                        <td class='suaxoansx'>
                                            <a href='./quanly.php?xuly=xemnsx&id=$r[0]'><i class='bx bx-detail'></i></i></a>
                                            <a href='./quanly.php?xuly=suansx&id=$r[0]'><i class='bx bx-edit'></i></a>
                                            <span p='$r[0]'><a href='#'><i class='bx bx-trash' ></i></a></span>
                                        </td>  
                                    </tr>";
                        }
                        echo $s;
                    ?>                    
                </tbody>
            </table>            
        </div> 
        <div class="row phantrangnsx">
            <div class="col-md-12 col-sm-12 phantrangnsx1">  
                <?php
                    $p=new CheckConnection();
                    $sql="SELECT * FROM nha_san_xuat WHERE TinhTrang!=0";
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
    var sdt=/^0[0-9]{1,9}$/;
    $(document).ready(function(){
        $(".suaxoansx span").click(function(){
            var mansx=$(this).attr('p');
            if (confirm('Bạn có chắc muốn xóa')){
                $.post("./xulynsx.php",{kieu:'xoansx',mansx:mansx},function(data){
                    if (data==1){
                        alert("Xóa thành công");
                        location.reload(); 
                    }                   
                });
            }
        });
        $("#chonkieutimkiemnsx").change(function(){
            var kieunsx=$("#chonkieutimkiemnsx").val();
            $.post("./xulynsx.php",{kieu:'timkiemnsx',kieunsx:kieunsx},function(data){
                $("#kieutimkiemnsx").html(data);
            });
        });
        $(".phantrangnsx1 div").click(function(){
            var page=$(this).attr('page');
            $.post("./phantrangnsx.php",{kieu:'phantrangnsx',page:page},function(data){
                $("#hiennsx").html(data);                  
            });            
        });
        $("#nuttimkiemnsx").click(function(){
            var kieunsx=$("#chonkieutimkiemnsx").val();
            if (kieunsx==0){
                alert("Chưa chọn kiểu tìm kiếm");
                return false;
            }
            if (kieunsx==1){
                var tennsx=$("#tennsxtimkiem").val();
                if (tennsx==""){
                    alert("Chưa nhập tên nhà sản xuất cần tìm");
                    $("#tennsxtimkiem").focus();
                    return false;
                }
                $.post("./timkiemnsx.php",{kieu:'kieu1',tennsx:tennsx},function(data){
                    $("#hiennsx").html(data);                  
                });
            }
            if (kieunsx==2){
                var sdtnsx=$("#sdtnsxtimkiem").val();
                if (sdtnsx==""){
                    alert("Chưa nhập số điện thoại cần tìm");
                    $("#sdtnsxtimkiem").focus();
                    return false;
                }
                if (sdt.test(sdtnsx)==false){
                    alert("Số điện thoại không hợp lệ");
                    $("#sdtnsxtimkiem").focus();
                    return false;
                }
                $.post("./timkiemnsx.php",{kieu:'kieu2',sdtnsx:sdtnsx},function(data){
                    $("#hiennsx").html(data);                  
                });
            }
        });
    });
</script>