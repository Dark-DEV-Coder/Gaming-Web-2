<link rel="stylesheet" href="../css/quyentk1.css">
<div class="container qtk">
    <div class="row tieudeqtk">
        <div class="col-md-12">Quyền tài khoản</div>
    </div>
    <div class="row timkiemqtk">                
        <div class="col-md-9 col-sm-9"></div>
        <div class="col-md-3 col-sm-3">
            <button type="button" class="btn btn-info" id="themqtk">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
                <a href="./quanly.php?xuly=themquyentk">Thêm quyền tài khoản</a>
            </button>
        </div>
    </div>
    <div id="kieutimkiemqtk">
        <div class="row timkiemtheotenqtk">
            <div class="col-md-2 col-sm-2 div1">Tên quyền:</div>
            <div class="col-md-4 col-sm-4">
                <input class="form-control" type="text" id="tenqtktimkiem" placeholder="Nhập tên quyền tài khoản cần tìm"  />
            </div>
            <div class="col-md-2 col-sm-2">
                <input class="btn btn-info" type="button" value="Tìm kiếm" id="nuttimkiemqtk" />
            </div>
        </div>             
    </div>    
    <div id="hienqtk">   
        <div class="row">
            <table class="table table-bordered bangqtk">
                <thead>
                    <tr>
                        <th class="tbqtk1">Mã quyền</th>
                        <th class="tbqtk2">Tên quyền tài khoản</th>                       
                        <th class="tbqtk3">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once("./KetnoiCSDL.php");
                        require_once("./xulydulieu.php");
                        $p=new CheckConnection();
                        $p1=new Xuly();
                        $sql="SELECT * FROM quyen_tk WHERE TinhTrang!=0 LIMIT 0,5";
                        $rs=$p->ExcuteQuery($sql);
                        $s="";
                        while($r=mysqli_fetch_array($rs)){                           
                            $s=$s."<tr>
                                        <td class='qtk1'>$r[0]</td>
                                        <td class='qtk1'>$r[1]</td>
                                        <td class='suaxoaqtk'>
                                            <a href='./quanly.php?xuly=xemquyentk&id=$r[0]' class='suaqtk'><i class='bx bx-detail'></i></i></a>
                                            <a href='./quanly.php?xuly=suaquyentk&id=$r[0]' class='suaqtk'><i class='bx bx-edit'></i></a>
                                            <span p='$r[0]'><a href='#' class='xoaqtk'><i class='bx bx-trash' ></i></a></span>
                                        </td>  
                                    </tr>";
                        }
                        echo $s;
                    ?>                    
                </tbody>
            </table>            
        </div> 
        <div class="row phantrangqtk">
            <div class="col-md-12 col-sm-12 phantrangqtk1">  
                <?php
                    $p=new CheckConnection();
                    $sql="SELECT * FROM quyen_tk WHERE TinhTrang!=0";
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
                                        $s=$s."<div style='background-color:#0d6efd' page='$i'>$i</div>";
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
        $(".suaxoaqtk span").click(function(){
            var maq=$(this).attr('p');
            if (confirm('Bạn có chắc muốn xóa')){
                $.post("./xulyquyentk.php",{kieu:'xoaqtk',maq:maq},function(data){
                    if (data==1){
                        alert("Xóa thành công");
                        location.reload(); 
                    }                   
                });
            }
        });
        $("#nuttimkiemqtk").click(function(){
            var tenqtktimkiem=$("#tenqtktimkiem").val();
            if (tenqtktimkiem==""){
                aler("Chưa nhập tên cần tìm");
                $("#tenqtktimkiem").focus();
                return false;
            }
            $.post("./phantrangqtk.php",{kieu:'timkiemqtk',tenqtktimkiem:tenqtktimkiem},function(data){
                $("#hienqtk").html(data);                  
            });
            
        });
        $(".phantrangqtk1 div").click(function(){
            var page=$(this).attr('page');
            var tenqtktimkiem=$("#tenqtktimkiem").val();
            $.post("./phantrangqtk.php",{kieu:'phantrangqtk',page:page,tenqtktimkiem:tenqtktimkiem},function(data){
                $("#hienqtk").html(data);                  
            });
            
        });
    });
</script>