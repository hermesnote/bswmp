<!DOCTYPE html>
<html>
<head>
	
<?php require_once("../model/index_rel.php") ?>
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link rel=stylesheet type="text/css" href="../css/body_global.css">
<!-- Title -->
<title>Visual Countdown Timer Examples</title>

<!-- Countdown Timer Default Style -->
<link href="../vender/countdownBar/countdownProgressBar.css" rel="stylesheet">


</script>
<style>
body {
	padding-top: 0;
	padding-left: 0;
	margin-top: 0;
	width: 100%;
	overflow-x: hidden;
	background-color: #fafafa;
}
.container {
	margin: 150px auto;
	max-width: 960px;
}
div.countdown-bar {
	width: 0;
	height: 20px;
	margin-bottom: 40px;
	border: 1px solid rgb(8, 233, 8);
	background-color: rgba(189, 184, 184, 0.788);
	border-radius: 3px;
}
</style>
</head>

<body>

<div class="container">

  <!-- Countdown timer html -->
  <div class="countdown-bar" id="countdownA">
    <div></div>
    <div></div>
  </div>
  
  <!-- Countdown timer html -->
  <div class="countdown-bar" id="countdownB">
    <div></div>
    <div></div>
  </div>
  
  <!-- Countdown timer html -->
  <div class="countdown-bar" id="countdownC">
    <div></div>
    <div></div>
  </div>
</div>

<div>
	<button class="btn btn-lg btn-info" onClick="getTimer()">取得時間</button>
	<input type="text" id="showTimer">
</div>

<div>
	<button class="btn btn-lg btn-danger" onClick="reTimer()">重新計時</button>
</div>
	

<?php require_once("../model/index_js.php") ?>
<!-- Countdown Timer JS Script -->
<script src="../vender/countdownBar/countdownProgressBar.js" type="text/javascript"></script>

<!-- Run Countdown Timer Script --> 
<script>
	$(document).ready(function () {
		countdown('countdownA', 0, 0, 0, 0);

		countdown('countdownB', 0, 0, 0, 10);

		countdown('countdownC', 0, 0, 0, 0);
	});
</script>
<!-- End script --> 	
	
<script>
	function reTimer(){
		countdown('countdownB', 0, 0, 0, 10);
		return;
	}
</script>

<!-- Get Timer -->
<script>
	function getTimer(){
		var timer = $("#countdownB > div").children('span')[0].innerHTML.split(':')[2];
		$("#showTimer").val(timer);
	}
</script>
	
</body>



</html>