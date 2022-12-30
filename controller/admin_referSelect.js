// JavaScript Document
function referSelect() {
	//取得表單值
	var projectNO = $("#projectNO").val();
	var startDate1 = $("#startDate1").val();
	var endDate1 = $("#endDate1").val();
	var startDate2 = $("#startDate2").val();
	var endDate2 = $("#endDate2").val();
	var referA = $("#referA").val();
	var referB = $("#referB").val();
	var referC = $("#referC").val();
	var referD = $("#referD").val();
	var referE = $("#referE").val();
	var referX = $("#referX").val();
	var referY = $("#referY").val();
	var referZ = $("#referZ").val();
	
$.ajax({
	
	url:"https://wmpcca.com/bswmp/form/model/admin_competReferSelect.php",
	data:{
		"projectNO" : projectNO,
		"startDate1" : startDate1,
		"endDate1" : endDate1,
		"startDate2" : startDate2,
		"endDate2" : endDate2,
		"referA" : referA,
		"referB" : referB,
		"referC" : referC,
		"referD" : referD,
		"referE" : referE,
		"referX" : referX,
		"referY" : referY,
		"referZ" : referZ
	},
	
	method : "POST",
	
	error : function(msg){
		$("#referSelectMsg").html(msg);
	},
	
	success : function(msg){
		$("#referSelectMsg").html(msg);
		$("#referSelectMsg").css('color', 'red');
		$("#referSelectMsg").css('font-weight', 'bold');

		if (msg === '資料已更新！'){
			window.location.reload();
		}
		
	}
	
});
	
}