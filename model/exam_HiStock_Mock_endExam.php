<?php
//連線資料庫
require_once("../vender/dbtools.inc.php");

//默認時區
date_default_timezone_set('PRC');

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');

//參數
$done = "done";

//刪除cookie
setcookie("number", "", time()-3600, "/" ,"wmpcca.com");
setcookie("answer", "", time()-3600, "/" ,"wmpcca.com");
setcookie("AQ", "", time()-3600, "/" ,"wmpcca.com");
setcookie("AT", "", time()-3600, "/" ,"wmpcca.com");

//回傳
echo json_encode($done);
exit();

?>