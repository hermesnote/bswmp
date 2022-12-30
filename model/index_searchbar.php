<div class="container-fluid bg-light">
<form name="searchBar" id="searchBar" class="col-12 mx-auto" method="post">
	<div class="row">
		<div class="col-xl-12 mx-auto my-auto">
			<div class="input-group col-sm-6 py-5 mx-auto">
				<div class="input-group-prepend">
					<button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="mainSearch">查詢項目 </button>
				<div class="dropdown-menu">
					<a class="dropdown-item" id="mainSearch_compet" href="javascript:void();" value="">競賽查詢 </a>
					<a class="dropdown-item" id="mainSearch_exam" href="javascript:void();" value="">測驗查詢 </a>
					<a class="dropdown-item" id="mainSearch_advisor" href="javascript:void();" value="">尋找顧問 </a>
				<div role="separator" class="dropdown-divider"></div>
					<a class="dropdown-item" id="mainSearch_site" href="###">全站搜尋 </a>
				</div>
				</div>
				<input name="searchBarInput" id="searchBarInput" type="text" class="form-control text-center" aria-label="Text input with dropdown button" placeholder="" style="font-size:20px">
				<div class="input-group-append">
				<button class="btn btn-info" type="button" onClick="search()">
				<i class="fa fa-search"></i>
				</button>
				</div>
			</div>
		</div>
	</div>
</form>
</div>