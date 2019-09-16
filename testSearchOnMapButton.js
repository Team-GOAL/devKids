$( function() {
    $( ".widget button" ).button();
    $( "button" ).click( function( event ) {
        var params = {"gender":"male", "age":10};
        sendRequestForPreference(params);
    } );
} );

function sendRequestForPreference(params){
    $.ajax({
        type: "GET",
        url: 'test.php',
        contentType: "application/json",
        data: params,
        success: function(response)
        {
            if(data.status == 'ok'){
                console.log("Returing from AJAX request for preference ");
                // var activityList = splitToArray(response);
                //TODO display activities in html
                //activityList.foreach   TODO add ul list and display

            } else {
                console.log("Request for preference failed. ");
                //TODO display error
                //$(".display-error").html("<ul>"+data.msg+"</ul>");
                //$(".display-error").css("display","block");
            }
        }
    });
}