
<link rel="stylesheet" href="../css/nsx1.css">
<div class="container nsx">
    <div class="row tieudensx">
        <div class="col-md-12">Thông tin nhà sản xuất</div>
    </div>
    <div class="row themnsx">         
            <?php
                if(isset($_GET['id']))
                    $id=$_GET['id'];
                require_once("./KetnoiCSDL.php");
                $p=new CheckConnection();
                $sql1="SELECT * from nha_san_xuat WHERE MaNSX='$id'";
                $rs1=$p->ExcuteQuery($sql1);
                $r1=mysqli_fetch_row($rs1);                        
                $s="<div class='row'>
                        <div class='col-md-3 col-sm-3'></div>
                        <div class='col-md-3 col-sm-3 div2'>Mã nhà sản xuất</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-3 col-sm-3'></div>             
                        <div class='col-md-6 col-sm-6 div3'>
                            <input class='form-control' style='background-color:white' type='text' id='suamansx' value='$r1[0]' readonly  />
                        </div>     
                    </div>
                    <div class='row'>
                        <div class='col-md-3 col-sm-3'></div>
                        <div class='col-md-3 col-sm-3 div2'>Tên nhà sản xuất</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-3 col-sm-3'></div>             
                        <div class='col-md-6 col-sm-6 div3'>
                            <input class='form-control' style='background-color:white' value='$r1[1]' readonly type='text' id='suatennsx' placeholder='Nhập tên nhà sản xuất'  />
                        </div>     
                    </div>
                    <div class='row div4'>
                        <div class='col-md-3 col-sm-3'></div>
                        <div class='col-md-3 col-sm-3 div2'>Số điện thoại</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-3 col-sm-3'></div>             
                        <div class='col-md-6 col-sm-6 div3'>
                            <input class='form-control' style='background-color:white' value='$r1[2]' readonly type='text' id='suasdtnsx' placeholder='Nhập số điện thoại nhà sản xuất'  />
                        </div>     
                    </div>
                    <div class='row div4'>
                        <div class='col-md-3 col-sm-3'></div>
                        <div class='col-md-3 col-sm-3 div2'>Địa chỉ</div>                               
                    </div>
                    <div class='row'>  
                        <div class='col-md-3 col-sm-3'></div>             
                        <div class='col-md-6 col-sm-6 div3'>
                            <textarea rows='4' style='background-color:white' class='form-control' id='suadcnsx' readonly placeholder='Nhập địa chỉ nhà sản xuất'>$r1[3]</textarea>          
                        </div>     
                    </div>"; 
                echo $s;                   
            ?>                                               
        </div>   
    </div>
</div>