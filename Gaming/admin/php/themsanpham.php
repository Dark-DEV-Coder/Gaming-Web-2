
<link rel="stylesheet" href="../css/sanpham4.css">
<div class="container sp">
    <div class="row tieudesp">
        <div class="col-md-12">Thêm sản phẩm</div>
    </div>
    <div class="row themsp"> 
        <div class="row div4">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Mã sản phẩm</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <input class="form-control" type="text" id="themmasp" placeholder="Nhập mã sản phẩm"  />
            </div>     
        </div>       
        <div class="row div4">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Loại sản phẩm</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <select class="form-select" id="themloaisp">
                    <option value="0" selected>Chọn loại sản phẩm</option>
                    <?php
                        require_once("./KetnoiCSDL.php");
                        $sql="SELECT * FROM loai_sp WHERE TinhTrang!=0";
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
            <div class="col-md-3 col-sm-3 div2">Nhà sản xuất</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <select class="form-select" id="themnsxsp">
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
            <div class="col-md-3 col-sm-3 div2">Tên sản phẩm</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <input class="form-control" type="text" id="themtensp" placeholder="Nhập tên sản phẩm"  />
            </div>     
        </div>
        <div class="row div4">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Hình ảnh</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <input class="form-control" type="file" id="themhinhsp"  />
            </div>     
        </div>
        <div class="row div4">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2" id="hienhinhanh">
                
            </div>                               
        </div>
        <div class="row div4">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Mô tả sản phẩm</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <textarea class="form-control" placeholder="Nhập mô tả sản phẩm" rows="5" id="themmotasp"></textarea>
            </div>     
        </div>
        <div class="row div5">
            <div class="col-md-12 col-sm-12">
                <input type="button" id="nutthemsp" value="Hoàn thành" class="btn btn-info btn-lg" />
            </div>
        </div>     
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#nutthemsp").click(function(){
            var masp=$("#themmasp").val();
            var lsp=$("#themloaisp").val();
            var nsx=$("#themnsxsp").val();
            var tensp=$("#themtensp").val();
            var hinhanh=$("#themhinhsp").val();
            var mota=$("#themmotasp").val();
            var themhinh1=hinhanh.split("\\");
            var themhinh=themhinh1[2];
            if (masp==""){
                alert("Chưa nhập mã sản phẩm");
                $("#themmasp").focus();
                return false;
            }
            if (lsp==0){
                alert("Chưa chọn loại sản phẩm");
                $("#themloaisp").focus();
                return false;
            }
            if (nsx==0){
                alert("Chưa chọn nhà sản xuất");
                $("#themnsxsp").focus();
                return false;
            }
            if (tensp==""){
                alert("Chưa nhập tên sản phẩm");
                $("#themtensp").focus();
                return false;
            }
            if (mota==""){
                alert("Chưa nhập mô tả sản phẩm");
                $("#themmotasp").focus();
                return false;
            }
            $.post("./xulysanpham.php",{kieu:'themsp',masp:masp,lsp:lsp,nsx:nsx,tensp:tensp,themhinh:themhinh,mota:mota},function(data){
                if (data==0)
                    alert("Mã sản phẩm đã tồn tại");
                else{
                    alert("Thêm thành công");
                    location.replace("./quanly.php?idchucnang=SP");
                }
            })
        });
        $("#themhinhsp").change(function(){
            var fileInput = document.getElementById('themhinhsp');
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