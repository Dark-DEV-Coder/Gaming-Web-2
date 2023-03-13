
<link rel="stylesheet" href="../css/loinhuan1.css">
<div class="container ln">
    <div class="row tieudeln">
        <div class="col-md-12">Cập nhật lợi nhuận</div>
    </div>
    <div class="row themln">         
            <?php
                if(isset($_GET['id']))
                    $id=$_GET['id'];
                require_once("./KetnoiCSDL.php");
                $p=new CheckConnection();
                $sql1="SELECT * from loi_nhuan WHERE MaLN='$id'";
                $rs1=$p->ExcuteQuery($sql1);
                $r1=mysqli_fetch_row($rs1);                        
                $s="<div class='row'>
                        <div class='col-md-3 col-sm-3'></div>
                        <div class='col-md-3 col-sm-3 div2'>Mã lợi nhuận</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-3 col-sm-3'></div>             
                        <div class='col-md-6 col-sm-6 div3'>
                            <input class='form-control' type='text' id='suamaln' value='$r1[0]' readonly  />
                        </div>     
                    </div>
                    <div class='row'>
                        <div class='col-md-3 col-sm-3'></div>
                        <div class='col-md-3 col-sm-3 div2'>Mã nhóm sản phẩm</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-3 col-sm-3'></div>             
                        <div class='col-md-6 col-sm-6 div3'>
                            <input class='form-control' value='$r1[1]' type='text' id='suamaspln' readonly  />
                        </div>     
                    </div>
                    <div class='row div4'>
                        <div class='col-md-3 col-sm-3'></div>
                        <div class='col-md-3 col-sm-3 div2'>% lợi nhuận</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-3 col-sm-3'></div>             
                        <div class='col-md-6 col-sm-6 div3'>
                            <input class='form-control' value='$r1[2]' type='number' id='suaphantramln' placeholder='Nhập phần trăm lợi nhuận'  />
                        </div>     
                    </div>"; 
                echo $s;                   
            ?>                                               
        </div>
        <div class="row div5">
            <div class="col-md-12 col-sm-12">
                <input type="button" id="nutsualn" value="Hoàn thành" class="btn btn-info btn-lg" />
            </div>
        </div>     
    </div>
</div>
<script>
    var sdt=/^0[0-9]{9}$/;
    $(document).ready(function(){
        $("#nutsualn").click(function(){
            var id=$("#suamaln").val();
            var ptln=$("#suaphantramln").val();
            var maspln=$("#suamaspln").val();
            if (suaphantramln<0 || suaphantramln==""){
                alert("Chưa nhập phần trăm khuyến mãi");
                $("#suaphantramln").focus();
                return false;
            }            
            $.post("./xulyloinhuan.php",{kieu:'sualn',ptln:ptln,id:id,maspln:maspln},function(data){                
                if (data==1){
                    alert("Cập nhật thành công");
                    location.replace("./quanly.php?idchucnang=LN");                    
                }
            });
        });
    });
</script>