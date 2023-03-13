
<link rel="stylesheet" href="../css/nsx1.css">
<div class="container tk">
    <div class="row tieudensx">
        <div class="col-md-12">Xem thông tin nhân viên</div>
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
                <input readonly value="<?php echo $r1[2] ?>" class="form-control" type="text" id="suahonv" placeholder="Nhập họ khách hàng"  />
            </div>     
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Tên</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <input readonly value="<?php echo $r1[3] ?>" class="form-control" type="text" id="suatennv" placeholder="Nhập tên khách hàng"  />
            </div>     
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Tài khoản</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <input readonly value="<?php echo $r1[1] ?>" class="form-control" type="text" id="suatknv" placeholder="Nhập tên khách hàng"  />
            </div>     
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Ngày sinh</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <input readonly value="<?php echo $r1[4] ?>" type="date" class="form-control" id="suansnv" placeholder="mm/dd/yyyy"></input>          
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
                <input value="Nam" readonly class="form-control" type="text" id="suatennv" placeholder="Nhập tên khách hàng"/>
                <?php }else{ ?>
                    <input value="Nữ" readonly class="form-control" type="text" id="suatennv" placeholder="Nhập tên khách hàng"/>
                <?php }?>
            </div>     
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Địa chỉ</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <textarea readonly rows="4" class="form-control" id="suadcnv" placeholder="Nhập địa chỉ khách hàng"><?php echo $r1[6] ?></textarea>          
            </div>     
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Số điện thoại</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <input readonly value="<?php echo $r1[7] ?>" type="number" rows="4" class="form-control" id="suasdtnv" placeholder="Nhập số điện thoại khách hàng"></input>          
            </div>     
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Tiền lương</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <input readonly value="<?php echo $r1[8] ?>" type="number" rows="4" class="form-control" id="suatlnv" placeholder="Nhập email khách hàng"></input>          
            </div>     
        </div>
        <div class="row div5">
            <div class="col-md-12 col-sm-12">
                
            </div>
        </div> 
        <?php } ?>  
    </div>
</div>