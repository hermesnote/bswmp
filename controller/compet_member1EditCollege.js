function member1EditCollege() {
    var projectNO = $("#projectNO").val();
	var teamNO = $("#teamNO").val();
	var schoolPre = $("#schoolPre").val();
	var member1Name = $("#member1Name-College").val();
	var member1Sex = $("#member1Sex-College").val();
	var member1ID = $("#member1ID-College").val();
	var member1Birth = $("#member1Birth-College").val();
	var member1Phone = $("#member1Phone-College").val();
	var member1Email = $("#member1Email-College").val();
	var member1City = $("#member1City-College").val();
	var member1District = $("#member1District-College").val();
	var member1Addr = $("#member1Addr-College").val();
	var member1College = $("#member1College").val();
	var member1Depart = $("#member1Depart").val();
	var member1Degree = $("#member1Degree").val();
	var member1Grade = $("#member1Grade").val();
	
$.ajax({

	url:"https://wmpcca.com/bswmp/form/model/compet_member1EditCollege.php",
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
		"addr" : member1Addr,
		"college" : member1College,
		"depart" : member1Depart,
		"degree" : member1Degree,
		"grade" : member1Grade
	},

	method : "POST",

	error : function(msg){
		$("#member1Msg-College").html(msg);
	},

	success : function(msg){

		$("#member1Msg-College").html(msg);
		$("#member1Msg-College").css('color', 'red');
		$("#member1Msg-College").css('font-weight', 'bold');
		
		if (msg === '新增修改完成，系統將自動重新整理'){
			setTimeout(function(){
			window.location.reload();
			},1000);
		}
	}

	});	
		
}// JavaScript Document
