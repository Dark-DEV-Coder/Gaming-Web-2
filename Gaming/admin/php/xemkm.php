
<?php 
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        require_once("./KetnoiCSDL.php");
        $p=new CheckConnection();
        $sql1="SELECT * from khuyen_mai WHERE MaKM='$id'";
        $rs1=$p->ExcuteQuery($sql1);
        $r1=mysqli_fetch_row($rs1);
        //echo $r1[1];
?>
<link rel="stylesheet" href="../css/phieunhaphang1.css">
<div class="container pnh">
    <div class="row tieudepnh">
        <div class="col-md-12">Xem thông tin khuyến mãi</div>
    </div>
    <div class="row thempnh">
    <div class='col-md-6 col-sm-6'>  
    <div class='row div4'>
        <div class='col-md-1 col-sm-1'></div>
        <div class='col-md-6 col-sm-6 div2'>Tên khuyến mãi</div>                               
    </div>
    <div class='row'>  
        <div class='col-md-1 col-sm-1'></div>             
        <div class='col-md-9 col-sm-6 div3'>
            <input readonly value='<?php echo $r1[1] ?>' class='form-control' type='text' id='suatenkm'/>             
        </div>     
    </div>     

    <div class='row'>  
        <div class='col-md-1 col-sm-1'></div>             
        <div class='col-md-6 col-sm-6 div3'>            
    </div>
    </div>
                <div class='row div4'>
                    <div class='col-md-1 col-sm-1'></div>
                    <div class='col-md-6 col-sm-6 div2'>Ngày bắt đầu</div>                               
                </div>
                <div class='row'>  
                    <div class='col-md-1 col-sm-1'></div>             
                    <div class='col-md-6 col-sm-6 div3'>
                        <input readonly value='<?php echo $r1[2] ?>' class='form-control' type='date' id='suanbd'/>
                    </div>     
                </div> 
                <div class='row div4'>
                        <div class='col-md-1 col-sm-1'></div>
                        <div class='col-md-6 col-sm-6 div2'>Ngày kết thúc</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-1 col-sm-1'></div>             
                        <div class='col-md-6 col-sm-6 div3'>
                        <input readonly value='<?php echo $r1[3] ?>' class='form-control' type='date' id='suankt'/>             
                        </div>    
                    </div>  
            </div>
                <div class='row' style='margin-top:30px'>
                <table class='table table-bordered bangpnh'>
                <thead>
                    <tr>
                        <th class='tbpnh1'>Mã sản phẩm</th>
                        <th class='tbpnh2'>Phần trăm</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $sql="SELECT * from chi_tiet_km where MaKM='$id'";
                        $rs=$p->ExcuteQuery($sql);
                        while($r1=mysqli_fetch_array($rs)){
                    ?>
                <tr>
                    <td class='pnh1'><?php echo $r1[1] ?></td>
                    <td class='pnh1'><?php echo $r1[2] ?></td>
                    
                </tr>
                <?php } ?>
                </tbody>
            </table>
            </div>
        </div> 
    <div class="row div5" style="height: 15%;">
        <div class="col-md-12 col-sm-12">
            <input type="button" id="nuthoanthanhkm" value="Thoát" class="btn btn-info btn-lg" />
        </div>
    </div>  
    </div>
</div> 
<?php } ?>
<script>
    var sdt=/^0[0-9]{9}$/;
    $(document).ready(function(){
        $("#nuthoanthanhkm").click(function(){
            location.replace("./quanly.php?idchucnang=KM");
        });
    });
</script>