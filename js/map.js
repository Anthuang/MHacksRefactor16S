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
})

window.initMap = function() {
    navigator.geolocation.getCurrentPosition(function (position) {
        var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
        };
        var coordInit = {lat: 42.279594, lng: -83.732124};
        var userReq = document.getElementById("id_UserReq");

        var map = new google.maps.Map(document.getElementById('id_MapDiv'), {
            zoom: 17,
            center: pos
        });

        $.post("load.php", {username: $("#username").val()})
            .done(function (data) {
            var testData = jQuery.parseJSON(data);
            addMarkers(testData, map);
        });

        google.maps.event.addListenerOnce(map, 'idle', function(){
            alert('loaded!');
        })

        userReq.addEventListener('click', function (e) {
            map.setCenter(pos);
            document.getElementById('id_ReqLat').value = pos.lat.toFixed(3);
            document.getElementById('id_ReqLng').value = pos.lng.toFixed(3);
            var marker = new google.maps.Marker({
                position: pos,
                map: map,
                draggable:true
            });
            marker.setIcon('http://maps.google.com/mapfiles/ms/icons/blue-dot.png');
            google.maps.event.addListener(marker, 'dragend', function (evt) {
                document.getElementById('id_ReqLat').value = evt.latLng.lat().toFixed(3);
                document.getElementById('id_ReqLng').value = evt.latLng.lng().toFixed(3);
            });
        });
    });
}

function addMarkers(markers, map) {
    for (var i = 0; i < markers.length; i++) {
        var loc = markers[i];
        var marker = new google.maps.Marker({
            position: loc,
            map: map
        });
        var contentString = '<div id="content">'+ loc.lat + ', ' + loc.lng + '</div>';
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