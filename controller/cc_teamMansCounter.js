// JavaScript Document
if ($("#teamMans").text()==="1"){
    $("#member1Info").attr("style","display:none");
    $("#member2Info").attr("style","display:none");
}else if ($("#teamMans").text()===2){
    $("#member2Info").attr("style","display:none");
}