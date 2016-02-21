$(document).ready(function() {
    $("#id_SubmitReq").click(function() {
        $.post("submit.php", $("#id_ReqForm").serialize())
            .done(function (data) {
            $("#id_ID").val(data);
            if($('#id_RadFound').is(':checked')) {
                $("#id_ReqForm").submit();
            } else if ($('#id_RadLost').is(':checked')) {
                $("#id_ReqForm").attr("action", "lost.php");
                $("#id_ReqForm").submit();
            }
        });
    });

    $("#id_UserReq").click(function() {
        $("#id_ReqForm").addClass("c_SubAppear");
        $("#id_ReqWrap").addClass("c_ReqReturn");
    })

    $("#id_MapQuit").click(function() {
        $("#id_ReqForm").removeClass("c_SubAppear");
        $("#id_ReqWrap").removeClass("c_ReqReturn");
    })

    $(document).on("click", ".class_MarkerEdit", function() {
        $("#id_ID").val($(this).attr("id"));
        $("#id_ReqLat").val($(this).siblings(".hidden_latitude").val());
        $("#id_ReqLng").val($(this).siblings(".hidden_longitude").val())
        if ($(this).siblings(".hidden_found").val() == 1) {
            $("#id_ReqForm").submit();
        } else {
            $("#id_ReqForm").attr("action", "lost.php");
            $("#id_ReqForm").submit();
        }
    })

    $(document).on("click", ".class_MarkerMine", function() {
        $("#id_MineID").val($(this).attr("id"));
        $("#id_Hiddentouser").val($(this).siblings("#id_touser").val())
        $("#form_Mine").submit();
    })
})

window.initMap = function() {
    navigator.geolocation.getCurrentPosition(function (position) {
        var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
        };
        var userReq = document.getElementById("id_UserReq");
        var mapQuit = document.getElementById("id_MapQuit");

        var map = new google.maps.Map(document.getElementById('id_MapDiv'), {
            zoom: 17,
            center: pos
        });

        $.post("load.php")
            .done(function (data) {
                var testData = JSON.parse(data);
                addMarkers(testData, map);
        });

        google.maps.event.addListenerOnce(map, 'idle', function(){
            document.getElementById("id_UserReq").disabled = false;
        })

        userReq.addEventListener('click', function (e) {
            // map.setCenter(pos);
            document.getElementById('id_ReqLat').value = map.getCenter().lat().toFixed(6);
            document.getElementById('id_ReqLng').value = map.getCenter().lng().toFixed(6);
            var marker = new google.maps.Marker({
                position: map.getCenter(),
                map: map,
                draggable:true
            });
            marker.setIcon('http://maps.google.com/mapfiles/ms/icons/blue-dot.png');
            google.maps.event.addListener(marker, 'dragend', function (evt) {
                document.getElementById('id_ReqLat').value = evt.latLng.lat().toFixed(6);
                document.getElementById('id_ReqLng').value = evt.latLng.lng().toFixed(6);
            });
            userReq.addEventListener('click', function (e) {
                marker.setMap(null);
            });
        });
    });
}

function addMarkers(markers, map) {
    for (var i = 0; i < markers.length; i++) {
        var loc = markers[i];
        var marker = new google.maps.Marker({
            position: {lat: loc.Latitude, lng: loc.Longitude},
            map: map
        });
        var contentString = '<div id="content">'+ loc.MarkerIdx +'. '+ loc.Item +'<br>Latitude: '+ loc.Latitude + ', Longitude: ' + loc.Longitude + '.<br>';
        contentString += 'Date: '+ loc.MarkerDate + '. Time: '+ loc.MarkerTime + '.<br>';
        if (loc.Found) {
            if (loc.User == $("#username").val()) {
                contentString += 'Item Found by You.<br><button class="class_MarkerEdit" value='+loc.MarkerIdx+'>Edit this entry</button>';
                contentString += '<input type="hidden" class="hidden_latitude" value='+loc.Latitude+'><input type="hidden" class="hidden_longitude" value='+loc.Longitude+'>';
                contentString += '<input type="hidden" class="hidden_found" value='+loc.Found+'></div>';
            } else {
                contentString += 'Item Found by User: '+loc.User+'.<br><button class="class_MarkerMine" id='+loc.MarkerIdx+'>This is mine.</button><input type="hidden" value='+loc.User+' id="id_touser"></div>';
            }
        }
        else {
            if (loc.User == $("#username").val()) {
                contentString += 'Item Lost by You.<br><button class="class_MarkerEdit" id='+loc.MarkerIdx+'>Edit this entry</button>';
                contentString += '<input type="hidden" class="hidden_latitude" value='+loc.Latitude+'><input type="hidden" class="hidden_longitude" value='+loc.Longitude+'>';
                contentString += '<input type="hidden" class="hidden_found" value='+loc.Found+'></div>';
            } else {
                contentString += 'Item Lost by User: '+loc.User+'.<br><button class="class_MarkerHave">I have it.</button></div>';
            }
        }
        attachInformation(marker, contentString);
    }
}

function attachInformation(marker, contentString) {
    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });

    marker.addListener('click', function() {
        infowindow.open(marker.get('map'), marker);
    });
}