<?php
//連結資料庫
require_once("../vender/dbtools.inc.php");

//取得現在日期時間
$getToday = date("Y-m-d H:i:s");

// 取得表單傳值
$projectNO = $_POST["rankProject"];
	// 取得活動梯次
$bach = $_POST["rankBach"];
	if ( $bach == 'bach1'){
		$bachX = '北區';
	}else if ( $bach == 'bach2'){
		$bachX = '中區';
	}else if ( $bach == 'bach3'){
		$bachX = '南區';
	}

// 撈出該梯總分不為空
$sqlRankX = mysql_query("
	SELECT examNumber, combineScore FROM histock_HTscore WHERE projectNO = '$projectNO' AND bach = '$bach' AND combineScore != '' ORDER BY CAST(combineScore AS DECIMAL(5,2)) DESC
");

// 建立陣列
$examNumberArr = array();
$scoreArr = array();

// while取值
while ($row = mysql_fetch_array($sqlRankX)){
	$examNumberArr[] = $row['examNumber'];
	$scoreArr[] = $row['combineScore'];
}

// 宣告准考證號及成績陣列
$rankNumber = $examNumberArr;
$rankScore = $scoreArr;

// 找出陣列長度
$j = count($rankScore);

// 123入庫
$sqlDiamond = "
	UPDATE histock_HTscore
	SET
	rank = '鑽石輔導員'
	WHERE examNumber = '$examNumberArr[0]'
";
$sqlDoDiamond = mysql_query($sqlDiamond);

$sqlPlatinum = "
	UPDATE histock_HTscore
	SET
	rank = '白金輔導員'
	WHERE examNumber = '$examNumberArr[1]'
";
$sqlDoPlatinum = mysql_query($sqlPlatinum);

$sqlGold = "
	UPDATE histock_HTscore
	SET
	rank = '黃金輔導員'
	WHERE examNumber = '$examNumberArr[2]'
";
$sqlDoGold = mysql_query($sqlGold);

// 4-13入庫
for ( $i=3; $i<=12; $i++ ){
	$sqlSilver = "
		UPDATE histock_HTscore
		SET
		rank = '特優輔導員'
		WHERE examNumber = '$examNumberArr[$i]'
	";
	$sqlDoSilver = mysql_query($sqlSilver);
}

// 13後入庫
if ( $j > 13 ){
	for ( $i=13; $i<=$j; $i++ ){
	$sqlBronze = "
		UPDATE histock_HTscore
		SET
		rank = '優等輔導員'
		WHERE examNumber = '$examNumberArr[$i]'
	";
	$sqlDoBronze = mysql_query($sqlBronze);
	}
}

// splice 優等輔導員
$spliceNumber = array_splice($rankNumber, 13);
$spliceScore = array_splice($rankScore, 13);


?>

<!doctype html>
<html>
<head>
<?php require_once("../model/index_rel.php") ?>

<link rel=stylesheet type="text/css" href="../css/body_global.css">
<meta charset="utf-8">
<title><? echo $projectNO; ?> <? echo $bachx; ?> 選拔結果</title>

<style>


</style>
	
</head>

<body>
<?php require_once("../model/waitload.php") ?>

<section class="container-white py-5">
	<div class="container">
		<div class="row">
			<div class="col mx-auto text-center">
				<img src="../img/logo_01.png">
				<p class="h1 text-info mt-5">第 <? echo substr($projectNO, 2, 5) ?> 梯</p>
				<p class="h2 text-info">金融與證券投資實務競賽最佳輔導員選拔賽</p>
				<h3 class="text-info"><? echo $bachX; ?>場次選拔結果</h2>
			</div>
		</div>
	</div>
</section>

	
<div class="jumbotron jumbotron-fluid" style="margin-bottom: 0;">
	<div class="container">
		<div class="row">

			<div class="col">
				<h2 class="display-1 mx-auto text-center" style="color: slategrey;"><i class="fas fa-star-of-david"></i></h2><br>
				<h2 class="mx-auto font-weight-bolder text-center" style="color: slategrey;">白金輔導員</h2><br>
				<h2 class="mx-auto font-weight-bolder text-center" style="color: slategrey;"><? echo $examNumberArr[1]; ?></h2>
				<h2 class="mx-auto font-weight-bolder text-center" style="color: slategrey;"><? echo $scoreArr[1]; ?> 分</h2>
			</div>
			
			<div class="col">
				<h1 class="display-1 mx-auto text-center" style="color: skyblue;"><i class="far fa-gem"></i></h1><br>
				<h1 class="mx-auto font-weight-bolder text-center" style="color: skyblue;">鑽石輔導員</h1><br>
				<h1 class="mx-auto font-weight-bolder text-center" style="color: skyblue;"><? echo $examNumberArr[0]; ?></h1>
				<h1 class="mx-auto font-weight-bolder text-center" style="color: skyblue;"><? echo $scoreArr[0]; ?> 分</h1>
			</div>
			
			<div class="col">
				<h3 class="display-1 mx-auto text-center" style="color: gold;"><i class="fas fa-certificate"></i></h3><br>
				<h3 class="mx-auto font-weight-bolder text-center" style="color: gold;">金質輔導員</h3><br>
				<h3 class="mx-auto font-weight-bolder text-center" style="color: gold;"><? echo $examNumberArr[2]; ?></h3>
				<h3 class="mx-auto font-weight-bolder text-center" style="color: gold;"><? echo $scoreArr[2]; ?> 分</h3>
			</div>
			
		</div>
	</div>
</div>
	
<section class="bg-white-50 py-5">
	<div class="container">
		
		<div class="row">
			<div class="col">
				<h4 class="display-4 mx-auto text-center font-weight-bolder" style="color: darkorange;"><i class="fas fa-medal"></i></h4><br>
				<h4 class="mx-auto text-center font-weight-bolder" style="color: darkorange;">特優輔導員</h4><br>
			</div>
		</div>
		
		<div class="row">
			<div class="col h4 font-weight-bolder mx-auto text-center" style="color: darkorange;">
				<? echo $examNumberArr[3]; ?><? echo '('.$scoreArr[3].')'; ?><br>
				<? echo $examNumberArr[4]; ?><? echo '('.$scoreArr[4].')'; ?><br>
				<? echo $examNumberArr[5]; ?><? echo '('.$scoreArr[5].')'; ?><br>
				<? echo $examNumberArr[6]; ?><? echo '('.$scoreArr[6].')'; ?><br>
				<? echo $examNumberArr[7]; ?><? echo '('.$scoreArr[7].')'; ?><br>
			</div>
			<div class="col h4 font-weight-bolder mx-auto text-center" style="color: darkorange;">
				<? echo $examNumberArr[8]; ?><? echo '('.$scoreArr[8].')'; ?><br>
				<? echo $examNumberArr[9]; ?><? echo '('.$scoreArr[9].')'; ?><br>
				<? echo $examNumberArr[10]; ?><? echo '('.$scoreArr[10].')'; ?><br>
				<? echo $examNumberArr[11]; ?><? echo '('.$scoreArr[11].')'; ?><br>
				<? echo $examNumberArr[12]; ?><? echo '('.$scoreArr[12].')'; ?><br>
			</div>
		</div>
		
	</div>
</section>
	
<section class="bg-light py-5">
	<div class="container">
		
		<div class="row">
			<div class="col">
				<h5 class="display-4 mx-auto text-center" style="color: cadetblue;"><i class="fas fa-star"></i></h5><br>
				<h5 class="mx-auto text-center" style="color: cadetblue;">優等輔導員</h5><br>
			</div>
		</div>
		
		<?php foreach($spliceNumber as $index=>$value): ?>
			<!--	when len = 1 then add new row	-->
			<?php 
				$len = $index+1;
				if($len%4==1) 
					echo '<div class="row">'; 
			?>
				<!--	add 4 col	-->
				<div class="col-lg-3 h5 font-weight-bolder" style="color: cadetblue;">
					<?php echo $value.'('.$spliceScore[$index].')'; ?>
				</div>
			<!--	when len = 4 then close row	-->
			<?php 
				$len = $index+1;
				if($len%4==0) 
					echo '</div>'; 
			?>
		<?php endforeach; ?>
		
		
	</div>
</section>

<?php require_once("../model/index_js.php") ?>
<script type="text/javascript" src="../controller/waitload.js"></script>
<script type="text/javascript" src="../controller/index_nav.js"></script>
<script type="text/javascript" src="../controller/toggle_tooltip.js"></script>
<script type="text/javascript" src="../controller/cc_imgGroup_Option1.js"></script>

</body>
</html>