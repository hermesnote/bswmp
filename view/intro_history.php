<?php

?>

<!doctype html>

<html>
<head>
<?php require_once("../model/index_rel.php") ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.1.0/css/swiper.css" rel="stylesheet" />

<link rel=stylesheet type="text/css" href="../css/body_global.css">
<link rel=stylesheet type="text/css" href="../css/keys_index.css">
<link rel=stylesheet type="text/css" href="../css/navbar.css">
<link rel=stylesheet type="text/css" href="../css/waitload.css">
<link rel=stylesheet type="text/css" href="../css/index_footer.css">

<!-- nexus CSS -->
<link rel="stylesheet" href="../nexus/css/font-awesome.min.css">
<link rel="stylesheet" href="../nexus/vendors/animate-css/animate.css">
<link rel="stylesheet" href="../nexus/vendors/owl-carousel/owl.carousel.min.css">
<link rel="stylesheet" href="../nexus/vendors/flaticon/flaticon.css">

<link rel="stylesheet" href="../nexus/css/style.css">
<link rel="stylesheet" href="../nexus/css/responsive.css">
<meta charset="utf-8">

<title>WMPCCA - 歷年重要事紀</title>
	

	
<style>
div.container {
  display: flex;
  flex: auto;
  flex-direction: column;
  max-height: 100%;
}

div.header {
  height: auto;
  text-align: center;
  background: slategrey;
  color: ghostwhite;
  padding: 2.3rem 1rem 2.3rem 1rem;
  position: relative;
}
div.header:after {
  content: '';
  position: absolute;
  bottom: -5rem;
  left: 0rem;
  height: 5.1rem;
  display: block;
  width: 100%;
  z-index: 300;
  background: -moz-linear-gradient(top, white 20%, rgba(255, 255, 255, 0) 100%);
  /* FF3.6-15 */
  background: -webkit-linear-gradient(top, white 20%, rgba(255, 255, 255, 0) 100%);
  /* Chrome10-25,Safari5.1-6 */
  background: linear-gradient(to bottom, white 20%, rgba(255, 255, 255, 0) 100%);
  /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#00ffffff',GradientType=0 );
  /* IE6-9 */
}
div.header h1 {
  margin-top: .8rem;
  margin-bottom: .5rem;
  font-weight: 200;
  font-size: 1.6em;
  letter-spacing: 0.1rem;
  text-transform: uppercase;
}
@media (min-width: 62em) {
  div.header h1 {
    font-size: 1.9em;
    letter-spacing: 0.2rem;
  }
}
div.header h2 {
  font-size: 1.1em;
  font-weight: 400;
  color: #cfd7de;
  max-width: 30rem;
  margin: auto;
}

div.item {
  display: flex;
  flex: auto;
  overflow-y: auto;
  padding: 0rem 1rem 0rem 1rem;
}

#timeline {
  position: relative;
  display: table;
  height: 100%;
  margin-left: auto;
  margin-right: auto;
  margin-top: 5rem;
}
#timeline div:after {
  content: '';
  width: 2px;
  position: absolute;
  top: .5rem;
  bottom: 0rem;
  left: 60px;
  z-index: 1;
  background: #C5C5C5;
}
#timeline h3 {
  position: -webkit-sticky;
  position: sticky;
  top: 5rem;
  color: #888;
  margin: 0;
  font-size: 1em;
  font-weight: 400;
}
@media (min-width: 62em) {
  #timeline h3 {
    font-size: 1.1em;
  }
}
#timeline section.year {
  position: relative;
}
#timeline section.year:first-child section {
  margin-top: -1.3em;
  padding-bottom: 0px;
}
#timeline section.year section {
  position: relative;
  padding-bottom: 1.25em;
  margin-bottom: 2.2em;
}
#timeline section.year section h4 {
  position: absolute;
  bottom: 0;
  font-size: .9em;
  font-weight: 400;
  line-height: 1.2em;
  margin: 0;
  padding: 0 0 0 89px;
  color: #C5C5C5;
}
@media (min-width: 62em) {
  #timeline section.year section h4 {
    font-size: 1em;
  }
}
#timeline section.year section ul {
  list-style-type: none;
  padding: 0 0 0 75px;
  margin: -1.35rem 0 1em;
  max-width: 32rem;
  font-size: 1em;
}
@media (min-width: 62em) {
  #timeline section.year section ul {
    font-size: 1.1em;
    padding: 0 0 0 81px;
  }
}
#timeline section.year section ul:last-child {
  margin-bottom: 0;
}
#timeline section.year section ul:first-of-type:after {
  content: '';
  width: 10px;
  height: 10px;
  background: #C5C5C5;
  border: 2px solid #FFFFFF;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  -ms-border-radius: 50%;
  border-radius: 50%;
  position: absolute;
  left: 54px;
  top: 3px;
  z-index: 2;
}
#timeline section.year section ul li {
  margin-left: .5rem;
}
#timeline section.year section ul li:before {
  content: '·';
  margin-left: -.5rem;
  padding-right: .3rem;
}
#timeline section.year section ul li:not(:first-child) {
  margin-top: .5rem;
}
#timeline section.year section ul li span.price {
  color: mediumturquoise;
  font-weight: 500;
}

