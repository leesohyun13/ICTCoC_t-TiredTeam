<?php
//지도 마커=>정보 예제 페이지.
header('Content-Type: text/html; charset=UTF-8');
$connect = mysqli_connect("localhost","cho","teamnova","ai");
$query = "select * from accident_data where sigugun_code=1";
$result = mysqli_query($connect, $query);
//$chart_data = array();
//사고데이터
$chart_data = '';



include 'menu.php';

?>


<div id="map" style="width:100%;height:400px;"></div>


<script id="code">

    var map = new naver.maps.Map('map', {
        center: new naver.maps.LatLng(37.517436, 127.047418),
        zoom: 12
    });

</script>
</body>
</html>