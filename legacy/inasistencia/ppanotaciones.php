<html>
<?PHP

session_start();
if ($_SESSION['estado']==1) { 

include 'conexion3.php';
//include 'conexion4.php';
/*
$dni=$_GET['dnix'];
$fechafalta=$_GET['fechaxxx'];
$materia=$_T['materiax'];
$curso=$_GET['cursox'];
$anotaciones=$_GET['anotaciones'];
$hora=$_GET['hora'];
$materia=$_GET['materia'];
*/

$id=$_GET['id'];
$conexion = conectar ();
$consulta="SELECT * FROM partepreceptores WHERE registro='$id'";
//echo $consulta;
$result80 = mysql_query ($consulta);
while ($fila80 = mysql_fetch_array($result80))
{
$anotacionx=$fila80['anotaciones'];	
}	





echo "<form method='GET' action='ppanotaciones.php' target='_self'>";

echo "<table style='width: 30%;' border='5' cellpadding='1'>";
echo "<th>ANOTACIONES PARA LA AUSENCIA</th>";
echo "<tr>";
echo "<td><textarea cols='80' rows='10' name='comentarios'>".$anotacionx."</textarea></td>";
echo "</tr>";
echo "<input type='hidden' name='idx' value='$id' />";
echo "<tr>";
echo "<td><input type='submit' style='width: 30%;' value='Guardar' name='submitcurso' /></td>";
echo "<tr>";
echo "</table>";

echo "</form>";

//$conexionx = conectarx ();




if(isset($_GET['submitcurso']))
 {

$anotaciones=$_GET['comentarios'];
$idx=$_GET['idx'];
$conexion = conectar ();
$consulta="SELECT * FROM partepreceptores WHERE registro='$idx'";
$result79 = mysql_query ($consulta);
while ($fila79 = mysql_fetch_array($result79))
{
$fecha=$fila79['fecha'];	
}	



$sql="UPDATE partepreceptores SET anotaciones='$anotaciones' WHERE registro='$idx' ";	
//echo $sql;
//mysql_query ($sql);
if (mysql_query ($sql))
{	
?>
			<script>
			var answer=alert("Se han guardado las anotaciones")
			</script> 
			<meta http-equiv='refresh' content='0; URL=selcurparver.php?fechax=<?echo $fecha; ?>&partedia=Ver'>
<?

}
else 
{	
?>
			<script>
			var answer=alert("No se ha podido guardar")
			</script> 
			
<?

}


}

}	
?>

</html>