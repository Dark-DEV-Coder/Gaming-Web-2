
<link rel="stylesheet" href="../css/phieunhaphang1.css">
<div class="container pnh">
    <div class="row tieudepnh">
        <div class="col-md-12">Thêm phiếu nhập hàng</div>
    </div>
    <div class="row thempnh">        
        <div class="row">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Nhà sản xuất</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <select class="form-select" id="themmansxpnh">
                    <option value="0" selected>Chọn nhà sản xuất</option>
                    <?php
                        require_once("./KetnoiCSDL.php");
                        $sql="SELECT * FROM nha_san_xuat WHERE TinhTrang!=0";
                        $s="";
                        $p=new CheckConnection();
                        $rs=$p->ExcuteQuery($sql);
                        while($r=mysqli_fetch_array($rs)){
                            $s=$s."<option value='$r[0]'>$r[1]</option>";
                        }
                        echo $s;                    
                    ?>
                </select>
            </div>     
        </div>
        <div class="row div4">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Ngày nhập hàng</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <?php
                    date_default_timezone_set('Asia/Ho_Chi_Minh');                    
                    $date=date('Y-m-d');
                    $s="<input class='form-control' type='date' id='themngaynhappnh' value='$date'  />";
                    echo $s;
                ?>                
            </div>     
        </div> 
        <div class="row div5">
            <div class="col-md-12 col-sm-12">
                <input type="button" id="nutthempnh" value="Hoàn thành" class="btn btn-info btn-lg" />
            </div>
        </div>     
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#nutthempnh").click(function(){
            var mansx=$("#themmansxpnh").val();
            var ngay=$("#themngaynhappnh").val();
            if (mansx==0){
                alert("Chưa chọn nhà sản xuất");
                $("#themmansxpnh").focus();
                return false;
            }
            if (ngay==""){
                alert("Chưa chọn ngày nhập hàng");
                $("#themngaynhappnh").focus();
                return false;
            }
            $.post("./xulypnh.php",{kieu:'thempnh',mansx:mansx,ngay:ngay},function(data){
                if (data==1){
                    alert("Thêm thành công");
                    location.replace("./quanly.php?idchucnang=PNH");
                }
            });
        });
    });
</script>