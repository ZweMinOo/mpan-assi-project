<?php require_once 'header.php'; ?>
	<div class="container well">
		<section>
			<h1>GDP of countries</h1>
			<table id="example" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Id</th>
						<th>Country/Region</th>
						<th>ISO3 Code</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>Id</th>
						<th>Country/Region</th>
						<th>ISO3 Code</th>
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
			url: "http://api.worldbank.org/v2/indicator?sper_page=300&date=2002:2018&format=jsonP&prefix=?",
			dataSrc: function (GDPJson) {
				console.log(GDPJson);
				GDP_data = GDPJson[1];
				table_data = [];
				for(var GDP of GDP_data) {
					console.log(GDP);
					table_data.push({
						id: GDP.id,
						country: GDP.name,
						iso3code: GDP.source.value
					});
				}
				return table_data;
			}
		},
		"columns": [
			{ "data": "id"},
			{ "data": "country" },
			{ "data": "iso3code" },
		]
	} );
} );

	</script>
<?php require_once 'footer.php'; ?>