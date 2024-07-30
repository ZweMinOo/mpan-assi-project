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
			url:"http://api.worldbank.org/v2/countries/MM/indicators/AG.LND.FRST.K2?date=2010:2014&format=jsonP&prefix=?",
			success: function(GDPJson){
				console.log(GDPJson);
				GDP_data = GDPJson[1];
				chart_data=[['Year','sq.km']];
				for(var GDP of GDP_data)
				{ 
					if(GDP.date=='2010')
					{
						chart_data[1]=['2010',Number((GDP.value).toFixed(2))]
					}
					else if(GDP.date=='2011')
					{
						chart_data[2]=['2011',Number((GDP.value).toFixed(2))]
					}
					else if(GDP.date=='2012')
					{
						chart_data[3]=['2012',Number((GDP.value).toFixed(2))]
					}
					else if(GDP.date=='2013')
					{
						chart_data[4]=['2013',Number((GDP.value).toFixed(2))]
					}
					else if(GDP.date=='2014')
					{
						chart_data[5]=['2014',Number((GDP.value).toFixed(2))]
					}	
				}
				console.log(chart_data);
				var data=google.visualization.arrayToDataTable(chart_data);
				var options = {
					title: 'Forest area (sq. km) Myanmar',
					curveType: 'function',
					legend: { position: 'bottom' },
					backgroundColor: 'darkGray',
					colors: ['gold']
				};

				var chart = new google.visualization.BarChart(document.getElementById('curve_chart'));
				chart.draw(data, options);
				//return table_data;
			}
		})
		
      }
    </script>
    
<?php require_once 'footer.php'; ?>