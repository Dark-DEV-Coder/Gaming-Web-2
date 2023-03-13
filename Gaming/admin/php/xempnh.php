<link rel="stylesheet" href="../css/phieunhaphang1.css">
<div class="container pnh">
    <div class="row tieudepnh">
        <div class="col-md-12">Thông tin phiếu nhập hàng</div>
    </div>
    <div class="row thempnh">  
        <?php
            require_once("./KetnoiCSDL.php");
            $p=new CheckConnection();
            require_once("./xulydulieu.php");
            $p1=new Xuly();
            if (isset($_GET['id']))
                $id=$_GET['id'];
            $sql="SELECT * FROM phieu_nhap_hang WHERE MaPNH='$id'";
            $rs1=$p->ExcuteQuery($sql);
            $r1=mysqli_fetch_row($rs1);
            $s="<div class='row div4'>
                        <div class='col-md-3 col-sm-3'></div>
                        <div class='col-md-6 col-sm-6 div2'>Mã phiếu nhập hàng</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-3 col-sm-3'></div>             
                        <div class='col-md-6 col-sm-6 div3'>
                            <input class='form-control' style='background-color:white' type='text' id='suamapnh' value='$r1[0]' readonly  />             
                        </div>     
                    </div>  
                    <div class='row div4'>
                        <div class='col-md-3 col-sm-3'></div>
                        <div class='col-md-6 col-sm-6 div2'>Mã nhân viên</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-3 col-sm-3'></div>             
                        <div class='col-md-6 col-sm-6 div3'>
                            <input class='form-control' style='background-color:white' type='text' id='suamapnh' value='$r1[1]' readonly  />             
                        </div>     
                    </div>    
                    <div class='row div4'>
                        <div class='col-md-3 col-sm-3'></div>
                        <div class='col-md-6 col-sm-6 div2'>Nhà sản xuất</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-3 col-sm-3'></div>             
                        <div class='col-md-6 col-sm-6 div3'>
                            <select class='form-select' id='suamansxpnh' disabled='true' style='background-color:white'>
                                <option value='0'>Chọn nhà sản xuất</option>";            
            $sql="SELECT * FROM nha_san_xuat WHERE TinhTrang!=0";
            $rs=$p->ExcuteQuery($sql);
            while($r=mysqli_fetch_array($rs)){
                if ($r[0]==$r1[2])
                    $s=$s."<option value='$r[0]' selected>$r[1]</option>";
                else
                    $s=$s."<option value='$r[0]'>$r[1]</option>";
            }
            $tongtien=$p1->Chuyentien($r1[3]);
            $s=$s."</select>
                    </div>     
                </div>
                <div class='row div4'>
                    <div class='col-md-3 col-sm-3'></div>
                    <div class='col-md-6 col-sm-6 div2'>Ngày nhập hàng</div>                               
                </div>
                <div class='row'>  
                    <div class='col-md-3 col-sm-3'></div>             
                    <div class='col-md-6 col-sm-6 div3'>
                        <input class='form-control' style='background-color:white' type='date' id='suangaynhappnh' value='$r1[4]' readonly  />
                    </div>     
                </div> 
                <div class='row div4'>
                        <div class='col-md-3 col-sm-3'></div>
                        <div class='col-md-6 col-sm-6 div2'>Tổng tiền</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-3 col-sm-3'></div>             
                        <div class='col-md-6 col-sm-6 div3'>
                            <input class='form-control' style='background-color:white' type='text' id='suatienpnh' value='$tongtien' readonly  />             
                        </div>     
                    </div>                 
                <div class='row' style='margin-top:30px;margin-bottom:50px'>";
            $s=$s."<table class='table table-bordered bangpnh'>
                        <thead>
                            <tr>
                                <th class='tbpnh1'>Mã sản phẩm</th>
                                <th class='tbpnh2'>Số lượng</th>
                                <th class='tbpnh3'>Giá gốc</th>
                                <th class='tbpnh4'>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>";        
            $sql="SELECT * FROM chi_tiet_phieu_nhap WHERE MaPNH='$id'";
            $rs=$p->ExcuteQuery($sql);
            while($r=mysqli_fetch_array($rs)){
                $sl=$p1->Chuyentien($r[2]);
                $gianhap=$p1->Chuyentien($r[3]);
                $thanhtien=$p1->Chuyentien($r[4]);
                $s=$s."<tr>
                            <td class='pnh1'>$r[1]</td>
                            <td class='pnh1'>$sl</td>
                            <td class='pnh1'>$gianhap</td>
                            <td class='pnh1'>$thanhtien</td> 
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