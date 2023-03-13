$(document).ready(function() { 
    
    $(document).on('click',  '.btn-cart', function() {
        var id = $(this).attr('class').replace('btn-cart ','');
        load_data_sp(id);
    }); 
    $(document).on('click',  '.btn-buy', function() {
        var id = $(this).attr('class').replace('btn-buy ','');
        load_data_sp1(id);
    }); 
    
}); 
function load_data_sp(id) {
    $.post('http://localhost/Gaming/php/addgiohang.php', {id:id}, function(data) {
        if(data) {
            $('#spchinh').html(data);
            alert("Thêm thành công")
        }
    });
}
function load_data_sp1(id) {
    $.post('http://localhost/Gaming/php/addgiohang1.php', {id:id}, function(data) {
        if(data) {
            location.href = 'http://localhost/Gaming/php/giohang.php';
        }
    });
}
