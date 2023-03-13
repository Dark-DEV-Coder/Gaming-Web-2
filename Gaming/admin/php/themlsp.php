
<link rel="stylesheet" href="../css/loaisp1.css">
<div class="container tk">
    <div class="row tieudelsp">
        <div class="col-md-12">Thêm loại sản phẩm</div>
    </div>
    <div class="row themlsp">        
        <div class="row">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Tên loại sản phẩm</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <input class="form-control" type="text" id="themtenlsp" placeholder="Nhập tên loại sản phẩm"  />
            </div>     
        </div>        
        <div class="row div5">
            <div class="col-md-12 col-sm-12">
                <input type="button" id="nutthemlsp" value="Hoàn thành" class="btn btn-info btn-lg" />
            </div>
        </div>     
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#nutthemlsp").click(function(){
            var tenlsp=$("#themtenlsp").val();
            if (tenlsp==""){
                alert("Chưa nhập tên loại sản phẩm");
                $("#themtenlsp").focus();
                return false;
            }           
            $.post("./xulyloaisp.php",{kieu:'themlsp',tenlsp:tenlsp},function(data){                
                if (data==1){
                    alert("Thêm thành công");
                    location.replace("./quanly.php?idchucnang=LSP");                    
                }
            });
        });
    });
</script>