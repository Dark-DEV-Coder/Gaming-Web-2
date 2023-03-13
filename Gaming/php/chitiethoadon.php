<?php 
    if(isset($_POST['detail']))
    {
        require_once './KetnoiCSDL.php';
        session_start();
        $p=new CheckConnection();
        $sql="SELECT ctkm.*,sp.Ten,sp.HinhAnh,sp.MaNhomSP FROM chi_tiet_hoa_don ctkm,`san_pham` sp, `hoa_don` hd WHERE ctkm.MaHD='".$_POST['detail']."' and  ctkm.MaNhomSP=sp.MaNhomSP and ctkm.MaHD = hd.MaHD";
        $result=$p->ExcuteQuery($sql);
        $sql1="SELECT hd.TinhTrang FROM chi_tiet_hoa_don ctkm, `hoa_don` hd WHERE ctkm.MaHD='".$_POST['detail']."' and ctkm.MaHD = hd.MaHD";
        $result1=$p->ExcuteQuery($sql1);
        $obj1 = $result1->fetch_object();
        
        $i=1;
        $sl=0;
        $sum=0;
    }
?>
<div id="detailorder" class="card border-primary mb-3">
    <div class="card-header" onclick="block()">
        <i class="fas fa-minus" style="float:right"></i>
    </div>
    <div class="card-body text-primary"style="overflow-y:scroll;overflow-x:hidden;height:550px;width:800px">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col">Hỉnh ảnh</th>
                <th scope="col">SL</th>
                <th scope="col">Thành tiền</th>
                <th scope="col">Đánh giá</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row=mysqli_fetch_array($result)){
                    $sl+=$row['SoLuong'];
                    $sum+=$row['ThanhTien'];
                ?>
                <tr>
                <th scope="row"><?php echo $i; $i++ ?></th>
                <td style="width: 300px"><?php echo $row['Ten'] ?></td>
                <td><img style="max-height:100px;overflow:hidden" src="../img/<?php echo $row['HinhAnh'] ?>" alt=""></td>
                <td><?php echo $row['SoLuong'] ?></td>
                <td><?php echo number_format($row['ThanhTien']) ?> đ</td>
                <?php 
                $count=0;
                if(isset($_SESSION['taikhoan'])) {
                    $idtk = $_SESSION['taikhoan']['mataikhoan'];
                    $idsp =$row['MaNhomSP'];
                    $sql2="SELECT * FROM danh_gia_sp dg WHERE dg.MaTK = '$idtk' and dg.MaNhomSP='$idsp'";
                    $result2=$p->ExcuteQuery($sql2);
                    $count = mysqli_num_rows($result2);
                }
                if($obj1->TinhTrang==4 && $count < 1) { 
                            
                ?>
                    <td><a class="detailHD" name="<?php echo $row['MaNhomSP']; ?>" href="#" data-toggle="modal" data-target="#modalLRForm3">Đánh giá</a></td>
                <?php } ?>
                </tr>
                <?php } ?>
                <tr>
                <th scope="row"></th>
                <td></td>
                <td>Tổng cộng   :</td>
                <td><?php echo $sl ?></td>
                <td><?php echo number_format($sum) ?> đ</td>
                <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
