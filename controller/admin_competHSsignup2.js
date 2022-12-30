// JavaScript Document
function signup2() {
	//取得表單值
	var teamNO = $("#teamNOGet4").val();
	var HSsignup2 = $("#HSsignup2").val();
	
$.ajax({
	
	url:"https://wmpcca.com/bswmp/form/model/admin_competHSsignup2.php",
	data:{
		"teamNO" : teamNO,
		"HSsignup2" : HSsignup2
	},
	
	method : "POST",
	
	error : function(msg){
		$("#signupMsg2").html(msg);
	},
	
	success : function(msg){
		$("#signupMsg2").html(msg);
		$("#signupMsg2").css('color', 'red');
		$("#signupMsg2").css('font-weight', 'bold');

		if (msg === '資料已更新！'){
			window.location.reload();
		}
		
	}
	
});
	
}