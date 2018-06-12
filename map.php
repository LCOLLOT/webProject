<?php
include ('affichage/header.php');
?>

<h2>l'ENSISA</h2>
<div class="row">
    <div class="col-lg-12">
        <title>Simple Map</title>
        <meta name="viewport" content="initial-scale=1.0">
        <meta charset="utf-8">
        <style>
            /* Always set the map height explicitly to define the size of the div
             * element that contains the map. */
            #map {
                height: 100%;
                margin:0;
                padding:0;
            }
        </style>
        <div id="map"></div>
        <script>
            let map;
                map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 16,
                    center: new google.maps.LatLng(47.7290842, 7.310896100000036),
                    mapTypeId: 'roadmap'
                });

                let iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
                let icons = {
                    parking: {
                        icon: iconBase + 'parking_lot_maps.png'
                    },
                    library: {
                        icon: iconBase + 'library_maps.png'
                    },
                    info: {
                        icon: iconBase + 'info-i_maps.png'
                    }
                };

                let features = [
                    {
                        position: new google.maps.LatLng(47.7290842, 7.310896100000036),
                        type: 'info'
                    }, {
                        position: new google.maps.LatLng(47.7324408, 7.312086000000022),
                        type: 'info'
                    }
                ];

                // Create markers.
                features.forEach(function(feature) {
                    new google.maps.Marker({
                        position: feature.position,
                        icon: icons[feature.type].icon,
                        map: map
                    });
                });
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBN2PTU4JQ2s_Ph8u4bo_pQpvVmlZt2s_Y&callback=initMap"
                async defer></script>
    </div>
</div>


<?php
include ('affichage/footer.php');
?>
