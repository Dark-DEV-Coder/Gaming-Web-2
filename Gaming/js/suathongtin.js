$(document).ready(function() {
    $('#btnsuathongtin').click(function() {
        var ma = $(this).attr('name');
        var ho = $('#modalTTInput9').val();
        var ten = $('#modalTTInput10').val();
        var email="";
        if(ma == 'Q1') {
            email = $('#modalTTInput11').val();
        }
        var sodienthoai = $('#modalTTInput12').val();
        var ngaysinh = $('#modalTTInput13').val();
        var diachi = $('#modalTTInput16').val();
        var gioitinh = document.getElementsByName("gioitinh2");
        var gt = 0;
        for (var i = 0; i < gioitinh.length; i++){
            if (gioitinh[i].checked === true){
                gt = gioitinh[i].value;
            }
        }
        if(ktratt(ma, ho, ten, email, sodienthoai, ngaysinh, diachi)===1) {
            $.post("http://localhost/Gaming/php/suathongtin.php", {ho:ho, ten:ten, email:email, sodienthoai:sodienthoai, ngaysinh:ngaysinh, diachi:diachi, gt:gt}, function(data) {
                if(data == "1") {
                    var x = location.href;
                    alert("Cập nhật thông tin thành công.");
                    location.href = x;
                }
            });
        }
    });  
    
});
function ktratt($ma, $ho, $ten, $email, $sodienthoai, $ngaysinh, $diachi) {
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/; 
    var vnf_regex = /((0)+([0-9]{9})\b)/g;
    if($.trim($ho).length <= 0) {
        alert("Họ của bạn đang rỗng.");
        document.getElementById('modalTTInput9').focus();
        return 0;
    }
    if($.trim($ten).length <= 0) {
        alert("Tên của bạn đang rỗng.");
        document.getElementById('modalTTInput10').focus();
        return 0;
    }
    if($ma == 'Q1') {
        if($.trim($email).length <= 0) {
            alert("Email của bạn đang rỗng.");
            document.getElementById('modalTTInput11').focus();
            return 0;
        }else if(!filter.test($email)) {
            alert("Email của bạn không đúng định dạng. \nExample@gmail.com");
            document.getElementById('modalTTInput11').focus();
            return 0;
        }
    }
    if($.trim($sodienthoai).length <= 0) {
        alert("Số điện thoại của bạn đang rỗng.");
        document.getElementById('modalTTInput12').focus();
        return 0;
    } else if(!vnf_regex.test($sodienthoai)) {
        alert("Số điện thoại của bạn phải đúng định dạng bắt đầu là số 0 và tối đa là 10 số.");
        document.getElementById('modalTTInput12').focus();
        return 0;
    }
    if($.trim($ngaysinh).length <= 0) {
        alert("Ngày sinh của bạn đang rỗng.");
        document.getElementById('modalTTInput13').focus();
        return 0;
    }
    if($.trim($diachi).length <= 0) {
        alert("Địa chỉ của bạn đang rỗng.");
        document.getElementById('modalTTInput16').focus();
        return 0;
    }
    return 1;
}