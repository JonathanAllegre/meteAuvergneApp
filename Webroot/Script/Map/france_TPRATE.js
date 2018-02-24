 function initMap() {

        var styledMapType = new google.maps.StyledMapType(
        [
          {
            "featureType": "administrative",
            "elementType": "geometry",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "administrative.land_parcel",
            "stylers": [
              {
                "visibility": "on"
              }
            ]
          },
          {
            "featureType": "administrative.land_parcel",
            "elementType": "geometry",
            "stylers": [
              {
                "visibility": "on"
              }
            ]
          },
          {
            "featureType": "administrative.land_parcel",
            "elementType": "labels",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "landscape.natural.terrain",
            "stylers": [
              {
                "color": "#d5dcdc"
              },
              {
                "visibility": "on"
              },
              {
                "weight": 7.5
              }
            ]
          },
          {
            "featureType": "poi",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "poi",
            "elementType": "labels.text",
            "stylers": [
              {
                "visibility": "off"
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
            "elementType": "labels.icon",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "road.local",
            "elementType": "labels",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "transit",
            "stylers": [
              {
                "visibility": "off"
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
