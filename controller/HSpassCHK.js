// JavaScript Document// JavaScript Document
function HSpassCHK() {
	
	//取得表單值
	var examNO = $("#HSexamNO").val();
	var vCode = $("#HSpwd").val();
	
	// 判斷HT/HS登入正確與否
	if (examNO.substr(0,2) != 'HS'){
		alert('隊伍編號格式錯誤!');
	}
	
$.ajax({
	
	url:"https://wmpcca.com/bswmp/form/model/histock_loginCHK.php",
	data:{
		"examNO" : examNO,
		"vCode" : vCode
	},
	
	method : "POST",
	
	error : function(msg){
		$("#HSpassCHKMsg").html(msg);
	},
	
	success : function(msg){

		$("#HSpassCHKMsg").html(msg);
		$("#HSpassCHKMsg").css('color', 'red');
		$("#HSpassCHKMsg").css('font-weight', 'bold');
		
		if (msg === '登入成功'){
			window.location.href = "https://wmpcca.com/bswmp/form/view/histock_mainpage.php";
		}
		
		}
});
	
}// JavaScript Document