#price {
  display: inline;
}

svg {
  border: 3px solid white;
  border-radius: 50%;
  box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08);
}


</style>	
	
	
</head>

<body>
<?php require_once("../model/cc_imgGroup_Modal.php") ?>
<?php require_once("../model/index_nav.php") ?>

<!--  -->
<section class="made_life_area p_120">
<div class="container">
	<div class="row">
		<div class="col mx-auto text-center">
<!--			<img src="../img/logo_01.png" alt="" height="auto" width="50%">-->
			<p class="pt-5 display-4">歷年重要事紀</p>
		</div>
	</div>
  <div class="item">
    <div id="timeline">
      <div>
		  
<!--
        <section class="year">			
          <h3>2008</h3>
          <section>
            <ul>
              <li>由創會理事長曹俊傑先生、林澍典先生、及商議</li>
            </ul>
          </section>
        </section>
-->


<!-- 區塊起始 -->
        <section class="year">
          
			<h3>2008</h3>
			
			  <section>
				<h4></h4>
				<ul>
				  <li>出版「財富管理－理論、實務與實作」，並於大專校院開辦實作課程</li>
				</ul>
			  </section>

			  <section>
				<h4></h4>
				<ul>
				  <li>以精進財商顧問股份有限公司研發設計之國內第一套，依循國際財富管理理財規劃流程為基礎，開發完成的財富管理決策模擬系統，發展實作的理財流程</li>
				</ul>
			  </section>

			  <section>
				<h4></h4>
				<ul>
				  <li>與德明財經科技大學林容竹教授，出版「財富管理－理論、實務與實作」</li>
				</ul>
			  </section>
			
        </section>
<!-- 區塊終了 -->

<!-- 區塊起始 -->
        <section class="year">
          
			<h3>2009</h3>
			
			  <section>
				<h4></h4>
				<ul>
				  <li>嘗試在大專校院開辦理財規劃實作課程。由業界具備專業證照、與豐富理財規劃實作經驗的顧問、理財經理或保險從業人員與學校老師搭配，整合財經、管理學院相關系所的各門學科，結合理論與實作，共同指導學生所學，進行決策模擬與分析，揚棄過去的點狀課程，採整合性邏輯判斷訓練，成效良好。</li>
				</ul>
			  </section>

			  <section>
				<h4></h4>
				<ul>
				  <li>結合經濟日報於於全省舉辦教師研習營，擴大推廣！期間共計近40所大專校院、近三百位教授，共同研習此一教學流程，並逐步於十數所大專校院開辦課程。</li>
				</ul>
			  </section>

        </section>
<!-- 區塊終了 -->
		  
<!-- 區塊起始 -->
        <section class="year">
          
			<h3>2010</h3>
			
			  <section>
				<h4></h4>
				<ul>
				  <li>在經濟日報的大力推動、與國內數家金融機構的共同贊助之下，第一屆「全國財富管理競賽」開辦。</li>
				</ul>
			  </section>

			  <section>
				<h4></h4>
				<ul>
				  <li>首次以金融機構的財富管理中心做為競賽舞台，並以公開徵求的方式，徵求自願接受規劃的客戶。全國約有50組以上的民眾表達願意參加活動，最後遴選了25組客戶做為此次競賽的客戶群。民眾在金融機構的財富管理中心，接受全國前50強的財富管理從業人員（來自銀行、獨立理財顧問、保險公司、證券業）的專業諮詢與規劃，所有參賽的客戶，皆表達高度認同。</li>
				</ul>
			  </section>

        </section>
<!-- 區塊終了 -->
		  
<!-- 區塊起始 -->
        <section class="year">
          
			<h3>2011</h3>
			
			  <section>
				<h4></h4>
				<ul>
				  <li>舉辦「全國大專財富管理競賽」，提供舞台供在校學生將習得的理論知識作實務的運用，並引進金融機構的專家與學校的老師共同指導，讓學生能在理論－實務的運用過程中，體會財富管理的意涵，為產業界培養能夠立即上線且實用的財富管理人才。</li>
				</ul>
			  </section>

			  <section>
				<h4></h4>
				<ul>
				  <li>首次以金融機構的財富管理中心做為競賽舞台，並以公開徵求的方式，徵求自願接受規劃的客戶。全國約有50組以上的民眾表達願意參加活動，最後遴選了25組客戶做為此次競賽的客戶群。民眾在金融機構的財富管理中心，接受全國前50強的財富管理從業人員（來自銀行、獨立理財顧問、保險公司、證券業）的專業諮詢與規劃，所有參賽的客戶，皆表達高度認同。</li>
				</ul>
			  </section>
			
			  <section>
				<h4></h4>
				<ul>
				  <li>成立「台灣財富管理規劃發展協會」以持續推廣理財教育，結合大專校院與金融機構，將理論與實務經驗做更有效的結合，是本會成立的一個重要目的；透過本會的成立，社會資源因此可以做更有效的利用與結合，理財教育推廣的力度也更將加大。</li>
				</ul>
			  </section>

        </section>
