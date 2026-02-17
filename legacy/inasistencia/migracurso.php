<?php
include 'conexion3.php';
$conexion = conectar ();
$result79 = mysql_query ("SELECT * FROM curso2 ORDER BY descripcion DESC");
while ($fila79 = mysql_fetch_array($result79))
{ 	
$completo=$fila79['idcurso'];
//echo "Curso:$completo";
//echo "Cortado:".substr($completo, 0,1);
$curso=substr($completo, 0,1);
$division=substr($completo, 1);
//echo "Curso:".$curso;
//echo "Division:".$division;   

if ($curso==0){$curso='A';}
if ($division==0 OR $division==00){$division='A';}


$sql = "UPDATE curso2modificado SET curso='$curso',division='$division' WHERE idcurso=$completo";
//echo $sql;
$result = mysql_query($sql);


echo "<br>";  // bcdef
}







?>
