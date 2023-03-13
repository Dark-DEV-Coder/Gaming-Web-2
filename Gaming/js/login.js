$(document).ready(function() {
    $('#btnLogin').click(function() {
        var user = $('#modalLRInput10').val();
        var pass = $('#modalLRInput11').val();
        if($.trim(user).length > 0 && $.trim(pass).length > 0) {
            $.post("http://localhost/Gaming/php/checktaikhoan.php", {un: user, pwd: pass}, function(data) {
                if(data == "1") {
                    document.getElementById("modalLRInput10").value = "";
                    document.getElementById("modalLRInput11").value = "";
                    alert("Đăng nhập thành công.");
                    var a = location.href;
                    location.href = a;
                } else if(data == "2") {
                    alert("Sai tài khoản hoặc mật khẩu!!!");
                }
            });
        } else {
            alert("Vui lòng nhập tài khoản và mật khẩu !!!");
        }
    });  
    
});