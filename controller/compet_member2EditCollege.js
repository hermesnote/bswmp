function member2EditCollege() {
    var projectNO = $("#projectNO").val();
	var teamNO = $("#teamNO").val();
	var schoolPre = $("#schoolPre").val();
	var member2Name = $("#member2Name-College").val();
	var member2Sex = $("#member2Sex-College").val();
	var member2ID = $("#member2ID-College").val();
	var member2Birth = $("#member2Birth-College").val();
	var member2Phone = $("#member2Phone-College").val();
	var member2Email = $("#member2Email-College").val();
	var member2City = $("#member2City-College").val();
	var member2District = $("#member2District-College").val();
	var member2Addr = $("#member2Addr-College").val();
	var member2College = $("#member2College").val();
	var member2Depart = $("#member2Depart").val();
	var member2Degree = $("#member2Degree").val();
	var member2Grade = $("#member2Grade").val();
	
$.ajax({

	url:"https://wmpcca.com/bswmp/form/model/compet_member2EditCollege.php",
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
		"addr" : member2Addr,
		"college" : member2College,
		"depart" : member2Depart,
		"degree" : member2Degree,
		"grade" : member2Grade
	},

	method : "POST",

	error : function(msg){
		$("#member2Msg-College").html(msg);
	},

	success : function(msg){

		$("#member2Msg-College").html(msg);
		$("#member2Msg-College").css('color', 'red');
		$("#member2Msg-College").css('font-weight', 'bold');
		
		if (msg === '新增修改完成，系統將自動重新整理'){
			setTimeout(function(){
			window.location.reload();
			},1000);
		}
	}

	});	
		
}// JavaScript Document
