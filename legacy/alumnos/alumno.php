<?PHP
session_start();
if ($_SESSION['estado']==1) {

include 'conexion.php';
include 'header.php';
$conexion = conectar ();
$actor=$_GET["dni"];


$resultt = mysql_query ("SELECT * FROM alumno WHERE dni = $actor");
$filatt = mysql_fetch_array($resultt);

$q_titulacion = mysql_query ("SELECT * FROM `titulo` WHERE `alumno` = '$actor'");
$titulacion = mysql_fetch_assoc($q_titulacion);

$apeNom = $filatt['apellido'] . " ". $filatt['nombre'];
$cuilpre = substr($filatt['cuil'],0,2);
$cuildni = substr($filatt['cuil'],2,-1);
$cuilsuf = substr($filatt['cuil'],-1,1);

$resulcc = mysql_query ("SELECT * FROM folio WHERE dni = $actor");


?>
<!DOCTYPE html >
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style2.css" />

<title><?=$apeNom?> - Información del estudiante</title>

<style type="text/css">
	/* Chrome, Safari, Edge, Opera */
	input::-webkit-outer-spin-button,
	input::-webkit-inner-spin-button {
	  -webkit-appearance: none;
	  margin: 0;
	}

	/* Firefox */
	input[type=number] {
	  -moz-appearance: textfield;
	}
</style>

</head>
<?

$anio=date("Y");
$color='';
$hayerrores = 0;
$flag = 0;

 if (isset($_GET["submitx"])) {
     // verifico los errores en los campos




}
 else
  {
    $flag = 1;
  }

if ($hayerrores OR $flag) {
	if ($filatt['sitEsp']) {
		$atn_color = "background-color: red";
		$titulo_tabla = "Datos personales <a href=# title='Click para más detalles' style='color: white'>(ATENCION: No brindar datos del/la estudiante)</a>";
	}
	else {
		$atn_color = "background-color:#ffffff";
		$titulo_tabla = "Datos personales";
	}

?>

<body>
<form method="GET" action="<?=$_SERVER['PHP_SELF']?>">
<div style="align:center;max-width: 980px">
<?
if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php'; //preceptor
?>
</div>
<table>
	<tr><th>
	</th></tr>
	<tr>
	<td><BR><p align="left" class="text1b">LEGAJO DEL ALUMNO: <a href="#previas">previas</a> <a href="#cursada">cursada</a> <a href="#familiares">familiares</a> <a href="#novedades">novedades</a> <a href="#documentacion">documentación</a></p><BR>
	<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, están marcado con color ROJO</font></h4>";} ?>
	</p>

<div align="center">
	<table border="0" width="895" id="table1" cellpadding="2" cellspacing="4">

<? // Datos del alumno?>

		<tr><td colspan=4  class="text1b" style="text-align:center; <?=$atn_color?>; border:1px solid lightgray;" ><?=$titulo_tabla?></td>
		</tr>
		<tr>
			<td width="174" bgcolor="#EAEAEA" align="right" >D.N.I.:</td>
			<td bgcolor="#EAEAEA" width="268" align="left"><input type="number" id="nroDNI" name="desechado" style="width: 6em;" value="<?=$filatt['dni']?>" disabled> - C.U.I.L.
							<input type="number" name="cuilpre" style="width: 1.5em;" max=50 value="<?=$cuilpre?>"  >-<input type="number" id="cuildni" name="cuildni" style="width: 6em;" max="120000000" value="<?=$cuildni?>" >-<input type="number" name="cuilsuf" style="width: 1em;" max=9 value="<?=$cuilsuf?>" ><button type="button" id="copiaDni" title="Completa con el número del DNI">Rellenar</button> </td>

			<td width="190" bgcolor="#EAEAEA" align="right">Sexo:</td>
			<td width="190" bgcolor="#EAEAEA" align="left">
			<select name="sexo">
			 <? if ($filatt['sexo']=='') echo '<option value="" selected>Seleccione el Sexo</option>'; ?>
				<option value="M" <? if ($filatt['sexo']=='M') echo "selected";?>>M</option>
				<option value="F" <? if ($filatt['sexo']=='F') echo "selected";?>>F</option>
				<option value="X" <? if ($filatt['sexo']=='X') echo "selected";?>>X</option>
				<?

				?>

			</select>
			</td>

		</tr>
		<tr>
			<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Apellido:</font></td>
			<td bgcolor="#EAEAEA" width="425" align="left">

			<input type="text" name="apellido" size="40" maxlength="40" value="<?=$filatt['apellido']?>"  autofocus>
			</td>
			<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Nombre:</font></td>

			<td bgcolor="#EAEAEA" width="425" align="left">

			<input type="text" name="nombre" size="40" maxlength="40" value="<?=$filatt['nombre']?>" />
			</td>

		</tr>
		<tr>


			<td width="190" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">
			Direccion:</font></td>
			<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="direccion" size="30" maxlength="30" value="<?echo $filatt['domicilio'];?>" /></td>






			<td width="190" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">

			Fecha de Nac.:</td></font>

			<td bgcolor="#EAEAEA" width="265" align="left"><input type="date" name="f_nac" size="10" maxlength="10" value="<?echo $filatt['f_nac'];?>" /></td>

		</tr>
		<tr>

			<td width="190" bgcolor="#EAEAEA" align="right">
			Ciudad:</td>
			<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="ciudad" size="30" maxlength="30" value="<?echo $filatt['ciudad'];?>" /></td>

			<td width="190" bgcolor="#EAEAEA" align="right">
			Provincia:</td>
			<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="provincia" size="20" maxlength="20" value="<?echo $filatt['provincia'];?>" /></td>
		</tr>
		<tr>
			<td width="190" bgcolor="#EAEAEA" align="right">
			Pais:</td>
			<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="pais" size="30" maxlength="30" value="<?echo $filatt['pais'];?>" /></td>




			<td width="190" bgcolor="#EAEAEA" align="right">
			E-mail:</td>
			<td bgcolor="#EAEAEA" width="265" align="left"><input type="email" name="mail" size="50" maxlength="50" value="<?echo $filatt['mail'];?>" /></td>
		</tr>

		<tr>
		<?
		$errortelefono=0;
		if ($errortelefono==1) {$color="#FF0000";}
		else{$color="#000000";}
		?>


			<td width="190" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">
			Tel&eacute;fono:</td></font>
			<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="tel" size="30" maxlength="30" value="<?echo $filatt['tel'];?>" /></td>

			<td width="190" bgcolor="#EAEAEA" align="right">Intertribus:
			</td></font>

			<td width="190" bgcolor="#EAEAEA" align="left">
			<select name="tribu">
			 <? if ($filatt['tribu']=='') {$selec = 'Seleccione la tribu'; } else {$selec = '';}?>

				<option value="<?=$filatt['tribu']?>"><?echo $filatt['tribu'] . $selec;?></option>
				<option value="-">-</option>
				<option value="Yamana">Yamana</option>
				<option value="Ona">Ona</option>

			</select>

			</td>


		</tr>
		<tr>


			<td width="190" bgcolor="#EAEAEA" align="right">
			Fecha de Ingreso:</td>
			<td bgcolor="#EAEAEA" width="265" align="left"><input type="date" name="f_ingreso" size="10" maxlength="10" value="<?echo $filatt['f_ingreso'];?>" /></td>

			<td width="190" bgcolor="#EAEAEA" align="right">Edad al 30/06/<? echo $anio; ?>
			</td>
			<td bgcolor="#EAEAEA" width="265" align="left"><H2><? echo busca_edad($filatt['f_nac']);?></H2></td>

		</tr>
	<?PHP	while ($filacc = mysql_fetch_array($resulcc)){
				$libro_sel1 = ($filacc['modalidad'] == 1) ? "selected" : "";
				$libro_sel2 = ($filacc['modalidad'] == 2) ? "selected" : "";
		?><tr>


			<td width="190" bgcolor="#EAEAEA" align="right">
			Libro:</td>
			<td bgcolor="#EAEAEA" width="265" align="left">
				<select name="lib_mod">
					<option value="1" <?=$libro_sel1?>>ESO</option>
					<option value="2" <?=$libro_sel2?>>ETP</option>
				</select> : <input type="number" name="libro" style="text-align: right; width: 2.5em;"  min="1" max=99  step=1 value="<?= $filacc['libro']?>" />
			</td>


			<td width="190" bgcolor="#EAEAEA" align="right">Folio:
			</td>
			<td bgcolor="#EAEAEA" width="265" align="left"><input type="number" name="folio" style="text-align: right; width: 2.5em;" step=1 min="1" max=300 value="<?= $filacc['folio']?>" /></td>

		</tr>
	<?PHP	}
if (!(mysql_num_rows($resulcc))) { //En caso de que no exista en la tabla folio ?>
		<tr>


			<td width="190" bgcolor="#EAEAEA" align="right">
			Libro:</td>
			<td bgcolor="#EAEAEA" width="265" align="left"><select name="lib_mod"><option value="1">ESO</option>
			<option value="2">ETP</option></select><input type="text" name="libro" size="10" maxlength="10" /></td>
			<td width="190" bgcolor="#EAEAEA" align="right">Folio:
			</td>
			<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="folio" size="10" maxlength="10" /></td>

		</tr>



	<?PHP	}?>
		<tr>


			<td width="190" bgcolor="#EAEAEA" align="right">
			Disposicion:</td>
			<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="dispo" size="20" maxlength="20" value="<?echo $filatt['dispo'];?>" /></td>


			<td width="190" bgcolor="#EAEAEA" align="right">Nota Informe:
			</td>
			<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="ninforme" size="20" maxlength="20" value="<?echo $filatt['ninforme'];?>" /></td>

		</tr>

		<tr>


			<td width="190" bgcolor="#EAEAEA" align="right">Archivo:</td>
			<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="archivo" size="20" maxlength="20" value="<?echo $filatt['archivo'];?>" /></td>
			<td width="190" bgcolor="#EAEAEA" align="right"></td>
			<td bgcolor="#EAEAEA" width="265" align="left"></td>

		</tr>

		<tr>
			<td width="834" bgcolor="#EAEAEA" align="left" colspan="4">
			<p align="center"><input type="submit" value="     Actualizar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
		</tr>
		<tr><td colspan="2"><p style="text-align:center"><a href="vercalifalumno.php?dni=<?=$filatt['dni']?>">Calificaciones del/la estudiante</a></p>&nbsp;</td><td colspan="2"></td></tr>
		<tr>
<? // Datos de procedencia?>
		 <td colspan="2" style="font-variant: small-caps;background-color:#EAEAEA;text-align:center">Datos de procedencia:</td>
		 <td style="font-style: italic;text-align:right">Localidad:</td>
		 <td style="text-align:left"><?=$filatt['localidad_esc']?></td>
		 </tr>
		<tr>
		 <td style="font-style: italic;text-align:right">Escuela:</td>
		 <td style="text-align:left"><?=$filatt['escuela']?></td>
		 <td style="font-style: italic;text-align:right">Grado/Año:</td>
		 <td style="text-align:left"><?=$filatt['grado']?></td>
		</tr>
	</table>
	</div>


<? // Datos de titulo
 if ($titulacion) { ?>
	<div ><table id="secundaria">
		<tr>
		<td><b>Datos de titulación</b></td>
		<td>Fecha de egreso: <?PHP if ($titulacion['f_egreso']!="0000-00-00") echo date("d-m-Y",strtotime($titulacion['f_egreso']));?></td>
	<?PHP	if (trim($titulacion['link'])=='') printf("<td>Archivado en: %s</td>",$titulacion['caja']);
			else printf("<td><a href='%s' target='_blank'>Ver t&iacute;tulo digital</a></td>",$titulacion['link']);?>
		<td title="<?=$titulacion['descripcion']?>"><? if ($titulacion['fecha']!="0000-00-00") echo "Retirado el " . date("d-m-Y",strtotime($titulacion['fecha'])) ?></td>
		</tr>
	</table></div>
<?} //fin datos de titulacion ?>

	</td>
</tr>
<tr>
<td>
<br>
<br>


<?

// Información de materias previas
$previ = mysql_query ("SELECT * FROM previas LEFT JOIN materias2023 ON previas.idmateria = materias2023.idmateria WHERE alumno = $actor ORDER BY previas.curso DESC,materia");
// $previ = mysql_query ("SELECT preSinUp.*,up FROM previasConUp RIGHT JOIN (SELECT previas.*,descripcion FROM previas LEFT JOIN materias2023 ON previas.idmateria = materias2023.idmateria WHERE alumno = $actor ORDER BY previas.curso DESC,materia) preSinUp ON previasConUp.alumno = preSinUp.alumno AND previasConUp.idmateria = preSinUp.idmateria AND previasConUp.curso = preSinUp.curso ");
// $previ = mysql_query ("SELECT * FROM previas WHERE alumno = $actor ORDER BY materia,fecha");

?>

<table id="previas" border="0" width="900" style="background-color: #ddcccc"  cellspacing="0">
   <tr>
       <td colspan="7" align="center" class="text1b" bgcolor="#BB6666"><a href="modif_previas2.php?dni=<?=$actor?>" title="Click para modificar" >INFORMACION DE PREVIAS</a></td>
   </tr>
   <tr>
       <td valign="top">


            <table width="500" border="1" cellspacing="0">
                <tr bgcolor="#dddddd">
      <br>
                </tr>

                <tr bgcolor="#dddddd">
                    <td align="center"><b>MATERIA (* = UP 2020-2021)</b></td>
                    <td align="center"><b>NOTA</b></td>
                    <td align="center"><b>FECHA</b></td>
                    <td align="center"><b>FOLIO</b></td>
                    <td align="center"><b>OBSERVACIONES</b></td>
                </tr>

<? while ($prev = mysql_fetch_array($previ))
	{
		if ($prev['fecha'] == "0000-00-00" OR $prev['fecha'] == 0 OR $prev['observacion'] == "ADEUDA")	$f_examen = "-";
		else $f_examen = date("d-m-Y",strtotime($prev['fecha']));

		$_up = ($prev['up']) ? "(*)" : "";
		if ($prev['curso']==0) $prev_anio ="";
		elseif ($prev['curso']==14) $prev_anio ="A. A.";
		else $prev_anio = " " . $prev['curso'];
		if ($prev['movilidad']) $desc_mat = ucwords(strtolower($prev['descripcion'])) . $prev_anio . " (M E.)";
		else $desc_mat = ucwords(strtolower($prev['descripcion'])) . " " . $prev_anio . "°" . $_up;
?>
                <tr>
      			<td align='center' style='background: white'> <? echo $desc_mat; ?></td>
      			<td align='center' style='background: white'> <? echo $prev['nota']; ?></td>
      			<td align='center' style='background: white'> <?=$f_examen?></td>
      			<td align='center' style='background: white'> <? echo $prev['folio']; ?></td>
      			<td align='center' style='background: white'> <? echo $prev['observacion']; ?></td>


                </tr>
<?
	}
mysql_free_result($previ);
$cur = mysql_query ("SELECT * FROM cursa WHERE alumno = $actor ORDER BY fecha DESC, anio DESC");

?>
            </table>
    </td>
    </tr>
</table>
<br>
<br>
<br>

<? // Daros de cursada?>
<table id="cursada" border="0" width="900" style="background-color: #ddcccc"  bordercolor="#dddddd" cellspacing="0">
   <tr>
       <td colspan="7" align="center" class="text1b" bgcolor="#BB6666">INFORMACION DE CURSADA</span></td>
   </tr>
   <tr>
        <td valign="top">
            <table width="700" border="1" cellspacing="0">
                <tr bgcolor="#dddddd">
      <br>
                </tr>

                <tr bgcolor="#dddddd">
                    <td align="center"><b>CURSO</b></td>
                    <td align="center"><b>DIVI</b></td>
                    <td align="center"><b>CICLO LECTIVO</b></td>
                    <td align="center"><b>PASE/BAJA</b></td>
                    <td align="center"><b>ACTUAL</b></td>
                    <td align="center"><b>FECHA MOV.</b></td>
                    <td align="center" width="245px"><b>MODALIDAD</b></td>
                </tr>

<? while ($cursa = mysql_fetch_array($cur))
	{
		$plaan = mysql_query ("SELECT * FROM plan WHERE id = $cursa[modalidad]");
		$plan = mysql_fetch_array($plaan);
?>
                <tr>
      			<td align='center' style='background: white'> <? echo $cursa['curso']; ?>º</td>
      			<td align='center' style='background: white'> <? echo $cursa['divi']; ?>º</td>
      			<td align='center' style='background: white'> <? echo $cursa['anio']; ?></td>
      			<td align='center' style='background: white'> <? echo ($cursa['pase']=="0000-00-00") ?"-" : date("d-m-Y",strtotime($cursa['pase'])); ?></td>
      			<td align='center' style='background: white'> <? if ($cursa['control']==1) echo "SI";
			else echo "NO"; ?></td>
      			<td align='center' style='background: white'> <? echo date("d-m-Y",strtotime($cursa['fecha'])); ?></td>
      			<td align='center' style='background: white'> <? echo $plan['descripcion']; ?></td>
                </tr>
<?
	}
mysql_free_result($plaan);

?>
            </table>
    </td>
    </tr>
</table>
<br>

<br>
<?

// Datos de familiares

$family = mysql_query ("SELECT * FROM familiares, alu_fami WHERE alu_fami.alumno = $actor and alu_fami.familiar=familiares.dni ORDER BY alu_fami.tipo");

?>

<table id="familiares" border="0" style="width: 900px; background-color: #ddcccc" bordercolor="#000000" cellspacing="0">
   <tr>
       <td colspan="7" align="center" class="text1b" bgcolor="#c0c0c0">INFORMACION DE LOS FAMILIARES</span></td>
   </tr>

   <tr>
        <td valign="top">


            <table width="800" border="1" cellspacing="0">
                <tr bgcolor="#dddddd">
      <br>
                </tr>

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
	<td align='center' style='background: white'><a href="alta_fami.php?dni=<?=$fami['dni']?>" target="_blank"> <? echo $fami['dni']; ?></a></td>
      			<td align='center' style='background: white'> <? echo $fami['apellido']; ?>, <? echo $fami['nombre']; ?></td>
      			<td align='center' style='background: white'> <? echo $fami['domicilio']; ?></td>
      			<td align='center' style='background: white'> <? echo $fami['tel']; ?></td>
      			<td align='center' style='background: white'> <? echo $fami['trabajo']; ?></td>
      			<td align='center' style='background: white'> <? echo $fami['tel_trabajo']; ?></td>
      			<td align='center' style='background: white'> <? echo $fami['email']; ?></td>


                </tr>
<?
	}
mysql_free_result($family);
?>
            </table>

    </td>
    </tr>
	<tr>
       <td colspan="7" align="center" class="text1b" ><a href="unir_fami_agregar.php?dni=<?=$actor?>">A&ntilde;adir familiar</a></td>
   </tr>
</table>


<br>
<br>

<?
// Novedades de trayectoria

$nov_alu = mysql_query ("SELECT curso,novedad,fecha,grabo FROM `novedades` WHERE `dni` =$actor");

?>

<table id="novedades" border="0" style="width: 900px; background-color: #ffffff" bordercolor="#000000" cellspacing="0">
   <tr>
       <td align="center" class="text1b" bgcolor="#bb6666"><a href="cargar_nov.php?actor=<?=$actor?>" title="Click para agregar novedad">NOVEDADES DEL ALUMNO</a></span></td>
   </tr>
   <tr><td><br></td></tr>
   <tr>
        <td valign="top">

            <table width="700" border="1" cellspacing="0">
                <tr bgcolor="#dddddd">
                    <th width="45px"><b>Curso</b></th>
                    <th width="85px"><b>Fecha</b></th>
                    <th><b>Novedad</b></th>
                    <th width="105px"><b>Notificó</b></th>
                </tr>

<?
if (!mysql_num_rows($nov_alu)) {
	echo "<tr><td align='center' style='background: white' colspan='4'>Sin novedades cargadas</td></tr>\n";
}
else {
while ($novedad = mysql_fetch_assoc($nov_alu))
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
}
mysql_free_result($nov_alu);
?>
            </table>
	</td>

    </tr>
</table>

<br>
<br>
<? // Documentación presentada y obrante en el folio
$resultmotivo = mysql_query ("SELECT * FROM documentacion order by id");
?>

<table id="documentacion" border="0" style="width: 895px; background-color: #ddcccc" id="table1" cellpadding="0" cellspacing="4">
		<tr>
			<td colspan="4" height="40" align="center" class="text1b" bgcolor="#bbCbbb">DOCUMENTACION DEL ESTUDIANTE <p style="font-weight: normal">(En color negro lo presentado, en <a href=# style="color: #BB6666" >rojo</a> la documentacion faltante)</p></td>
		</tr>

	<?	WHILE ($ff = mysql_fetch_array($resultmotivo)) {

		$check="";
		$color="#BB6666";


		$docu = mysql_query ("SELECT * FROM docu_alu where alumno=$actor and id=$ff[id]");
		$consulta = mysql_num_rows($docu);
		$docum = mysql_fetch_array($docu);
		$idProp= "id" . $ff[id];
		if ($consulta >=1) {
					$check="checked";

					if ($docum['descripcion']!="") $color="#000000";
					$descrip=$docum['descripcion'];
					$color="#000000";

				   }
		else {
			$descrip="";
			$check='';
		}
		?>

		<tr>

		  <td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>"><? echo $ff['nombre'];?> <input type="checkbox" disabled <?=$check?> name="<?=$idProp?>"></td>
		  <td bgcolor="#EAEAEA" width="268" align="left"><?echo $descrip; ?>

		</td>





		</tr>
	<? }
mysql_free_result($resultmotivo);
 ?>



						</table>
			</td>
		</tr>
</table>
<br>
<br>
			<?
			include 'footer.php';
			?>
			</td>
		</tr>
</table>

<input type="hidden" name="actor" value="<?echo $actor;?>">
</form>


</body>
<script>
document.getElementById("copiaDni").addEventListener("click",function (event){
  event.preventDefault();
  document.getElementById('cuildni').value = document.getElementById('nroDNI').value;
 },true);
</script>
<?
} //pizzarra
else
{

	$actor=$_GET['actor'];
	$cuit = trim($_GET['cuilpre']) . trim($_GET['cuildni']) . trim($_GET['cuilsuf']);

//	$nombre=ucwords(strtolower($_GET['nombre']));
	$nombre=$_GET['nombre'];
	$apellido=strtoupper($_GET['apellido']);
	$direccion=$_GET['direccion'];
	$mail=$_GET['mail'];
	$sexo=$_GET['sexo'];
	$f_nac=$_GET['f_nac'];
	$tel=$_GET['tel'];
	$pais=$_GET['pais'];
	$ciudad=$_GET['ciudad'];
	$provincia=$_GET['provincia'];
	$tribu=$_GET['tribu'];
	$f_ingreso=$_GET['f_ingreso'];
	$lib_mod=$_GET['lib_mod'];
	$folio=$_GET['folio'];
	$libro=$_GET['libro'];
	$dispo=$_GET['dispo'];
	$ninforme=$_GET['ninforme'];
	$archivo=$_GET['archivo'];


$resultfolio = mysql_query ("SELECT * FROM folio where dni=$actor");
$yaesta = mysql_num_rows($resultfolio);


if (mysql_query ("UPDATE alumno SET nombre='$nombre',apellido='$apellido',domicilio='$direccion',mail='$mail',sexo='$sexo',f_nac='$f_nac',tel='$tel',pais='$pais',ciudad='$ciudad',provincia='$provincia', tribu='$tribu',f_ingreso='$f_ingreso',dispo='$dispo',ninforme='$ninforme',archivo='$archivo',cuil='$cuit' WHERE dni=$actor"))
{

	if ($yaesta == 1)  mysql_query ("UPDATE folio SET folio='$folio',libro='$libro',modalidad='$lib_mod' where dni=$actor");
	else  mysql_query ("INSERT INTO folio VALUES ($actor,'$libro','$folio','$lib_mod','-')");

?>
	<script>
		var answer=alert("Datos Actualizados Correctamente");
		location.replace("alumno.php?dni=<?=$actor?>");
	</script>
<?
}
else {
?>
	<script>
		var answer=alert("Atención:\nNo se pudo grabar en la BD");
		location.replace("alumno.php?dni=<?=$actor?>");
	</script>
<?
}


}

?>
</html>
<?PHP }

else {
	$ref = base64_encode($_SERVER['REQUEST_URI']);
	$ref = 'Location: i_admin.php?ref=' . $ref;
	header($ref);
	exit;
}

function busca_edad($fecha_nacimiento){
 $dia=30;
 $mes=06;
 $ano=date("Y");
 $dianaz=date("d",strtotime($fecha_nacimiento));
 $mesnaz=date("m",strtotime($fecha_nacimiento));
 $anonaz=date("Y",strtotime($fecha_nacimiento));
 //si el mes es el mismo pero el día inferior aun no ha cumplido años, le quitaremos un año al actual
 if (($mesnaz == $mes) && ($dianaz > $dia)) $ano=($ano-1);
 //si el mes es superior al actual tampoco habrá cumplido años, por eso le quitamos un año al actual
 if ($mesnaz > $mes) $ano=($ano-1);
 //ya no habría mas condiciones, ahora simplemente restamos los años y mostramos el resultado como su edad
 $edad=($ano-$anonaz);
 return $edad;
}
 ?>
