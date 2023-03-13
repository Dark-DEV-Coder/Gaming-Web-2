
<link rel="stylesheet" href="../css/phieunhaphang1.css">
<div class="container pnh">
    <div class="row tieudepnh">
        <div class="col-md-12">Cập nhật phiếu nhập hàng</div>
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
            $s="<div class='col-md-6 col-sm-6'>  
                    <div class='row div4'>
                        <div class='col-md-1 col-sm-1'></div>
                        <div class='col-md-6 col-sm-6 div2'>Mã phiếu nhập hàng</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-1 col-sm-1'></div>             
                        <div class='col-md-6 col-sm-6 div3'>
                            <input class='form-control' type='text' id='suamapnh' value='$r1[0]' readonly  />             
                        </div>     
                    </div>     
                    <div class='row'>
                        <div class='col-md-1 col-sm-1'></div>
                        <div class='col-md-6 col-sm-6 div2'>Nhà sản xuất</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-1 col-sm-1'></div>             
                        <div class='col-md-6 col-sm-6 div3'>
                            <select class='form-select' id='suamansxpnh'>
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
                    <div class='col-md-1 col-sm-1'></div>
                    <div class='col-md-6 col-sm-6 div2'>Ngày nhập hàng</div>                               
                </div>
                <div class='row'>  
                    <div class='col-md-1 col-sm-1'></div>             
                    <div class='col-md-6 col-sm-6 div3'>
                        <input class='form-control' type='date' id='suangaynhappnh' value='$r1[4]'  />
                    </div>     
                </div> 
                <div class='row div4'>
                        <div class='col-md-1 col-sm-1'></div>
                        <div class='col-md-6 col-sm-6 div2'>Tổng tiền</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-1 col-sm-1'></div>             
                        <div class='col-md-6 col-sm-6 div3'>
                            <input class='form-control' type='text' id='suatienpnh' value='$tongtien' readonly  />             
                        </div>     
                    </div>  
            </div>
                <div class='col-md-6 col-sm-6'>
                    <div class='row div4'>
                        <div class='col-md-1 col-sm-1'></div>
                        <div class='col-md-6 col-sm-6 div2'>Mã nhóm sản phẩm</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-1 col-sm-1'></div>             
                        <div class='col-md-6 col-sm-6 div3'>
                            <input class='form-control' type='text' id='themctmasppnh' value=''  />             
                        </div>     
                    </div> 
                    <div class='row div4'>
                        <div class='col-md-1 col-sm-1'></div>
                        <div class='col-md-6 col-sm-6 div2'>Số lượng</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-1 col-sm-1'></div>             
                        <div class='col-md-6 col-sm-6 div3'>
                            <input class='form-control' type='number' id='themctslsppnh' />             
                        </div>     
                    </div> 
                    <div class='row div4'>
                        <div class='col-md-1 col-sm-1'></div>
                        <div class='col-md-6 col-sm-6 div2'>Giá nhập hàng</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-1 col-sm-1'></div>             
                        <div class='col-md-6 col-sm-6 div3'>
                            <input class='form-control' type='number' id='themctdgsppnh' />             
                        </div>    
                        <div class='col-md-3 col-sm-3'>
                            <input class='btn btn-info' type='button' id='nutthemctpnh' value='Thêm chi tiết'  />  
                        </div> 
                    </div> 
                </div>  
                <div class='row' style='margin-top:30px'>";
            $s=$s."<table class='table table-bordered bangpnh'>
                        <thead>
                            <tr>
                                <th class='tbpnh1'>Mã sản phẩm</th>
                                <th class='tbpnh2'>Số lượng</th>
                                <th class='tbpnh3'>Giá gốc</th>
                                <th class='tbpnh4'>Thành tiền</th>
                                <th class='tbpnh5'>Chức năng</th>
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
                            <td class='suaxoapnh' id='xoachitietpnh'>
                                <span p='$r[0]' p1='$r[1]' p2='$r[2]'><a href='#' class='xoapnh'><i class='bx bx-trash' ></i></a></span>
                            </td>  
                        </tr>";
            }
            $s=$s."</tbody>
            </table>            
        </div> ";
            echo $s;
        ?>                                            
        </div> 
        <div class="row div5" style="height: 15%;">
            <div class="col-md-12 col-sm-12">
                <input type="button" id="nutsuapnh" value="Hoàn thành" class="btn btn-info btn-lg" />
            </div>
        </div>  
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#nutsuapnh").click(function(){
            var id=$("#suamapnh").val();
            var mansx=$("#suamansxpnh").val();
            var ngay=$("#suangaynhappnh").val();
            if (mansx==0){
                alert("Chưa chọn nhà sản xuất");
                $("#suamansxpnh").focus();
                return false;
            }
            if (ngay==""){
                alert("Chưa chọn ngày nhập hàng");
                $("#suangaynhappnh").focus();
                return false;
            }
            $.post("./xulypnh.php",{kieu:'suapnh',mansx:mansx,ngay:ngay,id:id},function(data){
                if (data==1){
                    alert("Cập nhật thành công");
                    location.replace("./quanly.php?idchucnang=PNH");
                }
            });
        });
        $("#nutthemctpnh").click(function(){
            var mapnh=$("#suamapnh").val();
            var masp=$("#themctmasppnh").val();
            var slsp=$("#themctslsppnh").val();
            var dgsp=$("#themctdgsppnh").val();
            var mansx=$("#suamansxpnh").val();
            if (masp==""){
                alert("Chưa nhập mã sản phẩm");
                $("#themctmasppnh").focus();
                return false;
            }
            if (slsp=="" || slsp<=0){
                alert("Chưa nhập số lượng sản phẩm");
                $("#themctslsppnh").focus();
                return false;
            }
            if (dgsp=="" || dgsp<=0){
                alert("Chưa nhập đơn giá sản phẩm");
                $("#themctdgsppnh").focus();
                return false;
            }
            $.post("./xulypnh.php",{kieu:'themctpnh',mapnh:mapnh,masp:masp,slsp:slsp,dgsp:dgsp,mansx:mansx},function(data){
                if (data==0)
                    alert("Mã sản phẩm không tồn tại hoặc không thuộc nhà sản xuất");
                else{
                    alert("Thêm chi tiết thành công");
                    location.reload();
                }
            });
        });
        $("#xoachitietpnh span").click(function(){
            var mapnh=$(this).attr('p');
            var masp=$(this).attr('p1');
            var slsp=$(this).attr('p2');
            if (confirm("Bạn có chắc muốn xóa")){
                $.post("./xulypnh.php",{kieu:'xoactpnh',mapnh:mapnh,masp:masp,slsp:slsp},function(data){
                    if (data==1){
                        alert("Xóa chi tiết thành công");
                        location.reload();
                    }
                });
            }
        });
    });
</script>