/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
//    function initialize() {
//        var mapCanvas = document.getElementById('map');
//        var mapOptions = {
//            center: new google.maps.LatLng(28.630604, 77.5271096),
//            zoom: 9,
//            mapTypeId: google.maps.MapTypeId.ROADMAP
//        }
//        var map = new google.maps.Map(mapCanvas, mapOptions)
//        $.ajax({
//            url: 'getDevices.php',
//            success: function (data) {
//                $.each(data, function (index, element) {
//                    var pos = new google.maps.LatLng(this.latitude, this.longitude);
//                    new google.maps.Marker({
//                        position: pos,
//                        map: map,
//                        title: this.device_number + " " + this.city,
//                        icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'
//                    });
//                });
//            }
//        });
//    }
//    google.maps.event.addDomListener(window, 'load', initialize);
 var conn = new Websocket('ws://localhost:5000');
 conn.onClose = function(e){
     alert("Dsd");
 };
 conn.onmessage = function(e) {
     alert("Messsage is received.");
 };
 
});