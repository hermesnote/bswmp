<?php
//資料庫連線
require_once("../vender/dbtools.inc.php");

//取得輸入的隊伍編號
$teamNO = $_POST["searchBarInput"];

//搜尋隊編是否存在，若不存在則回上一頁
$sqlteamNOSearch = "SELECT * FROM competCollege WHERE teamNO = '$teamNO'";
$sqlteamNOSearchResult = mysql_query($sqlteamNOSearch, $sqlLink);
$sqlteamNORow = mysql_num_rows($sqlteamNOSearchResult);
if ($sqlteamNORow === 0){
	echo"<script type='text/javascript'>";
	echo "alert('隊伍編號不存在！');";
	echo "history.back();";
	echo "</script>";
}

// ******************* orderList *******************

//用隊編取得訂單編號 @ orderList
$sqlorderNOSearch = "SELECT orderNO FROM orderList WHERE customerNO = '$teamNO' ";
$sqlorderNOResult = mysql_query($sqlorderNOSearch, $sqlLink);
$sqlorderNOFetch = mysql_fetch_row($sqlorderNOResult);
$orderNO = $sqlorderNOFetch[0]; // 取得競賽項目名稱

//用隊編取得報名時間 @ orderList
$sqlorderTimeSearch = "SELECT orderTime FROM orderList WHERE customerNO = '$teamNO' ";
$sqlorderTimeResult = mysql_query($sqlorderTimeSearch, $sqlLink);
$sqlorderTimeFetch = mysql_fetch_row($sqlorderTimeResult);
$orderTime = $sqlorderTimeFetch[0]; // 取得競賽項目名稱

//用隊編取得競賽項目 @ orderList
$sqlProjectNameSearch = "SELECT projectName FROM orderList WHERE customerNO = '$teamNO' ";
$sqlProjectNameResult = mysql_query($sqlProjectNameSearch, $sqlLink);
$sqlProjectNameFetch = mysql_fetch_row($sqlProjectNameResult);
$projectName = $sqlProjectNameFetch[0]; // 取得競賽項目名稱

//用隊編取得繳費金額 @ orderList
$sqlMNSearch = "SELECT MN FROM orderList WHERE customerNO = '$teamNO' ";
$sqlMNResult = mysql_query($sqlMNSearch, $sqlLink);
$sqlMNFetch = mysql_fetch_row($sqlMNResult);
$MN = $sqlMNFetch[0]; // 取得繳費金額

//用隊編取得繳費狀態 @ orderList
$sqlPayStatusSearch = "SELECT payStatus FROM orderList WHERE customerNO = '$teamNO' ";
$sqlPayStatusResult = mysql_query($sqlPayStatusSearch, $sqlLink);
$sqlPayStatusFetch = mysql_fetch_row($sqlPayStatusResult);
$payStatus = $sqlPayStatusFetch[0]; // 取得繳費狀態

//用隊編取得繳費時間 @ orderList
$sqlPayTimeSearch = "SELECT payTime FROM orderList WHERE customerNO = '$teamNO' ";
$sqlPayTimeResult = mysql_query($sqlPayTimeSearch, $sqlLink);
$sqlPayTimeFetch = mysql_fetch_row($sqlPayTimeResult);
$payTime = $sqlPayTimeFetch[0]; // 取得繳費時間

		//轉換繳費時間為民國並拆分年月日 108/11/11 12:12:12
		$PaymentDateY = substr($payTime, 0, 4) - 1911;
		$PaymentDateM = substr($payTime, 5, 2);
		$PaymentDateD = substr($payTime, 8, 2);

//用隊編取得收據抬頭 @ orderList
$sqlReceiptTitleSearch = "SELECT receiptTitle FROM orderList WHERE customerNO = '$teamNO' ";
$sqlReceiptTitleResult = mysql_query($sqlReceiptTitleSearch, $sqlLink);
$sqlReceiptTitleFetch = mysql_fetch_row($sqlReceiptTitleResult);
$receiptTitle = $sqlReceiptTitleFetch[0]; // 取得收據抬頭

//用隊編取得統一編號 @ orderList
$sqltaxIDSearch = "SELECT taxID FROM orderList WHERE customerNO = '$teamNO' ";
$sqltaxIDResult = mysql_query($sqltaxIDSearch, $sqlLink);
$sqltaxIDFetch = mysql_fetch_row($sqltaxIDResult);
$taxID = $sqltaxIDFetch[0]; // 取得統一編號

