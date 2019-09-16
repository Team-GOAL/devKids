<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>MuziVic</title>
    
    <meta name="description" content="">
    <meta name="robots" content="noindex, follow"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

    <!-- all css here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/icons.css">
    <link rel="stylesheet" href="assets/css/plugins.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <script src="Scripts/jquery-3.2.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
    <script type="text/javascript">WebFont.load({google: {families: ["Karla:regular,italic,700", "Frank Ruhl Libre:300,regular", "Playfair Display:regular,italic,700,700italic,900,900italic"]}});</script>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Karla:regular,italic,700%7CFrank+Ruhl+Libre:300,regular%7CPlayfair+Display:regular,italic,700,700italic,900,900italic"
          media="all">
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>

</head>
<body class="wrapper">
<!-- header start -->
<?php include "header.html" ?>
<div class="pt-120 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-6">
                <div id="map"></div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-7 col-md-6">
    <div class="container" style="margin-top: 5%;margin-bottom: 5%">
        <div class="col-6 offset-3" style="align-content: center; align-self: center; ">
            <form id="preferenceForm" name="preferenceForm"
                  action="../php/server%20receive%20request%20on%20preference.php" method="post">
                <div id="ageList" style="align-content: center; align-self: center; ">
                    <label for="age">Select your child's age</label>
                    <select class="custom-select" name="age" id="age">
                        <option>0</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option selected="selected">7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                        <option>11</option>
                    </select>
                </div>
                <div id="genderList">
                    <label for="gender">Select your child's gender</label>
                    <br>
                    <select name="gender" id="gender">
                        <option selected="selected">male</option>
                        <option>female</option>
                    </select>
                </div>
                <div id="teamList">
                    <label for="teamIndividual">Team or individual sports?</label>
                    <br>
                    <select name="teamIndividual" id="teamIndividual">
                        <option selected="selected">team</option>
                        <option>individual</option>
                    </select>
                </div>
                <div id="indoorList">
                    <label>Indoor or Outdoor?</label>
                    <br>
                    <select name="indoorOutdoor" id="indoorOutdoor">
                        <option selected="selected">indoor</option>
                        <option>outdoor</option>
                    </select>
                </div>
                <br>
                <button style="border-radius: 4px;" type="button" form="preferenceForm" id="preferenceButton"
                        value="Submit">See our recommendation
                </button>
            </form>
            <div id='displayPreference'
                 style="align-content: center; align-self: center; padding-left: 5%;padding-top: 5%"></div>

        </div>
    </div>
    <!--input class="submit" type="submit" value="Send Message"-->
    <p class="form-messege"></p>
</div>
</div>
</div>
</div>
</div>
</div>
<?php include "footer.html" ?>
<script>
    $(document).ready(function () {
        $("#mapButton").click(function (e) {
            $('#displayLocations').empty();
            e.preventDefault();
            $.ajax({
                url: "../php/server%20receive%20request%20on%20sports.php",
                type: "POST",
                data: $('#mapForm').serialize(),
                success: function (data) { // Pop the location data on map
                    var output = "";
                    for (var i in data) {
                        output += "<br>" + data[i].facilityName + ": " + data[i].address + "<br>";
                        output += "Sports activity: " + data[i].sports + "<br>";
                    }
                    output += "</tbody></table>";
                    $('#displayLocations').append(output);
                },
                error: function (jqxhr, status, exception) {
                    alert("No result found. Please refresh and search again.");
                    //alert(status);
                    //alert(exception);
                }
            });
            $("#mapButton").unbind();
        });
    });

    $(document).ready(function () {
        $("#preferenceButton").click(function (e) {
            $('#displayPreference').empty();
            e.preventDefault();
            $.ajax({
                url: "php/testPreference.php",
                type: "POST",
                data: $('#preferenceForm').serialize(),
                //age: $('#age').val(),
                // gender: genderVal,
                //teamIndividual:teamVal,
                //indoorOutdoor: indoorVal
                success: function (data) {
                    //  var sports = getJson("sportsActivity", response);
                    var output = "<br>" + "Recommended Activities: " + "<br>";
                    for (var i in data) {
                        output += "<br>" + data[i].sportsActivity;
                    }
                    output += "</tbody></table>";
                    $('#displayPreference').append(output);

                },
                error: function (jqxhr, status, exception) {
                    alert(status);
                    alert(exception);
                }
            });
        });
    });

    $(document).ready(function () {
        $("chinesePopulationButtonButton").click(function () {
            $.get("../php/server%20receive%20request%20on%20Chinese%20proportion.php", function (data, status) {
                var output = "<br>" + "Top 10 places that aret he most popular among Chinese: " + "<br>";
                for (var i in data) {
                    output += "<br>" + data[i].suburbs;
                }
                output += "</tbody></table>";
                $('#population').append(output);

            });
        });
    });


    function getJson(key, jsonObj) {
        //1、Use eval
        var eValue = eval('jsonObj.' + key);
        return eValue;
    }


</script>
</body>
</html>