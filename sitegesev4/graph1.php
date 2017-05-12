<?php 
array_unshift($data_entrada, 'Mês');
array_unshift($PI, 'PI');
array_unshift($CP, 'Consumo Ponta');
array_unshift($CFP, 'Consumo Fora da Ponta');
array_unshift($LU, 'Limite de Ultrapassagem');
?>

<html lang="pt-br">
<head>
	  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
        	 <?php 
for ($i=0; $i < $endkey_entrada+2; $i++) 
        	{ 
        		if ($i==0) {
        			echo "['$data_entrada[$i]','$PI[$i]'],";
        			
        		}	
        		else if ($i == $endkey_entrada+1) {
        			echo "['$data_entrada[$i]',$PI[$i]]";
        		}
        		else
        		{
        			echo "['$data_entrada[$i]',$PI[$i]],";

        		}

        	}
     ?>
        ]);

        var options = {
          title: 'PI (R$/kWh)',
          titleTextStyle: {color: '#2F4F4F', fontSize:20, fontName: 'gotham'},
          hAxis: {textStyle: {color: '#2F4F4F', fontName: 'gotham'}},
          vAxis: {minValue: 0, textStyle: {color: '#2F4F4F', fontName: 'gotham'}}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div1'));

        chart.draw(data, options);
      }












       google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
          <?php 
for ($i=0; $i < $endkey_entrada+2; $i++) 
          { 
            if ($i==0) {
              echo "['$data_entrada[$i]','$CP[$i]','$CFP[$i]','$LU[$i]'],";             
            } 
            else if ($i == $endkey_entrada+1) {
              echo "['$data_entrada[$i]',$CP[$i],$CFP[$i],$LU[$i]]";
            }
            else
            {
              echo "['$data_entrada[$i]',$CP[$i],$CFP[$i],$LU[$i]],";

            }

          }
     ?>
      ]);

    var options = {
      title : 'CARGA (kWh)',
      titleTextStyle: {color: '#2F4F4F', fontSize:20, fontName: 'gotham'},
      hAxis: {textStyle: {color: '#2F4F4F', fontName: 'gotham'}},
      vAxis: {textStyle: {color: '#2F4F4F', fontName: 'gotham'}},
      seriesType: 'bars',
      series: {2: {type: 'line'}}
    };

    var chart = new google.visualization.ComboChart(document.getElementById('chart_div2'));
    chart.draw(data, options);
  }
	   </script>
</head>

<body>
 <div id="chart_div1" style="width: 100%; height: 100%;"></div>
 <div id="chart_div2" style="width: 100%; height: 100%;"></div>
</body>
</html>