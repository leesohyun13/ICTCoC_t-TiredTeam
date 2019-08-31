<?php
//지도 마커=>정보 예제 페이지.
header('Content-Type: text/html; charset=UTF-8');
$connect = mysqli_connect("localhost","cho","teamnova","ai");

//위험한 사고지역
$query = "select * from accident_data where sigugun_code=4 and state_code=0";
//state_code = 등급 0/1/2 =>가장 위험한거는? 0 = 위험 1=중간 2=경고
$result = mysqli_query($connect, $query);
//$chart_data = array();
//위험한 사고데이터
$chart_data = '';


//신호등데이터
$query1 = "select * from cross_walk where 구코드=4";
$result1 = mysqli_query($connect, $query1);
//$total_rows =mysqli_num_rows($result1);
//echo $total_rows;

$chart_data1 = '';
//중간 사고지역
$query2 = "select * from accident_data where sigugun_code=4 and state_code=1";
//state_code = 등급 0/1/2 =>가장 위험한거는? 0 = 위험 1=중간 2=경고
$result2 = mysqli_query($connect, $query2);
//$chart_data = array();
//중간 사고데이터
$chart_data2 = '';

//약한 사고지역
$query3 = "select * from accident_data where sigugun_code=4 and state_code=2";
//state_code = 등급 0/1/2 =>가장 위험한거는? 0 = 위험 1=중간 2=경고
$result3 = mysqli_query($connect, $query3);
//$chart_data = array();
//약한 사고데이터
$chart_data3 = '';

// 위험한 사고 데이터
while($row = mysqli_fetch_array($result))
{
    $chart_data .= "'".$row["point_name"]."':[".$row["Latitude"].", ".$row["longitude"].",".$row['Occurrence'].",".$row['Casualty'].",".$row['dead_count'].",".$row['slanderer'].",".$row['Thin_embroidery'].",".$row['Injured_count'].",".$row['across_100m'].",".$row['bridge'].",".$row['subway'].",".$row['library'].",".$row['market']."], ";
}
//중간 사고데이터
while($row = mysqli_fetch_array($result2))
{
    $chart_data2 .= "'".$row["point_name"]."':[".$row["Latitude"].", ".$row["longitude"].",".$row['Occurrence'].",".$row['Casualty'].",".$row['dead_count'].",".$row['slanderer'].",".$row['Thin_embroidery'].",".$row['Injured_count'].",".$row['across_100m'].",".$row['bridge'].",".$row['subway'].",".$row['library'].",".$row['market']."], ";
}
//약한 사고데이터
while($row = mysqli_fetch_array($result3))
{
    $chart_data3 .= "'".$row["point_name"]."':[".$row["Latitude"].", ".$row["longitude"].",".$row['Occurrence'].",".$row['Casualty'].",".$row['dead_count'].",".$row['slanderer'].",".$row['Thin_embroidery'].",".$row['Injured_count'].",".$row['across_100m'].",".$row['bridge'].",".$row['subway'].",".$row['library'].",".$row['market']."], ";
}

// 횡단보도 데이터
while($row = mysqli_fetch_array($result1))
{
    $chart_data1 .= "'".$row["순번"]."':[".$row["위도"].", ".$row["경도"]."], ";

//    $chart_data1 .= "new naver.maps.LatLng(".$row["위도"].", ".$row["경도"]."), ";
}
// 위험한 사고 데이터
$chart_data = substr($chart_data, 0, -2);
// 횡단보도 데이터
$chart_data1 = substr($chart_data1, 0, -2);
//중간 사고데이터
$chart_data2 = substr($chart_data2, 0, -2);
//약한 사고데이터
$chart_data3 = substr($chart_data3, 0, -2);

//echo $chart_data2;

include 'menu.php';

?>
<div class="header">
    <h1 class="page-header">
        &nbsp; &nbsp; &nbsp; &nbsp; 강서구  &nbsp; &nbsp;<img src="/test/img/icon7.png" alt="My Image">


    </h1>

</div>

<div id="map" style="width:100%;height:400px;"></div>


