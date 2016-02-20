function initMap() {
    var coordInit = {lat: 42.279594, lng: -83.732124};
    var userReq = document.getElementById("id_UserReq");

    var map = new google.maps.Map(document.getElementById('id_MapDiv'), {
        zoom: 15,
        center: coordInit
    });

    userReq.addEventListener('click', function(e) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            map.setCenter(pos);
            var marker = new google.maps.Marker({
                position: pos,
                map: map,
                title: 'Hello World!'
            });
        });
    });
}