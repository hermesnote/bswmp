<?php
require_once ("../vender/dbtools.inc.php");

$passed = $_COOKIE["passed"];
$account = $_COOKIE["account"];
$staffNO = $_COOKIE["staffNO"];
// 若cookie中的變數passed不為TRUE，則導回登入頁
if ($passed != "TRUE"){
echo "<script type='text/javascript'>";
echo "alert('COOKIE錯誤!')";
echo "</script>";
//header("location:admin_login.php");
//exit();	
}

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

<meta charset="utf-8">
<title>WMPCCA 後台管理系統 - 首頁</title>
	
	
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
			<div class="fadeIn first mx-auto text-center">
				<img src="../img/Favicon/180x180.png" id="icon" alt=""><br>
				<div class="h4 text-info">Hello World!歡迎使用後台!</div><br>
				<div class="h4 text-warning">您的員工編號為：<?php echo $staffNO; ?></div><br>
				<div class="h3 text-danger"><?php echo $_COOKIE["passed"]; ?></div>
				<div class="h3 text-danger"><?php echo $_COOKIE["account"]; ?></div>
				<div class="h3 text-danger"><?php echo $_COOKIE["staffNO"]; ?></div>
				<div class="h3 text-danger"><?php echo $passed; ?></div>
				<div class="h3 text-danger"><?php echo $account; ?></div>
				<div class="h3 text-danger"><?php echo $staffNO; ?></div>
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