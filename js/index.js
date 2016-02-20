$(document).ready(function() {
    $("#id_SubmitReq").click(function(){
        $.post( "submit.php", $("#id_ReqForm").serialize());
    })
})

function initMap() {
    navigator.geolocation.getCurrentPosition(function(position) {
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

        $.post("load.php", function(data) {
            var testData = jQuery.parseJSON(data);
            addMarkers(testData, map);
        });

        userReq.addEventListener('click', function(e) {
            map.setCenter(pos);
            var marker = new google.maps.Marker({
                position: pos,
                map: map,
                draggable:true
            });
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
        new google.maps.Marker({
            position: loc,
            map: map
        });
    }
}