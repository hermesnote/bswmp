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
<title>WMPCCA 後台管理系統 - 登入系統</title>
	
	
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
				<div class="h3 text-info">登入後台</div>
			</div>

	<!-- Login Form -->
			<form name="adminLoginForm" id="adminLoginForm" method="post" action="../model/admin_chkpwd.php">
				<input type="text" id="accountInput" class="fadeIn second" name="accountInput" placeholder="帳號">
				<input type="password" id="pwdInput" class="fadeIn third" name="pwdInput" placeholder="密碼">
				<input type="submit" class="fadeIn fourth" value="登入後台">
			</form>

	<!-- Remind Passowrd -->
			<div id="formFooter">
				<a class="underlineHover" href="#">忘記密碼?</a>
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


</body>
</html>