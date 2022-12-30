// JavaScript Document// JavaScript Document
function HTpassCHK() {

	//取得表單值
	var examNO = $("#examNOHT").val();
	var vCode = $("#vCodeHT").val();

	// 判斷HT/HS登入正確與否
	if (examNO.substr(0,2) != 'HT'){
		alert('選拔代號格式錯誤!');
	}
	
$.ajax({
	
	url:"https://wmpcca.com/bswmp/form/model/histock_loginCHK.php",
	data:{
		"examNO" : examNO,
		"vCode" : vCode
	},
	
	method : "POST",
	
	error : function(msg){
		$("#loginMsg").html(msg);
	},
	
	success : function(msg){

		$("#loginMsg").html(msg);
		$("#loginMsg").css('color', 'red');
		$("#loginMsg").css('font-weight', 'bold');
		
		if (msg === '登入成功'){
			window.location.href = "https://wmpcca.com/bswmp/form/view/histock_HTmainpage.php";
		}
		
		}
});
	
}// JavaScript Document