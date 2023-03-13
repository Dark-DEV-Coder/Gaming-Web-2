<?php 
session_start();
if(isset($_POST['id'])) {
    require_once "./KetnoiCSDL.php";
    $p=new CheckConnection();
    $id=$_POST['id'];
    $query = "SELECT * FROM san_pham WHERE MaNhomSP = '$id'";
    $res1=$p->ExcuteQuery($query);
    $obj=$res1->fetch_object();
    $output="";
        if(isset($_SESSION['cart'])) {
            if(isset($_SESSION['cart'][$id])) {
                //echo 1;
                if($_POST['pheptinh']==1){
                    if($obj->SoLuong>$_SESSION['cart'][$id]['SoLuong']){
                        $_SESSION['stt'] += 1;
                        $_SESSION['cart'][$id]['SoLuong'] += 1;
                        if($_SESSION['cart'][$id]['GiaKM']>0){
                            $_SESSION['cart'][$id]['TongCong']=$_SESSION['cart'][$id]['GiaKM']*$_SESSION['cart'][$id]['SoLuong'];
                            $_SESSION['odertotal']+=$_SESSION['cart'][$id]['GiaKM'];
                        }else{
                            $_SESSION['cart'][$id]['TongCong'] = $_SESSION['cart'][$id]['GiaBan']*$_SESSION['cart'][$id]['SoLuong'];
                            $_SESSION['odertotal']+=$_SESSION['cart'][$id]['GiaBan'];
                        }
                        $_SESSION['Tongtien']+=$_SESSION['cart'][$id]['GiaBan'];
                        $_SESSION['Tongtienkm']+=$_SESSION['cart'][$id]['GiaKM'];
                    }
                }else{
                    if($_SESSION['cart'][$id]['SoLuong']==1){
                        $_SESSION['cart'][$id]['SoLuong']=1;
                    }else{
                        $_SESSION['stt'] -= 1;
                        $_SESSION['cart'][$id]['SoLuong'] -= 1;
                        $_SESSION['Tongtien']-=$_SESSION['cart'][$id]['GiaBan'];
                        $_SESSION['Tongtienkm']-=$_SESSION['cart'][$id]['GiaKM'];
                        if($_SESSION['cart'][$id]['GiaKM']>0){
                            $_SESSION['cart'][$id]['TongCong']=$_SESSION['cart'][$id]['GiaKM']*$_SESSION['cart'][$id]['SoLuong'];
                            $_SESSION['odertotal']-=$_SESSION['cart'][$id]['GiaKM'];
                        }else{
                            $_SESSION['cart'][$id]['TongCong'] = $_SESSION['cart'][$id]['GiaBan']*$_SESSION['cart'][$id]['SoLuong'];
                            $_SESSION['odertotal']-=$_SESSION['cart'][$id]['GiaBan'];
                        }
                    }
                }
                $output.='
                    <div class="container-fluid">
                        <div class="row">
                        <div class="col-lg-10 offset-lg-1">
                                <div class="cart_container">
                                <div class="cart_title" style="color:white; ">Giỏ hàng<small> ('.$_SESSION['stt'].' sản phẩm trong giỏ hàng) </small></div>';
                                    foreach($_SESSION['cart'] as $key => $value){
                  $output.=        '<div class="cart_items">
                                        <ul class="cart_list">
                                            <li class="cart_item clearfix">
                                                <div class="cart_item_image"><img src="../img/'.$value['HinhAnh'].'" alt=""></div>
                                                <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                                    <div class="cart_item_name cart_info_col">
                                                        <div class="cart_item_title">Tên sản phẩm</div>
                                                        <div style="width:200px" class="cart_item_text">'.$value['Ten'].'</div>
                                                    </div>
                                                    <div class="cart_item_quantity cart_info_col">
                                                        <div class="cart_item_title">Số lượng</div>
                                                        <div class="cart_item_text"><button  onclick="cart(this)" id="'.$value['MaNhomSP'].'" style="width:20px;background-color:#009432;border:1px solid #009432" type="button" class="tru btn-warning" value="-1">-</button><span style="width:40px; margin:auto; text-align:center">'.$value['SoLuong'].'</span><button onclick="cart(this)" id="'.$value['MaNhomSP'].'" style="width:20px;background-color:#009432;border:1px solid #009432" type="button" class="cong btn-warning" value="1">+</button></div>
                                                    </div>
                                                    <div class="cart_item_price cart_info_col">
                                                        <div class="cart_item_title">Giá gốc</div>
                                                        <div class="cart_item_text">'.number_format($value['GiaBan']).'</div>
                                                    </div>
                                                    <div class="cart_item_price cart_info_col">
                                                        <div class="cart_item_title">Giá khuyến mãi</div>
                                                        <div class="cart_item_text">'.number_format($value['GiaKM']).'</div>
                                                    </div>
                                                    <div class="cart_item_total cart_info_col">
                                                        <div class="cart_item_title">Tổng cộng</div>
                                                        <div class="cart_item_text">'.number_format($value['TongCong']).'</div>
                                                    </div>
                                                    <div class="cart_item_total cart_info_col">
                                                        <div class="cart_item_title">Xóa sản phẩm</div>
                                                        <div class="cart_item_text"><a style="color:black" href="xoagiohang.php?dele='.$value['MaNhomSP'].'"><i class="fas fa-trash-alt"></i></a></div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    ';
                                    }
                   $output.=        '<div class="order_total">
                                        <div class="order_total_content text-md-right">
                                            <div class="order_total_title">Tổng tiền giỏ hàng:</div>
                                            <div class="order_total_amount">'.number_format($_SESSION['odertotal']).' đồng</div>
                                        </div>
                                    </div>';
                                    if(isset($_SESSION['taikhoan'])) { 
                                        if($_SESSION['taikhoan']['quyen']=='KH') {
                    $output.=       '<div class="cart_buttons">  <button type="button" class="button1 cart_button_checkout" data-toggle="modal" data-target="#modalthanhtoan">Mua hàng</button> </div>';
                                        }
                                    } else {       
                    $output.=       '<div class="cart_buttons"> <button type="button" class="button1 cart_button_checkout" data-toggle="modal" data-target="#modalthanhtoan">Mua hàng</button> </div>';        
                                    }
                    $output.='  </div>
                            </div>
                        </div>
                    </div>
                ';
            } else {
                $_SESSION['stt'] += 1;
                $_SESSION['cart'][$id]['MaNhomSP'] = $obj->MaNhomSP;
                $_SESSION['cart'][$id]['MaLoai'] = $obj->MaLoai;
                $_SESSION['cart'][$id]['MaNSX'] = $obj->MaNSX;
                $_SESSION['cart'][$id]['Ten'] = $obj->Ten;
                $_SESSION['cart'][$id]['HinhAnh'] = $obj->HinhAnh;
                $_SESSION['cart'][$id]['MoTa'] = $obj->MoTa;
                $_SESSION['cart'][$id]['GiaBan'] = $obj->GiaBan;
                $_SESSION['cart'][$id]['GiaKM'] = $obj->GiaKM;
                $_SESSION['cart'][$id]['SoLuong'] = 1;
                if($_SESSION['cart'][$id]['GiaKM']>0){
                    $_SESSION['cart'][$id]['TongCong']=$_SESSION['cart'][$id]['GiaKM'];
                    $_SESSION['odertotal']+=$_SESSION['cart'][$id]['GiaKM'];
                }else{
                    $_SESSION['cart'][$id]['TongCong'] = $_SESSION['cart'][$id]['GiaBan'];
                    $_SESSION['odertotal']+=$_SESSION['cart'][$id]['GiaBan'];
                }
                
            }
        }else {
            $_SESSION['stt'] = 1;
            $_SESSION['cart'][$id]['MaNhomSP'] = $obj->MaNhomSP;
            $_SESSION['cart'][$id]['MaLoai'] = $obj->MaLoai;
            $_SESSION['cart'][$id]['MaNSX'] = $obj->MaNSX;
            $_SESSION['cart'][$id]['Ten'] = $obj->Ten;
            $_SESSION['cart'][$id]['HinhAnh'] = $obj->HinhAnh;
            $_SESSION['cart'][$id]['MoTa'] = $obj->MoTa;
            $_SESSION['cart'][$id]['GiaBan'] = $obj->GiaBan;
            $_SESSION['cart'][$id]['GiaKM'] = $obj->GiaKM;
            $_SESSION['cart'][$id]['SoLuong'] = 1;
            if(isset($_SESSION['cart'][$id]['GiaKM'])){
                $_SESSION['Tongtienkm']=$_SESSION['cart'][$id]['GiaKM'];
            }else{
                $_SESSION['Tongtienkm']=0;
            }
            if($_SESSION['cart'][$id]['GiaKM']>0){
                $_SESSION['cart'][$id]['TongCong']=$_SESSION['cart'][$id]['GiaKM'];
                $_SESSION['odertotal']=$_SESSION['cart'][$id]['GiaKM'];
            }else{
                $_SESSION['cart'][$id]['TongCong'] = $_SESSION['cart'][$id]['GiaBan'];
                $_SESSION['odertotal']=$_SESSION['cart'][$id]['GiaBan'];
            }
        }
   echo $output;
}
?>