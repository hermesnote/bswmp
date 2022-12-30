var randomScalingFactor = function(){ return Math.round(Math.random()*1000)};
		
	var barChartData = {
			labels : ["January","February","March","April","May","June","100"],
			datasets : [
				{
					fillColor : "rgba(220,220,220,0.5)",
					strokeColor : "rgba(220,220,220,0.8)",
					highlightFill: "rgba(220,220,220,0.75)",
					highlightStroke: "rgba(220,220,220,1)",
					data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
				},
				{
					fillColor : "rgba(48, 164, 255, 0.2)",
					strokeColor : "rgba(48, 164, 255, 0.8)",
					highlightFill : "rgba(48, 164, 255, 0.75)",
					highlightStroke : "rgba(48, 164, 255, 1)",
					data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
				}
			]
	
		};

	var pieData = [
				{
					value: 300,
					color:"#30a5ff",
					highlight: "#62b9fb",
					label: "Blue"
				},
				{
					value: 50,
					color: "#ffb53e",
					highlight: "#fac878",
					label: "Orange"
				},
				{
					value: 100,
					color: "#1ebfae",
					highlight: "#3cdfce",
					label: "Teal"
				},
				{
					value: 120,
					color: "#f9243f",
					highlight: "#f6495f",
					label: "Red"
				}

			];
			
	var doughnutData = [
					{
						value: 300,
						color:"#30a5ff",
						highlight: "#62b9fb",
						label: "Blue"
					},
					{
						value: 50,
						color: "#ffb53e",
						highlight: "#fac878",
						label: "Orange"
					},
					{
						value: 100,
						color: "#1ebfae",
						highlight: "#3cdfce",
						label: "Teal"
					},
					{
						value: 120,
						color: "#f9243f",
						highlight: "#f6495f",
						label: "Red"
					}
	
				];

window.onload = function(){
	var chart1 = document.getElementById("line-chart").getContext("2d");
	
		$.ajax({

			url:"https://wmpcca.com/bswmp/form/model/admin_getIndexLineChartData.php",
			data:{},

			method : "POST",

			error : function(msg){
				alert('something wrong!');
			},

			success : function(msg){
				var day0 = msg[0];
				var day1 = msg[1];
				var day2 = msg[2];
				var day3 = msg[3];
				var day4 = msg[4];
				var day5 = msg[5];
				var day6 = msg[6];
				
					var lineChartData = {
							labels : [day6,day5,day4,day3,day2,day1,day0],
							datasets : [
								{
									label: "1",
									fillColor : "rgba(220,220,220,0.2)",
									strokeColor : "rgba(220,220,220,1)",
									pointColor : "rgba(220,220,220,1)",
									pointStrokeColor : "#fff",
									pointHighlightFill : "#fff",
									pointHighlightStroke : "rgba(220,220,220,1)",
									data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
//									data : [100,200,300,400,500,600,day0]
								},
								{
									label: "2",
									fillColor : "rgba(255,234,85,0.2)",
									strokeColor : "rgba(255,234,85,1)",
									pointColor : "rgba(255,234,85,1)",
									pointStrokeColor : "#fff",
									pointHighlightFill : "#fff",
									pointHighlightStroke : "rgba(255,234,85,1)",
									data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
//									data : [100,200,300,400,500,600,day0]
								},
								{
									label: "3",
									fillColor : "rgba(255,166,133,0.2)",
									strokeColor : "rgba(255,166,133,1)",
									pointColor : "rgba(255,166,133,1)",
									pointStrokeColor : "#fff",
									pointHighlightFill : "#fff",
									pointHighlightStroke : "rgba(255,166,133,1)",
									data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
//									data : [100,200,300,400,500,600,day0]
								},
								{
									label: "4",
									fillColor : "rgba(48, 164, 255, 0.2)",
									strokeColor : "rgba(48, 164, 255, 1)",
									pointColor : "rgba(48, 164, 255, 1)",
									pointStrokeColor : "#fff",
									pointHighlightFill : "#fff",
									pointHighlightStroke : "rgba(48, 164, 255, 1)",
									data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
//									data : [200,600,400,800,200,100,day0]
								}
							]

						};
				
					window.myLine = new Chart(chart1).Line(lineChartData, {
						responsive: true
						
						
					});
			}

		});
	

	var chart2 = document.getElementById("bar-chart").getContext("2d");
	window.myBar = new Chart(chart2).Bar(barChartData, {
		responsive : true
	});
	var chart3 = document.getElementById("doughnut-chart").getContext("2d");
	window.myDoughnut = new Chart(chart3).Doughnut(doughnutData, {responsive : true
	});
	var chart4 = document.getElementById("pie-chart").getContext("2d");
	window.myPie = new Chart(chart4).Pie(pieData, {responsive : true
	});
	
};