<!-- 區塊終了 -->
		  
<!-- 區塊起始 -->
        <section class="year">
          
			<h3>2012</h3>
			
			  <section>
				<h4></h4>
				<ul>
				  <li>自本年度起，持續舉辦社會組與大專組『全國財富管理競賽』</li>
			  </section>

			  <section>
				<h4></h4>
				<ul>
				  <li>自本年度起，持續舉辦財富管理種子教師研習營(持續舉辦中)</li>
				</ul>
			  </section>
			
			  <section>
				<h4></h4>
				<ul>
				  <li>自本年度起，持續舉辦北、中、南分區財富管理規劃案例競賽</li>
				</ul>
			  </section>

			  <section>
				<h4></h4>
				<ul>
				  <li>自本年度起，持續舉辦青少年財富管理種子教師研習營，落實紮根理財教育工作。</li>
				</ul>
			  </section>
				  
        </section>
<!-- 區塊終了 -->
		
<!-- 區塊起始 -->
        <section class="year">
          
			<h3>2018</h3>

			  <section>
				<h4></h4>
				<ul>
				  <li>正式更名「台灣財富管理規劃顧問認證協會」</li>
				</ul>
			  </section>
			
			  <section>
				<h4></h4>
				<ul>
				  <li>為結合大專院校理財實務教育，舉辦顧問認證測驗，提供適任業師前進校院指導同學財富規劃實務，並予以協助取得競賽佳績。</li>
				</ul>
			  </section>
				  
        </section>
<!-- 區塊終了 -->
			
<!-- 區塊起始 -->
        <section class="year">
          
			<h3>2019</h3>

			  <section>
				<h4></h4>
				<ul>
				  <li>出版『理財達人-探索金融與證券投資市場』高中理財課程用書。</li>
				</ul>
			  </section>
			
			  <section>
				<h4></h4>
				<ul>
				  <li>持續舉辦『教師赴公民營機構廣度教學訓練參訪』。</li>
				</ul>
			  </section>
				  
        </section>
<!-- 區塊終了 -->
		  
      </div>
    </div>
  </div>
</div>
</section>
	
<section class="price_area p_120">
	<div class="container">
		<div class="row">
			<div class="col h3">
				<p>本會的具體持續執行之行動，有以下幾項：</p>
				<ol>
					<li>透過舉辦財富管理教學研討會，讓學界了解財富管理人才培養流程，並建構適合之實作教學課程，協助同學做好「職前訓練」。</li>
					<li>結合學界及產業界共同評審，持續舉辦「全國財富管理競賽」，提升產業水準由學界及產業界各自以不同的角度，來評估參賽隊伍的表現，除了讓參賽隊伍暸解兩個角度的不同看法之外，也讓學界及產業界互相暸解，各自對財富管理重視的不同方向，共謀成長。</li>
					<li>持續舉辦「大專財富管理競賽」，期望透過競賽，讓有心從事金融產業之同學了解自身程度，並激發深入了解財富管理從業技能與所需具備之證照，進而降低業界新人訓練成本，並提升同學就業比率。</li>
					<li>教育部108課綱中，將金融與證券投資實務列入發展重點。因此，透過協會目前所舉辦之各項活動，結合產業界與大專校院，搭配理財桌遊，共同合作開發理財紮根課程，讓基礎教育的師資們有更多、更豐富的資源去教育下一代，讓學生提早具備金融實作經驗，培養正確的理財觀念，將是社會之福。</li>
					<li>結合金融機構、學校及社區資源，經常性地舉辦理財教育講座，將正確理財觀念深植於民間，提昇全民理財的知識與技能。進而提升客戶的忠誠度，降低從業人員開發新客戶成本。</li>
				</ol>
			</div>
		</div>
	</div>
</section>	

<!-- JS IMPORT -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="../lumino/js/bootstrap.min.js"></script>	
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.1.0/js/swiper.esm.bundle.js"></script>

<?php require_once("../model/index_footer.php") ?>
<?php require_once("../model/index_js.php") ?>

<!-- JS Defined -->
<script type="text/javascript" src="../controller/index_nav.js"></script>
<script type="text/javascript" src="../controller/toggle_tooltip.js"></script>
<!-- nexus JS -->
<script src="../nexus/vendors/owl-carousel/owl.carousel.min.js"></script>
<!-- Time Line -->
</body>
</html>