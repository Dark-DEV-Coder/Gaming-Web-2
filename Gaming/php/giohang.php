<?php require_once "./header.php"; ?>

<body style="background-color: #00000">

<div id="showcart" class="cart_section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="cart_container">
                    <?php if(isset($_SESSION['cart'])){ ?>
                    <div class="cart_title" style="color:white; ">Giỏ hàng<small> (<?php echo $_SESSION['stt']; ?> sản phẩm trong giỏ hàng) </small></div>
                    <?php }else{ ?>
                        <div class="cart_title" style="color:white; ">Giỏ hàng<small> (0 sản phẩm trong giỏ hàng) </small></div>
                        <?php } ?>
                    <?php if(isset($_SESSION['cart'])){ 
                        foreach($_SESSION['cart'] as $key => $value){
                        //var_dump($key);
                        ?>
                    <div class="cart_items">
                        <ul class="cart_list">
                            <li class="cart_item clearfix">
                                <div class="cart_item_image"><img src="../img/<?php echo $value['HinhAnh'] ?>" alt=""></div>
                                <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                    <div class="cart_item_name cart_info_col">
                                        <div class="cart_item_title">Tên sản phẩm</div>
                                        <div style="width:200px" class="cart_item_text"><?php echo $value['Ten'] ?></div>
                                    </div>
                                    <div class="cart_item_quantity cart_info_col">
                                        <div class="cart_item_title">Số lượng</div>
                                        <div class="cart_item_text"><button  onclick="cart(this)" id="<?php echo $value['MaNhomSP'] ?>" style="width:20px;background-color:#009432;border:1px solid #009432" type="button" class="tru btn-warning" value="-1">-</button><span style="width:40px; margin:auto; text-align:center"><?php echo $value['SoLuong'] ?></span><button onclick="cart(this)" id="<?php echo $value['MaNhomSP'] ?>" style="width:20px;background-color:#009432;border:1px solid #009432" type="button" class="cong btn-warning" value="1">+</button></div>
                                    </div>
                                    <div class="cart_item_price cart_info_col">
                                        <div class="cart_item_title">Giá gốc</div>
                                        <div class="cart_item_text"><?php echo number_format($value['GiaBan']) ?></div>
                                    </div>
                                    <div class="cart_item_price cart_info_col">
                                        <div class="cart_item_title">Giá khuyến mãi</div>
                                        <div class="cart_item_text"><?php echo number_format($value['GiaKM']) ?></div>
                                    </div>
                                    <div class="cart_item_total cart_info_col">
                                        <div class="cart_item_title">Tổng cộng</div>
                                        <div class="cart_item_text"><?php echo number_format($value['TongCong']) ?></div>
                                    </div>
                                    <div class="cart_item_total cart_info_col">
                                        <div class="cart_item_title">Xóa sản phẩm</div>
                                        <div class="cart_item_text"><a style="color:black" href="xoagiohang.php?dele=<?php echo $value['MaNhomSP'] ?>"><i class="fas fa-trash-alt"></i></a></div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                        <?php } ?>
                    <div class="order_total">
                        <div class="order_total_content text-md-right">
                            <div class="order_total_title">Tổng tiền giỏ hàng:</div>
                            <div class="order_total_amount"><?php echo number_format($_SESSION['odertotal']) ?> đồng</div>
                        </div>
                    </div>
                    <?php } ?>
                    <?php 
                        if(isset($_SESSION['taikhoan'])) { 
                            if($_SESSION['taikhoan']['quyen']=='KH') {
                    ?>
                        <div class="cart_buttons"> <button type="button" class="button1 cart_button_checkout" data-toggle="modal" data-target="#modalthanhtoan">Mua hàng</button> </div>
                    <?php   }
                        } else {
                    ?>
                        <div class="cart_buttons"> <button type="button" class="button1 cart_button_checkout" data-toggle="modal" data-target="#modalthanhtoan">Mua hàng</button> </div>
                    <?php   
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
      <!--====================== Bảng chi tiết sản phẩm đã đượck xử lý ===============================
          <div id="detail_product" class="detail_product product-info ">
          <h2>MỘT THUỞ YÊU NGƯỜI (LOFI MUSIC) - VICKY NHUNG</h2>
          <p>*Bài hát "Một Thuở Yêu Người" sẽ mở đầu cho Dự án Chill With Vicky Nhung (season 2) gồm 5 ca khúc được ra mắt vào 20h tối thứ 7 hàng tuần. Nếu Season 1 là những ca khúc do Vicky sáng tác và thể hiện trên nền Piano nhẹ nhàng sâu lắng, thì season 2 là những bản tình ca da diết của mối tình đầy phong sương, của mảng ký ức đau lòng tưởng đã lãng quên, được làm mới lại theo phong cách lofi hiện đại.
            Ký Ức - Memory cũng chính là chủ đề của season lần này, Vicky mong rằng sẽ có thể đưa mọi người quay về miền ký ức ngày đó, để nhớ ta từng có những ngày yêu nồng nàn đến thế! 
            * Cảm ơn Góc Của Tùng, cảm ơn khán giả yêu nhạc và những người bạn đã hết mình hỗ trợ Vicky trong dự án này.  Enjoy nhé mọi người ^_^. Đừng quên Like và Share để tiếp thêm động lực cho Vicky tạo ra những sản phẩm tuyệt vời hơn nữa nhé  (◍•ᴗ•◍)❤!</p>
            <a  onclick="toggle_background();"> Close</a>
         </div> -->
<!--Modal: Login / Register Form-->
<?php if(!isset($_SESSION['taikhoan'])){ ?>
<form id="oderform" method="POST">
<div class="modal fade" id="modalthanhtoan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog cascading-modal" role="document">
        <!--Content-->
        <div class="modal-content">

        <!--Modal cascading tabs-->
        <div class="modal-c-tabs">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs md-tabs tabs-2 light-blue darken-3" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#panel9" role="tab"><i class="fas fa-user mr-1"></i>
                Thông tin thanh toán</a>
            </li>
            </ul>

            <!-- Tab panels -->
            <div class="tab-content">
            <!--Panel 7-->
            <div class="tab-pane fade in show active" id="panel9" role="tabpanel">
            <div class="modal-body">
                <div class="md-form form-sm mb-5">
                    <i class="fa fa-users"></i>
                    <label data-error="wrong" data-success="right" for="modalLRInput23" style="margin-right:46%">Họ</label>
                    <i class="fa fa-users"></i>
                    <label data-error="wrong" data-success="right" for="modalLRInput24">Tên</label>
                    <br>
                    <input name="ho" type="text" id="modalLRInput23" class="form-control form-control-sm validate hocls" style="width:45%; float:left; margin-right:10%">
                    <input name="ten" type="text" id="modalLRInput24" class="form-control form-control-sm validate tencls" style="width:45%">
                </div>
                <div class="md-form form-sm mb-5">
                    <i class="fas fa-envelope prefix"></i>
                    <label data-error="wrong" data-success="right" for="modalLRInput25">Email</label>
                    <input name="email" type="email" id="modalLRInput25" class="form-control form-control-sm validate emailcls">
                </div>
                <div class="md-form form-sm mb-5">
                    <i class="fa fa-phone-square"></i>
                    <label data-error="wrong" data-success="right" for="modalLRInput26">Số điện thoại</label>
                    <input name="sdt"  type="text" id="modalLRInput26" class="form-control form-control-sm validate sdtcls">
                </div>
                
                <div class="md-form form-sm mb-5">
                    <i class="fa fa-address-book"></i>
                    <label data-error="wrong" data-success="right" for="modalLRInput27">Địa chỉ</label>
                    <input name="diachi" type="text" id="modalLRInput27" class="form-control form-control-sm validate diachicls">
                </div>
                <div class="text-center form-sm mt-2">
                    <button type="button" id="btnoder" class="btn btn-info">Thanh toán<i class="fas fa-sign-in ml-1"></i></button>
                </div>
                
                </div>
                <!--Footer-->
                <div class="modal-footer">
                
                <button type="button" class="btn btn-outline-info waves-effect ml-auto" data-dismiss="modal">Close</button>
                </div>

            </div>
            <!--/.Panel 7-->
                <!--Footer-->
                
            </div>
            <!--/.Panel 8-->
            </div>

        </div>
        </div>
        <!--/.Content-->
    </div>
</div>
</form>
<?php }else{ ?>
<form id="oderform" method="POST">
<div class="modal fade" id="modalthanhtoan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog cascading-modal" role="document">
        <!--Content-->
        <div class="modal-content">

        <!--Modal cascading tabs-->
        <div class="modal-c-tabs">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs md-tabs tabs-2 light-blue darken-3" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#panel9" role="tab"><i class="fas fa-user mr-1"></i>
                Thông tin thanh toán</a>
            </li>
            </ul>

            <!-- Tab panels -->
            <div class="tab-content">
            <!--Panel 7-->
            <div class="tab-pane fade in show active" id="panel9" role="tabpanel">
            <div class="modal-body">
                <div class="md-form form-sm mb-5">
                    <i class="fa fa-users"></i>
                    <label data-error="wrong" data-success="right" for="modalLRInput23" style="margin-right:46%">Họ</label>
                    <i class="fa fa-users"></i>
                    <label data-error="wrong" data-success="right" for="modalLRInput24">Tên</label>
                    <br>
                    <input value="<?php echo $_SESSION['taikhoan']['ho'] ?>" name="ho" type="text" id="modalLRInput23" class="form-control form-control-sm validate hocls" style="width:45%; float:left; margin-right:10%">
                    <input value="<?php echo $_SESSION['taikhoan']['ten'] ?>" name="ten" type="text" id="modalLRInput24" class="form-control form-control-sm validate tencls" style="width:45%">
                </div>
                <div class="md-form form-sm mb-5">
                    <i class="fas fa-envelope prefix"></i>
                    <label data-error="wrong" data-success="right" for="modalLRInput25">Email</label>
                    <input value="<?php echo $_SESSION['taikhoan']['email'] ?>" name="email" type="email" id="modalLRInput25" class="form-control form-control-sm validate emailcls">
                </div>
                <div class="md-form form-sm mb-5">
                    <i class="fa fa-phone-square"></i>
                    <label data-error="wrong" data-success="right" for="modalLRInput26">Số điện thoại</label>
                    <input value="<?php echo $_SESSION['taikhoan']['sdt'] ?>" name="sdt"  type="text" id="modalLRInput26" class="form-control form-control-sm validate sdtcls">
                </div>
                
                <div class="md-form form-sm mb-5">
                    <i class="fa fa-address-book"></i>
                    <label data-error="wrong" data-success="right" for="modalLRInput27">Địa chỉ</label>
                    <input value="<?php echo $_SESSION['taikhoan']['diachi'] ?>" name="diachi" type="text" id="modalLRInput27" class="form-control form-control-sm validate diachicls">
                </div>
                <div class="text-center form-sm mt-2">
                    <button type="button" id="btnoder" class="btn btn-info">Thanh toán<i class="fas fa-sign-in ml-1"></i></button>
                </div>
                
                </div>
                <!--Footer-->
                <div class="modal-footer">
                
                <button type="button" class="btn btn-outline-info waves-effect ml-auto" data-dismiss="modal">Close</button>
                </div>

            </div>
            <!--/.Panel 7-->
                <!--Footer-->
                
            </div>
            <!--/.Panel 8-->
            </div>

        </div>
        </div>
        <!--/.Content-->
    </div>
</div>
</form>
<?php } ?>
<!--Modal: Login / Register Form-->

              






</body>
<?php require_once "./footer.php"; ?>