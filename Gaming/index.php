<?php 
    require_once "./php/KetnoiCSDL.php";
    $p = new CheckConnection();
    session_start();
    // var_dump($_SESSION['cart']);
    // session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link rel="stylesheet" href="./css/bootstrap.css" />
    <link rel="stylesheet" href="./css/Body.css" />
    <link rel="stylesheet" href="./css/Trangchu2.css" />
    <style>
    <?php  require_once './css/Body.css'; ?>
    </style>
    <title>Responsive Navbar</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <!-- Font Awesome JS -->
    <script language="javascript" type="text/javascript" defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script language="javascript" type="text/javascript" defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <script language="javascript" type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script language="javascript" type="text/javascript" src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script language="javascript" type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
       
    .product-mota{
      color: #999999;
    }
    /* #wrapper.active{
    filter: blur(3px);
    } */
    #main-menu .drop1:hover {
        border:4px solid #009432
    }
    </style>
    <!-- <script>================== Này để làm mờ và hiện div thông tin sản phẩm====================================
      function detail_product(){
        document.getElementById('detail_product').style.display = 'block';
      } 
      function toggle_background(){
        var blur = document.getElementById('wrapper');
        blur.classList.toggle('active');
        var detail_product = document.getElementById('detail_product');
        detail_product.classList.toggle('active');
      }
    </script>

    <script>
      function all_detail_product(){
        detail_product();
        toggle_background();
      } 
    </script> -->

    <!-- <script>
      window.addEventListener('mouseup',function(event){
          var box = document.getElementById('detail_product');
          if(event.target != box && event.target.parentNode != box){
            $("div").removeClass("active");
              box.style.display = 'none';
          }
      });
    </script> -->
