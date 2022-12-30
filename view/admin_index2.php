<?php
require_once ("../vender/dbtools.inc.php");

$passed = $_COOKIE["passed"];
$account = $_COOKIE["account"];
$staffNO = $_COOKIE["staffNO"];
$staffName = $_COOKIE["staffName"];
$postType = $_COOKIE["postType"];
// 若cookie中的變數passed不為TRUE，則導回登入頁
if ($passed != "TRUE"){
echo "<script type='text/javascript'>";
echo "alert('COOKIE錯誤!請重新登入！')";
echo "</script>";
header("location:admin_login.php");
exit();
}

// 取得最近一次競賽資料
$sqlSELECTcompetData = " SELECT * FROM competList ORDER BY id DESC LIMIT 1 ";
$sqlRESULTcompetData = mysql_query($sqlSELECTcompetData, $sqlLink);
$sqlFETCHcompetData = mysql_fetch_row($sqlRESULTcompetData);
$projectNO = $sqlFETCHcompetData[1];
$projectName = $sqlFETCHcompetData[2];
$competStartDate = $sqlFETCHcompetData[4];
$competEndDate = $sqlFETCHcompetData[5];
$payEndDate = $sqlFETCHcompetData[7];

//取得該次競賽 報名隊伍總數 分區有效隊數
$sqlSELECTteamCount = " SELECT * FROM competCollege WHERE projectNO = '$projectNO' ";
$sqlSELECTteamNorth = " SELECT * FROM competCollege WHERE projectNO = '$projectNO' AND district = '北區' ";
$sqlSELECTteamCentral = " SELECT * FROM competCollege WHERE projectNO = '$projectNO' AND district = '中區' ";
$sqlSELECTteamSouth = " SELECT * FROM competCollege WHERE projectNO = '$projectNO' AND district = '南區' ";
$sqlRESULTteamCount = mysql_query($sqlSELECTteamCount, $sqlLink);
$sqlRESULTteamNorth = mysql_query($sqlSELECTteamNorth, $sqlLink);
$sqlRESULTteamCentral = mysql_query($sqlSELECTteamCentral, $sqlLink);
$sqlRESULTteamSouth = mysql_query($sqlSELECTteamSouth, $sqlLink);
$sqlNUMROWteamCount = mysql_num_rows($sqlRESULTteamCount);
$sqlNUMROWteamNorth = mysql_num_rows($sqlRESULTteamNorth);
$sqlNUMROWteamCentral = mysql_num_rows($sqlRESULTteamCentral);
$sqlNUMROWteamSouth = mysql_num_rows($sqlRESULTteamSouth);
$teamCount = $sqlNUMROWteamCount; // 總隊伍數
$teamNorth = $sqlNUMROWteamNorth; // 北區總隊數
$teamCentral = $sqlNUMROWteamCentral; // 中區總隊數
$teamSouth = $sqlNUMROWteamSouth; // 南區總隊數

//取得該次競賽 當天 成立訂單數 已取號數 已繳費數 尚未完成繳費數
$sqlSELECTgetOrderList = " SELECT * FROM orderList WHERE projectNO = '$projectNO' ";
$sqlSELECTgetPayNumber = " SELECT * FROM orderList WHERE projectNO = '$projectNO' AND payStatus = '已取號' ";
$sqlSELECTgetPayed = " SELECT * FROM orderList WHERE projectNO = '$projectNO' AND payStatus = '繳費完成' ";
$sqlRESULTgetOrderList = mysql_query($sqlSELECTgetOrderList, $sqlLink);
$sqlRESULTgetPayNumber = mysql_query($sqlSELECTgetPayNumber, $sqlLink);
$sqlRESULTgetPayed = mysql_query($sqlSELECTgetPayed, $sqlLink);
$sqlNUMROWSgetOrderList = mysql_num_rows($sqlRESULTgetOrderList);
$sqlNUMROWSgetPayNumber = mysql_num_rows($sqlRESULTgetPayNumber);
$sqlNUMROWSgetPayed = mysql_num_rows($sqlRESULTgetPayed);
$getOrderList = $sqlNUMROWSgetOrderList; //成立訂單總數
$getPayNumber = $sqlNUMROWSgetPayNumber; //已取號
$getPayed = $sqlNUMROWSgetPayed; //完成繳費
$getNoPay = $getOrderList - $getPayed; //未完成繳費

