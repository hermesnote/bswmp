function member2EditHiStock() {
    var projectNO = $("#projectNO").val();
	var teamNO = $("#teamNO").val();
	var schoolPre = $("#schoolPre").val();
	var member2Name = $("#member2Name-HiStock").val();
	var member2Sex = $("#member2Sex-HiStock").val();
	var member2ID = $("#member2ID-HiStock").val();
	var member2Birth = $("#member2Birth-HiStock").val();
	var member2Phone = $("#member2Phone-HiStock").val();
	var member2Email = $("#member2Email-HiStock").val();
	var member2City = $("#member2City-HiStock").val();
	var member2District = $("#member2District-HiStock").val();
	var member2Addr = $("#member2Addr-HiStock").val();
	
	
$.ajax({

	url:"https://wmpcca.com/bswmp/form/model/histock_member2Edit.php",
	data:{
		"projectNO" : projectNO,
		"teamNO" : teamNO,
		"schoolPre" : schoolPre,
		"name" : member2Name,
		"sex" : member2Sex,
		"identifyNO" : member2ID,
		"birthday" : member2Birth,
		"phone" : member2Phone,
		"email" : member2Email,
		"city" : member2City,
		"district" : member2District,
		"addr" : member2Addr
	},

	method : "POST",

	error : function(msg){
		$("#member2Msg-HiStock").html(msg);
	},

	success : function(msg){

		$("#member2Msg-HiStock").html(msg);
		$("#member2Msg-HiStock").css('color', 'red');
		$("#member2Msg-HiStock").css('font-weight', 'bold');
		
		if (msg === '新增修改完成，系統將自動重新整理'){
			setTimeout(function(){
			window.location.reload();
			},1000);
		}
	}

	});	
		
}// JavaScript Document
