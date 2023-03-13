<link rel="stylesheet" href="../css/hoadon2.css">
<div class="container hd">
    <div class="row tieudehd">
        <div class="col-md-12">Thống kê hóa đơn</div>
    </div>
    <div class="row timkiemhd">
        <div class="col-md-4 col-sm-4">
            <select class="form-select form-select-lg mb-3" id="chonkieuthongkehd">
                <option value="0" selected>Chọn kiểu thống kê</option>
                <option value="1">Thống kê theo thời gian</option>
                <option value="2">Thống kê theo sản phẩm bán chạy</option>
            </select>
        </div>
        <div class="col-md-2 col-sm-2">
            <input class="btn btn-info btn-lg" type="button" value="Thống kê" id="nutthongkehd" />
        </div>                  
    </div>
    <div id="kieuthongkehd">
           
    </div>    
    <div id="hienhd">   
        <?php
            require_once("./KetnoiCSDL.php");
            require_once("./xulydulieu.php");
            $p=new CheckConnection();
            $p1=new Xuly();
            if (isset($_POST['kieu'])){
                
            }
        ?>                                                   
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#chonkieuthongkehd").change(function(){
            var kieutk=$(this).val();            
            $.post("./xulyhoadon.php",{kieu:'thongkehd',kieutk:kieutk},function(data){
                $("#kieuthongkehd").html(data);
            });
        });
        $(".phantranghd1 div").click(function(){
            var page=$(this).attr('page');            
            if (kieutk==1){
                var tungay=$("#tungayhdthongke").val();
                var denngay=$("#denngayhdthongke").val();
                if (tungay==""){
                    alert("Chưa chọn thời gian cần tìm");
                    $("#tungayhdthongke").focus();
                    return false;
                }
                if (denngay==""){
                    alert("Chưa chọn thời gian cần tìm");
                    $("#denngayhdthongke").focus();
                    return false;
                }
                if (tungay>denngay){
                    alert("Khoảng thòi gian không hợp lệ");
                    return false;
                }
                $.post("./xulyhoadon.php",{kieu:'kieuthongke1',tungay:tungay,denngay:denngay},function(data){               
                    $("#hienhd").html(data);
                })
            }    
        });
        $("#nutthongkehd").click(function(){
            var kieutk=$("#chonkieuthongkehd").val();
            if (kieutk==0){
                alert("Chưa chọn kiểu tìm kiếm");
                return false;
            }
            if (kieutk==1){
                var tungay=$("#tungayhdthongke").val();
                var denngay=$("#denngayhdthongke").val();
                if (tungay==""){
                    alert("Chưa chọn thời gian cần tìm");
                    $("#tungayhdthongke").focus();
                    return false;
                }
                if (denngay==""){
                    alert("Chưa chọn thời gian cần tìm");
                    $("#denngayhdthongke").focus();
                    return false;
                }
                if (tungay>denngay){
                    alert("Khoảng thòi gian không hợp lệ");
                    return false;
                }
                $.post("./xulyhoadon.php",{kieu:'kieuthongke1',tungay:tungay,denngay:denngay},function(data){               
                    $("#hienhd").html(data);
                })
            }    
            if (kieutk==2){
                var hangsp=$("#hangsphdthongke").val();
                if (hangsp==""){
                    alert("Chưa nhập hạng sản phẩm cần thống kê");
                    $("#hangsphdthongke").focus();
                    return false;
                }
                $.post("./xulyhoadon.php",{kieu:'kieuthongke2',hangsp:hangsp},function(data){
                    $("#hienhd").html(data);
                })
            }
            
        });
    });
</script>