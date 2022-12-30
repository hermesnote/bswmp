<?php
header("Content-Type:text/html; charset=utf-8");

//清除session
session_start();
session_destroy();
//清除cookie
setcookie("loginCompet", "", time()+6000, "/" ,"wmpcca.com");
//導回登入頁
header("Location:https://wmpcca.com/bswmp/form/view/compet_index.php");
?>