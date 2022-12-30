function captainEdit() {
    var projectNO = $("#projectNO").val();
	var teamNO = $("#teamNO").val();
	var captainName = $("#captainName").val();
	var captainSex = $("#captainSex").val();
	var captainID = $("#captainID").val();
	var captainBirth = $("#captainBirth").val();
	var captainPhone = $("#captainPhone").val();
	var captainEmail = $("#captainEmail").val();
	var captainCity = $("#captainCity").val();
	var captainDistrict = $("#captainDistrict").val();
	var captainAddr = $("#captainAddr").val();
	var captainJob = $("#captainJob").val();
	var captainTitle = $("#captainTitle").val();
	var captainYear = $("#captainYear").val();
	
$.ajax({

	url:"https://wmpcca.com/bswmp/form/model/compet_captainEdit.php",
	data:{
		"projectNO" : projectNO,
		"teamNO" : teamNO,
		"name" : captainName,
		"sex" : captainSex,
		"identifyNO" : captainID,
		"birthday" : captainBirth,
		"phone" : captainPhone,
		"email" : captainEmail,
		"city" : captainCity,
		"district" : captainDistrict,
		"addr" : captainAddr,
		"job" : captainJob,
		"title" : captainTitle,
		"year" : captainYear
	},

	method : "POST",

	error : function(msg){
		$("#captainMsg").html(msg);
	},

	success : function(msg){

		$("#captainMsg").html(msg);
		$("#captainMsg").css('color', 'red');
		$("#captainMsg").css('font-weight', 'bold');
		
//		if (msg === '新增修改完成，系統將自動重新整理'){
//			setTimeout(function(){
//			window.location.reload();
//			},1000);
//		}
	}

	});	
		
}// JavaScript Document
