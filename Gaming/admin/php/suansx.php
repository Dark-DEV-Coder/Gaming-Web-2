
<link rel="stylesheet" href="../css/nsx1.css">
<div class="container nsx">
    <div class="row tieudensx">
        <div class="col-md-12">Cập nhật nhà sản xuất</div>
    </div>
    <div class="row themnsx">         
            <?php
                if(isset($_GET['id']))
                    $id=$_GET['id'];
                require_once("./KetnoiCSDL.php");
                $p=new CheckConnection();
                $sql1="SELECT * from nha_san_xuat WHERE MaNSX='$id'";
                $rs1=$p->ExcuteQuery($sql1);
                $r1=mysqli_fetch_row($rs1);                        
                $s="<div class='row'>
                        <div class='col-md-3 col-sm-3'></div>
                        <div class='col-md-3 col-sm-3 div2'>Mã nhà sản xuất</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-3 col-sm-3'></div>             
                        <div class='col-md-6 col-sm-6 div3'>
                            <input class='form-control' type='text' id='suamansx' value='$r1[0]' readonly  />
                        </div>     
                    </div>
                    <div class='row'>
                        <div class='col-md-3 col-sm-3'></div>
                        <div class='col-md-3 col-sm-3 div2'>Tên nhà sản xuất</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-3 col-sm-3'></div>             
                        <div class='col-md-6 col-sm-6 div3'>
                            <input class='form-control' value='$r1[1]' type='text' id='suatennsx' placeholder='Nhập tên nhà sản xuất'  />
                        </div>     
                    </div>
                    <div class='row div4'>
                        <div class='col-md-3 col-sm-3'></div>
                        <div class='col-md-3 col-sm-3 div2'>Số điện thoại</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-3 col-sm-3'></div>             
                        <div class='col-md-6 col-sm-6 div3'>
                            <input class='form-control' value='$r1[2]' type='text' id='suasdtnsx' placeholder='Nhập số điện thoại nhà sản xuất'  />
                        </div>     
                    </div>
                    <div class='row div4'>
                        <div class='col-md-3 col-sm-3'></div>
                        <div class='col-md-3 col-sm-3 div2'>Địa chỉ</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-3 col-sm-3'></div>             
                        <div class='col-md-6 col-sm-6 div3'>
                            <textarea rows='4' class='form-control' id='suadcnsx' placeholder='Nhập địa chỉ nhà sản xuất'>$r1[3]</textarea>          
                        </div>     
                    </div>"; 
                echo $s;                   
            ?>                                               
        </div>
        <div class="row div5">
            <div class="col-md-12 col-sm-12">
                <input type="button" id="nutsuansx" value="Hoàn thành" class="btn btn-info btn-lg" />
            </div>
        </div>     
    </div>
</div>
<script>
    var sdt=/^0[0-9]{9}$/;
    $(document).ready(function(){
        $("#nutsuansx").click(function(){
            var id=$("#suamansx").val();
            var tennsx=$("#suatennsx").val();
            var sdtnsx=$("#suasdtnsx").val();
            var dcnsx=$("#suadcnsx").val();
            if (tennsx==""){
                alert("Chưa nhập tên nhà sản xuất");
                $("#suatennsx").focus();
                return false;
            }
            if (sdtnsx==""){
                alert("Chưa nhập số điện thoại nhà sản xuất");
                $("#suasdtnsx").focus();
                return false;
            }
            if (sdt.test(sdtnsx)==false){
                alert("Số điện thoại không hợp lệ");
                $("#suasdtnsx").focus();
                return false;
            }
            if (dcnsx==""){
                alert("Chưa nhập địa chỉ nhà sản xuất");
                $("#suadcnsx").focus();
                return false;
            }
            $.post("./xulynsx.php",{kieu:'suansx',tennsx:tennsx,sdtnsx:sdtnsx,dcnsx:dcnsx,id:id},function(data){                
                if (data==1){
                    alert("Cập nhật thành công");
                    location.replace("./quanly.php?idchucnang=NSX");                    
                }
            });
        });
    });
</script>