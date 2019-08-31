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
    // $chart_data .= "new naver.maps.LatLng(".$row["n1"].", ".$row["n2"]."), ";
    //Latitude
    $chart_data .= "'".$row["point_name"]."':[".$row["Latitude"].", ".$row["longitude"]."], ";


}


$chart_data = substr($chart_data, 0, -2);

include 'menu.php';

//  echo $chart_data;

?>

<div id="map" style="width:100%;height:400px;"></div>


<script id="code">


    var HOME_PATH = window.HOME_PATH || '.';
var position = new naver.maps.LatLng(37.3849483, 127.1229117);

var map = new naver.maps.Map('map', {
center: position,
zoom: 14
});

var markerOptions = {
position: position.destinationPoint(90, 15),
map: map,
icon: {
    url:  ' /test/img/icon2.png',
    size: new naver.maps.Size(25, 34),
    scaledSize: new naver.maps.Size(25, 34),
origin: new naver.maps.Point(0, 0),
anchor: new naver.maps.Point(25, 26),
}
};

var marker = new naver.maps.Marker(markerOptions);
</script>
</body>
</html>