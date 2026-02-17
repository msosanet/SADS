<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style2.css" />

<title>Datos de <?=$filatt['apellido']?> <?=$filatt['nombre']?> </title>




</head>
<?
include 'header.php';
?>

<body  >

<div style="max-width:980px;align:center">
<?
if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php'; //preceptor
if ($_SESSION['valor']==4) include 'menuppal4.php'; // ++++++++++++++ E.O.E. +++++++++++++++++++
if ($_SESSION['valor']==5) include 'menuppal5.php';
?>
</div>
<br><br>
<div style="max-width: 980px">
<table border="0" width="900" bordercolor="#dddddd" cellspacing="0">
   <tr>
       <td colspan="7" align="center" class="text1b" bgcolor="#BB6666">LEGAJO DEL ALUMNO</td>
   </tr>
<tr>
<td>
 <table border="0" width="895" id="table1" cellpadding="2" cellspacing="4">
 <tr>
	<td width="174" bgcolor="#EAEAEA" align="right">D.N.I.:</td>
	<td bgcolor="#EAEAEA" width="268" align="left"><?echo $filatt['dni']; ?>	</td>
	<td width="190" bgcolor="#EAEAEA" align="right">Sexo:</td>
	<td width="190" bgcolor="#EAEAEA" align="left">
	<select name="sexo" disabled >
	 <? if ($filatt['sexo']=='') {$selec = 'Seleccione el Sexo'; } else {$selec = '';}?>

		<option value="<?echo $filatt['sexo'];?>"><?echo $filatt['sexo']; echo $selec;?></option>
		<option value="M">M</option>
		<option value="F">F</option>

	</select>
	</td>
 </tr>
 <tr>
	<td width="74" bgcolor="#cccccc" align="right">Apellido:</td>
	<td bgcolor="#cccccc" width="425" align="left">
	<input type="text" name="apellido" size="40" maxlength="40" value="<? echo $filatt['apellido']; ?>" disabled >
	</td>
	<td width="74" bgcolor="#EAEAEA" align="right">Nombre:</td>
	<td bgcolor="#EAEAEA" width="425" align="left">
	<input type="text" name="nombre" size="40" maxlength="40" value="<?echo $filatt['nombre']; ?>" disabled />
	</td>
 </tr>
 <tr>
	<td width="190" bgcolor="#EAEAEA" align="right">Direccion:</td>
	<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="direccion" size="30" maxlength="30" value="<?echo $filatt['domicilio'];?>" disabled /></td>
	<td width="190" bgcolor="#EAEAEA" align="right">Fecha de Nac.:</td>
	<td bgcolor="#EAEAEA" width="265" align="left"><input type="date" name="f_nac" size="10" maxlength="10" value="<?echo $filatt['f_nac'];?>" disabled /></td>
 </tr>
 <tr>
	<td width="190" bgcolor="#EAEAEA" align="right">Ciudad:</td>
	<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="ciudad" size="30" maxlength="30" value="<?echo $filatt['ciudad'];?>"disabled /></td>
	<td width="190" bgcolor="#EAEAEA" align="right">Provincia:</td>
	<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="provincia" size="20" maxlength="20" value="<?echo $filatt['provincia'];?>" disabled /></td>
 </tr>
 <tr>
	<td width="190" bgcolor="#EAEAEA" align="right">Pais:</td>
	<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="pais" size="30" maxlength="30" value="<?echo $filatt['pais'];?>" disabled /></td>
	<td width="190" bgcolor="#EAEAEA" align="right">E-mail:</td>
	<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="mail" size="50" maxlength="50" value="<?echo $filatt['mail'];?>" disabled /></td>
 </tr>
 <tr>
	<td width="190" bgcolor="#EAEAEA" align="right">Tel&eacute;fono:</td>
	<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="tel" size="30" maxlength="30" value="<?echo $filatt['tel'];?>" disabled /></td>
	<td width="190" bgcolor="#EAEAEA" align="right">Intertribus:</td>
	<td width="190" bgcolor="#EAEAEA" align="left">
		<select name="tribu" disabled >
		 <? if ($filatt['sexo']=='') {$selec = 'Seleccione la tribu'; } else {$selec = '';}?>

			<option value="<?echo $filatt['tribu'];?>"><?echo $filatt['tribu']; echo $selec;?></option>
			<option value="-">-</option>
			<option value="Yamana">Yamana</option>
			<option value="Ona">Ona</option>

		</select>
	</td>
 </tr>
 <tr>
	<td width="190" bgcolor="#EAEAEA" align="right">Fecha de Ingreso:</td>
	<td bgcolor="#EAEAEA" width="265" align="left"><input type="date" name="f_ingreso" size="10" maxlength="10" value="<?echo $filatt['f_ingreso'];?>" disabled /></td>
	<td width="190" bgcolor="#EAEAEA" align="right">Edad al 30/06/<? echo $anio; ?></td>
	<td bgcolor="#EAEAEA" width="265" align="left"><H2><? echo busca_edad($filatt['f_nac']);?></H2></td>
 </tr>
 <tr>
	<td width="190" bgcolor="#EAEAEA" align="right">Libro:</td>
	<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="libro" size="4" maxlength="4" value="<?echo $filacc['libro'];?>" disabled /></td>
	<td width="190" bgcolor="#EAEAEA" align="right">Folio:</td>
	<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="folio" size="4" maxlength="4" value="<?echo $filacc['folio'];?>" disabled  /></td>
 </tr>
 <tr>
	<td width="834" bgcolor="#EAEAEA" align="left" colspan="4"><p align="center"><a href="vercalifalumno.php?dni=<?=$filatt['dni']?>&imprime=1" target="_blank">Imprimir Informe académico</a></p></td>
 </tr>
 </table>
