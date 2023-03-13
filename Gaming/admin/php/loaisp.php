<link rel="stylesheet" href="../css/loaisp1.css"> 
<div class="container lsp">
    <div class="row tieudelsp">
        <div class="col-md-12">Loại sản phẩm</div>
    </div>
    <div class="row timkiemlsp">                
        <div class="col-md-9 col-sm-9"></div>
        <div class="col-md-3 col-sm-3">
            <button type="button" class="btn btn-info" id="themlsp">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
                <a href="./quanly.php?xuly=themlsp">Thêm loại sản phẩm</a>
            </button>
        </div>
    </div>
    <div id="kieutimkiemlsp">
        <div class="row timkiemtheotenloaisp">
            <div class="col-md-2 col-sm-2 div1">Tên loại:</div>
            <div class="col-md-4 col-sm-4">
                <input class="form-control" type="text" id="tenloaisptimkiem" placeholder="Nhập tên loại sản phẩm cần tìm"  />
            </div>
            <div class="col-md-2 col-sm-2">
                <input class="btn btn-info" type="button" value="Tìm kiếm" id="nuttimkiemlsp" />
            </div>
        </div>             
    </div>    
    <div id="hienlsp">   
        <div class="row">
            <table class="table table-bordered banglsp">
                <thead>
                    <tr>
                        <th class="tblsp1">Mã loại</th>
                        <th class="tblsp2">Tên loại</th>                       
                        <th class="tblsp3">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once("./KetnoiCSDL.php");
                        require_once("./xulydulieu.php");
                        $p=new CheckConnection();
                        $p1=new Xuly();
                        $sql="SELECT * FROM loai_sp WHERE TinhTrang!=0 LIMIT 0,5";
                        $rs=$p->ExcuteQuery($sql);
                        $s="";
                        while($r=mysqli_fetch_array($rs)){                           
                            $s=$s."<tr>
                                        <td class='lsp1'>$r[0]</td>
                                        <td class='lsp1'>$r[1]</td>
                                        <td class='suaxoalsp'>
                                            <a href='./quanly.php?xuly=sualsp&id=$r[0]' p='$r[0]' class='sualsp'><i class='bx bx-edit'></i></a>
                                            <span p='$r[0]'><a href='#' class='xoalsp'><i class='bx bx-trash' ></i></a></span>
                                        </td>  
                                    </tr>";
                        }
                        echo $s;
                    ?>                    
                </tbody>
            </table>            
        </div> 
        <div class="row phantranglsp">
            <div class="col-md-12 col-sm-12 phantranglsp1">  
                <?php
                    $p=new CheckConnection();
                    $sql="SELECT * FROM loai_sp WHERE TinhTrang!=0";
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
        $(".suaxoalsp span").click(function(){
            var malsp=$(this).attr('p');
            if (confirm('Bạn có chắc muốn xóa')){
                $.post("./xulyloaisp.php",{kieu:'xoalsp',malsp:malsp},function(data){
                    if (data==1){
                        alert("Xóa thành công");
                        location.reload(); 
                    }                   
                });
            }
        });
        $(".phantranglsp1 div").click(function(){
            var page=$(this).attr('page');
            $.post("./phantranglsp.php",{kieu:'phantranglsp',page:page},function(data){
                $("#hienlsp").html(data);                  
            });            
        });
        $("#nuttimkiemlsp").click(function(){
            var tenlsp=$("#tenloaisptimkiem").val();
            if (tenlsp==""){
                alert("Chưa nhập tên loại sản phẩm cần tìm");
                $("#tenloaisptimkiem").focus();
                return false;
            }
            $.post("./timkiemlsp.php",{kieu:'timkiemlsp',tenlsp:tenlsp},function(data){
                $("#hienlsp").html(data);                  
            });            
        });
    });
</script>