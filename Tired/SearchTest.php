<?php

header('Content-Type: text/html; charset=UTF-8');
$connect = mysqli_connect("localhost","root","tkgkdk33","test");
$query = "select * from testcsv2 where n2 not like '%경도%'";
$result = mysqli_query($connect, $query);
//$chart_data = array();
$chart_data = '';

while($row = mysqli_fetch_array($result))
{
    $chart_data .= "new naver.maps.LatLng(".$row["n1"].", ".$row["n2"]."), ";

//    $chart_data[]= array('year'=>$row['region'],'value'=>$row['n5']);

}
//
//
//$logJson = json_encode($chart_data);

$chart_data = substr($chart_data, 0, -2);
//echo $chart_data;
include 'menu.php';


?>

<script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?clientId=0qqfswi6hm&submodules=geocoder"></script>
<div id="map" style="width:100%;height:400px;"></div>


<script id="code">

    var map = new naver.maps.Map("map", {
        center: new naver.maps.LatLng(37.3595316, 127.1052133),
        zoom: 10,
        mapTypeControl: true
    });

    var infoWindow = new naver.maps.InfoWindow({
        anchorSkew: true
    });

    map.setCursor('pointer');

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

</script>
</body>
</html>
