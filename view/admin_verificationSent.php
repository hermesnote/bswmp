<?php
require_once ("../vender/dbtools.inc.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

date_default_timezone_set('Asia/Taipei');
//取得註冊資訊
$arrival = $_POST["arrival"];
$postTitle = $_POST["postTitle"];
$staffName = $_POST["staffName"];
$identifyNO = $_POST["identifyNO"];
	//身份證字號檢核是否註冊
	$sqlSELECTidentifyNO = "SELECT * FROM staffList WHERE identifyNO = '$identfyNO' ";
	$sqlRESULTidentifyNO = mysql_query($sqlSELECTidentifyNO, $sqlLink);
	$sqlNUMROWSidentifyNO = mysql_num_rows($sqlRESULTidentifyNO);
		if ($sqlNUMROWSidentifyNO != 0){
		echo"<script type='text/javascript'>";
		echo "alert('此身份證ID已被註冊');";
		echo "history.back();";
		echo "</script>";
		}


$staffSex = $_POST["staffSex"];
$staffBirth = $_POST["staffBirth"];
$staffLineID = $_POST["staffLineID"];
$staffDegree = $_POST["staffDegree"];
$staffPhone = $_POST["staffPhone"];
$staffEmail = $_POST["staffEmail"];
$staffCity = $_POST["staffCity"];
$staffDistrict = substr($_POST["staffDistrict"], 4);
$staffZipcode = substr($_POST["staffDistrict"], 0, 3);
$staffAddr0 = $_POST["staffAddr"];
$staffAddr = $staffZipcode.$staffCity.$staffDistrict.$staffAddr0;
$account = $_POST["account"];
$pwd = $_POST["pwd"];
$pwd2 = $_POST["pwd2"];
//產生員工編號
$staffNOFirst = 'MS001';
$staffNOadd1 = '1';
	//查詢MS001是否存在
	$sqlSELECTstaffNO1 = "SELECT * FROM staffList WHERE staffNO = '$staffNOFirst'";
	$sqlRESULTstaffNO1 = mysql_query($sqlSELECTstaffNO1, $sqlLink);
	$sqlstaffNOFirstNUMS = mysql_num_rows($sqlRESULTstaffNO1);

	//取得最近一筆員工編號末3碼 並加1
	$sqlSELECTstaffNO = "SELECT staffNO FROM staffList ORDER BY id DESC";
	$sqlRESULTstaffNO = mysql_query($sqlSELECTstaffNO, $sqlLink);
	$sqlFETCHstaffNO = mysql_fetch_row($sqlRESULTstaffNO);
	$sqlstaffNOLast = $sqlFETCHstaffNO[0];
	$sqlstaffNOLastNUMs = substr($sqlstaffNOLast, -3);
	$sqlstaffNOLastNUMsAdd1 = $sqlstaffNOLastNUMs+$staffNOadd1;
	$sqlstaffNOnew = str_pad($sqlstaffNOLastNUMsAdd1, 3, "0", STR_PAD_LEFT);

	//如果MS001不存在則作為員工編號, 否則以最近一筆+1
	if ($sqlstaffNOFirstNUMS != 0){
		$staffNO = 'MS'.$sqlstaffNOnew;
	}else{
		$staffNO = $staffNOFirst;
	}

//登入帳號為員編
if ($account == 0){
	$account = $staffNO;
}
//登入帳號為ID
if ($account == 1){
	$account = $identifyNO;
}
//登入帳號為Email
if ($account == 2){
	$account = $staffEmail;
}

//產生驗證碼
$str="QWERTYUIOPASDFGHJKLZXCVBNM1234567890qwertyuiopasdfghjklzxcvbnm";
str_shuffle($str);
$verification = substr(str_shuffle($str), 26, 8);

//資料入庫
$sqlINSERTstaffList = "INSERT IGNORE INTO staffList ( arrival, staffNO, postType, postTitle, identifyNO, staffName, staffSex, staffBirth, staffPhone, staffEmail, staffAddr, staffLineID, staffDegree, account, password, verification  ) VALUES ( '$arrival', '$staffNO', '2', '$postTitle', '$identifyNO', '$staffName', '$staffSex', '$staffBirth', '$staffPhone', '$staffEmail', '$staffAddr', '$staffLineID', '$staffDegree', '$account', '$pwd', '$verification' ) ";
$result = mysql_query($sqlINSERTstaffList, $sqlLink);



	//寄發帳號開通驗證碼Email
	require '../ecPay/Exception.php';
	require '../ecPay/PHPMailer.php';
	require '../ecPay/SMTP.php';

	$mail = new PHPMailer(true);

	// 設定為 SMTP 方式寄信
	$mail->IsSMTP();

	//設定為HTML
	$mail->isHTML();

	// SMTP 伺服器的設定，以及驗證資訊
	$mail->SMTPAuth = true;      
	$mail->Host = "wmpcca.com"; //請填您有指過到大朵主機的網址名稱
	$mail->Port = 25; //大朵主機的郵件伺服器port為 25 
	$mail->SMTPAuth = false;
	$mail->SMTPSecure = false;

	// 信件內容的編碼方式       
	$mail->CharSet = "utf-8";

	// 信件處理的編碼方式
	$mail->Encoding = "base64";

	// SMTP 驗證的使用者資訊
	$mail->Username = "service@wmpcca.com";  //在cpanel新增mail的帳號（需要完整的mail帳號，含@後都要填寫）
	$mail->Password = "Since2018";  //在cpanel新增mail帳號時設定的密碼，請小心是否有空格，空格也算一碼。

	//設定Mail共用參數


	//寄發開通碼通知Email
	require_once("../model/admin_accountVerificationMail.php");	
	mysqli_close($sqlLink);
?>

<!doctype html>
<html>
<head>
<?php require_once("../model/index_rel.php") ?>

<link rel=stylesheet type="text/css" href="../css/body_global.css">
<link rel=stylesheet type="text/css" href="../css/navbar.css">
<link rel=stylesheet type="text/css" href="../css/index_footer.css">
<link rel=stylesheet type="text/css" href="../css/waitload.css">
<link rel=stylesheet type="text/css" href="../css/cc_imgGroup_ModalScrollBar.css">
<link rel=stylesheet type="text/css" href="../css/admin_verification.css">


<meta charset="utf-8">
<title>WMPCCA 後台管理系統 - 驗證碼已寄送</title>
	

	
</head>

<body>
<?php require_once("../model/waitload.php") ?>
<?php require_once("../model/cc_imgGroup_Modal.php") ?>
<?php require_once("../model/index_nav.php") ?>
	
	
<div class="container-fluid">
	<div class="wrapper fadeInDown my-5">
		<div id="formContent">
<!-- Tabs Titles -->

	<!-- Icon -->
			<div class="fadeIn first">
				<img src="../img/Favicon/180x180.png" id="icon" alt=""><br>
				<div class="h4 text-info">※驗證碼已寄發至以下信箱</div><br>
				<div class="h4 text-warning"><?php echo $staffEmail; ?></div><br>
			</div>

	<!-- Login Form -->
			<form name="verificationForm" id="verificationForm" method="post" action="admin_accountVerification.php">
				<input type="submit" class="fadeIn fourth h3" value="前往開通帳號">
			</form>

	<!-- Remind Passowrd -->
			<div id="formFooter">
				<a class="underlineHover" href="">沒有收到驗證碼?(無用)</a>
			</div>

		</div>
	</div>
</div>

<?php require_once("../model/index_footer.php") ?>

<?php require_once("../model/index_js.php") ?>
<script type="text/javascript" src="../controller/waitload.js"></script>
<script type="text/javascript" src="../controller/index_nav.js"></script>
<script type="text/javascript" src="../controller/toggle_tooltip.js"></script>
<script type="text/javascript" src="../controller/datepicker.js"></script>
<script type="text/javascript" src="../controller/zipcode.js"></script>
<script type="text/javascript" src="../controller/cc_imgGroup_Option1.js"></script>


</body>
</html>