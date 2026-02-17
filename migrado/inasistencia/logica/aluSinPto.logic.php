<?PHP //acomodar unos registros de la BD
require_once "conexion3.php";
conectar();
$derivaciones = mysql_query("SELECT * FROM derivacion");
$total = 0;
while ($der = mysql_fetch_assoc($derivaciones)) {
	$documento = str_replace(".","",$der['alumno']);
	//if(mysql_query("UPDATE derivacion SET alumno = $documento WHERE id = '$der[id]'")) $total++;
	printf("<p>original: %s -> numerico: %s </p>",$der['alumno'],$documento);
	printf("<p>%s y van %s</p>",mysql_affected_rows(),$total);
	}
?>