</td>
</tr>
</table>

<?
//---------------------------------------------------------------------------------------
$cur = mysql_query ("SELECT * FROM cursa WHERE alumno = $actor ORDER BY anio DESC");

$previ = mysql_query ( "SELECT * FROM previas LEFT JOIN materias2023 ON previas.idmateria = materias2023.idmateria WHERE alumno = $actor ORDER BY previas.curso DESC,materia" );

?>
</div>

<div style="width: 900px; background-color: #ddcccc;margin: 15px 10px">

<table border="0" width="900" bordercolor="#dddddd" cellspacing="0">
   <tr>
       <td class="text1b" style="text-align: center" bgcolor="#BB6666">INFORMACION DE PREVIAS</td>
   </tr>
   <tr>
	<td style="text-align: center">
		<table style="width: 500px; background-color: #ddcccc; border:1; margin: 5px auto">

			<tr bgcolor="#dddddd">
				<td align="center"><b>MATERIA</b></td>
				<td align="center"><b>NOTA</b></td>
				<td align="center"><b>FECHA</b></td>
				<td align="center"><b>FOLIO</b></td>
				<td align="center"><b>OBSERVACIONES</b></td>
			</tr>

<? while ($prev = mysql_fetch_array($previ))
	{
		if ($prev['fecha'] == "0000-00-00" OR $prev['fecha'] == 0 OR $prev['observacion'] == "ADEUDA")	$f_examen = "-";
		else $f_examen = date("d-m-Y",strtotime($prev['fecha']));
		if ($prev['curso']==0) $prev_anio ="";
		elseif ($prev['curso']==14) $prev_anio ="A. A.";
		else $prev_anio = " " . $prev['curso'];
		if ($prev['movilidad']) $desc_mat = ucwords(strtolower($prev['descripcion'])) . $prev_anio . " (M E.)";
		else $desc_mat = ucwords(strtolower($prev['descripcion'])) . " " . $prev_anio . "°";

?>
			<tr>
			<td align='center' style='background: white'> <?=$desc_mat?></td>
			<td align='center' style='background: white'> <? echo $prev['nota']; ?></td>
			<td align='center' style='background: white'> <?=$f_examen ?></td>
			<td align='center' style='background: white'> <? echo $prev['folio']; ?></td>
			<td align='center' style='background: white'> <? echo $prev['observacion']; ?></td>


			</tr>
<?
}
?>
		</table>

	  </td>
   </tr>
</table>
</div>

<?PHP //--------------------------------------------------------------------------------------- ?>

<div style="width: 900px; background-color: #ddcccc;margin: 15px 10px">

