<?php
header("Content-type: application/vnd.ms-excel" ) ;
header("Content-Disposition: attachment; filename=archivo.xls" ) ;
	mysql_connect("localhost", "root", "msi2010");
	mysql_select_db("sid");

$desde=$_GET["desde"];
$hasta=$_GET["hasta"];
$qry=mysql_query("SELECT docentes.dni, docentes.apellido, docentes.nombre, diario.horario, diario.fecha, diario.tipo FROM docentes, diario WHERE docentes.identificacion =2 AND docentes.dni = diario.dni AND diario.fecha >= '$desde' AND diario.fecha <= '$hasta' order by docentes.apellido, docentes.dni, diario.fecha, diario.horario");


$campos = mysql_num_fields($qry) ;
$i=0;
echo "<table><tr>";
while($i<$campos){
echo "<td>". mysql_field_name ($qry, $i) ;
echo "</td>";
$i++;
}
echo "</tr>";
while($row=mysql_fetch_array($qry)){
echo "<tr>";
for($j=0; $j<$campos; $j++) {
echo "<td>".$row[$j]."</td>";
}
echo "</tr>";
}
echo "</table>";
?> 