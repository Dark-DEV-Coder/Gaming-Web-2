<?php 
    require_once "./KetnoiCSDL.php";
    session_start();
    $p = new CheckConnection();
    $id = $_POST['id'];
    $sql1 = "SELECT MaLoai FROM `san_pham` WHERE MaNhomSP = '$id'";
    $res1 = $p->ExcuteQuery($sql1);
    $obj1 = $res1->fetch_object();
    $maloai = $obj1->MaLoai;

    $limit = 9 ;
    $page = 1;
    if($_POST['page'] > 1) {
        $offset = (($_POST['page'] - 1) * $limit);
        $page = $_POST['page'];
    } else {
        $offset = 0;
    }

    $sql = "SELECT * FROM `san_pham` WHERE MaLoai = '$maloai' ORDER BY MaNhomSP ASC LIMIT $limit OFFSET $offset";
    $res = $p->ExcuteQuery($sql);
    $output='';
    
    

    $query = "SELECT * FROM san_pham WHERE MaNhomSP = '$id'";
    $res1=$p->ExcuteQuery($query);
    $obj=$res1->fetch_object();
    if(isset($_POST['id'])) {
        if(isset($_SESSION['cart'])) {
            if(isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id]['SoLuong'] += 1;
                
            } else {
                $_SESSION['cart'][$id]['MaNhomSP'] = $obj->MaNhomSP;
                $_SESSION['cart'][$id]['MaLoai'] = $obj->MaLoai;
                $_SESSION['cart'][$id]['MaNSX'] = $obj->MaNSX;
                $_SESSION['cart'][$id]['Ten'] = $obj->Ten;
                $_SESSION['cart'][$id]['HinhAnh'] = $obj->HinhAnh;
                $_SESSION['cart'][$id]['MoTa'] = $obj->MoTa;
                $_SESSION['cart'][$id]['GiaBan'] = $obj->GiaBan;
                $_SESSION['cart'][$id]['GiaKM'] = $obj->GiaKM;
                $_SESSION['cart'][$id]['SoLuong'] = 1;
               
            }
        }else {
            $_SESSION['cart'][$id]['MaNhomSP'] = $obj->MaNhomSP;
            $_SESSION['cart'][$id]['MaLoai'] = $obj->MaLoai;
            $_SESSION['cart'][$id]['MaNSX'] = $obj->MaNSX;
            $_SESSION['cart'][$id]['Ten'] = $obj->Ten;
            $_SESSION['cart'][$id]['HinhAnh'] = $obj->HinhAnh;
            $_SESSION['cart'][$id]['MoTa'] = $obj->MoTa;
            $_SESSION['cart'][$id]['GiaBan'] = $obj->GiaBan;
            $_SESSION['cart'][$id]['GiaKM'] = $obj->GiaKM;
            $_SESSION['cart'][$id]['SoLuong'] = 1;
           
        }
    }
    $sqlslsl = "SELECT SoLuong FROM `san_pham` WHERE MaNhomSP='$id'";
    $resslsl = $p->ExcuteQuery($sqlslsl);
    $soluong = $resslsl->fetch_object();
    $_SESSION['odertotal']=0;
    $_SESSION['cart'][$id]['TongCong']=0;
    $_SESSION['TongSoLuong']=0;
    $_SESSION['cart'][$id]['TongCong']=0;
    $_SESSION['Tongtien']=0;
    $_SESSION['Tongtienkm']=0;
    $_SESSION['stt']=0;
    if($_SESSION['cart'][$id]['SoLuong'] > $soluong->SoLuong) {
        $_SESSION['cart'][$id]['SoLuong']= (int)$soluong->SoLuong;         
    } else {
        $_SESSION['TongSoLuong']+=$_SESSION['cart'][$id]['SoLuong'];
    }

    foreach($_SESSION['cart'] as $keys => $values) {
        if($values['GiaKM']>0){
            $_SESSION['odertotal']+=$values['GiaKM']*$values['SoLuong'];
            $_SESSION['cart'][$id]['TongCong']=$values['GiaKM']*$values['SoLuong'];
        }else{
            $_SESSION['odertotal']+=$values['GiaBan']*$values['SoLuong'];
            $_SESSION['cart'][$id]['TongCong']=$values['GiaBan'];
        }
        $_SESSION['TongSoLuong']+=$values['SoLuong'];
        $_SESSION['Tongtien']+=$values['GiaBan']*$values['SoLuong'];
        $_SESSION['Tongtienkm']+=$values['GiaKM']*$values['SoLuong'];
        $_SESSION['stt']+=$values['SoLuong'];
    }
         
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
                                            <button type = "button" class = "btn-buy '.$data['MaNhomSP'].'"> Mua hàng
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
                        <button type = "button" class = "btn-buy '.$data['MaNhomSP'].'"> Mua hàng
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
        $href='';
    }
    echo $output;
?>