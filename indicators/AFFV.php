<?php require_once 'header.php'; ?>

<!--************ Button ************-->
<div class="well">
<div class="row">
	<div class="col-md-2">
		<button class="btn btn-default" onclick="drawBarChart()">Table</button>
	</div>
	<div class="col-md-2">
		<button class="btn btn-default" onclick="drawChart('Bar')">Bar Chart</button>
	</div>
	<div class="col-md-2">
		<button class="btn btn-default" onclick="drawChart('Line')">Line Chart</button>
	</div>
</div>
<!--************ Display ***********-->
<div class="row">
	<div id="curve_chart" class="well" style="width: 900px; height: 500px; color:white;"></div>
</div>
<div class="row">
	Comments..
</div>
</div>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
	
	
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart());

      function drawChart(type) {
	  $.ajax({
			method: "GET",
			dataType: "jsonp",
			url:"http://api.worldbank.org/v2/countries/MM/indicators/NV.AGR.TOTL.ZS?date=2010:2015&format=jsonP&prefix=?",
			success: function(GDPJson){
				console.log(GDPJson);
				GDP_data = GDPJson[1];
				chart_data=[['Year','kt']];
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
					else if(GDP.date=='2015')
					{
						chart_data[5]=['2015',Number((GDP.value).toFixed(2))]
					}
				}
				console.log(chart_data);
				var data=google.visualization.arrayToDataTable(chart_data);
				var options = {
					title: 'Agriculture, forestry, and fishing, value added (% of GDP) Myanmar',
					curveType: 'function',
					legend: { position: 'bottom' },
					backgroundColor: 'gray',
					colors: ['yellow']
				};

				var chart = "";
				if(type == 'Bar')
					chart = new google.visualization.BarChart(document.getElementById('curve_chart'));
				else 
					chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

				chart.draw(data, options);
				//return table_data;
			}
		})
      }
    </script>
<?php require_once 'footer.php'; ?>