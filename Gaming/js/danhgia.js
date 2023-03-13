$(document).ready(function() {   
    $(document).on('click',  '.detailHD', function() {
        var idsp = $(this).attr('name');
        document.getElementById('btndanhgia').name=idsp;

        
        
    });
    $(document).on('click',  '#btndanhgia', function() {
        var idsp = $(this).attr('name');
        var binhluan = $('#modalDGInput2').val();
        var sosao = $('#modalDGInput1').children("option:selected").val();
        $.post("http://localhost/Gaming/php/danhgia.php", {idsp:idsp, sosao:sosao, binhluan:binhluan}, function(data) {
            alert("Đánh giá hoàn thành.");
            location.href='http://localhost/Gaming/php/lichsu.php';
        });
        
    });
});