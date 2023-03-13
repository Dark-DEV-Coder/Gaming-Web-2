
<link rel="stylesheet" href="../css/nsx1.css">
<div class="container tk">
    <div class="row tieudensx">
        <div class="col-md-12">Thêm khuyến mãi</div>
    </div>
    <div class="row themnsx">        
        <div class="row">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Tên khuyến mãi</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <input class="form-control" type="text" id="themtenkm" placeholder="Nhập tên chương trình khuyến mãi"  />
            </div>     
        </div>     
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Ngày bắt đầu</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <input type="date" class="form-control" id="themnbd" placeholder="mm/dd/yyyy"></input>          
            </div>     
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Ngày kết thúc</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <input type="date" class="form-control" id="themnkt" placeholder="mm/dd/yyyy"></input>          
            </div>     
        </div>
        <div class="row div5">
            <div class="col-md-12 col-sm-12">
                <input type="button" id="nutthemkm" value="Hoàn thành" class="btn btn-info btn-lg" />
            </div>
        </div>
    </div>
</div>
<script>
    var sdt=/^0[0-9]{9}$/;
    $(document).ready(function(){
        $("#nutthemkm").click(function(){
            var tenkm=$("#themtenkm").val();
            var nbd=$("#themnbd").val();
            var nkt=$("#themnkt").val();
            if (tenkm==""){
                alert("Chưa nhập tên khuyến mãi");
                $("#themtenkm").focus();
                return false;
            }
            if (nbd==""){
                alert("Chưa nhập ngày bắt đầu");
                $("#themnbd").focus();
                return false;
            }
            if (nkt==""){
                alert("Chưa nhập ngày kết thúc");
                $("#themnkt").focus();
                return false;
            }
            if(nbd>nkt){
                alert("ngày bắt đầu không được lớn hơn ngày kết thúc");
                $("#themnkt").focus();
                return false;
            }
            $.post("./xulykm.php",{kieu:'themkm',tenkm:tenkm,nbd:nbd,nkt:nkt},function(data){             
                //alert(data);
                if (data==1){
                    alert("Thêm thành công");
                    location.replace("./quanly.php?idchucnang=KM");                    
                }if(data==2){
                    alert("không thể tạo cho quá khứ");
                    //location.replace("./quanly.php?idchucnang=KM"); 
                }
            });
        });
    });
</script>