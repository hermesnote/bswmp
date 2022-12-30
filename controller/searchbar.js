// JavaScript Document
function search(){
	
	switch($("#mainSearch").text().trim()){
		case "競賽查詢" :
			$("#searchBar").attr("action", "https://wmpcca.com/bswmp/form/model/search_Compet.php");
			break;
//		case "測驗查詢" :
//			$("#searchBar").attr("action", "");
//			break;
//		case "尋找顧問" :
//			$("#searchBar").attr("action", "");
//			break;
//		case "全站搜尋" :
//			$("#searchBar").attr("action", "");
//			break;
	}

	searchBar.submit();
};

$("#mainSearch_compet").click(function(){
$("#mainSearch").text($(this).text());
$("#mainSearch").val($(this).text());
$(this).attr("value", "searchCompet");
$("#searchBarInput").attr("placeholder", "請輸入「隊伍編號」");
});

$("#mainSearch_exam").click(function(){
$("#mainSearch").text($(this).text());
$("#mainSearch").val($(this).text());
$(this).attr("value", "searchExam");
$("#searchBarInput").attr("placeholder", "此功能暫不開放");
});		

$("#mainSearch_advisor").click(function(){
$("#mainSearch").text($(this).text());
$("#mainSearch").val($(this).text());
$(this).attr("value", "searchAdvisor");
$("#searchBarInput").attr("placeholder", "此功能暫不開放");
});		

$("#mainSearch_site").click(function(){
$("#mainSearch").text($(this).text());
$("#mainSearch").val($(this).text());
$(this).attr("value", "searchSite");
$("#searchBarInput").attr("placeholder", "此功能暫不開放");
});

$("#searchBarInput").click(function(){
$(this).attr("placeholder", "");
});