function member2DeleteHiStcok() {
	//Checkbox
	var delData = confirm('確認刪除隊員資料？');
	if (!delData){
		return;
	}
    var projectNO = $("#projectNO").val();
	var teamNO = $("#teamNO").val();
	var member2ID = $("#member2ID-HiStock").val();


$.ajax({

	url:"https://wmpcca.com/bswmp/form/model/histock_member2Delete.php",
	data:{
		"projectNO" : projectNO,
		"teamNO" : teamNO,
		"identifyNO" : member2ID
	},

	method : "POST",

	error : function(msg){
		$("#member2Msg-HiStock").html(msg);
	},

	success : function(msg){

		$("#member2Msg-HiStock").html(msg);
		$("#member2Msg-HiStock").css('color', 'red');
		$("#member2Msg-HiStock").css('font-weight', 'bold');
		
		if (msg === '刪除成功'){
			setTimeout(function(){
			window.location.reload();
			},1000);
		}
	}

	});	
		
}// JavaScript Document