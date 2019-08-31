<?php
//지도 마커=>정보 예제 페이지.
header('Content-Type: text/html; charset=UTF-8');
$connect = mysqli_connect("localhost","cho","teamnova","ai");
$query = "select * from accident_data where sigugun_code=1";
$result = mysqli_query($connect, $query);
//$chart_data = array();
//사고데이터
$chart_data = '';

//  사고 데이터 자세한 정보를 저장하는 배열
$accident_data= array();


//신호등데이터
$query1 = "select * from cross_walk where 구코드=1";
$result1 = mysqli_query($connect, $query1);
//$chart_data1 = '';
// DB서 정보가져오기.
while($row = mysqli_fetch_array($result))
{
//    $chart_data .= "'".$row["point_name"]."':[".$row["Latitude"].", ".$row["longitude"]."], ";

    $chart_data .= "'".$row["point_name"]."':[".$row["Latitude"].", ".$row["longitude"].",".$row['Occurrence'].",".$row['Casualty'].",".$row['dead_count'].",".$row['slanderer'].",".$row['Thin_embroidery'].",".$row['Injured_count'].",".$row['state_code']."], ";

}



// DB서 정보가져오기.
//while($row = mysqli_fetch_array($result1))
//{
//    $chart_data1 .= "'".$row["순번"]."':[".$row["위도"].", ".$row["경도"]."], ";
//
////    $chart_data1 .= "new naver.maps.LatLng(".$row["위도"].", ".$row["경도"]."), ";
//}

$chart_data = substr($chart_data, 0, -2);

//echo $chart_data;

//$chart_data1 = substr($chart_data1, 0, -2);

include 'menu.php';

?>


<div id="map" style="width:100%;height:800px;"></div>


