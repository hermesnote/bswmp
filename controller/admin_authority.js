var permit = $("#postType").text()
//最高權限-全控制權限
if(permit==="0"){
	$(".authority0").show();
	$(".authority1").show();
	$(".authority2").show();
	$(".authority3").show();
}
//精進及協會成員-非控制權限
else if(permit === "1"){
	$(".authority0").hide();
	$(".authority1").show();
	$(".authority2").hide();
	$(".authority3").hide();
}
//保富成員-僅開放金融證券實務項目
else if(permit === "2"){
	$(".authority0").hide();
	$(".authority1").hide();
	$(".authority2").show();
	$(".authority3").hide();
}
//其它成員-僅登入
else if(permit === "3"){
	$(".authority0").hide();
	$(".authority1").hide();
	$(".authority2").hide();
	$(".authority3").show();
}