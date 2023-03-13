
<link rel="stylesheet" href="../css/taikhoan2.css">
<div class="container tk">
    <div class="row tieudetk">
        <div class="col-md-12">Thông tin tài khoản</div>
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
                                    <input class='form-control' style='background-color:white' value='$r1[0]' type='text' id='mataikhoan' readonly  />
                                </div>     
                            </div>       
                            <div class='row'>
                                <div class='col-md-3 col-sm-3'></div>
                                <div class='col-md-3 col-sm-3 div2'>Quyền tài khoản</div>                               
                            </div>
                            <div class='row'>  
                                <div class='col-md-3 col-sm-3'></div>             
                                <div class='col-md-6 col-sm-6 div3'>";                                                                       ;    
                        $sql="SELECT * FROM quyen_tk WHERE TinhTrang!=0";                                    
                        $rs=$p->ExcuteQuery($sql);
                        while($r=mysqli_fetch_array($rs)){
                            if ($r1[1]==$r[0])
                                $s=$s."<input class='form-control' style='background-color:white' value='$r[1]' type='text' id='mataikhoan' readonly  />";
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
                            <input class='form-control' style='background-color:white' value='$r1[2]' readonly type='text' id='suatentaikhoan' placeholder='Nhập tên tài khoản'  />
                        </div>     
                    </div>
                    <div class='row div4'>
                        <div class='col-md-3 col-sm-3'></div>
                        <div class='col-md-3 col-sm-3 div2'>Mật khẩu</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-3 col-sm-3'></div>             
                        <div class='col-md-6 col-sm-6 div3' id='khoiphuc'>
                            <input class='form-control' style='background-color:white' type='password' id='suamktaikhoan' readonly value='$r1[3]' />                                               
                        </div>"; 
                        echo $s;                   
                    ?>                                               
        </div>    
    </div>
</div>