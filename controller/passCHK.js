// JavaScript Document// JavaScript Document
function passCHK() {
	//取得表單值
	var teamNO = $("#teamNO").val();
	var vCode = $("#vCode").val();

	
$.ajax({
	
	url:"https://wmpcca.com/bswmp/form/model/compet_loginCHK.php",
	data:{
		"teamNO" : teamNO,
		"vCode" : vCode
	},
	
	method : "POST",
	
	error : function(msg){
		$("#passCHKMsg").html(msg);
	},
	
	success : function(msg){
		$("#passCHKMsg").html(msg);
		$("#passCHKMsg").css('color', 'red');
		$("#passCHKMsg").css('font-weight', 'bold');
		
		if (msg === '登入成功'){
			window.location.href = "https://wmpcca.com/bswmp/form/view/compet_mainpage.php";
		}
		
		}
});
	
}// JavaScript Document