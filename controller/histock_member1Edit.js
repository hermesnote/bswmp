function member1EditHiStock() {
    var projectNO = $("#projectNO").val();
	var teamNO = $("#teamNO").val();
	var schoolPre = $("#schoolPre").val();
	var member1Name = $("#member1Name-HiStock").val();
	var member1Sex = $("#member1Sex-HiStock").val();
	var member1ID = $("#member1ID-HiStock").val();
	var member1Birth = $("#member1Birth-HiStock").val();
	var member1Phone = $("#member1Phone-HiStock").val();
	var member1Email = $("#member1Email-HiStock").val();
	var member1City = $("#member1City-HiStock").val();
	var member1District = $("#member1District-HiStock").val();
	var member1Addr = $("#member1Addr-HiStock").val();
	
	
$.ajax({

	url:"https://wmpcca.com/bswmp/form/model/histock_member1Edit.php",
	data:{
		"projectNO" : projectNO,
		"teamNO" : teamNO,
		"schoolPre" : schoolPre,
		"name" : member1Name,
		"sex" : member1Sex,
		"identifyNO" : member1ID,
		"birthday" : member1Birth,
		"phone" : member1Phone,
		"email" : member1Email,
		"city" : member1City,
		"district" : member1District,
		"addr" : member1Addr
	},

	method : "POST",

	error : function(msg){
		$("#member1Msg-HiStock").html(msg);
	},

	success : function(msg){

		$("#member1Msg-HiStock").html(msg);
		$("#member1Msg-HiStock").css('color', 'red');
		$("#member1Msg-HiStock").css('font-weight', 'bold');
		
		if (msg === '新增修改完成，系統將自動重新整理'){
			setTimeout(function(){
			window.location.reload();
			},1000);
		}
	}

	});	
		
}// JavaScript Document
