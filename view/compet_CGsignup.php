<?php
require_once("../vender/dbtools.inc.php");

$getToday = date("Y-m-d H:i:s");
$competYear = substr($getToday, 2, 2);

//取得全國大專資料
$CGsqlSELECTcompetData = " SELECT * FROM competList WHERE projectName LIKE '%全國大專財富%' ORDER BY id DESC ";
$CGsqlResultcompetData = mysql_query($CGsqlSELECTcompetData, $sqlLink);
$CGsqlFETCHcompetData = mysql_fetch_row($CGsqlResultcompetData);
$CGcompetprojectNO = $CGsqlFETCHcompetData[1]; //競賽代號
$CGcompetprojectName = $CGsqlFETCHcompetData[2]; //競賽名稱
$CGcompetStartDate = $CGsqlFETCHcompetData[4]; //開始時間
$CGcompetEndDate = $CGsqlFETCHcompetData[5]; //結束時間

//比對網頁開啟時的時間, 若大於現時則開放true, 否則false
if (strtotime($getToday) >= strtotime($CGcompetStartDate) && strtotime($getToday) <= strtotime($CGcompetEndDate)){
	$CGcompet = "TRUE";
}else {
	$CGcompet = "FALSE";
	echo "<script type='text/javascript'>";
	echo "alert('目前非開放時間！');";
	echo "history.back();";
	echo "</script>";
}


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

