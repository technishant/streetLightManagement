/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function initialize() {
    var mapCanvas = document.getElementById('map');
    var mapOptions = {
        center: new google.maps.LatLng(28.630604, 77.5271096),
        zoom: 9,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    var map = new google.maps.Map(mapCanvas, mapOptions);
    $.ajax({
        url: 'load-devices-on-map',
        success: function (data) {
            $.each(data, function (index, element) {
                var pos = new google.maps.LatLng(this.latitude, this.longitude);
                new google.maps.Marker({
                    position: pos,
                    map: map,
                    title: this.controller_id,
                    icon: (element.status == 0) ? 'http://maps.google.com/mapfiles/ms/icons/red-dot.png' : 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'
                });
            });
        }
    });
}
google.maps.event.addDomListener(window, 'load', initialize);

