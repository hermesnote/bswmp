function member2Edit() {
    var projectNO = $("#projectNO").val();
	var teamNO = $("#teamNO").val();
	var member2Name = $("#member2Name").val();
	var member2Sex = $("#member2Sex").val();
	var member2ID = $("#member2ID").val();
	var member2Birth = $("#member2Birth").val();
	var member2Phone = $("#member2Phone").val();
	var member2Email = $("#member2Email").val();
	var member2City = $("#member2City").val();
	var member2District = $("#member2District").val();
	var member2Addr = $("#member2Addr").val();
	var member2Job = $("#member2Job").val();
	var member2Title = $("#member2Title").val();
	var member2Year = $("#member2Year").val();
	
$.ajax({

	url:"https://wmpcca.com/bswmp/form/model/compet_member2Edit.php",
	data:{
		"projectNO" : projectNO,
		"teamNO" : teamNO,
		"name" : member2Name,
		"sex" : member2Sex,
		"identifyNO" : member2ID,
		"birthday" : member2Birth,
		"phone" : member2Phone,
		"email" : member2Email,
		"city" : member2City,
		"district" : member2District,
		"addr" : member2Addr,
		"job" : member2Job,
		"title" : member2Title,
		"year" : member2Year
	},

	method : "POST",

	error : function(msg){
		$("#member2Msg").html(msg);
	},

	success : function(msg){

		$("#member2Msg").html(msg);
		$("#member2Msg").css('color', 'red');
		$("#member2Msg").css('font-weight', 'bold');
		
		if (msg === '新增修改完成，系統將自動重新整理'){
			setTimeout(function(){
			window.location.reload();
			},1000);
		}
	}

	});	
		
}// JavaScript Document
