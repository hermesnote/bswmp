<?php
//連線資料庫
require_once("../vender/dbtools.inc.php");

//默認時區
date_default_timezone_set('PRC');

// 

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
			歡迎使用【金融證券實務】線上模擬測驗系統...
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
			<button class="btn btn-lg btn-secondary mt-5 px-5 py-3" onClick="startMock()">開始測驗</button>
		</div>
	</div>	
</div>
</section>		

	



<?php require_once("../model/index_js.php") ?>

<!-- 自定義 Javascript -->

<!-- 開始模擬測驗 -->
<script>
	function startMock(){
		window.location.href = "https://wmpcca.com/bswmp/form/model/exam_HiStock_Mock_getCookie.php";
	}
</script>
	
	
</body>
</html>