</head>
<body style="background-color: #17191b;">

     <div id="wrapper" >
            <div id="toggle" class="sticky-md-top sticky-sm-top">
              <i class="fas fa-bars"></i>
            </div>
             <!--====================================== Menu ====================================== -->
            <div id="bao_menu" class="sticky-md-top" >
              <div id="nav-menu" class="container">
                <div id="main-menu" class="row ">
                    <div class="col-md-2 button imglogo" onclick="window.location='http://localhost/Gaming/'">
                        <img src="./img/logo.png" />
                    </div>
                    <?php 
                        $sqllap = "SELECT * FROM `loai_sp` WHERE MaLoai='L1'";
                        $reslap = $p->ExcuteQuery($sqllap);
                        $objlap = $reslap->fetch_object();
                    ?>
                    <div class="col-md-1 button btnmenu" id="<?php echo $objlap->MaLoai; ?>"  onclick="window.location='http://localhost/Gaming/php/sanpham.php?id=<?php echo $objlap->MaLoai; ?>'">
                      <span></span><span></span><span></span><span></span>
                      LAPTOP
                    </div>
                    <?php 
                        $sqlpc = "SELECT * FROM `loai_sp` WHERE MaLoai='L2'";
                        $respc = $p->ExcuteQuery($sqlpc);
                        $objpc = $respc->fetch_object();
                    ?>
                    <div class="col-md-1 button btnmenu" id="<?php echo $objpc->MaLoai; ?>"  onclick="window.location='http://localhost/Gaming/php/sanpham.php?id=<?php echo $objpc->MaLoai; ?>'">
                      <span></span><span></span><span></span><span></span>
                      PC
                    </div>
                    <?php 
                        $sqlm = "SELECT * FROM `loai_sp` WHERE MaLoai='L8'";
                        $resm = $p->ExcuteQuery($sqlm);
                        $objm = $resm->fetch_object();
                    ?>
                    <?php 
                        $malap = $objlap->MaLoai;
                        $mapc = $objpc->MaLoai;
                        $mam = $objm->MaLoai;
                        $sqlgg = "SELECT * FROM `loai_sp` WHERE MaLoai!='$malap' and MaLoai!='$mapc' and MaLoai!='$mam'";
                        $resgg = $p->ExcuteQuery($sqlgg);
                        $objgg = $resgg->fetch_object();
                        $count = mysqli_num_rows($resgg);
                        $count1=0;
                    ?>
                        <div class="col-md-2 button drop1" style="">
                          <div class="dropdown-toggle" href="#pageSubmenutk" data-toggle="collapse" aria-expanded="false">GAMING GEAR</div>
                          <ul class="collapse list-unstyled" id="pageSubmenutk" style="background:#17191b; margin-top:-20px; text-align:left; width:235px">
                              <?php while($data = mysqli_fetch_assoc($resgg)) { $count1++; ?>
                                <a onclick="window.location='http://localhost/Gaming/php/sanpham.php?id=<?php echo $data['MaLoai']; ?>'" class="btnmenu" id="<?php echo $data['MaLoai']; ?>">
                                  <li STYLE="padding:10px; cursor:pointer; color:white; list-style-type: none; text-decoration: none;">
                                    <?php echo $data['TenLoai']; ?>
                                  </li>
                                </a>
                                <?php if($count1 < $count) { ?>
                                  <li>
                                    <hr class="dropdown-divider">
                                  </li>
                              <?php } }?>
                          </ul>
                        </div>
                    
                    <div class="col-md-2 button btnmenu" id="<?php echo $objm->MaLoai; ?>"  onclick="window.location='http://localhost/Gaming/php/sanpham.php?id=<?php echo $objm->MaLoai; ?>'">
                      <span></span><span></span><span></span><span></span>
                      MÀN HÌNH
                    </div>
                    <div class="col-md-2 button">
                      <span></span><span></span><span></span><span></span>
                      HỖ TRỢ
                    </div>
                    <?php if(!isset($_SESSION['taikhoan'])) { ?>
                      <div class="col-md-1 button" id="user" data-toggle="modal" data-target="#modalLRForm">
                          <img src="./img/user.png" />
      
                      </div>
                    <?php } else { ?>
                      <div class="col-md-1 button drop1" id="user" style="white-space:nowrap; border:1px solid #000000; text-overflow:ellipsis;">
                          <img src="./img/user.png" />
                          
                          <div class="dropdown-toggle" href="#pageSubmenut1" data-toggle="collapse" aria-expanded="false" style="white-space:nowrap;  overflow:hidden; text-overflow:ellipsis;">Chào, <?php echo $_SESSION['taikhoan']['ten']; ?> </div>
                          <ul class="collapse list-unstyled" id="pageSubmenut1" style="background:#17191b; margin-top:-42px; text-align:left; width:200px">
                                
         
                                <a href="#" style="color:white; list-style-type: none; text-decoration: none;" data-toggle="modal" data-target="#modalLRForm1">
                                  <li STYLE="padding:10px; cursor:pointer">
                                      Thông tin cá nhân
                                  </li>
                                </a>
                                <li>
                                  <hr class="dropdown-divider">
                                </li>
                                <?php if($_SESSION['taikhoan']['quyen']!='KH') { ?>
                                    <a href="./admin/index.php" style="color:white; list-style-type: none; text-decoration: none;">
                                      <li STYLE="padding:10px; cursor:pointer">
                                          Admin
                                      </li>
                                    </a>
                                    <li>
                                      <hr class="dropdown-divider">
                                    </li>
                                <?php } ?>
                                <a href="./php/lichsu.php" style="color:white; list-style-type: none; text-decoration: none;">
                                  <li STYLE="padding:10px; cursor:pointer">
                                      Xem lịch sử giỏ hàng
                                  </li>
                                </a>
                                <li>
                                  <hr class="dropdown-divider">
                                </li>
                                <a href="#" style="color:white; list-style-type: none; text-decoration: none;" data-toggle="modal" data-target="#modalLRForm2">
                                  <li STYLE="padding:10px; cursor:pointer">
                                      Đổi mật khẩu
                                  </li>
                                </a>
                                <li>
                                  <hr class="dropdown-divider">
                                </li>
                                <a href="./php/logout.php" style="color:white; list-style-type: none; text-decoration: none;"> 
                                  <li STYLE="padding:10px; cursor:pointer">
                                      Đăng xuất
                                  </li>
                                </a>
                                
                          </ul>
                      </div>
                    <?php } ?>
                        <div class="col-md-1 button" id="cart">
                            <a href="./php/giohang.php"><img src="./img/pngwing.com.png" /></a>
                            
                        </div>
                </div>
             </div>
            </div>
            
            <!--====================================== Nav bảo hành====================================== -->
            <div id="nav" class="container" style="background-color: #17191b;color: #ffffff;height: 47px;">
                <div id="main-baohanh" class="row">
                      <div class="thanh_huongdan col-md-2 "> THÔNG TIN MÙA DỊCH
                      </div>
                      <div class="thanh_huongdan col-md-2 "> HƯỚNG DẪN THANH TOÁN
                      </div>
                      <div class="thanh_huongdan col-md-2 "> HƯỚNG DẪN TRẢ GÓP
                      </div>
                      <div class="thanh_huongdan col-md-2 "> CHÍNH SÁCH BẢO HÀNH
                      </div>
                      <div class="thanh_huongdan col-md-2 "> CHÍNH SÁCH VẬN CHUYỂN
                      </div>
              </div>
           </div>
      
            <!--====================================== Slide ảnh ====================================== -->
            <!-- Wrapper for slides -->
            <div id="myCarousel" class="carousel slide" data-ride="carousel" style="margin-top: 0px;">
              <!-- Indicators -->
              <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
                <li data-target="#myCarousel" data-slide-to="4"></li>
              </ol>
           
              <!-- Wrapper for slides -->
              <div class="carousel-inner">
           
                <div class="item active">
                  <img src="./img/254795590_420333926346100_7355988065095911575_n.png" alt="Los Angeles" style="width:100%;">
                  <div class="carousel-caption">
                    <h3>Los Angeles</h3>
                    <p>LA is always so much fun!</p>
                  </div>
                </div>

                <div class="item">
                  <img src="https://assets2.razerzone.com/images/pnx.assets/808cc002620878e5b9bdd0edceb0ed1b/razer-blade-14-laptop-desktop-hero.jpg" alt="Chicago" style="width:100%;">
                  <div class="carousel-caption">
                    <h3>Razer</h3>
                    <p>Thank you !!!</p>
                  </div>
                </div>

                <div class="item">
                  <img src="https://assets2.razerzone.com/images/pnx.assets/e0ffd6312c5948a020eca3f8a77f876e/razer-blade-14-laptop-desktop-usp8-responsive.jpg" alt="New York" style="width:100%;">
                  <div class="carousel-caption">
                    <h3>New York</h3>
                    <p>We love the Big Apple!</p>
                  </div>
                </div>

                <div class="item">
                  <img src="https://assets2.razerzone.com/images/pnx.assets/351796a62196ff97ca0ed3f5f9991662/razer-blade-14-laptop-desktop-usp2.jpg" alt="Chicago" style="width:100%;">
                  <div class="carousel-caption">
                    <h3>Chicago</h3>
                    <p>Thank you, Chicago!</p>
                  </div>
                </div>
              
                <div class="item">
                  <img src="./img/255370662_607494957352757_1532891503197535571_n.png" alt="New York" style="width:100%;">
                  <div class="carousel-caption">
                    <h3>New York</h3>
                    <p>We love the Big Apple!</p>
                  </div>
                </div>
            
              </div>
           
              <!-- Left and right controls -->
              <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>

              <!--====================================== Content ====================================== -->
            <body >
                <div class = "products">
                    <div class = "container">
                        
                        
                         <?php 
                            date_default_timezone_set('Asia/Ho_Chi_Minh');
                            $today = date("Y-m-d");
                            $sqlKM = "UPDATE `khuyen_mai` km, `chi_tiet_km` ctkm, `san_pham` sp SET km.TinhTrang=1 WHERE km.NgayBD <= '$today' and km.NgayKT >= '$today' and km.MaKM=ctkm.MaKM and ctkm.MaNhomSP = sp.MaNhomSP and km.TinhTrang=3";
                            $resKM = $p->ExcuteQuery($sqlKM);
                            $sqlKM1 = "UPDATE `khuyen_mai` km, `chi_tiet_km` ctkm, `san_pham` sp SET km.TinhTrang=2 WHERE km.NgayKT < '$today' and km.MaKM=ctkm.MaKM and ctkm.MaNhomSP = sp.MaNhomSP and km.TinhTrang=1";
                            $resKM1 = $p->ExcuteQuery($sqlKM1 );
                            $sqlKM2 = "UPDATE `khuyen_mai` km, `chi_tiet_km` ctkm, `san_pham` sp SET sp.GiaKM=sp.GiaBan-(sp.GiaBan*ctkm.`%KM`)/100 WHERE km.MaKM=ctkm.MaKM and ctkm.MaNhomSP = sp.MaNhomSP and km.TinhTrang=1";
                            $resKM2 = $p->ExcuteQuery($sqlKM2 );
                            $sqlKM3 = "UPDATE `khuyen_mai` km, `chi_tiet_km` ctkm, `san_pham` sp SET sp.GiaKM=0 WHERE km.MaKM=ctkm.MaKM and ctkm.MaNhomSP = sp.MaNhomSP and km.TinhTrang=2";
                            $resKM3 = $p->ExcuteQuery($sqlKM3 );
                            // $sqlupsp1 = "UPDATE `san_pham` SET GiaKM = 0 WHERE 1";
                            // $p->ExcuteQuery($sqlupsp1);
                            // while($data = mysqli_fetch_assoc($resKM)) {
                            //     $manhomsp = $data['MaNhomSP'];
                            //     $sqlslsp = "SELECT GiaBan FROM `san_pham` where MaNhomSP = '$manhomsp'";
                            //     $resslsp = $p->ExcuteQuery($sqlslsp);
                            //     $obj=$resslsp->fetch_object();
                            //     $phantramkm = $data['%KM'];
                            //     $tinhtien = $obj->GiaBan - ($obj->GiaBan*$phantramkm)/100;
                            //     $sqlupsp = "UPDATE `san_pham` SET GiaKM = $tinhtien WHERE MaNhomSP = '$manhomsp'";
                            //     $p->ExcuteQuery($sqlupsp);
                            // }

                        ?> 
                        <div class = "product-items" id="spchinh">
                            <!-- single product -->
                        <?php 
                            $sql = "SELECT * FROM `san_pham` WHERE TinhTrang!=0 ORDER BY `san_pham`.`DoUuTien` DESC limit 16 ";
                            $res = $p->ExcuteQuery($sql);
                            while($data = mysqli_fetch_assoc($res)) {
                                if($data['SoLuong'] < 1) {
                        ?>
                                    <div class = "product">
                                        <div class = "product-content">
                                            <div class = "product-img">
                                                <img src = "./img/<?php echo $data['HinhAnh'] ?>" alt = "product image" onclick="window.location='http://localhost/Gaming/php/noidungsp.php?id=<?php echo $data['MaNhomSP'] ?>'">
                                            </div>
                                            <div class = "product-btns-hethang">
                                            <div  class = "product-btns-hethang1"> hết hàng   
                                                <span><i class='bx bxs-message-alt-error'></i></span>
                                            </div>
                                        </div>

                                        </div>
                
                                        <div class = "product-info">
                                            <div class = "product-info-top">

                                            </div>
                                            <a  onclick="all_detail_product();" class = "product-name <?php echo $data['MaNhomSP']; ?>"><?php echo $data['Ten']; ?></a>
                                            <br> 
                                            <?php 
                                                $phanKM = (($data['GiaBan'] - $data['GiaKM'])*100)/$data['GiaBan'];
                                                if($data['GiaKM'] > 0) {
                                            ?>
                                                    <p class = "product-price"><?php echo number_format($data['GiaBan']); ?> đồng</p>
                                                    <br>
                                                    <p class = "product-price"><?php echo number_format($data['GiaKM']); ?> đồng</p>
                                                    <div class = "off-info">
                                                        <h2 class = "sm-title"><?php echo $phanKM; ?>% khuyến mãi</h2>
                                                    </div>
                                            <?php 
                                                } else {
                                            ?>
                                                    <p class = "product-price" style="color:#17191b">....</p>
                                                    <br>
                                                    <p class = "product-price"><?php echo number_format($data['GiaBan']); ?> đồng</p>
                                            <?php 
                                                }
                                            ?>
                                        </div>
                                    </div>
                        <?php 
                                } else {
                                    if(isset($_SESSION['cart'][$data['MaNhomSP']])) {
                                        if((int)$data['SoLuong']>$_SESSION['cart'][$data['MaNhomSP']]['SoLuong']) {
                     
                        ?>
                                    <div class = "product">
                                        <div class = "product-content">
                                            <div class = "product-img">
                                                <img src = "./img/<?php echo $data['HinhAnh']; ?>" alt = "product image" onclick="window.location='http://localhost/Gaming/php/noidungsp.php?id=<?php echo $data['MaNhomSP'] ?>'">
                                            </div>
                                            <div class = "product-btns">
                                                <button type = "button" class = "btn-cart <?php echo $data['MaNhomSP']; ?>"> Thêm vào giỏ hàng
                                                    <span><i class = "fas fa-plus"></i></span>
                                                </button>
                                                <button type = "button" class = "btn-buy <?php echo $data['MaNhomSP']; ?>"> Mua ngay
                                                    <span><i class = "fas fa-shopping-cart"></i></span>
                                                </button>
                                            </div>
                                        </div>
                
                                        <div class = "product-info">
                                            <div class = "product-info-top">
            
                                            </div>
                                            <a href = "#" class = "product-name"><?php echo $data['Ten']; ?></a>
                                            <br>    
                                            <?php 
                                                $phanKM = (($data['GiaBan'] - $data['GiaKM'])*100)/$data['GiaBan'];
                                                if($data['GiaKM'] > 0) {
                                            ?>
                                                    <p class = "product-price"><?php echo number_format($data['GiaBan']); ?> đồng</p>
                                                    <br>
                                                    <p class = "product-price"><?php echo number_format($data['GiaKM']); ?> đồng</p>
                                                    <div class = "off-info">
                                                        <h2 class = "sm-title"><?php echo $phanKM; ?>% khuyến mãi</h2>
                                                    </div>
                                            <?php 
                                                } else {
                                            ?>
                                                    <p class = "product-price" style="color:#17191b">....</p>
                                                    <br>
                                                    <p class = "product-price"><?php echo number_format($data['GiaBan']); ?> đồng</p>
                                            <?php 
                                                }
                                            ?>
                                        </div>
                
                                        
                                    </div>
                        <?php 
                                        } else {
                        ?>
                                    <div class = "product">
                                        <div class = "product-content">
                                            <div class = "product-img">
                                                <img src = "./img/<?php echo $data['HinhAnh'] ?>" alt = "product image" onclick="window.location='http://localhost/Gaming/php/noidungsp.php?id=<?php echo $data['MaNhomSP'] ?>'">
                                            </div>
                                            <div class = "product-btns-hethang">
                                            <div  class = "product-btns-hethang1"> hết hàng   
                                                <span><i class='bx bxs-message-alt-error'></i></span>
                                            </div>
                                        </div>

                                        </div>
                
                                        <div class = "product-info">
                                            <div class = "product-info-top">

                                            </div>
                                            <a  onclick="all_detail_product();" class = "product-name <?php echo $data['MaNhomSP']; ?>"><?php echo $data['Ten']; ?></a>
                                            <br> 
                                            <?php 
                                                $phanKM = (($data['GiaBan'] - $data['GiaKM'])*100)/$data['GiaBan'];
                                                if($data['GiaKM'] > 0) {
                                            ?>
                                                    <p class = "product-price"><?php echo number_format($data['GiaBan']); ?> đồng</p>
                                                    <br>
                                                    <p class = "product-price"><?php echo number_format($data['GiaKM']); ?> đồng</p>
                                                    <div class = "off-info">
                                                        <h2 class = "sm-title"><?php echo $phanKM; ?>% khuyến mãi</h2>
                                                    </div>
                                            <?php 
                                                } else {
                                            ?>
                                                    <p class = "product-price" style="color:#17191b">....</p>
                                                    <br>
                                                    <p class = "product-price"><?php echo number_format($data['GiaBan']); ?> đồng</p>
                                            <?php 
                                                }
                                            ?>
                                        </div>
                                    </div>
                        <?php 
                                        }
                                    } else {
                        ?>  
                                    <div class = "product">
                                        <div class = "product-content">
                                            <div class = "product-img">
                                                <img src = "./img/<?php echo $data['HinhAnh']; ?>" alt = "product image" onclick="window.location='http://localhost/Gaming/php/noidungsp.php?id=<?php echo $data['MaNhomSP'] ?>'">
                                            </div>
                                            <div class = "product-btns">
                                                <button type = "button" class = "btn-cart <?php echo $data['MaNhomSP']; ?>"> Thêm vào giỏ hàng
                                                    <span><i class = "fas fa-plus"></i></span>
                                                </button>
                                                <button type = "button" class = "btn-buy <?php echo $data['MaNhomSP']; ?>"> Mua ngay
                                                    <span><i class = "fas fa-shopping-cart"></i></span>
                                                </button>
                                            </div>
                                        </div>
                
                                        <div class = "product-info">
                                            <div class = "product-info-top">
            
                                            </div>
                                            <a href = "#" class = "product-name"><?php echo $data['Ten']; ?></a>
                                            <br>    
                                            <?php 
                                                $phanKM = (($data['GiaBan'] - $data['GiaKM'])*100)/$data['GiaBan'];
                                                if($data['GiaKM'] > 0) {
                                            ?>
                                                    <p class = "product-price"><?php echo number_format($data['GiaBan']); ?> đồng</p>
                                                    <br>
                                                    <p class = "product-price"><?php echo number_format($data['GiaKM']); ?> đồng</p>
                                                    <div class = "off-info">
                                                        <h2 class = "sm-title"><?php echo $phanKM; ?>% khuyến mãi</h2>
                                                    </div>
                                            <?php 
                                                } else {
                                            ?>
                                                    <p class = "product-price" style="color:#17191b">....</p>
                                                    <br>
                                                    <p class = "product-price"><?php echo number_format($data['GiaBan']); ?> đồng</p>
                                            <?php 
                                                }
                                            ?>
                                        </div>
                
                                        
                                    </div>
                        <?php 
                                      }
                                }
                            }   
                        ?>
                            <!-- end of single product -->
                            <!-- single product -->
                            
                            <!-- end of single product -->
                        </div>
                    </div>
                </div>
        
                
            </body>
              <!--====================================== Footer====================================== -->
              
            <footer class="text-center text-lg-start bg-dark text-muted">
                <!-- Section: Social media -->
                <section
                  class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom"
                >
                  <!-- Left -->
                  <div class="me-5 d-none d-lg-block">
                    <span>Get connected with us on social networks:</span>
                  </div>
                  <!-- Left -->

                  <!-- Right -->
                  <div>
                    <a href="" class="me-4 text-reset">
                      <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                      <i class="fab fa-twitter"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                      <i class="fab fa-google"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                      <i class="fab fa-instagram"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                      <i class="fab fa-linkedin"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                      <i class="fab fa-github"></i>
                    </a>
                  </div>
                  <!-- Right -->
                </section>
                <!-- Section: Social media -->

                <!-- Section: Links  -->
                <section class="">
                  <div class="container text-center text-md-start mt-5">
                    <!-- Grid row -->
                    <div class="row mt-3">
                      <!-- Grid column -->
                      <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <!-- Content -->
                        <h6 class="text-uppercase fw-bold mb-4">
                          <i class="fas fa-gem me-3"></i>Company name
                        </h6>
                        <p>
                          Here you can use rows and columns to organize your footer content. Lorem ipsum
                          dolor sit amet, consectetur adipisicing elit.
                        </p>
                      </div>
                      <!-- Grid column -->

                      <!-- Grid column -->
                      <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                          Products
                        </h6>
                        <p>
                          <a href="#!" class="text-reset">Angular</a>
                        </p>
                        <p>
                          <a href="#!" class="text-reset">React</a>
                        </p>
                        <p>
                          <a href="#!" class="text-reset">Vue</a>
                        </p>
                        <p>
                          <a href="#!" class="text-reset">Laravel</a>
                        </p>
                      </div>
                      <!-- Grid column -->

                      <!-- Grid column -->
                      <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                          Useful links
                        </h6>
                        <p>
                          <a href="#!" class="text-reset">Pricing</a>
                        </p>
                        <p>
                          <a href="#!" class="text-reset">Settings</a>
                        </p>
                        <p>
                          <a href="#!" class="text-reset">Orders</a>
                        </p>
                        <p>
                          <a href="#!" class="text-reset">Help</a>
                        </p>
                      </div>
                      <!-- Grid column -->

                      <!-- Grid column -->
                      <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                          Contact
                        </h6>
                        <p><i class="fas fa-home me-3"></i> HO CHI MINH, HCM 700000, VIETNAM</p>
                        <p>
                          <i class="fas fa-envelope me-3"></i>
                          info@example.com
                        </p>
                        <p><i class="fas fa-phone me-3"></i> + 03 2833 2195</p>
                        <p><i class="fas fa-print me-3"></i> </p>
                      </div>
                      <!-- Grid column -->
                    </div>
                    <!-- Grid row -->
                  </div>
                </section>
                <!-- Section: Links  -->

                <!-- Copyright -->
                <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
                  Thank you for visiting us !
                </div>
                <!-- Copyright -->
              </footer>
              <!-- Footer -->
              


        </div>

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
                    <input type="text" disabled id="modalTTInputtien" class="form-control form-control-sm validate" value="<?php echo number_format($_SESSION['taikhoan']['tienluong']); ?> đồng">
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
<?php } ?>
         <script>
          $(document).ready(function() {
            $('#toggle').click(function() {
                $('#nav-menu').slideToggle();
            });
        })
          
        </script>
        <script language="javascript" src="./js/addgiohang.js"></script>
        <script language="javascript" src="./js/login.js"></script>
        <script language="javascript" src="./js/register.js"></script>
        <!-- <script language="javascript" src="./js/sanpham.js"></script> -->
        <script language="javascript" src="./js/doimatkhau.js"></script>
        <script language="javascript" src="./js/suathongtin.js"></script>

</body>
</html>