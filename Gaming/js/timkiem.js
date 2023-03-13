function disableF5(e) { 
    if ((e.which || e.keyCode) == 116 || (e.which || e.keyCode) == 82)
        e.preventDefault(); 
};
var page=1;
$(document).ready(function() {   
    $(document).on('click',  '.page-linkpage1', function() {
        var id = $(this).attr('name');
        page = $(this).data('page_number');
        
        var timkiem = $('#search-box').val();
        var giatu = $('#search-box1').val();
        var giaden = $('#search-box2').val();
        var nhasanxuat = $('#search-box3').children("option:selected").val();
        load_datatk(page, id, timkiem, giatu, giaden, nhasanxuat);
        $(document).on("keydown", disableF5);
    }); 
    $('#enter-box').click(function() {
        var timkiem = $('#search-box').val();
        var giatu = $('#search-box1').val();
        var giaden = $('#search-box2').val();
        var nhasanxuat = $('#search-box3').children("option:selected").val();
        var id = $(this).attr('name');
        if(ktratimkiem(timkiem, giatu, giaden, nhasanxuat)===1) {
            load_datatk(1, id, timkiem, giatu, giaden, nhasanxuat);
        }
    }); 
    $(document).on('click',  '.btn-cart1', function() {
        var id = $(this).attr('class').replace('btn-cart1 ','');
        var timkiem = $('#search-box').val();
        var giatu = $('#search-box1').val();
        var giaden = $('#search-box2').val();
        var nhasanxuat = $('#search-box3').children("option:selected").val();
        var idloai = $(this).attr('name');
        load_datatk1(page, id, idloai, timkiem, giatu, giaden, nhasanxuat);
    });
    
        
});
function load_datatk(page1, id, timkiem, giatu, giaden, nhasanxuat) {
    $.post("http://localhost/Gaming/php/timkiem.php", {page:page1, id:id, timkiem:timkiem, giatu:giatu, giaden:giaden, nhasanxuat:nhasanxuat}, function(data) {
        if(data) {
            $('#spchinh11').html(data);
        }
    });
}
function load_datatk1($page, $id, $idloai, $timkiem, $giatu, $giaden, $nhasanxuat) {
    $.post('http://localhost/Gaming/php/timkiem1.php', {page,$page, id:$id, idloai:$idloai, timkiem:$timkiem, giatu:$giatu, giaden:$giaden, nhasanxuat:$nhasanxuat}, function(data) {
        $('#spchinh1').html(data);
        alert("Thêm thành công.");
    });
}
function ktratimkiem($timkiem, $giatu, $giaden, $nhasanxuat) {
    var x = /^[0-9]+$/;
    if(!x.test($giatu)) {
        alert("Già tìm kiếm phải là số.");
        document.getElementById('search-box1').focus();
    } else if(!x.test($giaden)) {
        alert("Già tìm kiếm phải là số.");
        document.getElementById('search-box2').focus();
    } else if(Math.floor($giatu) > Math.floor($giaden)) {
        alert("Giá tìm kiếm từ không được lớn hơn giá tìm kiếm đến.");
        document.getElementById('search-box1').focus();
        return 0;
    }
    return 1;
}


    