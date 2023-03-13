<?php
    require_once("./KetnoiCSDL.php");
    require_once("./xulydulieu.php");    
    $p=new CheckConnection();
    $p1=new Xuly();
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    if (isset($_POST['kieu'])){
        $kieu=$_POST['kieu'];        
        if ($kieu=="suahd"){
            $id=$_POST['id'];
            $tt=$_POST['tt'];
            if ($tt!=4){
                $sql2="UPDATE `hoa_don` SET TinhTrang='$tt' WHERE MaHD='$id'";
                $p->ExcuteQuery($sql2);  
                echo 1;
            }
            else{
                $sql2="UPDATE `hoa_don` SET TinhTrang='$tt' WHERE MaHD='$id'";
                $p->ExcuteQuery($sql2);
                $sql="SELECT * FROM chi_tiet_hoa_don WHERE MaHD='$id'";
                $rs=$p->ExcuteQuery($sql);
                while($r=mysqli_fetch_array($rs)){
                    $d=$r[3];
                    $sql3="SELECT * FROM chi_tiet_sp WHERE MaNhomSP='$r[1]' AND TinhTrang=1 ORDER BY Stt ASC LIMIT 0,$d";
                    $rs3=$p->ExcuteQuery($sql3);
                    while($r3=mysqli_fetch_array($rs3)){
                        $s="UPDATE `chi_tiet_sp` SET `TinhTrang`=2 WHERE `MaSP`='$r3[0]'";
                        $p->ExcuteQuery($s);
                        $demsl="SELECT * FROM phieu_bao_hanh";
                        $dem=$p->ExcuteQuery($demsl);
                        $mapbh='PBH'.(mysqli_num_rows($dem)+1);
                        $today=date("Y-m-d");
                        $t=substr($today,0,4);
                        $t1=$t+2;
                        $today1=date("$t1-m-d");
                        $pbh="INSERT INTO `phieu_bao_hanh`(`MaPBH`, `MaSP`, `TuNgay`, `DenNgay`, `TinhTrang`) 
                        VALUES ('$mapbh','$r3[0]','$today','$today1',1)";
                        $p->ExcuteQuery($pbh);
                    }
                }
                echo 1;                
            }
        }
        if ($kieu=="xoahd"){
            $mahd=$_POST['mahd'];            
            $sql2="UPDATE `hoa_don` SET TinhTrang=0 WHERE MaHD='$mahd'";            
            $p->ExcuteQuery($sql2);            
            $sql="SELECT * FROM chi_tiet_hoa_don WHERE MaHD='$mahd'";
            $rs=$p->ExcuteQuery($sql);
            while($r=mysqli_fetch_array($rs)){
                $sql1="SELECT * FROM san_pham WHERE MaNhomSP='$r[1]'";
                $rs1=$p->ExcuteQuery($sql1);
                $r1=mysqli_fetch_row($rs1);
                $slmoi=$r1[6]+$r[3];
                $sql3="UPDATE `san_pham` SET `SoLuong`='$slmoi' WHERE `MaNhomSP`='$r[1]'";
                $p->ExcuteQuery($sql3);
            }
            echo 1;            
        }  
        if ($kieu=="timkiemhd"){
            $kieutk=$_POST['kieutk'];
            if ($kieutk==0)   
                $s="";
            if ($kieutk==1)   
                $s="<div class='row timkiemtheomanvhd'>
                        <div class='col-md-2 col-sm-2 div1'>Mã nhân viên:</div>
                        <div class='col-md-4 col-sm-4'>
                            <input class='form-control' type='text' id='manvhdtimkiem' placeholder='Nhập mã nhân viên cần tìm'  />
                        </div>
                    </div>";
            if ($kieutk==2)   
                $s="<div class='row timkiemtheotenkhhd'>
                        <div class='col-md-2 col-sm-2 div1'>Họ tên khách hàng:</div>
                        <div class='col-md-4 col-sm-4'>
                            <input class='form-control' type='text' id='tenkhhdtimkiem' placeholder='Nhập họ tên khách hàng cần tìm'  />
                        </div>
                    </div>";            
            if ($kieutk==3)   
                $s="<div class='row timkiemtheothoigianhd'>
                        <div class='col-md-2 col-sm-2 div1'>Ngày lập hóa đơn:</div>
                        <div class='col-md-4 col-sm-4'>
                            <input class='form-control' type='date' id='tungayhdtimkiem' />
                        </div>
                        <div class='col-md-1 col-sm-2 div1'>-</div>
                        <div class='col-md-4 col-sm-4'>
                            <input class='form-control' type='date' id='denngayhdtimkiem' />
                        </div>
                    </div>";
            if ($kieutk==4)   
                $s="<div class='row timkiemtheotinhtrang'>
                        <div class='col-md-2 col-sm-2 div1'>Tình trạng:</div>
                        <div class='col-md-4 col-sm-4'>
                            <select class='form-select' id='tinhtranghdtimkiem'>
                                <option value='0' selected>Chọn tình trạng cần tìm</option>
                                <option value='1'>Đang chờ xác nhận</option>
                                <option value='2'>Đã xác nhận</option>
                                <option value='3'>Đang giao</option>
                                <option value='4'>Hoàn thành</option>
                            </select>
                        </div>
                    </div>";
            echo $s;
        }  
        if ($kieu=="thongkehd"){
            $kieutk=$_POST['kieutk'];
            if ($kieutk==0)   
                $s="";                       
            if ($kieutk==1)   
                $s="<div class='row thongketheothoigianhd'>
                        <div class='col-md-2 col-sm-2 div1'>Ngày lập hóa đơn:</div>
                        <div class='col-md-4 col-sm-4'>
                            <input class='form-control' type='date' id='tungayhdthongke' />
                        </div>
                        <div class='col-md-1 col-sm-2 div1'>-</div>
                        <div class='col-md-4 col-sm-4'>
                            <input class='form-control' type='date' id='denngayhdthongke' />
                        </div>
                    </div>";
            if ($kieutk==2)   
                $s="<div class='row thongketheohangsphd'>
                        <div class='col-md-2 col-sm-2 div1'>Hạng sản phẩm</div>
                        <div class='col-md-4 col-sm-4'>
                            <input class='form-control' type='text' id='hangsphdthongke' placeholder='Nhập hạng sản phẩm cần thống kê'  />
                        </div>
                    </div>";
            echo $s;
        } 
        
        if ($kieu=='kieuthongke2'){
            $hangsp=$_POST['hangsp'];
            $sql="SELECT ct.MaNhomSP,SUM(ct.SoLuong) AS TongSL,SUM(ct.ThanhTien) AS TongTien 
            from chi_tiet_hoa_don as ct,hoa_don as hd 
            WHERE hd.MaHD=ct.MaHD AND hd.TinhTrang=4 GROUP BY ct.MaNhomSP ORDER BY TongSL DESC limit 0,$hangsp";
            $rs=$p->ExcuteQuery($sql);
            $tongtien=0;
            while($r=mysqli_fetch_array($rs)){
                $tongtien+=$r[2];
            }
            $tien=$p1->Chuyentien($tongtien);
            $s="<div class='row' id='tongtienhd'>
                    <div class='col-md-7 col-sm-7'></div>
                    <div class='col-md-5 col-sm-5'>
                        Tổng doanh thu: $tien
                    </div>
                </div>
                <div class='row'>
                    <table class='table table-bordered banghd'>
                        <thead>
                            <tr>
                                <th class='tbhd1'>Hạng</th>
                                <th class='tbhd2'>Mã sản phẩm</th>
                                <th class='tbhd3'>Tổng số lượng</th>
                                <th class='tbhd4'>Tổng tiền</th>
                            </tr>
                        </thead>
                        <tbody>";
            $stt=1;
            $sql="SELECT ct.MaNhomSP,SUM(ct.SoLuong) AS TongSL,SUM(ct.ThanhTien) AS TongTien 
            from chi_tiet_hoa_don as ct,hoa_don as hd 
            WHERE hd.MaHD=ct.MaHD AND hd.TinhTrang=4 GROUP BY ct.MaNhomSP ORDER BY TongSL DESC limit 0,$hangsp";
            $rs=$p->ExcuteQuery($sql);
            while($r=mysqli_fetch_array($rs)){
                $sl=$p1->Chuyentien($r[1]);
                $tongt=$p1->Chuyentien($r[2]);
                $s=$s."<tr>
                            <td class='hd1'>$stt</td>      
                            <td class='hd1'>$r[0]</td>                                  
                            <td class='hd1'>$sl</td>
                            <td class='hd1'>$tongt</td>
                        </tr>";
                $stt++;
            }
            $s=$s."</tbody>
            </table>            
        </div>";
            echo $s;
        } 
        if ($kieu=='kieuthongke1'){
            $tungay=$_POST['tungay'];
            $denngay=$_POST['denngay'];
            $page=1;
            if (isset($_POST['page']))
                $page=$_POST['page'];
            $tu=($page-1)*5;
            $sql="SELECT * FROM hoa_don WHERE TinhTrang=4 AND NgayLapHD>='$tungay' AND NgayLapHD<='$denngay'";
            $rs=$p->ExcuteQuery($sql);
            $tongtien=0;
            while($r=mysqli_fetch_array($rs)){
                $tongtien+=$r[11];
            }
            $tien=$p1->Chuyentien($tongtien);
            $s="<div class='row' id='tongtienhd'>
                    <div class='col-md-7 col-sm-7'></div>
                    <div class='col-md-5 col-sm-5'>
                        Tổng doanh thu: $tien
                    </div>
                </div>
                <div class='row'>
                    <table class='table table-bordered banghd'>
                        <thead>
                            <tr>
                                <th class='tbhd1'>Mã hóa đơn</th>
                                <th class='tbhd2'>Họ tên khách hàng</th>
                                <th class='tbhd3'>Ngày lập hóa đơn</th>
                                <th class='tbhd4'>Tổng tiền thanh toán</th>
                            </tr>
                        </thead>
                        <tbody>";
            $sql="SELECT * FROM hoa_don WHERE TinhTrang=4 AND NgayLapHD>='$tungay' AND NgayLapHD<='$denngay' LIMIT $tu,5";
            $rs=$p->ExcuteQuery($sql);
            while($r=mysqli_fetch_array($rs)){
                $tenkh=$r[3]." ".$r[4];
                $ngay=$p1->Chuyenngaythuan($r[8]);
                $tien=$p1->Chuyentien($r[11]);
                $s=$s."<tr>
                            <td class='hd1'>$r[0]</td>      
                            <td>$tenkh</td>                                  
                            <td class='hd1'>$ngay</td>
                            <td class='hd1'>$tien</td>
                        </tr>";
            }
            $s=$s."</tbody>
            </table>            
            </div>
            <div class='row phantranghd'>
                <div class='col-md-12 col-sm-12 phantranghd1'> ";            
            $sql="SELECT * FROM hoa_don WHERE TinhTrang=4 AND NgayLapHD>='$tungay' AND NgayLapHD<='$denngay'";
            $rs=$p->ExcuteQuery($sql);
            if (mysqli_num_rows($rs)>5){
                $k=ceil(mysqli_num_rows($rs)/5);
                $s=$s."<div page='1' style='background-color:#0d6efd'>1</div>";
                for ($i=2;$i<=$k;$i++){
                    if ($i!=$k){
                        if ($i<$page-4 || $i>$page+4){
                            if ($i==$page-6 || $i==$page+6)
                                $s=$s."<div>...</div>";                            
                            $s=$s."<div class='pagemenuhide' page='$i'>$i</div>";
                        }
                        if ($i>=$page-4 && $i<=$page+4){
                            if ($i==$page)
                                $s=$s."<div style='background-color:#0d6efd' page='$i>$i</div>";
                            else
                                $s=$s."<div page='$i'>$i</div>";
                        }      
                    } 
                    else{
                        if ($i==$page)
                            $s=$s."<div style='background-color:#0d6efd' page='$i'>$i</div>";
                        else
                            $s=$s."<div page='$i'>$i</div>";
                    }                                
                }
            }
            $s=$s."</div>
            </div>";
                echo $s;
        }     
    }
?>