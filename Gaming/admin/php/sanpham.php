<link rel="stylesheet" href="../css/sanpham4.css">
<div class="container sp">
    <div class="row tieudesp">
        <div class="col-md-12">Sản phẩm</div>
    </div>
    <div class="row timkiemsp">
        <div class="col-md-4 col-sm-4">
            <select class="form-select form-select-lg mb-3" id="chonkieutimkiemsp">
                <option value="0" selected>Chọn kiểu tìm kiếm</option>
                <option value="1">Tìm kiếm theo mã</option>
                <option value="2">Tìm kiếm theo tên</option>
                <option value="3">Tìm kiếm theo loại</option>
                <option value="4">Tìm kiếm theo nhà sản xuất</option>
                <option value="5">Tìm kiếm theo loại và nhà sản xuất</option>
            </select>
        </div>
        <div class="col-md-2 col-sm-2">
            <input class="btn btn-info btn-lg" type="button" value="Tìm kiếm" id="nuttimkiemsp" />
        </div>
        <div class="col-md-3 col-sm-3"></div>
        <div class="col-md-3 col-sm-3">
            <button type="button" class="btn btn-info" id="themsp">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
                <a href="./quanly.php?xuly=themsp">Thêm sản phẩm</a>
            </button>
        </div>
    </div>
    <div id="kieutimkiemsp">                  
                                                            
    </div>    
    <div id="hiensp">   
        <div class="row">
            <table class="table table-bordered bangsp">
                <thead>
                    <tr>
                        <th class="tbsp1">Mã sản phẩm</th>
                        <th class="tbsp2">Hình ảnh</th>
                        <th class="tbsp3">Tên sản phẩm</th>
                        <th class="tbsp4">Nhà sản xuất</th>
                        <th class="tbsp5">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once("./KetnoiCSDL.php");
                        $p=new CheckConnection();
                        $sql="SELECT sp.MaNhomSP,sp.HinhAnh,sp.Ten,nsx.TenNSX 
                        FROM san_pham as sp, nha_san_xuat as nsx 
                        WHERE nsx.MaNSX=sp.MaNSX AND sp.TinhTrang!=0 ORDER BY sp.Ten LIMIT 0,5";
                        $rs=$p->ExcuteQuery($sql);
                        $s="";
                        while($r=mysqli_fetch_array($rs)){
                            $s=$s."<tr>
                                        <td>$r[0]</td>
                                        <td class='imgsp'><img src='../img/$r[1]' /></td>
                                        <td>$r[2]</td>
                                        <td>$r[3]</td>
                                        <td class='suaxoasp'>
                                            <a href='./quanly.php?xuly=xemsp&id=$r[0]' class='xemsp'><i class='bx bx-detail'></i></i></a>
                                            <a href='./quanly.php?xuly=suasp&id=$r[0]' p='$r[0]' class='suasp'><i class='bx bx-edit'></i></a>
                                            <span p='$r[0]'><a href='#' class='xoasp'><i class='bx bx-trash' ></i></a></span>
                                        </td>  
                                    </tr>";
                        }
                        echo $s;
                    ?>                    
                </tbody>
            </table>            
        </div> 
        <div class="row phantrangsp">
            <div class="col-md-12 col-sm-12 phantrangsp1">  
                <?php
                    $p=new CheckConnection();
                    $sql="SELECT sp.MaNhomSP,sp.HinhAnh,sp.Ten,nsx.TenNSX 
                    FROM san_pham as sp, nha_san_xuat as nsx 
                    WHERE nsx.MaNSX=sp.MaNSX AND sp.TinhTrang!=0 ORDER BY sp.Ten";
                    $rs=$p->ExcuteQuery($sql);
                    $page=0;
                    $s="";
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
                    echo $s;
                ?>              
                
            </div>
        </div>                             
    </div>
</div>
<script>
    $(document).ready(function(){
        $(".suaxoasp span").click(function(){
            var masp=$(this).attr('p');
            if (confirm("Bạn có chắc muốn xóa")){
                $.post("./xulysanpham.php",{kieu:'xoasp',masp:masp},function(data){
                    if (data==1){
                        alert("Xóa thành công");
                        location.reload();
                    }
                });
            }
        });
        $("#chonkieutimkiemsp").change(function(){
            var kieutk=$(this).val();
            $.post("./xulysanpham.php",{kieu:'timkiemsp',kieutk:kieutk},function(data){
                $("#kieutimkiemsp").html(data);
            });
        });
        $(".phantrangsp1 div").click(function(){
            var page=$(this).attr('page');            
            $.post("./phantrangsanpham.php",{kieu:'phantrangsp',page:page},function(data){
                $("#hiensp").html(data);
            });
        });
        $("#nuttimkiemsp").click(function(){
            var kieutk=$("#chonkieutimkiemsp").val();
            if (kieutk==0){
                alert("Chưa chọn kiểu tìm kiếm");
                return false;
            }
            if (kieutk==1){
                var masp=$("#masptimkiem").val();
                if (masp==""){
                    alert("Chưa nhập mã sản phẩm cần tìm");
                    $("#masptimkiem").focus();
                    return false;
                }
                $.post("./timkiemsanpham.php",{kieu:'kieu1',masp:masp},function(data){
                    $("#hiensp").html(data);
                })
            }
            if (kieutk==2){
                var tensp=$("#tensptimkiem").val();
                if (tensp==""){
                    alert("Chưa nhập tên sản phẩm cần tìm");
                    $("#tensptimkiem").focus();
                    return false;
                }
                $.post("./timkiemsanpham.php",{kieu:'kieu2',tensp:tensp},function(data){
                    $("#hiensp").html(data);
                })
            }
            if (kieutk==3){
                var loaisp=$("#loaisptimkiem").val();
                if (loaisp==0){
                    alert("Chưa chọn loại sản phẩm cần tìm");
                    $("#loaisptimkiem").focus();
                    return false;
                }              
                $.post("./timkiemsanpham.php",{kieu:'kieu3',loaisp:loaisp},function(data){                  
                    $("#hiensp").html(data);
                })
            }  
            if (kieutk==4){
                var nsxsp=$("#nsxsptimkiem").val();
                if (nsxsp==0){
                    alert("Chưa chọn loại sản phẩm cần tìm");
                    $("#nsxsptimkiem").focus();
                    return false;
                }              
                $.post("./timkiemsanpham.php",{kieu:'kieu4',nsxsp:nsxsp},function(data){                  
                    $("#hiensp").html(data);
                })
            }     
            if (kieutk==5){
                var loaisp=$("#loainsxsptimkiem1").val();
                var nsxsp=$("#loainsxsptimkiem2").val();
                if (loaisp==0){
                    alert("Chưa chọn loại sản phẩm cần tìm");
                    $("#loainsxsptimkiem1").focus();
                    return false;
                }   
                if (nsxsp==0){
                    alert("Chưa chọn nhà sản xuất cần tìm");
                    $("#loainsxsptimkiem2").focus();
                    return false;
                }            
                $.post("./timkiemsanpham.php",{kieu:'kieu5',loaisp:loaisp,nsxsp:nsxsp},function(data){                  
                    $("#hiensp").html(data);
                })
            } 
        });
    });
</script>