function EditCompetcaptainCollege() {
	var teamNO = $("#teamNO_college").val();
	var captainName = $("#captainName_college").val();
	var captainSex = $("#captainSex_college").val();
	var captainID = $("#captainID_college").val();
	var captainBirth = $("#captainBirth_college").val();
	var captainPhone = $("#captainPhone_college").val();
	var captainEmail = $("#captainEmail_college").val();
	var captainCity = $("#captainCity-College").val();
	var captainDistrict = $("#captainDistrict-College").val();
	var captainAddr = $("#captainAddr_college").val();
	var captainCollege = $("#captainCollege").val();
	var captainDepart = $("#captainDepart").val();
	var captainDegree = $("#captainDegree").val();
	var captainGrade = $("#captainGrade_college").val();

	
$.ajax({

	url:"https://wmpcca.com/bswmp/form/model/admin_editCompet_captainEditCollege.php",
	data:{
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
		$("#editCaptainMsg_college").html(msg);
	},

	success : function(msg){

		$("#editCaptainMsg_college").html(msg);
		$("#editCaptainMsg_college").css('color', 'red');
		$("#editCaptainMsg_college").css('font-weight', 'bold');
	}

	});	
		
}// JavaScript Document
