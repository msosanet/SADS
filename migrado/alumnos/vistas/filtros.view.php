<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta charset="UTF-8"/>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<script type="text/javascript" language="JavaScript1.2" src="../csjs/stm31.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../csjs/images.js"></script>
<link rel="stylesheet" type="text/css" href="style.css" />

<link rel="shortcut icon" href="../imag/favicon.ico">
<title>Administrador de Alumnos</title>



</head>
<?
include 'header.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt) ;
$resultmotivo = mysql_query ("SELECT * FROM motivo_dec"); 

$anoz=$_GET[ano];
$cursoz=$_GET[curso];
$pasez=$_GET[pase];
$fechaz=$_GET[fecha];

?>

<body background="bgris.gif" >


<form method="GET" action="filtros.php">

<div align="center">
	<table border="0" width="980" bgcolor="#FFFFFF">
		<tr>
			<td>
			
			<div align="center">
			<table border="0" width="980">

<?if ($_SESSION['valor']==1)
{		
include 'menuppal2.php';
}
if ($_SESSION['valor']==0)
{		
include 'menuppal.php';
}
if ($_SESSION['valor']==3) 
{		
include 'menuppal3.php';
}
if ($_SESSION['valor']==4) 
{		
include 'menuppal4.php';
}
?>
<tr><td><p align="left">Filtros.</p></td></tr>
</table>
</div></div>
				
				<p align="left">
					<table border="0" width="250" bgcolor="#FFFFFF">
						<tr><td><input type="checkbox" value="ano" name="ano" <? if (isset($anoz)){echo "checked";}?>/><label>A&ntilde;o    </label>
							<td><input type="text" name="anox" <? ?> size="8" maxlength="4" value="<? echo $_GET[anox];?>" autofocus/></td></td>
						</tr>
						<tr>
							<td><input type="checkbox" value="fecha" name="fecha" <? if (isset($fechaz)){echo "checked";}?>/><label>Fecha</label></td>
							<td><font color="<?echo $color;?>">Desde:</td>
							</font>
							<td>
								<td><input type="text" name="diad" size="2" maxlength="2" value="<?echo $GET['diad']; ?>" /></td>
								<td><input type="text" name="md" size="2" maxlength="2" value="<?echo $_GET['md']; ?>" /></td>
								<td><input type="text" name="ad" size="4" maxlength="4" value="<?echo $_GET['ad']; ?>" /></td> 
							</td>
							<td><font color="<?echo $color;?>">Hasta:</td></font>
							<td>
								<td><input type="text" name="dh" size="2" maxlength="2" value="<?echo $_GET['dh']; ?>" /></td>
								<td><input type="text" name="mh" size="2" maxlength="2" value="<?echo $_GET['mh']; ?>" /></td>
								<td><input type="text" name="ah" size="4" maxlength="4" value="<?echo $_GET['ah']; ?>" /> </td>
							</td>
						</tr>


						
						<tr>
						<td>
						<input type="checkbox" value="curso" <? if (isset($cursoz)){echo "checked";}?> name="curso" /><label>Curso/Division</label>
						</td>
						<td>
						<?
						
						$result79 = mysql_query ("SELECT DISTINCT curso FROM novedades ORDER BY curso ASC");
						echo "<select name=cursos>";
							
							while ($fila79 = mysql_fetch_array($result79))
							{ 	if ($_GET[cursos]==$fila79['curso'])
									{echo "<option value=".$fila79['curso']." selected>".$fila79['curso']."</option>";}
								else
									{echo "<option value=".$fila79['curso']." >".$fila79['curso']."</option>";}
							}	
						echo "</select>";
						 ?></td>
						
						</tr>
						<tr>
						<td><input type="checkbox" value="pase" <? if (isset($pasez)){echo "checked";}?> name="pase" /><label>Pase</label></td>
						<td>
							<select name=pasew>
								<option value="Solicitado" <? if ($_GET[pasew]=='Solicitado'){echo "selected";}?>>Solicitado</option>
								<option value="Confirmado" <? if ($_GET[pasew]=='Confirmado'){echo "selected";}?>>Confirmado</option>
								<option value="Generado" <? if ($_GET[pasew]=='Generado'){echo "selected";}?>>Generado</option>
								<option value="Entregado" <? if ($_GET[pasew]=='Entregado'){echo "selected";}?>>Entregado</option>
							</select>
						
						</td>
						</tr>
						<tr><td><input type="submit" name="enviar" value="Ver" /></td></tr>

					</p>
					
					
				</table>


</form>




</body>

