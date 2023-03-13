
<link rel="stylesheet" href="../css/nsx1.css">
<div class="container tk">
    <div class="row tieudensx">
        <div class="col-md-12">Thêm khách hàng</div>
    </div>
    <div class="row themnsx">        
        <div class="row">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Họ</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <input class="form-control" type="text" id="themhokh" placeholder="Nhập họ khách hàng"  />
            </div>     
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Tên</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <input class="form-control" type="text" id="themtenkh" placeholder="Nhập tên khách hàng"  />
            </div>     
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Ngày sinh</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <input type="date" class="form-control" id="themnskh" placeholder="mm/dd/yyyy"></input>          
            </div>     
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Giới tính</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
            <input type="radio" value="0" checked="checked" id="modalLRInput20" name="gioitinh"><span style="margin-right:10%">Nam</span>
            <input type="radio" value="1" id="modalLRInput21" name="gioitinh"><span>Nữ</span>          
            </div>     
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Địa chỉ</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <textarea rows="4" class="form-control" id="themdckh" placeholder="Nhập địa chỉ khách hàng"></textarea>          
            </div>     
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Số điện thoại</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <input type="text" rows="4" class="form-control" id="themsdtkh" placeholder="Nhập số điện thoại khách hàng"></input>          
            </div>     
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Email</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <input type="text" rows="4" class="form-control" id="thememailkh" placeholder="Nhập email khách hàng"></input>          
            </div>     
        </div>
        <div class="row div5">
            <div class="col-md-12 col-sm-12">
                <input type="button" id="nutthemnkh" value="Hoàn thành" class="btn btn-info btn-lg" />
            </div>
        </div>     
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#nutthemnkh").click(function(){
            var sdt=/^0[0-9]{9}$/;
            var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/; 
            var tenkh=$("#themtenkh").val();
            var hokh=$("#themhokh").val();
            var sdtkh=$("#themsdtkh").val();
            var dckh=$("#themdckh").val();
            var emailkh=$("#thememailkh").val();
            var nskh=$("#themnskh").val();
            var gtkh=document.getElementsByName("gioitinh");
            var gt = 0;
            for (var i = 0; i < gtkh.length; i++){
                if (gtkh[i].checked === true){
                    gt = gtkh[i].value;
                }
            }
            if (hokh==""){
                alert("Chưa họ khách hàng");
                $("#themhokh").focus();
                return false;
            }
            if (tenkh==""){
                alert("Chưa nhập tên khách hàng");
                $("#themtenkh").focus();
                return false;
            }
            if (nskh==""){
                alert("Chưa nhập ngày sinh khách hàng");
                $("#themnskh").focus();
                return false;
            }
            if (dckh==""){
                alert("Chưa nhập địa chỉ khách hàng");
                $("#themdckh").focus();
                return false;
            }
            if (emailkh==""){
                alert("Chưa nhập eamil khách hàng");
                $("#thememailkh").focus();
                return false;
            }
            if(!filter.test(emailkh)){
                alert("Email của bạn không đúng định dạng. \nExample@gmail.com");
                $("#thememailkh").focus();
                return false;
            }
            if(sdtkh==""){
                alert("Chưa nhập sđt khách hàng");
                $("#themsdtkh").focus();
                return false;
            }
            if (sdt.test(sdtkh)==false){
                alert("Số điện thoại không hợp lệ");
                $("#themsdtkh").focus();
                return false;
            }
            $.post("./xulykh.php",{kieu:'themkh',hokh:hokh,tenkh:tenkh,gtkh:gt,nskh:nskh,dckh:dckh,emailkh:emailkh,sdtkh:sdtkh},function(data){    
                alert(data);            
                if (data==1){
                    alert("Thêm thành công");
                    location.replace("./quanly.php?idchucnang=KH");                    
                }
            });
        });
    });
</script>