// JavaScript Document
function teacherAdd(){
//取得表單值
var teacherSchool = $("#schoolPre").val();
var teacherCollege = $("#captainCollege").val();
var teacherDepart = $("#captainDepart").val();
var teacherType = $("#teacherType").val();
var teacherName = $("#teacherName").val();
var teacherPhone = $("#teacherPhone").val();
var teacherEmail = $("#teacherEmail").val();
var remarks = $("#remarks").val();

$.ajax({
	
	url:"https://wmpcca.com/bswmp/form/model/admin_teacherListAdd.php",
	data:{
		"teacherSchool" : teacherSchool,
		"teacherCollege" : teacherCollege,
		"teacherDepart" : teacherDepart,
		"teacherType" : teacherType,
		"teacherName" : teacherName,
		"teacherPhone" : teacherPhone,
		"teacherEmail" : teacherEmail
	},
	
	method : "POST",
	
	error : function(msg){
		$("#returnMsg").html(msg);
	},
	
	success : function(msg){
		$("#returnMsg").html(msg);
		$("#returnMsg").css('color', 'red');
		$("#returnMsg").css('font-weight', 'bold');
	}
	
});
	
}