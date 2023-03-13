$(document).ready(function() {
    $('#btnoder').click(function() {
        var ho = $('#modalLRInput23').val();
        var ten = $('#modalLRInput24').val();
        var email = $('#modalLRInput25').val();
        var sodienthoai = $('#modalLRInput26').val();
        var diachi = $('#modalLRInput27').val();
        if(ktrathongtin(ho, ten, email, sodienthoai, diachi)==1){
            $.post("http://localhost/Gaming/php/thanhtoan.php", {ho:ho, ten:ten,  email:email, sdt:sodienthoai, diachi:diachi}, function(data) {
                if(data==1){
                    alert("giỏ hàng rỗng");
                }else if(data==2){
                    alert("Sản phẩm đã hết hàng sẽ được xóa trên giỏ hàng của bạn");
                    location.href = "http://localhost/Gaming/php/giohang.php";
                }else if(data==0){
                    alert("Thanh toán thành công");
                    location.href = "http://localhost/Gaming/php/giohang.php";
                }
                    
            });
        }
    });
});
function ktrathongtin($ho, $ten, $email, $sodienthoai,  $diachi) {
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/; 
    var vnf_regex = /((0)+([0-9]{9})\b)/g;
    if($.trim($ho).length <= 0) {
        alert("Họ của bạn đang rỗng.");
        document.getElementById('modalLRInput23').focus();
        return 0;
    }
    if($.trim($ten).length <= 0) {
        alert("Tên của bạn đang rỗng.");
        document.getElementById('modalLRInput24').focus();
        return 0;
    }
    if($.trim($email).length <= 0) {
        alert("Email của bạn đang rỗng.");
        document.getElementById('modalLRInput25').focus();
        return 0;
    }else if(!filter.test($email)) {
        alert("Email của bạn không đúng định dạng. \nExample@gmail.com");
        document.getElementById('modalLRInput25').focus();
        return 0;
    }
    if($.trim($sodienthoai).length <= 0) {
        alert("Số điện thoại của bạn đang rỗng.");
        document.getElementById('modalLRInput26').focus();
        return 0;
    } else if(!vnf_regex.test($sodienthoai)) {
        alert("Số điện thoại của bạn phải đúng định dạng bắt đầu là số 0 và tối đa là 10 số.");
        document.getElementById('modalLRInput26').focus();
        return 0;
    }
    if($.trim($diachi).length <= 0) {
        alert("Địa chỉ của bạn đang rỗng.");
        document.getElementById('modalLRInput27').focus();
        return 0;
    }
    return 1;
}