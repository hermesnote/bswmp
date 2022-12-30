<?php
//連線資料庫
require_once ("../vender/dbtools.inc.php");

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');

//取得現在日期時間
$getToday = date("Y-m-d H:i:s");

//取得前端值
$vCode = $_POST["vCode"];
$months = $_POST["months"];
$amount = $_POST["amount"];


//查詢 vCode @ eventList
$sqlSELECTvCode = " SELECT * FROM eventList WHERE eventCode = '$vCode' ";
$sqlRESULTvCode = mysql_query($sqlSELECTvCode, $sqlLink);
$sqlNUMvCode = mysql_num_rows($sqlRESULTvCode);
$sqlFETCHvCode = mysql_fetch_row($sqlRESULTvCode);
$vCodeDescribe = $sqlFETCHvCode[3];
$vCodeEndTime = $sqlFETCHvCode[5];
$vCodeApplicant = $sqlFETCHvCode[9];
$vCodeStatus = $sqlFETCHvCode[10];

//建立回傳參數


//判斷vCode是否存在eventList
	if ( ($sqlNUMvCode == 0) || (strtotime($vCodeEndTime) <= strtotime($getToday)) || ($vCodeStatus != 'permit') ){
		$vCodeAmount = $amount;
		$vCodeMonths = $months;
		$vCodeDescribe = '無效的vCode';
	}else{
		
		if ($vCodeDescribe == '9折優惠'){
			$vCodeAmount = round($amount*0.9);
			$vCodeMonths = $months;
			$vCodeDescribe = $vCodeDescribe;
		}else if ($vCodeDescribe == '8折優惠'){
			$vCodeAmount = round($amount*0.8);
			$vCodeMonths = $months+3;
			$vCodeDescribe = $vCodeDescribe;
		}else if ($vCodeDescribe == '7折優惠'){
			$vCodeAmount = round($amount*0.7);
			$vCodeMonths = $months+3;
			$vCodeDescribe = $vCodeDescribe;
		}else if ($vCodeDescribe == '6折優惠'){
			$vCodeAmount = round($amount*0.6);
			$vCodeMonths = $months+3;
			$vCodeDescribe = $vCodeDescribe;
		}else if ($vCodeDescribe == '5折優惠'){
			$vCodeAmount = round($amount*0.5);
			$vCodeMonths = $months+3;
			$vCodeDescribe = $vCodeDescribe;
		}else if ($vCodeDescribe == '加贈1個月'){
			$vCodeAmount = $amount;
			$vCodeMonths = $months+1;
			$vCodeDescribe = $vCodeDescribe;
		}else if ($vCodeDescribe == '加贈2個月'){
			$vCodeAmount = $amount;
			$vCodeMonths = $months+2;
			$vCodeDescribe = $vCodeDescribe;
		}else if ($vCodeDescribe == '加贈3個月'){
			$vCodeAmount = $amount;
			$vCodeMonths = $months+3;
			$vCodeDescribe = $vCodeDescribe;
		}else if ($vCodeDescribe == '加贈6個月'){
			$vCodeAmount = $amount;
			$vCodeMonths = $months+6;
			$vCodeDescribe = $vCodeDescribe;
		}else if ($vCodeDescribe == '加贈12個月'){
			$vCodeAmount = $amount;
			$vCodeMonths = $months+12;
			$vCodeDescribe = $vCodeDescribe;
		}
		
	}

//
////判斷vCode內容
//if ($vCodeDescribe == '加贈1個月'){
//	$monthPlus = 1;
//	$totalMonths = $months+$monthPlus;
//}else{
//	echo json_encode($vCodeNOTEXT);
//	exit();
//}
//if ($vCodeDescribe == '加贈2個月'){
//	$monthPlus = 2;
//	$totalMonths = $months+$monthPlus;
//}
//else{
//	echo json_encode($vCodeNOTEXT);
//	exit();
//}

//else{
//	echo json_encode($vCodeNOTEXT);
//	exit();
//}
//if ($vCodeDescribe == '9折優惠'){
//	$amountDiscount = 0.9;
//	$amountDisconted = $amound * 0.9;
//}
//else{
//	echo json_encode($vCodeNOTEXT);
//	exit();
//}
//if ($vCodeDescribe == '8折優惠'){
//	$amountDiscount = 0.8;
//	$amountDisconted = $amound * 0.8;
//}else{
//	echo json_encode($vCodeNOTEXT);
//	exit();
//}
//
//if ($vCodeDescribe == '7折優惠'){
//	$amountDiscount = 0.7;
//	$amountDisconted = $amound * 0.7;
//}else{
//	echo json_encode($vCodeNOTEXT);
//	exit();
//}
//
//if ($vCodeDescribe == '6折優惠'){
//	$amountDiscount = 0.6;
//	$amountDisconted = $amound * 0.6;
//}else{
//	echo json_encode($vCodeNOTEXT);
//	exit();
//}
//
//if ($vCodeDescribe == '5折優惠'){
//	$amountDiscount = 0.5;
//	$amountDisconted = $amound * 0.5;
//}else{
//	echo json_encode($vCodeNOTEXT);
//	exit();
//}


//建立回傳值Array
$arr = array($vCodeAmount, $vCodeMonths, $vCodeDescribe);
echo json_encode($arr);
?>
