
<link rel="stylesheet" href="../css/sanpham4.css">
<div class="container sp">
    <div class="row tieudesp">
        <div class="col-md-12">Thông tin sản phẩm</div>
    </div>
    <div class="row themsp"> 
        <?php
            require_once("./KetnoiCSDL.php");
            require_once("./xulydulieu.php");
            $p=new CheckConnection();
            $p1=new Xuly();
            if (isset($_GET['id']))
                $id=$_GET['id'];
            $sql1="SELECT * FROM san_pham WHERE MaNhomSP='$id'";
            $rs=$p->ExcuteQuery($sql1);
            $r=mysqli_fetch_row($rs);
            $sl=$p1->Chuyentien($r[6]);
            $giaban=$p1->Chuyentien($r[7]);
            $giakm=$p1->Chuyentien($r[8]);
            $giagoc=$p1->Chuyentien($r[9]);
            $s="<div class='row div4'>
                    <div class='col-md-3 col-sm-3'></div>
                    <div class='col-md-3 col-sm-3 div2'>Mã sản phẩm</div>                               
                </div>
                <div class='row'>  
                    <div class='col-md-3 col-sm-3'></div>             
                    <div class='col-md-6 col-sm-6 div3'>
                        <input class='form-control' style='background-color:white' value='$r[0]' type='text' id='suamasp' readonly  />
                    </div>     
                </div>       
                <div class='row div4'>
                    <div class='col-md-3 col-sm-3'></div>
                    <div class='col-md-3 col-sm-3 div2'>Loại sản phẩm</div>                               
                </div>
                <div class='row'>  
                    <div class='col-md-3 col-sm-3'></div>             
                    <div class='col-md-6 col-sm-6 div3'>
                        <select class='form-select' style='background-color:white' id='sualoaisp' disabled='true>
                            <option value='0'>Chọn loại sản phẩm</option>";
            $sql="SELECT * FROM loai_sp WHERE TinhTrang!=0";
            $p=new CheckConnection();
            $rs1=$p->ExcuteQuery($sql);
            while($r1=mysqli_fetch_array($rs1)){
                if ($r1[0]==$r[1])
                    $s=$s."<option value='$r1[0]' selected>$r1[1]</option>";
                else
                    $s=$s."<option value='$r1[0]'>$r1[1]</option>";
            }
            $s=$s."</select>
                    </div>     
                </div>
                <div class='row div4'>
                    <div class='col-md-3 col-sm-3'></div>
                    <div class='col-md-3 col-sm-3 div2'>Nhà sản xuất</div>                               
                </div>
                <div class='row'>  
                    <div class='col-md-3 col-sm-3'></div>             
                    <div class='col-md-6 col-sm-6 div3'>
                        <select class='form-select' style='background-color:white' id='suansxsp' disabled='true'>
                            <option value='0'>Chọn nhà sản xuất</option>";                           
            $sql="SELECT * FROM nha_san_xuat WHERE TinhTrang!=0";
            $p=new CheckConnection();
            $rs1=$p->ExcuteQuery($sql);
            while($r1=mysqli_fetch_array($rs1)){
                if ($r1[0]==$r[2])
                    $s=$s."<option value='$r1[0]' selected>$r1[1]</option>";
                else
                    $s=$s."<option value='$r1[0]'>$r1[1]</option>";
            }
            $s=$s." </select>
            </div>     
                </div>
                <div class='row div4'>
                    <div class='col-md-3 col-sm-3'></div>
                    <div class='col-md-3 col-sm-3 div2'>Tên sản phẩm</div>                               
                </div>
                <div class='row'>  
                    <div class='col-md-3 col-sm-3'></div>             
                    <div class='col-md-6 col-sm-6 div3'>
                        <input class='form-control' style='background-color:white' readonly value='$r[3]' type='text' id='suatensp' placeholder='Nhập tên sản phẩm'  />
                    </div>     
                </div>
                <div class='row div4'>
                    <div class='col-md-3 col-sm-3'></div>
                    <div class='col-md-3 col-sm-3 div2'>Hình ảnh</div>                               
                </div>                
                <div class='row div4'>
                    <div class='col-md-3 col-sm-3'></div>
                    <div class='col-md-3 col-sm-3 div2' id='hienhinhanh'>
                        <img src='../img/$r[4]' />
                    </div>                               
                </div>
                <div class='row div4'>
                    <div class='col-md-3 col-sm-3'></div>
                    <div class='col-md-3 col-sm-3 div2'>Mô tả sản phẩm</div>                               
                </div>
                <div class='row'>  
                    <div class='col-md-3 col-sm-3'></div>             
                    <div class='col-md-6 col-sm-6 div3'>
                        <textarea class='form-control' style='background-color:white' readonly placeholder='Nhập mô tả sản phẩm' rows='5' id='suamotasp'>$r[5]</textarea>
                    </div>     
                </div>
                <div class='row div4'>
                    <div class='col-md-3 col-sm-3'></div>
                    <div class='col-md-3 col-sm-3 div2'>Số lượng</div>                               
                </div>
                <div class='row'>  
                    <div class='col-md-3 col-sm-3'></div>             
                    <div class='col-md-6 col-sm-6 div3'>
                        <input class='form-control' style='background-color:white' readonly value='$sl' type='text' id='suatensp' placeholder='Nhập tên sản phẩm'  />
                    </div>     
                </div>
                <div class='row div4'>
                    <div class='col-md-3 col-sm-3'></div>
                    <div class='col-md-3 col-sm-3 div2'>Giá bán</div>                               
                </div>
                <div class='row'>  
                    <div class='col-md-3 col-sm-3'></div>             
                    <div class='col-md-6 col-sm-6 div3'>
                        <input class='form-control' style='background-color:white' readonly value='$giaban' type='text' id='suatensp' placeholder='Nhập tên sản phẩm'  />
                    </div>     
                </div>
                <div class='row div4'>
                    <div class='col-md-3 col-sm-3'></div>
                    <div class='col-md-3 col-sm-3 div2'>Giá khuyến mãi</div>                               
                </div>
                <div class='row'>  
                    <div class='col-md-3 col-sm-3'></div>             
                    <div class='col-md-6 col-sm-6 div3'>
                        <input class='form-control' style='background-color:white' readonly value='$giakm' type='text' id='suatensp' placeholder='Nhập tên sản phẩm'  />
                    </div>     
                </div>
                <div class='row div4'>
                    <div class='col-md-3 col-sm-3'></div>
                    <div class='col-md-3 col-sm-3 div2'>Giá gốc</div>                               
                </div>
                <div class='row'>  
                    <div class='col-md-3 col-sm-3'></div>             
                    <div class='col-md-6 col-sm-6 div3'>
                        <input class='form-control' style='background-color:white' readonly value='$giagoc' type='text' id='suatensp' placeholder='Nhập tên sản phẩm'  />
                    </div>     
                </div>
                <div class='row div4'>
                    <div class='col-md-3 col-sm-3'></div>
                    <div class='col-md-3 col-sm-3 div2'>Độ ưu tiên</div>                               
                </div>
                <div class='row' style='margin-bottom:50px'>  
                    <div class='col-md-3 col-sm-3'></div>             
                    <div class='col-md-6 col-sm-6 div3'>
                        <input class='form-control' style='background-color:white' value='$r[11]' type='number' id='suadutsp' placeholder='Nhập độ ưu tiên' readonly  />
                    </div>     
                </div>";   
                echo $s;        
        ?>
                   
    </div>
</div>