<script id="code">

    var HOME_PATH = window.HOME_PATH || '.';
    //사고지점좌표위치
    var MARKER_SPRITE_POSITION = {
        <?php echo $chart_data?>
    };
    //신호등좌표위치
    var MARKER_CROSS_POSITION = {
        <?php echo $chart_data1?>
    };
    //네이버지도 초기위치
    var map = new naver.maps.Map('map', {
        //   126.84073 |  37.5416891
        center: new naver.maps.LatLng(37.5416891 , 126.84073),
        zoom: 10,
        mapTypeControl : true

    });




    //맵에서 보이는 영역의 모서리에 대한 위도와 경도
    var bounds = map.getBounds();

    //매우 위험마커와 마커안 넣어줄 데이터
    var markers = [],
        infoWindows = [];

    //위험도중간마커와 마커안에 넣어줄 데이터들
    var markers2 = [],
        infoWindows2 = [];


    //위험도약한마커와 마커안에 넣어줄 데이터들
    var markers3 = [],
        infoWindows3 = [];

    //신호등 위치 마커
    var crosswalkmarkers=[], crossinfoWindows = [];


    //매우 위험 데이터
    for (var key in MARKER_SPRITE_POSITION) {
        // alert("MARKER_SPRITE_POSITION");
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

            },
            zIndex: 100
        });

//마커 정보설정
        var infoWindow = new naver.maps.InfoWindow({
            content: '<div  class="iw_inner"' +
                'style="width:200px; text-align:center;padding:5px;">장소: <b>'+ key +'</b><br>' +
                '<b> 사고 발생 건수 :'+ MARKER_SPRITE_POSITION[key][2] +'</b><br>' +
                '<b> 사상자수 :'+ MARKER_SPRITE_POSITION[key][3] +'<b><br>' +
                '<b> 사망자수 :'+ MARKER_SPRITE_POSITION[key][4] +'</b><br>' +
                '<b> 중상자수 :'+ MARKER_SPRITE_POSITION[key][5] +'</b><br>' +
                '<b> 경상자수 :'+ MARKER_SPRITE_POSITION[key][6] +'</b><br>' +
                '<b> 부상 신고자수 :'+ MARKER_SPRITE_POSITION[key][7] +'</b><br>' +
                '<b> 반경 100m 횡단보도수 :'+ MARKER_SPRITE_POSITION[key][8] +'</b><br>' +
                '<b>반경 100m 육교수 :'+ MARKER_SPRITE_POSITION[key][9] +'</b><br>' +
                '<b>반경 100m 지하철 역수 :'+ MARKER_SPRITE_POSITION[key][10] +'</b><br>' +
                '<b>반경 100m 도서관수 :'+ MARKER_SPRITE_POSITION[key][11] +'</b><br>' +
                '<b>반경 100m 마트수 :'+ MARKER_SPRITE_POSITION[key][12] +'</b><br>' +
                '</div>'      });

