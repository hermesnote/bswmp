function captainEditHiStock() {
    var projectNO = $("#projectNO").val();
	var teamNO = $("#teamNO").val();
	var captainSex = $("#captainSex-HiStock").val();
	var captainID = $("#captainID-HiStock").val();
	var captainBirth = $("#captainBirth-HiStock").val();
	var captainPhone = $("#captainPhone-HiStock").val();
	var captainCity = $("#captainCity-HiStock").val();
	var captainDistrict = $("#captainDistrict-HiStock").val();
	var captainAddr = $("#captainAddr-HiStock").val();
	

$.ajax({

	url:"https://wmpcca.com/bswmp/form/model/histock_captainEdit.php",
	data:{
		"projectNO" : projectNO,
		"teamNO" : teamNO,
		"sex" : captainSex,
		"identifyNO" : captainID,
		"birthday" : captainBirth,
		"phone" : captainPhone,
		"city" : captainCity,
		"district" : captainDistrict,
		"addr" : captainAddr
	},

	method : "POST",

	error : function(msg){
		$("#captainMsg-HiStock").html(msg);
	},

	success : function(msg){

			$("#captainMsg-HiStock").html(msg);
			$("#captainMsg-HiStock").css('color', 'red');
			$("#captainMsg-HiStock").css('font-weight', 'bold');
		
			if (msg === '新增修改完成，系統將自動重新整理'){
				setTimeout(function(){
				window.location.reload();
				},1000);
			}
		
	}

	});	
		
}// JavaScript Document
