function signupAbortHiStock() {
	//Checkbox
	var delData = confirm('確認刪除所有報名資料？(包括隊伍成員)');
	if (!delData){
		return;
	}
	var teamNO = $("#teamNO").val();
	var teamDB = $("#teamDB").val();
	var memberDB = $("#memberDB").val();
	
$.ajax({

	url:"https://wmpcca.com/bswmp/form/model/histock_signupAbort.php",
	data:{
		"teamNO" : teamNO,
		"teamDB" : teamDB,
		"memberDB" : memberDB
	},

	method : "POST",

	error : function(msg){
		$("#teamInfoMag").html(msg);
	},

	success : function(msg){
		if (msg === 'TRUE'){
			alert('報名資料已刪除！');
		}
		window.location.href = "https://wmpcca.com/bswmp/form/view/histock_index.php";
	}

	});	
		
}// JavaScript Document