//마커배열에 설정한 마커넣기
        markers.push(marker);

        //마커정보에 지정한 정보 넣기
        infoWindows.push(infoWindow);
    };

    //약한위험마커데이터
    var MARKER_LOW_POSITION = {
        <?php echo $chart_data3?>
    };
    //약한위험사고데이터 실제로 마커안에 담기
    for (var key in MARKER_LOW_POSITION) {
        // alert("MARKER_SPRITE_POSITION");
//사고지점마커의 위치
        var position = new naver.maps.LatLng(
            MARKER_LOW_POSITION[key][0],
            MARKER_LOW_POSITION[key][1]);


//중간사고지점 마커 설정
        var marker = new naver.maps.Marker({
            map: map,
            position: position,
            title: key,
            icon: {
                url: '/test/img/icon6.png',
                size: new naver.maps.Size(24, 37),
                //앵커 위치로 이미지 작동
                anchor: new naver.maps.Point(0, 0),
                origin: new naver.maps.Point(0, 0)

            },
            zIndex: 100
        });




//마커 정보설정
        var infoWindow = new naver.maps.InfoWindow({
            content: '<div  class="iw_inner"' +
                'style="width:200px; text-align:center;padding:5px;">장소: <b>'+ key +'</b><br>' +
                '<b> 사고 발생 건수 :'+ MARKER_LOW_POSITION[key][2] +'</b><br>' +
                '<b> 사상자수 :'+ MARKER_LOW_POSITION[key][3] +'<b><br>' +
                '<b> 사망자수 :'+ MARKER_LOW_POSITION[key][4] +'</b><br>' +
                '<b> 중상자수 :'+ MARKER_LOW_POSITION[key][5] +'</b><br>' +
                '<b> 경상자수 :'+ MARKER_LOW_POSITION[key][6] +'</b><br>' +
                '<b> 부상 신고자수 :'+ MARKER_LOW_POSITION[key][7] +'</b><br>' +
                '<b> 반경 100m 횡단보도수 :'+ MARKER_LOW_POSITION[key][8] +'</b><br>' +
                '<b>반경 100m 육교수 :'+ MARKER_LOW_POSITION[key][9] +'</b><br>' +
                '<b>반경 100m 지하철 역수 :'+ MARKER_LOW_POSITION[key][10] +'</b><br>' +
                '<b>반경 100m 도서관수 :'+ MARKER_LOW_POSITION[key][11] +'</b><br>' +
                '<b>반경 100m 마트수 :'+ MARKER_LOW_POSITION[key][12] +'</b><br>' +
                '</div>'             });

//마커배열에 설정한 마커넣기
        markers3.push(marker);

        //마커정보에 지정한 정보 넣기
        infoWindows3.push(infoWindow);
    };


    //위험도 중간좌표위치
    var MARKER_MIDDLE_POSITION = {
        <?php echo $chart_data2?>
    };
    //중간위험사고데이터 실제로 마커안에 담기
    for (var key in MARKER_MIDDLE_POSITION) {
        // alert("MARKER_SPRITE_POSITION");
//사고지점마커의 위치
        var position = new naver.maps.LatLng(
            MARKER_MIDDLE_POSITION[key][0],
            MARKER_MIDDLE_POSITION[key][1]);


//중간사고지점 마커 설정
        var marker = new naver.maps.Marker({
            map: map,
            position: position,
            title: key,
            icon: {
                url: '/test/img/icon5.png',
                size: new naver.maps.Size(24, 37),
                //앵커 위치로 이미지 작동
                anchor: new naver.maps.Point(0, 0),
                origin: new naver.maps.Point(0, 0)

            },
            zIndex: 100
        });




//마커 정보설정
        var infoWindow = new naver.maps.InfoWindow({
            content: '<div  class="iw_inner"' +
                'style="width:200px; text-align:center;padding:5px;">장소: <b>'+ key +'</b><br>' +
                '<b> 사고 발생 건수 :'+ MARKER_MIDDLE_POSITION[key][2] +'</b><br>' +
                '<b> 사상자수 :'+ MARKER_MIDDLE_POSITION[key][3] +'<b><br>' +
                '<b> 사망자수 :'+ MARKER_MIDDLE_POSITION[key][4] +'</b><br>' +
                '<b> 중상자수 :'+ MARKER_MIDDLE_POSITION[key][5] +'</b><br>' +
                '<b> 경상자수 :'+ MARKER_MIDDLE_POSITION[key][6] +'</b><br>' +
                '<b> 부상 신고자수 :'+ MARKER_MIDDLE_POSITION[key][7] +'</b><br>' +
                '<b> 반경 100m 횡단보도수 :'+ MARKER_MIDDLE_POSITION[key][8] +'</b><br>' +
                '<b>반경 100m 육교수 :'+ MARKER_MIDDLE_POSITION[key][9] +'</b><br>' +
                '<b>반경 100m 지하철 역수 :'+ MARKER_MIDDLE_POSITION[key][10] +'</b><br>' +
                '<b>반경 100m 도서관수 :'+ MARKER_MIDDLE_POSITION[key][11] +'</b><br>' +
                '<b>반경 100m 마트수 :'+ MARKER_MIDDLE_POSITION[key][12] +'</b><br>' +
                '</div>'       });

//마커배열에 설정한 마커넣기
        markers2.push(marker);

        //마커정보에 지정한 정보 넣기
        infoWindows2.push(infoWindow);
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

                //
                // url: '/test/img/icon3.png',
                // size: new naver.maps.Size(24, 37),
                // //앵커 위치로 이미지 작동
                // anchor: new naver.maps.Point(0, 0),
                // origin: new naver.maps.Point(0, 0)

            },
            zIndex: 100
        });
//마커 정보설정
        var infoWindow = new naver.maps.InfoWindow({
            content: '<div style="width:150px;text-align:center;padding:10px;">장소: <b>"'+ key.substr(0, 28) +'"</b>.</div>'
        });


        //마커정보에 지정한 정보 넣기
        crossinfoWindows.push(infoWindow);
