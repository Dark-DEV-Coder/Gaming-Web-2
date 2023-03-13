$(document).ready(function() {   
    
    
    $(document).on('click',  '#addgiohang1', function() {
        var id = $(this).attr('name');
        load_nd1(id);
    }); 
        
});



function load_nd1($id) {
    $.post('http://localhost/Gaming/php/loadsp2.php', {id:$id}, function(data) {
        if(data) {
            location.href = 'http://localhost/Gaming/php/giohang.php';
        }
    });
}