//用隊編取得繳費銀行代碼 @ orderList
$sqlpaymentInfo1Search = "SELECT paymentInfo1 FROM orderList WHERE customerNO = '$teamNO' ";
$sqlpaymentInfo1Result = mysql_query($sqlpaymentInfo1Search, $sqlLink);
$sqlpaymentInfo1Fetch = mysql_fetch_row($sqlpaymentInfo1Result);
$paymentInfo1 = $sqlpaymentInfo1Fetch[0]; // 取得競賽項目名稱

//用隊編取得繳費帳號 @ orderList
$sqlpaymentInfo2Search = "SELECT paymentInfo2 FROM orderList WHERE customerNO = '$teamNO' ";
$sqlpaymentInfo2Result = mysql_query($sqlpaymentInfo2Search, $sqlLink);
$sqlpaymentInfo2Fetch = mysql_fetch_row($sqlpaymentInfo2Result);
$paymentInfo2 = $sqlpaymentInfo2Fetch[0]; // 取得繳費銀行帳號

//用隊編取得超商繳費代碼 @ orderList
$sqlpaymentInfo3Search = "SELECT paymentInfo3 FROM orderList WHERE customerNO = '$teamNO' ";
$sqlpaymentInfo3Result = mysql_query($sqlpaymentInfo3Search, $sqlLink);
$sqlpaymentInfo3Fetch = mysql_fetch_row($sqlpaymentInfo3Result);
$paymentInfo3 = $sqlpaymentInfo3Fetch[0]; // 取得繳費銀行帳號

//用隊編取得繳費期限 @ orderList
$sqlExpireDateSearch = "SELECT ExpireDate FROM orderList WHERE customerNO = '$teamNO' ";
$sqlExpireDateResult = mysql_query($sqlExpireDateSearch, $sqlLink);
$sqlExpireDateFetch = mysql_fetch_row($sqlExpireDateResult);
$ExpireDate = $sqlExpireDateFetch[0]; // 取得繳費期限

// ******************* receiptList *******************

//用訂單編號取得收據號碼 @ receiptList
$sqlreceiptNOSearch = "SELECT receiptNO FROM receiptList WHERE orderNO = '$orderNO' ";
$sqlreceiptNOResult = mysql_query($sqlreceiptNOSearch, $sqlLink);
$sqlreceiptNOFetch = mysql_fetch_row($sqlreceiptNOResult);
$receiptNO = $sqlreceiptNOFetch[0]; // 取得收據號碼

//用訂單編號取得收據狀態 @ receiptList
$sqlreceiptStatusSearch = "SELECT remarks FROM receiptList WHERE orderNO = '$orderNO' ";
$sqlreceiptStatusResult = mysql_query($sqlreceiptStatusSearch, $sqlLink);
$sqlreceiptStatusFetch = mysql_fetch_row($sqlreceiptStatusResult);
$receiptStatus = $sqlreceiptStatusFetch[0]; // 取得競賽項目名稱

// ******************* competScore *******************

//用隊編查詢初賽報告繳交 @ competScore
$sqlfirstReportSearch = "SELECT firstReport FROM competScore WHERE teamNO = '$teamNO' ";
$sqlfirstReportResult = mysql_query($sqlfirstReportSearch, $sqlLink);
$sqlfirstReportFetch = mysql_fetch_row($sqlfirstReportResult);
$firstReport = $sqlfirstReportFetch[0]; // 取得初賽報告繳交

//用隊編查詢初賽成績 @ competScore
$sqlfirstRoundSearch = "SELECT firstRound FROM competScore WHERE teamNO = '$teamNO' ";
$sqlfirstRoundResult = mysql_query($sqlfirstRoundSearch, $sqlLink);
$sqlfirstRoundFetch = mysql_fetch_row($sqlfirstRoundResult);
$firstRound = $sqlfirstRoundFetch[0]; // 取得初賽成績

//用隊編查詢決賽報告繳交 @ competScore
$sqlsecondReportSearch = "SELECT secondReport FROM competScore WHERE teamNO = '$teamNO' ";
$sqlsecondReportResult = mysql_query($sqlsecondReportSearch, $sqlLink);
$sqlsecondReportFetch = mysql_fetch_row($sqlsecondReportResult);
$secondReport = $sqlsecondReportFetch[0]; // 取得決賽報告繳交