</html>
<? 
if (isset($_GET[enviar])) 
{ 

	if (isset($_GET[ano])) 
	{ $ano=" YEAR(p.fecha_solicitud)=$_GET[anox]";}
	else
	{$ano=" p.fecha_solicitud LIKE '%%'";}

	if (isset($_GET[fecha])) 
	{	if(isset($_GET[diad]) AND isset($_GET[md]) AND isset($_GET[ad]) AND isset($_GET[dh]) AND isset($_GET[mh]) AND isset($_GET[ah])) 
		{
			$fecha_desde=$_GET['ad']."-".$_GET['md']."-".$_GET['diad'];	
			$fecha_hasta=$_GET['ah']."-".$_GET['mh']."-".$_GET['dh'];
			$fecha=" AND p.fecha_solicitud BETWEEN ".$fecha_desde." AND ".$fecha_hasta;
		}
	}
	else
	{$fecha="";}
		
	if (isset($_GET[curso])) 
	{$curso=" AND n.curso='$_GET[cursos]'";}
	else
	{$curso=" AND n.curso LIKE '%%'";}
	
	
	if (isset($_GET[pase])) 
	{ 
		if ($_GET[pasew]=='Solicitado')	
		{$pase=" AND n.novedad LIKE '%Pidio%'";}
		if ($_GET[pasew]=='Confirmado')	
		{$pase=" AND n.novedad LIKE '%Confirmo%'";}
		if ($_GET[pasew]=='Generado')	
		{$pase=" AND p.numero!=''";}
		if ($_GET[pasew]=='Entregado')	
		{$pase=" AND p.fecha_retiro!=''";}
	
	}
	else
	{$pase=" AND novedad LIKE '%%'";}

$consulta="SELECT DISTINCT (a.dni),a.apellido,a.nombre,p.fecha_solicitud,p.fecha_conf,p.numero,p.fecha_retiro,p.id FROM pase p, novedades n,alumno a WHERE p.alumno=a.dni AND n.dni=a.dni AND".$ano.$curso.$pase.$fecha." ORDER BY a.dni";

//$consulta="SELECT * FROM alumno,pase where dni=alumno ORDER BY dni ASC";
$consultax = mysql_query ($consulta);
$cantidat=mysql_num_rows($consultax);
//echo $consulta;


?>

<table border="1" width="900" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
	<tr>
		<td class="text1b" colspan="6" height="40" align="left">
		&nbsp;Resultado de la B&uacute;squeda <? echo $cantidat; ?></td>
	</tr>
	<tr bgcolor="#CCCCCC">
		<td width="20" align="center" height="36">DNI</td>
		<td width="200" align="center" height="36">Alumno</td>
		<td width="118" align="center"  height="36">Solicitar</td>
		<td width="118" align="center"  height="36">Confirmar</td>
		<td width="118" align="center"  height="36">Generar</td>
		<td width="118" align="center"  height="36">Entregar</td>							
	</tr>


<? 
while ($fila2 = mysql_fetch_array($consultax)) {	

//echo "SELECT * FROM pase p,novedades n WHERE n.dni = $fila2[dni] AND".$ano.$curso.$pase." ORDER BY p.alumno ASC";
/*$resulta = mysql_query ("SELECT * FROM pase p,novedades n WHERE n.alumno = $fila2[dni] AND".$ano.$curso.$pase." ORDER BY n.alumno ASC");
$fils = mysql_fetch_array($resulta) ;*/
?> 



	<tr bgcolor="#EEEEEE">
		<td width="20" align="center"><? echo $fila2[dni]; ?></td>
		<td width="20" align="center"><a href='ver_pase.php?dni=<? echo $fila2[id]; ?>'><? echo $fila2[apellido]; ?>, <? echo $fila2[nombre]; ?></a></td>
		<td bgcolor="#FFFFFF" width="55" align="center" bordercolor="#C0C0C0"><? if (($fila2[fecha_solicitud]=='') or ($fila2[fecha_solicitud]=='0000-00-00')) { ?><a href="crear.php?dni=<? echo $fila2[dni]; ?>" target="_self"><img border="0" src="form.png" width="35" height="35" alt="Ver Legajo"></a><? } else { ?><img border="0" src="tilde.png" width="42" height="35""><? } ?></td>
		<td bgcolor="#FFFFFF" width="55" align="center" bordercolor="#C0C0C0"><? if ($fila2[fecha_conf]=='' or $fila2[fecha_conf]=="0000-00-00") { ?><a href="confirmar.php?dni=<? echo $fila2[dni]; ?>" target="_self"><img border="0" src="form.png" width="35" height="35" alt="Ver Legajo"></a><? } else { ?><img border="0" src="tilde.png" width="42" height="35""><? } ?></td>
		<td bgcolor="#FFFFFF" width="55" align="center" bordercolor="#C0C0C0"><? if ($fila2[numero]=='') { ?><a href="generar.php?dni=<? echo $fila2[dni]; ?>" target="_self"><img border="0" src="form.png" width="35" height="35" alt="Ver Legajo"></a><? } else { ?><img border="0" src="tilde.png" width="42" height="35""><? } ?></td>
		<td bgcolor="#FFFFFF" width="55" align="center" bordercolor="#C0C0C0"><? if ($fila2[fecha_retiro]=='' or $fila2[fecha_retiro]=="0000-00-00") { ?><a href="entregar.php?dni=<? echo $fila2[dni]; ?>" target="_self"><img border="0" src="form.png" width="35" height="35" alt="Ver Legajo"></a><? } else { ?><img border="0" src="tilde.png" width="42" height="35"><? } ?></td>

    </tr>
<?
    }
?>    
</table>
<?









}








?>

<?} ?>
