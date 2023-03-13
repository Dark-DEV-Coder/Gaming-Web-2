<?php 
    require_once "./KetnoiCSDL.php";
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
    <link rel="stylesheet" href="../css/bootstrap.css" />
    <style>
    <?php  require_once '../css/Body.css'; ?>
    <?php  require_once '../css/Trangchu2.css'; ?>
    </style>
    <!-- <link rel="stylesheet" href="../css/Trangchu.css" /> -->
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
    <link rel="stylesheet" href="../css/cart.css">
    <style>
       .btn-outline-success:hover {
        background:#009432;
    }
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
                    <div class="col-md-2 button imglogo"  onclick="window.location='http://localhost/Gaming/'">
                      <img src="../img/logo.png" />
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
                    <div class="col-md-1 button btnmenu" id="<?php echo $objpc->MaLoai; ?>" onclick="window.location='http://localhost/Gaming/php/sanpham.php?id=<?php echo $objpc->MaLoai; ?>'" >
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
                        <div class="col-md-2 button drop1" style="" href="#pageSubmenutk" data-toggle="collapse" aria-expanded="false">
                          <div class="dropdown-toggle" href="#pageSubmenutk" data-toggle="collapse" aria-expanded="false">GAMING GEAR</div>
                          <ul class="collapse list-unstyled" id="pageSubmenutk" style="background:#17191b; margin-top:-20px; text-align:left; width:235px">
                              <?php while($data = mysqli_fetch_assoc($resgg)) { $count1++; ?>
                                <a onclick="window.location='http://localhost/Gaming/php/sanpham.php?id=<?php echo $data['MaLoai']; ?>'" class="btnmenu" id="<?php echo $data['MaLoai']; ?>">
                                  <li STYLE="padding:10px; cursor:pointer; color:white; list-style-type: none; text-decoration: none;" >
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
                          <img src="../img/user.png" />
      
                      </div>
                    <?php } else { ?>
                      <div class="col-md-1 button drop1" id="user" style="white-space:nowrap; border:1px solid #000000; text-overflow:ellipsis;">
                          <img src="../img/user.png" />
                          
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
                                    <a href="../admin/index.php" style="color:white; list-style-type: none; text-decoration: none;">
                                      <li STYLE="padding:10px; cursor:pointer">
                                          Admin
                                      </li>
                                    </a>
                                    <li>
                                      <hr class="dropdown-divider">
                                    </li>
                                <?php } ?>
                                <a href="./lichsu.php" style="color:white; list-style-type: none; text-decoration: none;">
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
                                <a href="../php/logout.php" style="color:white; list-style-type: none; text-decoration: none;"> 
                                  <li STYLE="padding:10px; cursor:pointer">
                                      Đăng xuất
                                  </li>
                                </a>
                                
                          </ul>
                      </div>
                    <?php } ?>
                        <div class="col-md-1 button" id="cart">
                            <a href="./giohang.php"><img src="../img/pngwing.com.png" /></a>
                            
                        </div>
                </div>
             </div>
            </div>
