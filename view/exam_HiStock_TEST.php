<?php
//連線資料庫
require_once("../vender/dbtools.inc.php");

//默認時區
date_default_timezone_set('PRC');

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
	<div class="row pl-5">
	</div>
</section>
	
<!-- 競賽規則 -->
<section class="examImport">
	<div class="container-fluid">
		<div class="row text-center">
			
		</div>
	</div>
</section>

<section class="examImport">
<div class="container-fluid">
	<div class="row">
		<div class="col text-center h3">
			<button class="btn btn-lg btn-outline-secondary" id="goMockButton" onClick="goMock()">線上模擬測驗</button>
		</div>
	</div>
</div>
</section>		

	



<?php require_once("../model/index_js.php") ?>

<!-- 自定義 Javascript -->
<script>
	function goMock(){
		window.open("https://wmpcca.com/bswmp/form/view/exam_HiStock_Exam_Start.php","線上模擬測驗","fullscreen=yes,status=yes,toolbar=yes,menubar=yes,location=yes");
//		window.moveTo(0,0);
//		window.resizeTo(screen.width,screen.height);
}
</script>
	
	
</body>
</html>