<?php
require_once("../vender/dbtools.inc.php");
	
?>

<!doctype html>

<html>
<head>
<?php require_once("../model/index_rel.php") ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">

<link rel=stylesheet type="text/css" href="../css/body_global.css">
<link rel=stylesheet type="text/css" href="../css/keys_index.css">
<link rel=stylesheet type="text/css" href="../css/navbar.css">
<link rel=stylesheet type="text/css" href="../css/waitload.css">
<link rel=stylesheet type="text/css" href="../css/index_footer.css">

<!-- nexus CSS -->
<link rel="stylesheet" href="../nexus/css/font-awesome.min.css">
<link rel="stylesheet" href="../nexus/vendors/animate-css/animate.css">
<link rel="stylesheet" href="../nexus/vendors/owl-carousel/owl.carousel.min.css">
<link rel="stylesheet" href="../nexus/vendors/flaticon/flaticon.css">

<link rel="stylesheet" href="../nexus/css/style.css">
<link rel="stylesheet" href="../nexus/css/responsive.css">
<meta charset="utf-8">

<title>WMPCCA - 重新發送驗證碼</title>
	

	
<style>
.banner_inner{
	font-size: 13px;
	line-height: 1.8;
	color: #000000;
	background-image: url("../img/compet_index.png");
	background-repeat: no-repeat;
	background-size: cover;
	-moz-background-size: cover;
	-webkit-background-size: cover;
	-o-background-size: cover;
	-ms-background-size: cover;
	background-position: center center;
	font-weight: 400;
	font-family: "Microsoft JhengHei", "微軟正黑體", "Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, "sans-serif";
	margin: 0px;	
}

.main {
padding: 60px 0;
position: relative; 
}


.containerIndex {
	width: 660px;
	height: auto;
	background: white;
	margin:0px auto;
/*	margin-left: 35%;*/
	border-radius: 10px;
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	-o-border-radius: 10px;
	-ms-border-radius: 10px; 
}

/*
.appointment-form {
	padding: 50px 60px 70px 60px; }
*/

/* The customcheck */
.customcheck {
	line-height: 24px;
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 18px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* Hide the browser's default checkbox */
.customcheck input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

/* Create a custom checkbox */
.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
    border-radius: 5px;
}

/* On mouse-over, add a grey background color */
.customcheck:hover input ~ .checkmark {
    background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.customcheck input:checked ~ .checkmark {
    background-color: #0B7376;
    border-radius: 5px;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the checkmark when checked */
.customcheck input:checked ~ .checkmark:after {
    display: block;
}

/* Style the checkmark/indicator */
.customcheck .checkmark:after {
    left: 10px;
    top: 4px;
    width: 6px;
    height: 16px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}	

* {
  box-sizing: border-box;
}
.inp {
  position: relative;
  margin: auto;
  width: 100%;
  
}
.inp .label1, .label2, .label3, .label4 {
  position: absolute;
  top: 16px;
  left: 0;
  font-size: 16px;
  color: #9098a9;
  font-weight: 500;
  transform-origin: 0 0;
  transition: all 0.2s ease;
}
.inp .border1, .border2, .border3, .border4 {
  position: absolute;
  bottom: 0;
  left: 0;
  height: 2px;
  width: 100%;
  background: #0B7376;
  transform: scaleX(0);
  transform-origin: 0 0;
  transition: all 0.15s ease;
}
.inp input {
  -webkit-appearance: none;
  width: 100%;
  border: 0;
  font-family: inherit;
  padding: 12px 0;
  height: 48px;
  font-size: 16px;
  font-weight: 500;
  border-bottom: 2px solid #c8ccd4;
  background: none;
  border-radius: 0;
  color: #0B7376;
  transition: all 0.15s ease;
}
.inp input:hover {
  background: rgba(34,50,84,0.03);
}
.inp input:not(:placeholder-shown) + span {
  color: #5a667f;
  transform: translateY(-26px) scale(0.75);
}
.inp input:focus {
  background: none;
  outline: none;
}
.inp input:focus + span {
  color: #FAB216;
  transform: translateY(-26px) scale(0.75);
}
.inp input:focus + span + .border1 {
  transform: scaleX(1);
}
.inp input:focus + span + .border2 {
  transform: scaleX(1);
}
.inp input:focus + span + .border3 {
  transform: scaleX(1);
}
.inp input:focus + span + .border4 {
  transform: scaleX(1);
}		
	
</style>	
	
	
</head>

<body>
<?php require_once("../model/waitload.php") ?>
<?php require_once("../model/cc_imgGroup_Modal.php") ?>
<?php require_once("../model/index_nav.php") ?>


<section class="home_banner_area">
	<div class="banner_inner">
<div class="main">
	<div class="containerIndex">
		<form class="" method="POST" style="padding-top: 50px;" action="../view/compet_forgetCodeSent.php">
			
				<div class="row mt-0">
					<div class="col-2"></div>
						<div class="col-8">
							<select class="custom-select text-center" style="text-align: center;text-align-last: center; font-size: 18px;" name="teamDB">
								<option value="">請選擇競賽組別</option>
								<option value="competCollege">大專盃(全國、分區)</option>
								<option value="competSocial">社會組</option>
							</select>
						</div>
					<div class="col-2"></div>
				</div>

				<div class="row mx-auto text-center mt-3">
					<div class="col-2 mx-auto text-center"></div>
						<div class="col-8">
							<input type="text" class="form-group form-control mx-auto text-center" id="teamNO" name="teamNO" placeholder="請輸入隊伍編號">
							<input type="text" class="form-group form-control mx-auto text-center" id="identifyNO" name="identifyNO" placeholder="請輸入隊長身份證字號">
							<input type="text" class="form-group form-control mx-auto text-center" id="email" name="email" placeholder="請輸入隊長E-mail">
						</div>
					<div class="col-2"></div>
				</div>

				<div class="row mx-auto text-center mt-3">
					<div class="col-4 mx-auto text-center"></div>
						<div class="col-4">
							<button type="submit" class="form-control btn btn-lg btn-warning" onClick="reGetCode()">發送驗證碼</button>
						</div>
					<div class="col-4"></div>
				</div>
			
				<div class="row mt-3">
					<div class="col-2"></div>
						<div class="col-8">
							<small class="form-text text-danger mx-auto text-center">※ 建議使用Gmail或Yahoo，其它免費信箱可能無法正常寄送！</small>
							<small class="form-text text-danger mx-auto text-center">※ 重新發送後3分鐘內沒有收到可至垃圾郵件查詢</small>							
						</div>
					<div class="col-2"></div>
				</div>			
			
		</form>
			
				<div style="padding-bottom: 50px;"></div>
		
	</div>	
</div>
	</div>
</section>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="../lumino/js/bootstrap.min.js"></script>	
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>

	

<?php require_once("../model/index_footer.php") ?>
<?php require_once("../model/index_js.php") ?>

<script type="text/javascript" src="../controller/waitload.js"></script>
<script type="text/javascript" src="../controller/index_nav.js"></script>
<script type="text/javascript" src="../controller/toggle_tooltip.js"></script>
<!-- nexus JS -->
<script src="../nexus/vendors/owl-carousel/owl.carousel.min.js"></script>
</body>
</html>