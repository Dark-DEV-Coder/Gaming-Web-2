
<link rel="stylesheet" href="../css/nsx1.css">
<div class="container tk">
    <div class="row tieudensx">
        <div class="col-md-12">Sửa nhân viên</div>
    </div>
    <?php
        if(isset($_GET['id'])){
            $id=$_GET['id'];
        require_once("./KetnoiCSDL.php");
        $p=new CheckConnection();
        $sql1="SELECT * from nhan_vien WHERE MaNV='$id'";
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
                <input value="<?php echo $r1[2] ?>" class="form-control" type="text" id="suahonv" placeholder="Nhập họ khách hàng"  />
            </div>     
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Tên</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <input value="<?php echo $r1[3] ?>" class="form-control" type="text" id="suatennv" placeholder="Nhập tên khách hàng"  />
            </div>     
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Tài khoản</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <input value="<?php echo $r1[1] ?>" class="form-control" type="text" id="suatknv" placeholder="Nhập tên khách hàng"  />
            </div>     
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Ngày sinh</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <input value="<?php echo $r1[4] ?>" type="date" class="form-control" id="suansnv" placeholder="mm/dd/yyyy"></input>          
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
                <input type="radio" value="0" checked="checked" id="modalLRInput20" name="gioitinh1"><span style="margin-right:10%">Nam</span>
                <input type="radio" value="1" id="modalLRInput21" name="gioitinh1"><span>Nữ</span>  
           <?php  }else{  ?> 
                <input type="radio" value="0"  id="modalLRInput20" name="gioitinh1"><span style="margin-right:10%">Nam</span>
                <input type="radio" value="1" checked="checked" id="modalLRInput21" name="gioitinh1"><span>Nữ</span>  
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
                <textarea rows="4" class="form-control" id="suadcnv" placeholder="Nhập địa chỉ khách hàng"><?php echo $r1[6] ?></textarea>          
            </div>     
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Số điện thoại</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <input value="<?php echo $r1[7] ?>" type="text" rows="4" class="form-control" id="suasdtnv" placeholder="Nhập số điện thoại khách hàng"></input>          
            </div>     
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Tiền lương</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <input value="<?php echo $r1[8] ?>" type="number" rows="4" class="form-control" id="suatlnv" placeholder="Nhập email khách hàng"></input>          
            </div>     
        </div>
        <div class="row div5">
            <div class="col-md-12 col-sm-12">
            <button type="button" value="<?php echo $r1[0] ?>" id="nutsuanv" value="Hoàn thành" class="btn btn-info btn-lg">Hoàn thành</button>
            </div>
        </div> 
        <?php } ?>  
    </div>
</div>
<script>
    var sdt=/^0[0-9]{9}$/;
    $(document).ready(function(){
        $("#nutsuanv").click(function(){
            var manv=$('#nutsuanv').val();
            var tennv=$("#suatennv").val();
            var honv=$("#suahonv").val();
            var tknv=$("#suatknv").val();
            var sdtnv=$("#suasdtnv").val();
            var dcnv=$("#suadcnv").val();
            var tlnv=$("#suatlnv").val();
            var nsnv=$("#suansnv").val();
            var gtnv=document.getElementsByName("gioitinh1");
            var gt = 0;
            for (var i = 0; i < gtnv.length; i++){
                if (gtnv[i].checked === true){
                    gt = gtnv[i].value;
                }
            }
            if (honv==""){
                alert("Chưa nhập họ nhân viên");
                $("#suahonv").focus();
                return false;
            }
            if (tennv==""){
                alert("Chưa nhập tên nhân viên");
                $("#suatennv").focus();
                return false;
            }
            if (tknv==""){
                alert("Chưa nhập tài khoản nhân viên");
                $("#suatknv").focus();
                return false;
            }
            if (nsnv==""){
                alert("Chưa nhập ngày sinh nhân viên");
                $("#suansnv").focus();
                return false;
            }
            if (dcnv==""){
                alert("Chưa nhập địa chỉ nhân viên");
                $("#suadcnv").focus();
                return false;
            }
            if (tlnv==""){
                alert("Chưa tiền lương nhân viên");
                $("#suaemailkh").focus();
                return false;
            }
            if (sdt.test(sdtnv)==false){
                alert("Số điện thoại không hợp lệ");
                $("#suasdtkh").focus();
                return false;
            }
            $.post("./xulynhanvien.php",{kieu:'suanv',tknv:tknv,manv:manv,honv:honv,tennv:tennv,gtnv:gt,nsnv:nsnv,dcnv:dcnv,tlnv:tlnv,sdtnv:sdtnv},function(data){    
                //console.log(data);
                //alert(data);            
                if (data==1){
                    alert("Sửa thành công");
                    location.replace("./quanly.php?idchucnang=NV");
                }else if(data==2){
                    alert('Mã tài khoản không tồn tại');
                }else{
                    alert('Tài khoản đã tồn tại nhân viên');
                }
            });
        });
    });
</script>