<?php require_once 'header.php'; ?>
	<div class="container well">
		<section>
			<h1>GDP of countries</h1>
			<table id="example" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Country/Region</th>
						<th>ISO3 Code</th>
						<th>Year</th>
						<th>Indicator</th>
						<th>Value</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>Country/Region</th>
						<th>ISO3 Code</th>
						<th>Year</th>
						<th>Indicator</th>
						<th>Value</th>
					</tr>
				</tfoot>
			</table>
		</section>
	</div>
	<script type="text/javascript" language="javascript" class="init">
		
	$(document).ready(function() {
		$('#example').DataTable( {
			"ajax": {
				type: "GET",
				url: "http://api.worldbank.org/v2/countries/all/indicators/NY.GDP.MKTP.CD?per_page=300&date=2002:2008&format=jsonP&prefix=?",
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
							indicator: GDP.indicator.value,
							value: GDP.value,
						});
					}
					return table_data;
				}
			},
			"columns": [
				{ "data": "country" },
				{ "data": "iso3code" },
				{ "data": "year" },
				{ "data": "indicator" },
				{ "data": "value" }
			]
		} );
	} );

	</script>
<?php require_once 'footer.php'; ?>