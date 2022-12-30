<?php
//連結資料庫
require_once("../vender/dbtools.inc.php");

//設定時區
date_default_timezone_set('Asia/Taipei');

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');

//取得今天日期
$getTime = date("Y-m-d H:i:s");

//建立回傳參數
$examNOEPT = "請輸入隊伍編號";
$examNOEXT = "查無此隊伍編號";
$examNOWRG = "隊伍編號格式錯誤";
$pwdEPT = "請輸入驗證碼";
$pwdWRG = "驗證碼錯誤";
$Done = "登入成功";

//取得AJAX傳值
$examNO = $_POST["examNO"];
	if($examNO == ''){
		echo json_encode($examNOEPT);
		exit();
	}
$pwd = $_POST["vCode"];
	if($pwd == ''){
		echo json_encode($pwdEPT);
		exit();
	}

//隊編判斷對應資料表competSocial
if (preg_match("/HT/i", $examNO)){
	
	$examDB = "histock_HTsignup";
	$infoDB = "histock_HTinfo";
	$eventDB = "histock_eventList";
	
	//比對examNO
	$sqlExamNOCHK = mysql_query("
		SELECT * FROM $examDB WHERE examNumber = '$examNO'
	");
	$sqlExamNUMs = mysql_num_rows($sqlExamNOCHK);
		
	//如果examNO不存在
	if ($sqlExamNUMs == 0){
			echo json_encode($examNOEXT);
			exit();
	}else{
	//取得驗證碼並比對
		$sqlpwdCHK = mysql_query("
			SELECT * FROM $examDB WHERE examNumber = '$examNO'
		");
		$sqlpwd = mysql_fetch_row($sqlpwdCHK);

		if (!strcmp($pwd, $sqlpwd[6]) == 0){
			echo json_encode($pwdWRG);
			exit();
			
		}else{
			
			//取得對象報名資訊
			$projectNO = $sqlpwd[2];  // 取得活動代號
			$bachSelect = $sqlpwd[3];  // 取得參加場次
			$bachTimeX = $bachSelect.'Time';		
			
				//取得活動資訊
				$sqlEvent1 = mysql_query("
					SELECT * FROM $eventDB WHERE projectNO = '$projectNO'
				");
				$sqlEvent = mysql_fetch_row($sqlEvent1);
				$projectName = $sqlEvent[3];  // 活動名稱
				$fee = $sqlEvent[4];  // 報名費
				$start = $sqlEvent[5];  //報名開始
				$end = $sqlEvent[6];  // 報名結束
			
				//取得測驗場次資訊 : 時間 時程
				$sqlBachX = mysql_query("
					SELECT $bachSelect FROM $eventDB WHERE projectNO = '$projectNO'
				");
				$sqlBach = mysql_fetch_row($sqlBachX);
				$bach = $sqlBach[0];
			
				//取得測驗場次資訊 : 時間 時程
				$sqlBachTimeX = mysql_query("
					SELECT $bachTimeX FROM $eventDB WHERE projectNO = '$projectNO'
				");
				$sqlBachTime = mysql_fetch_row($sqlBachTimeX);
				$bachTime = $sqlBachTime[0];
		}
		
		//資訊存入陣列
		$passed = "TRUE";
		$loginHT = array($examNO, $pwd, $host, $projectNO, $projectName, $fee, $start, $end, $bach, $bachTime, $passed);
		
		//陣列存入COOKIE
		setcookie("loginInfo", serialize($loginHT), time()+3600, "/" ,"wmpcca.com");
		
		//寫入Log
		$file_name = "../log/competLog.txt"; //檔案名稱
		$file = @file("$file_name"); //讀取檔案
		$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
		$log =  "\r\n$getTime $examNO 登入了競賽專區";
		@fwrite($open,$log); //寫入資料
		fclose($open); //關閉檔案	
		
	}

}

else if(preg_match("/HS/i", $examNO)){
	
	$examDB = "histock_HSsignup";
	$infoDB = "studentsHistock";
	$eventDB = "histock_eventList";
	
	//比對examNO
	$sqlExamNOCHK = mysql_query("
		SELECT * FROM $examDB WHERE examNumber = '$examNO'
	");
	$sqlExamNUMs = mysql_num_rows($sqlExamNOCHK);
		
	//如果examNO不存在
	if ($sqlExamNUMs == 0){
			echo json_encode($examNOEXT);
			exit();
	}else{
	//取得驗證碼並比對
		$sqlpwdCHK = mysql_query("
			SELECT * FROM $examDB WHERE examNumber = '$examNO'
		");
		$sqlpwd = mysql_fetch_row($sqlpwdCHK);
		if (!strcmp($pwd, $sqlpwd[9]) == 0){
			echo json_encode($pwdWRG);
			exit();
			
		}else{
			
			//取得對象報名資訊
			$projectNO = $sqlpwd[2];  // 取得活動代號
			$bachSelect = $sqlpwd[5];  // 取得報名學校區域
			//轉換北中南區
			if ( $bachSelect == 'N' ){
				$bachSelect = 'bach1';
			}
			if ( $bachSelect == 'M' ){
				$bachSelect = 'bach2';
			}
			if ( $bachSelect == 'S' ){
				$bachSelect = 'bach3';
			}
			$bachXTime = $bachSelect.'Time';
			$bachXFinals = $bachSelect.'Finals';
			
				//取得活動資訊
				$sqlEvent1 = mysql_query("
					SELECT * FROM $eventDB WHERE projectNO = '$projectNO'
				");
				$sqlEvent = mysql_fetch_row($sqlEvent1);
				$projectName = $sqlEvent[3];  // 活動名稱
				$fee = $sqlEvent[4];  // 報名費
				$start = $sqlEvent[5];  // 報名開始
				$end = $sqlEvent[6];  // 報名截止
			
				//取得該分區 所有測驗場次資訊 : 時間 時程
				$sqlBachX = mysql_query("
					SELECT $bachSelect, $bachXTime, $bachXFinals FROM $eventDB WHERE projectNO = '$projectNO'
				");
				$sqlBach = mysql_fetch_array($sqlBachX);
				$bach = $sqlBach["$bachSelect"];
				$bachTime = $sqlBach["$bachXTime"];
				$bachFinals = $sqlBach["$bachXFinals"];
			
		}
		
		//資訊存入陣列
		$passed = "TRUE";
		$loginHT = array($examNO, $pwd, $host, $projectNO, $projectName, $fee, $start, $end, $bach, $bachTime, $bachFinals, $passed);
		
		//陣列存入COOKIE
		setcookie("loginInfo", serialize($loginHT), time()+3600, "/" ,"wmpcca.com");
		
		//寫入Log
		$file_name = "../log/competLog.txt"; //檔案名稱
		$file = @file("$file_name"); //讀取檔案
		$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
		$log =  "\r\n$getTime $examNO 登入了競賽專區, 建立cookie: $bachSelect, $bach, $bachTime";
		@fwrite($open,$log); //寫入資料
		fclose($open); //關閉檔案	
		
	}
}

else{
	echo json_encode($examNOWRG);
	exit();
}


//回傳成功訊息
echo json_encode($Done);
exit();



?>