//用隊編查詢決賽成績 @ competScore
$sqlsecondRoundSearch = "SELECT secondRound FROM competScore WHERE teamNO = '$teamNO' ";
$sqlsecondRoundResult = mysql_query($sqlsecondRoundSearch, $sqlLink);
$sqlsecondRoundFetch = mysql_fetch_row($sqlsecondRoundResult);
$secondRound = $sqlsecondRoundFetch[0]; // 取得決賽成績

// ******************* competCollege *******************

//判斷參賽組別是否為大專 取得代表學校 隊名 及 指導老師
if (substr($teamNO, 0, 2)=='CG' || 'CN' || 'CC' || 'CS'){

	//用隊編取得代表學校 @ competCollege
	$sqlschoolSearch = "SELECT school FROM competCollege WHERE teamNO = '$teamNO' ";
	$sqlschoolResult = mysql_query($sqlschoolSearch, $sqlLink);
	$sqlschoolFetch = mysql_fetch_row($sqlschoolResult);
	$school = $sqlschoolFetch[0]; // 取得代表學校

	//用隊編取得隊伍名稱 @ competCollege
	$sqlteamNameSearch = "SELECT teamName FROM competCollege WHERE teamNO = '$teamNO' ";
	$sqlteamNameResult = mysql_query($sqlteamNameSearch, $sqlLink);
	$sqlteamNameFetch = mysql_fetch_row($sqlteamNameResult);
	$teamName = $sqlteamNameFetch[0]; // 取得隊伍名稱
	
	//用隊編取得指導老師 @ competCollege
	$sqlteacherSearch = "SELECT teacher FROM competCollege WHERE teamNO = '$teamNO' ";
	$sqlteacherResult = mysql_query($sqlteacherSearch, $sqlLink);
	$sqlteacherFetch = mysql_fetch_row($sqlteacherResult);
	$teacher = $sqlteacherFetch[0]; // 取得指導老師
	
	// ******************* studentsInfo *******************
	
	//用隊編查詢隊長名字 @ studentsInfo
	$sqlcaptainNameSearch = "SELECT name FROM studentsInfo WHERE teamNO = '$teamNO' AND remarks = '隊長' ";
	$sqlcaptainNameResult = mysql_query($sqlcaptainNameSearch, $sqlLink);
	$sqlcaptainNameFetch = mysql_fetch_row($sqlcaptainNameResult);
	$captainName = $sqlcaptainNameFetch[0]; // 取得隊長姓名
	
	//用隊編查詢隊長ID @ studentsInfo
	$sqlcaptainIDSearch = "SELECT identifyNO FROM studentsInfo WHERE teamNO = '$teamNO' AND remarks = '隊長' ";
	$sqlcaptainIDResult = mysql_query($sqlcaptainIDSearch, $sqlLink);
	$sqlcaptainIDFetch = mysql_fetch_row($sqlcaptainIDResult);
	$captainID = $sqlcaptainIDFetch[0]; // 取得隊長ID
	
	//用隊編查詢隊員1名字 @ studentsInfo
	$sqlmember1NameSearch = "SELECT name FROM studentsInfo WHERE teamNO = '$teamNO' AND remarks = '隊員1' ";
	$sqlmember1NameResult = mysql_query($sqlmember1NameSearch, $sqlLink);
	$sqlmember1NameFetch = mysql_fetch_row($sqlmember1NameResult);
	$member1Name = $sqlmember1NameFetch[0]; // 取得隊員1姓名
	
	//用隊編查詢隊員2名字 @ studentsInfo
	$sqlmember2NameSearch = "SELECT name FROM studentsInfo WHERE teamNO = '$teamNO' AND remarks = '隊員2' ";
	$sqlmember2NameResult = mysql_query($sqlmember2NameSearch, $sqlLink);
	$sqlmember2NameFetch = mysql_fetch_row($sqlmember2NameResult);
	$member2Name = $sqlmember2NameFetch[0]; // 取得隊員2姓名
}

// ******************* 整理 *******************

