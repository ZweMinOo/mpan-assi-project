<?php 
  require_once 'header.php';
?>
    
    <button class="btn btn-default" onclick="drawChart(2010)">2010</button>
    <button class="btn btn-default" onclick="drawChart(2011)">2011</button>
    <button class="btn btn-default" onclick="drawChart(2013)">2013</button>
    <button class="btn btn-default" onclick="drawChart(2014)">2014</button>
    <button class="btn btn-default" onclick="drawChart(2015)">2015</button>
    <div id="curve_chart" style="width: 900px; height: 500px"></div>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart(2010));

      function drawChart(year) {
        $.ajax({
          method: "GET",
          dataType: "jsonp",
          url: "http://api.worldbank.org/v2/countries/BRN;IDN;KHM;LAO;MMR;MYS;PHL;SGP;THA;VNM/indicators/NY.GDP.MKTP.CD?per_page=300&date="+year+"&format=jsonP&prefix=?",
          success: function (GDPJson) {
            console.log(GDPJson);
            GDP_data = GDPJson[1];
            chart_data = [
              ['Year', 'BRN','IDN','KHM','LAO','MMR','MYS','PHL','SGP','THA','VNM']
            ];

            for(var GDP of GDP_data) {
              if (GDP.date == '2010') {
                /** Country **/
                var i = 1;
                if (GDP.countryiso3code === 'BRN') {
                  chart_data[i] = ['BRN', Number((GDP.value/100000000).toFixed(2)) ]
                } else if (GDP.countryiso3code === 'IDN') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'KHM') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'LAO') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'MMR') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'MYS') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'PHL') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'SGP') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'THA') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'VNM') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
              } else if (GDP.date == '2011') {
                var i = 1;
                if (GDP.countryiso3code === 'BRN') {
                  chart_data[i] = ['2011', Number((GDP.value/100000000).toFixed(2)) ]
                } else if (GDP.countryiso3code === 'IDN') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'KHM') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'LAO') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'MMR') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'MYS') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'PHL') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'SGP') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'THA') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'VNM') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
              } else if (GDP.date == '2012') {
                var i = 1;
                if (GDP.countryiso3code === 'BRN') {
                  chart_data[i] = ['2012', Number((GDP.value/100000000).toFixed(2)) ]
                } else if (GDP.countryiso3code === 'IDN') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'KHM') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'LAO') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'MMR') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'MYS') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'PHL') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'SGP') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'THA') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'VNM') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
              } else if (GDP.date == '2013') {
                var i = 1;
                if (GDP.countryiso3code === 'BRN') {
                  chart_data[i] = ['2013', Number((GDP.value/100000000).toFixed(2)) ]
                } else if (GDP.countryiso3code === 'IDN') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'KHM') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'LAO') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'MMR') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'MYS') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'PHL') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'SGP') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'THA') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'VNM') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
              }
              else if (GDP.date == '2014') {
                var i = 1;
                if (GDP.countryiso3code === 'BRN') {
                  chart_data[i] = ['2014', Number((GDP.value/100000000).toFixed(2)) ]
                } else if (GDP.countryiso3code === 'IDN') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'KHM') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'LAO') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'MMR') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'MYS') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'PHL') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'SGP') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'THA') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'VNM') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
              }
              else if (GDP.date == '2015') {
                var i = 1;
                if (GDP.countryiso3code === 'BRN') {
                  chart_data[i] = ['2015', Number((GDP.value/100000000).toFixed(2)) ]
                } else if (GDP.countryiso3code === 'IDN') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'KHM') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'LAO') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'MMR') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'MYS') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'PHL') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'SGP') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'THA') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
                else if (GDP.countryiso3code === 'VNM') {
                  chart_data[i].push(Number((GDP.value/100000000).toFixed(2)))
                }
              }
            }

            console.log(chart_data);
            var data = google.visualization.arrayToDataTable(chart_data);
            var options = {
              title: 'GDP of Countries (billion USD)',
              curveType: 'function',
              legend: { position: 'bottom' },
              bar: {groupWidth: "55%"},
              backgroundColor: 'yellow',
              colors: ['green','darkred','black','orange','','silver','gold','white','DarkBlue','DarkMagenta']
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('curve_chart'));
            
            chart.draw(data, options);
          }
        });
      }
    </script>
<?php
  require_once 'footer.php';
?>