//신호등마커배열에 설정한 마커넣기
        crosswalkmarkers.push(marker);

    };


    naver.maps.Event.addListener(map, 'idle', function() {

        updateMarkers(map, markers);
        // updatecrossMarkers(map,crosswalkmarkers);
        updateMiddleMarkers(map, markers2);
        updatelowMarkers(map, markers3);
    });

    naver.maps.Event.addListener(map, 'rightclick', function(e) {
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
            //만약 현재 지정된 영역안에 마크가 있는게 확인되면
            if (mapBounds.hasLatLng(position)) {

                showMarker(map, marker);
            } else {
                hideMarker(map, marker);
            }
            //  }
        }



    }

    //중간위험마커 업데이트
    function updateMiddleMarkers(map, markers) {

        var mapBounds = map.getBounds();
        var marker, position;
        var crosswalkmarker,crossposition;

        for (var i = 0; i < markers.length; i++) {
            // for(var i = 0; i < crosswalkmarkers.length; i++){
            marker = markers[i];
            position = marker.getPosition();

            //만약 현재 지정된 영역안에 마크가 있는게 확인되면
            if (mapBounds.hasLatLng(position)) {

                showMiddleMarker(map, marker);
            } else {
                hideMiddleMarker(map, marker);
            }
            //  }
        }



    }

    //중간위험마커 업데이트
    function updatelowMarkers(map, markers) {

        var mapBounds = map.getBounds();
        var marker, position;
        var crosswalkmarker,crossposition;

        for (var i = 0; i < markers.length; i++) {
            // for(var i = 0; i < crosswalkmarkers.length; i++){
            marker = markers[i];
            position = marker.getPosition();

            //만약 현재 지정된 영역안에 마크가 있는게 확인되면
            if (mapBounds.hasLatLng(position)) {

                showlowMarker(map, marker);
            } else {
                hidelowMarker(map, marker);
            }
            //  }
        }



    }
    //횡단보도 마커 지도 영역내 있는 마커만 띄어주기.
    function updatecrossMarkers(map, markers) {

        var marker, position;

        for (var i = 0; i < markers.length; i++) {

            marker = markers[i];
            position = marker.getPosition();



            hideMarker(map, marker);

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


    //보여줄 중간위험마커
    function showMiddleMarker(map, marker) {

        if (marker.setMap()) return;
        marker.setMap(map);
        //
        // if (crosswalkmarker.setMap()) return;
        // crosswalkmarker.setMap(map);
    }

    //숨길 중간위험마커
    function hideMiddleMarker(map, marker) {

        if (!marker.setMap()) return;
        marker.setMap(null);
        // if (!crosswalkmarker.setMap()) return;
        // marker.setMap(null);

    }


    //보여줄 약한위험마커
    function showlowMarker(map, marker) {

        if (marker.setMap()) return;
        marker.setMap(map);
        //
        // if (crosswalkmarker.setMap()) return;
        // crosswalkmarker.setMap(map);
    }

    //숨길 약한위험마커
    function hidelowMarker(map, marker) {

        if (!marker.setMap()) return;
        marker.setMap(null);
        // if (!crosswalkmarker.setMap()) return;
        // marker.setMap(null);

    }

    // 매우 강한 위험마커
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

    // 중간 위험마커
    //마커를 클릭시 해당 마커의 정보를 가져오기 위한 핸들러.
    function getClickMiddleHandler(seq) {
        return function(e) {
            var marker = markers2[seq],
                infoWindow = infoWindows2[seq];

            if (infoWindow.getMap()) {
                infoWindow.close();
            } else {
                infoWindow.open(map, marker);
            }
        }
    }
    for (var i=0, ii=markers2.length; i<ii; i++) {
        naver.maps.Event.addListener(markers2[i], 'click', getClickMiddleHandler(i));
    }


    // 약한 위험마커
    //마커를 클릭시 해당 마커의 정보를 가져오기 위한 핸들러.
    function getClickLowHandler(seq) {
        return function(e) {
            var marker = markers3[seq],
                infoWindow = infoWindows3[seq];

            if (infoWindow.getMap()) {
                infoWindow.close();
            } else {
                infoWindow.open(map, marker);
            }
        }
    }
    for (var i=0, ii=markers3.length; i<ii; i++) {
        naver.maps.Event.addListener(markers3[i], 'click', getClickLowHandler(i));
    }
</script>
</body>
</html>