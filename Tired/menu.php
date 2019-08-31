<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bootstrap Admin Template : Bluebox</title>
    <!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Morris Chart Styles-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

<!--    //지도-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=0qqfswi6hm"></script>
    <script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?clientId=0qqfswi6hm&submodules=drawing"></script>
    <script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?clientId=0qqfswi6hm&submodules=visualization"></script>
</head>
<body style="font-size: 14px">
<div id="wrapper">
    <!-- 상단 -->
    <nav class="navbar navbar-default top-navbar" role="navigation">





    </nav>
    <!--/. NAV TOP  -->
    <!-- 사이드바 -->
    <nav class="navbar-default navbar-side" role="navigation" style="overflow: auto; height: 800px; top: 40px;" >
        <div class="sidebar-collapse">
            <ul class="nav" id="main-menu" >

                <!-- 멀티드롭다운 -->
                <li>
                    <a href="#" style="padding-top: 25px;"><i class="fa fa-sitemap"></i> 서울시<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level"  >
                        <li>
                            <a style="padding: 2px 20px" href="gangnamgu.php"  >강남구</a>
                            <!--// 클릭 했을 때 지도 이동 -->
                        </li>

                        <li>
                            <a style="padding: 2px 20px" href="gangdong.php" >강동구</a>
                            <!--// 클릭 했을 때 지도 이동 -->
                        </li>
                        <li>
                            <a style="padding: 2px 20px"  href="gangbuk.php" >강북구</a>
                            <!--// 클릭 했을 때 지도 이동 -->
                        </li>
                        <li>
                            <a  style="padding: 2px 20px"  href="gangsu.php" >강서구</a>
                            <!--// 클릭 했을 때 지도 이동 -->
                        </li>
                        <li>
                            <a style="padding: 2px 20px"  href="gwanak.php"  >관악구</a>
                            <!--// 클릭 했을 때 지도 이동 -->
                        </li>
                        <li>
                            <a style="padding: 2px 20px" href="gwanggin.php" >광진구</a>
                            <!--// 클릭 했을 때 지도 이동 -->
                        </li>
                        <li>
                            <a style="padding: 2px 20px"  href="guro.php" >구로구</a>
                            <!--// 클릭 했을 때 지도 이동 -->
                        </li>
                        <li>
                            <a style="padding: 2px 20px"  href="gmchun.php" >금천구</a>
                            <!--// 클릭 했을 때 지도 이동 -->
                        </li>
                        <li>
                            <a style="padding: 2px 20px"  href="nowon.php" >노원구</a>
                            <!--// 클릭 했을 때 지도 이동 -->
                        </li>
                        <li>
                            <a style="padding: 2px 20px" href="dobong.php"  >도봉구</a>
                            <!--// 클릭 했을 때 지도 이동 -->
                        </li>
                        <li>
                            <a style="padding: 2px 20px"  href="dongdaemoon.php"  >동대문구</a>
                            <!--// 클릭 했을 때 지도 이동 -->
                        </li>
                        <li>
                            <a style="padding: 2px 20px" href="dongjak.php"  >동작구</a>
                            <!--// 클릭 했을 때 지도 이동 -->
                        </li>
                        <li>
                            <a style="padding: 2px 20px"  href="mapo.php"   >마포구</a>
                            <!--// 클릭 했을 때 지도 이동 -->
                        </li>  <li>
                            <a style="padding: 2px 20px"  href="seodaemoon.php" >서대문구</a>
                            <!--// 클릭 했을 때 지도 이동 -->
                        </li>
                        <li>
                            <a style="padding: 2px 20px"  href="seocho.php"  >서초구</a>
                            <!--// 클릭 했을 때 지도 이동 -->
                        </li>  <li>
                            <a style="padding: 2px 20px" href="sungdong.php"  >성동구</a>
                            <!--// 클릭 했을 때 지도 이동 -->
                        </li>
                        <li>
                            <a style="padding: 2px 20px"  href="sungbook.php"   >성북구</a>
                            <!--// 클릭 했을 때 지도 이동 -->
                        </li>  <li>
                            <a style="padding: 2px 20px"  href="songpa.php" >송파구</a>
                            <!--// 클릭 했을 때 지도 이동 -->
                        </li>
                        <li>
                            <a style="padding: 2px 20px"  href="yangchun.php"  >양천구</a>
                            <!--// 클릭 했을 때 지도 이동 -->
                        </li>
                        <li>
                            <a style="padding: 2px 20px"  href="youngdngpo.php"  >영등포구</a>
                            <!--// 클릭 했을 때 지도 이동 -->
                        </li>
                        <li>
                            <a style="padding: 2px 20px"  href="youngsan.php" >용산구</a>
                            <!--// 클릭 했을 때 지도 이동 -->
                        </li>
                        <li>
                            <a style="padding: 2px 20px"  href="eungpyung.php"  >은평구</a>
                            <!--// 클릭 했을 때 지도 이동 -->
                        </li>
                        <li>
                            <a style="padding: 2px 20px"  href="jongro.php"  >종로구</a>
                            <!--// 클릭 했을 때 지도 이동 -->
                        </li>
                        <li>
                            <a style="padding: 2px 20px" href="joong.php"  >중구</a>
                            <!--// 클릭 했을 때 지도 이동 -->
                        </li>
                        <li>
                            <a style="padding: 2px 20px"  href="joongrang.php"  >중랑구</a>
                            <!--// 클릭 했을 때 지도 이동 -->
                        </li>



                    </ul>

                </li>
                <!-- 멀티드롭다운 끝 -->
                <!-- 멀티드롭다운 -->
                <li>
                    <a href="#"><i class="fa fa-sitemap"></i> 차트<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="#">데이터</a>
                        </li>
                    </ul>
                </li>
                <!-- 멀티드롭다운 끝 -->
                <!-- <li>
                    <a href="form.html"><i class="fa fa-edit"></i> Forms </a>
                </li> -->


                <!-- <li>
                    <a href="empty.html"><i class="fa fa-fw fa-file"></i> Empty Page</a>
                </li> -->
            </ul>

        </div>

    </nav>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script src="assets/js/custom-scripts.js"></script>
    <!-- /. NAV SIDE  -->
    <!-- 페이지내의 헤더 -->
    <div id="page-wrapper">