$( document ).ready(function() {
    //Subir imagen para ver el color
    $( "#submitform" ).submit(function( event ) {
        event.preventDefault();
        formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "/getColor",
            data: formData,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            success: function(result) {
                if(result.status == 'error'){
                    alert(result.msg);
                }else{
                    $("#color_result").css({
                        'background-color': result.color.hexa
                    });
                    $("#my_image").attr("src",result.img);
                }
            },
            error: function(result) {
                alert('Error');
            }
        });

    });
});