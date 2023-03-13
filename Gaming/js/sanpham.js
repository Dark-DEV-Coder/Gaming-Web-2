// $(document).ready(function() { 
    
//     $(document).on('click',  '.btnmenu', function() {
//         var id = $(this).attr('id');
//         alert(id);
//         load_sp(id);
//     }); 
    
// }); 
// function load_sp($id) {
//     $.post('./loadsp.php', {id:$id}, function(data) {
//         if(data) {
//             $('#spchinh1').html(data);
//             alert(data);
//         }
//         console.log(data);
//     });
// }
function disableF5(e) { 
    if ((e.which || e.keyCode) == 116 || (e.which || e.keyCode) == 82)
        e.preventDefault(); 
};
var page = 1;
$(document).ready(function() {   
    $(document).on('click',  '.page-link', function() {
        var id = $(this).attr('name');
        page = $(this).data('page_number');
        load_data(page, id);
        $(document).on("keydown", disableF5);
    }); 
    
    $(document).on('click',  '.btn-cart', function() {
        var id = $(this).attr('class').replace('btn-cart ','');
        load_data1(page, id);
    }); 
    $(document).on('click',  '.btn-buy', function() {
        var id = $(this).attr('class').replace('btn-buy ','');
        load_data2(id);
    }); 
        
});
function load_data(page, id) {
    $.post('http://localhost/Gaming/php/loadsp.php', {page:page, id:id}, function(data) {
        $('#spchinh11').html(data);
        $(window).scrollTop(0);
    });
}
function load_data1($page, $id) {
    $.post('http://localhost/Gaming/php/loadsp1.php', {page,$page, id:$id}, function(data) {
        $('#spchinh1').html(data);
        alert("Thêm thành công.");
    });
}
function load_data2($id) {
    $.post('http://localhost/Gaming/php/loadsp2.php', {id:$id}, function(data) {
        if(data) {
            location.href = 'http://localhost/Gaming/php/giohang.php';
        }
    });
}


    