<?php
    session_start();
    date_default_timezone_set('Asia/Ho_Chi_Minh');
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset="UTF-8">
        <title>Đăng nhập trang quản trị</title>        
        <link href="./css/bootstrap.css" rel="stylesheet">   
        <link href="./css/dangnhap.css" rel="stylesheet" >   
        <script type="text/javascript" src="./js/jquery1.js"></script>
    </head>
    <body style="background-color: #17191B;">
        <?php
            if ( isset($_SESSION['matk']) && isset($_SESSION['maq']) ){
                unset($_SESSION['matk']);
                unset($_SESSION['maq']);
            }
        ?>
        <div class="form">
            <div class="container">
                <div class="row form-row">
                    <div class="col-md-6 col-sm-6 formimg">
                        <img src="./img/logo.png" />
                    </div>
                    <div class="col-md-6 col-sm-6 formlogin">
                        <div class="row form1">Tên đăng nhập</div>
                        <div class="row form2">                            
                            <input class="form-control" id="tendn" type="text" placeholder="Nhập tên đăng nhập" />
                        </div>
                        <div class="row form1">Mật khẩu</div>
                        <div class="row form2">
                            <input class="form-control" id="mkdn" type="password" placeholder="Nhập mật khẩu" />
                        </div>
                        <div class="row form3">
                            <input class="btn btn-success btn-sm btdn1" id="button-dn" type="button" value="Đăng nhập" />
                        </div>
                        <div class="row form4"><a href="../index.php">Quay lại trang chủ</a></div>
                    </div>                
            </div>
        </div>
    </body>
    <script>
        $(document).ready(function(){
            $("#button-dn").click(function(){
                var tendn=$("#tendn").val();
                var mkdn=$("#mkdn").val();
                if (tendn==""){
                    alert("Chưa nhập tên đăng nhập");
                    $("#tendn").focus();
                    return false;
                }
                if (mkdn==""){
                    alert("Chưa nhập mật khẩu");
                    $("#mkdn").focus();
                    return false;
                }
                $.post("./php/xulydangnhap.php",{tendn:tendn,mkdn:mkdn},function(data){
                    if (data==1){
                        alert("Đăng nhập thành công");
                        location.replace("./php/quanly.php");
                    }
                    else{
                        if (data==0)
                            alert("Sai tên đăng nhập hoặc mật khẩu");
                        else
                            alert("Bạn không được phép đăng nhập");
                    }                 
                });
            });
        });
    </script>
</html>
