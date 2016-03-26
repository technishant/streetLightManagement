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
            if (data.status == 1) {
                $.each(data.data, function (index, element) {
                    var pos = new google.maps.LatLng(this.latitude, this.longitude);
                    var popup = new google.maps.InfoWindow({
                        content: "<h5>Device ID - " + this.controller_id + "</h5><table>\n\
                                  <tr><td>IMEI No. - </td><td>" + this.imei_number + "</td></tr>\n\
                                  <tr><td>SIM No. - </td><td>" + this.sim_number + "</td></tr>\n\
                                  <tr><td>SIM No. - </td><td>" + this.sim_number + "</td></tr>\n\
                                  <tr><td>Current Voltage - </td><td>" + this.logs.current_voltage + " V " + "</td></tr>\n\
                                  <tr><td>Current Load - </td><td>" + this.logs.current_load + " KW "+ "</td></tr>\n\
                                  <tr><td>Voltage Status - </td><td>" + this.logs.voltage_status + "</td></tr>\n\
                                  <tr><td>Light Status - </td><td>" + this.logs.light_status + "</td></tr>\n\
                                  <tr><td>Overload Status - </td><td>" + this.logs.overload_status + "</td></tr>\n\
                                  <tr><td>Synced At - </td><td>" + this.created + "</td></tr>\n\
                                </table>",
                        maxWidth: 250
                    });
                    var marker = new google.maps.Marker({
                        position: pos,
                        map: map,
                        title: this.controller_id,
                        icon: (element.status == 0) ? 'http://maps.google.com/mapfiles/ms/icons/red-dot.png' : 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'
                    });
                    google.maps.event.addListener(marker, 'mouseover', function () {
                        popup.open(map, marker);
                    });
                    google.maps.event.addListener(marker, 'mouseout', function () {
                        popup.close();
                    });
                });
            } else {
                console.log("No devices could be found.");
            }
        },
        complete: function (data) {
            console.log("its done");
        }
    });
}
google.maps.event.addDomListener(window, 'load', initialize);

$('#refresh-map').click(function () {
    alert("dsd");
});