<?PHP
// Devuelve "alumnos de 6to año.xls" con tabla de alumnos de todos los 6tos que adeudan
// documentacion: DNI, partida de nacimiento, Certificado de Finalizaciòn estudios Primarios
// o Analítico parcial (También usado para primer año con otra doocumentación)

session_start();
include 'conexion.php';

$ext=".xls";
$nombre="alumnos de 1ro año".$ext;
$anio=date("Y");

// Establece el formato del documento como planilla de Excel
header("Content-type: application/vnd.ms-excel" ) ;
header("Content-Disposition: attachment; filename=$nombre" );

// Conecta a la BD
$conexion = conectar ();

// Establece quién obtuvo el listado
$usuario = $_SESSION['usuario'];
$result = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario'");
$fila = mysql_fetch_array($result) ;

echo "<table>"; //Linea de aclaración de fecha y usuario que obtiene el listado
	echo "<tr>";
		echo"<td align='left' bgcolor='#C0C0C0'><b>Listado obtenido el " . date("j/n/Y") . " por " . $fila[nombre] . " " . $fila[apellido] . "</b></td>";
	echo "</tr>";
echo"</table>";

echo "<table>";
	echo "<tr>";
		// Encabezado de la tabla
		echo"<td align='center' bgcolor='#C0C0C0'>DNI</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>APELLIDO</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>NOMBRE</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>CURSO</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>DIV</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>Adeuda DNI</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>Adeuda DNI Padre</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>Adeuda DNI Madre</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>Adeuda DNI Tutor</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>Adeuda P. Nacim.</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>Adeuda CFP</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>Adeuda C salud</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>Adeuda C Bucod</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>Adeuda C Vacunas</td>";
	echo "</tr>";


// Consulta a la BD
    $result = mysql_query ("SELECT alumno.dni,alumno.apellido, alumno.nombre, cursa.curso, cursa.divi, alumno.f_ingreso FROM alumno,cursa WHERE cursa.alumno=alumno.dni AND cursa.curso='1' AND cursa.divi='-' and cursa.control=1 ORDER BY alumno.apellido,alumno.nombre");
// Volcado de datos de la consulta en la tabla 
	while ($fila2 = mysql_fetch_array($result)) {
		echo"<tr>";
		echo"<td align='center'>$fila2[dni]</td>";
		echo"<td align='left'>$fila2[apellido]</td>";
		echo"<td align='left'>$fila2[nombre]</td>";
		echo"<td align='center'>$fila2[curso]</td>";
		echo"<td align='center'>$fila2[divi]</td>";


		$ade_dni=mysql_query("SELECT * FROM docu_alu WHERE alumno=$fila2[dni] AND id=3"); //consulta por DNI
		if (mysql_num_rows($ade_dni)){

			echo"<td align='center'>No</td>";}
		else {
			echo"<td align='center' bgcolor='#ddcccc'>Si</td>";}
		
		$ade_part=mysql_query("SELECT * FROM docu_alu WHERE alumno=$fila2[dni] AND id=5"); //consulta por Partida
		if (mysql_num_rows($ade_part)){

			echo"<td align='center'>No</td>";}
		else {
			echo"<td align='center' bgcolor='#ddcccc'>Si</td>";}
		
		$ade_cfp=mysql_query("SELECT * FROM docu_alu WHERE alumno=$fila2[dni] AND id=6"); //consulta por Certificado primaria
		if (mysql_num_rows($ade_cfp)){

			echo"<td align='center'>No</td>";}
		else {
			echo"<td align='center' bgcolor='#ddcccc'>Si</td>";}
		
		$ade_part1=mysql_query("SELECT * FROM docu_alu WHERE alumno=$fila2[dni] AND id=5"); //consulta por Partida
		if (mysql_num_rows($ade_part1)){

			echo"<td align='center'>No</td>";}
		else {
			echo"<td align='center' bgcolor='#ddcccc'>Si</td>";}

		$ade_part2=mysql_query("SELECT * FROM docu_alu WHERE alumno=$fila2[dni] AND id=5"); //consulta por Partida
		if (mysql_num_rows($ade_part2)){

			echo"<td align='center'>No</td>";}
		else {
			echo"<td align='center' bgcolor='#ddcccc'>Si</td>";}


		
		$ade_ap=mysql_query("SELECT * FROM docu_alu WHERE alumno=$fila2[dni] AND id=11"); //consulta Analítico
		if (mysql_num_rows($ade_ap)){

			echo"<td align='center'>No</td>";}
		else {
			echo"<td align='center' bgcolor='#ddcccc'>Si</td>";}
		$ade_part3=mysql_query("SELECT * FROM docu_alu WHERE alumno=$fila2[dni] AND id=15"); //consulta por Partida
		if (mysql_num_rows($ade_part3)){

			echo"<td align='center'>No</td>";}
		else {
			echo"<td align='center' bgcolor='#ddcccc'>Si</td>";}
		$ade_part4=mysql_query("SELECT * FROM docu_alu WHERE alumno=$fila2[dni] AND id=16"); //consulta por Partida
		if (mysql_num_rows($ade_part4)){

			echo"<td align='center'>No</td>";}
		else {
			echo"<td align='center' bgcolor='#ddcccc'>Si</td>";}
$ade_part5=mysql_query("SELECT * FROM docu_alu WHERE alumno=$fila2[dni] AND id=17"); //consulta por Partida
		if (mysql_num_rows($ade_part5)){

			echo"<td align='center'>No</td>";}
		else {
			echo"<td align='center' bgcolor='#ddcccc'>Si</td>";}



		
		} 
		
echo"</table>";


?>