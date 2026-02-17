<?PHP // Reprobados y aprobados por espacios para el primer cuatrimestre
if ($_SESSION['estado']!=1) exit();

require_once('submod/conexion.php');
$base = conectarcalif();
if (mysqli_connect_errno()) exit();

// Nombre de espacios curriculares
$qNomEspacios = $base->prepare("SELECT * FROM `materias` ");
$qNomEspacios->execute();
$qNomEspacios->bind_result($_idmat,$_desc,$_abrv,$_curric);
$nomEspacios = [];
while ($m = $qNomEspacios->fetch()) $nomEspacios[$_idmat] = $_desc;
$qNomEspacios->close();

$cursos = ["1_","2_","3_","4_","5_","6_","7_"];

// Cantidades de reprobados
$consulta = $base->prepare("SELECT materia,COUNT(dni) AS reprobados FROM `calificador2` WHERE `anio` = ? AND `idnota` = 2 AND nota BETWEEN 1 AND 5 AND curso LIKE ? GROUP BY materia");
foreach ($cursos AS $c) {
	$consulta->bind_param('is',$ciclo,$c);
	$consulta->execute();
	$consulta->bind_result($espacio,$cantRepro);
	while($consulta->fetch()) {
		$tabla_tits[$espacio] = $espacio;
		$cantidades[$c]['r'][$espacio] = $cantRepro;
	}
}
$consulta->close();

// Cantidades de aprobados
$consulta = $base->prepare("SELECT materia,COUNT(dni) AS reprobados FROM `calificador2` WHERE `anio` = '2024' AND `idnota` = 2 AND nota BETWEEN 6 AND 10 AND curso LIKE ? GROUP BY materia");
foreach ($cursos AS $c) {
	$consulta->bind_param('s',$c);
	$consulta->execute();
	$consulta->bind_result($espacio,$cantApro);
	while($consulta->fetch()) {
		$tabla_tits[$espacio] = $espacio;
		$cantidades[$c]['a'][$espacio] = $cantApro;
	}
}
$consulta->close();

$base->close();

?>

<div>
	<table>
		<thead>
			<tr>
				<th>A&ntilde;o</th>
<?PHP
foreach ($tabla_tits AS $e) printf("<th style='writing-mode: vertical-rl; text-orientation: mixed;'>%s</th>",$nomEspacios[$e]);
?>
			</tr>
		</thead>
		<tbody>

<?PHP
foreach ($cantidades AS $cu => $subConj) {
	printf("<tr class='alte'><td class='alte'>%s reprobados</td>",substr($cu,0,1));
	$espRep = $subConj['r'];
	foreach ($tabla_tits AS $e) {
		if (array_key_exists($e,$espRep)) printf("<td class='alte'>%s</td>",$espRep[$e]);
		else echo "<td class='alte'>-</td>";
	}
	echo "</tr>";
	printf("<tr class='alte'><td class='alte'>%s aprobados</td>",substr($cu,0,1));
	$espAp = $subConj['a'];
	foreach ($tabla_tits AS $e) {
		if (array_key_exists($e,$espAp)) printf("<td class='alte'>%s</td>",$espAp[$e]);
		else echo "<td class='alte'>-</td>";
	}
	echo "</tr>";
}
?>

		</tbody>
	</table>
</div>

<div><pre><?PHP // echo var_export($cantidades,true);?></pre></div>
