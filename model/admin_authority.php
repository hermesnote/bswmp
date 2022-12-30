<script>
	var permit = $("#postType").text()
		if(permit==="0"){
			$("#postType0").show();
			$("#postType1").show();
			$("#postType2").show();
			$(".authority0").show();
			$(".authority1").show();
			$(".authority2").show();
		}else if(permit === "1"){
			$("#postType1").show();
			$(".authority1").show();
		}
</script>