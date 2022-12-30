function EditCompetmember2College() {
	var teamNO = $("#teamNO_college").val();
	var member2Name = $("#member2Name_college").val();
	var member2Sex = $("#member2Sex_college").val();
	var member2ID = $("#member2ID_college").val();
	var member2Birth = $("#member2Birth_college").val();
	var member2Phone = $("#member2Phone_college").val();
	var member2Email = $("#member2Email_college").val();
	var member2City = $("#member2City-College").val();
	var member2District = $("#member2District-College").val();
	var member2Addr = $("#member2Addr_college").val();
	var member2College = $("#member2College").val();
	var member2Depart = $("#member2Depart").val();
	var member2Degree = $("#member2Degree").val();
	var member2Grade = $("#member2Grade_college").val();

	
$.ajax({

	url:"https://wmpcca.com/bswmp/form/model/admin_editCompet_member2EditCollege.php",
	data:{
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
		"college" : member2College,
		"depart" : member2Depart,
		"degree" : member2Degree,
		"grade" : member2Grade
	},

	method : "POST",

	error : function(msg){
		$("#editmember2Msg_college").html(msg);
	},

	success : function(msg){
		$("#editMember2Msg_college").html(msg);
	}

	});	
		
}// JavaScript Document
