// JavaScript Document// JavaScript Document
function confirmSub() {
	
	var projectNO= $("#projectNO").val();
	var memName= $("#memName").val();
	var memId = $("#memId").val();
	var memSN = $("#memSN").val();
	var memMobile = $("#memMobile").val();
	var memEmail = $("#memEmail").val();
	
	// 檢核同次重覆報名 對隊長
	var capId = $("#capId").val();
	var viceId = $("#viceId").val();
	if( (capId === memId)||(viceId === memId) ){
		alert('隊員不可與隊長或副手為同一人!');
	}
	
$.ajax({
	
	url:"https://wmpcca.com/bswmp/form/model/histock_HSmemCHK.php",
	data:{
		"projectNO" : projectNO,
		"memName" : memName,
		"memId" : memId,
		"memSN" : memSN,
		"memMobile" : memMobile,
		"memEmail" : memEmail
	},
	
	method : "POST",
	
	error : function(Msg){
		alert(Msg);
	},
	
	success : function(Msg){
		
		if(Msg == 'nameWRG'){
			alert('姓名格式不符(僅限中英文不含阿拉伯數字及符號)');
			return;
		}
		if(Msg == 'emailWRG'){
			alert('Email格式不符');
			return;
		}
		if(Msg == 'EXT'){
			alert('不可重覆報名(有問題請致電協會)');
			return;
		}
		if(Msg == 'EPT'){
			alert('若要增加隊員請確實填寫欄位');
			return;
		}
		if (Msg == 'app'){
			$("#amountArea").fadeOut("fast"); // fadeOut學校區域
			$("#capArea").fadeOut("fast"); // fadeOut隊長區域
			$("#viceArea").fadeOut("fast"); // fadeOut副手區域
			$("#memArea").fadeOut("fast"); // fadeOut隊員區域
			$("#confirmSub").fadeIn("slow"); // fadeIn提交區域
		}
	}
	
});
	
}