//取得該次競賽 初賽報告繳交狀況
$sqlSELECTreport1 = " SELECT * FROM competScore WHERE projectNO = '$projectNO' AND firstReport = '已繳交' ";
$sqlRESULTreport1 = mysql_query($sqlSELECTreport1, $sqlLink);
$sqlNUMROWSreport1 = mysql_num_rows($sqlRESULTreport1);
$report1 = $sqlNUMROWSreport1;
//取得該次競賽 決賽報告繳交狀況
$sqlSELECTreport2 = " SELECT * FROM competScore WHERE projectNO = '$projectNO' AND secondReport = '已繳交' ";
$sqlRESULTreport2 = mysql_query($sqlSELECTreport2, $sqlLink);
$sqlNUMROWSreport2 = mysql_num_rows($sqlRESULTreport2);
$report2 = $sqlNUMROWSreport2;

//報告繳交
$report1Sent = round(($report1/$getPayed)*100, 1); //初賽報告繳交

// 訂單統計
$effectOrders = round(($getPayed/$getOrderList)*100, 1); // 有效訂單
$failOrders = round(($getNoPay/$getOrderList)*100, 1); // 無效訂單

// 當次競賽收取報名費總金額
$sqlSELECTpayCount = " SELECT SUM(MN) FROM orderList WHERE projectNO = '$projectNO' AND payStatus = '繳費完成' ";
$sqlRESULTpayCount = mysql_query($sqlSELECTpayCount, $sqlLink);
$sqlFETCHpayCount = mysql_fetch_row($sqlRESULTpayCount);
$payCount = $sqlFETCHpayCount[0];

?>
	
<!DOCTYPE html>

<html>

<head>
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>WMPCCA - 後台管理系統</title>
	<link href="../lumino/css/bootstrap.min.css" rel="stylesheet">
	<link href="../lumino/css/datepicker3.css" rel="stylesheet">
	<link href="../lumino/css/styles.css" rel="stylesheet">

</head>

<body>

	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="admin_index2.php"><span>WMPCCA</span>後台管理系統</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $staffName ?> <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href=""><span class="glyphicon glyphicon-user"></span> 個人資料</a></li>
							<li><a href=""><span class="glyphicon glyphicon-cog"></span> 設定</a></li>
							<li><a href="../model/admin_logout.php"><span class="glyphicon glyphicon-log-out"></span> 登出</a></li>
						</ul>
					</li>
				</ul>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>


