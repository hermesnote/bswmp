// JavaScript Document
function addEvent() {
	//buttonFail
	$(".buttonFail").prop('disabled', true);

	//取得表單值
	var getEvent = $("#selectEvent").val();
	var projectName;
	var start;
	var end;
	var fee;
	var bach1;
	var bach1Time;
	var bach1Finals;
	var bach2;
	var bach2Time;
	var bach2Finals;
	var bach3;
	var bach3Time;
	var bach3Finals;
	var amount;

	projectName = '金融與證券投資實務知識奧運會競賽';
	start = $("#startHS").val();
	end = $("#endHS").val();
	fee = $("#feeHS").val();
	bach1 = $("#bach1HS").val();
	bach1Time = $("#bach1TimeHS").val();
	bach1Finals = $("#bach1FinalsHS").val();
	bach2 = $("#bach2HS").val();
	bach2Time = $("#bach2TimeHS").val();
	bach2Finals = $("#bach2FinalsHS").val();
	bach3 = $("#bach3HS").val();
	bach3Time = $("#bach3TimeHS").val();
	bach3Finals = $("#bach3FinalsHS").val();
	amount = $("#amount").val();

	
$.ajax({
	
	url:"https://wmpcca.com/bswmp/form/model/admin_histockAddEvent.php",
	data:{
		"getEvent" : getEvent,
		"projectName" : projectName,
		"start" : start,
		"end" : end,
		"fee" : fee,
		"bach1" : bach1,
		"bach1Time" : bach1Time,
		"bach1Finals" : bach1Finals,
		"bach2" : bach2,
		"bach2Time" : bach2Time,
		"bach2Finals" : bach2Finals,
		"bach3" : bach3,
		"bach3Time" : bach3Time,
		"bach3Finals" : bach3Finals,
		"amount" : amount
	},
	
	method : "POST",
	
	error : function(msg){
		$("#resultMsg").html(msg);
	},
	
	success : function(msg){
	//buttonFail-reBorn
	$(".buttonFail").prop('disabled', false);
		
		if (msg === '操作成功！'){
			alert("操作成功！");
			window.location.reload();
		}

	}
	
});
	
}