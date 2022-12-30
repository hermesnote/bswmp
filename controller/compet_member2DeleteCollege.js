function member2DeleteCollege() {
	//Checkbox
	var delData = confirm('確認刪除隊員資料？');
	if (!delData){
		return;
	}
    var projectNO = $("#projectNO").val();
	var teamNO = $("#teamNO").val();
	var member2ID = $("#member2ID-College").val();

	
$.ajax({

	url:"https://wmpcca.com/bswmp/form/model/compet_member2DeleteCollege.php",
	data:{
		"projectNO" : projectNO,
		"teamNO" : teamNO,
		"identifyNO" : member2ID
	},

	method : "POST",

	error : function(msg){
		$("#member2Msg-College").html(msg);
	},

	success : function(msg){

		$("#member2Msg-College").html(msg);
		$("#member2Msg-College").css('color', 'red');
		$("#member2Msg-College").css('font-weight', 'bold');
		
		if (msg === '刪除成功'){
			setTimeout(function(){
			window.location.reload();
			},1000);
		}
	}

	});	
		
}// JavaScript Document
