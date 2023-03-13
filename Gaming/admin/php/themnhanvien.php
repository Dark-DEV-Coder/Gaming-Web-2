
<link rel="stylesheet" href="../css/nsx1.css">
<div class="container tk">
    <div class="row tieudensx">
        <div class="col-md-12">Thêm nhân viên</div>
    </div>
    <div class="row themnsx">        
        <div class="row">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Họ</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <input class="form-control" type="text" id="themhonv" placeholder="Nhập họ nhân viên"  />
            </div>     
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Tên</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <input class="form-control" type="text" id="themtennv" placeholder="Nhập tên nhân viên"  />
            </div>     
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Ngày sinh</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <input type="date" class="form-control" id="themnsnv" placeholder="mm/dd/yyyy"></input>          
            </div>     
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Giới tính</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
            <input type="radio" value="0" checked="checked" id="modalLRInput20" name="gioitinhnv"><span style="margin-right:10%">Nam</span>
            <input type="radio" value="1" id="modalLRInput21" name="gioitinhnv"><span>Nữ</span>          
            </div>     
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Địa chỉ</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <textarea rows="4" class="form-control" id="themdcnv" placeholder="Nhập địa chỉ nhân viên"></textarea>          
            </div>     
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Số điện thoại</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <input type="text" rows="4" class="form-control" id="themsdtnv" placeholder="Nhập số điện thoại nhân viên"></input>          
            </div>     
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Tiền lương</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <input type="number" rows="4" class="form-control" id="themtlnv" placeholder="Nhập tiền lương"></input>          
            </div>     
        </div>
        <div class="row div5">
            <div class="col-md-12 col-sm-12">
                <input type="button" id="nutthemnnv" value="Hoàn thành" class="btn btn-info btn-lg" />
            </div>
        </div>     
    </div>
</div>
<script>
    var sdt=/^0[0-9]{9}$/;
    $(document).ready(function(){
        $("#nutthemnnv").click(function(){
            var tennv=$("#themtennv").val();
            var honv=$("#themhonv").val();
            var sdtnv=$("#themsdtnv").val();
            var dcnv=$("#themdcnv").val();
            var tlnv=$("#themtlnv").val();
            var nsnv=$("#themnsnv").val();
            var gtnv=document.getElementsByName("gioitinhnv");
            var gt = 0;
            for (var i = 0; i < gtnv.length; i++){
                if (gtnv[i].checked === true){
                    gt = gtnv[i].value;
                }
            }
            if (honv==""){
                alert("Chưa họ nhân viên");
                $("#themhonv").focus();
                return false;
            }
            if (tennv==""){
                alert("Chưa nhập tên nhân viên");
                $("#themtennv").focus();
                return false;
            }
            if (nsnv==""){
                alert("Chưa nhập ngày sinh nhân viên");
                $("#themnsnv").focus();
                return false;
            }
            if (dcnv==""){
                alert("Chưa nhập địa chỉ nhân viên");
                $("#themdcnv").focus();
                return false;
            }
            if (tlnv==""){
                alert("Chưa tiền lương nhân viên");
                $("#themtlnv").focus();
                return false;
            }
            if(sdtnv==""){
                alert("Chưa nhập sđt khách hàng");
                $("#themsdtnv").focus();
                return false;
            }
            if (sdt.test(sdtnv)==false){
                alert("Số điện thoại không hợp lệ");
                $("#themsdtnv").focus();
                return false;
            }
            $.post("./xulynhanvien.php",{kieu:'themnv',honv:honv,tennv:tennv,gtnv:gt,nsnv:nsnv,dcnv:dcnv,tlnv:tlnv,sdtnv:sdtnv},function(data){    
                alert(data);            
                if (data==1){
                    alert("Thêm thành công");
                    location.replace("./quanly.php?idchucnang=NV");                    
                }
            });
        });
    });
</script>