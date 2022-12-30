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

//定義refund搜尋條件
$refund1 = mysql_query("select * from orderList WHERE payStatus = '已退費' ORDER BY id DESC ");//從OrderList中選取全部(已退費)的資料
$refund2 = mysql_query("select * from receiptList WHERE payStatus = '已退費' ORDER BY id DESC ");//從ReceiptList中選取全部(已作廢)的資料

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

<link href="../lumino/css/styles.css" rel="stylesheet">

<style>
	.hidden{
		display: none;
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
				<li>進階功能/報名編修</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">競賽報名資料編修</h1>
			</div>
		</div><!--/.row-->
				
<!-- 增補報名隊伍 -->
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading text-center" style="color:darkred;font-weight: bold;font-size: 22px;font-family: Microsoft JhengHei;">
						<span id="">增補報名隊伍</span>
					</div>
	
					<div class="panel-body">
						
						<div class="row mx-auto text-center">
							<select name="" id="selectCompet">	
							<option value="">請選擇...</option>
								<?php
									$str = "SELECT projectNO, projectName FROM competList GROUP BY id DESC LIMIT 3";
									$list = mysql_query($str,$sqlLink);
									while(list($projectNO,$projectName) = mysql_fetch_row($list))
									{
									echo "<option value=".$projectNO.">".$projectNO."：".$projectName."</option>\n";
									}
								?> 
							</select>
							<button class="btn-info" id="" onClick="getProjectNO()">繼續</button>
						</div>
						
							<!-- 增補報名 >> 社會組 -->
						<div class="row hidden" id="sinupSocial" style="padding-top: 10px;padding-bottom: 10px;">
							
							<div class="col-md-6" style="border-right:1px #E0E0E0 solid;">
								
								<div style="padding-bottom: 5px;">
									<label for="">隊伍名稱：</label>
									<input type="text" name="" class="" id="singupSocialTeamName" maxlength="8">
								</div>
								<div style="padding-bottom: 5px;">
									<label for="">隊長姓名：</label>
									<input type="text" name="" class="" id="singupSocialCaptainName">
								</div>
								<div style="padding-bottom: 5px;">
									<label for="">身份證字號：</label>
									<input type="text" name="" class="" id="singupSocialCaptainIdentifyNO">
								</div>
								<div style="padding-bottom: 5px;">
									<label for="">Email：</label>
									<input type="text" name="" class="" id="singupSocialCaptainEmail" size="50">
								</div>
								<div class="text-center">
									<button class="btn-info" id="" onClick="socialSingup()">增補隊伍</button>
								</div>
								
							</div>
							
							<div class="col-md-6">
								<p class="h4">操作結果：</p>
								<p class="h2 text-danger" id="signupSocialReturnTeamNO"></p>
								<p class="h3 text-danger" id="signupSocialResultMsg"></p>
							</div>
							
						</div>
						
							<!-- 增補報名 >> 大專組 -->
						<div class="row hidden" id="sinupCollege" style="padding-top: 20px;padding-bottom: 10px;">
							
							<div class="col-md-6" style="border-right:1px #E0E0E0 solid;">
								<div style="padding-bottom: 5px;">
									<label for="">代表學校：</label>
									<select name="selectDistrict" class="" id="schoolDistrict"></select>
									<select name="schoolPre" class="" id="schoolPre"><option value="">請選擇...</option></select>
								</div>
								<div style="padding-bottom: 5px;">
									<label for="">隊伍名稱：</label>
									<input type="text" name="" class="" id="singupCollegeTeamName" maxlength="8">
								</div>
								<div style="padding-bottom: 5px;">
									<label for="">指導老師：</label>
									<input type="text" name="" class="" id="singupCollegeTeacher">
								</div>
								<div style="padding-bottom: 5px;">
									<label for="">隊長姓名：</label>
									<input type="text" name="" class="" id="singupCollegeCaptainName">
								</div>
								<div style="padding-bottom: 5px;">
									<label for="">身份證字號：</label>
									<input type="text" name="" class="" id="singupCollegeCaptainIdentifyNO">
								</div>
								<div style="padding-bottom: 5px;">
									<label for="">Email：</label>
									<input type="text" name="" class="" id="singupCollegeCaptainEmail" size="50">
								</div>
								<div style="padding-bottom: 5px;">
									<label for="">Advisor：</label>
									<select name="singupCollegeCaptainAdvisor" class="" id="singupCollegeCaptainAdvisor">
										<option value="">不需顧問</option>
										<option value="NEED">安排顧問</option>
									</select>
								</div>
								<div class="text-center">
									<button class="btn-info" id="" onClick="collegeSingup()">增補隊伍</button>
								</div>
							</div>
							
							<div class="col-md-6">
								<p class="h4">操作結果：</p>
								<p class="h2 text-danger" id="signupCollegeReturnTeamNO"></p>
								<p class="h3 text-danger" id="signupCollegeResultMsg"></p>
							</div>

						</div>
						
						<div class="row hidden" id="sinupHighscool" style="padding-top: 10px;padding-bottom: 10px;">
							
						</div>
						
					</div>
				</div>
			</div>
		</div><!--/.row-->
		

		
<!-- 編修隊伍及成員 -->
		<div class="row">
			
			<div class="col-md-12" id="">
				<div class="panel panel-default">
					
					<div class="panel-heading text-center" style="color:darkred;font-weight: bold;font-size: 22px;font-family: Microsoft JhengHei;">
						<span id="">編修隊伍資料 (含退費)</span>
					</div>

					<div class="panel-body" style="border-bottom: 1px #E0E0E0 solid;">
						<div class="row mx-auto text-center">
							<div class="col mx-auto text-center">
								<input type="text" placeholder="輸入隊伍編號" id="getTeamNO">
								<button class="btn-info" id="" onClick="getTeamData()">繼續</button>
							</div>
						</div>
					</div>
					
					<div class="panel-body">
						
						<div class="row hidden" id="editSocial">
							
								<!-- 隊伍資料 >> 社會組 -->
							<div class="col-md-3" style="border-right:1px #E0E0E0 solid;">
								
								<div class="h4 text-center text-primary">隊伍資料</div>
								
								<div>
									<label for="">隊伍編號：</label>
									<input type="text" name="teamNO_social" class="" id="teamNO_social" disabled>
								</div>
								<div>
									<label for="">隊伍名稱：</label>
									<input type="text" name="teamName_social" class="" id="teamName_social" disabled>
								</div>
								<div>
									<label for="">繳費狀態：</label>
									<input type="text" name="payStatus_social" class="" id="payStatus_social">
								</div>
								<div>
									<label for="">繳費方式：</label>
									<select name="payWay_social" class="" id="payWay_social">
										<option value="匯款轉帳">匯款轉帳</option>
										<option value="現金存入">現金存入</option>
									</select>
								</div>
								<div>
									<label for="">繳款來源：</label>
									<input type="text" name="vAccount_social" class="" id="vAccount_social">
								</div>
								<div>
									<label for="">繳費日期：</label>
									<input type="text" name="payTime_social" class="datepicker" id="payTime_social">
								</div>
								<div>
									<label for="">繳費金額：</label>
									<input type="text" name="MN_social" class="" id="MN_social">
								</div>
								<div class="" style="margin-top: 10px;">
									<button class="btn-success" id="editTeamInfoButton" onClick="editTeamInfo()" style="margin-left: 10px;">儲存修改</button>
									<button class="btn-danger" id="" onClick="delTeamInfo()" style="margin-left: 10px;">取消報名</button>
									<button class="btn-warning" id="" onClick="refund()" style="margin-left: 10px;">完成退費</button>
								</div>
								<div class="text-center text-danger" id="editTeamMsg_social" style="margin-top: 10px;"></div>
							</div>
							
								<!-- 隊長資料 >> 社會組 -->
							<div class="col-md-3" style="border-right:1px #E0E0E0 solid;">

								<div class="h4 text-center text-primary">隊長資料</div>
								
								<div>
									<label for="">姓名：</label>
									<input type="text" name="captainName_social" class="" id="captainName_social">
								</div>
								<div>
									<label for="">稱謂：</label>
									<select name="captainSex_social" class="" id="captainSex_social">
										<option value="女士">女士</option>
										<option value="先生">先生</option>
									</select>
								</div>
								<div>
									<label for="">　ID：</label>
									<input type="text" name="captainID_social" class="" id="captainID_social">
								</div>
								<div>
									<label for="">生日：</label>
									<input type="text" name="captainBirth_social" class="datepicker" id="captainBirth_social">
								</div>
								<div>
									<label for="">電話：</label>
									<input type="text" name="captainPhone_social" class="" id="captainPhone_social">
								</div>
								<div>
									<label for="">Mail：</label>
									<input type="text" name="captainEmail_social" class="" id="captainEmail_social">
								</div>
								<div>
									<label for="">城市：</label>
									<select name="captainCity_social" class="" id="captainCity">
										<option id="captainCityOption-Social"></option>
									</select>
								</div>
								<div>
									<label for="">區域：</label>
									<select name="captainDistrict_social" class="" id="captainDistrict">
										<option id="captainDistrictOption-Social"></option>
									</select>
								</div>
								<div>
									<label for="">地址：</label>
									<input type="text" name="captainAddr_social" class="" id="captainAddr_social">
								</div>
								<div>
									<label for="">產業：</label>
									<select class="custom-select mr-sm-2" name="captainJob" id="captainJob">
										<option value="農林漁牧業">農、林、漁、牧業</option>
										<option value="礦業及土石採取業">礦業及土石採取業</option>
										<option value="製造業">製造業</option>
										<option value="電力及燃氣供應業">電力及燃氣供應業</option>
										<option value="用水供應及污染整治業">用水供應及污染整治業</option>
										<option value="營建工程業">營建工程業</option>
										<option value="批發及零售業">批發及零售業</option>
										<option value="運輸及倉儲業">運輸及倉儲業</option>
										<option value="住宿及餐飲業">住宿及餐飲業</option>
										<option value="出版影音製作傳播及資通訊服務業">出版、影音製作、傳播及資通訊服務業</option>
										<option value="金融及保險業">金融及保險業</option>
										<option value="不動產業">不動產業</option>
										<option value="專業、科學及技術服務業">專業、科學及技術服務業</option>
										<option value="支援服務業">支援服務業</option>
										<option value="公共行政及國防強制性社會安全">公共行政及國防；強制性社會安全</option>
										<option value="教育業">教育業</option>
										<option value="醫療保健及社會工作服務業">醫療保健及社會工作服務業</option>
										<option value="藝術、娛樂及休閒服務業">藝術、娛樂及休閒服務業</option>
										<option value="其他服務業">其他服務業</option>
									</select>
								</div>
								<div>
									<label for="">職務：</label>
									<select class="custom-select mr-sm-2" name="captainTitle" id="captainTitle">
										<option value="民意代表、高階主管、總執行長">民意代表、高階主管、總執行長</option>
										<option value="行政及商業經理人員">行政及商業經理人員</option>
										<option value="生產及專業服務經理人員">生產及專業服務經理人員</option>
										<option value="餐旅、零售及其他場所服務經理人員">餐旅、零售及其他場所服務經理人員</option>
										<option value="專業人員">專業人員</option>
										<option value="技術員及助理專業人員">技術員及助理專業人員</option>
										<option value="事務支援人員">事務支援人員</option>
										<option value="服務及銷售工作人員">服務及銷售工作人員</option>
										<option value="農林漁牧業生產人員">農林漁牧業生產人員</option>
										<option value="技藝有關工作人員">技藝有關工作人員</option>
										<option value="機械設備操作及組裝人員">機械設備操作及組裝人員</option>
										<option value="基層技術工及勞力工">基層技術工及勞力工</option>
										<option value="軍人">軍人</option>
									</select>
								</div>
								<div>
									<label for="">年資：</label>
									<select class="custom-select mr-sm-2" name="captainYear" id="captainYear">
										<option value="1年以下">1年以下</option>
										<option value="1到3年">1-3年</option>
										<option value="3到5年">3-5年</option>
										<option value="5到7年">5-7年</option>
										<option value="7到10年">7-10年</option>
										<option value="10到15年">10-15年</option>
										<option value="15年以上">15年以上</option>
									</select>
								</div>
								<div class="text-center" style="margin-top: 10px;">
									<button class="btn-success" id="" onClick="EditCompetCaptainSocial()">儲存修改</button>
									<div id="editCaptainMsg_social"></div>
								</div>
								
							</div>
							
								<!-- 副手資料 >> 社會組 -->							
							<div class="col-md-3" style="border-right:1px #E0E0E0 solid;">
								
								<div class="h4 text-center text-primary">副手資料</div>
								
								<div>
									<label for="">姓名：</label>
									<input type="text" name="member1Name_social" class="" id="member1Name_social">
								</div>
								<div>
									<label for="">稱謂：</label>
									<select name="member1Sex_social" class="" id="member1Sex_social">
										<option value="女士">女士</option>
										<option value="先生">先生</option>
									</select>
								</div>
								<div>
									<label for="">　ID：</label>
									<input type="text" name="member1ID_social" class="" id="member1ID_social">
								</div>
								<div>
									<label for="">生日：</label>
									<input type="text" name="member1Birth_social" class="datepicker" id="member1Birth_social">
								</div>
								<div>
									<label for="">電話：</label>
									<input type="text" name="member1Phone_social" class="" id="member1Phone_social">
								</div>
								<div>
									<label for="">Mail：</label>
									<input type="text" name="member1Email_social" class="" id="member1Email_social">
								</div>
								<div>
									<label for="">城市：</label>
									<select name="member1City_social" class="" id="member1City">
										<option id="member1CityOption-Social"></option>
									</select>
								</div>
								<div>
									<label for="">區域：</label>
									<select name="member1District_social" class="" id="member1District">
										<option id="member1DistrictOption-Social"></option>
									</select>
								</div>
								<div>
									<label for="">地址：</label>
									<input type="text" name="member1Addr_social" class="" id="member1Addr_social">
								</div>
								<div>
									<label for="">產業：</label>
									<select class="custom-select mr-sm-2" name="member1Job" id="member1Job">
										<option value="農林漁牧業">農、林、漁、牧業</option>
										<option value="礦業及土石採取業">礦業及土石採取業</option>
										<option value="製造業">製造業</option>
										<option value="電力及燃氣供應業">電力及燃氣供應業</option>
										<option value="用水供應及污染整治業">用水供應及污染整治業</option>
										<option value="營建工程業">營建工程業</option>
										<option value="批發及零售業">批發及零售業</option>
										<option value="運輸及倉儲業">運輸及倉儲業</option>
										<option value="住宿及餐飲業">住宿及餐飲業</option>
										<option value="出版影音製作傳播及資通訊服務業">出版、影音製作、傳播及資通訊服務業</option>
										<option value="金融及保險業">金融及保險業</option>
										<option value="不動產業">不動產業</option>
										<option value="專業、科學及技術服務業">專業、科學及技術服務業</option>
										<option value="支援服務業">支援服務業</option>
										<option value="公共行政及國防強制性社會安全">公共行政及國防；強制性社會安全</option>
										<option value="教育業">教育業</option>
										<option value="醫療保健及社會工作服務業">醫療保健及社會工作服務業</option>
										<option value="藝術、娛樂及休閒服務業">藝術、娛樂及休閒服務業</option>
										<option value="其他服務業">其他服務業</option>
									</select>
								</div>
								<div>
									<label for="">職務：</label>
									<select class="custom-select mr-sm-2" name="member1Title" id="member1Title">
										<option value="民意代表、高階主管、總執行長">民意代表、高階主管、總執行長</option>
										<option value="行政及商業經理人員">行政及商業經理人員</option>
										<option value="生產及專業服務經理人員">生產及專業服務經理人員</option>
										<option value="餐旅、零售及其他場所服務經理人員">餐旅、零售及其他場所服務經理人員</option>
										<option value="專業人員">專業人員</option>
										<option value="技術員及助理專業人員">技術員及助理專業人員</option>
										<option value="事務支援人員">事務支援人員</option>
										<option value="服務及銷售工作人員">服務及銷售工作人員</option>
										<option value="農林漁牧業生產人員">農林漁牧業生產人員</option>
										<option value="技藝有關工作人員">技藝有關工作人員</option>
										<option value="機械設備操作及組裝人員">機械設備操作及組裝人員</option>
										<option value="基層技術工及勞力工">基層技術工及勞力工</option>
										<option value="軍人">軍人</option>
									</select>
								</div>
								<div>
									<label for="">年資：</label>
									<select class="custom-select mr-sm-2" name="member1Year" id="member1Year">
										<option value="1年以下">1年以下</option>
										<option value="1到3年">1-3年</option>
										<option value="3到5年">3-5年</option>
										<option value="5到7年">5-7年</option>
										<option value="7到10年">7-10年</option>
										<option value="10到15年">10-15年</option>
										<option value="15年以上">15年以上</option>
									</select>
								</div>
								<div class="text-center" style="margin-top: 10px;">
									<button class="btn-success" id="" onClick="EditCompetmember1Social()">儲存修改</button>
									<button class="btn-danger" id="" onClick="delCompetmember1Social()">刪除隊員</button>
									<div id="editMember1Msg_social"></div>
								</div>
								
							</div>
							
								<!-- 隊員資料 >> 社會組 -->
							<div class="col-md-3">
								
								<div class="h4 text-center text-primary">隊員資料</div>
								
								<div>
									<label for="">姓名：</label>
									<input type="text" name="member2Name_social" class="" id="member2Name_social">
								</div>
								<div>
									<label for="">稱謂：</label>
									<select name="member2Sex_social" class="" id="member2Sex_social">
										<option value="女士">女士</option>
										<option value="先生">先生</option>
									</select>
								</div>
								<div>
									<label for="">　ID：</label>
									<input type="text" name="member2ID_social" class="" id="member2ID_social">
								</div>
								<div>
									<label for="">生日：</label>
									<input type="text" name="member2Birth_social" class="datepicker" id="member2Birth_social">
								</div>
								<div>
									<label for="">電話：</label>
									<input type="text" name="member2Phone_social" class="" id="member2Phone_social">
								</div>
								<div>
									<label for="">Mail：</label>
									<input type="text" name="member2Email_social" class="" id="member2Email_social">
								</div>
								<div>
									<label for="">城市：</label>
									<select name="member2City_social" class="" id="member2City">
										<option id="member2CityOption-Social"></option>
									</select>
								</div>
								<div>
									<label for="">區域：</label>
									<select name="member2District_social" class="" id="member2District">
										<option id="member2DistrictOption-Social"></option>
									</select>
								</div>
								<div>
									<label for="">地址：</label>
									<input type="text" name="member2Addr_social" class="" id="member2Addr_social">
								</div>
								<div>
									<label for="">產業：</label>
									<select class="custom-select mr-sm-2" name="member2Job" id="member2Job">
										<option value="農林漁牧業">農、林、漁、牧業</option>
										<option value="礦業及土石採取業">礦業及土石採取業</option>
										<option value="製造業">製造業</option>
										<option value="電力及燃氣供應業">電力及燃氣供應業</option>
										<option value="用水供應及污染整治業">用水供應及污染整治業</option>
										<option value="營建工程業">營建工程業</option>
										<option value="批發及零售業">批發及零售業</option>
										<option value="運輸及倉儲業">運輸及倉儲業</option>
										<option value="住宿及餐飲業">住宿及餐飲業</option>
										<option value="出版影音製作傳播及資通訊服務業">出版、影音製作、傳播及資通訊服務業</option>
										<option value="金融及保險業">金融及保險業</option>
										<option value="不動產業">不動產業</option>
										<option value="專業、科學及技術服務業">專業、科學及技術服務業</option>
										<option value="支援服務業">支援服務業</option>
										<option value="公共行政及國防強制性社會安全">公共行政及國防；強制性社會安全</option>
										<option value="教育業">教育業</option>
										<option value="醫療保健及社會工作服務業">醫療保健及社會工作服務業</option>
										<option value="藝術、娛樂及休閒服務業">藝術、娛樂及休閒服務業</option>
										<option value="其他服務業">其他服務業</option>
									</select>
								</div>
								<div>
									<label for="">職務：</label>
									<select class="custom-select mr-sm-2" name="member2Title" id="member2Title">
										<option value="民意代表、高階主管、總執行長">民意代表、高階主管、總執行長</option>
										<option value="行政及商業經理人員">行政及商業經理人員</option>
										<option value="生產及專業服務經理人員">生產及專業服務經理人員</option>
										<option value="餐旅、零售及其他場所服務經理人員">餐旅、零售及其他場所服務經理人員</option>
										<option value="專業人員">專業人員</option>
										<option value="技術員及助理專業人員">技術員及助理專業人員</option>
										<option value="事務支援人員">事務支援人員</option>
										<option value="服務及銷售工作人員">服務及銷售工作人員</option>
										<option value="農林漁牧業生產人員">農林漁牧業生產人員</option>
										<option value="技藝有關工作人員">技藝有關工作人員</option>
										<option value="機械設備操作及組裝人員">機械設備操作及組裝人員</option>
										<option value="基層技術工及勞力工">基層技術工及勞力工</option>
										<option value="軍人">軍人</option>
									</select>
								</div>
								<div>
									<label for="">年資：</label>
									<select class="custom-select mr-sm-2" name="member2Year" id="member2Year">
										<option value="1年以下">1年以下</option>
										<option value="1到3年">1-3年</option>
										<option value="3到5年">3-5年</option>
										<option value="5到7年">5-7年</option>
										<option value="7到10年">7-10年</option>
										<option value="10到15年">10-15年</option>
										<option value="15年以上">15年以上</option>
									</select>
								</div>
								<div class="text-center" style="margin-top: 10px;">
									<button class="btn-success" id="" onClick="EditCompetmember2Social()">儲存修改</button>
									<button class="btn-danger" id="" onClick="delCompetmember2Social()">刪除隊員</button>
									<div id="editMember2Msg_Social"></div>
								</div>
								
							</div>
							
						</div>
						
						<div class="row hidden" id="editCollege">
							
								<!-- 隊伍資料 >> 大專組 -->
							<div class="col-md-3" style="border-right:1px #E0E0E0 solid;">
								
								<div class="h4 text-center text-primary">隊伍資料</div>
								
								<div>
									<label for="">隊伍編號：</label>
									<input type="text" name="teamNO_college" class="" id="teamNO_college" disabled>
								</div>
								<div>
									<label for="">隊伍名稱：</label>
									<input type="text" name="teamName_college" class="" id="teamName_college" disabled>
								</div>
								<div>
									<label for="">代表學校：</label>
									<input type="text" name="schoolID" class="" id="schoolID" disabled>
								</div>
								<div>
									<label for="">指導老師：</label>
									<input type="text" name="teacher_college" class="" id="teacher_college">
								</div>
								<div>
									<label for="">繳費狀態：</label>
									<input type="text" name="payStatus_college" class="" id="payStatus_college">
								</div>
								<div>
									<label for="">繳費方式：</label>
									<select name="payWay_college" class="" id="payWay_college">
										<option value="匯款轉帳">匯款轉帳</option>
										<option value="現金存入">現金存入</option>
									</select>
								</div>
								<div>
									<label for="">繳款來源：</label>
									<input type="text" name="vAccount_college" class="" id="vAccount_college">
								</div>
								<div>
									<label for="">繳費日期：</label>
									<input type="text" name="payTime_college" class="datepicker" id="payTime_college">
								</div>
								<div>
									<label for="">繳費金額：</label>
									<input type="text" name="MN_college" class="" id="MN_college">
								</div>
								<div class="" style="margin-top: 10px;">
									<button class="btn-success" id="" onClick="editTeamInfo()" style="margin-left: 10px;">儲存修改</button>
									<button class="btn-danger" id="" onClick="delTeamInfo()" style="margin-left: 10px;">取消報名</button>
									<button class="btn-warning" id="" onClick="refund()" style="margin-left: 10px;">完成退費</button>
								</div>
								<div class="text-center text-danger" id="editTeamMsg_college" style="margin-top: 10px;"></div>
							</div>
							
								<!-- 隊長資料 >> 大專組 -->
							<div class="col-md-3" style="border-right:1px #E0E0E0 solid;">
								
								<div class="h4 text-center text-primary">隊長資料</div>
								
								<div>
									<label for="">姓名：</label>
									<input type="text" name="captainName_college" class="" id="captainName_college">
								</div>
								<div>
									<label for="">稱謂：</label>
									<select name="captainSex_college" class="" id="captainSex_college">
										<option value="女士">女士</option>
										<option value="先生">先生</option>
									</select>
								</div>
								<div>
									<label for="">　ID：</label>
									<input type="text" name="captainID_college" class="" id="captainID_college">
								</div>
								<div>
									<label for="">生日：</label>
									<input type="text" name="captainBirth_college" class="datepicker" id="captainBirth_college">
								</div>
								<div>
									<label for="">電話：</label>
									<input type="text" name="captainPhone_college" class="" id="captainPhone_college">
								</div>
								<div>
									<label for="">Mail：</label>
									<input type="text" name="captainEmail_college" class="" id="captainEmail_college">
								</div>
								<div>
									<label for="">城市：</label>
									<select name="captainCity_college" class="" id="captainCity-College">
										<option id="captainCityOption-College"></option>
									</select>
								</div>
								<div>
									<label for="">區域：</label>
									<select name="captainDistrict_college" class="" id="captainDistrict-College">
										<option id="captainDistrictOption-College"></option>
									</select>
								</div>
								<div>
									<label for="">地址：</label>
									<input type="text" name="captainAddr_college" class="" id="captainAddr_college">
								</div>
								<div>
									<label for="">院所：</label>
									<select name="captainCollege" class="" id="captainCollege">
										<option id="captainCollegeOption"></option>
									</select>
								</div>
								<div>
									<label for="">科系：</label>
									<select name="captainDepart" class="" id="captainDepart">
										<option id="captainDepartOption"></option>
									</select>
								</div>
								<div>
									<label for="">學位：</label>
										<select name="captainDegree" class="" id="captainDegree">
											<option value="五專">五專</option>
											<option value="二專">二專</option>
											<option value="四技">四技</option>
											<option value="二技">二技</option>
											<option value="學士">學士</option>
											<option value="碩士">碩士</option>
											<option value="博士">博士</option>
										</select>
								</div>
								<div>
									<label for="">年級：</label>
									<select name="captainGrade_college" id="captainGrade_college">
										<option value="一年級">一年級</option>
										<option value="二年級">二年級</option>
										<option value="三年級">三年級</option>
										<option value="四年級">四年級</option>
										<option value="五年級">五年級</option>
										<option value="六年級">六年級</option>
										<option value="七年級">七年級</option>
									</select>
								</div>
								<div class="text-center" style="margin-top: 10px;">
									<button class="btn-success" id="" onClick="EditCompetcaptainCollege()">儲存修改</button>
									<div id="editCaptainMsg_college"></div>
								</div>
								
							</div>
							
								<!-- 副手資料 >> 大專組 -->
							<div class="col-md-3" style="border-right:1px #E0E0E0 solid;">
								
								<div class="h4 text-center text-primary">副手資料</div>
								
								<div>
									<label for="">姓名：</label>
									<input type="text" name="member1Name_college" class="" id="member1Name_college">
								</div>
								<div>
									<label for="">稱謂：</label>
									<select name="member1Sex_college" class="" id="member1Sex_college">
										<option value="女士">女士</option>
										<option value="先生">先生</option>
									</select>
								</div>
								<div>
									<label for="">　ID：</label>
									<input type="text" name="member1ID_college" class="" id="member1ID_college">
								</div>
								<div>
									<label for="">生日：</label>
									<input type="text" name="member1Birth_college" class="datepicker" id="member1Birth_college">
								</div>
								<div>
									<label for="">電話：</label>
									<input type="text" name="member1Phone_college" class="" id="member1Phone_college">
								</div>
								<div>
									<label for="">Mail：</label>
									<input type="text" name="member1Email_college" class="" id="member1Email_college">
								</div>
								<div>
									<label for="">城市：</label>
									<select name="member1City_college" class="" id="member1City-College">
										<option id="member1CityOption-College"></option>
									</select>
								</div>
								<div>
									<label for="">區域：</label>
									<select name="member1District_college" class="" id="member1District-College">
										<option id="member1DistrictOption-College"></option>
									</select>
								</div>
								<div>
									<label for="">地址：</label>
									<input type="text" name="member1Addr_college" class="" id="member1Addr_college">
								</div>
								<div>
									<label for="">院所：</label>
									<select name="member1College" class="" id="member1College">
										<option id="member1CollegeOption"></option>
									</select>
								</div>
								<div>
									<label for="">科系：</label>
									<select name="member1Depart" class="" id="member1Depart">
										<option id="member1DepartOption"></option>
									</select>
								</div>
								<div>
									<label for="">學位：</label>
										<select name="member1Degree" class="" id="member1Degree">
											<option value="五專">五專</option>
											<option value="二專">二專</option>
											<option value="四技">四技</option>
											<option value="二技">二技</option>
											<option value="學士">學士</option>
											<option value="碩士">碩士</option>
											<option value="博士">博士</option>
										</select>
								</div>
								<div>
									<label for="">年級：</label>
									<select name="member1Grade_college" id="member1Grade_college">
										<option value="一年級">一年級</option>
										<option value="二年級">二年級</option>
										<option value="三年級">三年級</option>
										<option value="四年級">四年級</option>
										<option value="五年級">五年級</option>
										<option value="六年級">六年級</option>
										<option value="七年級">七年級</option>
									</select>
								</div>
								<div class="text-center" style="margin-top: 10px;">
									<button class="btn-success" id="" onClick="EditCompetmember1()">儲存修改</button>
									<button class="btn-danger" id="" onClick="delCompetmember1College()">刪除副手</button>
									<div id="editMember1Msg_college"></div>
								</div>
								
							</div>
							
								<!-- 隊員資料 >> 大專組 -->
							<div class="col-md-3">
								
								<div class="h4 text-center text-primary">隊員資料</div>
								
								<div>
									<label for="">姓名：</label>
									<input type="text" name="member2Name_college" class="" id="member2Name_college">
								</div>
								<div>
									<label for="">稱謂：</label>
									<select name="member2Sex_college" class="" id="member2Sex_college">
										<option value="女士">女士</option>
										<option value="先生">先生</option>
									</select>
								</div>
								<div>
									<label for="">　ID：</label>
									<input type="text" name="member2ID_college" class="" id="member2ID_college">
								</div>
								<div>
									<label for="">生日：</label>
									<input type="text" name="member2Birth_college" class="datepicker" id="member2Birth_college">
								</div>
								<div>
									<label for="">電話：</label>
									<input type="text" name="member2Phone_college" class="" id="member2Phone_college">
								</div>
								<div>
									<label for="">Mail：</label>
									<input type="text" name="member2Email_college" class="" id="member2Email_college">
								</div>
								<div>
									<label for="">城市：</label>
									<select name="member2City_college" class="" id="member2City-College">
										<option id="member2CityOption-College"></option>
									</select>
								</div>
								<div>
									<label for="">區域：</label>
									<select name="member2District_college" class="" id="member2District-College">
										<option id="member2DistrictOption-College"></option>
									</select>
								</div>
								<div>
									<label for="">地址：</label>
									<input type="text" name="member2Addr_college" class="" id="member2Addr_college">
								</div>
								<div>
									<label for="">院所：</label>
									<select name="member2College" class="" id="member2College">
										<option id="member2CollegeOption"></option>
									</select>
								</div>
								<div>
									<label for="">科系：</label>
									<select name="member2Depart" class="" id="member2Depart">
										<option id="member2DepartOption"></option>
									</select>
								</div>
								<div>
									<label for="">學位：</label>
										<select name="member2Degree" class="" id="member2Degree">
											<option value="五專">五專</option>
											<option value="二專">二專</option>
											<option value="四技">四技</option>
											<option value="二技">二技</option>
											<option value="學士">學士</option>
											<option value="碩士">碩士</option>
											<option value="博士">博士</option>
										</select>
								</div>
								<div>
									<label for="">年級：</label>
									<select name="member2Grade_college" id="member2Grade_college">
										<option value="一年級">一年級</option>
										<option value="二年級">二年級</option>
										<option value="三年級">三年級</option>
										<option value="四年級">四年級</option>
										<option value="五年級">五年級</option>
										<option value="六年級">六年級</option>
										<option value="七年級">七年級</option>
									</select>
								</div>
								<div class="text-center" style="margin-top: 10px;">
									<button class="btn-success" id="" onClick="EditCompetmember2College()">儲存修改</button>
									<button class="btn-danger" id="" onClick="delCompetmember2College()">刪除隊員</button>
									<div id="editMember2Msg_college"></div>
								</div>
								
							</div>
							
						</div>
						
						<div class="row hidden" id="editHighschool">
							
							<div class="col-md-3" style="border-right:1px #E0E0E0 solid;">
								123
							</div>
							
							<div class="col-md-3" style="border-right:1px #E0E0E0 solid;">
								456
							</div>
							
							<div class="col-md-3" style="border-right:1px #E0E0E0 solid;">
								789
							</div>
							
							<div class="col-md-3">
								012
							</div>
							
						</div>

					</div>
					
				</div>
			</div>
			
		</div>
			
<!--
		<div class="row" style="display: none;" id="postType2">
			<div class="col-md-12" id="manageArea">
				<div class="panel panel-default">
					
					<div class="panel-heading text-center" style="color:darkred;font-weight: bold;font-size: 22px;font-family: Microsoft JhengHei;">
						<span id="">退費紀錄 (修改已繳費之訂單資料並作廢收據)</span>
					</div>
					
					<div class="panel-body" style="border-bottom: 1px #E0E0E0 solid;">
						<div class="row mx-auto text-center">
							<div class="col mx-auto text-center">
								<input type="text" placeholder="輸入隊伍編號" id="getRefundTeamNO">
								<button class="btn-info" id="refundComfirmButton" onClick="refund()">繼續</button>
							</div>
						</div>
					</div>
			
					<div class="panel-body">
						<table id="competForm" class="table table-hover table-striped table-bordered text-center" style="100%">
							<thead class="thead-dark bg-info">
								<tr>
									<th class="text-center">ID</th>
									<th class="text-center">建立時間</th>
									<th class="text-center">vCode</th>
									<th class="text-center">對應項目</th>
									<th class="text-center">內容描述</th>
									<th class="text-center">結束時間</th>
									<th class="text-center">對象</th>
									<th class="text-center">額度</th>
									<th class="text-center">申請人</th>
									<th class="text-center">操作</th>
								</tr>
							</thead>
							<tbody>	
								
							<?php
							for ($i=1; $i<=mysql_num_rows($refundList); $i++) {
								$row=mysql_fetch_row($refundList);
							?>

								<tr>
									<td><?php echo $row[0];?></td>
									<td><?php echo $row[1];?></td>
									<td><?php echo $row[2];?></td>
									<td><?php echo $row[3];?></td>
									<td><?php echo $row[4];?></td>
									<td><?php echo $row[5];?></td>
									<td><?php echo $row[7];?></td>
									<td><?php echo $row[9];?></td>
									<td><?php echo $submiter;?></td>
									<td><button class="btn-success" onclick="vCodePermit('<?php echo $row[2];?>')">通過</button> <button class="btn-danger" onclick="vCodeReject('<?php echo $row[2];?>')">駁回</button></span></td>
								</tr>

							<?php }?>
							</tbody>
						</table>
					</div>
					
				</div>
			</div>
		</div>
-->
	
</div>
<!--/.main-->

	

	
	

	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="../lumino/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
	<script src="../lumino/js/chart.min.js"></script>
	<script src="../lumino/js/chart-data.js"></script>
	<script src="../lumino/js/easypiechart.js"></script>
	<script src="../lumino/js/easypiechart-data.js"></script>
<!--	<script src="../lumino/js/bootstrap-datepicker.js"></script>-->
	<script src="../controller/datepicker.js"></script>
	<script type="text/javascript" src="../controller/zipcode.js"></script>
	<script type="text/javascript" src="../controller/zipcode2.js"></script>
	<script type="text/javascript" src="../controller/Division.js"></script>
	<script type="text/javascript" src="../controller/Division2.js"></script>
	<script type="text/javascript" src="../controller/HS_schoolList.js"></script>
	<script type="text/javascript" src="../controller/admin_editCompet_captainEditCollege.js"></script>
<!--	<script src="../lumino/js/bootstrap-table.js"></script>-->
<!-- DataTables v1.10.16 -->
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>


<!-- 自定義JS -->
	<!-- 權限 -->
	<script src="../controller/admin_authority.js"></script>

	<!-- 選擇增補競賽項目 -->
<script>
	function getProjectNO(){
		var projectNO = $("#selectCompet").val();
		if ( (projectNO.substring(0,2) == "CG") || (projectNO.substring(0,3) == "NCS")){
			$("#sinupCollege").removeClass("hidden");
			$("#sinupSocial").addClass("hidden");
			$("#sinupHighschool").addClass("hidden");
		}else if (projectNO.substring(0,2) == "SG"){
			$("#sinupCollege").addClass("hidden");
			$("#sinupSocial").removeClass("hidden");
			$("#sinupHighschool").addClass("hidden");
		}
	}
</script>	
	
	<!-- 增補隊伍 Ajax -->
<script>
	function collegeSingup(){
		// 取得增補競賽代號
		var projectNO = $("#selectCompet").val();
		// 判斷競賽, 取得增補資料 並傳送Ajax
		if ( projectNO.substring(0,2) == "CG" ){
			var schoolDistrict = $("#schoolDistrict").val(); //取得大專學校所在分區
			var schoolPre = $("#schoolPre").val(); //取得大專學校名稱
			var teamName = $("#singupCollegeTeamName").val(); //取得隊伍名稱
			var teacherName = $("#singupCollegeTeacher").val(); //取得指導老師
			var name = $("#singupCollegeCaptainName").val(); //取得隊長姓名
			var identifyNO = $("#singupCollegeCaptainIdentifyNO").val(); //取得隊長身份證字號
			var email = $("#singupCollegeCaptainEmail").val(); //取得隊長Email
			var advisor = $("#singupCollegeCaptainAdvisor").val(); //顧問需求
			// CG_getCode Ajax 開始
			$.ajax({

				url:"https://wmpcca.com/bswmp/form/model/admin_editCompet_CGgetCode.php",
				data:{
					"projectNO" : projectNO,
					"schoolDistrict" : schoolDistrict,
					"schoolPre" : schoolPre,
					"teacherName" : teacherName,
					"teamName" : teamName,
					"name" : name,
					"identifyNO" : identifyNO,
					"email" : email,
					"advisor" : advisor
				},

				method : "POST",

				error : function(Msg){
					$("#sinupCollegeResultMsg").html(Msg);
				},

				success : function(Msg){
					
					if ( Msg == '請勿重覆報名' ){
						$("#signupCollegeResultMsg").text(Msg);	
					}else if ( Msg == '隊名已被使用' ){
						$("#signupCollegeResultMsg").text(Msg);	
				  	}else{					
						$("#signupCollegeReturnTeamNO").text("增補成功！隊伍編號為 "+Msg[0]);
						$("#signupCollegeResultMsg").text("※已將隊伍編號及驗證碼寄至"+Msg[1]);
					}
				}
			}); // CG_GetCode Ajax 結束
			
		}else if( projectNO.substring(0,3) == "NCS" ){
			var schoolDistrict = $("#schoolDistrict").val(); //取得大專學校所在分區
			var schoolPre = $("#schoolPre").val(); //取得大專學校名稱
			var teamName = $("#singupCollegeTeamName").val(); //取得隊伍名稱
			var teacherName = $("#singupCollegeTeacher").val(); //取得指導老師
			var name = $("#singupCollegeCaptainName").val(); //取得隊長姓名
			var identifyNO = $("#singupCollegeCaptainIdentifyNO").val(); //取得隊長身份證字號
			var email = $("#singupCollegeCaptainEmail").val(); //取得隊長Email
			var advisor = $("#singupCollegeCaptainAdvisor").val(); //顧問需求
			// NCS_getCode Ajax 開始
			$.ajax({

				url:"https://wmpcca.com/bswmp/form/model/admin_editCompet_NCSgetCode.php",
				data:{
					"projectNO" : projectNO,
					"schoolDistrict" : schoolDistrict,
					"schoolPre" : schoolPre,
					"teacherName" : teacherName,
					"teamName" : teamName,
					"name" : name,
					"identifyNO" : identifyNO,
					"email" : email,
					"advisor" : advisor
				},

				method : "POST",

				error : function(Msg){
					$("#sinupCollegeResultMsg").html(Msg);
				},

				success : function(Msg){
					
					if ( Msg == '請勿重覆報名' ){
						$("#signupCollegeResultMsg").text(Msg);	
					}else if ( Msg == '隊名已被使用' ){
						$("#signupCollegeResultMsg").text(Msg);	
				  	}else{					
						$("#signupCollegeReturnTeamNO").text("增補成功！隊伍編號為 "+Msg[0]);
						$("#signupCollegeResultMsg").text("※已將隊伍編號及驗證碼寄至"+Msg[1]);
					}
				}
			}); // NCS_GetCode Ajax 結束
	}
	}
	
	function socialSingup(){
		// 取得增補競賽代號
		var projectNO = $("#selectCompet").val();
		
		if ( projectNO.substring(0,2) == "SG" ){
					var teamName = $("#singupSocialTeamName").val(); //取得隊伍名稱
					var name = $("#singupSocialCaptainName").val(); //取得隊長姓名
					var identifyNO = $("#singupSocialCaptainIdentifyNO").val(); //取得隊長身份證字號
					var email = $("#singupSocialCaptainEmail").val(); //取得隊長Email
					// SG_getCode Ajax 開始
					$.ajax({

						url:"https://wmpcca.com/bswmp/form/model/admin_editCompet_SGgetCode.php",
						data:{
							"projectNO" : projectNO,
							"teamName" : teamName,
							"name" : name,
							"identifyNO" : identifyNO,
							"email" : email
						},

						method : "POST",

						error : function(Msg){
							$("#sinupSocailResultMsg").html(Msg);
						},

						success : function(Msg){

							if ( Msg == '請勿重覆報名' ){
								$("#signupSocialResultMsg").text(Msg);	
							}else if ( Msg == '隊名已被使用' ){
								$("#signupSocialResultMsg").text(Msg);	
							}else{					
								$("#signupSocialReturnTeamNO").text("增補成功！隊伍編號為 "+Msg[0]);
								$("#signupSocialResultMsg").text("※已將隊伍編號及驗證碼寄至"+Msg[1]);
							}
						}
					}); // SG_GetCode Ajax 結束
				}
	}
	
</script>


	<!-- 取得編輯隊伍 -->
<script>
	
	function getTeamData(){
		// 取得輸入隊編
		var teamNO = $("#getTeamNO").val();
		// 判斷隊編, 取回隊伍資訊 (大專)
		if ( (teamNO.substring(0,2) == "CG") ||  (teamNO.substring(0,2) == "CN") || (teamNO.substring(0,2) == "CC") || (teamNO.substring(0,2) == "CS") ){
		//顯示editCollege區域
		$("#editCollege").removeClass("hidden");
		$("#editSocial").addClass("hidden");
			// get college Team Info Ajax 開始
			$.ajax({

				url:"https://wmpcca.com/bswmp/form/model/admin_editCompet_getTeamDataCollege.php",
				data:{
					"teamNO" : teamNO
				},

				method : "POST",

				error : function(Msg){
					$("#editTeamMsg_college").text(Msg);
				},

				success : function(Msg){
					//取回隊伍資料
					$("#teamNO_college").val(Msg[5]);
					$("#schoolID").val(Msg[6]);
					$("#teamName_college").val(Msg[7]);
					$("#teacher_college").val(Msg[8]);
					
					//取回繳費狀態
					$("#MN_college").val(Msg[0]);
					$("#payWay_college").val(Msg[1]);
					$("#payStatus_college").val(Msg[2]);
					$("#payTime_college").val(Msg[3]);
					$("#vAccount_college").val(Msg[4]);
					//若繳費狀況為繳費完成, 則全繳費欄位上鎖
					if (Msg[2] == '繳費完成'){
						$("#payWay_college").append(`<option value="${Msg[1]}" selected>${Msg[1]}</option>`);
						$("#payWay_college").attr("disabled", "disabled");
						$("#payWay_college").css("background", "#EBEBE4");
						$("#payStatus_college").attr("disabled", "disabled");
						$("#payTime_college").attr("disabled", "disabled");
						$("#vAccount_college").attr("disabled", "disabled");
						$("#MN_college").attr("disabled", "disabled");
						$("#editTeamInfoButton").hide();
						
					}else if (Msg[2] == '已退費'){
						$("#payStatus_college").prop("disabled", "disabled");
						$("#payStatus_college").val("已退費");
						$("#payWay_college").prop("disabled", "disabled");
						$("#payWay_college").css("background", "none");
					}
					else
					{
						$("#teacher_college").attr("disabled", "disabled");
						$("#payWay_college").prop("disabled", false);
						$("#payStatus_college").prop("disabled", "disabled");
						$("#payStatus_college").val("未完成繳費");
						$("#payTime_college").prop("disabled", false);
						$("#vAccount_college").prop("disabled", false);
						$("#MN_college").prop("disabled", false);
						$("#payWay_college").css("background", "none");
					}
					
					//帶入院所科系
					var id = $("#schoolID").val();
					let str = ''
					str = ``;
					$.getJSON('../controller/json/College/' + id + '.json', function (data) {
						$.each(data, function (i, item) {
							str += `<option id="${item.collegeID}">${item.collegeName}</option>`
						});
						$("#captainCollege").append(str);
						$("#member1College").append(str);
						$("#member2College").append(str);
					});
					
					//取回隊長資料
					$("#captainName_college").val(Msg[9]);
					$("#captainSex_college").val(Msg[10]);
					$("#captainID_college").val(Msg[11]);
					$("#captainBirth_college").val(Msg[12]);
					$("#captainPhone_college").val(Msg[13]);
					$("#captainEmail_college").val(Msg[14]);
					$("#captainCity-College").val(Msg[15]);
					$("#captainCityOption-College").val(Msg[15]);
					$("#captainCityOption-College").text(Msg[15]);
					$("#captainDistrictOption-College").val(Msg[16]);
					$("#captainDistrictOption-College").text(Msg[16]);
					$("#captainAddr_college").val(Msg[17]);
					$("#captainCollegeOption").val(Msg[18]);
					$("#captainCollegeOption").text(Msg[18]);
					$("#captainDepartOption").val(Msg[19]);
					$("#captainDepartOption").text(Msg[19]);
					$("#captainDegree").val(Msg[20]);
					$("#captainGrade_college").val(Msg[21]);
					
					//取回副手資料
					$("#member1Name_college").val(Msg[22]);
					$("#member1Sex_college").val(Msg[23]);
					$("#member1ID_college").val(Msg[24]);
					$("#member1Birth_college").val(Msg[25]);
					$("#member1Phone_college").val(Msg[26]);
					$("#member1Email_college").val(Msg[27]);
					$("#member1City-College").val(Msg[28]);
					$("#member1CityOption-College").val(Msg[28]);
					$("#member1CityOption-College").text(Msg[28]);
					$("#member1DistrictOption-College").val(Msg[29]);
					$("#member1DistrictOption-College").text(Msg[29]);
					$("#member1Addr_college").val(Msg[30]);
					$("#member1CollegeOption").val(Msg[31]);
					$("#member1CollegeOption").text(Msg[31]);
					$("#member1DepartOption").val(Msg[32]);
					$("#member1DepartOption").text(Msg[32]);
					$("#member1Degree").val(Msg[33]);
					$("#member1Grade_college").val(Msg[34]);
					
					//取回隊員資料
					$("#member2Name_college").val(Msg[35]);
					$("#member2Sex_college").val(Msg[36]);
					$("#member2ID_college").val(Msg[37]);
					$("#member2Birth_college").val(Msg[38]);
					$("#member2Phone_college").val(Msg[39]);
					$("#member2Email_college").val(Msg[40]);
					$("#member2City-College").val(Msg[41]);
					$("#member2CityOption-College").val(Msg[41]);
					$("#member2CityOption-College").text(Msg[41]);
					$("#member2DistrictOption-College").val(Msg[42]);
					$("#member2DistrictOption-College").text(Msg[42]);
					$("#member2Addr_college").val(Msg[43]);
					$("#member2CollegeOption").val(Msg[44]);
					$("#member2CollegeOption").text(Msg[44]);
					$("#member2DepartOption").val(Msg[45]);
					$("#member2DepartOption").text(Msg[45]);
					$("#member2Degree").val(Msg[46]);
					$("#member2Grade_college").val(Msg[47]);
					
				}
			}); // get college Team Info Ajax 結束
			
		}else if(teamNO.substring(0,2) == "SG"){
		//顯示editSocial區域
		$("#editCollege").addClass("hidden");
		$("#editSocial").removeClass("hidden");
			// get social Team Info Ajax 開始
			$.ajax({

				url:"https://wmpcca.com/bswmp/form/model/admin_editCompet_getTeamDataSocial.php",
				data:{
					"teamNO" : teamNO
				},

				method : "POST",

				error : function(Msg){
					$("#editTeamMsg_social").text(Msg);
				},

				success : function(Msg){
					//取回隊伍資料
					$("#teamNO_social").val(Msg[5]);
					$("#teamName_social").val(Msg[6]);
					
					//取回繳費狀態
					$("#MN_social").val(Msg[0]);
					$("#payWay_social").val(Msg[1]);
					$("#payStatus_social").val(Msg[2]);
					$("#payTime_social").val(Msg[3]);
					$("#vAccount_social").val(Msg[4]);
					//若繳費狀況為繳費完成, 則全繳費欄位上鎖
					if (Msg[2] == '繳費完成'){
						$("#payWay_social").append(`<option value="${Msg[1]}" selected>${Msg[1]}</option>`);
						$("#payWay_social").attr("disabled", "disabled");
						$("#payWay_social").css("background", "#EBEBE4");
						$("#payStatus_social").attr("disabled", "disabled");
						$("#payTime_social").attr("disabled", "disabled");
						$("#vAccount_social").attr("disabled", "disabled");
						$("#MN_social").attr("disabled", "disabled");
						$("#editTeamInfoButton").hide();
					}else if (Msg[2] == '已退費'){
						$("#payStatus_social").prop("disabled", "disabled");
						$("#payStatus_social").val("已退費");
						$("#payWay_social").prop("disabled", "disabled");
						$("#payWay_social").css("background", "none");
					}
					else
					{
						$("#teacher_social").attr("disabled", "disabled");
						$("#payWay_social").prop("disabled", false);
						$("#payStatus_social").prop("disabled", "disabled");
						$("#payStatus_social").val("未完成繳費");
						$("#payTime_social").prop("disabled", false);
						$("#vAccount_social").prop("disabled", false);
						$("#MN_social").prop("disabled", false);
						$("#payWay_social").css("background", "none");
					}
					
					//取回隊長資料
					$("#captainName_social").val(Msg[7]);
					$("#captainSex_social").val(Msg[8]);
					$("#captainID_social").val(Msg[9]);
					$("#captainBirth_social").val(Msg[10]);
					$("#captainPhone_social").val(Msg[11]);
					$("#captainEmail_social").val(Msg[12]);
					$("#captainCity").val(Msg[13]);
					$("#captainCityOption-Social").val(Msg[13]);
					$("#captainCityOption-Social").text(Msg[13]);
					$("#captainDistrictOption-Social").val(Msg[14]);
					$("#captainDistrictOption-Social").text(Msg[14]);
					$("#captainAddr_social").val(Msg[15]);
					$("#captainJob").val(Msg[16]);
					$("#captainTitle").val(Msg[17]);
					$("#captainYear").val(Msg[18]);
					
					//取回副手資料
					$("#member1Name_social").val(Msg[19]);
					$("#member1Sex_social").val(Msg[20]);
					$("#member1ID_social").val(Msg[21]);
					$("#member1Birth_social").val(Msg[22]);
					$("#member1Phone_social").val(Msg[23]);
					$("#member1Email_social").val(Msg[24]);
					$("#member1City").val(Msg[25]);
					$("#member1CityOption-Social").val(Msg[25]);
					$("#member1CityOption-Social").text(Msg[25]);
					$("#member1DistrictOption-Social").val(Msg[26]);
					$("#member1DistrictOption-Social").text(Msg[26]);
					$("#member1Addr_social").val(Msg[27]);
					$("#member1Job").val(Msg[28]);
					$("#member1Title").val(Msg[29]);
					$("#member1Year").val(Msg[30]);
					
					//取回隊員資料
					$("#member2Name_social").val(Msg[31]);
					$("#member2Sex_social").val(Msg[32]);
					$("#member2ID_social").val(Msg[33]);
					$("#member2Birth_social").val(Msg[34]);
					$("#member2Phone_social").val(Msg[35]);
					$("#member2Email_social").val(Msg[36]);
					$("#member2City").val(Msg[37]);
					$("#member2CityOption-Social").val(Msg[37]);
					$("#member2CityOption-Social").text(Msg[37]);
					$("#member2DistrictOption-Social").val(Msg[38]);
					$("#member2DistrictOption-Social").text(Msg[38]);
					$("#member2Addr_social").val(Msg[39]);
					$("#member2Job").val(Msg[40]);
					$("#member2Title").val(Msg[41]);
					$("#member2Year").val(Msg[42]);
					
				}
			}); // get social Team Info Ajax 結束
			
		}
	}
	
</script>

	
	<!-- 儲存編輯隊伍 建立訂單或更新訂單-->
<script>
	function editTeamInfo(){
		//取得隊伍編號
		var teamNO = $("#getTeamNO").val();
		var teacher = $("#teacher_college").val();
		var payStatus = $("#payStatus_college").val();
		var payWay = $("#payWay_college").val();
		var vAccount = $("#vAccount_college").val();
		var payTime = $("#payTime_college").val();
		var MN = $("#MN_college").val();
		
		// 傳值 修改資料/產生/修改訂單 Ajax
		$.ajax({

			url:"https://wmpcca.com/bswmp/form/model/admin_editCompet_teamInfoCollege.php",
			data:{
				"teamNO" : teamNO,
				"teacher" : teacher,
				"payStatus" : payStatus,
				"payWay" : payWay,
				"vAccount" : vAccount,
				"payTime" : payTime, 
				"MN" : MN
			},

			method : "POST",

			error : function(Msg){
				$("#editTeamMsg_college").text(Msg);
			},

			success : function(Msg){
				$("#editTeamMsg_college").text(Msg);
			}
		});	// 傳值 修改資料/產生/修改訂單 Ajax 結束
	}
</script>


	<!-- 退費 更新訂單繳費狀態及作廢收據-->
<script>
	function refund(){
		//取得隊伍編號
		var teamNO = $("#getTeamNO").val();
		
		// 傳值 修改資料/產生/修改訂單 Ajax
		$.ajax({

			url:"https://wmpcca.com/bswmp/form/model/admin_editCompet_refund.php",
			data:{
				"teamNO" : teamNO
			},

			method : "POST",

			error : function(Msg){
				$("#editTeamMsg_college").text(Msg);
			},

			success : function(Msg){
				if (Msg == "無法設定退費"){
					$("#editTeamMsg_college").text(Msg);
				}else{
					$("#editTeamMsg_college").text("訂單編號:"+Msg[0]+"及收據編號:"+Msg[1]+"完成退費修訂");
				}
			}
		});	// 傳值 修改資料/產生/修改訂單 Ajax 結束
	}
</script>
	
	
	<!-- 取消報名 刪除所有報名資料 -->
<script>
	function delTeamInfo(){
		// 跳出確認訊息
		var delData = confirm('將刪除該隊所有報名資料？(包括隊伍成員！)');
		if (!delData){
			return;
		}
		
		//取得隊伍編號
		var teamNO = $("#getTeamNO").val();
		// 傳值 修改資料/產生/修改訂單 Ajax
		$.ajax({

			url:"https://wmpcca.com/bswmp/form/model/compet_edit_signupAbort.php",
			data:{
				"teamNO" : teamNO
			},

			method : "POST",

			error : function(Msg){
				$("#editTeamMsg_college").text(Msg);
			},

			success : function(Msg){
				if (Msg == 'TRUE'){
					$("#editTeamMsg_college").text("資料已「完全」刪除！");
				}
			}
		});	// 傳值 修改資料/產生/修改訂單 Ajax 結束
	}
</script>	

	
	<!-- 修改隊長資料 -->
<script>
	// 大專組
function EditCompetCaptainCollege() {
	var teamNO = $("#teamNO_college").val();
	var captainName = $("#captainName_college").val();
	var captainSex = $("#captainSex_college").val();
	var captainID = $("#captainID_college").val();
	var captainBirth = $("#captainBirth_college").val();
	var captainPhone = $("#captainPhone_college").val();
	var captainEmail = $("#captainEmail_college").val();
	var captainCity = $("#captainCity-College").val();
	var captainDistrict = $("#captainDistrict-College").val();
	var captainAddr = $("#captainAddr_college").val();
	var captainCollege = $("#captainCollege").val();
	var captainDepart = $("#captainDepart").val();
	var captainDegree = $("#captainDegree").val();
	var captainGrade = $("#captainGrade_college").val();

	
$.ajax({

	url:"https://wmpcca.com/bswmp/form/model/admin_editCompet_captainEditCollege.php",
	data:{
		"teamNO" : teamNO,
		"name" : captainName,
		"sex" : captainSex,
		"identifyNO" : captainID,
		"birthday" : captainBirth,
		"phone" : captainPhone,
		"email" : captainEmail,
		"city" : captainCity,
		"district" : captainDistrict,
		"addr" : captainAddr,
		"college" : captainCollege,
		"depart" : captainDepart,
		"degree" : captainDegree,
		"grade" : captainGrade
	},

	method : "POST",

	error : function(msg){
		alert(msg);
	},

	success : function(msg){
		
		alert(msg);
	}

	});	
		
}// JavaScript Document
	
	// 社會組	
function EditCompetCaptainSocial() {
	var teamNO = $("#teamNO_social").val();
	var captainName = $("#captainName_social").val();
	var captainSex = $("#captainSex_social").val();
	var captainID = $("#captainID_social").val();
	var captainBirth = $("#captainBirth_social").val();
	var captainPhone = $("#captainPhone_social").val();
	var captainEmail = $("#captainEmail_social").val();
	var captainCity = $("#captainCity").val();
	var captainDistrict = $("#captainDistrict").val();
	var captainAddr = $("#captainAddr_social").val();
	var captainJob = $("#captainJob").val();
	var captainTitle = $("#captainTitle").val();
	var captainYear = $("#captainYear").val();

	
$.ajax({

	url:"https://wmpcca.com/bswmp/form/model/admin_editCompet_captainEditSocial.php",
	data:{
		"teamNO" : teamNO,
		"name" : captainName,
		"sex" : captainSex,
		"identifyNO" : captainID,
		"birthday" : captainBirth,
		"phone" : captainPhone,
		"email" : captainEmail,
		"city" : captainCity,
		"district" : captainDistrict,
		"addr" : captainAddr,
		"job" : captainJob, 
		"title" : captainTitle, 
		"year" : captainYear
	},

	method : "POST",

	error : function(msg){
		alert(msg);
	},

	success : function(msg){
		alert(msg);
	}

	});	
		
}
	
</script>
	
	
	<!-- 修改副手資料 -->
<script>
	// 大專組
function EditCompetmember1() {
	var teamNO = $("#teamNO_college").val();
	var member1Name = $("#member1Name_college").val();
	var member1Sex = $("#member1Sex_college").val();
	var member1ID = $("#member1ID_college").val();
	var member1Birth = $("#member1Birth_college").val();
	var member1Phone = $("#member1Phone_college").val();
	var member1Email = $("#member1Email_college").val();
	var member1City = $("#member1City-College").val();
	var member1District = $("#member1District-College").val();
	var member1Addr = $("#member1Addr_college").val();
	var member1College = $("#member1College").val();
	var member1Depart = $("#member1Depart").val();
	var member1Degree = $("#member1Degree").val();
	var member1Grade = $("#member1Grade_college").val();

	
$.ajax({

	url:"https://wmpcca.com/bswmp/form/model/admin_editCompet_member1EditCollege.php",
	data:{
		"teamNO" : teamNO,
		"name" : member1Name,
		"sex" : member1Sex,
		"identifyNO" : member1ID,
		"birthday" : member1Birth,
		"phone" : member1Phone,
		"email" : member1Email,
		"city" : member1City,
		"district" : member1District,
		"addr" : member1Addr,
		"college" : member1College,
		"depart" : member1Depart,
		"degree" : member1Degree,
		"grade" : member1Grade
	},

	method : "POST",

	error : function(msg){
		$("#editMember1Msg_college").html(msg);
	},

	success : function(msg){
		
		$("#editMember1Msg_college").text(msg);
	}

	});	
		
}
	
	// 社會組	
function EditCompetmember1Social() {
	var teamNO = $("#teamNO_social").val();
	var member1Name = $("#member1Name_social").val();
	var member1Sex = $("#member1Sex_social").val();
	var member1ID = $("#member1ID_social").val();
	var member1Birth = $("#member1Birth_social").val();
	var member1Phone = $("#member1Phone_social").val();
	var member1Email = $("#member1Email_social").val();
	var member1City = $("#member1City").val();
	var member1District = $("#member1District").val();
	var member1Addr = $("#member1Addr_social").val();
	var member1Job = $("#member1Job").val();
	var member1Title = $("#member1Title").val();
	var member1Year = $("#member1Year").val();

	
$.ajax({

	url:"https://wmpcca.com/bswmp/form/model/admin_editCompet_member1EditSocial.php",
	data:{
		"teamNO" : teamNO,
		"name" : member1Name,
		"sex" : member1Sex,
		"identifyNO" : member1ID,
		"birthday" : member1Birth,
		"phone" : member1Phone,
		"email" : member1Email,
		"city" : member1City,
		"district" : member1District,
		"addr" : member1Addr,
		"job" : member1Job, 
		"title" : member1Title, 
		"year" : member1Year
	},

	method : "POST",

	error : function(msg){
		alert(msg);
//		$("#editMember1Msg_social").html(msg);
	},

	success : function(msg){
		alert(msg);
//		$("#editMember1Msg_social").html(msg);
	}

	});	
		
}	

</script>
	
	<!-- 刪除副手報名資料 -->
<script>
	// 大專組
	function delCompetmember1College(){
		// 跳出確認訊息
		var delData = confirm('是否確定要刪除副手所有報名資料？');
		if (!delData){
			return;
		}
		
		//取得隊伍編號
		var teamNO = $("#getTeamNO").val();
		var memberDB = 'studentsInfo';
		// 傳值 修改資料/產生/修改訂單 Ajax
		$.ajax({

			url:"https://wmpcca.com/bswmp/form/model/admin_editCompet_delMember1College.php",
			data:{
				"teamNO" : teamNO,
				"memberDB" : memberDB
			},

			method : "POST",

			error : function(Msg){
				$("#editTeamMsg_college").text(Msg);
			},

			success : function(Msg){
				$("#editMember1Msg_college").text("資料已刪除！");
			}
		});	// 傳值 修改資料/產生/修改訂單 Ajax 結束
	}
	
	// 社會組
	function delCompetmember1Social(){
		// 跳出確認訊息
		var delData = confirm('是否確定要刪除副手所有報名資料？');
		if (!delData){
			return;
		}
		
		//取得隊伍編號
		var teamNO = $("#getTeamNO").val();
		var memberDB = 'socialInfo';
		// 傳值 修改資料/產生/修改訂單 Ajax
		$.ajax({

			url:"https://wmpcca.com/bswmp/form/model/admin_editCompet_delMember1Social.php",
			data:{
				"teamNO" : teamNO,
				"memberDB" : memberDB
			},

			method : "POST",

			error : function(Msg){
				$("#editTeamMsg_college").text(Msg);
			},

			success : function(Msg){
				$("#editMember1Msg_college").text("資料已刪除！");
			}
		});	// 傳值 修改資料/產生/修改訂單 Ajax 結束
	}
</script>	
	
	
	<!-- 修改隊員資料 -->
<script>
	// 大專組
function EditCompetmember2College() {
	var teamNO = $("#teamNO_college").val();
	var member2Name = $("#member2Name_college").val();
	var member2Sex = $("#member2Sex_college").val();
	var member2ID = $("#member2ID_college").val();
	var member2Birth = $("#member2Birth_college").val();
	var member2Phone = $("#member2Phone_college").val();
	var member2Email = $("#member2Email_college").val();
	var member2City = $("#member2City-College").val();
	var member2District = $("#member2District-College").val();
	var member2Addr = $("#member2Addr_college").val();
	var member2College = $("#member2College").val();
	var member2Depart = $("#member2Depart").val();
	var member2Degree = $("#member2Degree").val();
	var member2Grade = $("#member2Grade_college").val();

	
$.ajax({

	url:"https://wmpcca.com/bswmp/form/model/admin_editCompet_member2EditCollege.php",
	data:{
		"teamNO" : teamNO,
		"name" : member2Name,
		"sex" : member2Sex,
		"identifyNO" : member2ID,
		"birthday" : member2Birth,
		"phone" : member2Phone,
		"email" : member2Email,
		"city" : member2City,
		"district" : member2District,
		"addr" : member2Addr,
		"college" : member2College,
		"depart" : member2Depart,
		"degree" : member2Degree,
		"grade" : member2Grade
	},

	method : "POST",

	error : function(msg){
		$("#editmember2Msg_college").html(msg);
	},

	success : function(msg){
		$("#editMember2Msg_college").html(msg);
	}

	});	
		
}
	
	
	// 社會組	
function EditCompetmember2Social() {
	var teamNO = $("#teamNO_social").val();
	var member2Name = $("#member2Name_social").val();
	var member2Sex = $("#member2Sex_social").val();
	var member2ID = $("#member2ID_social").val();
	var member2Birth = $("#member2Birth_social").val();
	var member2Phone = $("#member2Phone_social").val();
	var member2Email = $("#member2Email_social").val();
	var member2City = $("#member2City").val();
	var member2District = $("#member2District").val();
	var member2Addr = $("#member2Addr_social").val();
	var member2Job = $("#member2Job").val();
	var member2Title = $("#member2Title").val();
	var member2Year = $("#member2Year").val();

	
$.ajax({

	url:"https://wmpcca.com/bswmp/form/model/admin_editCompet_member2EditSocial.php",
	data:{
		"teamNO" : teamNO,
		"name" : member2Name,
		"sex" : member2Sex,
		"identifyNO" : member2ID,
		"birthday" : member2Birth,
		"phone" : member2Phone,
		"email" : member2Email,
		"city" : member2City,
		"district" : member2District,
		"addr" : member2Addr,
		"job" : member2Job, 
		"title" : member2Title, 
		"year" : member2Year
	},

	method : "POST",

	error : function(msg){
		$("#editMember2Msg_Social").html(msg);
	},

	success : function(msg){
		$("#editMember2Msg_Social").html(msg);
	}

	});	
		
}		
	
</script>
	
	
	<!-- 刪除隊員報名資料 -->
<script>
	// 大專組
	function delCompetmember2College(){
		// 跳出確認訊息
		var delData = confirm('是否確定要刪除隊員所有報名資料？');
		if (!delData){
			return;
		}
		
		//取得隊伍編號
		var teamNO = $("#getTeamNO").val();
		var memberDB = 'studentsInfo';
		// 傳值 修改資料/產生/修改訂單 Ajax
		$.ajax({

			url:"https://wmpcca.com/bswmp/form/model/admin_editCompet_delMember2College.php",
			data:{
				"teamNO" : teamNO,
				"memberDB" : memberDB
			},

			method : "POST",

			error : function(Msg){
				$("#editMember2Msg_college").text(Msg);
			},

			success : function(Msg){
				$("#editMember2Msg_college").text("資料已刪除！");
			}
		});	// 傳值 修改資料/產生/修改訂單 Ajax 結束
	}
	
	// 社會組
	function delCompetmember2Social(){
		// 跳出確認訊息
		var delData = confirm('是否確定要刪除隊員所有報名資料？');
		if (!delData){
			return;
		}
		
		//取得隊伍編號
		var teamNO = $("#getTeamNO").val();
		var memberDB = 'socialInfo';
		// 傳值 修改資料/產生/修改訂單 Ajax
		$.ajax({

			url:"https://wmpcca.com/bswmp/form/model/admin_editCompet_delMember2Social.php",
			data:{
				"teamNO" : teamNO,
				"memberDB" : memberDB
			},

			method : "POST",

			error : function(Msg){
				$("#editMember2Msg_Social").text(Msg);
			},

			success : function(Msg){
				$("#editMember2Msg_Social").text("資料已刪除！");
			}
		});	// 傳值 修改資料/產生/修改訂單 Ajax 結束
	}
</script>	
	
</body>

</html>

