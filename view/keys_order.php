<!doctype html>

<html>
<head>
<?php require_once("../model/index_rel.php") ?>

<link rel=stylesheet type="text/css" href="../css/body_global.css">
<link rel=stylesheet type="text/css" href="../css/keys_index.css">
<link rel=stylesheet type="text/css" href="../css/navbar.css">
<link rel=stylesheet type="text/css" href="../css/waitload.css">
<link rel=stylesheet type="text/css" href="../css/index_footer.css">
	
<!-- Owl Carousel -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />	
<link rel="stylesheet" href="../vender/owl.slider/css/slider.css">
<!-- nexus CSS -->
<!--<link rel="stylesheet" href="../nexus/css/font-awesome.min.css">-->
<!--
<link rel="stylesheet" href="../nexus/vendors/animate-css/animate.css">
<link rel="stylesheet" href="../nexus/vendors/flaticon/flaticon.css">
-->

<link rel="stylesheet" href="../nexus/css/style.css">
<!--<link rel="stylesheet" href="../nexus/css/responsive.css">-->
<meta charset="utf-8">

<title>KEYs財富軟體使用授權合約</title>
	

<style>

.banner_inner{
	font-size: 13px;
	line-height: 1.8;
	color: #000000;
	background-image: url("../img/72-174.jpg");
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
	
.img-fluid{
	-webkit-filter:drop-shadow(10px 10px 10px white);
}
.textStroke{
    -webkit-text-stroke: 1px white;
    color: black;
}
	
/* The customcheck */
.customcheck {
	line-height: 24px;
/*    display: block;*/
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

</style>	
	
</head>

<body>
<?php require_once("../model/waitload.php") ?>
<?php require_once("../model/cc_imgGroup_Modal.php") ?>
<?php require_once("../model/index_nav.php") ?>
<!-- <?php require_once("../model/keys_bgimg.php") ?> -->

<!-- 頁首 HEADER -->
<section class="home_banner_area">
	<div class="banner_inner">
		<div class="container" style="padding-top: 200px;padding-bottom: 200px;">
			<div class="row">
				
				<div class="col-lg-12">
					<div class="mx-auto text-center h1 textStroke text-info font-weight-bold">
						KEYs財富管理系統係由本會授權委託
						<img class="img-fluid" src="../img/MoneyStar-05.png" alt="" width="30%" height="auto">
						研發
					</div>			
				</div>
				
				<div class="col mx-auto text-center h3 pt-5 text-info textStroke font-weight-bold">
					您的訂單及合約維護將由MoneyStar進行處理，請詳讀以下<span class="text-warning font-weight-bold">軟體使用授權合約</span>
				</div>
<!--
				<div class="col-lg-5">
					<div class="banner_content">
						<h2><span style="color: #0B7376">KEY</span><span style="color: #FAB216">s</span> <span style="color:#FFFF35;">全方位</span><br /><span class="text-white">財富管理規劃系統</span></h2>
						<p></p>
						<a class="btn btn-outline-info btn-lg" href="#">選擇計劃</a>
						<a class="btn btn-outline-warning btn-lg ml-3" href="#">了解更多</a>
					</div>
				</div>
-->
			</div>
		</div>
	</div>
</section>

<!-- 訂購聲明 -->
<section class="made_life_area p_120">
	<div class="container">
		
		<div class="row bg-white px-3 py-3" style="border-radius: 20px;">
			<div class="col">
				<h3 class="mx-auto text-info text-center pt-3">MoneyStar精進財商顧問股份有限公司 - KEYs財富軟體使用授權合約</h3>
				<ul>
					<li>A</li>
					<li>B</li>
					<li>C</li>
					<li>D</li>
					<li>E</li>
					<li>F</li>
					<li>G</li>
					<li>H</li>
					<li>I</li>
					<li>J</li>
				</ul>
				
				
				
			</div>
		</div>

		<div class="mx-auto text-center py-3">
			<label class="customcheck">我已閱讀、瞭解並同意接受本授權協議之所有內容。
			<input type="checkbox" id="agreeCheck" value="agree">
			<span class="checkmark"></span>
			</label>
		</div>
			
		<div class="row mx-auto text-center">
			<div class="col">
				<button class="btn btn-lg btn-outline-info" onClick="go2op()">前往訂購</button>
			</div>
		</div>
		
	</div>
</section>


<!-- 訂購聲明 -->
<!--
<section class="made_life_area p_120">
	<div class="container">
		
		<div class="row bg-white px-3 py-3" style="border-radius: 20px;">
			<div class="col">
				<h3 class="mx-auto text-info text-center pt-3">MoneyStar精進財商顧問股份有限公司 - KEYs財富軟體使用授權合約</h3>
				<ul>
					<li>你要付錢</li>
					<li>你要付一點錢</li>
					<li>你要付多一點錢</li>
					<li>你要付很多的錢</li>
					<li>你要付更多的錢</li>
					<li>你要付更多更多的錢</li>
					<li>我還要更多的錢</li>
					<li>我還要更多更多的錢</li>
					<li>你要付到破產</li>
					<li>不然我會破產</li>
				</ul>
				
				<div class="mx-auto text-center">
				<button class="btn btn-lg btn-success">同　意</button>
				<button class="btn btn-lg btn-danger ml-3">不同意</button>
				</div>
				
			</div>
		</div>
		
		<div class="row mx-auto text-center py-5">
			<div class="col">
				
			</div>
		</div>
		
	</div>
</section>	
-->
	
<!--  -->
<!--
<section class="price_area p_120">
	<div class="container">
		
	</div>
</section>
-->


<!-- Carousel TEST -->

<!-- Carousel TEST End -->












<?php require_once("../model/index_footer.php") ?>
<?php require_once("../model/index_js.php") ?>

<script type="text/javascript" src="../controller/waitload.js"></script>
<script type="text/javascript" src="../controller/index_nav.js"></script>
<script type="text/javascript" src="../controller/toggle_tooltip.js"></script>
<!-- nexus JS -->
<!--<script src="../nexus/vendors/owl-carousel/owl.carousel.min.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha256-pTxD+DSzIwmwhOqTFN+DB+nHjO4iAsbgfyFq5K5bcE0=" crossorigin="anonymous"></script>		
<script>

</script>

	<script>
   function go2op(){
    if($("#agreeCheck").is(":checked")){
     location.href= "https://wmpcca.com/bswmp/form/view/keys_op.php"
    }else{
     alert('請勾選同意事項！')
    }
   }
	</script>

</body>
</html>



