
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
        <div class="col-md-12">Cập nhật khuyến mãi</div>
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
            <input value='<?php echo $r1[1] ?>' class='form-control' type='text' id='suatenkm'/>             
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
                        <input value='<?php echo $r1[2] ?>' class='form-control' type='date' id='suanbd'/>
                    </div>     
                </div> 
                <div class='row div4'>
                        <div class='col-md-1 col-sm-1'></div>
                        <div class='col-md-6 col-sm-6 div2'>Ngày kết thúc</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-1 col-sm-1'></div>             
                        <div class='col-md-6 col-sm-6 div3'>
                        <input value='<?php echo $r1[3] ?>' class='form-control' type='date' id='suankt'/>             
                        </div> 
                        <div class='col-md-3 mt-2 col-sm-3'>
                                <button class='btn btn-info' type='button' id='nutsuakm' value='<?php echo $id ?>'>Cập nhật</button>
                        </div>    
                    </div>  
            </div>
                <div class='col-md-6 col-sm-6'>
                    <div class='row div4'>
                        <div class='col-md-1 col-sm-1'></div>
                        <div class='col-md-6 col-sm-6 div2'>Mã nhóm sản phẩm</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-1 col-sm-1'></div>             
                        <div class='col-md-6 col-sm-6 div3'>
                            <input class='form-control' type='text' id='themctspkm' value=''  />             
                        </div>     
                    </div> 
                    <div class='row div4'>
                        <div class='col-md-1 col-sm-1'></div>
                        <div class='col-md-6 col-sm-6 div2'>Phần trăm khuyến mãi</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-1 col-sm-1'></div>             
                        <div class='col-md-6 col-sm-6 div3'>
                            <input class='form-control' type='number' id='themctptkm' />             
                        </div>
                    </div>
                    <div class='row div5'> 
                        <div class='col-md-8 col-sm-3'>
                                <button class='btn btn-info' type='button' id='nutthemctkm' value='<?php echo $id ?>'>Thêm chi tiết</button>  
                        </div> 
                    </div>
                    
                </div>  
                <div class='row' style='margin-top:30px'>";
                <table class='table table-bordered bangpnh'>
                <thead>
                    <tr>
                        <th class='tbpnh1'>Mã sản phẩm</th>
                        <th class='tbpnh2'>Phần trăm</th>
                        <th class='tbpnh5'>Chức năng</th>
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
                    <td class='pnh1'><?php echo $r1[2] ?></td>>
                    <td class='suaxoakm pnh1' id='xoachitietkm'>
                        <span p='<?php echo $r1[0] ?>' p1='<?php echo $r1[1] ?>' p2='<?php echo $r1[2] ?>'><a href='#' class='xoakm'><i class='bx bx-trash' ></i></a></span>
                    </td>  
                </tr>
                <?php } ?>
                </tbody>
            </table>
            </div>
        </div> 
    <div class="row div5" style="height: 15%;">
        <div class="col-md-12 col-sm-12">
            <input type="button" id="nuthoanthanhkm" value="Hoàn thành" class="btn btn-info btn-lg" />
        </div>
    </div>  
    </div>
</div> 
<?php } ?>
<script>
    var sdt=/^0[0-9]{9}$/;
    $(document).ready(function(){
        $("#nutsuakm").click(function(){
            var tenkm=$("#suatenkm").val();
            var nbd=$("#suanbd").val();
            var nkt=$("#suankt").val();
            var makm=$("#nutsuakm").val();
            if (tenkm==""){
                alert("Chưa nhập tên khuyến mãi");
                $("#suatenkm").focus();
                return false;
            }
            if (nbd==""){
                alert("Chưa nhập ngày bắt đầu");
                $("#suanbd").focus();
                return false;
            }
            if (nkt==""){
                alert("Chưa nhập ngày kết thúc");
                $("#suankt").focus();
                return false;
            }
            if(nbd>nkt){
                alert("ngày bắt đầu không được lớn hơn ngày kết thúc");
                $("#suankt").focus();
                return false;
            }
            $.post("./xulykm.php",{kieu:'suakm',makm:makm,tenkm:tenkm,nbd:nbd,nkt:nkt},function(data){             
                //alert(data);
                if (data==1){
                    alert("sửa thành công");
                    location.reload();                
                }if(data==2){
                    alert("không thể tạo cho quá khứ");
                    //location.replace("./quanly.php?idchucnang=KM"); 
                }
            });
        });
        $("#nutthemctkm").click(function(){
            var makm=$("#nutthemctkm").val();
            var ptkm=$("#themctptkm").val();
            var masp=$("#themctspkm").val();
            if (masp==""){
                alert("Chưa nhập mã sản phẩm");
                $("#themctspkm").focus();
                return false;
            }
            if (ptkm==""){
                alert("Chưa nhập phần trăm khuyến mãi");
                $("#themctptkm").focus();
                return false;
            }
            $.post("./xulykm.php",{kieu:'themctkm',makm:makm,ptkm:ptkm,masp:masp},function(data){
                console.log(data)
                if (data==1){
                    alert("Thêm chi tiết thành công");
                    location.reload();
                }
                else if(data==2){
                    alert("Mã sản phẩm đã tồn tại trong chi tiết");
                }else{
                    alert("Mã sản phẩm không tồn tại")
                }
            });
        });
        $("#xoachitietkm span").click(function(){
            var makm=$(this).attr('p');
            var masp=$(this).attr('p1');
            var ptkm=$(this).attr('p2');
            if (confirm("Bạn có chắc muốn xóa")){
                $.post("./xulykm.php",{kieu:'xoactkm',makm:makm,ptkm:ptkm,masp:masp},function(data){
                    if (data==1){
                        alert("Xóa chi tiết thành công");
                        location.reload();
                    }
                });
            }
        });
        $("#nuthoanthanhkm").click(function(){
            location.replace("./quanly.php?idchucnang=KM");
        });
    });
</script>