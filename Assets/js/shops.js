function initMap() {
    var center = {lat: 48.6833, lng: 6.2};
    var map = new google.maps.Map(document.getElementById('gmap'), {
      zoom: 4,
      center: center
    });
    /*var marker = new google.maps.Marker({
      position: center,
      map: map
    });*/

    var markers = [];

    /*
    **The Google maps LatLngBounds object to fit map zoom & bounds based on existing shops markers
    */
    var bounds = new google.maps.LatLngBounds();

    for(shop of shops){
      console.log(shop);
      console.log({lat: parseFloat(shop.latitude),lng: parseFloat(shop.longitude)});
      markers.push(new google.maps.Marker({
        position: {lat: parseFloat(shop.latitude),lng: parseFloat(shop.longitude)},
        map: map
      }));
      bounds.extend({lat: parseFloat(shop.latitude),lng: parseFloat(shop.longitude)});
    }
    map.fitBounds(bounds);
    map.setCenter(bounds.getCenter());
}
