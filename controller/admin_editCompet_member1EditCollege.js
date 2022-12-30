function EditCompetmember1College() {
	var teamNO = $("#teamNO_college").val();
	var member1Name = $("#member1Name_college").val();
	var member1Sex = $("#member1Sex_college").val();
	var member1ID = $("#member1ID_college").val();
	var member1Birth = $("#member1Birth_college").val();
	var member1Phone = $("#member1Phone_college").val();
	var member1Email = $("#member1Email_college").val();
	var member1City = $("#member1City-College").val();
	var member1District = $("#member1District-College").val();
	var member1Addr = $("#member1Addr_college").val();
	var member1College = $("#member1College").val();
	var member1Depart = $("#member1Depart").val();
	var member1Degree = $("#member1Degree").val();
	var member1Grade = $("#member1Grade_college").val();

	
$.ajax({

	url:"https://wmpcca.com/bswmp/form/model/admin_editCompet_member1EditCollege.php",
	data:{
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
		"college" : member1College,
		"depart" : member1Depart,
		"degree" : member1Degree,
		"grade" : member1Grade
	},

	method : "POST",

	error : function(msg){
		$("#editMember1Msg_college").html(msg);
	},

	success : function(msg){
		
		$("#editMember1Msg_college").text(msg);
	}

	});	
		
}// JavaScript Document
