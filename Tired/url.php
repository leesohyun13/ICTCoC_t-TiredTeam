<?php
$http_host = $_SERVER['HTTP_HOST'];
$request_uri = $_SERVER['REQUEST_URI'];
$url = 'http://' . $http_host . $request_uri;
?>
<div>HTTP_HOST: <?= $http_host ?></div>
<div>REQUEST_URI: <?= $request_uri ?></div>
<div>URL: <?= $url ?></div>