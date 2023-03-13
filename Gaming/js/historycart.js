function detail(myvar){
    var value = myvar.attributes.value.value;
    $.ajax({
        url:"../php/chitiethoadon.php",
        method:"POST",
        data:{detail:value},
        success:function(data){
            $('#bodyhistory').html(data);
        }
    });
}
function block()
{
    document.getElementById("detailorder").style.display="none";
}