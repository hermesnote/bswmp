<?php
//連結資料庫
require_once("../vender/dbtools.inc.php");

//取得現在日期時間
$getToday = date("Y-m-d H:i:s");

//COOKIE陣列解序
$loginInfo = unserialize($_COOKIE["loginCompet"]);

//取得COOKIE內容
$teamDB = $loginInfo[0];
$memberDB = $loginInfo[1];
$teamNO = $loginInfo[2];
$teamName = $loginInfo[3];
$projectNO = $loginInfo[4];
$projectName = $loginInfo[5];
$competInfo = $loginInfo[6];
$passed = $loginInfo[7];


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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.js"></script>
<meta charset="utf-8">
<title>WMPCCA 初賽報告上傳</title>

<style>
#uploader {
  border: 16px solid #f3f3f3; /* Light grey */
  border-top: 16px solid #3498db; /* Blue */
  border-radius: 50%;
  width: 120px;
  height: 120px;
  animation: spin 2s linear infinite;
  margin-top:18%;
  margin-left: 45%;
  position: absolute;
  z-index: 10;
  background-color: white;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
#uploadbg {
	width:100%;
	height: 100%;
	background-color: white;
	background-position: center;
	background-size: cover;
	background-attachment: fixed;
	text-align: center;
	position: fixed;
	background-repeat: no-repeat;
	z-index: 9;
}
</style>
	
</head>

<body>
<?php require_once("../model/waitload.php") ?>
<?php require_once("../model/cc_imgGroup_Modal.php") ?>
<?php require_once("../model/index_nav.php") ?>

<!-- Show Uploading -->
<div id="uploadbg">
	<div id="uploader"></div>
</div>

<div class="container-fluid">
		
	<div class="wrapper fadeInDown my-5">
		<div id="formContent">
<!-- Tabs Titles -->

	<!-- Icon -->
			<div class="fadeIn first">
				<img src="../img/Favicon/180x180.png" id="icon" alt=""><br>
				<div class="h5 text-info"><?php echo $projectName; ?></div>
				<div class="h3 text-info">初賽報告上傳</div>
			</div>

	<!-- Login Form -->
    <form action="https://script.google.com/macros/s/AKfycbwOi2MA50kPOaOoahpnEm5nPHFuJA2bfxNXQh5ZXASoC_YlFaU5itFh-_nIYUBnw2Tn/exec" id="form" method="post">
        <div id="data"></div>
        <input name="file" id="uploadfile" type="file" class="mt-3">
        <input id="submit" type="submit" value="上 傳 檔 案" class="mt-3" style="font-size: 22px;" onClick="showUploading()">
		<small class="form-text text-muted mx-auto text-center">※ 一次限上傳一份檔案，到期日前可重新上傳</small>
		<small class="form-text text-danger mx-auto text-center pb-3">※ 檔案愈大所須上傳時間愈久，建議不超過15MB</small>
    </form>
			
<!-- hidden teamNO -->
<input type="hidden" name="teamNO" id="teamNO" Value="<? echo $teamNO; ?>">

<script>
$("#uploadbg").hide();
$('#uploadfile').on("change", function() {
	var file = this.files[0];
	var fr = new FileReader();
	var teamNO = $("#teamNO").val();
	fr.fileName = teamNO+'-01';
	fr.onload = function(e) {
		e.target.result
		html = '<input type="hidden" name="data" value="' + e.target.result.replace(/^.*,/, '') + '" >';
		html += '<input type="hidden" name="mimetype" value="' + e.target.result.match(/^.*(?=;)/)[0] + '" >';
		html += '<input type="hidden" name="filename" value="' + e.target.fileName + '" >';
		$("#data").empty().append(html);
	}
	fr.readAsDataURL(file);
});

</script>

<script>
	function showUploading(){
		$("#uploadbg").show();
		$.ajax({

			url:"https://wmpcca.com/bswmp/form/model/compet_Uploading.php",
			data:{},

			method : "POST",

			error : function(msg){
				
			},

			success : function(msg){
				
				}
		});
		
	}
</script>		

			
			
		</div>
	</div>
</div>


<?php require_once("../model/index_footer.php") ?>

<?php require_once("../model/index_js.php") ?>
<script type="text/javascript" src="../controller/waitload.js"></script>
<script type="text/javascript" src="../controller/index_nav.js"></script>
<script type="text/javascript" src="../controller/toggle_tooltip.js"></script>
<script type="text/javascript" src="../controller/cc_imgGroup_Option1.js"></script>

</body>
</html>