 function initMap() {

        var styledMapType = new google.maps.StyledMapType(
        [
          {
            "elementType": "geometry",
            "stylers": [
              {
                "color": "#f5f5f5"
              }
            ]
          },
          {
            "elementType": "labels.icon",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "elementType": "labels.text.fill",
            "stylers": [
              {
                "color": "#616161"
              }
            ]
          },
          {
            "elementType": "labels.text.stroke",
            "stylers": [
              {
                "color": "#f5f5f5"
              }
            ]
          },
          {
            "featureType": "administrative.country",
            "elementType": "geometry",
            "stylers": [
              {
                "color": "#0ccff2"
              }
            ]
          },
          {
            "featureType": "administrative.land_parcel",
            "elementType": "labels.text.fill",
            "stylers": [
              {
                "color": "#bdbdbd"
              }
            ]
          },
          {
            "featureType": "administrative.locality",
            "stylers": [
              {
                "visibility": "simplified"
              }
            ]
          },
          {
            "featureType": "poi",
            "elementType": "geometry",
            "stylers": [
              {
                "color": "#eeeeee"
              }
            ]
          },
          {
            "featureType": "poi",
            "elementType": "labels.text.fill",
            "stylers": [
              {
                "color": "#757575"
              }
            ]
          },
          {
            "featureType": "poi.business",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "poi.park",
            "elementType": "geometry",
            "stylers": [
              {
                "color": "#e5e5e5"
              }
            ]
          },
          {
            "featureType": "poi.park",
            "elementType": "geometry.fill",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "poi.park",
            "elementType": "labels.text",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "poi.park",
            "elementType": "labels.text.fill",
            "stylers": [
              {
                "color": "#9e9e9e"
              }
            ]
          },
          {
            "featureType": "road",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "road",
            "elementType": "geometry",
            "stylers": [
              {
                "color": "#ffffff"
              }
            ]
          },
          {
            "featureType": "road.arterial",
            "elementType": "labels.text.fill",
            "stylers": [
              {
                "color": "#757575"
              }
            ]
          },
          {
            "featureType": "road.highway",
            "elementType": "geometry",
            "stylers": [
              {
                "color": "#dadada"
              }
            ]
          },
          {
            "featureType": "road.highway",
            "elementType": "labels.text.fill",
            "stylers": [
              {
                "color": "#616161"
              }
            ]
          },
          {
            "featureType": "road.local",
            "elementType": "labels.text.fill",
            "stylers": [
              {
                "color": "#9e9e9e"
              }
            ]
          },
          {
            "featureType": "transit.line",
            "elementType": "geometry",
            "stylers": [
              {
                "color": "#e5e5e5"
              }
            ]
          },
          {
            "featureType": "transit.station",
            "elementType": "geometry",
            "stylers": [
              {
                "color": "#eeeeee"
              }
            ]
          },
          {
            "featureType": "water",
            "elementType": "geometry",
            "stylers": [
              {
                "color": "#c9c9c9"
              }
            ]
          },
          {
            "featureType": "water",
            "elementType": "labels.text.fill",
            "stylers": [
              {
                "color": "#9e9e9e"
              }
            ]
          }
        ],
                    {name: 'Styled Map'});

                $('#map').attr('style', 'height:900px;border:solid 2px black;margin-top:10px;width:100%; background-color:#FEE"');
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 7,
                    center: {
                        lat: 46.73,
                        lng: 2.13
                    },
                    mapTypeIds: ['roadmap', 'satellite', 'hybrid', 'terrain',
                            'styled_map'],
                    minZoom: 0,
                    scrollwheel: true,
                });

                //Associate the styled map with the MapTypeId and set it to display.
                map.mapTypes.set('styled_map', styledMapType);
                map.setMapTypeId('styled_map');

                var imageBounds1 = {
                    north: 51.45,
                    south: 40.95,
                    east: 10.05,
                    west: -5.57
                };

                
                
                
                 baseUrl = $('#baseUrl').attr('url');

                Overlay = new google.maps.GroundOverlay(
                    baseUrl + "/0.png",
                    imageBounds1);

                Overlay.setMap(map);
                
                var legend = document.getElementById('legend');
                var div = document.createElement('div');

                $(".b_ech").click(function() {
                    ech = $(this).attr('ech');
                    $("#htmlEch").html("- " + $(this).text());
                    div.innerHTML = $(this).text();
                    Overlay.setMap(null);
                    Overlay = new google.maps.GroundOverlay(
                     baseUrl + "/"+ech+".png",
                      imageBounds1);

                  Overlay.setMap(map);
                  });
                
                 document.onkeydown = function(event){
                  var keycode = event.which || event.keyCode;
                  switch(keycode) {
                    case 89:
                      ech++;
                      $("#htmlEch").html("- " + $('#' + ech ).text());
                      div.innerHTML = $('#' + ech ).text();
                      $(".b_ech").removeClass('active');
                      $('#' + ech ).addClass('active');
                      Overlay.setMap(null);
                      Overlay = new google.maps.GroundOverlay(
                      baseUrl + "/"+ech+".png",
                      imageBounds1);
                      Overlay.setMap(map);
                      break;
                    case 84:
                      ech--;
                      $("#htmlEch").html("- " + $('#' + ech ).text());
                       div.innerHTML = $('#' + ech ).text();
                      $(".b_ech").removeClass('active');
                      $('#' + ech ).addClass('active');
                      Overlay.setMap(null);
                      Overlay = new google.maps.GroundOverlay(
                      baseUrl + "/"+ech+".png",
                      imageBounds1);
                      Overlay.setMap(map);
                      break;
                      
                  }
                  
                };
           legend.appendChild(div);
           map.controls[google.maps.ControlPosition.LEFT_BOTTOM].push(legend);


            }