<title>WMPCCA - 財富管理規劃競賽</title>
	

	
<style>
.banner_inner{
	font-size: 13px;
	line-height: 1.8;
	color: #000000;
	background-image: url("../img/CGcompet_index.jpg");
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
		<form class="" method="POST" style="padding-top: 50px;">

			<div class="h4 mx-auto text-center" style="color: #0B7376;">歡迎參加</div>
			<div class="h3 mx-auto text-center" style="color: #000000.;"><?php echo $CGcompetprojectName; ?></div>

				<div class="row mt-4">
					<div class="col-2"></div>
						<div class="col-3">
							<label for="disdrict">學校分區</label>
							<select name="schoolDistrict" class="form-control" id="schoolDistrict">
							</select>
						</div>
						<div class="col-5">
							<label for="school">代表學校</label>
							<select name="schoolPre" class="form-control" id="schoolPre">
							</select>
							<small id="schoolSelector" class="form-text text-muted text-right"><span id="schoolMsg">※ 宜蘭:北區, 花東離島:南區</span></small>
						</div>
					<div class="col-2"></div>
				</div>

				<div class="row mt-2">
					<div class="col-2"></div>
						<div class="col-8">
							<label for="inp" class="inp">
							<input type="text" placeholder="&nbsp;" maxlength="8" style="text-align: center" id="teacherName">
							<span class="label1">指導老師</span>
							<span class="border1"></span>
							</label>
							<small id="" class="form-text text-muted text-right"><span id="teacherNameMsg">※ 請填寫全名</span></small>
						</div>
					<div class="col-2"></div>
				</div>

				<div class="row mt-0">
					<div class="col-2"></div>
						<div class="col-8">
							<label for="inp" class="inp">
							<input type="text" placeholder="&nbsp;" maxlength="8" style="text-align: center" id="teamName">
							<span class="label1">隊伍名稱</span>
							<span class="border1"></span>
							</label>
							<small id="loginHelp" class="form-text text-muted text-right"><span id="teamNameMsg">※ 最多8個中文字</span></small>
						</div>
					<div class="col-2"></div>
				</div>
			
				<div class="row mt-0">
					<div class="col-2"></div>
						<div class="col-8">
							<label for="inp" class="inp">
							<input type="text" placeholder="&nbsp;" style="text-align: center" id="name">
							<span class="label2">隊伍代表(隊長)</span>
							<span class="border2"></span>
							</label>
							<small id="loginHelp" class="form-text text-muted text-right"><span id="nameMsg">※ 外籍在台人士請填寫居留證件中文全名</span></small>
						</div>
					<div class="col-2"></div>
				</div>

				<div class="row mt-0">
					<div class="col-2"></div>
						<div class="col-8">
							<label for="inp" class="inp">
							<input type="text" placeholder="&nbsp;" style="text-align: center" id="identifyNO">
							<span class="label2">身份證字號</span>
							<span class="border2"></span>
							</label>
							<small id="loginHelp" class="form-text text-muted text-right"><span id="identifyNOMsg">※ 外籍在台人士請填寫居留證號</small>
						</div>
					<div class="col-2"></div>
				</div>
			
				<div class="row mt-0">
					<div class="col-2"></div>
						<div class="col-8">
							<label for="inp" class="inp">
							<input type="text" placeholder="&nbsp;" style="text-align: center" id="email">
							<span class="label4">電子信箱</span>
							<span class="border4"></span>
							</label>
							<small id="loginHelp" class="form-text text-muted text-right"><span id="emailMsg">※ 建議使用Gmail，其它免費信箱可能無法正常寄送</span></small>
						</div>
					<div class="col-2"></div>
				</div>

				<div class="row mt-3">
					<div class="col-2"></div>
						<div class="col-8">
							<label class="customcheck">申請配發競賽輔導顧問（勾選：由協會配發合格之競賽輔導顧問；不勾選：由各隊自行決定,但相關輔導人士不授予協會輔導證書。）
							<input type="checkbox" id="needAdvisor" value="NEED">
							<span class="checkmark"></span>
							</label>
						</div>
					<div class="col-2"></div>
				</div>
					
				<div class="row mt-3">
					<div class="col-2"></div>
						<div class="col-8">
							<label class="customcheck">為保障參賽者之權益，請於使用本服務前，詳細閱讀本頁下方「活動辦法」、「競賽規則」以及「隱私權保護政策」之所有內容，當勾選此項同意時，即表示您以及所有隊伍成員，均已閱讀、瞭解並同意接受本活動之所有內容。
							<input type="checkbox" id="agreeCheck" value="agree">
							<span class="checkmark"></span>
							</label>
						</div>
					<div class="col-2"></div>
				</div>
			
			<div class="mt-3 mx-auto text-center" style="padding-bottom: 50px;">
			<button type="button" class="form-control btn btn-lg btn-outline-warning buttonFail" style="text-align: center; width: 50%" onClick="CGgetCode()">索取競賽驗證碼</button>
			<small id="" class="form-text text-muted mx-auto text-center pt-3"><a href="../view/compet_reGetCode.php">沒有收到驗證碼嗎?</a></small>
			<br><span id="CGgetCodeMsg"></span>
			</div>
		
		</form>
		
	</div>	
</div>
	</div>
</section>


<!-- 活動辦法 -->
<section class="made_life_area p_120">
	<div class="container">
		<h1 class="pb-3">活動辦法</h1>
		<div class="pl-3">
			<p class="h5">活動期間：依各競賽公佈為主。</p>
			<p class="h5">參加資格：依各競賽公佈為主。</p>
			<p class="h5">報名方式：網路報名，每隊1~3人。</p>
			<p class="h5">報名費用：依各競賽公佈為主。</p>
			<p class="h5">團報優惠：同校報名10隊以上，每隊新台幣$850元整 (限大專競賽)。</p>
			<p class="h5">活動流程：依各競賽公佈為主。</p>
			<p class="h5 pt-2">活動獎勵：</p>
				<p class="h5 pl-3 pt-2"><strong>全國財富管理競賽</strong></p>
					<p class="h6 pl-5">第一名：獎金新台幣$15,000元整，冠軍獎盃一座，獎狀一楨</p>
					<p class="h6 pl-5">第二名：獎金新台幣$12,000元整，亞軍獎盃一座，獎狀一楨</p>
					<p class="h6 pl-5">第三名：獎金新台幣 $9,000元整，季軍獎盃一座，獎狀一楨</p>
					<p class="h6 pl-5">特　優：獎金新台幣 $4,500元整，特優獎狀一楨</p>
					<p class="h6 pl-5">優　等：獎金新台幣 $3,000元整，獎狀一楨</p>
					<p class="h6 pl-5">佳　作：獎狀一楨</p>
				<p class="h5 pl-3 pt-2"><strong>全國大專財富管理競賽</strong></p>
					<p class="h6 pl-5">第一名：獎金新台幣$15,000元整，冠軍獎盃一座，獎狀一楨</p>
					<p class="h6 pl-5">第二名：獎金新台幣$12,000元整，亞軍獎盃一座，獎狀一楨</p>
					<p class="h6 pl-5">第三名：獎金新台幣 $9,000元整，季軍獎盃一座，獎狀一楨</p>
					<p class="h6 pl-5">特　優：獎金新台幣 $4,500元整，特優獎狀一楨</p>
					<p class="h6 pl-5">優　等：獎金新台幣 $3,000元整，獎狀一楨</p>
					<p class="h6 pl-5">佳　作：獎狀一楨</p>
				<p class="h5 pl-3 pt-2"><strong>全國大專校院北、中、南分區理財規劃案例競賽</strong></p>
					<p class="h6 pl-5">第一名：獎金新台幣$6,000元整，冠軍獎狀一楨</p>
					<p class="h6 pl-5">第二名：獎金新台幣$4,500元整，亞軍獎狀一楨</p>
					<p class="h6 pl-5">第三名：獎金新台幣$3,000元整，季軍獎狀一楨</p>
					<p class="h6 pl-5">特　優：獎金新台幣$1,500元整，特優獎狀一楨</p>
					<p class="h6 pl-5">優　等：獎金新台幣$1,000元整，佳作獎狀一楨</p>
					<p class="h6 pl-5">佳　作：獎狀一楨</p>
					<p class="h6 pl-5 pt-2"><strong><u>※  以上『特優』、『優等』及『佳作』之名額，視該屆競賽報名總隊伍數斟酌頒發。</u></strong></p>
			<p class="h5 pt-2">注意事項：</p>
				<ol>
					<li class="h5 pl-3 pt-2">競賽期間請各隊參賽成員遵循<strong><a>競賽規則</a></strong>，如有違反規則之情節事實，本會將取消參賽者之活動權利。</li>
					<li class="h5 pl-3 pt-1">參賽成員於參加本活動同時，即視為同意接受本活動辦法，本會得將其部分資料運用或公佈於本會網站或相關活動宣傳物中。</li>
					<li class="h5 pl-3 pt-1">參賽成員個人資料之蒐集、處理及利用，請參考本會之<strong><a>隱私權保護政策。</a></strong></li>
					<li class="h5 pl-3 pt-1"><strong>未成年者(未滿20歲)</strong>須下載並填寫<a href="https://drive.google.com/file/d/1BU5GuDmnJDXtk7rjaQkbX0i_vcQWsD12/view" target="_blank"><u>競賽同意書</u></a>，由其監護人或法定代理人簽章後，於當屆賽事之初賽收件截止日之前，寄至<a data-toggle="tooltip" data-placement="top" title="104台北市中山區南京東路二段216號8樓（台灣財富管理規劃顧問認證協會 收）"><u>本會</u></a>，郵戳為憑，逾期視同放棄參賽資格，本會將取消全隊後續參賽之權利。(可統一收取後一併寄送)</li>
					<li class="h5 pl-3 pt-1">競賽期間，系統將依競賽時程開放／關閉各項報名系統、繳費系統及檔案上傳功能，逾期視同放棄，請參賽成員自行注意競賽專區之競賽時程表。</li>
					<li class="h5 pl-3 pt-1">活動之報名統一由隊長做為代表，系統將發送競賽之隊伍編號及驗證碼至隊長E-mail，持隊編及驗證碼登入競賽專區後，於報名期間完善所有成員之報名資料。報名截止後隊伍任一成員資料不全者視同全隊放棄參賽資格，已繳交之報名費用不予退返。</li>
					<li class="h5 pl-3 pt-1">請各隊成員自行做好溝通，本會將以報名結束時之隊伍成員資料做為參賽認定，不接受任何形式更改隊伍成員之要求。</li>
					<li class="h5 pl-3 pt-1">入圍決賽及簡報之隊伍名單，將於網站公佈，或可登入競賽專區查詢，不另行通知。</li>
					<li class="h5 pl-3 pt-1">各競賽公佈決賽成績之第一名、第二名及第三名之所有隊伍成員，須於頒獎典禮全體出席，並進行成果發表之簡報。</li>
					<li class="h5 pl-3 pt-1">除前三名外之獲獎隊伍須一半以上隊伍成員參與頒獎典禮，如因不可抗拒之事由無法出席頒獎典禮者(非私人因素，經評審團同意者除外)，須於頒獎典禮前至本會網站或競賽專區填寫線上<a><u>請假單</u></a>。未填寫請假單而無故缺席者，或全隊請假無人出席頒獎典禮之隊伍，均視同全隊放棄獲獎資格，包括獲獎名次、所有獎項及獎金之發放，將轉由本會自行處理。因前述原因取消之名次及獎項不予遞補</li>
					<li class="h5 pl-3 pt-1">獎盃、獎牌及獎狀等獎項，以實物為準，如因不可抗拒之事由導致獎品內容變更，中獎人同意接受主辦單位安排之替代獎品，不得要求折現或轉換其他商品，亦不得要求將獎項讓與他人。</li>
					<li class="h5 pl-3 pt-1">頒獎典禮相關資訊將與得獎名單同時公佈，並於公告後一個月內舉行，如遇不可抗拒情事須延期舉行，以本會網站公告為主，不另通知。</li>
					<li class="h5 pl-3 pt-1">前述相關頒獎活動僅限全國財富管理競賽及全國大專財富管理競賽</li>
					<li class="h5 pl-3 pt-1">全國大專校院北、中、南分區理財規劃案例競賽得獎隊伍之獎項將另行寄送至各校單位。</li>
					<li class="h5 pl-3 pt-1">所有活動通知將以本會網站公佈為主不另通知，本會有權決定取消、終止、修改或暫停本活動。</li>
				</ol>
		</div>
	</div>
</section>

<!-- 競賽規則 -->
<section class="price_area p_120">
	<div class="container">
		<h1 class="pb-3">競賽規則</h1>
		<div class="pl-3">
			<p class="h5">報告書格式：全國財富管理競賽之決賽報告書首頁須為競賽指定格式，競賽期間登入競賽專區下載後置於檔案首頁。</p>
			<p class="h5">上傳檔案格式：上傳之報告書檔案格式須為PDF，簡報檔案格式須符合微軟Office Powerpoint之通用格式.ppt或.pptx</p>
			<p class="h5">書面報告書：一式四份(A4格式)，能清楚辨識為原則，可自行選擇黑白或彩色列印，並請妥善裝訂。</p>
			<p class="h5">評分標準：依各競賽公佈為主。</p>
			<p class="h5 pt-4">注意事項：</p>
				<ol>
					<li class="h5 pl-3 pt-2">必要之基本假設與計算過程需於報告書附錄頁附上，包括運用工具所輸入的各項數據，若無附數據評審將斟酌扣分。</li>
					<li class="h5 pl-3 pt-2">大專參賽隊伍之所有報告及簡報之內容，嚴禁出現足以辨識參賽者任何資訊(姓名、學校、指導老師、隊名…等)，違者取消參賽資格，已繳交之報名費用不予退返。</li>
					<li class="h5 pl-3 pt-2">大專決賽簡報隊伍請於簡報當天自行攜帶書面報告，於簡報評審老師提問時紀錄使用。</li>
					<li class="h5 pl-3 pt-2">大專決賽簡報隊伍之簡報檔允許美編及動畫修正，若修改數據與文字內容，需提出對照表供評審檢核。</li>
					<li class="h5 pl-3 pt-2">大專決賽簡報時間為10分鐘及評審提問15分鐘。</p>
					<li class="h5 pl-3 pt-2">全國財富管理競賽參賽隊伍之初賽報告書之內容，嚴禁出現足以辨識參賽者任何資訊(姓名、隊名、服務單位、商業圖標…等)，違者取消參賽資格，已繳交之報名費用不予退返。</li>
					<li class="h5 pl-3 pt-2">全國財富管理競賽參賽隊伍於競賽期間，除咨詢時間外，嚴禁以任何形式與案主進行聯繫或接觸，違者取消參賽資格，已繳交之報名費用不予退返。</li>
					<li class="h5 pl-3 pt-2">全國財富管理競賽案主咨詢時間為，隊伍提問一分鐘，案主回答三分鐘。</p>
					<li class="h5 pl-3 pt-2">全國財富管理競賽及全國大專財富管理競賽得獎前三名隊伍於頒獎典禮之成果發表簡報時間為每隊15分鐘</p>
					<li class="h5 pl-3 pt-2">所有競賽應於繳交期間繳交之檔案如有不全或逾期，視同全隊放棄參賽權利，已繳交之報名費用不予退返。</li>
				</ol>
		</div>
	</div>
</section>

<!-- 隱私權保護政策 -->
<section class="testimonials_area p_120">
	<div class="container">
		<h1>隱私權保護政策</h1>
			<div class="pl-3 h5">
				<p>依個人資料保護法要求，請各隊所有成員參與台灣財富管理規劃發展協會活動報名前，務必於詳閱本條款，所有參與活動之人員，詳閱後於報名欄之「同意」欄勾選，始得報名參加本活動。</p>
				<p>本同意條款說明台灣財富管理規劃顧問認證協會（以下簡稱本會）將如何處理本表單所蒐集到的個人資料。當報名時勾選「同意」之欄位選項時，表示參與本活動之所有報名成員均已閱讀、瞭解並同意接受本同意條款之所有內容及其後修改變更規定。若有成員未滿二十歲，應於您的法定代理人閱讀、瞭解並同意本同意條款之所有內容及其後修改變更規定後，方得使用本活動，但若您已接受本活動，視為已取得法定代理人之同意，並遵守以下所有規範。</p>
				<h3>一、基本資料之蒐集、更新及保管</h3>
				<p class="pl-3">1. 本會蒐集您的個人資料在中華民國「個人資料保護法」與相關法令之規範下，依據協會「隱私權保護政策」，蒐集、處理及利用於參與活動之個人資料。</p>
				<p class="pl-3">2. 請於報名時提供正確、最新及完整的個人資料。</p>
				<p class="pl-3">3. 本會因執行業務所蒐集您的個人資料包括姓名、電話、身份證字號、生日、地址、email、現職單位、就讀學校…等。</p>
				<p class="pl-3">4. 若您的個人資料有任何異動，請主動向協會申請更正，使其保持正確、最新及完整。</p>
				<p class="pl-3">5. 若您提供錯誤、不實、過時或不完整或具誤導性的資料，您將損失相關權益。</p>
				<p class="pl-3">6. 成員可依中華民國「個人資料保護法」，通知本會行使以下權利：</p>
				<p class="pl-5">(1)請求補充或更正。</p>
				<p class="pl-5">(2)請求停止蒐集、處理及利用。</p>
				<p class="pl-5">(3)請求刪除。</p>
				<p class="pl-3">但因本會執行職務或業務所必須者，協會得拒絕之。若成員欲執行上述權利時，請透過<strong><a href="https://wmpcca.com/contact/" target="_blank">線上表單</a></strong>與本會聯絡。但因成員行使上述權利，而導致權益受損時，協會將不負相關賠償責任。</p>
				<br>
				<h3>二、蒐集個人資料之目的</h3>
				<p class="pl-3">1. 本會為執行所有參賽成員參與協會所舉辦的活動相關業務需蒐集的個人資料。</p>
				<p class="pl-3">2. 當參賽成員的個人資料使用方式與當初本會蒐集的目的不同時，本會將在使用前先徵求參賽成員的書面同意，成員可以拒絕向協會提供個人資料，但可能因此喪失權益。</p>
				<p class="pl-3">3. 協會利用參賽成員的個人資料期間為即日起1年內，利用地區為台灣地區，於次年定期銷毀所填具之申請表及同意書。</p>
				<br>
				<h3>三、基本資料之保密</h3>
				<p class="pl-3">參賽成員的個人資料受到協會依「個人資料保護法」之保護及規範。協會如違反「個人資料保護法」規定或因天災、事變或其他可抗力所致者，致參賽成員的個人資料被竊取、洩漏、竄改、遭其他侵害者，本會將於查明後以電話、信函、電子郵件或網站公告等方法，擇適當方式通知參賽成員。</p>
				<br>
				<h3>四、同意書之效力</h3>
				<p class="pl-3">1. 當參賽成員於活動報名同意欄位勾選「同意」時視同簽署同意條款，即表示參賽成員已閱讀、瞭解並同意本活動之所有條款及內容，如違反活動辦法及規則條例時，協會得隨時終止對參賽成員所提供之所有權益或服務。</p>
				<p class="pl-3">2. 本會保留隨時修改本同意條款之權利，本會將於修改條款時，於本會網頁(站)公告修改之事實，不另作個別通知。如果參賽成員不同意修改的內容，請勿繼續參與本次活動。否則將視為已同意並接受本同意條款該等增訂或修改內容之拘束。</p>
				<p class="pl-3">3. 參賽成員自本同意條款取得的任何建議或資訊，無論是書面或口頭形式，除非本同意條款有明確規定，均不構成本同意條款以外之任何保證。</p>
				<br>
				<h3>五、準據法與管轄法院</h3>
				<p class="pl-3">本同意條款之解釋與適用，以及本同意條款有關之爭議，均應依照中華民國法律予以處理，並以臺灣臺北地方法院為管轄法院。</p>
			</div>
	</div>
</section>

	

<!--
<section class="price_area p_120">
	<div class="container">
		<h1>活動辦法</h1>
	</div>
</section>
-->





<!-- hidden PHP Time Value-->
<input type="hidden" name="CGcompet" id="CGcompet" Value="<?php echo $CGcompet; ?>">
<input type="hidden" name="CGcompetprojectNO" id="CGcompetprojectNO" Value="<?php echo $CGcompetprojectNO; ?>">
<input type="hidden" name="CGcompetprojectName" id="CGcompetprojectName" Value="<?php echo $CGcompetprojectName; ?>">
	
<!-- hidden PHP Time Value End-->

	
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="../lumino/js/bootstrap.min.js"></script>	
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
	

<?php require_once("../model/index_footer.php") ?>
<?php require_once("../model/index_js.php") ?>

<script type="text/javascript" src="../controller/waitload.js"></script>
<script type="text/javascript" src="../controller/index_nav.js"></script>
<script type="text/javascript" src="../controller/toggle_tooltip.js"></script>
<script type="text/javascript" src="../controller/Division.js"></script>
<!-- nexus JS -->
<script src="../nexus/vendors/owl-carousel/owl.carousel.min.js"></script>
<script src="../controller/compet_CGgetCode.js"></script>
<!-- 輸入框click時, 將小字改回 -->
<script>
$("#schoolDistrict").click(function(){
	$("#schoolMsg").html("※ 宜蘭:北區, 花東離島:南區");
	$("#schoolMsg").css('color', '');
	$("#schoolMsg").css('font-weight', '');
});
$("#teacherName").click(function(){
	$("#teacherNameMsg").html("※ 請填寫全名");
	$("#teacherNameMsg").css('color', '');
	$("#teacherNameMsg").css('font-weight', '');
});
$("#teamName").click(function(){
	$("#teamNameMsg").html("※ 最多8個中文字");
	$("#teamNameMsg").css('color', '');
	$("#teamNameMsg").css('font-weight', '');
});
$("#name").click(function(){
	$("#nameMsg").html("※ 外籍在台人士請填寫居留證件中文全名");
	$("#nameMsg").css('color', '');
	$("#nameMsg").css('font-weight', '');
});
$("#identifyNO").click(function(){
	$("#identifyNOMsg").html("※ 外籍在台人士請填寫居留證號");
	$("#identifyNOMsg").css('color', '');
	$("#identifyNOMsg").css('font-weight', '');
});
$("#email").click(function(){
	$("#emailMsg").html("※ 建議使用gmail");
	$("#emailMsg").css('color', '');
	$("#emailMsg").css('font-weight', '');
});
</script>
</body>
</html>