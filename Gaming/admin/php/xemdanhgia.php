
<link rel="stylesheet" href="../css/danhgia3.css">
<div class="container dg">
    <div class="row tieudedg">
        <div class="col-md-12">Thông tin bài đánh giá</div>
    </div>
    <div class="row themdg">         
            <?php
                if(isset($_GET['id']))
                    $id=$_GET['id'];
                require_once("./KetnoiCSDL.php");
                $p=new CheckConnection();
                $sql1="SELECT * from danh_gia_sp WHERE MaBinhLuan='$id'";
                $rs1=$p->ExcuteQuery($sql1);
                $r1=mysqli_fetch_row($rs1);                        
                $s="<div class='row'>
                        <div class='col-md-3 col-sm-3'></div>
                        <div class='col-md-3 col-sm-3 div2'>Mã bình luận</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-3 col-sm-3'></div>             
                        <div class='col-md-6 col-sm-6 div3'>
                            <input class='form-control' style='background-color:white' type='text' value='$r1[0]' readonly  />
                        </div>     
                    </div>
                    <div class='row'>
                        <div class='col-md-3 col-sm-3'></div>
                        <div class='col-md-3 col-sm-3 div2'>Mã tài khoản</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-3 col-sm-3'></div>             
                        <div class='col-md-6 col-sm-6 div3'>
                            <input class='form-control' style='background-color:white' value='$r1[1]' readonly type='text' id='suatendg' placeholder='Nhập tên nhà sản xuất'  />
                        </div>     
                    </div>
                    <div class='row div4'>
                        <div class='col-md-3 col-sm-3'></div>
                        <div class='col-md-3 col-sm-3 div2'>Mã nhóm sản phẩm</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-3 col-sm-3'></div>             
                        <div class='col-md-6 col-sm-6 div3'>
                            <input class='form-control' style='background-color:white' value='$r1[2]' readonly type='text' id='suasdtdg' placeholder='Nhập số điện thoại nhà sản xuất'  />
                        </div>     
                    </div>
                    <div class='row div4'>
                        <div class='col-md-3 col-sm-3'></div>
                        <div class='col-md-3 col-sm-3 div2'>Số sao đánh giá</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-3 col-sm-3'></div>             
                        <div class='col-md-6 col-sm-6 div3'>
                            <input class='form-control' style='background-color:white' value='$r1[3]' readonly type='text' id='suasdtdg' placeholder='Nhập số điện thoại nhà sản xuất'  />
                        </div>     
                    </div>
                    <div class='row div4'>
                        <div class='col-md-3 col-sm-3'></div>
                        <div class='col-md-3 col-sm-3 div2'>Bình luận</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-3 col-sm-3'></div>             
                        <div class='col-md-6 col-sm-6 div3'>
                            <textarea rows='4' style='background-color:white' class='form-control' readonly >$r1[4]</textarea>          
                        </div>     
                    </div>"; 
                echo $s;                   
            ?>                                               
        </div>   
    </div>
</div>