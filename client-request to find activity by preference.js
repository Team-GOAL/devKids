('#mapButton').click(function(){//TODO ajax connect here!
        let suburb = document.getElementById("suburb");  //TODO
        let activity = document.getElementById("activity");
        var validSuburb = validateSuburb(suburb);
        var params= [];
        if (validSuburb){
            params.push({"suburb": suburb});
        }
        params.push({"activity": activity});
    $.ajax({
        type: "POST",
        url: '../php/server%20receive%20request%20on%20sports.php',
        dataType: "json",
        data: params,
        success: function(response)
        {
            console.log("ajax succeeded!");
            //let jsonData = JSON.parse(response);
            //TODO convert the json data to gson.
            //TODO pop on map
        }
    });
    });

function validateSuburb(suburb){
    var check = true;
    if (suburb.length()===0 || suburb.length() > 55){
        check = false;
    }
    if (!suburb.match("^[a-zA-Z\(\)]+$")){
        check = false;
    }
    return check;
}

('#preferenceButton').click(function(){
        let gender = document.getElementById("gender");  //TODO
        let age = document.getElementById("age");
        let team = document.getElementById("team");
        let indoor = document.getElementById("indoor");
        if (gender.isEmptyObject() && age.isEmptyObject()){
            window.alert("Age and gender are required for the recommendation.");
        }
        //TODO ensure that indoor and team have default values
        else{
            var params = createParamsForPreference(gender, age, team, indoor);
            $.post('../php/server%20receive%20request%20on%20preference.php', params, function(data){
                var activities = "<p>" + data + "</p>";
                $ ('#activityResult').append (activities);
                }
            );
        }
    });

//TODO do i need the script text or not
function createParamsForPreference(gender, age, team, indoor){
    let paramsPreference = [];
    //TODO debug to see if the length syntax is correct, or childNode is needed
    //TODO check the default value
    if (age.length()!==0){
        paramsPreference.push({"age": age});
    }
    if (gender.length()!==0){
        paramsPreference.push({"gender": gender});
    }
    if (team.length()!==0){//TODO update this with the defult value
        paramsPreference.push({"team": team});
    }
    if (indoor.length()!==0){ //TODO update this with the defult value
        paramsPreference.push({"indoor": indoor});
    }
    return paramsPreference;
}

/*
   Accepts an array of suburb and sports activity and send them to the server.
 */
function sendRequestForMap(params){
    $.ajax({
        type: "POST",
        url: 'server receive request on sports.php', //TODO update the url.
        dataType: "json",
        data: params,
        success: function(response)
        {
            let jsonData = JSON.parse(response);
            //TODO convert the json data to gson.
            //TODO pop on map
        }
    });
}

/*
   Accepts an array of preferences and send them to the server.
 */
function sendRequestForPreference(params){
    $.ajax({
        type: "GET",
        url: 'server receive request on preference.php',
        contentType: "text",
        data: params,
        success: function(response)
        {
            if (data.code == "200"){
                console.log("Returing from AJAX request for preference ");
                var activityList = splitToArray(response);
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

/*
Accepts a text string and split it to an array
 */
function splitToArray(text){
    //TODO
    var array = [];
    return array;
}




