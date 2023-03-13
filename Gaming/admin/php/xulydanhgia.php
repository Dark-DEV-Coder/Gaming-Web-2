<?php
    require_once("./KetnoiCSDL.php");
    $p=new CheckConnection();
    if (isset($_POST['kieu'])){
        $kieu=$_POST['kieu'];        
        if ($kieu=="xoadg"){
            $madg=$_POST['madg'];            
            $sql2="UPDATE `danh_gia_sp` SET TinhTrang=0 WHERE MaBinhLuan='$madg'";
            $p->ExcuteQuery($sql2);            
            echo 1;            
        }  
        if ($kieu=="timkiemdg"){
            $kieutk=$_POST['kieutk'];
            if ($kieutk==0)   
                $s="";            
            if ($kieutk==1)   
                $s="<div class='row timkiemtheotentkdg'>
                        <div class='col-md-2 col-sm-2 div1'>Tên tài khoản:</div>
                        <div class='col-md-4 col-sm-4'>
                            <input class='form-control' type='text' id='tentkdgtimkiem' placeholder='Nhập tên tài khoản cần tìm'  />
                        </div>
                    </div>";
            if ($kieutk==2)   
                $s="<div class='row timkiemtheomaspdg'>
                        <div class='col-md-2 col-sm-2 div1'>Mã sản phẩm:</div>
                        <div class='col-md-4 col-sm-4'>
                            <input class='form-control' type='text' id='maspdgtimkiem' placeholder='Nhập mã sản phẩm cần tìm'  />
                        </div>
                    </div>";
            if ($kieutk==3)   
                $s="<div class='row timkiemtheotinhtrang'>
                        <div class='col-md-2 col-sm-2 div1'>Đánh giá:</div>
                        <div class='col-md-4 col-sm-4'>
                            <select class='form-select' id='tinhtrangdgtimkiem'>
                                <option value='0' selected>Chọn số sao đánh giá cần tìm</option>
                                <option value='1'>1</option>
                                <option value='2'>2</option>
                                <option value='3'>3</option>
                                <option value='4'>4</option>
                                <option value='5'>5</option>
                            </select>
                        </div>
                    </div>";
            echo $s;
        } 
    }
?>