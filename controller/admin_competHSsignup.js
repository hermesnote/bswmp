// JavaScript Document
function signup1() {
	//取得表單值
	var teamNO = $("#teamNOGet3").val();
	var HSsignup1 = $("#HSsignup1").val();
	
$.ajax({
	
	url:"https://wmpcca.com/bswmp/form/model/admin_competHSsignup.php",
	data:{
		"teamNO" : teamNO,
		"HSsignup1" : HSsignup1
	},
	
	method : "POST",
	
	error : function(msg){
		$("#signupMsg").html(msg);
	},
	
	success : function(msg){
		$("#signupMsg").html(msg);
		$("#signupMsg").css('color', 'red');
		$("#signupMsg").css('font-weight', 'bold');

		if (msg === '資料已更新！'){
			window.location.reload();
		}
		
	}
	
});
	
}