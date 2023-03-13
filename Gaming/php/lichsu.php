a<?php 
    $stt=1;
?>
<?php require_once "./header.php"; ?>
<body>
<div id="bodyhistory" style="overflowx:hidden;position:fixed;with:100%;height:100%;top:12%;left:20%">
    </div>
<div class="container">
<?php if(isset($_SESSION['taikhoan'])){ ?>
<table class="table table-hover table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Mã hóa đơn</th>
      <th scope="col">Ngày lập</th>
      <th scope="col">Tổng tiền</th>
      <th scope="col">Tổng tiền khuyến mãi</th>
      <th scope="col">Tổng tiền phải trả</th>
      <th scope="col">Tình trạng</th>
      <th scope="col">Chi tiết</th>
    </tr>
  </thead>
  <tbody>
    <tr>
    <?php if(isset($_SESSION['taikhoan'])){
      $sql="SELECT * FROM hoa_don WHERE MaKH='".$_SESSION['taikhoan']['makhachhang']."' and TinhTrang!=0";
      $res=$p->ExcuteQuery($sql);
            while($row=mysqli_fetch_array($res)){ ?>
      <tr>
      <td><?php echo $stt++ ?></td>
      <td><?php echo $row['MaHD'] ?></td>
      <td><?php  echo $row['NgayLapHD'] ?></td>
      <td><?php  echo number_format($row['TongTien']) ?></td>
      <td><?php  echo number_format($row['TongTienKM']) ?></td>
      <td><?php  echo number_format($row['TongPhaiTra']) ?></td>
    <?php if ($row[12]==1) { ?>
        <td class='hd1' style='color:red;font-weight:600;'>Đang chờ xác nhận</td>
    <?php } ?>
   <?php  if ($row[12]==2){  ?>
        <td class='hd1' style='color:rgb(250, 155, 12);font-weight:600;'>Đã xác nhận</td>
    <?php } ?>   
    <?php if ($row[12]==3){ ?>
        <td class='hd1' style='color:#c2d32f;font-weight:600;'>Đang giao</td>
    <?php } ?>    
    <?php if ($row[12]==4){ ?>
        <td class='hd1' style='color:rgb(22, 184, 22);font-weight:600;'>Hoàn thành</td>
    <?php } ?>    
      <td><button type="button" value="<?php echo $row['MaHD'] ?>"  class="btn btn-info" style="color: white" onclick="detail(this)" >Detail</button></td>
      
      </tr>
      <?php } ?>
    <?php } ?>
    </tr>
  </tbody>
</table>
</div>
<?php } ?>
<script language="javascript" src="../js/historycart.js"></script>
</body>
 <!--====================== Bảng chi tiết sản phẩm đã đượck xử lý ===============================
          <div id="detail_product" class="detail_product product-info ">
          <h2>MỘT THUỞ YÊU NGƯỜI (LOFI MUSIC) - VICKY NHUNG</h2>
          <p>*Bài hát "Một Thuở Yêu Người" sẽ mở đầu cho Dự án Chill With Vicky Nhung (season 2) gồm 5 ca khúc được ra mắt vào 20h tối thứ 7 hàng tuần. Nếu Season 1 là những ca khúc do Vicky sáng tác và thể hiện trên nền Piano nhẹ nhàng sâu lắng, thì season 2 là những bản tình ca da diết của mối tình đầy phong sương, của mảng ký ức đau lòng tưởng đã lãng quên, được làm mới lại theo phong cách lofi hiện đại.
            Ký Ức - Memory cũng chính là chủ đề của season lần này, Vicky mong rằng sẽ có thể đưa mọi người quay về miền ký ức ngày đó, để nhớ ta từng có những ngày yêu nồng nàn đến thế! 
            * Cảm ơn Góc Của Tùng, cảm ơn khán giả yêu nhạc và những người bạn đã hết mình hỗ trợ Vicky trong dự án này.  Enjoy nhé mọi người ^_^. Đừng quên Like và Share để tiếp thêm động lực cho Vicky tạo ra những sản phẩm tuyệt vời hơn nữa nhé  (◍•ᴗ•◍)❤!</p>
            <a  onclick="toggle_background();"> Close</a>
         </div> -->
         <div class="modal fade" id="modalLRForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog cascading-modal" role="document">
        <!--Content-->
        <div class="modal-content">

        <!--Modal cascading tabs-->
        <div class="modal-c-tabs">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs md-tabs tabs-2 light-blue darken-3" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="lh" data-toggle="tab" href="#panel7" role="tab"><i class="fas fa-user mr-1"></i>
                Đăng nhập</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#panel8" role="tab"><i class="fas fa-user-plus mr-1"></i>
                Đăng ký</a>
            </li>
            </ul>

            <!-- Tab panels -->
            <div class="tab-content">
            <!--Panel 7-->
            <div class="tab-pane fade in show active" id="panel7" role="tabpanel">

                <!--Body-->
                <div class="modal-body mb-1">
                <div class="md-form form-sm mb-5">
                    <i class="fa fa-user"></i>
                    <label data-error="wrong" data-success="right" for="modalLRInput10">Tài khoản</label>
                    <input type="text" id="modalLRInput10" class="form-control form-control-sm validate">
                </div>

                <div class="md-form form-sm mb-4">
                    <i class="fas fa-lock prefix"></i>
                    <label data-error="wrong" data-success="right" for="modalLRInput11">Mật khẩu</label>
                    <input type="password" id="modalLRInput11" class="form-control form-control-sm validate">
                </div>
                <div class="text-center mt-2">
                    <button id="btnLogin" class="btn btn-info">Đăng nhập <i class="fas fa-sign-in ml-1"></i></button>
                </div>
                </div>
                <!--Footer-->
                <div class="modal-footer">
    
                <button type="button" class="btn btn-outline-info waves-effect ml-auto" data-dismiss="modal">Thoát</button>
                </div>

            </div>
            <!--/.Panel 7-->

            <!--Panel 8-->
            <div class="tab-pane fade" id="panel8" role="tabpanel">

                <!--Body-->
                <div class="modal-body">
                <div class="md-form form-sm mb-5">
                    <i class="fa fa-users"></i>
                    <label data-error="wrong" data-success="right" for="modalLRInput12" style="margin-right:46%">Họ</label>
                    <i class="fa fa-users"></i>
                    <label data-error="wrong" data-success="right" for="modalLRInput13">Tên</label>
                    <br>
                    <input type="text" id="modalLRInput12" class="form-control form-control-sm validate" style="width:45%; float:left; margin-right:10%">
                    <input type="text" id="modalLRInput13" class="form-control form-control-sm validate" style="width:45%">
                </div>
                <div class="md-form form-sm mb-5">
                    <i class="fa fa-user"></i>
                    <label data-error="wrong" data-success="right" for="modalLRInput14">Tài khoản</label>
                    <input type="text" id="modalLRInput14" class="form-control form-control-sm validate">
                </div>
                <div class="md-form form-sm mb-5">
                    <i class="fas fa-lock prefix"></i>
                    <label data-error="wrong" data-success="right" for="modalLRInput15">Mật khẩu</label>
                    <input type="password" id="modalLRInput15" class="form-control form-control-sm validate">
                </div>
                <div class="md-form form-sm mb-4">
                    <i class="fas fa-lock prefix"></i>
                    <label data-error="wrong" data-success="right" for="modalLRInput16">Nhập lại mật khẩu</label>
                    <input type="password" id="modalLRInput16" class="form-control form-control-sm validate">
                </div>
                <div class="md-form form-sm mb-5">
                    <i class="fas fa-envelope prefix"></i>
                    <label data-error="wrong" data-success="right" for="modalLRInput17">Email</label>
                    <input type="email" id="modalLRInput17" class="form-control form-control-sm validate">
                </div>
                <div class="md-form form-sm mb-5">
                    <i class="fa fa-phone-square"></i>
                    <label data-error="wrong" data-success="right" for="modalLRInput18">Số điện thoại</label>
                    <input type="text" id="modalLRInput18" class="form-control form-control-sm validate">
                </div>
                <div class="md-form form-sm mb-5">
                    <i class="fa fa-calendar"></i>
                    <label data-error="wrong" data-success="right" for="modalLRInput19" style="margin-right:36%">Ngày sinh</label>
                    <i class="fa fa-male"></i>
                    <i class="fa fa-female"></i>
                    <label data-error="wrong" data-success="right" for="modalLRInput20">Giới tính</label>
                    <br>
                    <input type="date" id="modalLRInput19" class="form-control form-control-sm validate" style="width:45%; float:left; margin-right:10%">
                    <input type="radio" value="0" checked="checked" id="modalLRInput20" name="gioitinh"><span style="margin-right:10%">Nam</span>
                    <input type="radio" value="1" id="modalLRInput21" name="gioitinh"><span>Nữ</span>
                </div>
                <div class="md-form form-sm mb-5">
                    <i class="fa fa-address-book"></i>
                    <label data-error="wrong" data-success="right" for="modalLRInput22">Địa chỉ</label>
                    <input type="text" id="modalLRInput22" class="form-control form-control-sm validate">
                </div>
                <div class="text-center form-sm mt-2">
                    <button id="btnRegister" class="btn btn-info">Đăng ký <i class="fas fa-sign-in ml-1"></i></button>
                </div>
                
                </div>
                <!--Footer-->
                <div class="modal-footer">
                
                <button type="button" class="btn btn-outline-info waves-effect ml-auto" data-dismiss="modal">Thoát</button>
                </div>
            </div>
            <!--/.Panel 8-->
            </div>

        </div>
        </div>
        <!--/.Content-->
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
         <?php if(isset($_SESSION['taikhoan'])) { ?>
         <div class="modal fade" id="modalLRForm1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog cascading-modal" role="document">
        <!--Content-->
        <div class="modal-content">

        <!--Modal cascading tabs-->
        <div class="modal-c-tabs">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs md-tabs tabs-2 light-blue darken-3" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="lh" data-toggle="tab" href="#panel10" role="tab"><i class="fas fa-user mr-1"></i>
                Thông tin cá nhân</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#panel11" role="tab"><i class="fas fa-user-plus mr-1"></i>
                Sửa thông tin cá nhân</a>
            </li>
            </ul>

            <!-- Tab panels -->
            <div class="tab-content">
            <!--Panel 7-->
            <div class="tab-pane fade in show active" id="panel10" role="tabpanel">

                <!--Body-->
                <div class="modal-body mb-1">
                <div class="md-form form-sm mb-5">
                <i class="fa fa-users"></i>
                    <label data-error="wrong" data-success="right" for="modalTTInput1" style="margin-right:46%">Họ</label>
                    <i class="fa fa-users"></i>
                    <label data-error="wrong" data-success="right" for="modalTTInput2">Tên</label>
                    <br>
                    <input type="text" disabled id="modalTTInput1" class="form-control form-control-sm validate" style="width:45%; float:left; margin-right:10%" value="<?php echo $_SESSION['taikhoan']['ho']; ?>">
                    <input type="text" disabled id="modalTTInput2" class="form-control form-control-sm validate" style="width:45%" value="<?php echo $_SESSION['taikhoan']['ten']; ?>">
                </div>
                <?php if($_SESSION['taikhoan']['quyen']=='KH') { ?>
                <div class="md-form form-sm mb-5">
                    <i class="fas fa-envelope prefix"></i>
                    <label data-error="wrong" data-success="right" for="modalTTInput3">Email</label>
                    <input type="email" disabled id="modalTTInput3" class="form-control form-control-sm validate" value="<?php echo $_SESSION['taikhoan']['email']; ?>">
                </div>
                <?php } ?>
                <div class="md-form form-sm mb-5">
                    <i class="fa fa-phone-square"></i>
                    <label data-error="wrong" data-success="right" for="modalTTInput4">Số điện thoại</label>
                    <input type="text" disabled id="modalTTInput4" class="form-control form-control-sm validate" value="<?php echo $_SESSION['taikhoan']['sdt']; ?>">
                </div>

                <div class="md-form form-sm mb-5">
                    <i class="fa fa-calendar"></i>
                    <label data-error="wrong" data-success="right" for="modalTTInput5" style="margin-right:36%">Ngày sinh</label>
                    <i class="fa fa-male"></i>
                    <i class="fa fa-female"></i>
                    <label data-error="wrong" data-success="right" for="modalTTInput6">Giới tính</label>
                    <br>
                    <input type="date" disabled id="modalTTInput5" class="form-control form-control-sm validate" style="width:45%; float:left; margin-right:10%" value="<?php echo $_SESSION['taikhoan']['ngaysinh']; ?>">
                    <?php if($_SESSION['taikhoan']['gioitinh']==0) { ?>
                    <input type="radio" value="0" checked="checked" disabled id="modalTTInput6" name="gioitinh1"><span style="margin-right:10%; color:blue">Nam</span>
                    <input type="radio" value="1" id="modalTTInput7" disabled name="gioitinh1"><span>Nữ</span>
                    <?php } else { ?>
                    <input type="radio" value="0" id="modalTTInput6" disabled name="gioitinh1"><span style="margin-right:10%">Nam</span>
                    <input type="radio" value="1" checked="checked" disabled id="modalTTInput7" name="gioitinh1" style="color:red"><span>Nữ</span>
                    <?php } ?>
                </div>
                <div class="md-form form-sm mb-5">
                    <i class="fa fa-address-book"></i>
                    <label data-error="wrong" data-success="right" for="modalTTInput8">Địa chỉ</label>
                    <input type="text" disabled id="modalTTInput8" class="form-control form-control-sm validate" value="<?php echo $_SESSION['taikhoan']['diachi']; ?>">
                </div>
                <?php if($_SESSION['taikhoan']['quyen']!='KH') {?>
                <div class="md-form form-sm mb-5">
                    <i class="fa fa-address-book"></i>
                    <label data-error="wrong" data-success="right" for="modalTTInputtien">Tiền lương</label>
                    <input type="text" disabled id="modalTTInputtien" class="form-control form-control-sm validate" value="<?php echo number_format($_SESSION['taikhoan']['tienluong']); ?> VND">
                </div>
                <?php } ?>
                </div>
                <!--Footer-->
                <div class="modal-footer">
    
                <button type="button" class="btn btn-outline-info waves-effect ml-auto" data-dismiss="modal">Thoát</button>
                </div>

            </div>
            <!--/.Panel 7-->

            <!--Panel 8-->
            <div class="tab-pane fade" id="panel11" role="tabpanel">

                <!--Body-->
                <div class="modal-body">
                <div class="md-form form-sm mb-5">
                    <i class="fa fa-users"></i>
                    <label data-error="wrong" data-success="right" for="modalTTInput9" style="margin-right:46%">Họ</label>
                    <i class="fa fa-users"></i>
                    <label data-error="wrong" data-success="right" for="modalTTInput10">Tên</label>
                    <br>
                    <input type="text" id="modalTTInput9" class="form-control form-control-sm validate" style="width:45%; float:left; margin-right:10%" value="<?php echo $_SESSION['taikhoan']['ho']; ?>">
                    <input type="text" id="modalTTInput10" class="form-control form-control-sm validate" style="width:45%" value="<?php echo $_SESSION['taikhoan']['ten']; ?>">
                </div>
                <?php if($_SESSION['taikhoan']['quyen']=='KH') { ?>
                <div class="md-form form-sm mb-5">
                    <i class="fas fa-envelope prefix"></i>
                    <label data-error="wrong" data-success="right" for="modalTTInput11">Email</label>
                    <input type="email" id="modalTTInput11" class="form-control form-control-sm validate" value="<?php echo $_SESSION['taikhoan']['email']; ?>">
                </div>
                <?php } ?>
                <div class="md-form form-sm mb-5">
                    <i class="fa fa-phone-square"></i>
                    <label data-error="wrong" data-success="right" for="modalTTInput12">Số điện thoại</label>
                    <input type="text" id="modalTTInput12" class="form-control form-control-sm validate" value="<?php echo $_SESSION['taikhoan']['sdt']; ?>">
                </div>
                <div class="md-form form-sm mb-5">
                    <i class="fa fa-calendar"></i>
                    <label data-error="wrong" data-success="right" for="modalTTInput13" style="margin-right:36%">Ngày sinh</label>
                    <i class="fa fa-male"></i>
                    <i class="fa fa-female"></i>
                    <label data-error="wrong" data-success="right" for="modalTTInput14">Giới tính</label>
                    <br>
                    <input type="date" id="modalTTInput13" class="form-control form-control-sm validate" style="width:45%; float:left; margin-right:10%" value="<?php echo $_SESSION['taikhoan']['ngaysinh']; ?>">
                    <?php if($_SESSION['taikhoan']['gioitinh']==0) { ?>
                    <input type="radio" value="0" checked="checked" id="modalTTInput14" name="gioitinh2"><span style="margin-right:10%">Nam</span>
                    <input type="radio" value="1" id="modalTTInput15" name="gioitinh2"><span>Nữ</span>
                    <?php } else { ?>
                    <input type="radio" value="0" id="modalTTInput14" name="gioitinh2"><span style="margin-right:10%">Nam</span>
                    <input type="radio" value="1" checked="checked" id="modalTTInput15" name="gioitinh2"><span>Nữ</span>
                    <?php } ?>
                </div>
                <div class="md-form form-sm mb-5">
                    <i class="fa fa-address-book"></i>
                    <label data-error="wrong" data-success="right" for="modalTTInput16">Địa chỉ</label>
                    <input type="text" id="modalTTInput16" class="form-control form-control-sm validate" value="<?php echo $_SESSION['taikhoan']['diachi']; ?>">
                </div>
                <div class="text-center form-sm mt-2">
                    <button id="btnsuathongtin" name="<?php echo $_SESSION['taikhoan']['quyen']; ?>" class="btn btn-info">Hoàn thành <i class="fas fa-sign-in ml-1"></i></button>
                </div>
                
                </div>
                <!--Footer-->
                <div class="modal-footer">
                
                <button type="button" class="btn btn-outline-info waves-effect ml-auto" data-dismiss="modal">Thoát</button>
                </div>
            </div>
            <!--/.Panel 8-->
            </div>

        </div>
        </div>
        <!--/.Content-->
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
         <div class="modal fade" id="modalLRForm2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog cascading-modal" role="document">
        <!--Content-->
        <div class="modal-content">

        <!--Modal cascading tabs-->
        <div class="modal-c-tabs">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs md-tabs tabs-2 light-blue darken-3" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="lh" data-toggle="tab" href="#panel12" role="tab"><i class="fas fa-user mr-1"></i>
                Đổi mật khẩu</a>
            </li>
            </ul>

            <!-- Tab panels -->
            <div class="tab-content">
            <!--Panel 7-->
            <div class="tab-pane fade in show active" id="panel12" role="tabpanel">

                <!--Body-->
                <div class="modal-body mb-1">
                
                <div class="md-form form-sm mb-5">
                    <i class="fa fa-lock prefix"></i>
                    <label data-error="wrong" data-success="right" for="modalTTInput17">Mật khẩu cũ</label>
                    <input type="password" id="modalTTInput17" class="form-control form-control-sm validate">
                </div>
                <div class="md-form form-sm mb-5">
                    <i class="fas fa-lock prefix"></i>
                    <label data-error="wrong" data-success="right" for="modalTTInput18">Mật khẩu mới</label>
                    <input type="password" id="modalTTInput18" class="form-control form-control-sm validate">
                </div>
                <div class="md-form form-sm mb-4">
                    <i class="fas fa-lock prefix"></i>
                    <label data-error="wrong" data-success="right" for="modalTTInput19">Nhập lại mật khẩu mới</label>
                    <input type="password" id="modalTTInput19" class="form-control form-control-sm validate">
                </div>
                <div class="text-center form-sm mt-2">
                    <button id="btnsuamatkhau" class="btn btn-info">Hoàn thành <i class="fas fa-sign-in ml-1"></i></button>
                </div>
                </div>
                <!--Footer-->
                <div class="modal-footer">
    
                <button type="button" class="btn btn-outline-info waves-effect ml-auto" data-dismiss="modal">Thoát</button>
                </div>

            </div>
            <!--/.Panel 7-->

           
            </div>

        </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<div class="modal fade" id="modalLRForm3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog cascading-modal" role="document">
        <!--Content-->
        <div class="modal-content">

        <!--Modal cascading tabs-->
        <div class="modal-c-tabs">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs md-tabs tabs-2 light-blue darken-3" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="lh" data-toggle="tab" href="#panel13" role="tab"><i class="fas fa-user mr-1"></i>
                Đánh giá sản phẩm</a>
            </li>
            </ul>

            <!-- Tab panels -->
            <div class="tab-content">
            <!--Panel 7-->
            <div class="tab-pane fade in show active" id="panel13" role="tabpanel">

                <!--Body-->
                <div class="modal-body mb-1">
                
                <div class="md-form form-sm mb-5">
                    <i class="fa fa-star"></i>
                    <label data-error="wrong" data-success="right" for="modalDGInput1">Chọn số sao</label>
                    <select name="modalDGInput1" id="modalDGInput1" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                        <option checked value="5">5 sao</option>
                        <option value="4">4 sao</option>
                        <option value="3">3 sao</option>
                        <option value="2">2 sao</option>
                        <option value="1">1 sao</option>
                    </select>
                </div>
                <div class="md-form form-sm mb-5">
                    <i class="fa fa-commenting"></i>
                    <label data-error="wrong" data-success="right" for="modalDGInput2">Bình luận</label>
                    <textarea type="text" id="modalDGInput2" class="form-control form-control-sm validate"></textarea>
                </div>
                <div class="text-center form-sm mt-2">
                    <button id="btndanhgia" name="" class="btn btn-info">Hoàn thành <i class="fas fa-sign-in ml-1"></i></button>
                </div>
                </div>
                <!--Footer-->
                <div class="modal-footer">
    
                <button type="button" class="btn btn-outline-info waves-effect ml-auto" data-dismiss="modal">Thoát</button>
                </div>

            </div>
            <!--/.Panel 7-->

           
            </div>

        </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<?php } ?>
         <script>
          $(document).ready(function() {
            $('#toggle').click(function() {
                $('#nav-menu').slideToggle();
            });
        })
          
        </script>
        <script language="javascript" src="../js/login.js"></script>
        <script language="javascript" src="../js/register.js"></script>
        <script language="javascript" src="../js/sanpham.js"></script>
        <script language="javascript" src="../js/tanggiam.js"></script>
        <script language="javascript" src="../js/thanhtoan.js"></script>
        <script language="javascript" src="../js/historycart.js"></script>
        <script language="javascript" src="../js/doimatkhau.js"></script>
        <script language="javascript" src="../js/suathongtin.js"></script>
        <script language="javascript" src="../js/timkiem.js"></script>
        <script language="javascript" src="../js/noidungsp.js"></script>
        <script language="javascript" src="../js/danhgia.js"></script>
