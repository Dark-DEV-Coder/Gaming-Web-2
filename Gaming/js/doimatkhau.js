$(document).ready(function() {
    $('#btnsuamatkhau').click(function() {
        var matkhaucu = $('#modalTTInput17').val();
        var matkhaumoi = $('#modalTTInput18').val();
        var nhaplaimatkhaumoi = $('#modalTTInput19').val();
        if(ktra1(matkhaucu, matkhaumoi, nhaplaimatkhaumoi)===1) {
            $.post("http://localhost/Gaming/php/doimatkhau.php", {matkhaucu:matkhaucu, matkhaumoi:matkhaumoi, nhaplaimatkhaumoi:nhaplaimatkhaumoi}, function(data) {
                if(data == "1") {
                    alert("Đổi mật khẩu thành công.");
                    document.getElementById("modalTTInput17").value = "";
                    document.getElementById("modalTTInput18").value = "";
                    document.getElementById("modalTTInput19").value = "";
                } else if(data == "2") {
                    alert("Mật khẩu cũ không đúng.");
                    document.getElementById('modalTTInput17').focus();
                }
            });
        }
    });  
    
});
function ktra1($matkhaucu, $matkhaumoi, $nhaplaimatkhaumoi) {

    if($.trim($matkhaucu).length <= 0) {
        alert("Mật khẩu cũ của bạn đang rỗng.");
        document.getElementById('modalTTInput17').focus();
        return 0;
    }
    if($.trim($matkhaumoi).length <= 0) {
        alert("Mật khẩu mới lần 1 của bạn đang rỗng.");
        document.getElementById('modalTTInput18').focus();
        return 0;
    }
    if($.trim($nhaplaimatkhaumoi).length <= 0) {
        alert("Mật khẩu mới lần 2 của bạn đang rỗng.");
        document.getElementById('modalTTInput19').focus();
        return 0;
    } else if($matkhaumoi != $nhaplaimatkhaumoi) {
        alert("Mật khẩu mới lần 2 của bạn không trùng khớp với mật khẩu mới lần 1.");
        document.getElementById('modalTTInput19').focus();
        return 0;
    }
    
    return 1;
}