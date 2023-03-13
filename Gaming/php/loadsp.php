<?php 
    require_once "./KetnoiCSDL.php";
    session_start();
    $p = new CheckConnection();
    $id1 = $_POST['id'];

    
    $limit = 9 ;
    $page = 1;
    if($_POST['page'] > 1) {
        $offset = (($_POST['page'] - 1) * $limit);
        $page = $_POST['page'];
    } else {
        $offset = 0;
    }
    $sql = "SELECT * FROM `san_pham` WHERE MaLoai = '$id1' and TinhTrang!=0 ORDER BY MaNhomSP ASC LIMIT $limit OFFSET $offset";
    $res = $p->ExcuteQuery($sql);
    $sql1 = "SELECT * FROM `san_pham` WHERE MaLoai = '$id1' and TinhTrang!=0";
    $res1 = $p->ExcuteQuery($sql1);
    $count_data=mysqli_num_rows($res1);
    $total_pages = ceil($count_data/$limit);
    $output='<div class = "product-items product-items1" id="spchinh1">';

    // $query = "SELECT * FROM san_pham WHERE MaNhomSP = '$id'";
    // $res1=$p->ExcuteQuery($query);
    // $obj=$res1->fetch_object();
    // if(isset($_POST['id'])) {
    //     if(isset($_SESSION['cart'])) {
    //         if(isset($_SESSION['cart'][$id])) {
    //             $_SESSION['cart'][$id]['SoLuong'] += 1;
                
    //         } else {
    //             $_SESSION['cart'][$id]['MaNhomSP'] = $obj->MaNhomSP;
    //             $_SESSION['cart'][$id]['MaLoai'] = $obj->MaLoai;
    //             $_SESSION['cart'][$id]['MaNSX'] = $obj->MaNSX;
    //             $_SESSION['cart'][$id]['Ten'] = $obj->Ten;
    //             $_SESSION['cart'][$id]['HinhAnh'] = $obj->HinhAnh;
    //             $_SESSION['cart'][$id]['MoTa'] = $obj->MoTa;
    //             $_SESSION['cart'][$id]['GiaBan'] = $obj->GiaBan;
    //             $_SESSION['cart'][$id]['GiaKM'] = $obj->GiaKM;
    //             $_SESSION['cart'][$id]['SoLuong'] = 1;
               
    //         }
    //     }else {
    //         $_SESSION['cart'][$id]['MaNhomSP'] = $obj->MaNhomSP;
    //         $_SESSION['cart'][$id]['MaLoai'] = $obj->MaLoai;
    //         $_SESSION['cart'][$id]['MaNSX'] = $obj->MaNSX;
    //         $_SESSION['cart'][$id]['Ten'] = $obj->Ten;
    //         $_SESSION['cart'][$id]['HinhAnh'] = $obj->HinhAnh;
    //         $_SESSION['cart'][$id]['MoTa'] = $obj->MoTa;
    //         $_SESSION['cart'][$id]['GiaBan'] = $obj->GiaBan;
    //         $_SESSION['cart'][$id]['GiaKM'] = $obj->GiaKM;
    //         $_SESSION['cart'][$id]['SoLuong'] = 1;
           
    //     }
    // }
    // $sqlslsl = "SELECT SoLuong FROM `san_pham` WHERE MaNhomSP='$id'";
    // $resslsl = $p->ExcuteQuery($sqlslsl);
    // $soluong = $resslsl->fetch_object();
    // $_SESSION['odertotal']=0;
    // $_SESSION['cart'][$id]['TongCong']=0;
    // $_SESSION['TongSoLuong']=0;
    // if($_SESSION['cart'][$id]['SoLuong'] > $soluong->SoLuong) {
    //     $_SESSION['cart'][$id]['SoLuong']= (int)$soluong->SoLuong;         
    // } else {
    //     $_SESSION['TongSoLuong']+=$_SESSION['cart'][$id]['SoLuong'];
    // }

    // foreach($_SESSION['cart'] as $keys => $values) {
    //     if($values['GiaKM']>0){
    //         $_SESSION['odertotal']+=$values['GiaKM']*$values['SoLuong'];
    //         $_SESSION['cart'][$id]['TongCong']=$values['GiaKM']*$values['SoLuong'];
    //     }else{
    //         $_SESSION['odertotal']+=$values['GiaBan']*$values['SoLuong'];
    //         $_SESSION['cart'][$id]['TongCong']=$values['GiaBan'];
    //     }
    //     $_SESSION['TongSoLuong']+=$values['SoLuong'];
    // }
        
    while($data = mysqli_fetch_assoc($res)) {
        $href = "'http://localhost/Gaming/php/noidungsp.php?id="; 
        $href.="".$data['MaNhomSP']."'";
        if($data['SoLuong'] < 1) {
            $output.='  <div class = "product">
                            <div class = "product-content">
                                <div class = "product-img">
                                    <img src = "../img/'.$data['HinhAnh'].'" alt = "product image" onclick="window.location='.$href.'">
                                </div>
                                <div class = "product-btns-hethang">
                                <div  class = "product-btns-hethang1"> hết hàng   
                                    <span><i class="bx bxs-message-alt-error"></i></span>
                                </div>
                            </div>

                            </div>

                            <div class = "product-info">
                                <div class = "product-info-top">

                                </div>
                                <a  onclick="all_detail_product();" class = "product-name '.$data['MaNhomSP'].'">'.$data['Ten'].'</a>
                                <br>';
            $phanKM = (($data['GiaBan'] - $data['GiaKM'])*100)/$data['GiaBan'];
            if($data['GiaKM'] > 0) {
            $output.='          <p class = "product-price">'.number_format($data['GiaBan']).' đồng</p>
                                <br>
                                <p class = "product-price">'.number_format($data['GiaKM']).' đồng</p>
                                <div class = "off-info">
                                    <h2 class = "sm-title">'.$phanKM.'% khuyến mãi</h2>
                                </div>';
            } else {
            $output.='          <p class = "product-price" style="color:#17191b">....</p>
                                <br>
                                <p class = "product-price">'.number_format($data['GiaBan']).' đồng</p>';
            }
            $output.='      </div>
                        </div>';
        } else {
            if(isset($_SESSION['cart'][$data['MaNhomSP']])) {
                if($data['SoLuong']>$_SESSION['cart'][$data['MaNhomSP']]['SoLuong']) {
                    $output.='  <div class = "product">
                                    <div class = "product-content">
                                        <div class = "product-img">
                                            <img src = "../img/'.$data['HinhAnh'].'" alt = "product image" onclick="window.location='.$href.'">
                                        </div>
                                        <div class = "product-btns">
                                            <button type = "button" class = "btn-cart '.$data['MaNhomSP'].'"> Thêm vào giỏ hàng
                                                <span><i class = "fas fa-plus"></i></span>
                                            </button>
                                            <button type = "button" class = "btn-buy '.$data['MaNhomSP'].'"> Mua ngay
                                                <span><i class = "fas fa-shopping-cart"></i></span>
                                            </button>
                                        </div>
                                    </div>

                                    <div class = "product-info">
                                        <div class = "product-info-top">

                                        </div>
                                        <a href = "#" class = "product-name">'.$data['Ten'].'</a>
                                        <br>';
                    $phanKM = (($data['GiaBan'] - $data['GiaKM'])*100)/$data['GiaBan'];
                    if($data['GiaKM'] > 0) {
                    $output.='          <p class = "product-price">'.number_format($data['GiaBan']).' đồng</p>
                                        <br>
                                        <p class = "product-price">'.number_format($data['GiaKM']).' đồng</p>
                                        <div class = "off-info">
                                            <h2 class = "sm-title">'.$phanKM.'% khuyến mãi</h2>
                                        </div>';
                    } else {
                    $output.='          <p class = "product-price" style="color:#17191b">....</p>
                                        <br>
                                        <p class = "product-price">'.number_format($data['GiaBan']).' đồng</p>';
                    }
                    $output.='     
                                    </div>
                                </div>';
                } else {
                    $output.='  <div class = "product">
                        <div class = "product-content">
                            <div class = "product-img">
                                <img src = "../img/'.$data['HinhAnh'].'" alt = "product image" onclick="window.location='.$href.'">
                            </div>
                            <div class = "product-btns-hethang">
                            <div  class = "product-btns-hethang1"> hết hàng   
                                <span><i class="bx bxs-message-alt-error"></i></span>
                            </div>
                        </div>

                        </div>

                        <div class = "product-info">
                            <div class = "product-info-top">

                            </div>
                            <a  onclick="all_detail_product();" class = "product-name '.$data['MaNhomSP'].'">'.$data['Ten'].'</a>
                            <br>';
                    $phanKM = (($data['GiaBan'] - $data['GiaKM'])*100)/$data['GiaBan'];
                    if($data['GiaKM'] > 0) {
                    $output.='          <p class = "product-price">'.number_format($data['GiaBan']).' đồng</p>
                                        <br>
                                        <p class = "product-price">'.number_format($data['GiaKM']).' đồng</p>
                                        <div class = "off-info">
                                            <h2 class = "sm-title">'.$phanKM.'% khuyến mãi</h2>
                                        </div>';
                    } else {
                    $output.='          <p class = "product-price" style="color:#17191b">....</p>
                                        <br>
                                        <p class = "product-price">'.number_format($data['GiaBan']).' đồng</p>';
                    }
                    $output.='      </div>
                                </div>';    
                }
            } else {
                $output.='  <div class = "product">
                <div class = "product-content">
                    <div class = "product-img">
                        <img src = "../img/'.$data['HinhAnh'].'" alt = "product image" onclick="window.location='.$href.'">
                    </div>
                    <div class = "product-btns">
                        <button type = "button" class = "btn-cart '.$data['MaNhomSP'].'"> Thêm vào giỏ hàng
                            <span><i class = "fas fa-plus"></i></span>
                        </button>
                        <button type = "button" class = "btn-buy '.$data['MaNhomSP'].'"> Mua ngay
                            <span><i class = "fas fa-shopping-cart"></i></span>
                        </button>
                    </div>
                </div>

                <div class = "product-info">
                    <div class = "product-info-top">

                    </div>
                    <a href = "#" class = "product-name">'.$data['Ten'].'</a>
                    <br>';
                $phanKM = (($data['GiaBan'] - $data['GiaKM'])*100)/$data['GiaBan'];
                if($data['GiaKM'] > 0) {
                $output.='          <p class = "product-price">'.number_format($data['GiaBan']).' đồng</p>
                                    <br>
                                    <p class = "product-price">'.number_format($data['GiaKM']).' đồng</p>
                                    <div class = "off-info">
                                        <h2 class = "sm-title">'.$phanKM.'% khuyến mãi</h2>
                                    </div>';
                } else {
                $output.='          <p class = "product-price" style="color:#17191b">....</p>
                                    <br>
                                    <p class = "product-price">'.number_format($data['GiaBan']).' đồng</p>';
                }
                $output.='     
                                </div>
                            </div>';
            }
        }
        $href = ""; 
    }
    $output.='</div><div class="col-md-4"></div>';
    $output.='<ul class="pagination justify-content-center mt-5" id="pagination1">';
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
                $page_pages .= "<li class='page-item active'><a href='javascript:void(0)' name='".$id1."' class='page-link' data-page_number='".$page_array[$count]."'>".$page_array[$count]."
                                <span class='sr-only'>(current)</span></a></li>";
                $previous_id = $page_array[$count] - 1;

                if($previous_id > 0) {
                    $previous_pages = "<li class='page-item'><a class='page-link' href='javascript:void(0)'  name='".$id1."' 
                                        data-page_number='".$previous_id."'>Previous</a></li>";
                } else {
                    $previous_pages = "<li class='page-item disabled'><a class='page-link' href='#'>Previous</a></li>";
                }

                $next_id = $page_array[$count] + 1;

                if($next_id > $total_pages) {
                    $next_pages = "<li class='page-item disabled'><a class='page-link' href='#'>Next</a></li>";
                } else {
                    $next_pages = "<li class='page-item'><a name='".$id1."' class='page-link' href='javascript:void(0)' data-page_number='".$next_id."'>Next</a></li>";
                }
            } else {
                if($page_array[$count] == '...') {
                    $page_pages .= "<li class='page-item disabled'><a class='page-link' href='javascript:void(0)'>...</a></li>";
                } else {
                    $page_pages .= "<li class='page-item'><a class='page-link' href='javascript:void(0)' name='".$id1."' 
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
    echo $output;
?>