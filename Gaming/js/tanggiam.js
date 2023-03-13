function cart(myvar) {
    var value = myvar.attributes.value.value;
    var id = myvar.attributes.id.value;
    // $.ajax({
    //     url:"http://localhost/Gaming/php/sessioncart.php",
    //     method:"POST",
    //     data:{id:id,pheptinh:value},
    //     success:function(data){
    //         // $('#showcart').html(data); 
    //              alert(data);
    //     }
    // });
    //alert(value);
    // alert(id);
    $.post('http://localhost/Gaming/php/sessioncart.php', {id:id,pheptinh:value}, function(data) {
        //alert(data);
            if(data==1){
                alert('Sản phẩm đã hết hàng');
            }else{
                //alert(data);
                $('#showcart').html(data); 
            }
        
    });
}