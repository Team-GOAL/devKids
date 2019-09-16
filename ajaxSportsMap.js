$( document ).ready(function(){
    $('#mapButton').click(function(){
        var suburb =  $('#suburb').val();
        var sports =  $('#sports').val();
        var formData;
        if (suburb === ""){
            formData = {"sports": sports};
        }
        else{
            formData = {"suburb":suburb, "sports": sports};
            }
        $.ajax({
            type: "POST",
            url: '../php/server%20receive%20request%20on%20sports.php',
            dataType:"json",
            data: formData,
            success: function(response)
            {
                $('#displayLocations').html(response);
            }
        });
    });
});