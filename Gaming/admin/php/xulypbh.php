<?php
    require_once("./KetnoiCSDL.php");
    $p=new CheckConnection();
    if (isset($_POST['kieu'])){
        $kieu=$_POST['kieu'];
        if ($kieu=="kieutimkiem"){
            $kieutk=$_POST['kieutk'];
            if ($kieutk==0)
                $s="";
            if ($kieutk==1){
                $s="<div class='row timkiemtheomasppbh'>
                        <div class='col-md-2 col-sm-2 div1'>Mã riêng sản phẩm:</div>
                        <div class='col-md-4 col-sm-4'>
                            <input class='form-control' type='text' id='masppbhtimkiem' placeholder='Nhập mã sản phẩm riêng cần tìm'  />
                        </div>
                    </div>";
            }
            if ($kieutk==2){
                $s="<div class='row timkiemtheothoigianpbh'>
                        <div class='col-md-2 col-sm-2 div1'>Thời gian bảo hành:</div>
                        <div class='col-md-4 col-sm-4'>
                            <input class='form-control' type='date' id='tungaypbhtimkiem' />
                        </div>
                        <div class='col-md-1 col-sm-2 div1'>-</div>
                        <div class='col-md-4 col-sm-4'>
                            <input class='form-control' type='date' id='denngaypbhtimkiem' />
                        </div>
                    </div>";
            }
            if ($kieutk==3){
                $s="<div class='row timkiemtheotinhtrang'>
                        <div class='col-md-2 col-sm-2 div1'>Tình trạng:</div>
                        <div class='col-md-4 col-sm-4'>
                            <select class='form-select' id='tinhtrangpbhtimkiem'>
                                <option value='0' selected>Chọn tình trạng cần tìm</option>
                                <option value='1'>Còn hạn</option>
                                <option value='2'>Hết hạn</option>
                            </select>
                        </div>
                    </div>";
            }
            echo $s;
        }   
        if ($kieu=="xoapbh"){
            $mapbh=$_POST['mapbh'];            
            $sql2="UPDATE `phieu_bao_hanh` SET TinhTrang=0 WHERE MaPBH='$mapbh'";
            $p->ExcuteQuery($sql2);            
            echo 1;            
        }         
    }
?>