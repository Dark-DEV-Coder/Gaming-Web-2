
<link rel="stylesheet" href="../css/quyentk1.css">
<div class="container qtk">
    <div class="row tieudeqtk">
        <div class="col-md-12">Thêm quyền tài khoản</div>
    </div>
    <div class="row themqtk">
        <div class="col-md-6 col-sm-6">
            <div class="row">
                <div class="col-md-3 col-sm-3"></div>
                <div class="col-md-3 col-sm-3 div2">Mã quyền</div>                               
            </div>
            <div class="row">  
                <div class="col-md-3 col-sm-3"></div>             
                <div class="col-md-6 col-sm-6 div3">
                    <input class="form-control" type="text" id="themmaquyen" placeholder="Nhập mã quyền tài khoản"  />
                </div>     
            </div>
            <div class="row div4">
                <div class="col-md-3 col-sm-3"></div>
                <div class="col-md-3 col-sm-3 div2">Tên quyền</div>                               
            </div>
            <div class="row">  
                <div class="col-md-3 col-sm-3"></div>             
                <div class="col-md-6 col-sm-6 div3">
                    <input class="form-control" type="text" id="themtenquyen" placeholder="Nhập tên quyền tài khoản"  />
                </div>     
            </div>
            <div class="row div5">
                <div class="col-md-12 col-sm-12">
                    <input type="button" id="nutthemqtk" value="Hoàn thành" class="btn btn-info btn-lg" />
                </div>
            </div>
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
                    while($r=mysqli_fetch_array($rs)){
                        $s=$s."<div class='col-md-6 col-sm-6 chucnang1'>
                                    <input type='checkbox' class='checkchucnang' value='$r[0]' /> $r[1]
                                </div> ";
                    }
                    echo $s;
                ?>               
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#nutthemqtk").click(function(){
            var maq=$("#themmaquyen").val();
            var tenq=$("#themtenquyen").val();
            var x=document.getElementsByClassName('checkchucnang');
            var arr=[];
            var sl=0,d=0;
            for (i=0;i<x.length;i++){
                if (x[i].checked==true){
                    arr.push(x[i].value);
                    sl++;
                }
                else
                    d++;
            }
            if (maq==""){
                alert("Chưa nhập mã quyền");
                $("#themmaquyen").focus();
                return false;
            }
            if (tenq==""){
                alert("Chưa nhập tên quyền");
                $("#themtenquyen").focus();
                return false;
            }
            if (d==x.length){
                alert("Chưa chọn chức năng");
                return false;
            }
            $.post("./xulyquyentk.php",{kieu:'themqtk',maq:maq,tenq:tenq,sl:sl,arr:arr},function(data){
                if (data==0){
                    alert("Mã quyền đã tồn tại");
                }
                else{
                    alert("Thêm thành công");
                    location.replace("./quanly.php?idchucnang=QTK");
                }
            });
        });
    });
</script>