<?php



?>

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

<title>WMPCCA - KEYs財富管理規劃系統</title>
	

<style>

.banner_inner{
	font-size: 13px;
	line-height: 1.8;
	color: #000000;
	background-image: url("../img/2851.jpg");
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

.reviews{
	background-image: url("../img/72-174.jpg");
	background-repeat: no-repeat;
	background-size: cover;
	-moz-background-size: cover;
	-webkit-background-size: cover;
	-o-background-size: cover;
	-ms-background-size: cover;
	background-position: center center;
}
	
.to-class{
    padding: 150px 0;
    padding-bottom: 150px;
	background-image: url("../img/124.jpg");
	background-repeat: no-repeat;
	background-size: cover;
	-moz-background-size: cover;
	-webkit-background-size: cover;
	-o-background-size: cover;
	-ms-background-size: cover;
	background-position: center center;
}	



/* Carousel TEST */


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
		<div class="container">
			<div class="row">
				<div class="col-lg-5">
					<div class="banner_content">
						<h2><span style="color: #0B7376">KEY</span><span style="color: #FAB216">s</span> <span style="color:#FFFF35;">全方位</span><br /><span class="text-white">財富管理規劃系統</span></h2>
						<p></p>
						<a class="btn btn-outline-info btn-lg" href="#">選擇計劃</a>
						<a class="btn btn-outline-warning btn-lg ml-3" href="#">了解更多</a>
					</div>
				</div>
				<div class="col-lg-7">
					<div class="home_left_img">
						<img class="img-fluid" src="../img/KEYs_screen.png" alt="">
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- KEYs功能介紹 -->
<section class="made_life_area p_120">
	<div class="container">
		<div class="made_life_inner">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
				<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true" style="font-size:22px;">全方位理財環境</a>
				</li>
				<li class="nav-item">
				<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" style="font-size:22px;">家庭保障計劃</a>
				</li>
				<li class="nav-item">
				<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false" style="font-size:22px;">理財方案比較</a>
				</li>
				<li class="nav-item">
				<a class="nav-link" id="edge-tab" data-toggle="tab" href="#edge" role="tab" aria-controls="edge" aria-selected="false" style="font-size:22px;">生涯財富模擬</a>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
					<div class="row made_life_text">
						<div class="col-lg-6">
							<div class="left_side_text">
								<h3>最完整的理財規劃</h3>
								<h6>參考國際理財規劃標準流程</h6>
								<p>滿足生涯財務需求的目標設定，提供完整的家庭基本資料、財務夢想清單、財務需求目標以及財務現況…等資料的建立與分析。</p>
								<a class="btn btn-warning btn-lg my-3" href="#">選擇計劃</a>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="chart_img">
								<img class="img-fluid" src="../img/KEYs/keysindex02.png" alt="">
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
					<div class="row made_life_text">
						<div class="col-lg-6">
							<div class="left_side_text">
								<h3>We’ve made a life <br />that will change you</h3>
								<h6>We are here to listen from you deliver exellence</h6>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod temp or incididunt ut labore et dolore magna aliqua. Ut enim ad minim.</p>
<!--								<a class="main_btn" href="#">Get Started Now</a>-->
							</div>
						</div>
						<div class="col-lg-6">
							<div class="chart_img">
								<img class="img-fluid" src="../img/KEYs/keysindex03.png" alt="">
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
					<div class="row made_life_text">
						<div class="col-lg-6">
							<div class="left_side_text">
								<h3>We’ve made a life <br />that will change you</h3>
								<h6>We are here to listen from you deliver exellence</h6>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod temp or incididunt ut labore et dolore magna aliqua. Ut enim ad minim.</p>
<!--								<a class="main_btn" href="#">Get Started Now</a>-->
							</div>
						</div>
						<div class="col-lg-6">
							<div class="chart_img">
								<img class="img-fluid" src="../img/KEYs/keysindex05.png" alt="">
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="edge" role="tabpanel" aria-labelledby="edge-tab">
					<div class="row made_life_text">
						<div class="col-lg-6">
							<div class="left_side_text">
								<h3>We’ve made a life <br />that will change you</h3>
								<h6>We are here to listen from you deliver exellence</h6>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod temp or incididunt ut labore et dolore magna aliqua. Ut enim ad minim.</p>
<!--								<a class="main_btn" href="#">Get Started Now</a>-->
							</div>
						</div>
						<div class="col-lg-6">
							<div class="chart_img">
								<img class="img-fluid" src="../img/KEYs/keysindex01.png" alt="">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- 來自各方的推薦 -->
<section class="reviews">
<!--        <h2 class="main-title text-center font-weight-bold pb-4">來自各方的推薦</h2>-->
        
<!--
		<div class="main_title">
			<h2>來自星星的推薦</h2>
			<p>立即開始您的財富計劃</p>
		</div>
-->
	
		<div class="container">
            <div class="owl-carousel">

                <!-- card -->
                <div class="item">
                    <div class=" card">
                        <div class="row">
                            <div class="col-xs-7 col-7 info-col">
                                <h4 class="title pl-2">梁亦鴻</h4>
                                <h6 class="sub-title pl-2">CFP國際理財規劃顧問</h6>
                                <ul class="pl-2">
                                    <li>
                                        <i class="fas fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fas fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fas fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fas fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fas fa-star"></i>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4 col-4 img-col">
                                <div class="user" style="background-image: url('../vender/owl.slider/images/user.jpg')"></div>
                            </div>

							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 p-col">
                                <p class="px-3">
									這行看上去就有十個字。這行看上去就有十個字。這行看上去就有十個字。這行看上去就有十個字。
								</p>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- card -->
                <div class="item">
                    <div class=" card">
                        <div class="row">
                            <div class="col-xs-7 col-7 info-col">
                                <h4 class="title pl-2">林婉玲</h4>
                                <h6 class="sub-title pl-2">證券分析師</h6>
                                <ul class="pl-2">
                                    <li>
                                        <i class="fas fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fas fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fas fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fas fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fas fa-star"></i>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4 col-4 img-col">

                                <div class="user" style="background-image: url('../vender/owl.slider/images/user-1.jpg')"></div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 p-col">
                                <p class="px-3">
									這行看上去就有十個字。這行看上去就有十個字。這行看上去就有十個字。這行看上去就有十個字。這行看上去就有十個字。
								</p>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- card -->
                <div class="item">
                    <div class=" card">
                        <div class="row">
                            <div class="col-xs-7 col-7 info-col">
                                <h4 class="title pl-2">林澍典</h4>
                                <h6 class="sub-title pl-2">精進財商總經理</h6>
                                <ul class="pl-2">
                                    <li>
                                        <i class="fas fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fas fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fas fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fas fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fas fa-star"></i>
                                    </li>
<!--
									<li>
										<i class="fas fa-thumbs-up"></i>
									</li>
-->
                                </ul>
                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4 col-4 img-col">
                                <div class="user" style="background-image: url('../vender/owl.slider/images/user-2.jpg')"></div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 p-col">
                                <p class="px-3">
									這行看上去就有十個字。這行看上去就有十個字。這行看上去就有十個字。這行看上去就有十個字。這行看上去就有十個字。
								</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- card -->
                <div class="item">
                    <div class=" card">
                        <div class="row">
                            <div class="col-xs-7 col-7 info-col">
                                <h4 class="title pl-2">無名氏</h4>
                                <h6 class="sub-title pl-2">某外商PM</h6>
                                <ul class="pl-2">
                                    <li>
                                        <i class="fas fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fas fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fas fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fas fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fas fa-star"></i>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4 col-4 img-col">
                                <div class="user" style="background-image: url('../vender/owl.slider/images/8B61.jpg')"></div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 p-col">
                                <p class="px-3">
									這行看上去就有十個字。這行看上去就有十個字。這行看上去就有十個字。這行看上去就有十個字。這行看上去就有十個字。
								</p>
                            </div>
                        </div>
                    </div>
                </div>				
				
                <!-- card -->
                <div class="item">
                    <div class=" card">
                        <div class="row">
                            <div class="col-xs-7 col-7 info-col">
                                <h4 class="title pl-2">吳楚仁</h4>
                                <h6 class="sub-title pl-2">沒有這個人</h6>
                                <ul class="pl-2">
                                    <li>
                                        <i class="fas fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fas fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fas fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fas fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fas fa-star"></i>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4 col-4 img-col">
                                <div class="user" style="background-image: url('../vender/owl.slider/images/8B61.jpg')"></div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 p-col">
                                <p class="px-3">
									這行看上去就有十個字。這行看上去就有十個字。&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
								</p>
                            </div>
                        </div>
                    </div>
                </div>		
				
            </div>
        </div>
    </section>

<!-- KEYs訂購 -->
<section class="price_area p_120 plan-select">
	<div class="container">
		
		<div class="main_title">
			<h2>立即開始您的財富計劃</h2>
<!--			<p>立即開始您的財富計劃</p>-->
		</div>
		
		<div class="price_inner row">
			<div class="col-lg-4">
				<div class="price_item">
					<div class="price_head">
						<h2>標 準 版</h2>
					</div>
					<div class="price_body">
						<ul class="list">
							<li>可儲存1筆規劃資料</li>
							<li>規劃連結保險平台</li>
							<li>規劃連結基金平台</li>
							<li>適合個人用戶</li>
						</ul>
					</div>
					<div class="price_footer">
						<h3><span class="dlr">$</span> 免費 <span class="month"> <br />3個月</span></h3>
						<button class="btn btn-outline-info btn-lg my-3" onClick="go2KEYs()">前 往 註 冊</button><br>
						<h5 class="text-info">※限首次註冊帳號</h5>
					</div>
				</div>
			</div>
<!--
			<div class="col-lg-4">
				<div class="price_item">
					<div class="price_head">
						<h4>Real Standard</h4>
					</div>
					<div class="price_body">
						<ul class="list">
							<li><a href="#">10 GB Space</a></li>
							<li><a href="#">Secure Online Transfer</a></li>
							<li><a href="#">Unlimited Styles</a></li>
							<li><a href="#">Customer Service</a></li>
						</ul>
					</div>
					<div class="price_footer">
						<h3><span class="dlr">$</span> 8K <span class="month"><br />每年</span></h3>
						<a class="main_btn" href="#">Get Started</a>
					</div>
				</div>
			</div>
-->
			<div class="col-lg-4">
				<div class="price_item">
					<div class="price_head">
						<h2>專 業 版</h2>
					</div>
					<div class="price_body">
						<ul class="list">
							<li class="text-info font-weight-bold">可儲存無限筆規劃資料</li>
							<li>規劃連結保險平台</li>
							<li>規劃連結基金平台</li>
							<li class="text-warning font-weight-bold">一鍵產出專業規劃報告書</li>
						</ul>
					</div>
					<div class="price_footer">
						<h3><span class="dlr">$</span> 19,800 <span class="month"><br />/每年</span></h3>
						<button class="btn btn-outline-info btn-lg my-3" onClick="go2order()">立 即 擁 有</button><br>
						<h5 class="text-info">※限使用信用卡付款</h5>
					</div>
				</div>
			</div>

		

			<div class="col-lg-4">
				<div class="price_item">
					<div class="price_head">
						<h2>專業版續約</h2>
					</div>
					<div class="price_body">
						<ul class="list">
							<li>&nbsp;</li>
							<li class="text-info font-weight-bold">限專業版使用者</li>
							<li>&nbsp;</li>
							<li>&nbsp;</li>
						</ul>
					</div>
					<div class="price_footer">
						<h3><span class="dlr">$</span> 6,000 <span class="month"><br />/1年</span></h3>
						<button class="btn btn-outline-info btn-lg my-3" onClick="go2order2()">點 此 續 約</button><br>
						<h5 class="text-info">※限使用信用卡付款</h5>
					</div>
			</div>	
		</div>
			
			
			
<!--
			<div class="col-8">
				<h2 class="d-flex flex-column justify-content-center align-items-center">專業版續期</h2>
			</div>
			
			<div class="col-4">
				<a class="btn btn-outline-info btn-lg my-3" href="" target="_blank">點 此 續 約</a>
			</div>
-->

		</div>
		
		<h3 class="text-center mx-auto pt-5">查詢您的KEYs狀態</h3>
		<div class="row">
			<div class="col-3"></div>
			<div class="col-6">
				<div class="input-group mb-3 pt-2">
				<input type="text" class="form-control" placeholder="請輸入您的KEYs使用者帳號" aria-label="Recipient's username" aria-describedby="basic-addon2" id="UserName">
				<div class="input-group-append">
				<button class="btn btn-outline-info" type="button" id="submitCHK"><i class="fas fa-search"></i></button>
				</div>
				</div>
			</div>
			<div class="col-3"></div>
		</div>
		
		<div class="row">
			<div class="col-2"></div>
			<div class="col-8 mx-auto text-center">
				<table class="table">
				  <thead class="table-warning">
					<tr class="text-info">
					  <th scope="col">使用者</th>
					  <th scope="col">KEYs版本</th>
					  <th scope="col">授權到期</th>
					  <th scope="col">帳號狀態</th>
					</tr>
				  </thead>
				  <tbody class="table-light">
					<tr>
					  <td id="getUserName"></th>
					  <td id="getRoleID"></td>
					  <td id="getEndDate"></td>
					  <td id="getRowStatus"></td>
					</tr>
				  </tbody>
				</table>
			</div>
			<div class="col-2"></div>
		</div>
	
	<div class="row">
		<div class="col-2"></div>
		<div class="col-8 mx-auto text-center">
			<span class="h4" id="adviceAct"></span>
		</div>
		<div class="col-2"></div>
	</div>
		
		
		
	</div>
</section>

	
<!-- 培訓課程連結 -->
<section class="to-class">
	<div class="container">
		<div class="row">
			
			<div class="col-lg-12">
				<h1>結合協會的顧問及講師認證培訓</h1>
				<button class="btn btn-lg btn-outline-warning" style="float: right">培 訓 資 訊</button>
			</div>
			
<!--
			<div class="col-4">
				<button class="btn btn-lg btn-warning">培 訓 資 訊</button>
			</div>
-->
			
		</div>
	</div>
</section>

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
function go2order(){
  location.href = 'https://wmpcca.com/bswmp/form/view/keys_order.php'
}

// Reviews slider
    $(".reviews .owl-carousel").owlCarousel({
        loop: true,
        margin: 35,
        nav: false,
        center: true,
        autoplay: true,
        navText: [
            '<i class="fas fa-angle-left"></i>',
            '<i class="fas fa-angle-right"></i>'
        ],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            750: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    });
</script>

<!-- Keys查詢 -->
	<script>
		$('#submitCHK').click(function () {
			const data = $('#UserName').val()
			$.ajax({
				url:`https://www.holdingkeys.com/hermesAPI/api/member?userId=${data}`,
				contentType:'application/json'
				}).done(function (resp) {
					if(resp.success){
						$('#getUserName').text(resp.data.userName)
						$('#getRoleID').text(resp.data.roleID)
						$('#getStartDate').text(resp.data.startDate)
						$('#getEndDate').text(resp.data.endDate)
						$('#getRowStatus').text(resp.data.rowStatus)
					}else{
						alert(resp.message)
					}
				});
		})
	</script>
	
</body>
</html>



