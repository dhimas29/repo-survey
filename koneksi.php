<?php
$hostName	= "localhost";
$userName	= "root";
$passWord	= "";
$database	= "survey";

//$masuk = ($hostName,$userName,$passWord) or die('Connection Failed');
$hore = mysqli_connect($hostName,$userName,$passWord,$database) or die('Database Failed');
?>