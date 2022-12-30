// JavaScript Document// JavaScript Document
function HSgetCode() {
	
	//取號Button失效
	$("#HsgetCodeButton").attr('disabled', 'disabled');
	
	//Checkbox
		if(!$("#agreeCheck").prop("checked")){
			alert('未勾選同意事項！');
			return;
		}
	
	//取得表單值
		// 學校與隊名
	var projectNO= $("#projectNO").val();
	var conference = $("#conference").val();
	var city = $("#city").val();
	var hischool = $("#hischool").val();
	var teacher = $("#teacherName").val();
	var teamName = $("#teamName").val();

		// 隊長資料
	var capName = $("#capName").val();
	var capId = $("#capId").val();
	var capSN = $("#capSN").val();
	var capMobile = $("#capMobile").val();
	var capEmail = $("#capEmail").val();
	
		// 副手資料
	var viceName = $("#viceName").val();
	var viceId = $("#viceId").val();
	var viceSN = $("#viceSN").val();
	var viceMobile = $("#viceMobile").val();
	var viceEmail = $("#viceEmail").val();
	
		// 隊員資料
	var memName = $("#memName").val();
	var memId = $("#memId").val();
	var memSN = $("#memSN").val();
	var memMobile = $("#memMobile").val();
	var memEmail = $("#memEmail").val();
	
$.ajax({
	
	url:"https://wmpcca.com/bswmp/form/model/histock_HSgetCode.php",
	data:{
		// 學校隊伍
		"projectNO" : projectNO,
		"conference" : conference,
		"city" : city, 
		"hischool" : hischool,
		"teacher" : teacher,
		"teamName" : teamName,
		// 隊長
		"capName" : capName,
		"capId" : capId,
		"capSN" : capSN,
		"capMobile" : capMobile,
		"capEmail" : capEmail,
		// 副手
		"viceName" : viceName,
		"viceId" : viceId,
		"viceSN" : viceSN,
		"viceMobile" : viceMobile,
		"viceEmail" : viceEmail,
		// 隊員
		"memName" : memName,
		"memId" : memId,
		"memSN" : memSN,
		"memMobile" : memMobile,
		"memEmail" : memEmail
	},
	
	method : "POST",
	
	error : function(Msg){
		$("#HSgetCodeMsg").html(Msg);
	},
	
	success : function(Msg){
		if (Msg === 'done'){
			window.location.href = "https://wmpcca.com/bswmp/form/view/histock_getCodeInfo.php";
		}
		
	}
	
});
	
}