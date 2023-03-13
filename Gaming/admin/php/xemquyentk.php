
<link rel="stylesheet" href="../css/quyentk1.css">
<div class="container qtk">
    <div class="row tieudeqtk">
        <div class="col-md-12">Thông tin quyền tài khoản</div>
    </div>
    <div class="row themqtk">
        <div class="col-md-6 col-sm-6">
            <?php
                if (isset($_GET['id'])){
                    $id=$_GET['id'];
                    require_once("./KetnoiCSDL.php");
                    $p=new CheckConnection();
                    $sql="SELECT * FROM quyen_tk WHERE MaQuyen='$id'";
                    $rs=$p->ExcuteQuery($sql);
                    $r=mysqli_fetch_row($rs);
                    $s="<div class='row'>
                            <div class='col-md-3 col-sm-3'></div>
                            <div class='col-md-3 col-sm-3 div2'>Mã quyền</div>                               
                        </div>
                        <div class='row'>  
                            <div class='col-md-3 col-sm-3'></div>             
                            <div class='col-md-6 col-sm-6 div3'>
                                <input class='form-control' style='background-color:white' type='text' readonly id='suamaquyen' placeholder='Nhập mã quyền tài khoản' value='$r[0]'  />
                            </div>     
                        </div>
                        <div class='row div4'>
                            <div class='col-md-3 col-sm-3'></div>
                            <div class='col-md-3 col-sm-3 div2'>Tên quyền</div>                               
                        </div>
                        <div class='row'>  
                            <div class='col-md-3 col-sm-3'></div>             
                            <div class='col-md-6 col-sm-6 div3'>
                                <input class='form-control' style='background-color:white' type='text' id='suatenquyen' placeholder='Nhập tên quyền tài khoản' value='$r[1]' readonly  />
                            </div>     
                        </div>";
                    echo $s;
                }
            ?>            
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="row tieudechucnang">
                <div class="col-md-1 col-sm-1"></div>
                <div class="col-md-6 col-sm-6">Các chức năng</div>
            </div>
            <div class="row chucnang">
                <?php
                    require_once("./KetnoiCSDL.php");
                    $p=new CheckConnection();
                    $sql="SELECT * FROM chuc_nang";
                    $rs=$p->ExcuteQuery($sql);
                    $s="";
                    if (isset($_GET['id']))
                        $id=$_GET['id'];
                    $sql1="SELECT * FROM chi_tiet_quyen WHERE MaQuyen='$id'";
                    $rs1=$p->ExcuteQuery($sql1);
                    $arr=[];
                    $i=0;
                    while($r1=mysqli_fetch_array($rs1)){
                        array_push($arr,$r1[1]);
                    }
                    while($r=mysqli_fetch_array($rs)){
                        if ($i<count($arr)){
                            if ($r[0]==$arr[$i]){
                                $s=$s."<div class='col-md-6 col-sm-6 chucnang1'>
                                            <input type='checkbox' class='checkchucnang' value='$r[0]' checked onclick='return false;' /> $r[1]
                                        </div> ";
                                $i++;
                            }
                            else
                                $s=$s."<div class='col-md-6 col-sm-6 chucnang1'>
                                            <input type='checkbox' class='checkchucnang' value='$r[0]' onclick='return false;' /> $r[1]
                                        </div> ";
                        }
                        else
                            $s=$s."<div class='col-md-6 col-sm-6 chucnang1'>
                                        <input type='checkbox' class='checkchucnang' value='$r[0]' onclick='return false;' /> $r[1]
                                    </div> ";                        
                    }
                    echo $s;
                ?>               
            </div>
        </div>
    </div>
</div>