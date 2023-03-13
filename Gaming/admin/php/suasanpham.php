
<link rel="stylesheet" href="../css/sanpham4.css">
<div class="container sp">
    <div class="row tieudesp">
        <div class="col-md-12">Cập nhật sản phẩm</div>
    </div>
    <div class="row themsp"> 
        <?php
            require_once("./KetnoiCSDL.php");
            $p=new CheckConnection();
            if (isset($_GET['id']))
                $id=$_GET['id'];
            $sql1="SELECT * FROM san_pham WHERE MaNhomSP='$id'";
            $rs=$p->ExcuteQuery($sql1);
            $r=mysqli_fetch_row($rs);
            $s="<div class='row div4'>
                    <div class='col-md-3 col-sm-3'></div>
                    <div class='col-md-3 col-sm-3 div2'>Mã sản phẩm</div>                               
                </div>
                <div class='row'>  
                    <div class='col-md-3 col-sm-3'></div>             
                    <div class='col-md-6 col-sm-6 div3'>
                        <input class='form-control' value='$r[0]' type='text' id='suamasp' readonly  />
                    </div>     
                </div>       
                <div class='row div4'>
                    <div class='col-md-3 col-sm-3'></div>
                    <div class='col-md-3 col-sm-3 div2'>Loại sản phẩm</div>                               
                </div>
                <div class='row'>  
                    <div class='col-md-3 col-sm-3'></div>             
                    <div class='col-md-6 col-sm-6 div3'>
                        <select class='form-select' id='sualoaisp'>
                            <option value='0'>Chọn loại sản phẩm</option>";
            $sql="SELECT * FROM loai_sp WHERE TinhTrang!=0";
            $p=new CheckConnection();
            $rs1=$p->ExcuteQuery($sql);
            while($r1=mysqli_fetch_array($rs1)){
                if ($r1[0]==$r[1])
                    $s=$s."<option value='$r1[0]' selected>$r1[1]</option>";
                else
                    $s=$s."<option value='$r1[0]'>$r1[1]</option>";
            }
            $s=$s."</select>
                    </div>     
                </div>
                <div class='row div4'>
                    <div class='col-md-3 col-sm-3'></div>
                    <div class='col-md-3 col-sm-3 div2'>Nhà sản xuất</div>                               
                </div>
                <div class='row'>  
                    <div class='col-md-3 col-sm-3'></div>             
                    <div class='col-md-6 col-sm-6 div3'>
                        <select class='form-select' id='suansxsp'>
                            <option value='0'>Chọn nhà sản xuất</option>";                           
            $sql="SELECT * FROM nha_san_xuat WHERE TinhTrang!=0";
            $p=new CheckConnection();
            $rs1=$p->ExcuteQuery($sql);
            while($r1=mysqli_fetch_array($rs1)){
                if ($r1[0]==$r[2])
                    $s=$s."<option value='$r1[0]' selected>$r1[1]</option>";
                else
                    $s=$s."<option value='$r1[0]'>$r1[1]</option>";
            }
            $s=$s." </select>
            </div>     
                </div>
                <div class='row div4'>
                    <div class='col-md-3 col-sm-3'></div>
                    <div class='col-md-3 col-sm-3 div2'>Tên sản phẩm</div>                               
                </div>
                <div class='row'>  
                    <div class='col-md-3 col-sm-3'></div>             
                    <div class='col-md-6 col-sm-6 div3'>
                        <input class='form-control' value='$r[3]' type='text' id='suatensp' placeholder='Nhập tên sản phẩm'  />
                    </div>     
                </div>
                <div class='row div4'>
                    <div class='col-md-3 col-sm-3'></div>
                    <div class='col-md-3 col-sm-3 div2'>Hình ảnh</div>                               
                </div>
                <div class='row'>  
                    <div class='col-md-3 col-sm-3'></div>             
                    <div class='col-md-6 col-sm-6 div3'>
                        <input class='form-control' type='file' id='suahinhsp' value='$r[4]'  />
                    </div>     
                </div>
                <div class='row div4'>
                    <div class='col-md-3 col-sm-3'></div>
                    <div class='col-md-3 col-sm-3 div2' id='hienhinhanh'>
                        <img src='../img/$r[4]' />
                    </div>                               
                </div>
                <div class='row div4'>
                    <div class='col-md-3 col-sm-3'></div>
                    <div class='col-md-3 col-sm-3 div2'>Mô tả sản phẩm</div>                               
                </div>
                <div class='row'>  
                    <div class='col-md-3 col-sm-3'></div>             
                    <div class='col-md-6 col-sm-6 div3'>
                        <textarea class='form-control' placeholder='Nhập mô tả sản phẩm' rows='5' id='suamotasp'>$r[5]</textarea>
                    </div>     
                </div>
                <div class='row div4'>
                    <div class='col-md-3 col-sm-3'></div>
                    <div class='col-md-3 col-sm-3 div2'>Độ ưu tiên</div>                               
                </div>
                <div class='row'>  
                    <div class='col-md-3 col-sm-3'></div>             
                    <div class='col-md-6 col-sm-6 div3'>
                        <input class='form-control' value='$r[11]' type='number' id='suadutsp' placeholder='Nhập độ ưu tiên'  />
                    </div>     
                </div>";   
                echo $s;        
        ?>
               
        <div class="row div5">
            <div class="col-md-12 col-sm-12">
                <input type="button" id="nutsuasp" value="Hoàn thành" class="btn btn-info btn-lg" />
            </div>
        </div>     
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#nutsuasp").click(function(){
            var masp=$("#suamasp").val();
            var lsp=$("#sualoaisp").val();
            var nsx=$("#suansxsp").val();
            var tensp=$("#suatensp").val();
            var hinhanh=$("#suahinhsp").val();
            var mota=$("#suamotasp").val();
            var douutien=$("#suadutsp").val();            
            var suahinh1;
            var suahinh="";
            if (hinhanh!=""){
                suahinh1=hinhanh.split("\\");
                suahinh=suahinh1[2];
            }
            if (masp==""){
                alert("Chưa nhập mã sản phẩm");
                $("#suamasp").focus();
                return false;
            }
            if (lsp==0){
                alert("Chưa chọn loại sản phẩm");
                $("#sualoaisp").focus();
                return false;
            }
            if (nsx==0){
                alert("Chưa chọn nhà sản xuất");
                $("#suansxsp").focus();
                return false;
            }
            if (tensp==""){
                alert("Chưa nhập tên sản phẩm");
                $("#suatensp").focus();
                return false;
            }
            if (mota==""){
                alert("Chưa nhập mô tả sản phẩm");
                $("#suamotasp").focus();
                return false;
            }
            if (douutien=="" || douutien<=0){
                alert("Chưa nhập độ ưu tiên sản phẩm");
                $("#suadutsp").focus();
                return false;
            }
            $.post("./xulysanpham.php",{kieu:'suasp',masp:masp,lsp:lsp,nsx:nsx,tensp:tensp,suahinh:suahinh,mota:mota,douutien:douutien},function(data){
                console.log(data);
                if (data==1){
                    alert("Cập nhật thành công");
                    location.replace("./quanly.php?idchucnang=SP");
                }
            })
        });
        $("#suahinhsp").change(function(){
            var fileInput = document.getElementById('suahinhsp');
            var filePath = fileInput.value;
            var allowedExtensions = /(\.jpg|\.png)$/i;                        
            if(!allowedExtensions.exec(filePath)){
                alert('Vui lòng upload các file có định dạng: .jpg or .png');        
                fileInput.value = '';    
                return false;   
            }
            else{                   
                var k=filePath.split("\\");
                data="<img src='../img/"+k[2]+"' />";
                $("#hienhinhanh").html(data);                
            }
            
        })
    });
</script>