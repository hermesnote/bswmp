function captainEditCollege() {
    var projectNO = $("#projectNO").val();
	var teamNO = $("#teamNO").val();
	var captainName = $("#captainName-College").val();
	var captainSex = $("#captainSex-College").val();
	var captainID = $("#captainID-College").val();
	var captainBirth = $("#captainBirth-College").val();
	var captainPhone = $("#captainPhone-College").val();
	var captainEmail = $("#captainEmail-College").val();
	var captainCity = $("#captainCity-College").val();
	var captainDistrict = $("#captainDistrict-College").val();
	var captainAddr = $("#captainAddr-College").val();
	var captainCollege = $("#captainCollege").val();
	var captainDepart = $("#captainDepart").val();
	var captainDegree = $("#captainDegree").val();
	var captainGrade = $("#captainGrade").val();
	
$.ajax({

	url:"https://wmpcca.com/bswmp/form/model/compet_captainEditCollege.php",
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
		"college" : captainCollege,
		"depart" : captainDepart,
		"degree" : captainDegree,
		"grade" : captainGrade
	},

	method : "POST",

	error : function(msg){
		$("#captainMsg-College").html(msg);
	},

	success : function(msg){

		$("#captainMsg-College").html(msg);
		$("#captainMsg-College").css('color', 'red');
		$("#captainMsg-College").css('font-weight', 'bold');
		if (msg === '新增修改完成，系統將自動重新整理'){
			setTimeout(function(){
			window.location.reload();
			},1000);
		}
	}

	});	
		
}// JavaScript Document
