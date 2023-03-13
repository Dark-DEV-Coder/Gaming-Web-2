
<link rel="stylesheet" href="../css/nsx1.css">
<div class="container tk">
    <div class="row tieudensx">
        <div class="col-md-12">Sửa khách hàng</div>
    </div>
    <?php
        if(isset($_GET['id'])){
            $id=$_GET['id'];
        require_once("./KetnoiCSDL.php");
        $p=new CheckConnection();
        $sql1="SELECT * from khach_hang WHERE MaKH='$id'";
        //echo $sql1;
        $rs1=$p->ExcuteQuery($sql1);
        $r1=mysqli_fetch_row($rs1);     
    ?>
    <div class="row themnsx">        
        <div class="row">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Họ</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <input value="<?php echo $r1[2] ?>" class="form-control" type="text" id="suahokh" placeholder="Nhập họ khách hàng"  />
            </div>     
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Tên</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <input value="<?php echo $r1[3] ?>" class="form-control" type="text" id="suatenkh" placeholder="Nhập tên khách hàng"  />
            </div>     
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Tài khoản</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <input value="<?php echo $r1[1] ?>" class="form-control" type="text" id="suatkkh" placeholder="Nhập tên khách hàng"  />
            </div>     
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Ngày sinh</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <input value="<?php echo $r1[4] ?>" type="date" class="form-control" id="suanskh" placeholder="mm/dd/yyyy"></input>          
            </div>     
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Giới tính</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
            <?php if($r1[5]==0){ ?>
                <input type="radio" value="0" checked="checked" id="modalLRInput20" name="gioitinh"><span style="margin-right:10%">Nam</span>
                <input type="radio" value="1" id="modalLRInput21" name="gioitinh"><span>Nữ</span>  
           <?php  }else{  ?> 
                <input type="radio" value="0"  id="modalLRInput20" name="gioitinh"><span style="margin-right:10%">Nam</span>
                <input type="radio" value="1" checked="checked" id="modalLRInput21" name="gioitinh"><span>Nữ</span>  
                <?php } ?>
            </div>     
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Địa chỉ</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <textarea rows="4" class="form-control" id="suadckh" placeholder="Nhập địa chỉ khách hàng"><?php echo $r1[6] ?></textarea>          
            </div>     
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Số điện thoại</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <input value="<?php echo $r1[7] ?>" type="text" rows="4" class="form-control" id="suasdtkh" placeholder="Nhập số điện thoại khách hàng"></input>          
            </div>     
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Email</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <input value="<?php echo $r1[8] ?>" type="text" rows="4" class="form-control" id="suaemailkh" placeholder="Nhập email khách hàng"></input>          
            </div>     
        </div>
        <div class="row div5">
            <div class="col-md-12 col-sm-12">
                <button type="button" value="<?php echo $r1[0] ?>" id="nutsuankh" value="Hoàn thành" class="btn btn-info btn-lg">Hoàn thành</button>
            </div>
        </div> 
        <?php } ?>  
    </div>
</div>
<script>
    var sdt=/^0[0-9]{9}$/;
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    $(document).ready(function(){
        $("#nutsuankh").click(function(){
            var makh=$('#nutsuankh').val();
            var tenkh=$("#suatenkh").val();
            var hokh=$("#suahokh").val();
            var tkkh=$("#suatkkh").val();
            var sdtkh=$("#suasdtkh").val();
            var dckh=$("#suadckh").val();
            var emailkh=$("#suaemailkh").val();
            var nskh=$("#suanskh").val();
            var gtkh=document.getElementsByName("gioitinh");
            var gt = 0;
            for (var i = 0; i < gtkh.length; i++){
                if (gtkh[i].checked === true){
                    gt = gtkh[i].value;
                }
            }
            if (hokh==""){
                alert("Chưa họ khách hàng");
                $("#suahokh").focus();
                return false;
            }
            if (tenkh==""){
                alert("Chưa nhập tên khách hàng");
                $("#suatenkh").focus();
                return false;
            }
            if (tkkh==""){
                alert("Chưa nhập tài khoản khách hàng");
                $("#suatkkh").focus();
                return false;
            }
            if (nskh==""){
                alert("Chưa nhập ngày sinh khách hàng");
                $("#suanskh").focus();
                return false;
            }
            if (dckh==""){
                alert("Chưa nhập địa chỉ khách hàng");
                $("#suadckh").focus();
                return false;
            }
            if (emailkh==""){
                alert("Chưa eamil khách hàng");
                $("#suaemailkh").focus();
                return false;
            }
            if(!filter.test(emailkh)) {
                alert("Email của bạn không đúng định dạng. \nExample@gmail.com");
                $("#suaemailkh").focus();
                return false;
            }
            if (sdtkh==""){
                alert("chưa nhập Số điện thoại");
                $("#suasdtnv").focus();
                return false;
            }
            if (sdt.test(sdtkh)==false){
                alert("Số điện thoại không hợp lệ");
                $("#suasdtkh").focus();
                return false;
            }
            $.post("./xulykh.php",{kieu:'suakh',tkkh:tkkh,makh:makh,hokh:hokh,tenkh:tenkh,gtkh:gt,nskh:nskh,dckh:dckh,emailkh:emailkh,sdtkh:sdtkh},function(data){    
                //console.log(data);
                //alert(data);            
                if (data==1){
                    alert("Sửa thành công");
                    location.replace("./quanly.php?idchucnang=KH");
                }else if(data==2){
                    alert('Mã tài khoản không tồn tại');
                }else{
                    alert('Tài khoản đã tồn tại khách hàng');
                }
            });
        });
    });
</script>