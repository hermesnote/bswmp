<?php require_once("../model/cc_getForm2.php") ?>
<?php require_once("../model/db_cc_SignupInsert.php") ?>
<?php 
//重定向瀏覽器 
header("Location: https://wmpcca.com/bswmp/form/ecPay/All_CreateOrder.php"); 
//確保重定向後，後續代碼不會被執行 
exit();
?>