$teamNO = $teamNO;
$orderTime = $orderTime; //報名時間
$projectName = $projectName; //項目名稱
$MN = $MN; //繳費金額
$payStatus = $payStatus; //繳費狀態
$payTime = $payTime; //繳費時間
$PaymentDateY = $PaymentDateY; //繳費時間-民國年
$PaymentDateM = $PaymentDateM; //繳費時間-月
$PaymentDateD = $PaymentDateD; //繳費時間-日
$receiptTitle = $receiptTitle; //收據抬頭
$taxID = $taxID; //統一編號
$paymentInfo1 = $paymentInfo1; //繳費銀行
$paymentInfo2 = $paymentInfo2; //繳費帳號
$paymentInfo3 = $paymentInfo3; //超商代碼
$firstReport = $firstReport; //初賽報告
$firstRound = $firstRound; //初賽成績
$secondReport = $secondReport; //決賽報告
$secondRound = $secondRound; //決賽成績
$school = $school; //代表學校
$teamName = $teamName; //隊名
$teacher = $teacher; //指導老師
$captainName = $captainName; //隊長姓名
$captainID = $captainID; //隊長ID
$member1Name = $member1Name; //隊員1姓名
$member2Name = $member2Name; //隊員2姓名

?>

<!DOCTYPE html>
<html>
<head>
<?php require_once("../model/index_rel.php") ?>

<link rel=stylesheet type="text/css" href="../css/body_global.css">
<link rel=stylesheet type="text/css" href="../css/navbar.css">
<link rel=stylesheet type="text/css" href="../css/index_footer.css">
<link rel=stylesheet type="text/css" href="../css/searchbar.css">
<link rel=stylesheet type="text/css" href="../css/waitload.css">

<meta charset="utf-8">
<title>歡迎光臨 台灣財富管理規劃顧問認證協會</title>
</head>


<body>
<?php require_once("../model/waitload.php") ?>
<?php require_once("../model/index_nav.php") ?>
<?php require_once("../model/index_searchbar.php") ?>
<?php require_once("../model/cc_imgGroup_Modal.php") ?>

<div class="container-fluid">
	<div class="col-xl-8 mx-auto my-5">
		<table class="table table-bordered table-responsive-sm">
			<thead>
				<tr class="table-info  list-group-item-info">
					<td colspan="4" class="text-center h3 font-weight-bold">「<?php echo $teamName; ?>」 隊<span class="h5 ml-3">(<?php echo $teamNO; ?>)</span></td>
				</tr>
			</thead>
			<tbody>
				<tr class="bg-secondary">
					<td width="20%" class="text-center font-weight-bold h5 text-white">報名時間</td>
					<td width="50%" class="text-center font-weight-bold h5 text-white">參賽項目</td>
					<td width="15%" class="text-center font-weight-bold h5 text-white">隊長代表</td>
					<td width="15%" class="text-center font-weight-bold h5 text-white">繳費狀態</td>
				</tr>
				<tr>
					<td class="text-center"><?php echo $orderTime; ?></td>
					<td class="text-center"><?php echo $projectName; ?></td>
					<td class="text-center"><?php echo $captainName; ?></td>
					<td class="text-center" id="payStatus"><?php echo $payStatus; ?></td>
				</tr>
			</tbody>
		</table>
		
		<table class="table table-bordered table-responsive-sm mt-5">
			<thead>
				<tr class="table-warning list-group-item-warning">
					<td colspan="5" class="text-center h3 font-weight-bold">繳 費 資 訊</td>
				</tr>
			</thead>
			<tbody>
				<tr class="bg-secondary">
					<td width="20%" class="text-center font-weight-bold h5 text-white">銀行代碼</td>
					<td width="20%" class="text-center font-weight-bold h5 text-white">匯款帳號</td>
					<td width="20%" class="text-center font-weight-bold h5 text-white">超商代碼</td>
					<td width="20%" class="text-center font-weight-bold h5 text-white">繳費金額</td>
					<td width="20%" class="text-center font-weight-bold h5 text-white">繳費期限</td>
				</tr>
				<tr>
					<td class="text-center"><?php echo $paymentInfo1; ?></td>
					<td class="text-center"><?php echo $paymentInfo2; ?></td>
					<td class="text-center"><?php echo $paymentInfo3; ?></td>
					<td class="text-center"><?php echo $MN; ?></td>
					<td class="text-center"><?php echo $ExpireDate; ?></td>
				</tr>
			</tbody>
		</table>
	
		<table class="table table-bordered table-responsive-sm mt-5">
			<thead>
				<tr class="table-danger list-group-item-danger">
					<td colspan="4" class="text-center h3 font-weight-bold">競 賽 資 訊</td>
				</tr>
			</thead>
			<tbody>
				<tr class="bg-secondary">
					<td width="25%" class="text-center font-weight-bold h5 text-white">初賽報告</td>
					<td width="25%" class="text-center font-weight-bold h5 text-white">初賽成績</td>
					<td width="25%" class="text-center font-weight-bold h5 text-white">決賽報告</td>
					<td width="25%" class="text-center font-weight-bold h5 text-white">決賽成績</td>
				</tr>
				<tr>
					<td class="text-center"><?php echo $firstReport; ?></td>
					<td class="text-center"><?php echo $firstRound; ?></td>
					<td class="text-center"><?php echo $secondReport; ?></td>
					<td class="text-center"><?php echo $secondRound; ?></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

