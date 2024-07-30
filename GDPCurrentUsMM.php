<?php 
	require_once 'header.php'; 
	$api = 'NY.GDP.MKTP.CD';
?>
<div class="row" style="background: none;">
	<div class="row">
		<!-- Board -->
		<div class="col-md-2">
		</div>		
		<div class="well col-md-8">
			<a href='index.php' style="color:black;">Back to Home</a>
			<h3>GDP (current US$) Myanmar</h3>
			<input type="radio" name="api" value="myanmar" checked="checked">Myanmar
  			<input type="radio" name="api" value="all" onclick="showFor()"> All asian countries <br>
			<button class="btn btn-default" onclick="chartType('Bar')">Bar Chart</button>
			<button class="btn btn-default" onclick="chartType('Line')">Line Chart</button>
			<button class="btn btn-default" onclick="showTable()">Table</button>
			<div id="curve_chart" class="well" style="width: auto; height: 500px; color:white;"></div>
				<section id="Table" style="display:none;">
					<h1>GDP (current US$) Myanmar</h1>
					<table id="example" class="display" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>Country/Region</th>
								<th>ISO3 Code</th>
								<th>Year</th>
								<th>% of GDP</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Country/Region</th>
								<th>ISO3 Code</th>
								<th>Year</th>
								<th>% of GDP</th>
							</tr>
						</tfoot>
					</table>
				</section>
		</div>
		<!-- End Board -->
	</div>
	<div class="row">
		<!-- Comments -->
		<div class="col-md-2">
		</div>
		<div class="well col-md-8">
			<h3> Comments </h3>
<?php
	if(isset($_SESSION['user'])){
	echo <<<_END
			<div class="panel panel-info width-300px">
				<div class="panel-body">
					<form method="POST" action="GDPCurrentUsMM.php">
						<div class="col-md-8">
							<textarea class="form-control" name="cmt"></textarea>
						</div>
						<div class="col-md-4">
							<button type="submit" class="btn btn-default" style="width:100%;height:100%;font-size:20px;">Send</button>
						</div>
					</form>
				</div>
			</div>
_END;
	}
?>
			<div id="cmt">
				<a href="GDPCurrentUsMM.php" style="color:blue;">Refresh Comments</a>
				<?php showComments($api,'GDPCurrentUsMM.php'); ?>   
			</div>
		</div>
		<!-- End Comments -->
	</div>
</div>
<!-- Scripts -->
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
 		google.charts.load('current', {'packages':['corechart']});
      	google.charts.setOnLoadCallback(drawChart);
      	var data,option;
      	var api = 'NY.GDP.MKTP.CD';
      	function showFor(){
      		window.location.href='GDPCurrentUsAsian.php';
      	}
      	function drawChart(){
	 		$.ajax({
				method: "GET",
				dataType: "jsonp",
				url:"http://api.worldbank.org/v2/countries/MM/indicators/"+api+"?date=2010:2014&format=jsonP&prefix=?",
				success: function(GDPJson){
					console.log(GDPJson);
					GDP_data = GDPJson[1];
					chart_data=[['Year','current US$)']];
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
					data=google.visualization.arrayToDataTable(chart_data);
					options = {
						title: 'GDP (current US$) Myanmar',
						curveType: 'function',
						legend: { position: 'bottom' },
						backgroundColor: 'white',
						vAxis: {
			            	title: 'Year'
			            },
			            hAxis: {
			            	title: 'current US$)'
			            }
					};
					var chart = new google.visualization.BarChart(document.getElementById('curve_chart'));
					chart.draw(data, options);
				}
			})
	 	}
		function chartType(type) {
				var chart = "";
				if(type == 'Bar')
					chart = new google.visualization.BarChart(document.getElementById('curve_chart'));
				else 
					chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
				
				document.getElementById('Table').style.display = "none";
   		 		document.getElementById('curve_chart').style.display = "block";
   		 		chart.draw(data, options);
				//return table_data;
   		 }
   		 $(document).ready(function() {
	   		 $('#example').DataTable( {				
					"ajax": {
						type: "GET",
						url: "http://api.worldbank.org/v2/countries/MM/indicators/"+api+"?date=2010:2015&format=jsonP&prefix=?",
						dataSrc: function (GDPJson) {
							console.log(GDPJson);
							GDP_data = GDPJson[1];
							table_data = [];
							for(var GDP of GDP_data) {
								console.log(GDP);
								table_data.push({
									country: GDP.country.value,
									iso3code: GDP.countryiso3code,
									year: GDP.date,
									value: Number((GDP.value).toFixed(2)),
								});
							}
							return table_data;
						}
					},
					"columns": [
						{ "data": "country" },
						{ "data": "iso3code" },
						{ "data": "year" },
						{ "data": "value" }
					]
				} );
	   		});
   		 function showTable(){
   		 	document.getElementById('Table').style.display = "block";
   		 	document.getElementById('curve_chart').style.display = "none";
		}
    </script>
<!-- End Scripts -->
<?php 		
	if(isset($_POST['cmt'])){
	    if(trim($_POST['cmt'])!= ""){
		     	$txt = $_POST['cmt'];
		     	$time = time();
		     	$user = $_SESSION['user'];
		     	$query = "INSERT INTO comments (api,user,time,text) VALUES ('$api','$user','$time','$txt')";
		      	queryMysql($query);
	    }
	}
	require_once 'footer.php'; 
?>