<table border="0" width="900" bordercolor="#dddddd" cellspacing="0">

   <tr>

       <td align="center" class="text1b" bgcolor="#BB6666">INFORMACION DE CURSADA</span></td>
   </tr>
   <tr>
        <td>
			<table style="width: 700px; background-color: #ddcccc; border:1; margin: 5px auto">

                <tr bgcolor="#dddddd">
                    <td align="center"><b>CURSO</b></td>
                    <td align="center"><b>DIVI</b></td>
                    <td align="center"><b>CICLO LECTIVO</b></td>
                    <td align="center"><b>PASE</b></td>
                    <td align="center"><b>ACTUAL</b></td>
                    <td align="center"><b>FECHA MOV.</b></td>
                   <td align="center"><b>MODALIDAD</b></td>
                </tr>

<? while ($cursa = mysql_fetch_array($cur))
	{


$plaan = mysql_query ("SELECT * FROM plan WHERE id = $cursa[modalidad]");
$plan = mysql_fetch_array($plaan);


$fechapase="";
if ($cursa['pase']!='0000-00-00' && $cursa['pase']!='' ) $fechapase=date('d-m-Y',strtotime($cursa['pase']));
else $fechapase = "-";
?>
                <tr>
      			<td align='center' style='background: white'> <? echo $cursa['curso']; ?>º</td>
      			<td align='center' style='background: white'> <? echo $cursa['divi']; ?>º</td>
      			<td align='center' style='background: white'> <? echo $cursa['anio']; ?></td>
      			<td align='center' style='background: white'> <? echo $fechapase; ?></td>
      			<td align='center' style='background: white'> <? if ($cursa['control']==1) echo "SI";
			else echo "NO" ?></td>
      			<td align='center' style='background: white'> <? echo date('d-m-Y',strtotime($cursa['fecha'])); ?></td>
      			<td align='center' style='background: white'> <? echo $plan['descripcion']; ?></td>


                </tr>
<?
}
?>
            </table>
		</td>
	</tr>
	<tr><td style="align:center">
		<table><tr>
		 <td colspan="2"><b>Datos de procedencia:</b></td>
		 <td style="text-align:right">Localidad:</td>
		 <td style="text-align:left"><?=$filatt['localidad_esc']?></td>
		</tr>
		<tr>
		 <td style="text-align:right">Escuela:</td>
		 <td style="text-align:left"><?=$filatt['escuela']?></td>
		 <td style="text-align:right">Grado/Año:</td>
		 <td style="text-align:left"><?=$filatt['grado']?></td>
		</tr></table>
	</td>
	</tr>
</table>
</div>

<?PHP
$q_habilitado = "SELECT * FROM `comedor_habilitados` WHERE `dni_alumno` = $actor ORDER BY fecha DESC LIMIT 1";
$_habilitado = mysql_query($q_habilitado);
$statusHab = mysql_fetch_assoc($_habilitado);
$habilitado = (isset($statusHab['habilitado'])) ? $statusHab['habilitado'] : 0;
$statusText = $habilitado ? "Estudiante habilitado/a para ingresar al comedor desde: " : "Estudiante no habilitado/a para ingresar al comedor desde: ";
$fecha = (isset($statusHab['fecha'])) ? date("d-m-Y", strtotime($statusHab['fecha'])) : "Nunca";
$statusText .= $fecha;

$q_meses = "SELECT DAY(fecha) dia, MONTH(fecha) mes FROM `comedor_asistencia` asicom WHERE `dni_alumno` = $actor AND fecha NOT IN (SELECT fecha FROM comedor_asistencia WHERE dni_alumno = asicom.dni_alumno AND permitido = 0) AND fecha >= (CONCAT(YEAR(CURRENT_DATE),'-',MONTH(DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH)),'-',1))";
$_meses = mysql_query($q_meses);
$_comio = [];
while ($_dm = mysql_fetch_assoc($_meses)) $_comio[$_dm['mes']][] = $_dm['dia'];

printf("<!-- %s -->",var_export($_comio,true));

//Definimos la hora actual por Continente/Ciudad
date_default_timezone_set("America/Buenos Aires");
# definimos los valores iniciales para nuestro calendario
$month=date("n");
$pmonth=date("n",strtotime("-1 month"));
$year=date("Y");
$pyear=date("Y",strtotime("-1 month"));
$diaActual=date("j");

# Obtenemos el dia de la semana del primer dia
# Devuelve 0 para domingo, 6 para sabado
$diaSemana=date("w",mktime(0,0,0,$month,1,$year))+7;
$pdiaSemana=date("w",mktime(0,0,0,$pmonth,1,$pyear))+7;
# Obtenemos el ultimo dia del mes
$ultimoDiaMes=date("d",(mktime(0,0,0,$month+1,1,$year)-1));
$pultimoDiaMes=date("d",(mktime(0,0,0,$pmonth+1,1,$pyear)-1));