<script id="code">
    // alert("1");
    var HOME_PATH = window.HOME_PATH || '.';
    //사고지점좌표위치
    var MARKER_SPRITE_POSITION = {
        <?php echo $chart_data?>
    };
    // alert("2");
    //신호등좌표위치
    var MARKER_CROSS_POSITION = {
        <?php echo $chart_data1?>
    };
    // alert("3");
    //네이버지도 초기위치
    var map = new naver.maps.Map('map', {
        center: new naver.maps.LatLng(37.517436, 127.047418),
        zoom: 12
    });
    // alert("4");
    //맵에서 보이는 영역의 모서리에 대한 위도와 경도
    var bounds = map.getBounds();

    //마커와 마커안에 넣어줄 데이터들
    var markers = [],
        infoWindows = [];

    //신호등 위치 마커
    var crosswalkmarkers=[], crossinfoWindows = [];


    //다수의 데이터 실제로 마커안에 담기
    for (var key in MARKER_SPRITE_POSITION) {

//사고지점마커의 위치
        var position = new naver.maps.LatLng(
            MARKER_SPRITE_POSITION[key][0],
            MARKER_SPRITE_POSITION[key][1]);


//사고지점 마커 설정
        var marker = new naver.maps.Marker({
            map: map,
            position: position,
            title: key,
            icon: {


                url: '/test/img/icon4.png',
                size: new naver.maps.Size(24, 37),
                //앵커 위치로 이미지 작동
                anchor: new naver.maps.Point(0, 0),
                origin: new naver.maps.Point(0, 0)

                //
                // url: HOME_PATH +'/img/example/sp_pins_spot_v3.png',
                // size: new naver.maps.Size(24, 37),
                // anchor: new naver.maps.Point(12, 37),
                // origin: new naver.maps.Point(MARKER_SPRITE_POSITION[key][0], MARKER_SPRITE_POSITION[key][1])
            },
            zIndex: 100
        });




//마커 정보설정
        var infoWindow = new naver.maps.InfoWindow({


            content: '<div  class="iw_inner"' +
                'style="width:200px; text-align:center;padding:5px;">장소: <b>'+ key +'</b>' +
                '<p> 사고 발생 건수 :'+ MARKER_SPRITE_POSITION[key][2] +'</p>' +
                '<p> 사상자수 :'+ MARKER_SPRITE_POSITION[key][3] +'</p>' +
                '<p> 사망자수 :'+ MARKER_SPRITE_POSITION[key][4] +'</p>' +
                '<p> 중상자수 :'+ MARKER_SPRITE_POSITION[key][5] +'</p>' +
                '<p> 경상자수 :'+ MARKER_SPRITE_POSITION[key][6] +'</p>' +
                '<p> 부상 신고자수 :'+ MARKER_SPRITE_POSITION[key][7] +'</p>' +
                '</div>'

            // content: '<div style="width:150px;text-align:center;">장소: <b>재미있는 장소</b>.</div>'



        });

//마커배열에 설정한 마커넣기
        markers.push(marker);

        //마커정보에 지정한 정보 넣기
        infoWindows.push(infoWindow);
    };

    //     //신호등 데이터 실제로 마커안에 담기
    for (var key in MARKER_CROSS_POSITION) {
        // alert("MARKER_CROSS_POSITION");
//신호등의 위치
        var position = new naver.maps.LatLng(
            MARKER_CROSS_POSITION[key][0],
            MARKER_CROSS_POSITION[key][1]);

//신호등의 마커 설정
        var marker = new naver.maps.Marker({
            map: map,
            position: position,
            title: key,
            icon: {
                url: HOME_PATH +'/img/example/sp_pins_spot_v3.png',
                size: new naver.maps.Size(24, 37),
                anchor: new naver.maps.Point(12, 37),
                origin: new naver.maps.Point(MARKER_CROSS_POSITION[key][0], MARKER_CROSS_POSITION[key][1])


                // url: '/test/img/icon5.png',
                // size: new naver.maps.Size(24, 37),
                // //앵커 위치로 이미지 작동
                // anchor: new naver.maps.Point(0, 0),
                // origin: new naver.maps.Point(0, 0)

            },
            zIndex: 100
        });
//마커 정보설정
//         var infoWindow = new naver.maps.InfoWindow({
//             // content: '<div style="width:150px;text-align:center;padding:10px;">장소: <b>"'+ key.substr(0, 28) +'"</b>.</div>'
//             content: '<div style="width:150px;text-align:center;">장소: <b>재미있는 장소</b>.</div>'
//
//         });


        //마커정보에 지정한 정보 넣기
        crossinfoWindows.push(infoWindow);
//신호등마커배열에 설정한 마커넣기
        crosswalkmarkers.push(marker);

    };



    naver.maps.Event.addListener(map, 'idle', function() {

        updateMarkers(map, markers);
        updatecrossMarkers(map,crosswalkmarkers);
    });

    //현재 지도 줌된 영역(위치 안의) 마커만 띄어주기.
    function updateMarkers(map, markers,crosswalkmarkers) {

        var mapBounds = map.getBounds();
        var marker, position;
        var crosswalkmarker,crossposition;

        for (var i = 0; i < markers.length; i++) {
            // for(var i = 0; i < crosswalkmarkers.length; i++){
            marker = markers[i];
            position = marker.getPosition();
            // crosswalkmarker = crosswalkmarkers[i];
            // crossposition = crosswalkmarker.getPosition();

            //만약 현재 지정된 영역안에 마크가 있는게 확인되면
            if (mapBounds.hasLatLng(position)) {

                showMarker(map, marker);
            } else {
                hideMarker(map, marker);
            }
            //  }
        }



    }


    //현재 지도 줌된 영역(위치 안의) 마커만 띄어주기.
    function updatecrossMarkers(map, markers) {
        // alert("updatecrossMarkers");

        var marker, position;

        for (var i = 0; i < markers.length; i++) {

            marker = markers[i];
            position = marker.getPosition();


            //만약 현재 지정된 영역안에 마크가 있는게 확인되면
            if (mapBounds.hasLatLng(position)) {

                showMarker(map, marker);
            } else {
                hideMarker(map, marker);
            }

        }



    }

    //보여줄 마커
    function showMarker(map, marker) {

        if (marker.setMap()) return;
        marker.setMap(map);
        //
        // if (crosswalkmarker.setMap()) return;
        // crosswalkmarker.setMap(map);
    }

    //숨길 마커
    function hideMarker(map, marker) {

        if (!marker.setMap()) return;
        marker.setMap(null);
        // if (!crosswalkmarker.setMap()) return;
        // marker.setMap(null);

    }
    //}

    // 해당 마커의 인덱스를 seq라는 클로저 변수로 저장하는 이벤트 핸들러를 반환합니다.
    //마커를 클릭시 해당 마커의 정보를 가져오기 위한 핸들러.
    function getClickHandler(seq) {
        return function(e) {
            var marker = markers[seq],
                infoWindow = infoWindows[seq];

            if (infoWindow.getMap()) {
                infoWindow.close();
            } else {
                infoWindow.open(map, marker);
            }
        }
    }

    for (var i=0, ii=markers.length; i<ii; i++) {
        naver.maps.Event.addListener(markers[i], 'click', getClickHandler(i));
    }
</script>
</body>
</html>