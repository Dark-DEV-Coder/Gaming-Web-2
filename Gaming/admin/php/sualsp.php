
<link rel="stylesheet" href="../css/loaisp1.css">
<div class="container lsp">
    <div class="row tieudelsp">
        <div class="col-md-12">Cập nhật loại sản phẩm</div>
    </div>
    <div class="row themlsp">         
            <?php
                if(isset($_GET['id']))
                    $id=$_GET['id'];
                require_once("./KetnoiCSDL.php");
                $p=new CheckConnection();
                $sql1="SELECT * from loai_sp WHERE MaLoai='$id'";
                $rs1=$p->ExcuteQuery($sql1);
                $r1=mysqli_fetch_row($rs1);                        
                $s="<div class='row'>
                        <div class='col-md-3 col-sm-3'></div>
                        <div class='col-md-3 col-sm-3 div2'>Mã loại sản phẩm</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-3 col-sm-3'></div>             
                        <div class='col-md-6 col-sm-6 div3'>
                            <input class='form-control' type='text' id='suamalsp' value='$r1[0]' readonly  />
                        </div>     
                    </div>
                    <div class='row'>
                        <div class='col-md-3 col-sm-3'></div>
                        <div class='col-md-3 col-sm-3 div2'>Tên loại sản phẩm</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-3 col-sm-3'></div>             
                        <div class='col-md-6 col-sm-6 div3'>
                            <input class='form-control' value='$r1[1]' type='text' id='suatenlsp' placeholder='Nhập tên loại sản phẩm'  />
                        </div>     
                    </div>"; 
                echo $s;                   
            ?>                                               
        </div>
        <div class="row div5">
            <div class="col-md-12 col-sm-12">
                <input type="button" id="nutsualsp" value="Hoàn thành" class="btn btn-info btn-lg" />
            </div>
        </div>     
    </div>
</div>
<script>
    var sdt=/^0[0-9]{9}$/;
    $(document).ready(function(){
        $("#nutsualsp").click(function(){
            var id=$("#suamalsp").val();
            var tenlsp=$("#suatenlsp").val();
            if (tenlsp==""){
                alert("Chưa nhập tên loại sản phẩm");
                $("#suatenlsp").focus();
                return false;
            }            
            $.post("./xulyloaisp.php",{kieu:'sualsp',tenlsp:tenlsp,id:id},function(data){                
                if (data==1){
                    alert("Cập nhật thành công");
                    location.replace("./quanly.php?idchucnang=LSP");                    
                }
            });
        });
    });
</script>