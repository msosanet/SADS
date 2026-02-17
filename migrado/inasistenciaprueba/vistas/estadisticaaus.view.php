<!DOCTYPE html>
<html lang="en">
<head>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

    var data = google.visualization.arrayToDataTable([
      ['Fecha', 'EF','GRAL'],
      <?php
      if($result->num_rows > 0){
          while($row = $result->fetch_assoc()){
		$fechita=$row['fecha'];
        //$link="<a href='http://inasistencias.colegiosobral.edu.ar/alumnostarde.php?fecha=$fechita&ver=Mostrar' target='_blank'>".$fechita."</a>";
		echo $link;
		echo "['".$row['fecha']."', ".$row['EduFisica']."', ".$row['General']."],";
     	//echo "['".$row['fecha']."', ".$row['tipo'].", '".$row['total']."'],";

          }
      }
      ?>
    ]);
    
    var options = {
        title: 'Cantidad de Ausentes por dia del mes en curso',
        width: 1200,
        height: 900,
    };
    
    var chart = new google.visualization.BarChart(document.getElementById('barchart_values'));
    
    chart.draw(data, options);
}
</script>



</head>
<body>
    <!-- Display the pie chart -->
    <div id="barchart_values"></div>
</body>
</html>
