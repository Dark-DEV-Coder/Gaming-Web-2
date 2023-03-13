
<link rel="stylesheet" href="../css/nsx1.css">
<div class="container tk">
    <div class="row tieudensx">
        <div class="col-md-12">Thêm nhà sản xuất</div>
    </div>
    <div class="row themnsx">        
        <div class="row">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Tên nhà sản xuất</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <input class="form-control" type="text" id="themtennsx" placeholder="Nhập tên nhà sản xuất"  />
            </div>     
        </div>
        <div class="row div4">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Số điện thoại</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <input class="form-control" type="text" id="themsdtnsx" placeholder="Nhập số điện thoại nhà sản xuất"  />
            </div>     
        </div>
        <div class="row div4">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Địa chỉ</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <textarea rows="4" class="form-control" id="themdcnsx" placeholder="Nhập địa chỉ nhà sản xuất"></textarea>          
            </div>     
        </div>
        <div class="row div5">
            <div class="col-md-12 col-sm-12">
                <input type="button" id="nutthemnsx" value="Hoàn thành" class="btn btn-info btn-lg" />
            </div>
        </div>     
    </div>
</div>
<script>
    var sdt=/^0[0-9]{9}$/;
    $(document).ready(function(){
        $("#nutthemnsx").click(function(){
            var tennsx=$("#themtennsx").val();
            var sdtnsx=$("#themsdtnsx").val();
            var dcnsx=$("#themdcnsx").val();
            if (tennsx==""){
                alert("Chưa nhập tên nhà sản xuất");
                $("#themtennsx").focus();
                return false;
            }
            if (sdtnsx==""){
                alert("Chưa nhập số điện thoại nhà sản xuất");
                $("#themsdtnsx").focus();
                return false;
            }
            if (sdt.test(sdtnsx)==false){
                alert("Số điện thoại không hợp lệ");
                $("#themsdtnsx").focus();
                return false;
            }
            if (dcnsx==""){
                alert("Chưa nhập địa chỉ nhà sản xuất");
                $("#themdcnsx").focus();
                return false;
            }
            $.post("./xulynsx.php",{kieu:'themnsx',tennsx:tennsx,sdtnsx:sdtnsx,dcnsx:dcnsx},function(data){                
                if (data==1){
                    alert("Thêm thành công");
                    location.replace("./quanly.php?idchucnang=NSX");                    
                }
            });
        });
    });
</script>