$meses=array(1=>"Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
"Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

?>

<div style="width: 900px; background-color: #ffffff;margin: 15px 10px;">
<table border="0" width="600" bordercolor="#dddddd" cellspacing="0">


   <tr>

       <td  colspan=2 align="center" class="text1b" bgcolor="#BB6666">INGRESO A COMEDOR</td>
   </tr>
   <tr>
   <td  colspan=2><?=$statusText?></td>
   </tr>

	<tr ><td>
		<table id="calendar" style="margin: 0px auto">
		<caption><?php echo $meses[$pmonth]." ".$pyear?></caption>
		<tr>
		<th>Lun</th><th>Mar</th><th>Mie</th><th>Jue</th>
		<th>Vie</th><th>Sab</th><th>Dom</th>
		</tr>
		<tr bgcolor="silver" style="display: none">
		<?php
		$last_cell=$pdiaSemana+$pultimoDiaMes;
		// hacemos un bucle hasta 42, que es el máximo de valores que puede
		// haber... 6 columnas de 7 dias
		for($i=1;$i<=42;$i++)
		{
			if($i==$pdiaSemana)
				{
				// determinamos en que dia empieza
				$day=1;
				}
			if($i<$pdiaSemana || $i>=$last_cell)
			{
				// celca vacia
				echo "<td> </td>";
			}else{
				// mostramos el dia
				if (in_array($day,$_comio[$pmonth]))
				echo "<td style='font-weight: bold;background-color: PaleTurquoise;text-align: center' title='Ingres&oacute; al comedor'>$day</td>";
				else
				echo "<td style='text-align: center' title='Sin registros'>$day</td>";
				$day++;
			}
			// cuando llega al final de la semana, iniciamos una columna nueva
			if($i%7==0)
			{
				echo "</tr><tr>\n";
			}
		}
		?>
		</tr>
		</table>
	</td>
	<td>
		<table id="calendar" style="margin: 0px auto">
		<caption><?php echo $meses[$month]." ".$year?></caption>
		<tr>
		<th>Lun</th><th>Mar</th><th>Mie</th><th>Jue</th>
		<th>Vie</th><th>Sab</th><th>Dom</th>
		</tr>
		<tr bgcolor="silver" style="display: none">
		<?php
		$last_cell=$diaSemana+$ultimoDiaMes;
		// hacemos un bucle hasta 42, que es el máximo de valores que puede
		// haber... 6 columnas de 7 dias
		for($i=1;$i<=42;$i++)
		{
		if($i==$diaSemana)
		{
		// determinamos en que dia empieza
		$day=1;
		}
		if($i<$diaSemana || $i>=$last_cell)
		{
		// celca vacia
		echo "<td> </td>";
		}else{
		// mostramos el dia
		if (in_array($day,$_comio[$month]))
		echo "<td style='font-weight: bold;background-color: PaleTurquoise;text-align: center' title='Ingres&oacute; al comedor'>$day</td>";
		else
		echo "<td style='text-align: center' title='Sin registros'>$day</td>";
		$day++;
		}
		// cuando llega al final de la semana, iniciamos una columna nueva
		if($i%7==0)
		{
		echo "</tr><tr>\n";
		}
		}
		?>
		</tr>
		</table>
	</td></tr>
</table>

</div>

<?
//----------------------------------------------------------------------------------------------------

$family = mysql_query ("SELECT * FROM familiares, alu_fami WHERE alu_fami.alumno = $actor and alu_fami.familiar=familiares.dni ORDER BY alu_fami.tipo");

?>

<div style="width: 900px; background-color: #ddcccc;margin: 15px 10px">

<table border="0" width="900" bordercolor="#dddddd" cellspacing="0">
 <tr>
   <td  class="text1b" style="text-align: center" bgcolor="#BB6666">INFORMACION DE LOS FAMILIARES</td>
 </tr>
 <tr>
	<table class="table1" style="background-color: #ddcccc; border:1; margin: 5px auto">
		<tr bgcolor="#dddddd">
			<td align="center"><b>TIPO</b></td>
			<td align="center"><b>DNI</b></td>
			<td align="center"><b>NOMBRE</b></td>
			<td align="center"><b>DIRECCION</b></td>
			<td align="center"><b>TEL PER.</b></td>
			<td align="center"><b>LUGAR TRABAJO</b></td>
			<td align="center"><b>TEL LAB</b></td>
			<td align="center"><b>MAIL</b></td>
		</tr>

<? while ($fami = mysql_fetch_array($family))
	{
	if ($fami['tipo']=='P') $fam="PADRE";
	if ($fami['tipo']=='M') $fam="MADRE";
	if ($fami['tipo']=='T') $fam="TUTOR";


?>
                <tr>
      			<td align='center' style='background: white'> <? echo $fam; ?></td>
      			<td align='center' style='background: white'> <? echo $fami['dni']; ?></td>
      			<td align='center' style='background: white'> <? echo $fami['apellido']; ?>, <? echo $fami['nombre']; ?></td>
      			<td align='center' style='background: white'> <? echo $fami['domicilio']; ?></td>
      			<td align='center' style='background: white'> <? echo $fami['tel']; ?></td>
      			<td align='center' style='background: white'> <? echo $fami['trabajo']; ?></td>
      			<td align='center' style='background: white'> <? echo $fami['tel_trabajo']; ?></td>
      			<td align='center' style='background: white'> <? echo $fami['email']; ?></td>


                </tr>
<?
}
?>
       </table>
	</tr>
</table>
</div>

<div style="width: 900px; background-color: #ddcccc;margin: 15px 10px">

<?
$nov_alu = mysql_query ("SELECT curso,novedad,fecha,grabo FROM `novedades` WHERE `dni` =$actor");

?>

<table border="0" width="900" bordercolor="#000000" cellspacing="0">
   <tr>
       <td align="center" class="text1b" bgcolor="#bb6666">NOVEDADES DEL ALUMNO</span></td>
   </tr>
   <tr>
        <td>
		<table class = "text1b" style="width: 700px; background-color: #ddcccc; border:1; margin: 5px auto">
                <tr bgcolor="#dddddd">
                    <th width="45px"><b>Curso</b></th>
                    <th width="85px"><b>Fecha</b></th>
                    <th><b>Novedad</b></th>
                    <th width="105px"><b>Notificó</b></th>
                </tr>

<? while ($novedad = mysql_fetch_assoc($nov_alu))
	{
		if ($novedad['fecha']!="0000-00-00") $f_visible = date("d-m-Y",strtotime($novedad['fecha']));
		else $f_visible="-";

?>
                <tr>
      			<td align='center' style='background: white'> <? echo $novedad['curso']; ?></td>
      			<td align='center' style='background: white'> <? echo $f_visible; ?></td>
      			<td align='center' style='background: white'> <? echo $novedad['novedad']; ?></td>
      			<td align='center' style='background: white'> <? echo $novedad['grabo']; ?></td>


                </tr>
<?
}
?>
        </table>
		</td>
    </tr>
</table>

</div>

<div style="width: 900px; background-color: #ddcccc;margin: 15px 10px"> <!-- Documentación -->

<?
$resultmotivo = mysql_query ("SELECT * FROM documentacion order by id");
?>

<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">
		<tr>
			<td colspan="4" height="40" align="center" class="text1b" bgcolor="#bbCbbb">DOCUMENTACION DEL ALUMNO </td>
		</tr>

	<?	WHILE ($ff = mysql_fetch_array($resultmotivo)) {

		$check="";
		$color="#BB6666";


		$docu = mysql_query ("SELECT * FROM docu_alu where alumno=$actor and id=$ff[id]");
		$consulta = mysql_num_rows($docu);
		$docum = mysql_fetch_array($docu);
		if ($consulta >=1) {
					$check="checked";

					if ($docum['descripcion'	]!="") $color="#000000";
					$descrip=$docum['descripcion'];
$color="#000000";

				   }
		else $descrip="";
		?>

		<tr>

		  <td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>"><? echo $ff['nombre'];?>:</td>
		  <td bgcolor="#EAEAEA" width="268" align="left"><?echo $descrip; ?>

		</td>





		</tr>
<? }
mysql_free_result($resultmotivo);
 ?>
	</table>
</div> <!-- Fin documentación -->

<br>

			<?
			include 'footer.php';
			?>

			</td>
		</tr>
	</table>
</div>




<?PHP /* <input type="hidden" name="actor" value="<?echo $actor;">
</form> */ ?>
 </td>


</body>
<?
}
else
{



}

?>
</html>
<? } ?>

