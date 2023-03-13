<?php require_once "./header.php"; 
    $id = $_GET['id'];
    $sql = "SELECT * FROM `san_pham` WHERE MaNhomSP = '$id'";
    $res = $p->ExcuteQuery($sql);
    $obj = $res->fetch_object();
    $sql1 = "SELECT nsx.TenNSX FROM `san_pham` sp, `nha_san_xuat` nsx WHERE sp.MaNSX=nsx.MaNSX and  MaNhomSP = '$id'";
    $res1 = $p->ExcuteQuery($sql1);
    $obj1 = $res1->fetch_object();
?>

                <div class = "products">
                    <div class = "container">
                        
                        
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-12" style="width:50%; height: 100%;margin: 0 auto;border-radius: 50%;">
                                <img src="../img/<?php echo $obj->HinhAnh; ?>" style="width:100%; height:100%; box-shadow: 0px 0px 20px 0px #9e9e9e;" alt="">
                            </div>
                            <div class="col-md-6 col-sm-12 col-12" style="color:white; padding:10px 20px 0px 30px;background:;">
                                <span style="font-size:20px; color:#009432"><?php echo $obj->Ten; ?></span>
                                <ul style="font-size:18px">
                                    <li style="font-weight:bold; margin-top:10px; margin-bottom:20px; color:#009432">Nhà sản xuất : <span style="color:white; font-weight:normal"><?php echo $obj1->TenNSX; ?></span></li> 
                                    <li style="font-size:20px; margin-bottom:10px; color:#009432">Mô tả: <span style="color:white;" ><?php echo $obj->MoTa; ?></span></li>
                                </ul>
                                
                                <br>
                                <?php if($obj->GiaKM > 0) { ?>
                                    <span style="font-size:20px; text-decoration-line:line-through">Giá cũ: <?php echo number_format($obj->GiaBan); ?> đồng</span>
                                    <span style="font-size:20px; color:#009432">Giá khuyến mãi: <?php echo number_format($obj->GiaKM); ?> đồng</span>
                                <?php } else { ?>
                                    <span style="font-size:20px; color:#009432 ">Giá sản phẩm: <?php echo number_format($obj->GiaBan); ?> đồng</span>
                                <?php } ?>
                                <?php if($obj->SoLuong < 1) { ?>
                                        <div class="cart_buttons"> <button type="button" name="<?php echo $id; ?>" class="button1 cart_button_checkout">Hết hàng</button> </div>
                                <?php } else {
                                            if(isset($_SESSION['cart'][$id])) {
                                                if((int)$obj->SoLuong>$_SESSION['cart'][$id]['SoLuong']) {
                                ?>
                                                    <div class="cart_buttons"> <button type="button" id="addgiohang1" name="<?php echo $id; ?>" class="button1 cart_button_checkout">Mua ngay</button> </div>
                                <?php               
                                                } else {
                                ?>
                                                    <div class="cart_buttons"> <button type="button" name="<?php echo $id; ?>" class="button1 cart_button_checkout">Hết hàng</button> </div>
                                <?php 
                                                }
                                            } else {
                                ?>
                                                <div class="cart_buttons"> <button type="button" id="addgiohang1" name="<?php echo $id; ?>" class="button1 cart_button_checkout">Mua ngay</button> </div>
                                <?php 
                                            }
                                        }
                                ?>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-md-9 col-sm-12 col-12" style="color:white; padding:50px; font-size:20px; height:700px; overflow-y: auto; overflow-x: hidden;">
                            <?php 
                                $sqldg = "SELECT dg.*, kh.Ho, kh.Ten FROM danh_gia_sp dg, tai_khoan tk, khach_hang kh WHERE dg.MaNhomSP='$id' and tk.MaTK = dg.MaTK and tk.MaTK = kh.MaTK";
                                $resdg = $p->ExcuteQuery($sqldg);
                                $resdg1 = $p->ExcuteQuery($sqldg);
                                $tongsao = 0;
                                while($data = mysqli_fetch_assoc($resdg)) {
                                    $tongsao += $data['DanhGia'];
                                }
                                $count = mysqli_num_rows($resdg);
                                if($count!=0) {
                                    $tongsosao = (int)$tongsao/(int)$count;
                                } else {
                                    $tongsosao = 0;
                                }
                                if($count!=0) {
                            ?>
                                <div class="col-md-6 col-sm-6 col-6">
                                <span style="font-size:20px; color:#009432">Tổng số bình  : <span style="color:white"><?php echo $count; ?>  <i class="fa fa-comment"></i></span></span> 
                                </div>
                                <div class="col-md-6 col-sm-6 col-6">
                                <span style="font-size:20px; color:#009432">Tổng số sao : <span style="color:white"><?php echo $tongsosao; ?> <i class="fa fa-star"></i></span></span>
                                </div>
                                
                                <?php 
                                    while($data = mysqli_fetch_assoc($resdg1)) { 
                                        
                                ?>
                                        
                                            <div class="col-md-12 col-sm-12 col-12" style= "margin-top:50px">
                                            <span style="font-size:20px; color:#009432"><?php echo $data['Ho']; ?> </span> <span style="font-size:20px; color:#009432"><?php echo $data['Ten']; ?></span>  
                                            <?php if(empty($data['BinhLuan'])) { ?>
                                                <span> <?php echo $data['DanhGia']; ?><i class="fa fa-star"></i></span> <span>:</span>
                                            <?php } else { ?>
                                                <span> <?php echo $data['DanhGia']; ?><i class="fa fa-star"></i></span> <span>:</span>
                                                <span><?php echo $data['BinhLuan']; ?></i></span> 
                                            <?php } ?>
                                            <br>
                                            
                                            </div>
                                <?php 
                                    } 
                                ?>
                            <?php  
                                } else {
                            ?>
                                <span style="font-size:20px; color:#009432">Chưa có bình luận</span>
                            <?php 
                                }
                            ?>
                        </div>
                    </div>
                        
                    </div>
                    
                </div>
        


<?php require_once "./footer.php"; ?>