<form name="ccSearchForm" method="post" action="" id="ccSearchForm" target="_blank">
<input type="hidden" name="school" value="<?php echo $school; ?>">
<input type="hidden" name="teamNO" value="<?php echo $teamNO; ?>">
<input type="hidden" name="PaymentDateY" value="<?php echo $PaymentDateY; ?>">
<input type="hidden" name="PaymentDateM" value="<?php echo $PaymentDateM; ?>">
<input type="hidden" name="PaymentDateD" value="<?php echo $PaymentDateD; ?>">
<input type="hidden" name="receiptNO" value="<?php echo $receiptNO; ?>">
<input type="hidden" name="receiptStatus" value="<?php echo $receiptStatus; ?>">
<input type="hidden" name="receiptTitle" value="<?php echo $receiptTitle; ?>">
<input type="hidden" name="teamName" value="<?php echo $teamName; ?>">
<input type="hidden" name="captainName" value="<?php echo $captainName; ?>">
<input type="hidden" name="captainID" value="<?php echo $captainID; ?>">
<input type="hidden" name="member1Name" value="<?php echo $member1Name; ?>">
<input type="hidden" name="member2Name" value="<?php echo $member2Name; ?>">
<input type="hidden" name="projectName" value="<?php echo $projectName; ?>">
<input type="hidden" name="MN" value="<?php echo $MN; ?>">
<input type="hidden" name="payStatus" value="<?php echo $payStatus; ?>">
<input type="hidden" name="firstReport" value="<?php echo $firstReport; ?>">
</form>

<div class="mx-auto text-center my-5">
	<button type="button" onclick="back2Signup();" class="btn btn-outline-success mx-4"><span class="fa fa-arrow-circle-left"></span>回報名頁</button>
	<button type="button" onclick="captainID_chk();" class="btn btn-outline-info mx-4"><span class="fa fa-print"></span>收據列印</button>
	<button type="button" onclick="captainID_chk2()" class="btn btn-outline-danger ml-4" id="dropSignup"><span class="fa fa-times"></span>刪除報名資料</button>
	<button type="button" onclick="participationPage()" class="btn btn-outline-warning ml-4"><span class="fa fa-bookmark"></span>參賽證明</button>
</div>
<?php require_once("../model/index_footer.php") ?>


<?php require_once("../model/index_js.php") ?>
<script type="text/javascript" src="../controller/waitload.js"></script>
<script type="text/javascript" src="../controller/index_nav.js"></script>
<script type="text/javascript" src="../controller/toggle_tooltip.js"></script>
<script type="text/javascript" src="../controller/searchbar.js"></script>

<script>
	function captainID_chk(){
		var inputID = prompt('請輸入隊長的身份證字號');
		if (document.ccSearchForm.captainID.value != inputID) {
			alert('隊長身份證字號錯誤!');
			return false;
	}else{
		receiptPage();
	}
}
	
	function captainID_chk2(){
		var inputID = prompt('請輸入隊長的身份證字號');
		if (document.ccSearchForm.captainID.value != inputID) {
			alert('隊長身份證字號錯誤!');
			return false;
	}else{
		dropCompetData();
	}
}	

	function back2Signup(){
		document.location.href="https://wmpcca.com/bswmp/form/view/cc_signup.php";
	}	
	
	function receiptPage(){
	$("#ccSearchForm").attr("action", "https://wmpcca.com/bswmp/form/receipt_CG.php");
	ccSearchForm.submit();
	}
		
	function participationPage(){
	$("#ccSearchForm").attr("action", "https://wmpcca.com/bswmp/form/entryProve_CG.php");
	ccSearchForm.submit();
	}

	function dropCompetData(){
	$("#ccSearchForm").attr("action", "https://wmpcca.com/bswmp/form/model/search_DropCompetData.php");
	$("#ccSearchForm").attr("target", "");
	ccSearchForm.submit();
	}	

	console.log($("#payStatus").text())
	if($("#payStatus").text() === "完成"){
		$("#dropSignup").css("display","none")
	}

</script>

</body>
</html>
