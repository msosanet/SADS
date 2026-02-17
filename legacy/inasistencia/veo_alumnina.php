<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion3.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<script type="text/javascript" language="JavaScript1.2" src="../csjs/stm31.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../csjs/images.js"></script>
<link rel="stylesheet" type="text/css" href="style.css" />

<link rel="shortcut icon" href="../imag/favicon.ico">
<title>Administrador del SID</title>




</head>
<?
include 'header.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt) ;
//$resultmotivo = mysql_query ("SELECT * FROM motivo_dec"); 






?>

<body background="bgris.gif" >


<form method="GET" action="veo_alumnina.php">

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
	
				<tr>
					<td>
					<p align="center"><div class="titles1">&nbsp;<p align="left">Informe del Alumno.</p>
						</p>
					<p align="center">&nbsp;
					
					</p>
					
					<div align="left">
					<?
/*
					<table border="0" width="62%">
						<tr>
							<td align="right" width="36%">Ingrese el apellido o parte de el:</td>
							<td align="right">&nbsp;<input type="text" name="alumno" id="alumno" size="20" maxlength="20" value="" /></td>
							<td align="right" rowspan="3" width="389" >
							<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;</td>
						</tr>
						<tr>
							<td align="right" width="36%"></td>
							<td align="right"></td>
							<td align="right" rowspan="3" width="389" >
							<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;<p align="center">&nbsp;</td>
						</tr>
						
						<tr>
							<td align="right" colspan="2">
							<p align="center">
									<input type="submit" value="   Buscar   " name="muestra2" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
						</tr>
					</table>*/?>
					</div>
					<p align="center">

					</p>
					<p align="center">&nbsp;</p>
					<p align="center">&nbsp;</p>
					<p align="left">
</font>
					<?
				if (isset($_GET['muestra2']))
{ 

	$alumno=$_GET['alumno'];


$_pagi_sql="SELECT * FROM alumnos WHERE alumno like '%$alumno%' order by alumno";




$_pagi_cuantos=50;
$_pagi_conteo_alternativo = true;
$_pagi_nav_num_enlaces=10;
include("paginator.inc.php"); 
?>
<p align="left"><?
echo"$_pagi_navegacion"; 
?>
<br><br>
</p><?

$cont=0;		?> <table border="1" width="980" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="9" height="40" align="left">
							&nbsp;Datos del Alumno</td>
						</tr>




						<tr>
							<td width="20" bgcolor="#808080" align="center" height="36">N°</td>							
							<td width="100" bgcolor="#808080" align="center" height="36">DNI</td>
							<td width="200" bgcolor="#808080" align="center" height="36">Alumno</td>
							<td bgcolor="#808080" width="100" align="center" height="36">Padre</td>
							<td bgcolor="#808080" width="100" align="center" height="36">Madre</td>
							<td bgcolor="#808080" width="100" align="center" height="36">Tutor</td>
							<td bgcolor="#808080" width="80" align="center" height="36">Tel.</td>
							<td bgcolor="#808080" width="80" align="center" height="36">Donicilio</td>
							<td bgcolor="#808080" width="80" align="center" height="36">Curso</td>
						

						</tr>

		<?php while ($fila2 = mysql_fetch_array($_pagi_result))
		{

		$cont=$cont+1;
	
		?> 

						<tr>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $cont;?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[dni]; $dni=$fila2[dni];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[alumno];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[nompadre];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[nommadre];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[tutor];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[tel];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[domicilio];?></td>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $fila2[curso];?>° <?echo $fila2[division];?>°</td>
						
                					
					
							
							
						</tr>
						<?
						}
						?>
						</table><?
}
	?>					
					</p>
					<p align="center">&nbsp;</td>
				</tr>


			</table>
			</div>
			

			</td>
		</tr>
	</table>
</div>
</form>

<table border="1" width="980" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="9" height="40" align="left">
							&nbsp;Ausencias del Alumno: <?echo $fila2[alumno];?>
							</td>
						</tr>




						<tr>
							<td width="20" bgcolor="#808080" align="center" height="36">N°</td>							
							<td width="100" bgcolor="#808080" align="center" height="36">Fecha</td>
							<td width="200" bgcolor="#808080" align="center" height="36">Materia</td>
							<td width="200" bgcolor="#808080" align="center" height="36">Tipo</td>
							
						</tr>




<?

//echo $dni;
$conexion = conectar ();
//SOLO LAS DEL AÑO EN CURSO, DEJEMOSLO ACA PARA TRABAJOS FUTUROS.
$cons=mysql_query("SELECT * from alumnos_faltas WHERE dni='".$dni."' AND fecha>'2018-01-01' ORDER BY fecha ASC");
//echo $cons;
$conti=0;
$ef=0;
$gral=0;

while($rowz = mysql_fetch_array($cons)) 
{
				if ($rowz['injus']==1)
				{$injus='Injustificada';}
				if ($rowz['injus']==0)
				{$injus='Justificada';}
				if ($rowz['injus']==2)
				{$injus='Tarde';}
				if ($rowz['injus']==3)
				{$injus='Ausente con Permanencia';}
				$conti=$conti+1;
?>
						<tr>
							<td width="20" bgcolor="#EAEAEA" align="center"><?echo $conti;?></td>
							<td width="100" bgcolor="#EAEAEA" align="center"><?echo $rowz["fecha"];?></td>
							<td width="200" bgcolor="#EAEAEA" align="center"><?echo $rowz["tipo"]; $tipo=$rowz["tipo"];?></td>
							<td width="200" bgcolor="#EAEAEA" align="center"><?echo $injus;?></td>
						
						</tr>
<?			
		//echo $tipo;
		
		/*if ($rowz['tipo']='EF') //
		{ef=ef+1;}*/
		
		
		}
?>
</table>


</td>
<br>
<br>

</div>
</body>
<? } ?>
<?include 'footer.php';?>
</html>
