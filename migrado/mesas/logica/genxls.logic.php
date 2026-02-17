<?PHP
session_start();
// Enviamos los encabezados de hoja de calculo 
$ext=".xls";
$nombre="cv".$ext;
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$nombre"); 
include 'conexion.php';
$conexion = conectar ();


echo "<table>";
	echo "<tr>";
		echo"<td align='center' bgcolor='#C0C0C0'>Campaña</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>Fecha de Carga</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>Apellido y Nombre</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>F. Nac.</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>Provincia</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>E-Mail</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>Tel.</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>Puesto</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>Profesion</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>Tit. Residencia</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>Esp. Inst. Resid.</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>Tit. Especialista?</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>Esp. Inst Certificante</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>Como Conocio?</td>";
		echo"<td align='center' bgcolor='#C0C0C0'>C.V.</td>";
	echo"</tr>";

for($i=0;$i<count($_SESSION['array']);$i++)
   {
    $variable=$_SESSION['array'][$i];

    $result = mysql_query ("SELECT * FROM m_salud_cformsdata WHERE field_name='Puesto de trabajo para el que se postula:' and sub_id=$variable");
	$fila2 = mysql_fetch_array($result);
    
			$result2 = mysql_query ("SELECT * FROM m_salud_cformsdata WHERE field_name='Campania' and sub_id=$fila2[sub_id]");
			$fila3 = mysql_fetch_array($result2);
			$result3 = mysql_query ("SELECT * FROM m_salud_cformsdata WHERE field_name='Fecha de carga' and sub_id=$fila2[sub_id]");
			$fila4 = mysql_fetch_array($result3);
			$result4 = mysql_query ("SELECT * FROM m_salud_cformsdata WHERE field_name='Ingrese su Apellido y Nombre Completo' and sub_id=$fila2[sub_id]");
			$fila5 = mysql_fetch_array($result4);
			$result5 = mysql_query ("SELECT * FROM m_salud_cformsdata WHERE field_name='Ingrese su Fecha de Nacimiento' and sub_id=$fila2[sub_id]");
			$fila6 = mysql_fetch_array($result5);
			$result6 = mysql_query ("SELECT * FROM m_salud_cformsdata WHERE field_name='Provincia donde Reside' and sub_id=$fila2[sub_id]");
			$fila7 = mysql_fetch_array($result6);
			$result7 = mysql_query ("SELECT * FROM m_salud_cformsdata WHERE field_name='Ingrese su E-mail' and sub_id=$fila2[sub_id]");
			$fila8 = mysql_fetch_array($result7);
			$result8 = mysql_query ("SELECT * FROM m_salud_cformsdata WHERE field_name='Ingrese su TelÃ©fono de Contacto' and sub_id=$fila2[sub_id]");
			$fila9 = mysql_fetch_array($result8);
			$result9 = mysql_query ("SELECT * FROM m_salud_cformsdata WHERE field_name='Puesto de trabajo para el que se postula:' and sub_id=$fila2[sub_id]");
			$fila10 = mysql_fetch_array($result9);
			$result10 = mysql_query ("SELECT * FROM m_salud_cformsdata WHERE field_name='ProfesiÃ³n' and sub_id=$fila2[sub_id]");
			$fila11 = mysql_fetch_array($result10);
			$result11 = mysql_query ("SELECT * FROM m_salud_cformsdata WHERE field_name='Tiene Residencia Completa?' and sub_id=$fila2[sub_id]");
			$fila12 = mysql_fetch_array($result11);
			$result12 = mysql_query ("SELECT * FROM m_salud_cformsdata WHERE field_name='Especialidad e IntituciÃ³n donde realizÃ³ la residencia' and sub_id=$fila2[sub_id]");
			$fila13 = mysql_fetch_array($result12);
			$result13 = mysql_query ("SELECT * FROM m_salud_cformsdata WHERE field_name='Tiene TÃ­tulo de Especialista?' and sub_id=$fila2[sub_id]");
			$fila14 = mysql_fetch_array($result13);
			$result14 = mysql_query ("SELECT * FROM m_salud_cformsdata WHERE field_name='Especialidad Certificada e InstituciÃ³n Certificante' and sub_id=$fila2[sub_id]");
			$fila15 = mysql_fetch_array($result14);
			$result15 = mysql_query ("SELECT * FROM m_salud_cformsdata WHERE field_name='CÃ³mo conociÃ³ esta convocatoria?' and sub_id=$fila2[sub_id]");
			$fila16 = mysql_fetch_array($result15);
			$result16 = mysql_query ("SELECT * FROM m_salud_cformsdata WHERE field_name='Seleccione su C.V.[*3]' and sub_id=$fila2[sub_id]");
			$fila17 = mysql_fetch_array($result16);



			$ext=$fila2[sub_id]."-";
			$adjunto="http://ministeriosalud.tierradelfuego.gov.ar/webapps/cv/".$ext.$fila17[field_val];
			$apeynom1=strtolower($fila5[field_val]); 
			$apeynom=utf8_decode(ucwords($apeynom1));
			$prov=utf8_decode(ucwords(strtolower($fila7[field_val])));
			$residencia1=utf8_decode(ucwords(strtolower($fila12[field_val])));
			$residencia2=utf8_decode(ucwords(strtolower($fila14[field_val])));
			$tres=utf8_decode($fila3[field_val]);
			$cuatro=utf8_decode($fila4[field_val]);
			$seis=utf8_decode($fila6[field_val]);
			$ocho=utf8_decode($fila8[field_val]);
			$nueve=utf8_decode($fila9[field_val]);
			$diez=utf8_decode($fila10[field_val]);
			$once=utf8_decode($fila11[field_val]);
			$trece=utf8_decode($fila3[field_val]);
			$quince=utf8_decode($fila15[field_val]);
			$dyseis=utf8_decode($fila16[field_val]);




	echo"<tr>";
		echo"<td align='center'>$tres</td>";
		echo"<td align='center'>$cuatro</td>";
		echo"<td align='center'>$apeynom</td>";
		echo"<td align='center'>$seis</td>";
		echo"<td align='center'>$prov</td>";
		echo"<td align='center'>$ocho</td>";
		echo"<td align='center'>$nueve</td>";
		echo"<td align='center'>$diez</td>";
		echo"<td align='center'>$once</td>";
		echo"<td align='center'>$residencia1</td>";
		echo"<td align='center'>$trece</td>";
		echo"<td align='center'>$residencia2</td>";
		echo"<td align='center'>$quince</td>";
		echo"<td align='center'>$dyseis</td>";
		echo"<td align='center'><a href='$adjunto' target='_blank'>Descargar CV</a></td>";
	echo"</tr>";
		}
echo"</table>";

unset($_SESSION['array']);			
  

?>


