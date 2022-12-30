// JavaScript Document
	$(function() {
		$( ".datepicker" ).datepicker({
			dateFormat:'yy-mm-dd',
			firstDay:'1',
			monthNamesShort: ['一月','二月','三月','四月','五月','六月', '七月','八月','九月','十月','十一月','十二月'],
			dayNamesMin: ['日','一','二','三','四','五','六'],
			changeMonth: true,
			changeYear: true,
			yearRange:'-100:+0'
		});
	});