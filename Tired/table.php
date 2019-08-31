<?php

header('Content-Type: text/html; charset=UTF-8');
$connect = mysqli_connect("localhost","cho","teamnova","ai");

$query = "select * from accident_data where sigugun_code=1 and state_code=1;";
$result = mysqli_query($connect, $query);
//$chart_data = array();
$chart_data = '';
while($row = mysqli_fetch_array($result))
{
    //n2:노인 부상자수 n3:노인보행자 사망자수
    $chart_data .= "{ label:'".$row["region"]."', n2:".$row["n2"].", n3:".$row["n3"]."} ,";

    //$chart_data[]= array('year'=>$row['region'],'value'=>$row['n5']);

}
//
//$logJson = json_encode($chart_data);
//echo $logJson;
$chart_data = substr($chart_data, 0, -2);
echo $chart_data;
include 'menu.php';


?>

<h1>서울 구별 횡단보도수</h1>
<div id="morrisChart" ></div>
<h1>서울 구별 총사고수</h1>

<div id="morrisDonut" ></div>
<div id="area-chart" ></div>
<div id="bar-chart" ></div>
<div id="stacked" ></div>

<!-- /. WRAPPER  -->
<!-- JS Scripts-->
<!-- jQuery Js -->


<script src="assets/js/jquery-1.10.2.js"></script>
<!-- Bootstrap Js -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- Metis Menu Js -->
<script src="assets/js/jquery.metisMenu.js"></script>
<!-- Morris Chart Js -->
<script src="assets/js/morris/raphael-2.1.0.min.js"></script>
<script src="assets/js/morris/morris.js"></script>
<!-- Custom Js -->
<script src="assets/js/custom-scripts.js"></script>

<script>

//선차트는 한글 없이 써야 잘나옴.
    new Morris.Bar({
        element: 'morrisChart',
        data:[<?php echo $chart_data?>],
        xkey: 'label',
        ykeys:['n2','n3'],
        labels:['노인부상자수','노인 사망자수'],
        hideHover:'auto',
        pointFillColors:['#ffffff'],
       
    });

    //new Morris.Line({
    //    element: 'morrisChart',
    //    data:[<?php //echo $chart_data?>//],
    //    xkey: 'label',
    //    ykeys: ['n2','n3'],
    //    labels: ['n3']
    //
    //});
    /* <![CDATA[ */
    // var data = [
    //         { y: '2014', a: 50, b: 90},
    //         { y: '2015', a: 65,  b: 75},
    //         { y: '2016', a: 50,  b: 50},
    //         { y: '2017', a: 75,  b: 60},
    //         { y: '2018', a: 80,  b: 65},
    //         { y: '2019', a: 90,  b: 70},
    //         { y: '2020', a: 100, b: 75},
    //         { y: '2021', a: 115, b: 75},
    //         { y: '2022', a: 120, b: 85},
    //         { y: '2023', a: 145, b: 85},
    //         { y: '2024', a: 160, b: 95}
    //     ],
    alert("0");
    //var config = {
    //        data: [<?php //echo $chart_data?>//],
    //        xkey: 'label',
    //        ykeys: ['n2', 'n3'],
    //        labels: ['Total Income', 'Total Outcome'],
    //        fillOpacity: 0.6,
    //        hideHover: 'auto',
    //        behaveLikeLine: true,
    //        resize: true,
    //        pointFillColors:['#ffffff'],
    //        pointStrokeColors: ['black'],
    //        lineColors:['gray','red']
    //    };
    //alert("1");
    //
    //config.element = 'morrisChart';
    //Morris.Line(config)

    //new Morris.Donut({
    //    element: 'morrisDonut',
    //    data:[<?php //echo $chart_data?>//]
    //});




    /* ]]> */
</script>

<!-- script -->




</body>
</html>

