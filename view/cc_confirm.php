<!-- 載入資料庫連線PHP程式 -->
<?php require_once("../vender/dbtools.inc.php") ?>
<!-- eventCode檢核PHP程式 -->
<?php require_once("../model/chk_cc_eventCode.php") ?>
<!-- 取得表單資訊PHP程式 -->
<?php require_once("../model/cc_getForm.php") ?>
<!-- 隊名及隊伍成員檢核PHP程式 -->
<?php require_once("../model/chk_signupForm.php") ?>
<!doctype html>

<html>
<head>
<!-- 載入必要外部CSS -->
<?php require_once("../model/index_rel.php") ?>

<!-- 載入自定義CSS -->
<link rel=stylesheet type="text/css" href="../css/body_global.css">
<link rel=stylesheet type="text/css" href="../css/navbar.css">
<link rel=stylesheet type="text/css" href="../css/index_footer.css">
<link rel=stylesheet type="text/css" href="../css/waitload.css">


<meta charset="utf-8">
<title>歡迎光臨 台灣財富管理規劃顧問認證協會</title>
</head>

<body>
<!-- 頁面載入等待 -->
<?php require_once("../model/waitload.php") ?>
<!-- 頂部導覽列 -->
<?php require_once("../model/index_nav.php") ?>
<?php require_once("../model/cc_imgGroup_Modal.php") ?>
<!-- 頁首背景圖 -->
<?php require_once("../model/cc_bgimg.php") ?>


<!-- 顯示取得的報名表單資訊 -->
<?php require_once("../model/cc_signupInfo.php") ?>
<!-- 準備傳送的報名表單資料 -->
<?php require_once("../model/cc_postForm.php") ?>


<!-- 首面框架Footer -->
<?php require_once("../model/index_footer.php") ?>

<!-- 載入index js -->
<?php require_once("../model/index_js.php") ?>

<script type="text/javascript" src="../controller/waitload.js"></script>
<script type="text/javascript" src="../controller/index_nav.js"></script>
<script type="text/javascript" src="../controller/toggle_tooltip.js"></script>
<script type="text/javascript" src="../controller/cc_teamMansCounter.js"></script>
<script>
	function confirmPay(){
		var ans = confirm('系統將前往綠界科技金流系統(開新視窗)！請確認各項「報名資料」及「繳費金額」正確無誤！經金流繳費單成立後請儘快繳費以完成報名！)')
		if (ans){
			$("#dropSignupButton").css("display","none");
			ccPostForm.submit();
			}
	}
	function printPage()
  {
  window.print()
  }
</script>
</body>
</html>