<?php 
  require_once 'header.php';
  $api = 'BX.KLT.DINV.CD.WD';
?>
<div class="row" style="background: none;">
  <div class="row">  
    <!-- Board -->
    <div class="col-md-2">
    </div>    
    <div class="well col-md-8">
      <a href='index.php' style="color:black;">Back to Home</a>
      <h3>Foreign direct investment, net inflows (BoP, current US$) Asian</h3>
      <input type="radio" name="api" value="myanmar" onclick="showFor()"/>Myanmar
      <input type="radio" name="api" value="all" checked="checked"/> All asian countries <br>

      <button class="btn btn-default" onclick="chartType('Bar')">Bar Chart</button>
      <button class="btn btn-default" onclick="chartType('Line')">Pie Chart</button>
      <button class="btn btn-default" onclick="showTable()">Table</button> <br>

      <input type="radio" name="year" onclick="drawChart(2010)" checked="checked"/> 2010
      <input type="radio" name="year" onclick="drawChart(2011)""/> 2011 
      <input type="radio" name="year" onclick="drawChart(2012)""/> 2012
      <input type="radio" name="year" onclick="drawChart(2013)""/> 2013
      <input type="radio" name="year" onclick="drawChart(2014)""/> 2014 <br>
      <div id="curve_chart" class="well" style="width: auto; height: 500px; color:white;"></div>
        <section id="Table" style="display:none;">
          <h1>GDP of countries</h1>
          <table id="example" class="display" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Country/Region</th>
                <th>ISO3 Code</th>
                <th>Year</th>
                <th>Value</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Country/Region</th>
                <th>ISO3 Code</th>
                <th>Year</th>
                <th>Value</th>
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
          <form method="POST" action="ForeginDirectInvestAsian.php">
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
        <a href="ForeginDirectInvestAsian.php" style="color:blue;">Refresh Comments</a>
        <?php showComments($api,'ForeginDirectInvestAsian.php'); ?>     
      </div>
    </div>
    <!-- End Comments -->
  </div>
</div>
<!-- Scripts -->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      var data,option;
      var api = 'BX.KLT.DINV.CD.WD';
      function showFor(){
        window.location.href='ForeginDirectInvestMM.php';
      }
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart(2010));

      function drawChart(year) {
        $.ajax({
          method: "GET",
          dataType: "jsonp",
          url: "http://api.worldbank.org/v2/countries/BRN;IDN;KHM;LAO;MMR;MYS;PHL;SGP;THA;VNM/indicators/"+api+"?per_page=300&date="+year+"&format=jsonP&prefix=?",
          success: function (GDPJson) {
            console.log(GDPJson);
            GDP_data = GDPJson[1];
            chart_data = [
              ['Year', 'Country']
            ];

            for(var GDP of GDP_data) {
                /** Country **/
                if (GDP.countryiso3code === 'BRN') {
                  chart_data[1] = [GDP.country.value, Number((GDP.value/100000000).toFixed(2))]
                } else if (GDP.countryiso3code === 'IDN') {
                  chart_data[2] = [GDP.country.value, Number((GDP.value/100000000).toFixed(2))]
                }
                else if (GDP.countryiso3code === 'KHM') {
                  chart_data[3] = [GDP.country.value, Number((GDP.value/100000000).toFixed(2))]
                }
                else if (GDP.countryiso3code === 'LAO') {
                  chart_data[4] = [GDP.country.value, Number((GDP.value/100000000).toFixed(2))]
                }
                else if (GDP.countryiso3code === 'MMR') {
                  chart_data[5] = [GDP.country.value, Number((GDP.value/100000000).toFixed(2))]
                }
                else if (GDP.countryiso3code === 'MYS') {
                  chart_data[6] = [GDP.country.value, Number((GDP.value/100000000).toFixed(2))]
                }
                else if (GDP.countryiso3code === 'PHL') {
                  chart_data[7] = [GDP.country.value, Number((GDP.value/100000000).toFixed(2))]
                }
                else if (GDP.countryiso3code === 'SGP') {
                  chart_data[8] = [GDP.country.value, Number((GDP.value/100000000).toFixed(2))]
                }
                else if (GDP.countryiso3code === 'THA') {
                  chart_data[9] = [GDP.country.value, Number((GDP.value/100000000).toFixed(2))]
                }
                else if (GDP.countryiso3code === 'VNM') {
                  chart_data[10] = [GDP.country.value, Number((GDP.value/100000000).toFixed(2))]
                }         
            }

            console.log(chart_data);
            data = google.visualization.arrayToDataTable(chart_data);
            options = {
              title: 'Foreign direct investment, net inflows (BoP, current US$) '+year,
              curveType: 'function',
              legend: { position: 'left' },
              bar: {groupWidth: "55%"},
              backgroundColor:'white',
              colors: ['red','blue','orange','green','pink','purple','black','gold','silver','lightGreen'],
              vAxis: {
                title: 'Country'
              },
              hAxis: {
                title: 'GPD value'
              }
            };

            var chart = new google.visualization.BarChart(document.getElementById('curve_chart'));
            
            chart.draw(data, options);
          }
        });
      }
    function chartType(type) {
        var chart = "";
        if(type == 'Bar')
          chart = new google.visualization.BarChart(document.getElementById('curve_chart'));
        else 
          chart = new google.visualization.PieChart(document.getElementById('curve_chart'));
        
          document.getElementById('Table').style.display = "none";
          document.getElementById('curve_chart').style.display = "block";
          chart.draw(data, options);
        //return table_data;
       }
       $(document).ready(function() {
         $('#example').DataTable( {       
          "ajax": {
            type: "GET",
            url: "http://api.worldbank.org/v2/countries/BRN;IDN;KHM;LAO;MMR;MYS;PHL;SGP;THA;VNM/indicators/"+api+"?date=2010:2015&format=jsonP&prefix=?",
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