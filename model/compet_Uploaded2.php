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
<title>WMPCCA - 上傳完成</title>

<style>

</style>
	
</head>

<body>
<?php require_once("../model/waitload.php") ?>
<?php require_once("../model/cc_imgGroup_Modal.php") ?>
<?php require_once("../model/index_nav.php") ?>


<div class="container-fluid">
	<div class="wrapper fadeInDown my-5">
		<div id="formContent">

			<div class="fadeIn first">
				<img src="../img/Favicon/180x180.png" id="icon" alt=""><br>
					<div class="h3 text-info">上傳完成</div>
						<small class="form-text text-muted mx-auto text-center py-3">※ 請關閉此分頁，回到競賽專區(F5)更新競賽資訊</small>
						<small class="form-text text-danger mx-auto text-center py-3">※ 如因網路因素造成競賽專區上傳資訊未能更新，請重新操作上傳檔案！</small>
			</div>

		</div>
	</div>
</div>

<?php require_once("../model/index_footer.php") ?>

<?php require_once("../model/index_js.php") ?>
<script type="text/javascript" src="../controller/waitload.js"></script>
<script type="text/javascript" src="../controller/index_nav.js"></script>
<script type="text/javascript" src="../controller/toggle_tooltip.js"></script>
<script type="text/javascript" src="../controller/cc_imgGroup_Option1.js"></script>
	
<!-- close Window -->
<script>
	function closeWindow(){
		window.open('', '_self', ''); window.close();
	}
</script>

</body>
</html>