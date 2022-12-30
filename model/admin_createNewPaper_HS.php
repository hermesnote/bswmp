<?php
//連線資料庫
require_once ("../vender/dbtools.inc.php");

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');

//取得今天日期
$todayDate = date("Y-m-d H:i:s");

//取得cookie
$passed = $_COOKIE["passed"];
$account = $_COOKIE["account"];
$staffNO = $_COOKIE["staffNO"];
$staffName = $_COOKIE["staffName"];

// 若cookie中的變數passed不為TRUE，則導回登入頁
if ($passed != "TRUE"){
echo "<script type='text/javascript'>";
echo "alert('COOKIE錯誤!請重新登入！')";
echo "</script>";
header("location:admin_login.php");
exit();
}

//建立回傳參數
$PPDB = "examPP_HiStock";
$ANDB = "examAN_HiStock";
$numberWRG = "題數總和必須為50！";
$done = "操作成功！";


//取得今天日期
$todayDate = date("Y-m-d H:i:s");

//取得AJAX傳送值

$projectNO = "HS20";

$selectA = $_POST["selectA"];
$selectB = $_POST["selectB"];
$selectC = $_POST["selectC"];
$selectD = $_POST["selectD"];
$selectE = $_POST["selectE"];
$selectF = $_POST["selectF"];
$paperAll = $_POST["paperAll"];

// 找出上次未使用之試卷號
$sqlPPX = mysql_query( " SELECT paperNumber FROM examPP_HiStock WHERE examNumber = '' " );
$EPTarr = array();
while ($row = mysql_fetch_array($sqlPPX)){
	$EPTarr[] = $row['paperNumber'];
}
$paperNumberArr = $EPTarr;
$j = count($paperNumberArr);


// 刪除未使用之試卷及答卷
for ( $i=0; $i<=$j; $i++ ){
	mysql_query(" DELETE FROM examPP_HiStock WHERE paperNumber = '$paperNumberArr[$i]' ");
	mysql_query(" DELETE FROM examAN_HiStock WHERE paperNumber = '$paperNumberArr[$i]' ");
}

//寫入Log
	$file_name = "../log/adminLog.txt"; //檔案名稱
	$file = @file("$file_name"); //讀取檔案
	$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
	$log =  "\r\n$todayDate $staffNO 刪除了 $j 筆 題卷及試卷 ";
	@fwrite($open,$log); //寫入資料
	fclose($open); //關閉檔案


//生成卷號
	//生成一組今天的第一組卷號
	$paperToday = date(Ymd)."0001";

	//查詢試卷資料庫是否已存在第一組
	$sqlpaperTodaySearch = "SELECT * FROM $PPDB WHERE paperNumber = '$paperToday'";
	$sqlpaperTodayResult = mysql_query($sqlpaperTodaySearch, $sqlLink);
	$sqlpaperTodayRow = mysql_num_rows($sqlpaperTodayResult);

	//取得資料庫最近一筆卷號
	$sqlgetPaperNOSearch = "SELECT paperNumber FROM $PPDB ORDER BY id DESC";
	$sqlgetPaperNOResult = mysql_query($sqlgetPaperNOSearch, $sqlLink);
	$sqlgetPaperNOFetch = mysql_fetch_row($sqlgetPaperNOResult);
	$paperLastNO = $sqlgetPaperNOFetch[0];

	//如果數組已經存在，則取最近一筆收據尾數+1做為本次起始卷號，如果數組不存在，則直接取用為起始卷號
	if ($sqlpaperTodayRow != 0){
		$paperNumber = $paperLastNO+1;
	}else{
		$paperNumber = $paperToday;
	}

