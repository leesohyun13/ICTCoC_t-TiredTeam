<?php
//지도 마커=>정보 예제 페이지.
header('Content-Type: text/html; charset=UTF-8');
$connect = mysqli_connect("localhost","cho","teamnova","ai");
$query = "select * from accident_data where sigugun_code=1";
$result = mysqli_query($connect, $query);
//$chart_data = array();
$chart_data = '';

// DB서 정보가져오기.
while($row = mysqli_fetch_array($result))
{
     $chart_data .= "new naver.maps.LatLng(".$row["Latitude"].", ".$row["longitude"]."), ";
    //Latitude
    //$chart_data .= "'".$row["point_name"]."':[".$row["Latitude"].", ".$row["longitude"]."], ";


}


$chart_data = substr($chart_data, 0, -2);

include 'menu.php';

//  echo $chart_data;

?>

<div id="map" style="width:100%;height:400px;"></div>


<script id="code">

    //네이버지도 초기위치
    var map = new naver.maps.Map('map', {
        center: new naver.maps.LatLng(37.3595704, 127.105399),
        zoom: 10,
        mapTypeControl: true
    });

    var address= '불정로 6';
    function searchAddressToCoordinate(address) {
        naver.maps.Service.geocode({
            address: '불정로 6'
        }, function(status, response) {
            if (status !== naver.maps.Service.Status.OK) {
                return alert('Something wrong!');
            }

            var result = response.result, // 검색 결과의 컨테이너
                items = result.items; // 검색 결과의 배열

            // do Something
        });
    }

    //맵에서 보이는 영역의 모서리에 대한 위도와 경도
    var bounds = map.getBounds();

    //마커와 마커안에 넣어줄 데이터들
    var markers = [],
        infoWindows = [];

    var datas = [
        <?php echo $chart_data?>
    ];



        var dotmap = new naver.maps.visualization.DotMap({
            map: map,
            data: datas
        });

    //
    // var dotmap = new naver.maps.visualization.DotMap({
    //     map: map,
    //     data: data
    // });
</script>
</body>
</html>