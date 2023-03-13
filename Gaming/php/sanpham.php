<?php require_once "./header.php"; 
    $id = $_GET['id'];
?>

                <div class = "products">
                    <div class = "container-fluid">
                        
                        
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
                        
                        <div class="row" style="">
                        <div class="col-md-3 col-sm-12 col-12" id="sc1" style="color:white; padding:30px; border-right: 2px solid #009432;">
                            <div  id="sc">
                            <span>Tìm kiếm:</span>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-12"><input class="form-control" id="search-box" type="text" placeholder="Search" aria-label="Search"></div>
                            </div>
                            <div class="row" style="margin-top:50px">
                                <div class="col-md-7 col-sm-7 col-6"><span>Giá từ:</span></div>
                                <div class="col-md-5 col-sm-5 col-6"><span>Giá đến:</span></div>
                            </div>
                            <div class="row" >
                                
                                <div class="col-md-5 col-sm-5 col-12"><input class="form-control" id="search-box1" type="text" placeholder="0" aria-label="Search" value="0"></div>
                                <div class="col-md-2 col-sm-2 col-2" style="text-align:center">=></div>
                                <div class="col-md-5 col-sm-5 col-12"><input class="form-control" id="search-box2" type="text" placeholder="0" aria-label="Search" value="0"></div>
                            </div>
                            
                            <div class="row" style="margin-top:50px">
                                <div class="col-md-12 col-sm-12 col-12"><span>Nhà sản xuất:</span></div>
                            </div>
                            <div class="row" >
                                <div class="col-md-12 col-sm-12 col-12">
                                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" id="search-box3" name="search-box3">
                                        <option value="0" selected>Chọn tất cả</option>
                                        <?php 
                                            $sqlsql = "SELECT * FROM `nha_san_xuat` WHERE TinhTrang!=0"; 
                                            $resres = $p->ExcuteQuery($sqlsql);
                                            while($data = mysqli_fetch_assoc($resres)) {
                                        ?>
                                            <option value="<?php echo $data['MaNSX']; ?>"><?php echo $data['TenNSX']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                
                            </div>

                            

                            <div class="row" style="margin-top:50px">
                                <div class="col-md-8"></div>
                                <div class="col-md-4"><button class="btn btn-outline-success" name="<?php echo $id; ?>" id="enter-box" type="button" style="background:white">Tìm kiếm</button></div>
                            
                            </div>
                            </div>
                        </div>
                        <div class="col-md-9" id="spchinh11">
                        <div class = "product-items product-items1" id="spchinh1">
                            <!-- single product -->
                        <?php 
                            
                            $limit = 9 ;
                            $page = 1;
                            $offset = 0;
                            $sql = "SELECT * FROM `san_pham` WHERE MaLoai = '$id' ORDER BY MaNhomSP ASC LIMIT $limit OFFSET $offset";
                            $res = $p->ExcuteQuery($sql);
                            $sql1 = "SELECT * FROM `san_pham` WHERE MaLoai = '$id' ";
                            $res1 = $p->ExcuteQuery($sql1);
                            $count_data=mysqli_num_rows($res1);
                            $total_pages = ceil($count_data/$limit);
                            while($data = mysqli_fetch_assoc($res)) {
                                if($data['SoLuong'] < 1) {
                        ?>
                                    <div class = "product">
                                        <div class = "product-content">
                                            <div class = "product-img">
                                                <img src = "../img/<?php echo $data['HinhAnh'] ?>" alt = "product image" onclick="window.location='http://localhost/Gaming/php/noidungsp.php?id=<?php echo $data['MaNhomSP'] ?>'">
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
                                                <img src = "../img/<?php echo $data['HinhAnh']; ?>" alt = "product image" onclick="window.location='http://localhost/Gaming/php/noidungsp.php?id=<?php echo $data['MaNhomSP'] ?>'">
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
                                                <img src = "../img/<?php echo $data['HinhAnh'] ?>" alt = "product image" onclick="window.location='http://localhost/Gaming/php/noidungsp.php?id=<?php echo $data['MaNhomSP'] ?>'">
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
                                                <img src = "../img/<?php echo $data['HinhAnh']; ?>" alt = "product image" onclick="window.location='http://localhost/Gaming/php/noidungsp.php?id=<?php echo $data['MaNhomSP'] ?>'">
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
                        
                        </div>
                        <div class="col-md-4"></div>
                        <ul class="pagination justify-content-center mt-5" id="pagination1">
                        <?php
                            $output='';
                            $previous_pages = '';

                            $next_pages = '';
                
                            $page_pages = '';
                
                            if($total_pages > 4) {
                                if($page < 5) {
                                    for($count = 1; $count < 5; $count++) {
                                        $page_array[] = $count;
                                    }
                                    $page_array[] = '...';
                                    $page_array[] = $total_pages;
                                } else {
                                    $end_limit = $total_pages - 3;
                                    if($page > $end_limit) {
                                        $page_array[] = 1;
                                        $page_array[] = '...';
                                        for($count = $end_limit; $count <= $total_pages; $count++) {
                                            $page_array[] = $count;
                                        }
                                    } else {
                                        $page_array[] = 1;
                                        $page_array[] = '...';
                                        for($count = $page - 1; $count <= $page + 1; $count++) {
                                            $page_array[] = $count;
                                        }
                                        $page_array[] = '...';
                                        $page_array[] = $total_pages;
                                    }
                                }
                            } else {
                                for($count = 1; $count <= $total_pages; $count++) {
                                    $page_array[] = $count;
                                }
                            }
                
                            if(isset($page_array)) {
                                for($count = 0; $count < count($page_array); $count++) {
                                    if($page == $page_array[$count]) {
                                        $page_pages .= "<li class='page-item active'><a href='javascript:void(0)' name='".$id."' class='page-link' data-page_number='".$page_array[$count]."'>".$page_array[$count]."
                                                        <span class='sr-only'>(current)</span></a></li>";
                                        $previous_id = $page_array[$count] - 1;
                    
                                        if($previous_id > 0) {
                                            $previous_pages = "<li class='page-item'><a class='page-link' href='javascript:void(0)' name='".$id."' 
                                                                data-page_number='".$previous_id."'>Previous</a></li>";
                                        } else {
                                            $previous_pages = "<li class='page-item disabled'><a class='page-link' href='#'>Previous</a></li>";
                                        }
                    
                                        $next_id = $page_array[$count] + 1;
                    
                                        if($next_id > $total_pages) {
                                            $next_pages = "<li class='page-item disabled'><a class='page-link' href='#'>Next</a></li>";
                                        } else {
                                            $next_pages = "<li class='page-item'><a name='".$id."' class='page-link' href='javascript:void(0)' data-page_number='".$next_id."'>Next</a></li>";
                                        }
                                    } else {
                                        if($page_array[$count] == '...') {
                                            $page_pages .= "<li class='page-item disabled'><a class='page-link' href='javascript:void(0)'>...</a></li>";
                                        } else {
                                            $page_pages .= "<li class='page-item'><a data-idhoadon class='page-link' href='javascript:void(0)' name='".$id."' 
                                                                data-page_number='".$page_array[$count]."'>".$page_array[$count]."</a></li>";
                                        }
                                    }
                                }
                                if($total_pages > 1) {
                                    $output .= $previous_pages . $page_pages . $next_pages . '</ul>';
                                } else {
                                    $output .= '</ul>';
                                }
                            }
                        ?>
                        <?php echo $output; ?>
                        </div>
                            <!-- end of single product -->
                            <!-- single product -->
                            
                            <!-- end of single product -->
                        </div>
                    </div>
                </div>
        


<?php require_once "./footer.php"; ?>