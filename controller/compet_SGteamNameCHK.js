$("#teamName").keyup(function () {
    var teamName = $("#teamName").val();
	var projectNO = $("#SGcompetprojectNO").val();
	
		$.ajax({

			url:"https://wmpcca.com/bswmp/form/model/compet_SGteamNameCHK.php",
			data:{
				"teamName" : teamName,
				"projectNO" : projectNO
			},

			method : "POST",

			error : function(msg){
				$("#teamNameCheck").html(msg);
			},

			success : function(msg){

				if (msg === '隊名可以使用！'){
					$("#teamNameCheck").html(msg);
					$("#teamNameCheck").css('color', 'green');
					$("#teamNameCheck").css('font-weight', 'bold');
				}
				
				if (msg === '隊名已被使用！'){
					$("#teamNameCheck").html(msg);
					$("#teamNameCheck").css('color', 'red');
					$("#teamNameCheck").css('font-weight', 'bold');
				}

				if (msg === '不可使用特殊符號！'){
					$("#teamNameCheck").html(msg);
					$("#teamNameCheck").css('color', 'red');
					$("#teamNameCheck").css('font-weight', 'bold');
				}
			}

			});	
		
});


