<?php
//連線資料庫
require_once("../vender/dbtools.inc.php");

//默認時區
date_default_timezone_set('PRC');

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');

?>