function member1Edit() {
    var projectNO = $("#projectNO").val();
	var teamNO = $("#teamNO").val();
	var member1Name = $("#member1Name").val();
	var member1Sex = $("#member1Sex").val();
	var member1ID = $("#member1ID").val();
	var member1Birth = $("#member1Birth").val();
	var member1Phone = $("#member1Phone").val();
	var member1Email = $("#member1Email").val();
	var member1City = $("#member1City").val();
	var member1District = $("#member1District").val();
	var member1Addr = $("#member1Addr").val();
	var member1Job = $("#member1Job").val();
	var member1Title = $("#member1Title").val();
	var member1Year = $("#member1Year").val();
	
$.ajax({

	url:"https://wmpcca.com/bswmp/form/model/compet_member1Edit.php",
	data:{
		"projectNO" : projectNO,
		"teamNO" : teamNO,
		"name" : member1Name,
		"sex" : member1Sex,
		"identifyNO" : member1ID,
		"birthday" : member1Birth,
		"phone" : member1Phone,
		"email" : member1Email,
		"city" : member1City,
		"district" : member1District,
		"addr" : member1Addr,
		"job" : member1Job,
		"title" : member1Title,
		"year" : member1Year
	},

	method : "POST",

	error : function(msg){
		$("#member1Msg").html(msg);
	},

	success : function(msg){

		$("#member1Msg").html(msg);
		$("#member1Msg").css('color', 'red');
		$("#member1Msg").css('font-weight', 'bold');
		
		if (msg === '新增修改完成，系統將自動重新整理'){
			setTimeout(function(){
			window.location.reload();
			},1000);
		}
	}

	});	
		
}// JavaScript Document
