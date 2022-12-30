<?php
//連線資料庫
require_once("../vender/dbtools.inc.php");

//默認時區
date_default_timezone_set('PRC');

//取得現在日期時間
$getTime = date("Y-m-d H:i:s");

// 解帳號資訊陣列
$loginInfo = unserialize($_COOKIE["loginInfo"]);
$examData = unserialize($_COOKIE["examData"]);

// 取得帳號資訊
$examNO = $loginInfo[0];	//帳號

// 解測驗資訊陣列
$paperNumber = $examData[0];
$AQstart = $examData[1];
$AQend = $examData[2];
$PPZ = $examData[3];
$AQZ = $examData[4];

// 取得當前試題欄位題號
$sqlPaperX = mysql_query("
	SELECT $PPZ FROM examPP_HiStock
");
$sqlPaperY = mysql_fetch_row($sqlPaperX);
$topicNumber = $sqlPaperY[0];

// 取得當前題號資料
$sqlDBX = mysql_query("
	SELECT * FROM examDB_hiStock WHERE number = '$topicNumber'
");
$sqlDBY = mysql_fetch_row($sqlDBX);
$number = $sqlDBY[3];	// 當前題號
$topic = $sqlDBY[4];	// 題目
$choiceA = $sqlDBY[5];	// 選項A
$choiceB = $sqlDBY[6];	// 選項B
$choiceC = $sqlDBY[7];	// 選項C
$choiceD = $sqlDBY[8];	// 選項D


?>

<!doctype html>

<html>
<head>
<?php require_once("../model/index_rel.php") ?>
<!--<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">-->
<link rel=stylesheet type="text/css" href="../css/body_global.css">
	
<!-- Countdown Timer Default Style -->
<!--<link href="../vender/countdownBar/countdownProgressBar.css" rel="stylesheet">	-->

<meta charset="utf-8">

<title>模擬測驗</title>

<style>
/* section頭尾距 */
.examHeadline{
	background-color: navy;
	color: white;
	font-size: 16px;
	text-align: left;
}
.examTitle{
	padding-top: 30px;
	padding-bottom: 30px;
	background-color: silver;
}
	
.examImport{
	padding-top: 50px;
	padding-bottom: 50px;
	background-color: white;
}

/* 左右邊框線 */
.br-1{
	border-right:1px #E0E0E0 solid;
}

.bl-1{
	border-left:1px #E0E0E0 solid;
}	
.hoverPointer{
	cursor: pointer;
}
	
/* Radio Style */
input[type=radio] {
  width: 15px;
  height: 15px;
}

input[type=radio] {
  transform: scale(1.5);
}

input[type=radio]:checked+label {
    font-weight: 800;
	color: blue;
	text-decoration: underline;
}

</style>
	
</head>

<body>

<!-- Headline -->
<section class="examHeadline">
	<div class="row pl-5">
歡迎使用 台灣財富管理規劃顧問認證協會 - 【金融與證券投資實務競賽】線上模擬測驗系統
	</div>
</section>
	
<!-- 競賽規則 -->
<section class="examTitle">
	<div class="container-fluid">
		<div class="row text-center">
			<div class="col-3">
				<div class="pl-2 text-left">准考證號：<span id="examNumber"><? echo $examNO; ?></span></div>
				<div class="pl-2 text-left">測驗卷號：<span id="paperNumber"><? echo $paperNumber; ?></span></div>
			</div>
			<div class="col-6 text-center mx-auto">
				<div class="h2">金融證券投資實務測驗</div>
				<div class="h5">距離本次測驗結束時間尚有：<span id="examTimer"></span></div>
			</div>
			<div class="col-3 text-right">
				<div class="mr-5 pr-5">測驗開始時間：<? echo $AQstart; ?></div>
				<div class="mr-5 pr-5">測驗結束時間：<span id="examEndTime"><? echo $AQend; ?></span></div>
			</div>
		</div>
	</div>
</section>
	
<!-- 作答區 -->
<section class="examImport" id="examArea">
<div class="container">
	<div class="row">
		<div class="col-md-2 h4 text-center">
			第【 <span id="listNumber"><? echo substr($PPZ, 1); ?></span> 】題
		</div>
		<div class="col-md-10 h3">
			<span id="getTopic"><? echo $topic; ?></span><span class="h6 text-muted ml-3" id="getNumber"><? echo $number; ?></span>
		</div>
	</div>
	
	<div class="row mt-2 ml-3">
		<div class="col-md-2"></div>
		<div class="col-md-10">
			<input type="radio" class="mr-3" name="optionsRadios" id="showChoiceA" value="A">
			<label for="showChoiceA"><span class="h4 hoverPointer" id="getChoiceA"><? echo $choiceA; ?></span></label>
		</div>
	</div>
	
	<div class="row mt-1 ml-3">
		<div class="col-md-2"></div>
		<div class="col-md-10">
			<input type="radio" class="mr-3" name="optionsRadios" id="showChoiceB" value="B">
			<label for="showChoiceB"><span class="h4 hoverPointer" id="getChoiceB"><? echo $choiceB; ?></span></label>
		</div>
	</div>
	
	<div class="row mt-1 ml-3">
		<div class="col-md-2"></div>
		<div class="col-md-10">
			<input type="radio" class="mr-3" name="optionsRadios" id="showChoiceC" value="C">
			<label for="showChoiceC"><span class="h4 hoverPointer" id="getChoiceC"><? echo $choiceC; ?></span></label>
		</div>
	</div>
	
	<div class="row mt-1 ml-3">
		<div class="col-md-2"></div>
		<div class="col-md-10">
			<input type="radio" class="mr-3" name="optionsRadios" id="showChoiceD" value="D">
			<label for="showChoiceD"><span class="h4 hoverPointer" id="getChoiceD"><? echo $choiceD; ?></span></label>
		</div>
	</div>
	
	<div class="row mt-5">
		<div class="col-2 text-center"></div>
		<div class="col-10 text-right">
			<button class="btn btn-lg btn-secondary px-5 mr-5" id="goNextButton" onClick="goNext()">下一題</button>
			<button class="btn btn-lg btn-success px-5 mr-5" id="goResultButton" onClick="goResult()">結束測驗</button>
		</div>
	</div>
	
</div>
	
<div class="mt-5 text-center border-warning" style="width:50%;margin: 0 auto;background-color: lightgrey;height: 50px;">
	<div id="myBar" class="text-center text-light font-weight-bolder align-self-center" style="width:100%;background-color: seagreen;height: 50px;">
		<h3 style="padding-top: 8px;">60</h3>
	</div>
</div>
	
<div id="getAT"></div>
	
</section>		

	
<!--<input onclick="window.close();" value="關閉視窗" type="button">-->

	
<section class="examImport" id="resultArea">
	<div class="container">
		<div class="h2 mx-auto text-center">測驗成績：<span id="score"></span></div>
		<div class="row">
			<div class="col">
				<table class="mx-auto text-center" border="1" width="100%">
					
					<tr>
						<td width="10%">第1題</td>
						<td width="10%">第2題</td>
						<td width="10%">第3題</td>
						<td width="10%">第4題</td>
						<td width="10%">第5題</td>
						<td width="10%">第6題</td>
						<td width="10%">第7題</td>
						<td width="10%">第8題</td>
						<td width="10%">第9題</td>
						<td width="10%">第10題</td>
					</tr>
					
					<tr>
						<td width="10%" id="outAN0"></td>
						<td width="10%" id="outAN1"></td>
						<td width="10%" id="outAN2"></td>
						<td width="10%" id="outAN3"></td>
						<td width="10%" id="outAN4"></td>
						<td width="10%" id="outAN5"></td>
						<td width="10%" id="outAN6"></td>
						<td width="10%" id="outAN7"></td>
						<td width="10%" id="outAN8"></td>
						<td width="10%" id="outAN9"></td>
					</tr>
					
					<tr>
						<td width="10%">第11題</td>
						<td width="10%">第12題</td>
						<td width="10%">第13題</td>
						<td width="10%">第14題</td>
						<td width="10%">第15題</td>
						<td width="10%">第16題</td>
						<td width="10%">第17題</td>
						<td width="10%">第18題</td>
						<td width="10%">第19題</td>
						<td width="10%">第20題</td>
					</tr>
					
					<tr>
						<td width="10%" id="outAN10">0</td>
						<td width="10%" id="outAN11"></td>
						<td width="10%" id="outAN12"></td>
						<td width="10%" id="outAN13"></td>
						<td width="10%" id="outAN14"></td>
						<td width="10%" id="outAN15"></td>
						<td width="10%" id="outAN16"></td>
						<td width="10%" id="outAN17"></td>
						<td width="10%" id="outAN18"></td>
						<td width="10%" id="outAN19"></td>
					</tr>
					
					<tr>
						<td width="10%">第21題</td>
						<td width="10%">第22題</td>
						<td width="10%">第23題</td>
						<td width="10%">第24題</td>
						<td width="10%">第25題</td>
						<td width="10%">第26題</td>
						<td width="10%">第27題</td>
						<td width="10%">第28題</td>
						<td width="10%">第29題</td>
						<td width="10%">第30題</td>
					</tr>
					
					<tr>
						<td width="10%" id="outAN20"></td>
						<td width="10%" id="outAN21"></td>
						<td width="10%" id="outAN22"></td>
						<td width="10%" id="outAN23"></td>
						<td width="10%" id="outAN24"></td>
						<td width="10%" id="outAN25"></td>
						<td width="10%" id="outAN26"></td>
						<td width="10%" id="outAN27"></td>
						<td width="10%" id="outAN28"></td>
						<td width="10%" id="outAN29"></td>
					</tr>
					
					<tr>
						<td width="10%">第31題</td>
						<td width="10%">第32題</td>
						<td width="10%">第33題</td>
						<td width="10%">第34題</td>
						<td width="10%">第35題</td>
						<td width="10%">第36題</td>
						<td width="10%">第37題</td>
						<td width="10%">第38題</td>
						<td width="10%">第39題</td>
						<td width="10%">第40題</td>
					</tr>
					
					<tr>
						<td width="10%" id="outAN30"></td>
						<td width="10%" id="outAN31"></td>
						<td width="10%" id="outAN32"></td>
						<td width="10%" id="outAN33"></td>
						<td width="10%" id="outAN34"></td>
						<td width="10%" id="outAN35"></td>
						<td width="10%" id="outAN36"></td>
						<td width="10%" id="outAN37"></td>
						<td width="10%" id="outAN38"></td>
						<td width="10%" id="outAN39"></td>
					</tr>
					
					<tr>
						<td width="10%">第41題</td>
						<td width="10%">第42題</td>
						<td width="10%">第43題</td>
						<td width="10%">第44題</td>
						<td width="10%">第45題</td>
						<td width="10%">第46題</td>
						<td width="10%">第47題</td>
						<td width="10%">第48題</td>
						<td width="10%">第49題</td>
						<td width="10%">第50題</td>
					</tr>
					
					<tr>
						<td width="10%" id="outAN40"></td>
						<td width="10%" id="outAN41"></td>
						<td width="10%" id="outAN42"></td>
						<td width="10%" id="outAN43"></td>
						<td width="10%" id="outAN44"></td>
						<td width="10%" id="outAN45"></td>
						<td width="10%" id="outAN46"></td>
						<td width="10%" id="outAN47"></td>
						<td width="10%" id="outAN48"></td>
						<td width="10%" id="outAN49"></td>
					</tr>
					
				</table>
			</div>
		</div>
		
		<div class="row mt-3">
			<div class="col">
				<div id="clickTopic"></div>
			</div>
		</div>
		
		<div class="row mt-2">
			<div class="col-6">
				<div id="clickChoiceA"></div>
			</div>
			<div class="col-6">
				<div id="clickChoiceB"></div>
			</div>
		</div>
		
		<div class="row mt-1">
			<div class="col-6">
				<div id="clickChoiceC"></div>
			</div>
			<div class="col-6">
				<div id="clickChoiceD"></div>
			</div>
		</div>
		
		<div class="row mt-5">
			<div class="col-12 text-center">
				<button class="btn btn-lg btn-secondary" id="endExamButton" onClick="endExam()">提交成績</button>
			</div>
		</div>
		
	</div>
</section>		


	
<?php require_once("../model/index_js.php") ?>
<!-- Jquery CountDown -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.countdown/2.2.0/jquery.countdown.min.js" integrity="sha512-lteuRD+aUENrZPTXWFRPTBcDDxIGWe5uu0apPEn+3ZKYDwDaEErIK9rvR0QzUGmUQ55KFE2RqGTVoZsKctGMVw==" crossorigin="anonymous"></script>

<!-- 自定義 Javascript -->

	<!-- Radio選項字變色 -->
<script>
$("input[type=radio]:checked").each(function () {
  ;
});
</script>	
	
	
<script>
// 載入時隱藏結算按鈕
$(document).ready(function (){
	$("#goResultButton").hide();
	$("#resultArea").hide();
	var listNumber = parseInt($("#listNumber").text());
	if (listNumber == 50){
	$("#goNextButton").hide();
	$("#goResultButton").show();
}
});
	
// 答題60秒倒數
function getAnswerCountdown() {
	return new Date().getTime() + 60*1000;
}

var $answerClock = $("#myBar");
var ansS = 60;
$answerClock.countdown(getAnswerCountdown(), function(e) {
		var elem = document.getElementById("myBar");
		var barWidth = Math.round((e.offset.totalSeconds)/60*100);
		elem.style.width = barWidth + '%'; 
		elem.getElementsByTagName("h3")[0].innerHTML = e.offset.totalSeconds;
		ansS = e.offset.totalSeconds;
//	$(this).html(event.strftime("%S"));
})
	.on('finish.countdown', function() {
		var elem = document.getElementById("myBar");
//		var barWidth = Math.round((e.offset.totalSeconds)/60*100);
		elem.style.width = '0'; 
		elem.getElementsByTagName("h3")[0].innerHTML = '&nbsp;';
	//倒數終止時Do Something
})
	
	
//下一題取值
function goNext() {
	
	//取得倒數秒數
//	var ansS = parseInt(document.getElementById("myBar").getElementsByTagName("h3")[0].innerHTML);  //取得現在倒數中秒數轉為int	
	console.log(ansS)
	//取得現在題序
	var listNumber = parseInt($("#listNumber").text());
	
	// 取得examNumber PaperNumber
	var examNumber = $("#examNumber").text();
	var paperNumber = $("#paperNumber").text();
	
	//取得作答選項
	var AQ = $("input[name=optionsRadios]:checked").val();
		//若沒作答
	if (AQ == undefined){
			swal({
				title: "等等...現在放棄的話...",
				text: "測驗還是不會結束喔~",
				icon: "warning",
				button: "我知道了",
			});
			return;
	}
	
	// 回傳下一題Ajax
	$.ajax({

		url:"https://wmpcca.com/bswmp/form/model/exam_HiStock_Exam_getNextQuestion.php",
		data:{
			"listNumber" : listNumber,
			"examNumber" : examNumber,
			"paperNumber" : paperNumber,
			"ansS" : ansS,
			"AQ" : AQ
		},

		method : "POST",

		error : function(msg){
			alert('Something Wrong!!!');
		},

		success : function(msg){
			
//			alert(msg);
			
			$("#listNumber").html(msg[0]);
			$("#getNumber").html(msg[1]);
			$("#getTopic").html(msg[2]);
			$("#getChoiceA").html(msg[3]);
			$("#getChoiceB").html(msg[4]);
			$("#getChoiceC").html(msg[5]);
			$("#getChoiceD").html(msg[6]);
			$("#getAT").html(msg[7]);
			
			if (msg[0] == 50){
				$("#goNextButton").hide();
				$("#goResultButton").show();
			}
		}
	});
	
	$("input[name=optionsRadios]").prop('checked', false);
	$answerClock.countdown(getAnswerCountdown());  //重新執行計時程式
	
}

// 結算
function goResult() {
	
	//取得倒數秒數
//	var ansS = parseInt($answerClock[0].innerHTML.split(':')[1]);  //取得現在倒數中秒數轉為int
	
	//取得現在題序
	var listNumber = parseInt($("#listNumber").text());
	
	//取得作答選項
	var AQ = $("input[name=optionsRadios]:checked").val();
	
	// 取得examNumber PaperNumber
	var examNumber = $("#examNumber").text();
	var paperNumber = $("#paperNumber").text();
	
	// 前往結算頁面Ajax
	$.ajax({

		url:"https://wmpcca.com/bswmp/form/model/exam_HiStock_Exam_goResult.php",
		data:{
			"listNumber" : listNumber,
			"examNumber" : examNumber,
			"paperNumber" : paperNumber,
			"ansS" : ansS,
			"AQ" : AQ
		},

		method : "POST",

		error : function(msg){
			alert('Something Wrong!!!');
		},

		success : function(msg){
			
			$("#examArea").hide();
			$("#resultArea").show();
			
			var NB = msg[0];
			var AN = msg[1];
			var AQ = msg[2];
			var AT = msg[3];
			var score = 0;
			
			for(var i=0; i<50;i++){

				if( AN[i] == AQ[i] ){
					score += 1.4 + (parseInt(AT[i])*0.01);
					$("#outAN"+i+"").html(AN[i]);
				}else{
					$("#outAN"+i+"").html(`<span style="cursor:pointer;" onclick="getExam('${NB[i]}')">${AQ[i]}</span>`);
					$("#outAN"+i+"").css("color", "red");
				}
			}
			var score = score.toFixed(2);
			$("#score").html(score);	
		}
	});
}
function getExam(num){
	$.ajax({

		url:"https://wmpcca.com/bswmp/form/model/exam_HiStock_Exam_resultClick.php",
		data:{
			"number" : num
		},

		method : "POST",

		error : function(msg){
			alert('Something Wrong!!!');
		},

		success : function(msg){
			$("#clickTopic").html('【題目】：'+msg[0]);
			$("#clickChoiceA").html('［選項Ａ］：'+msg[1]);
			$("#clickChoiceB").html('［選項Ｂ］：'+msg[2]);
			$("#clickChoiceC").html('［選項Ｃ］：'+msg[3]);
			$("#clickChoiceD").html('［選項Ｄ］：'+msg[4]);
		}
	});
}	

</script>


<script>
// 測驗50分倒數
var examEnd = $("#examEndTime").text();
var diffTime = new Date(examEnd).getTime();
var $examClock = $("#examTimer");
$examClock.countdown(diffTime, function(event) {
	$(this).html(event.strftime("%H:%M:%S"));
})
	.on('finish.countdown', function() {
	alert('測驗結束！');//倒數終止時Do Something
	goResult();
//	window.location.href = "https://wmpcca.com/bswmp/form/view/exam_HiStock_Mock_Result.php";
})
;
</script>
	
<script>
function endExam(){
	
	// 取得examNumber score
	var examNumber = $("#examNumber").text();
	var paperNumber = $("#paperNumber").text();
	var score = $("#score").text();
	
	$.ajax({

		url:"https://wmpcca.com/bswmp/form/model/exam_HiStock_Exam_endExam.php",
		data:{
			"examNumber" : examNumber,
			"paperNumber" : paperNumber,
			"score" : score
		},

		method : "POST",

		error : function(msg){
			alert('Something Wrong!!!');
		},

		success : function(msg){
			
			if(msg == 'done'){
				alert('您的測驗成績已成功送出！');
				window.close();
			}
		}
	});
}
</script>

<!-- 禁用F5及右鍵 -->
<script>
	// 禁用F5
	$(document).ready(function(){
		$(document).bind("keydown",function(e){
			var e=window.event||e;if(e.keyCode==116){ e.keyCode = 0; return false;} 
		}) 
	});
	
	// 禁用右鍵
	$(document).ready(function() { $(document).bind("contextmenu",function(e) { alert("測驗過程禁用滑鼠右鍵！"); return false; }); });
	
	// 禁用倒退鍵
</script>
	
	
</body>
</html>