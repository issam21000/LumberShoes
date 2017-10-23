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

      var shopMarker = new google.maps.Marker({
        position: {lat: parseFloat(shop.latitude),lng: parseFloat(shop.longitude)},
        map: map
      });

      shopMarker.infoWindowHtmlContent = `<h4>`+shop.shop_name+`</h4>
                                          <button class="btn btn-primary shop-explore" data-shop-id="`+shop.id+`">Explorer
                                          </button>`;
      google.maps.event.addListener(shopMarker,'click',function(e){
        var infowindow = new google.maps.InfoWindow;
        infowindow.setContent(this.infoWindowHtmlContent);
        infowindow.open(map,this);
      });

      markers.push(shopMarker);
      bounds.extend({lat: parseFloat(shop.latitude),lng: parseFloat(shop.longitude)});
    }
    map.fitBounds(bounds);
    map.setCenter(bounds.getCenter());
}

$(document).ready(function(){

  //Click on explore to display the shoes based on a given shop

  $('body').on('click', '.shop-explore', function(e){
    e.preventDefault();
    if(NaN != parseInt($(this).data('shop-id'))){
      window.location.href = "./shops/"+$(this).data('shop-id');
    }
  });

});