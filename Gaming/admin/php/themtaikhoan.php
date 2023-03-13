
<link rel="stylesheet" href="../css/taikhoan2.css">
<div class="container tk">
    <div class="row tieudetk">
        <div class="col-md-12">Thêm tài khoản</div>
    </div>
    <div class="row themtk">        
        <div class="row">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Quyền tài khoản</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <select class="form-select" id="themqtaikhoan">
                    <option value="0" selected>Chọn quyền tài khoản</option>
                    <?php
                        require_once("./KetnoiCSDL.php");
                        $sql="SELECT * FROM quyen_tk WHERE TinhTrang!=0";
                        $s="";
                        $p=new CheckConnection();
                        $rs=$p->ExcuteQuery($sql);
                        while($r=mysqli_fetch_array($rs)){
                            $s=$s."<option value='$r[0]'>$r[1]</option>";
                        }
                        echo $s;                    
                    ?>
                </select>
            </div>     
        </div>
        <div class="row div4">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Tên tài khoản</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <input class="form-control" type="text" id="themtentaikhoan" placeholder="Nhập tên tài khoản"  />
            </div>     
        </div>
        <div class="row div4">
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-3 col-sm-3 div2">Mật khẩu (mặc định)</div>                               
        </div>
        <div class="row">  
            <div class="col-md-3 col-sm-3"></div>             
            <div class="col-md-6 col-sm-6 div3">
                <?php
                    $s="khachsan4D";
                    $pass=password_hash($s,PASSWORD_DEFAULT);
                    $s1="<input class='form-control' type='password' style='background-color:white' id='themmktaikhoan' readonly value='$pass' />";
                    echo $s1;
                ?>                
            </div>     
        </div>
        <div class="row div5">
            <div class="col-md-12 col-sm-12">
                <input type="button" id="nutthemtk" value="Hoàn thành" class="btn btn-info btn-lg" />
            </div>
        </div>     
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#nutthemtk").click(function(){
            var qtk=$("#themqtaikhoan").val();
            var tentk=$("#themtentaikhoan").val();
            if (qtk==0){
                alert("Chưa chọn quyền tài khoản");
                $("#themqtaikhoan").focus();
                return false;
            }
            if (tentk==""){
                alert("Chưa nhập tên tài khoản");
                $("#themtentaikhoan").focus();
                return false;
            }
            $.post("./xulytaikhoan.php",{kieu:'themtk',qtk:qtk,tentk:tentk},function(data){
                if (data==0){
                    alert("Tên tài khoản đã tồn tại");
                    $("#themtentaikhoan").focus();
                }
                else{
                    alert("Thêm thành công");
                    location.replace("./quanly.php?idchucnang=TK");                    
                }
            });
        });
    });
</script>