<?php
require_once ("../vender/dbtools.inc.php");

//取得現在時間
$getToday = date("Y-m-d H:i:s");
//轉換現在時間
$getTime = strtotime($getToday);

$passed = $_COOKIE["passed"];
$account = $_COOKIE["account"];
$staffNO = $_COOKIE["staffNO"];
$staffName = $_COOKIE["staffName"];
$postType = $_COOKIE["postType"];

//取得evenList的dataList
$dataList = mysql_query(" SELECT * FROM histock_eventList ORDER BY id DESC ");

//取得試卷資訊
$sqlPPList = mysql_query("
	SELECT * FROM examPP_HiStock
");
$PPList = mysql_num_rows($sqlPPList);

//取得已做試卷資訊
$sqlPPUsed = mysql_query("
	SELECT * FROM examPP_HiStock WHERE examNumber != ''
");
$PPUsed = mysql_num_rows($sqlPPUsed);

//計算未使用卷數
$PPLeft = $PPList - $PPUsed;

// 若cookie中的變數passed不為TRUE，則導回登入頁
if ($passed != "TRUE"){
echo "<script type='text/javascript'>";
echo "alert('COOKIE錯誤!請重新登入！')";
echo "</script>";
header("location:admin_login.php");
exit();
}

// 調閱目前空白試卷數 ()
$sqlAN = mysql_query("
	SELECT * FROM examAN_HiStock WHERE examNumber = ''
");
$sqlANNUM = mysql_num_rows($sqlAN);
$ANNums = $sqlANNUM;

?>

<!DOCTYPE html>

<html>

<head>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>WMPCCA - 後台管理系統</title>


	

<link href="../lumino/css/bootstrap.min.css" rel="stylesheet">
<!--<link href="../lumino/css/datepicker3.css" rel="stylesheet">-->
<!--<link href="../lumino/css/bootstrap-table.css" rel="stylesheet">-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" integrity="sha512-f0tzWhCwVFS3WeYaofoLWkTP62ObhewQ1EZn65oSYDZUg1+CyywGKkWzm8BxaJj5HGKI72PnMH9jYyIFz+GH7g==" crossorigin="anonymous" />
<link href="../lumino/css/styles.css" rel="stylesheet">

<style>
	
	.select100 {
		width: 100%;
	}
	
	.hidden{
		display: none;
	}
	
	.mt-1{
		margin-top: 10px;
	}
	
	.mt-2{
		margin-top: 20px;
	}
	
	.mt-3{
		margin-top: 30px;
	}
	
	.ml-1{
		margin-left: 10px;
	}
	
	.ml-2{
		margin-left: 20px;
	}
	
	.ml-3{
		margin-left: 30px;
	}
	
	.mr-1{
		margin-right: 10px;
	}
	
	.mr-2{
		margin-right: 30px;
	}
	
	.mr-3{
		margin-right: 30px;
	}
	
	.pt-1{
		padding-top: 10px;
	}
	
	.pt-2{
		padding-top: 20px;
	}
	
	.pt-3{
		padding-top: 30px;
	}
	
	.pb-1{
		padding-bottom: 10px;
	}
	
	.pb-2{
		padding-bottom: 20px;
	}
	
	.pb-2{
		padding-bottom: 20px;
	}
	
	.br-1{
		border-right:1px #E0E0E0 solid;
	}
	
	.bl-1{
		border-left:1px #E0E0E0 solid;
	}
	
</style>



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
				<li>金融證券實務/活動設定</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">活動設定</h1>
			</div>
		</div><!--/.row-->

<!-- 活動設定 -->
		<div class="row">
			<div class="col-md-12" id="manageArea">
				<div class="panel panel-default">
					
					<div class="panel-heading text-center" style="color:darkred;font-weight: bold;font-size: 22px;font-family: Microsoft JhengHei;">
						<span id="">活動設定</span>
					</div>
			
					<div class="panel-body ml-3">
						
						<div class="row">
							
							
							<div class="col-md-4 br-1">
								
								<div class="text-center h3">建立活動</div>
								
								<div class="mt-2">
									<lebel></lebel>
									<select class="select100" id="selectEvent">
										<option value="0">請選擇...</option>
										<option value="HT">金融證券投資實務輔導員選拔(HT)</option>
										<option value="HS">金融與證券投資實務知識奧運會競賽(HS)</option>
									</select>
								</div>
								
	
								<div class="" id="createHT">	
									<div class="mt-3">
										活動期間：&emsp;自 <input type="button" class="datetimepicker ml-1 mr-1" id="startHT"  value="請選擇時間"  />&emsp;至&emsp;<input type="button" class="datetimepicker ml-1" id="endHT"  value="請選擇時間"  />
									</div>
									<div class="mt-1">
										&emsp;報名費用：<input type="text" id="feeHT" maxlength="4" size="5">
									</div>

									<div class="mt-3">
										北區梯次：&emsp;自 <input type="button" class="datetimepicker ml-1 mr-1" id="bach1HT"  value="請選擇時間"  />&emsp;開始
									</div>
									<div class="mt-1">
										&emsp;測驗時間：
										<select id="bach1TimeHT">
												<option value="2">2小時</option>
												<option value="3">3小時</option>
												<option value="4">4小時</option>
												<option value="5">5小時</option>
												<option value="6">6小時</option>
												<option value="7">7小時</option>
												<option value="8">8小時</option>
												<option value="9">9小時</option>
												<option value="12">12小時</option>
												<option value="24">24小時</option>
											</select>
										&emsp;名額：
											<select id="bach1LimitHT">
												<option value="10">10</option>
												<option value="15">15</option>
												<option value="20">20</option>
												<option value="25">25</option>
												<option value="30">30</option>
												<option value="35">35</option>
												<option value="40">40</option>
												<option value="45">45</option>
												<option value="55">55</option>
												<option value="60">60</option>
												<option value="65">65</option>
												<option value="70">70</option>
												<option value="75">75</option>
												<option value="80">80</option>
												<option value="85">85</option>
												<option value="90">90</option>
												<option value="95">95</option>
												<option value="100">100</option>
											</select>
										</div>
									
									
									<div class="mt-3">
										中區梯次：&emsp;自 <input type="button" class="datetimepicker ml-1 mr-1" id="bach2HT"  value="請選擇時間"  />&emsp;開始
									</div>
									<div class="mt-1">
										&emsp;測驗時間：
										<select id="bach2TimeHT">
												<option value="2">2小時</option>
												<option value="3">3小時</option>
												<option value="4">4小時</option>
												<option value="5">5小時</option>
												<option value="6">6小時</option>
												<option value="7">7小時</option>
												<option value="8">8小時</option>
												<option value="9">9小時</option>
												<option value="12">12小時</option>
												<option value="24">24小時</option>
											</select>
										&emsp;名額：
											<select id="bach2LimitHT">
												<option value="10">10</option>
												<option value="15">15</option>
												<option value="20">20</option>
												<option value="25">25</option>
												<option value="30">30</option>
												<option value="35">35</option>
												<option value="40">40</option>
												<option value="45">45</option>
												<option value="55">55</option>
												<option value="60">60</option>
												<option value="65">65</option>
												<option value="70">70</option>
												<option value="75">75</option>
												<option value="80">80</option>
												<option value="85">85</option>
												<option value="90">90</option>
												<option value="95">95</option>
												<option value="100">100</option>
											</select>
									</div>
									
									<div class="mt-3">
										南區梯次：&emsp;自 <input type="button" class="datetimepicker ml-1 mr-1" id="bach3HT"  value="請選擇時間"  />&emsp;開始
									</div>
									<div class="mt-1">
										&emsp;測驗時間：
										<select id="bach3TimeHT">
												<option value="2">2小時</option>
												<option value="3">3小時</option>
												<option value="4">4小時</option>
												<option value="5">5小時</option>
												<option value="6">6小時</option>
												<option value="7">7小時</option>
												<option value="8">8小時</option>
												<option value="9">9小時</option>
												<option value="12">12小時</option>
												<option value="24">24小時</option>
											</select>
										&emsp;名額：
											<select id="bach3LimitHT">
												<option value="10">10</option>
												<option value="15">15</option>
												<option value="20">20</option>
												<option value="25">25</option>
												<option value="30">30</option>
												<option value="35">35</option>
												<option value="40">40</option>
												<option value="45">45</option>
												<option value="55">55</option>
												<option value="60">60</option>
												<option value="65">65</option>
												<option value="70">70</option>
												<option value="75">75</option>
												<option value="80">80</option>
												<option value="85">85</option>
												<option value="90">90</option>
												<option value="95">95</option>
												<option value="100">100</option>
											</select>
									</div>

<!--
									<div class="mt-1">
										競賽活動：自&emsp;<input type="button" class="datetimepicker ml-1 mr-1" id="preHT"  value="請選擇時間"  />&emsp;開始
										&emsp;※ 不含測驗時間
									</div>
-->

									<div class="mt-3 mx-auto text-center">
										<button class="btn btn-primary" onClick="addEvent()">建立活動</button>
									</div>

								</div>
								
								
								<div class="" id="createHS">	
									<div class="mt-3">
										每校限額：
										<select id="amount">
											<option value="0">不限制</option>
											<option value="1">1隊</option>
											<option value="2">2隊</option>
											<option value="3">3隊</option>
											<option value="4">4隊</option>
											<option value="5">5隊</option>
											<option value="6">6隊</option>
											<option value="7">7隊</option>
											<option value="8">8隊</option>
											<option value="9">9隊</option>
											<option value="10">10隊</option>
										</select>
									</div>
									<div class="mt-3">
										活動期間：&emsp;自 <input type="button" class="datetimepicker ml-1 mr-1" id="startHS"  value="請選擇時間"  />&emsp;至&emsp;<input type="button" class="datetimepicker ml-1" id="endHS"  value="請選擇時間"  />
										&emsp;費用：<input id="feeHS" type="text" maxlength="4" size="5">
									</div>

									<div class="mt-3">
										北區複賽：&emsp;自 <input type="button" class="datetimepicker ml-1 mr-1" id="bach1HS"  value="請選擇時間"  />&emsp;開始
									</div>
									<div class="mt-1">
										&emsp;複賽時間：
										<select id="bach1TimeHS">
											<option value="2">2小時</option>
											<option value="3">3小時</option>
											<option value="4">4小時</option>
											<option value="5">5小時</option>
											<option value="6">6小時</option>
											<option value="7">7小時</option>
											<option value="8">8小時</option>
											<option value="9">9小時</option>
											<option value="12">12小時</option>
											<option value="24">24小時</option>
										</select>
									</div>
									<div class="mt-3">
										北區決賽：&emsp;自 <input type="button" class="datetimepicker ml-1 mr-1" id="bach1FinalsHS"  value="請選擇時間"  />&emsp;開始
									</div>
									
									
									<div class="mt-3">
										中區複賽：&emsp;自 <input type="button" class="datetimepicker ml-1 mr-1" id="bach2HS"  value="請選擇時間"  />&emsp;開始
									</div>
									<div class="mt-1">
										&emsp;複賽時間：
										<select id="bach2TimeHS">
											<option value="2">2小時</option>
											<option value="3">3小時</option>
											<option value="4">4小時</option>
											<option value="5">5小時</option>
											<option value="6">6小時</option>
											<option value="7">7小時</option>
											<option value="8">8小時</option>
											<option value="9">9小時</option>
											<option value="12">12小時</option>
											<option value="24">24小時</option>
										</select>
									</div>
									<div class="mt-3">
										中區決賽：&emsp;自 <input type="button" class="datetimepicker ml-1 mr-1" id="bach2FinalsHS"  value="請選擇時間"  />&emsp;開始
									</div>
									
									<div class="mt-3">
										南區複賽：&emsp;自 <input type="button" class="datetimepicker ml-1 mr-1" id="bach3HS"  value="請選擇時間"  />&emsp;開始
									</div>
									<div class="mt-1">
										&emsp;複賽時間：
										<select id="bach3TimeHS">
											<option value="2">2小時</option>
											<option value="3">3小時</option>
											<option value="4">4小時</option>
											<option value="5">5小時</option>
											<option value="6">6小時</option>
											<option value="7">7小時</option>
											<option value="8">8小時</option>
											<option value="9">9小時</option>
											<option value="12">12小時</option>
											<option value="24">24小時</option>
										</select>
									</div>
									<div class="mt-3">
										南區決賽：&emsp;自 <input type="button" class="datetimepicker ml-1 mr-1" id="bach3FinalsHS"  value="請選擇時間"  />&emsp;開始
									</div>

<!--
									<div class="mt-2">
										競賽初賽：&emsp;自 <input type="button" class="datetimepicker ml-1 mr-1" id="preHS"  value="請選擇時間"  />&emsp;開始
									</div>
-->

<!--
									<div class="mt-2">
										決賽時間：&emsp;自 <input type="button" class="datetimepicker ml-1 mr-1" id="finalHS"  value="請選擇時間"  />&emsp;開始
									</div>
									
									<div class="">
										
									</div>
-->

									<div class="mt-3 mx-auto text-center">
										<button class="btn btn-primary buttonFail" onClick="addEvent()">建立活動</button>
									</div>

								</div>
								
								
							</div>
							
							
<!-- 檢視活動／刪除活動 -->
							
							<div class="col-md-4 br-1">
								
								<div class="text-center h3">刪除活動</div>
								
								<div class="mt-2">
									<lebel for=""></lebel>
									<select id="eventProjectNO" style="width: 100%;">
										<option value="">請選擇...</option>
										<?php
											$strDel = "SELECT projectNO, projectName FROM histock_eventList ORDER BY id DESC ";
											$listDel = mysql_query($strDel,$sqlLink);
											while(list($projectNO,$projectName) = mysql_fetch_row($listDel))
											{
											echo "<option value=".$projectNO.">".$projectNO."：".$projectName."</option>\n";
											}
										?> 
									</select>
								</div>
								
								<div class="mt-3 mx-auto text-center">
									<button class="btn btn-danger buttonFail" onClick="eventDel()">刪除活動</button>
								</div>
								
							</div>

							
<!-- 產生試卷 -->
							<div class="col-md-4">
								
								<div class="text-center h3">建立試卷</div>
								
								<div class="mt-2">
									<lebel class="">Ａ區出題數：</lebel>
									<select id="selectA">
										<option value="0" selected="selected">0</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
										<option value="11">11</option>
										<option value="12">12</option>
										<option value="13">13</option>
										<option value="14">14</option>
										<option value="15">15</option>
										<option value="16">16</option>
										<option value="17">17</option>
										<option value="18">18</option>
										<option value="19">19</option>
										<option value="20">20</option>
									</select>
									
									<lebel class="ml-2">Ｂ區出題數：</lebel>
									<select id="selectB">
										<option value="0" selected="selected">0</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
										<option value="11">11</option>
										<option value="12">12</option>
										<option value="13">13</option>
										<option value="14">14</option>
										<option value="15">15</option>
										<option value="16">16</option>
										<option value="17">17</option>
										<option value="18">18</option>
										<option value="19">19</option>
										<option value="20">20</option>
									</select>
									
									<lebel class="ml-2">Ｃ區出題數：</lebel>
									<select id="selectC">
										<option value="0" selected="selected">0</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
										<option value="11">11</option>
										<option value="12">12</option>
										<option value="13">13</option>
										<option value="14">14</option>
										<option value="15">15</option>
										<option value="16">16</option>
										<option value="17">17</option>
										<option value="18">18</option>
										<option value="19">19</option>
										<option value="20">20</option>
									</select>
									
								</div>
								
								<div class="mt-1">

									
									<lebel>Ｄ區出題數：</lebel>
									<select id="selectD">
										<option value="0" selected="selected">0</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
										<option value="11">11</option>
										<option value="12">12</option>
										<option value="13">13</option>
										<option value="14">14</option>
										<option value="15">15</option>
										<option value="16">16</option>
										<option value="17">17</option>
										<option value="18">18</option>
										<option value="19">19</option>
										<option value="20">20</option>
									</select>
									
									<lebel class="ml-2">Ｅ區出題數：</lebel>
									<select id="selectE">
										<option value="0" selected="selected">0</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
										<option value="11">11</option>
										<option value="12">12</option>
										<option value="13">13</option>
										<option value="14">14</option>
										<option value="15">15</option>
										<option value="16">16</option>
										<option value="17">17</option>
										<option value="18">18</option>
										<option value="19">19</option>
										<option value="20">20</option>
									</select>
									
									<lebel class="ml-2">Ｆ區出題數：</lebel>
									<select id="selectF">
										<option value="0" selected="selected">0</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
										<option value="11">11</option>
										<option value="12">12</option>
										<option value="13">13</option>
										<option value="14">14</option>
										<option value="15">15</option>
										<option value="16">16</option>
										<option value="17">17</option>
										<option value="18">18</option>
										<option value="19">19</option>
										<option value="20">20</option>
									</select>
									
								</div>
								
								<div class="mt-1">
									<lebel>總試卷數：</lebel>
									<select id="paperAll">
										<option value="10">10</option>
										<option value="15">15</option>
										<option value="20">20</option>
										<option value="25">25</option>
										<option value="30">30</option>
										<option value="35">35</option>
										<option value="40">40</option>
										<option value="45">45</option>
										<option value="55">55</option>
										<option value="60">60</option>
										<option value="65">65</option>
										<option value="70">70</option>
										<option value="75">75</option>
										<option value="80">80</option>
										<option value="85">85</option>
										<option value="90">90</option>
										<option value="95">95</option>
										<option value="100">100</option>
										<option value="200">200</option>
										<option value="300">300</option>
										<option value="500">500</option>
										<option value="1000">1000</option>
									</select>
								</div>
								
								<div class="text-center h3">目前總出題數：<span id="total"></span></div>
								<div class="mt-3 mx-auto text-center"><button class="btn btn-success" onClick="createNewPaper()">產生試卷</button></div>
								<div class="mx-auto text-center mt-1"><small class="text-muted">※ 系統產生新試卷同時 將刪除之前未使用之試卷</small></div>
								
								<div class="text-left h3 ml-3">總卷數：<span id="ppList"><? echo $PPList; ?></span></div>
								<div class="text-left h3 ml-3">已使用：<span id="ppUsed"><? echo $PPUsed; ?></span></div>
								<div class="text-left h3 ml-3">未使用：<span id="ppLeft"><? echo $PPLeft; ?></span></div>
									
							</div>

						</div>
					</div>
					
					<div class="panel-body text-center h4">
						操作結果：<span id="resultMsg"></span>
					</div>
					
				</div>
			</div>
		</div>


<!-- 活動列表 -->
		<div class="row">
			<div class="col-md-12" id="actArea">
				<div class="panel panel-default">
					
					<div class="panel-heading text-center" style="color:darkred;font-weight: bold;font-size: 22px;font-family: Microsoft JhengHei;">
						<span id="">活動列表</span>
					</div>
			
					<div class="panel-body text-center">
						<table id="histockList" class="table table-hover table-striped table-bordered text-center" style="100%">
							<thead class="thead-dark bg-info">
								<tr>
									<th>流水號</th>
									<th>競賽代號</th>
									<th>報名費用</th>
									<th>開始報名</th>
									<th>截止報名</th>
									<th>北區複賽</th>
									<th>北區決賽</th>
									<th>中區複賽</th>
									<th>中區決賽</th>
									<th>南區複賽</th>
									<th>南區決賽</th>
									<th>限額</th>
								</tr>
							</thead>
							<tbody>	
								
							<?php
							for ($i=1; $i<=mysql_num_rows($dataList); $i++) {
								$row=mysql_fetch_row($dataList);
							?>

								<tr>
									<td><? echo $row[0]; ?></td>
									<td><? echo $row[2]; ?></td>
									<td><? echo $row[4]; ?></td>
									<td><? echo substr($row[5], 0, 16); ?></td>
									<td><? echo substr($row[6], 0, 16); ?></td>
									<td><? echo substr($row[7], 0, 16); ?><br><? echo $row[8]; ?>小時</td>
									<td><? echo substr($row[9], 0, 16) ?></td>
									<td><? echo substr($row[10], 0, 16); ?><br><? echo $row[11]; ?>小時</td>
									<td><? echo substr($row[12], 0, 16) ?></td>
									<td><? echo substr($row[13], 0, 16); ?><br><? echo $row[14]; ?>小時</td>
									<td><? echo substr($row[15], 0, 16) ?></td>
									<td><? echo $row[18]; ?></td>
								</tr>
								
							<?php }?>
							</tbody>
						</table>
					</div>
					
				</div>
			</div>
		</div>			
	
</div>
<!--/.main-->

	

	
	

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="../lumino/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
<script src="../lumino/js/chart.min.js"></script>
<script src="../lumino/js/chart-data.js"></script>
<script src="../lumino/js/easypiechart.js"></script>
<script src="../lumino/js/easypiechart-data.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous"></script>

<!-- DataTables v1.10.16 -->
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>


<!-- 自定義JS -->
<script src="../controller/admin_authority.js"></script>
<script src="../controller/admin_histockAddEvent.js"></script>
<script src="../controller/admin_histockEventDel.js"></script>

<!-- 載入時隱藏選單 -->
<script>
//隱藏選單內容
$(document).ready(function (){
	$("#createHS").hide();
	$("#createHT").hide();
});
//選取時顯示
$("#selectEvent").change(function(){
	if ( $(this).val() == "HT" ){
		$("#createHS").hide();
		$("#createHT").show();
	}else if ( $(this).val() == "HS" ){
		$("#createHT").hide();
		$("#createHS").show();
	}
});		 
</script>
	
	<!-- DataTables -->
<script>
	$("#histockList").dataTable({
		"order": [[ 0, "desc" ]],
		"oLanguage": {
			"sInfoFiltered": " ,從 _MAX_ 筆資料中查得",
			"sLengthMenu": "每次顯示 _MENU_ 筆資料",
			"sInfo":"第 _START_ 至 _END_ 筆資料, 共 _TOTAL_ 筆",
			"sSearch": "搜尋：",
			"oPaginate": {
				"sNext": "下一頁",
				"sPrevious": "上一頁"
			}
		}
	});

	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})
</script>	

	
<!-- Jquery UI DateTimePicker -->
<script>
$(".datetimepicker").datetimepicker({
step: 15,
format: 'Y-m-d H:i'
});
</script>	
	
	
<!-- onChange計算已選題數 -->
<script>
	$("#selectA, #selectB,#selectC,#selectD,#selectE,#selectF").change(function(){
	  var A = $("#selectA").val();
	  var B = $("#selectB").val();
	  var C = $("#selectC").val();
	  var D = $("#selectD").val();
	  var E = $("#selectE").val();
	  var F = $("#selectF").val();
	  var total = parseInt(A)+parseInt(B)+parseInt(C)+parseInt(D)+parseInt(E)+parseInt(F);
	  console.log(total)

	  $("#total").html(total);
	});
</script>
	
	
<!-- 建立題庫 -->
<script>
	
	function createNewPaper() {
		
		var A = $("#selectA").val();
		var B = $("#selectB").val();
		var C = $("#selectC").val();
		var D = $("#selectD").val();
		var E = $("#selectE").val();
		var F = $("#selectF").val();
		var source = $("#selectDBSource").val();
		var paperAll = $("#paperAll").val();
		var total = parseInt(A)+parseInt(B)+parseInt(C)+parseInt(D)+parseInt(E)+parseInt(F)
		
		if((total)!==50 ){
			$("#resultMsg").html("建立試卷總題數必須為50！");
			return;
		}
		
		$.ajax({

			url:"https://wmpcca.com/bswmp/form/model/admin_createNewPaper_HS.php",
			data:{
				"selectA" : A,
				"selectB" : B,
				"selectC" : C,
				"selectD" : D,
				"selectE" : E,
				"selectF" : F,
				"paperAll" : paperAll
			},

			method : "POST",

			error : function(msg){
				alert(msg);
			},

			success : function(msg){
				alert(msg);
				window.location.reload();
				}
		});
	}
		
</script>
	
</body>

</html>