//取得題庫

			
	for ( $i=0; $i < $paperAll; $i++ ){

		//依條件從題庫撈出一張試卷
		$SQL = mysql_query("
			SELECT number,answer FROM (SELECT DISTINCT * FROM examDB_hiStock WHERE category = 'A' ORDER BY RAND() LIMIT $selectA) as TEST
			UNION ALL
			SELECT number,answer FROM (SELECT DISTINCT * FROM examDB_hiStock WHERE category = 'B' ORDER BY RAND() LIMIT $selectB) as TEST
			UNION ALL
			SELECT number,answer FROM (SELECT DISTINCT * FROM examDB_hiStock WHERE category = 'C' ORDER BY RAND() LIMIT $selectC) as TEST
			UNION ALL
			SELECT number,answer FROM (SELECT DISTINCT * FROM examDB_hiStock WHERE category = 'D' ORDER BY RAND() LIMIT $selectD) as TEST
			UNION ALL
			SELECT number,answer FROM (SELECT DISTINCT * FROM examDB_hiStock WHERE category = 'E' ORDER BY RAND() LIMIT $selectE) as TEST
			UNION ALL
			SELECT number,answer FROM (SELECT DISTINCT * FROM examDB_hiStock WHERE category = 'F' ORDER BY RAND() LIMIT $selectF) as TEST ORDER BY number ASC
		");

		//給予題號及答案陣列
		$demo0 = array();
		$demo1 = array();

		//取得題號及答案的陣列值
		while ($row = mysql_fetch_array($SQL)){
			$demo0[] = $row['number'];
			$demo1[] = $row['answer'];
		}

		//將題號寫入試卷資料表
		$sqlInsertPP = "
			INSERT INTO $PPDB ( projectNO, paperNumber, Q1, Q2, Q3, Q4, Q5, Q6, Q7, Q8, Q9, Q10, Q11, Q12, Q13, Q14, Q15, Q16, Q17, Q18, Q19, Q20, Q21, Q22, Q23, Q24, Q25, Q26, Q27, Q28, Q29, Q30, Q31, Q32, Q33, Q34, Q35, Q36, Q37, Q38, Q39, Q40, Q41, Q42, Q43, Q44, Q45, Q46, Q47, Q48, Q49, Q50 )
			VALUES ( '$projectNO', '$paperNumber', '$demo0[0]', '$demo0[1]', '$demo0[2]', '$demo0[3]', '$demo0[4]', '$demo0[5]', '$demo0[6]', '$demo0[7]', '$demo0[8]', '$demo0[9]', '$demo0[10]', '$demo0[11]', '$demo0[12]', '$demo0[13]', '$demo0[14]', '$demo0[15]', '$demo0[16]', '$demo0[17]', '$demo0[18]', '$demo0[19]', '$demo0[20]', '$demo0[21]', '$demo0[22]', '$demo0[23]', '$demo0[24]', '$demo0[25]', '$demo0[26]', '$demo0[27]', '$demo0[28]', '$demo0[29]', '$demo0[30]', '$demo0[31]', '$demo0[32]', '$demo0[33]', '$demo0[34]', '$demo0[35]', '$demo0[36]', '$demo0[37]', '$demo0[38]', '$demo0[39]', '$demo0[40]', '$demo0[41]', '$demo0[42]', '$demo0[43]', '$demo0[44]', '$demo0[45]', '$demo0[46]', '$demo0[47]', '$demo0[48]', '$demo0[49]')
		";
		$sqlDoInsertPP = mysql_query($sqlInsertPP, $sqlLink);

		//將答案寫入答案資料表
		$sqlInsertAN = "
			INSERT INTO $ANDB ( paperNumber, A1, A2, A3, A4, A5, A6, A7, A8, A9, A10, A11, A12, A13, A14, A15, A16, A17, A18, A19, A20, A21, A22, A23, A24, A25, A26, A27, A28, A29, A30, A31, A32, A33, A34, A35, A36, A37, A38, A39, A40, A41, A42, A43, A44, A45, A46, A47, A48, A49, A50 )
			VALUES ( '$paperNumber', '$demo1[0]', '$demo1[1]', '$demo1[2]', '$demo1[3]', '$demo1[4]', '$demo1[5]', '$demo1[6]', '$demo1[7]', '$demo1[8]', '$demo1[9]', '$demo1[10]', '$demo1[11]', '$demo1[12]', '$demo1[13]', '$demo1[14]', '$demo1[15]', '$demo1[16]', '$demo1[17]', '$demo1[18]', '$demo1[19]', '$demo1[20]', '$demo1[21]', '$demo1[22]', '$demo1[23]', '$demo1[24]', '$demo1[25]', '$demo1[26]', '$demo1[27]', '$demo1[28]', '$demo1[29]', '$demo1[30]', '$demo1[31]', '$demo1[32]', '$demo1[33]', '$demo1[34]', '$demo1[35]', '$demo1[36]', '$demo1[37]', '$demo1[38]', '$demo1[39]', '$demo1[40]', '$demo1[41]', '$demo1[42]', '$demo1[43]', '$demo1[44]', '$demo1[45]', '$demo1[46]', '$demo1[47]', '$demo1[48]', '$demo1[49]')
		";
		$sqlDoInsertAN = mysql_query($sqlInsertAN, $sqlLink);

		//卷號+1
		$paperNumber++;
	}


//寫入Log
	$file_name = "../log/adminLog.txt"; //檔案名稱
	$file = @file("$file_name"); //讀取檔案
	$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
	$log =  "\r\n$todayDate $staffNO 產生代號 $projectNO , $paperAll 筆試卷 ";
	@fwrite($open,$log); //寫入資料
	fclose($open); //關閉檔案

//回傳成功訊息
echo json_encode($done);
exit();

?>