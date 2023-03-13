<link rel="stylesheet" href="../css/hoadon2.css">
<div class="container hd">
    <div class="row tieudehd">
        <div class="col-md-12">Thông tin hóa đơn</div>
    </div>
    <div class="row themhd">  
        <?php
            require_once("./KetnoiCSDL.php");
            $p=new CheckConnection();
            require_once("./xulydulieu.php");
            $p1=new Xuly();
            if (isset($_GET['id']))
                $id=$_GET['id'];
            $sql="SELECT * FROM hoa_don WHERE MaHD='$id'";
            $rs1=$p->ExcuteQuery($sql);
            $r=mysqli_fetch_row($rs1);
            $hoten=$r[3]." ".$r[4];
            $tongtien=$p1->Chuyentien($r[9]);
            $tongtienkm=$p1->Chuyentien($r[10]);
            $tongtienphaitra=$p1->Chuyentien($r[11]);
            $tinhtrang="<input class='form-control' style='background-color:white' type='text' value='$tongtienphaitra' readonly  />";
            if ($r[12]==1)
                $tinhtrang="<input class='form-control' style='background-color:white;color:red;font-weight:600;' type='text' value='Đang chờ xác nhận' readonly  />";
            if ($r[12]==2)
                $tinhtrang="<input class='form-control' style='background-color:white;color:rgb(250, 155, 12);font-weight:600;' type='text' value='Đã xác nhận' readonly  />";
            if ($r[12]==3)
                $tinhtrang="<input class='form-control' style='background-color:white;color:#c2d32f;font-weight:600;' type='text' value='Đang giao' readonly  />";
            if ($r[12]==4)
                $tinhtrang="<input class='form-control' style='background-color:white;color:rgb(22, 184, 22);font-weight:600;' type='text' value='Hoàn thành' readonly  />";
            $s="<div class='col-md-6 col-sm-6'>
                    <div class='row div4'>
                        <div class='col-md-2 col-sm-2'></div>
                        <div class='col-md-6 col-sm-6 div2'>Mã hóa đơn</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-2 col-sm-2'></div>             
                        <div class='col-md-6 col-sm-6 div3'>
                            <input class='form-control' style='background-color:white' type='text' id='suamahd' value='$r[0]' readonly  />             
                        </div>     
                    </div>  
                    <div class='row div4'>
                        <div class='col-md-2 col-sm-2'></div>
                        <div class='col-md-6 col-sm-6 div2'>Mã khách hàng</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-2 col-sm-2'></div>             
                        <div class='col-md-6 col-sm-6 div3'>
                            <input class='form-control' style='background-color:white' type='text' id='suamahd' value='$r[2]' readonly  />             
                        </div>     
                    </div>   
                    <div class='row div4'>
                        <div class='col-md-2 col-sm-2'></div>
                        <div class='col-md-6 col-sm-6 div2'>Mã nhân viên</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-2 col-sm-2'></div>             
                        <div class='col-md-6 col-sm-6 div3'>
                            <input class='form-control' style='background-color:white' type='text' id='suamahd' value='$r[2]' readonly  />             
                        </div>     
                    </div>  
                    <div class='row div4'>
                        <div class='col-md-2 col-sm-2'></div>
                        <div class='col-md-6 col-sm-6 div2'>Họ tên khách hàng</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-2 col-sm-2'></div>             
                        <div class='col-md-6 col-sm-6 div3'>
                            <input class='form-control' style='background-color:white' type='text' id='suamahd' value='$hoten' readonly  />             
                        </div>     
                    </div> 
                    <div class='row div4'>
                        <div class='col-md-2 col-sm-2'></div>
                        <div class='col-md-6 col-sm-6 div2'>Số điện thoại</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-2 col-sm-2'></div>             
                        <div class='col-md-6 col-sm-6 div3'>
                            <input class='form-control' style='background-color:white' type='text' value='$r[5]' readonly  />             
                        </div>     
                    </div> 
                    <div class='row div4'>
                        <div class='col-md-2 col-sm-2'></div>
                        <div class='col-md-6 col-sm-6 div2'>Địa chỉ</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-2 col-sm-2'></div>             
                        <div class='col-md-6 col-sm-6 div3'>
                        <textarea class='form-control' style='background-color:white' readonly placeholder='Nhập mô tả sản phẩm' rows='4'>$r[6]</textarea>             
                        </div>     
                    </div> 
                </div>
                <div class='col-md-6 col-sm-6'>
                    <div class='row div4'>
                        <div class='col-md-2 col-sm-2'></div>
                        <div class='col-md-6 col-sm-6 div2'>Email</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-2 col-sm-2'></div>             
                        <div class='col-md-6 col-sm-6 div3'>
                            <input class='form-control' style='background-color:white' type='text' value='$r[7]' readonly  />             
                        </div>     
                    </div> 
                    <div class='row div4'>
                        <div class='col-md-2 col-sm-2'></div>
                        <div class='col-md-6 col-sm-6 div2'>Ngày lập hóa đơn</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-2 col-sm-2'></div>             
                        <div class='col-md-6 col-sm-6 div3'>
                            <input class='form-control' style='background-color:white' type='text' value='$r[8]' readonly  />             
                        </div>     
                    </div> 
                    <div class='row div4'>
                        <div class='col-md-2 col-sm-2'></div>
                        <div class='col-md-6 col-sm-6 div2'>Tổng tiền</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-2 col-sm-2'></div>             
                        <div class='col-md-6 col-sm-6 div3'>
                            <input class='form-control' style='background-color:white' type='text' value='$tongtien' readonly  />             
                        </div>     
                    </div>
                    <div class='row div4'>
                        <div class='col-md-2 col-sm-2'></div>
                        <div class='col-md-6 col-sm-6 div2'>Tổng tiền khuyến mãi</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-2 col-sm-2'></div>             
                        <div class='col-md-6 col-sm-6 div3'>
                            <input class='form-control' style='background-color:white' type='text' value='$tongtienkm' readonly  />             
                        </div>     
                    </div>
                    <div class='row div4'>
                        <div class='col-md-2 col-sm-2'></div>
                        <div class='col-md-6 col-sm-6 div2'>Tổng tiền thanh toán</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-2 col-sm-2'></div>             
                        <div class='col-md-6 col-sm-6 div3'>
                            <input class='form-control' style='background-color:white' type='text' value='$tongtienphaitra' readonly  />             
                        </div>     
                    </div>
                    <div class='row div4'>
                        <div class='col-md-2 col-sm-2'></div>
                        <div class='col-md-6 col-sm-6 div2'>Tình trạng</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-2 col-sm-2'></div>             
                        <div class='col-md-6 col-sm-6 div3'>"
                            .$tinhtrang."                            
                        </div>     
                    </div>
                </div>                              
                <div class='row' style='margin-top:30px;margin-bottom:50px'>";
            $s=$s."<table class='table table-bordered banghd'>
                        <thead>
                            <tr>
                                <th class='tbhd1'>Mã sản phẩm</th>
                                <th class='tbhd2' style='width:10%'>Mã khuyến mãi</th>
                                <th class='tbhd3' style='width:10%'>Số lượng</th>
                                <th class='tbhd4'>Đơn giá</th>
                                <th class='tbhd5'>Thành tiền</th>
                                <th class='tbhd6' style='width:15%'>Tiền khuyến mãi</th>
                            </tr>
                        </thead>
                        <tbody>";        
            $sql="SELECT * FROM chi_tiet_hoa_don WHERE MaHD='$id'";
            $rs=$p->ExcuteQuery($sql);
            while($r1=mysqli_fetch_array($rs)){
                $sl=$p1->Chuyentien($r1[3]);
                $dongia=$p1->Chuyentien($r1[4]);
                $thanhtien=$p1->Chuyentien($r1[5]);
                $tienkm=$p1->Chuyentien($r1[6]);
                $s=$s."<tr>
                            <td class='hd1'>$r1[1]</td>
                            <td class='hd1'>$r1[2]</td>
                            <td class='hd1'>$sl</td>
                            <td class='hd1'>$dongia</td>
                            <td class='hd1'>$thanhtien</td> 
                            <td class='hd1'>$tienkm</td> 
                        </tr>";
            }
            $s=$s."</tbody>
            </table>            
        </div> ";
            echo $s;
        ?>                                            
        </div> 
    </div>
</div>