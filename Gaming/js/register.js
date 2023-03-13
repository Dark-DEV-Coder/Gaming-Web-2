$(document).ready(function() {
    $('#btnRegister').click(function() {
        var ho = $('#modalLRInput12').val();
        var ten = $('#modalLRInput13').val();
        var taikhoan = $('#modalLRInput14').val();
        var matkhau = $('#modalLRInput15').val();
        var nhaplaimatkhau = $('#modalLRInput16').val();
        var email = $('#modalLRInput17').val();
        var sodienthoai = $('#modalLRInput18').val();
        var ngaysinh = $('#modalLRInput19').val();
        var diachi = $('#modalLRInput22').val();
        var gioitinh = document.getElementsByName("gioitinh");
        var gt = 0;
        for (var i = 0; i < gioitinh.length; i++){
            if (gioitinh[i].checked === true){
                gt = gioitinh[i].value;
            }
        }
        if(ktra(ho, ten, taikhoan, matkhau, nhaplaimatkhau, email, sodienthoai, ngaysinh, diachi)===1) {
            $.post("http://localhost/Gaming/php/addtaikhoan.php", {ho:ho, ten:ten, taikhoan:taikhoan, matkhau:matkhau, nhaplaimatkhau:nhaplaimatkhau, email:email, sodienthoai:sodienthoai, ngaysinh:ngaysinh, diachi:diachi, gt:gt}, function(data) {
                if(data == "1") {
                    alert("Đăng ký thành công.");
                    document.getElementById("modalLRInput12").value = "";
                    document.getElementById("modalLRInput13").value = "";
                    document.getElementById("modalLRInput14").value = "";
                    document.getElementById("modalLRInput15").value = "";
                    document.getElementById("modalLRInput16").value = "";
                    document.getElementById("modalLRInput17").value = "";
                    document.getElementById("modalLRInput18").value = "";
                    document.getElementById("modalLRInput19").value = "";
                    document.getElementById("modalLRInput22").value = "";
                } else if(data == "2") {
                    alert("Tài khoản đã tồn tại.");
                    document.getElementById('modalLRInput14').focus();
                }
            });
        }
    });  
    
});
function ktra($ho, $ten, $taikhoan, $matkhau, $nhaplaimatkhau, $email, $sodienthoai, $ngaysinh, $diachi) {
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/; 
    var vnf_regex = /((0)+([0-9]{9})\b)/g;
    if($.trim($ho).length <= 0) {
        alert("Họ của bạn đang rỗng.");
        document.getElementById('modalLRInput12').focus();
        return 0;
    }
    if($.trim($ten).length <= 0) {
        alert("Tên của bạn đang rỗng.");
        document.getElementById('modalLRInput13').focus();
        return 0;
    }
    if($.trim($taikhoan).length <= 0) {
        alert("Tài khoản của bạn đang rỗng.");
        document.getElementById('modalLRInput14').focus();
        return 0;
    }
    if($.trim($matkhau).length <= 0) {
        alert("Mật khẩu lần 1 của bạn đang rỗng.");
        document.getElementById('modalLRInput15').focus();
        return 0;
    }
    if($.trim($nhaplaimatkhau).length <= 0) {
        alert("Mật khẩu lần 2 của bạn đang rỗng.");
        document.getElementById('modalLRInput16').focus();
        return 0;
    } else if($matkhau != $nhaplaimatkhau) {
        alert("Mật khẩu lần 2 của bạn không trùng khớp với mật khẩu lần 1.");
        document.getElementById('modalLRInput16').focus();
        return 0;
    }
    if($.trim($email).length <= 0) {
        alert("Email của bạn đang rỗng.");
        document.getElementById('modalLRInput17').focus();
        return 0;
    }else if(!filter.test($email)) {
        alert("Email của bạn không đúng định dạng. \nExample@gmail.com");
        document.getElementById('modalLRInput17').focus();
        return 0;
    }
    if($.trim($sodienthoai).length <= 0) {
        alert("Số điện thoại của bạn đang rỗng.");
        document.getElementById('modalLRInput18').focus();
        return 0;
    } else if(!vnf_regex.test($sodienthoai)) {
        alert("Số điện thoại của bạn phải đúng định dạng bắt đầu là số 0 và tối đa là 10 số.");
        document.getElementById('modalLRInput18').focus();
        return 0;
    }
    if($.trim($ngaysinh).length <= 0) {
        alert("Ngày sinh của bạn đang rỗng.");
        document.getElementById('modalLRInput19').focus();
        return 0;
    }
    if($.trim($diachi).length <= 0) {
        alert("Địa chỉ của bạn đang rỗng.");
        document.getElementById('modalLRInput22').focus();
        return 0;
    }
    return 1;
}