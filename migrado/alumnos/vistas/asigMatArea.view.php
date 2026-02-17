<!DOCTYPE html>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" type="text/css" href="areas.css" />
<title>&Aacute;reas de los espacios curriculares</title></title>

<script language=javascript>
function ventanaSecundaria (URL){
   window.open(URL,"ventana1","width=300,height=300,scrollbars=NO")
}
</script>

<img src="header.jpg" alt="SID" style="vertical-align:bottom; display: block; margin-left: auto; margin-right: auto;">
</head>
<body >
<div style="max-width: 980px; margin: auto">
<?
if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';
?>
<div style="margin: auto; padding:5px; width: 80%">
<form method="GET" id="cur" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
<p align="left" class="text1b">Asignar Docentes a:
<select form="cur" name="curso" onchange='this.form.submit()'>
<?PHP
foreach($cursosTodos AS $idc => $descc) printf("<option value='%s' %s>%s</option>",$idc,(($idc==$cursox)? "selected": ""),$descc);
?>
</select><input form="cur" type="submit" value="Cambiar" name="submitcurso"></p><p>(El cambio solo aplica a los calificadores)</p><br>
</form>
</div>

 <div align="center">
 <form method="GET" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
 <br><br>

<p align="center" class="text1b"></p>
<div align="center">

<table border="1" bordercolor="#000000" style="background-color:#FFFFFF" width="895" cellpadding="1" cellspacing="0">
	<tr>
		<th bgcolor="#EAEAEA" align="center"><b>Materia</b></th>
		<th bgcolor="#EAEAEA" align="center"><b>Docente</b></th>
	</tr>

<?php

			//echo "<td bgcolor='#EAEAEA' align='center'>";

			$result79 = mysql_query ("SELECT m.descripcion,mc.idcurso,mc.idmateria,mc.idarea FROM matcur mc, materias m WHERE mc.idmateria=m.idmateria AND mc.idcurso='$cursox' AND mc.idmateria!=65");

				while ($fila79 = mysql_fetch_array($result79))
				{ echo "<tr>";
					$descri=$fila79['descripcion'];
					$materia=$fila79['idmateria'];
					$areaActual=$fila79['idarea'];
					echo "<td bgcolor='#EAEAEA' align='center'><b>".$descri."</b></td>";
					echo "<td bgcolor='#EAEAEA' align='center'>";
					//que materia
					echo "<input name='matmat[]' type='hidden' value=$materia />";

					echo "<select class='".$areaActual."' name='asigna[".$materia."]' onchange='this.style.color = \"red\";this.style.backgroundColor = \"white\"'>";
					if ($areaActual=="") echo "<option value='' selected>falta asignar</option>";
					foreach ($area AS $idA => $descA) {
						$selA = ($idA == $areaActual) ? "selected" : "";
						printf("<option value=%s %s>%s</option>",$idA,$selA,$descA);
					}
					echo "</select>";
					echo "</td>";
					echo "</td>";


			//echo "</td>";
			echo "</tr>";
		}

	?>


<input name="curso" type="hidden" value ="<?=$cursox?>"/>



						<tr>
							<td width="895" height="100" bgcolor="#EAEAEA" align="center" colspan="7">
							<br>
							<p align="center"><input type="submit" value="     Grabar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #ff0000; font-weight:1000; float:center width:500px; height:125px; " /></td>

						</tr>


	</table></div>
					<p align="right">&nbsp;</div>
				<?
include 'footer.php';
?>
			</div>
	</form>
</body>
</html>

<?PHP }
	else {
	$ref = base64_encode($_SERVER['REQUEST_URI']);
	$ref = 'Location: i_admin.php?ref=' . $ref;
	header($ref);
	exit;
} ?>

