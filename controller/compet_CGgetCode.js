// JavaScript Document// JavaScript Document
function CGgetCode() {
	'use strict';
	
	//取號Button失效
	$(".buttonFail").attr('disabled', 'disabled');
	
	//Checkbox
		if(!$("#agreeCheck").prop("checked")){
			alert('未勾選同意事項！');
			$(".buttonFail").removeAttr('disabled');
			return;
		}
	
	//輔導顧問 Advisor
		if(!$("#needAdvisor").prop("checked")){
			var x = confirm('貴隊將不配發競賽輔導顧問！按「確定」繼續報名，或「取消」重新選擇！');
			if(x !== true){
				$(".buttonFail").removeAttr('disabled');
				return;
			}
		}

	//取得表單值
	var projectNO = $("#CGcompetprojectNO").val();
	var schoolDistrict = $("#schoolDistrict").val();
	var schoolPre = $("#schoolPre").val();
	var teacherName = $("#teacherName").val();
	var teamName = $("#teamName").val();
	var name = $("#name").val();
	var identifyNO = $("#identifyNO").val();
	var email = $("#email").val();
	var advisor = $("#needAdvisor").val();
	
$.ajax({

	url:"https://wmpcca.com/bswmp/form/model/compet_CGgetCode.php",
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
		$("#CGgetCodeMsg").html(Msg);
	},
	
	success : function(Msg){
		if (Msg === '請選擇代表學校'){
		$("#schoolMsg").html(Msg);
		$("#schoolMsg").css('color', 'red');
		$("#schoolMsg").css('font-weight', 'bold');
		$(".buttonFail").removeAttr('disabled');
		}
		if (Msg === '請填寫指導老師姓名'){
		$("#teacherNameMsg").html(Msg);
		$("#teacherNameMsg").css('color', 'red');
		$("#teacherNameMsg").css('font-weight', 'bold');
		$(".buttonFail").removeAttr('disabled');
		}
		if (Msg === '隊名不可為空'){
		$("#teamNameMsg").html(Msg);
		$("#teamNameMsg").css('color', 'red');
		$("#teamNameMsg").css('font-weight', 'bold');
		$(".buttonFail").removeAttr('disabled');
		}
		if (Msg === '隊名已被使用'){
		$("#teamNameMsg").html(Msg);
		$("#teamNameMsg").css('color', 'red');
		$("#teamNameMsg").css('font-weight', 'bold');
		$(".buttonFail").removeAttr('disabled');
		}
		if (Msg === '隊名不可使用特殊符號'){
		$("#teamNameMsg").html(Msg);
		$("#teamNameMsg").css('color', 'red');
		$("#teamNameMsg").css('font-weight', 'bold');
		$(".buttonFail").removeAttr('disabled');
		}
		if (Msg === '隊長姓名不可為空'){
		$("#nameMsg").html(Msg);
		$("#nameMsg").css('color', 'red');
		$("#nameMsg").css('font-weight', 'bold');
		$(".buttonFail").removeAttr('disabled');
		}
		if (Msg === '隊長姓名不可使用特殊符號'){
		$("#nameMsg").html(Msg);
		$("#nameMsg").css('color', 'red');
		$("#nameMsg").css('font-weight', 'bold');
		$(".buttonFail").removeAttr('disabled');
		}
		if (Msg === '請勿重覆報名'){
		$("#nameMsg").html(Msg);
		$("#nameMsg").css('color', 'red');
		$("#nameMsg").css('font-weight', 'bold');
		$(".buttonFail").removeAttr('disabled');
		}
		if (Msg === '身份證字號不可為空'){
		$("#identifyNOMsg").html(Msg);
		$("#identifyNOMsg").css('color', 'red');
		$("#identifyNOMsg").css('font-weight', 'bold');
		$(".buttonFail").removeAttr('disabled');
		}
		if (Msg === '電子郵件不可為空'){
		$("#emailMsg").html(Msg);
		$("#emailMsg").css('color', 'red');
		$("#emailMsg").css('font-weight', 'bold');
		$(".buttonFail").removeAttr('disabled');
		}
		if (Msg === '電子郵件格式不正確'){
		$("#emailMsg").html(Msg);
		$("#emailMsg").css('color', 'red');
		$("#emailMsg").css('font-weight', 'bold');
		$(".buttonFail").removeAttr('disabled');
		}
		if (Msg === '隊名不可使用特殊符號'){
		$("#teamNameMsg").html(Msg);
		$("#teamNameMsg").css('color', 'red');
		$("#teamNameMsg").css('font-weight', 'bold');
		$(".buttonFail").removeAttr('disabled');
		}
		if (Msg === 'TRUE'){
			window.location.href = "https://wmpcca.com/bswmp/form/view/compet_getCodeInfo.php";
		}
		
	}
	
});
	
}