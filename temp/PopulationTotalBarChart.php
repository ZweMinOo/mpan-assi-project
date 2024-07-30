<?php require_once 'header.php'; ?>
	<div class="container">
		<div id="curve_chart" class="well" style="width: 900px; height: 500px; color:white;"></div>
	</div>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
	
	
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
	  $.ajax({
			method: "GET",
			dataType: "jsonp",
			url:"http://api.worldbank.org/v2/countries/MMR/indicators/SP.POP.TOTL?date=2010:2014&format=jsonP&prefix=?",
			success: function(GDPJson){
				console.log(GDPJson);
				GDP_data = GDPJson[1];
				var chart_data = [];
				chart_data[0]=['Years','Billion'];
				for(var GDP of GDP_data)
				{ 
					if(GDP.date=='2010')
					{
						if(GDP.value==null) GDP.value = 0;
						chart_data[1]=['2010',Number((GDP.value/1000000).toFixed(2))]
					}
					else if(GDP.date=='2011')
					{
						if(GDP.value==null) GDP.value = 0;
						chart_data[2]=['2011',Number((GDP.value/1000000).toFixed(2))]
					}
					else if(GDP.date=='2012')
					{
						if(GDP.value==null) GDP.value = 0;
						chart_data[3]=['2012',Number((GDP.value/1000000).toFixed(2))]
					}
					else if(GDP.date=='2013')
					{
						if(GDP.value==null) GDP.value = 0;
						chart_data[4]=['2013',Number((GDP.value/1000000).toFixed(2))]
					}
					else if(GDP.date=='2014')
					{
						if(GDP.value==null) GDP.value = 0;
						chart_data[5]=['2014',Number((GDP.value/1000000).toFixed(2))]
					}	
				}
				console.log(chart_data);
				var data=google.visualization.arrayToDataTable(chart_data);
				var options = {
					title: 'Population, total',
					curveType: 'function',
					legend: {position: 'bottom' },
					backgroundColor: 'darkGray',
					colors: ['gold'],
				};

				var chart = new google.visualization.BarChart(document.getElementById('curve_chart'));
				chart.draw(data, options);
				//return table_data;
			}
		})
		
      }
    </script>
    
<?php require_once 'footer.php'; ?>