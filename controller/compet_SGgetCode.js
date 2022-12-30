// JavaScript Document// JavaScript Document
function SGgetCode() {
	//Checkbox
		if(!$("#agreeCheck").prop("checked")){
			alert('未勾選同意事項！');
			return;
		}
	
	//取得表單值
	var projectNO = $("#SGcompetprojectNO").val();
	var projectName = $("#SGcompetprojectName").val();
	var teamName = $("#teamName").val();
	var name = $("#name").val();
	var identifyNO = $("#identifyNO").val();
	var email = $("#email").val();

	
$.ajax({
	
	url:"https://wmpcca.com/bswmp/form/model/compet_SGgetCode.php",
	data:{
		"projectNO" : projectNO,
		"projectName" : projectName,
		"teamName" : teamName,
		"name" : name,
		"identifyNO" : identifyNO,
		"email" : email
	},
	
	method : "POST",
	
	error : function(msg){
		$("#SGgetCodeMsg").html(msg);
	},
	
	success : function(msg){
		if (msg === '隊名不可為空'){
		$("#teamNameMsg").html(msg);
		$("#teamNameMsg").css('color', 'red');
		$("#teamNameMsg").css('font-weight', 'bold');
		}
		if (msg === '隊名已被使用'){
		$("#teamNameMsg").html(msg);
		$("#teamNameMsg").css('color', 'red');
		$("#teamNameMsg").css('font-weight', 'bold');
		}
		if (msg === '隊名不可使用特殊符號'){
		$("#teamNameMsg").html(msg);
		$("#teamNameMsg").css('color', 'red');
		$("#teamNameMsg").css('font-weight', 'bold');
		}
		if (msg === '隊長姓名不可為空'){
		$("#nameMsg").html(msg);
		$("#nameMsg").css('color', 'red');
		$("#nameMsg").css('font-weight', 'bold');
		}
		if (msg === '隊長姓名不可使用特殊符號'){
		$("#nameMsg").html(msg);
		$("#nameMsg").css('color', 'red');
		$("#nameMsg").css('font-weight', 'bold');
		}
		if (msg === '請勿重覆報名'){
		$("#nameMsg").html(msg);
		$("#nameMsg").css('color', 'red');
		$("#nameMsg").css('font-weight', 'bold');
		}
		if (msg === '身份證字號不可為空'){
		$("#identifyNOMsg").html(msg);
		$("#identifyNOMsg").css('color', 'red');
		$("#identifyNOMsg").css('font-weight', 'bold');
		}
		if (msg === '電子郵件不可為空'){
		$("#emailMsg").html(msg);
		$("#emailMsg").css('color', 'red');
		$("#emailMsg").css('font-weight', 'bold');
		}
		if (msg === '電子郵件格式不正確'){
		$("#emailMsg").html(msg);
		$("#emailMsg").css('color', 'red');
		$("#emailMsg").css('font-weight', 'bold');
		}
		if (msg === '隊名不可使用特殊符號'){
		$("#teamNameMsg").html(msg);
		$("#teamNameMsg").css('color', 'red');
		$("#teamNameMsg").css('font-weight', 'bold');
		}
		if (msg === 'TRUE'){
			window.location.href = "https://wmpcca.com/bswmp/form/view/compet_getCodeInfo.php";
		}
		
	}
	
});
	
}