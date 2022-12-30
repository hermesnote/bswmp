<?php
//連線資料庫
require_once("../vender/dbtools.inc.php");

//默認時區
date_default_timezone_set('PRC');

//取得現在日期時間
$getToday = date("Y-m-d H:i:s");

//取得COOKIE陣列並解序還原
$loginInfo = unserialize($_COOKIE["loginInfo"]);
$examNO = $loginInfo[0];	//帳號
$pwd = $loginInfo[1];	//驗證碼
$host = $loginInfo[2];	//公關招待
$projectNO = $loginInfo[3];	//活動代號
$projectName = '第'.substr($projectNO, 2, 5).'梯'.' '.$loginInfo[4];	//活動名稱
$fee = $loginInfo[5];	//報名費
$start = $loginInfo[6];	//開始報名
$end = $loginInfo[7];	//截止報名
$bach = $loginInfo[8];	//測驗梯次
$bachTimeAdd = $loginInfo[9]*60*60;	//測驗時間
$bachTimeAdded = strtotime($bach)+$bachTimeAdd;	//測驗結束時間
$finalCompet = $loginInfo[10]; // 決賽時間
$passed = $loginInfo[11];	//帳密符合

//COOKIE登入錯誤
if ($passed != "TRUE"){
echo "<script type='text/javascript'>";
echo "alert('COOKIE逾時或錯誤！請重新登入！');";
echo "window.location.href='histock_index.php';";
echo "</script>";
exit();
}

?>



<!doctype html>

<html>
<head>
<?php require_once("../model/index_rel.php") ?>
<link rel=stylesheet type="text/css" href="../css/body_global.css">

<meta charset="utf-8">

<title>模擬測驗入口</title>

<style>
/* section頭尾距 */
.examHeadline{
	background-color: navy;
	color: white;
	font-size: 16px;
	text-align: left;
}
.examTitle{
	padding-top: 50px;
	padding-bottom: 50px;
	background-color: silver;
}
	
.examImport{
	padding-top: 150px;
	padding-bottom: 150px;
	background-color: white;
}

/* 左右邊框線 */
.br-1{
	border-right:1px #E0E0E0 solid;
}

.bl-1{
	border-left:1px #E0E0E0 solid;
}	


</style>
	
</head>

<body>

<!-- Headline -->
<section class="examHeadline">
	<div class="container-fluid">
		<div class="row pl-5">
			歡迎使用 台灣財富管理規劃顧問認證協會 - 【金融與證券投資實務競賽】線上模擬測驗系統
		</div>
	</div>
</section>
	
<!-- 競賽規則 -->
<section class="examTitle">
	<div class="container-fluid">
		<div class="row text-center">
<!--			解說...圖例...BalaBala...-->
		</div>
	</div>
</section>

<section class="examImport">
<div class="container-fluid">
	<div class="row">
		<div class="col text-center">
			<button class="btn btn-lg btn-secondary mt-5 px-5 py-3" onClick="startExam()">開始測驗</button>
		</div>
	</div>	
</div>
</section>		

	



<?php require_once("../model/index_js.php") ?>

<!-- 自定義 Javascript -->

<!-- 開始模擬測驗 -->
<script>
	function startExam(){
		window.location.href = "https://wmpcca.com/bswmp/form/model/exam_HiStock_Exam_getPapper.php";
	}
</script>
	
	
</body>
</html>