<!-- Admin Left Side Bar -->
<?php require_once("../model/admin_leftSideBar.php") ?>	
<!--/.sidebar-->


	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
			<div class="row">
				<ol class="breadcrumb">
					<li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
					<li class="active">儀表板</li>
				</ol>
			</div><!--/.row-->

			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">總覽：<? echo $projectName; ?><span class="h3" style="margin-left: 20px;"> ( 報名期間：<? echo substr($competStartDate, 0, 10); ?> ~ <? echo substr($competEndDate, 0, 10); ?> ) </span></h1>
				</div>
			</div><!--/.row-->

			<div class="row">
				<div class="col-xs-12 col-md-6 col-lg-2">
					<div class="panel panel-blue panel-widget ">
						<div class="row no-padding">
							<div class="col-sm-3 col-lg-5 widget-left">
								<em class="glyphicon glyphicon-pencil glyphicon-l"></em>
							</div>
							<div class="col-sm-9 col-lg-7 widget-right">
								<div class="large"><?php echo $teamCount; ?> 隊</div>
								<div class="text-muted" style="margin-top: 3px;">報名隊伍</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-md-6 col-lg-2">
					<div class="panel panel-orange panel-widget">
						<div class="row no-padding">
							<div class="col-sm-3 col-lg-5 widget-left">
								<em class="glyphicon glyphicon-shopping-cart glyphicon-l"></em>
							</div>
							<div class="col-sm-9 col-lg-7 widget-right">
								<div class="large"><?php echo $getOrderList; ?> 張</div>
								<div class="text-muted" style="margin-top: 3px;">訂單成立</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-md-6 col-lg-2">
					<div class="panel panel-teal panel-widget">
						<div class="row no-padding">
							<div class="col-sm-3 col-lg-5 widget-left">
								<em class="glyphicon glyphicon-check glyphicon-l"></em>
							</div>
							<div class="col-sm-9 col-lg-7 widget-right">
								<div class="large"><?php echo $getPayed; ?> 隊</div>
								<div class="text-muted" style="margin-top: 3px;">繳費完成</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-md-6 col-lg-2">
					<div class="panel panel-red panel-widget">
						<div class="row no-padding">
							<div class="col-sm-3 col-lg-5 widget-left">
								<em class="glyphicon glyphicon-usd glyphicon-l"></em>
							</div>
							<div class="col-sm-9 col-lg-7 widget-right">
								<div class="large">$<?php echo $payCount; ?></div>
								<div class="text-muted" style="margin-top: 3px;">總金額</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-md-6 col-lg-2">
					<div class="panel panel-blue panel-widget">
						<div class="row no-padding">
							<div class="col-sm-3 col-lg-5 widget-left">
								<em class="glyphicon glyphicon-stats glyphicon-l"></em>
							</div>
							<div class="col-sm-9 col-lg-7 widget-right" style="padding: 6px 0 0 6px">
								<div class="text-muted">北區：<?php echo $teamNorth; ?> 隊</div>
								<div class="text-muted">中區：<?php echo $teamCentral; ?> 隊</div>
								<div class="text-muted">南區：<?php echo $teamSouth; ?> 隊</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-md-6 col-lg-2">
					<div class="panel panel-orange panel-widget">
						<div class="row no-padding">
							<div class="col-sm-3 col-lg-5 widget-left">
								<em class="glyphicon glyphicon-file glyphicon-l"></em>
							</div>
							<div class="col-sm-9 col-lg-7 widget-right">
								<div class="large"><?php echo $report1; ?>:<?php echo $report2; ?></div>
								<div class="text-muted" style="margin-top: 3px;">初賽:決賽</div>
							</div>
						</div>
					</div>
				</div>
			</div><!--/.row-->

			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">過去7天</div>
						<div class="panel-body">
							<div class="canvas-wrapper">
								<canvas class="main-chart" id="line-chart" height="200" width="600"></canvas>
							</div>
						</div>
					</div>
				</div>
			</div><!--/.row-->

			<div class="row">
				<div class="col-xs-6 col-md-3">
					<div class="panel panel-default">
						<div class="panel-body easypiechart-panel">
							<h4>有效訂單</h4>
							<div class="easypiechart" id="easypiechart-blue" data-percent="<?php echo $effectOrders; ?>" ><span class="percent"><?php echo $effectOrders; ?>%</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3">
					<div class="panel panel-default">
						<div class="panel-body easypiechart-panel">
							<h4>無效訂單</h4>
							<div class="easypiechart" id="easypiechart-orange" data-percent="<?php echo $failOrders; ?>" ><span class="percent"><?php echo $failOrders; ?>%</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3">
					<div class="panel panel-default">
						<div class="panel-body easypiechart-panel">
							<h4>初賽上傳</h4>
							<div class="easypiechart" id="easypiechart-teal" data-percent="<?php echo $report1Sent; ?>" ><span class="percent"><?php echo $report1Sent; ?>%</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3">
					<div class="panel panel-default">
						<div class="panel-body easypiechart-panel">
							<h4>保留區域</h4>
							<div class="easypiechart" id="easypiechart-red" data-percent="27" ><span class="percent"><?php echo '2%'; ?></span>
							</div>
						</div>
					</div>
				</div>
			</div><!--/.row-->

		</div>	<!--/.main-->











<script src="../lumino/js/jquery-1.11.1.min.js"></script>
<script src="../lumino/js/bootstrap.min.js"></script>
<script src="../lumino/js/chart.min.js"></script>
<script src="../lumino/js/chart-data.js"></script>
<script src="../lumino/js/easypiechart.js"></script>
<script src="../lumino/js/easypiechart-data.js"></script>
<script src="../lumino/js/bootstrap-datepicker.js"></script>
	
<!-- 自定義JS -->
	<!-- 權限 -->
	<script src="../controller/admin_authority.js"></script>
	
<script>
$('#calendar').datepicker({
});

!function ($) {
$(document).on("click","ul.nav li.parent > a > span.icon", function(){     
$(this).find('em:first').toggleClass("glyphicon-minus");
}); 
$(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
}(window.jQuery);

$(window).on('resize', function () {
if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
})
$(window).on('resize', function () {
if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
})

</script>	
</body>