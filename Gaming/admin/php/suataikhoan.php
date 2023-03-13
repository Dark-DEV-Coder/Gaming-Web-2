
<link rel="stylesheet" href="../css/taikhoan2.css">
<div class="container tk">
    <div class="row tieudetk">
        <div class="col-md-12">Cập nhật tài khoản</div>
    </div>
    <div class="row themtk"> 
        
                    <?php
                        if(isset($_GET['id']))
                            $id=$_GET['id'];
                        require_once("./KetnoiCSDL.php");
                        $p=new CheckConnection();
                        $sql1="SELECT * from tai_khoan WHERE MaTK='$id'";
                        $rs1=$p->ExcuteQuery($sql1);
                        $r1=mysqli_fetch_row($rs1);                        
                        $s="<div class='row div4'>
                                <div class='col-md-3 col-sm-3'></div>
                                <div class='col-md-3 col-sm-3 div2'>Mã tài khoản</div>                               
                            </div>
                            <div class='row'>  
                                <div class='col-md-3 col-sm-3'></div>             
                                <div class='col-md-6 col-sm-6 div3'>
                                    <input class='form-control' value='$r1[0]' type='text' id='mataikhoan' readonly  />
                                </div>     
                            </div>       
                            <div class='row'>
                                <div class='col-md-3 col-sm-3'></div>
                                <div class='col-md-3 col-sm-3 div2'>Quyền tài khoản</div>                               
                            </div>
                            <div class='row'>  
                                <div class='col-md-3 col-sm-3'></div>             
                                <div class='col-md-6 col-sm-6 div3'>
                                    <select class='form-select' id='suaqtaikhoan'>
                                        <option value='0'>Chọn quyền tài khoản</option>";    
                        $sql="SELECT * FROM quyen_tk WHERE TinhTrang!=0";                                    
                        $rs=$p->ExcuteQuery($sql);
                        while($r=mysqli_fetch_array($rs)){
                            if ($r1[1]==$r[0])
                                $s=$s."<option value='$r[0]' selected>$r[1]</option>";
                            else
                                $s=$s."<option value='$r[0]'>$r[1]</option>";
                        }
                        $s=$s."</select>
                        </div>     
                    </div>
                    <div class='row div4'>
                        <div class='col-md-3 col-sm-3'></div>
                        <div class='col-md-3 col-sm-3 div2'>Tên tài khoản</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-3 col-sm-3'></div>             
                        <div class='col-md-6 col-sm-6 div3'>
                            <input class='form-control' value='$r1[2]' type='text' id='suatentaikhoan' placeholder='Nhập tên tài khoản'  />
                        </div>     
                    </div>
                    <div class='row div4'>
                        <div class='col-md-3 col-sm-3'></div>
                        <div class='col-md-3 col-sm-3 div2'>Mật khẩu (mặc định)</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-3 col-sm-3'></div>             
                        <div class='col-md-6 col-sm-6 div3' id='khoiphuc'>
                            <input class='form-control' style='background-color:white' type='password' id='suamktaikhoan' readonly value='$r1[3]' />                                               
                        </div>
                        <div class='col-md-1 col-sm-1 divicon'>
                            <a href='#' id='phuchoimatkhau'><i class='bx bx-loader-circle' ></i></a>
                        </div>"; 
                        echo $s;                   
                    ?>                                               
        </div>
        <div class="row div5">
            <div class="col-md-12 col-sm-12">
                <input type="button" id="nutsuatk" value="Hoàn thành" class="btn btn-info btn-lg" />
            </div>
        </div>     
    </div>
</div>
<script>
    var tentkcu=document.getElementById('suatentaikhoan').value;
    $(document).ready(function(){
        $("#nutsuatk").click(function(){
            var id=$("#mataikhoan").val();
            var qtk=$("#suaqtaikhoan").val();
            var tentk=$("#suatentaikhoan").val();
            var mk=$("#suamktaikhoan").val();
            if (qtk==0){
                alert("Chưa chọn quyền tài khoản");
                $("#suaqtaikhoan").focus();
                return false;
            }
            if (tentk==""){
                alert("Chưa nhập tên tài khoản");
                $("#suatentaikhoan").focus();
                return false;
            }
            $.post("./xulytaikhoan.php",{kieu:'suatk',id:id,qtk:qtk,tentk:tentk,pass:mk,tentkcu:tentkcu},function(data){
                if (data==0){
                    alert("Tên tài khoản đã tồn tại");
                    $("#themtentaikhoan").focus();
                }
                else{
                    alert("Cập nhật thành công");
                    location.replace("./quanly.php?idchucnang=TK");                    
                }
            });
        });
        $("#phuchoimatkhau").click(function(){
            $.post("./xulytaikhoan.php",{kieu:'khoiphucmk'},function(data){
                $("#khoiphuc").html(data);
            });
        });
    });
</script>