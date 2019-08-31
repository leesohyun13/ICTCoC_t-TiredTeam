<?php
//지도 마커=>정보 예제 페이지.
header('Content-Type: text/html; charset=UTF-8');

include 'menu.php';

// echo $chart_data;

?>

<div id="map" style="width:100%;height:400px;"></div>


<script id="code">

    var map = new naver.maps.Map('map', {
        center: new naver.maps.LatLng(37.3595704, 127.105399),
        zoom: 10
    });

    var marker = new naver.maps.Marker({
        position: new naver.maps.LatLng(37.3595704, 127.105399),
        map: map
    });



    var exwitch;
    var num = 0;
    var witch;

    naver.maps.Event.addListener(map, 'click', function(e) {
        marker.setPosition(e.latlng);
        //lat:경도 lng:위도

        //현재좌표
        witch = e.latlng;
        alert("0");
        alert(exwitch);
        //만약 가장 처음이라면
        if (num == 0) {
            alert("1");
            circle = new naver.maps.Circle({
                map: map,
                center: e.latlng,
                radius: 1000,
                fillColor: 'crimson',
                fillOpacity: 0.8,
                visible:true
            });
            exwitch = e.latlng;

        }

        if(num != 0){

            alert("2");
            circle.setMap(null);
            circle = new naver.maps.Circle({
                map: map,
                center: witch,
                radius: 1000,
                fillColor: 'crimson',
                fillOpacity: 0.8,
                visible:true
            });
            exwitch = e.latlng;


        }
        num++;


    });
</script>
</body>
</html>