<?php

header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Asia/Taipei');

//建立資料庫連線
$sqlLink = mysql_connect("localhost", "hermesn1_wmpcca", "Since2018");
mysql_select_db("hermesn1_wmpccaBackEnd", $sqlLink);
mysql_query("SET NAMES 'UTF8'");

?>