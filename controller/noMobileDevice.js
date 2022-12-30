$(document).ready(function(){
	if( navigator.userAgent.match(/Android/i)
	|| navigator.userAgent.match(/webOS/i)
	|| navigator.userAgent.match(/iPhone/i)
	|| navigator.userAgent.match(/iPad/i)
	|| navigator.userAgent.match(/iPod/i)
	|| navigator.userAgent.match(/BlackBerry/i)
	|| navigator.userAgent.match(/Windows Phone/i)
	){
	alert("系統偵測到您正使用手機或平板等行動裝置進行操作，行動瀏覽器可能導致部分功能無法正常使用，請使用電腦進行操作！(※建議使用Google Chrome瀏覽器進行操作)");
	window.location.href = 'https://wmpcca.com/';
	}
});