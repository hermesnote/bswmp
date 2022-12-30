<?php
header("Content-Type:text/html; charset=utf-8");

//清除session
session_start();
session_destroy();
//清除cookie
setcookie("account", "", time()-3000, "/" ,"wmpcca.com");
setcookie("passed", "", time()-3000, "/" ,"wmpcca.com");
//導回登入頁
header("Location:https://wmpcca.com/bswmp/form/view/admin_login.php");
?>