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
<title>ALUMNOS</title>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=300,height=300,scrollbars=NO") 
} 
</script> 
</head>
<?
include 'header.php';
?>
<body background="bgris.gif" >

<p>


<style type="text/css">
<!--
.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.Estilo6 {
	font-size: 16px;
	font-weight: bold;
}
.Estilo7 {font-size: 16px; font-weight: bold; color: #FF0000; }
-->
</style>

<?
$conexion = conectar ();
$usuario=$_SESSION['usuario'];

$materia=$_GET["materia"];
$curso=$_GET["anio"];
$divi=$_GET["divi"];
$cur=$_GET["cur"];

$resultdocente = mysql_query ("SELECT * FROM materias where id=$materia");
$filadocente = mysql_fetch_array($resultdocente); 

$anio=date ("Y");

$anio="2019";


$res = mysql_query ("SELECT * FROM calificador, alumno where  calificador.division=$divi and calificador.materia=$materia and alumno.dni=calificador.alumno order by alumno.apellido");

$r2 = mysql_query ("SELECT * FROM tablero");
$f2 = mysql_fetch_array($r2); 


$sum=0;

$errordoc = 0;
$hayerrores = 0;
$i=1;




function menu2($ssql,$valor,$i){ 
  	echo "<select name='unouno[$i]'>"; 
  	$resultado=mysql_query($ssql); 
  	while ($fila=mysql_fetch_row($resultado)){ 
    	if ($fila[0]==$valor){ 
      	echo "<option selected value='$fila[0]'>$fila[1]";	
    	} 
    	else{ 
      	echo "<option value='$fila[0]'>$fila[1]";	
    	} 
  } 
  	echo "</select>";	
}


function menu3($ssql,$valor,$i){ 
  	echo "<select name='unodos[$i]'>"; 
  	$resultado=mysql_query($ssql); 
  	while ($fila=mysql_fetch_row($resultado)){ 
    	if ($fila[0]==$valor){ 
      	echo "<option selected value='$fila[0]'>$fila[1]";	
    	} 
    	else{ 
      	echo "<option value='$fila[0]'>$fila[1]";	
    	} 
  } 
  	echo "</select>";	
}

function menu4($ssql,$valor,$i){ 
  	echo "<select name='dosuno[$i]'>"; 
  	$resultado=mysql_query($ssql); 
  	while ($fila=mysql_fetch_row($resultado)){ 
    	if ($fila[0]==$valor){ 
      	echo "<option selected value='$fila[0]'>$fila[1]";	
    	} 
    	else{ 
      	echo "<option value='$fila[0]'>$fila[1]";	
    	} 
  } 
  	echo "</select>";	
}

function menu5($ssql,$valor,$i){ 
  	echo "<select name='dosdos[$i]'>"; 
  	$resultado=mysql_query($ssql); 
  	while ($fila=mysql_fetch_row($resultado)){ 
    	if ($fila[0]==$valor){ 
      	echo "<option selected value='$fila[0]'>$fila[1]";	
    	} 
    	else{ 
      	echo "<option value='$fila[0]'>$fila[1]";	
    	} 
  } 
  	echo "</select>";	
}

function mostrar($valor){ 

			$rxx = mysql_query ("SELECT * FROM nota where id=$valor");
			$rzz = mysql_fetch_array($rxx);
			echo $rzz[nota];	
			}



  $flag = 0;
  if (isset($_POST["submitx"])) {
     // verifico los errores en los campos



}
 else
  {
    $flag = 1;
  }
  
if ($hayerrores OR $flag) {
?>

<form method="POST" action="calificador2.php?cur=<? echo $cur; ?>&anio=<? echo $anio; ?>&divi=<? echo $divi; ?>&materia=<? echo $materia; ?>">
</p>
<div align="center">
	<table border="0" width="980" bgcolor="#FFFFFF">
		<tr>
			<td>
			<div align="center">
				<table border="0" width="980" cellspacing="0" cellpadding="0">
					<tr>
						
					</tr>
				</table>
				
				<p></div>
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
if ($_SESSION['valor']==5) 
{		
include 'menuppal5.php';
}
?>	
				<tr>
				

					<td>
					
					<p align="left" class="text1b">Cargar notas a los alumnos</p>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
					</p><div align="left">
					
					<div align="center">
					
					<table border="0" width="980" id="table1" cellpadding="0" cellspacing="2">

												<tr>
							<td colspan="12" height="40" align="left" class="titulo2" bgcolor="#bbCbbb">&nbsp;Materia: <b><?echo $filadocente['materia']; ?></b>&nbsp;&nbsp;&nbsp;Curso: <b><?echo $cur; ?>º&nbsp; <?echo $divi; ?>º</b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href="des_cali.php?curso=<? echo $cur; ?>&anio=<? echo $anio; ?>&divi=<? echo $divi; ?>&materia=<? echo $materia; ?>" target="_blank"><img src="pdf2.png" alt="generar" height="62" width="50" align="center">&nbsp; &nbsp;Descargar Planilla </a></td>
						</tr>
						<tr>
							<td width="10" bgcolor="#EAEAEA" align="center">Nº</td>
							<td width="700" bgcolor="#EAEAEA" align="center">ALUMNO</td>
							<td bgcolor="#EAEAEA" width="268" align="center">1º (1º INF.)</td>
							<td width="174" bgcolor="#EAEAEA" align="center">2º (1º INF.)</td>
							<td bgcolor="#EAEAEA" width="268" align="center">NOTA 1º CUAT.</td>	
							<td width="174" bgcolor="#EAEAEA" align="center">1º (2º INF.)</td>
							<td bgcolor="#EAEAEA" width="268" align="center">2º (2º INF.)</td>
							<td width="174" bgcolor="#EAEAEA" align="center">NOTA 2º CUAT.</td>
							<td bgcolor="#EAEAEA" width="268" align="center">POND.</td>
							<td width="174" bgcolor="#EAEAEA" align="center">DIC.</td>
							<td bgcolor="#EAEAEA" width="268" align="center">FEB.</td>
							<td width="174" bgcolor="#EAEAEA" align="center">POND. DEF.</td>			
							
						</tr>

						<?	WHILE ($filass = mysql_fetch_array($res)) { 

						$al = mysql_query ("SELECT * FROM alumno where dni=$filass[alumno] ");
						$alu = mysql_fetch_array($al);
						$alum=$alu[apellido].", ".$alu[nombre];
						$sum=$sum + 1;
						
						


						?>
						
						<tr>
							<td width="10" bgcolor="#EAEAEA" align="center"><? echo $sum; ?></td>
	
							<td width="700" bgcolor="#EAEAEA" align="center"><? echo $alum; ?></td>
							<td bgcolor="#EAEAEA" width="268" align="center"><? if ($f2[uno]==0){ $valor4="SELECT * FROM nota order by id";
							menu2($valor4,$filass['11cua'],$i); } else mostrar($filass['11cua']); ?></td>
							<td width="174" bgcolor="#EAEAEA" align="center"><? if ($f2[dos]==0){ $valor5="SELECT * FROM nota order by id";
							menu3($valor5,$filass['12cua'],$i); } else mostrar($filass['12cua']);?></td>
							<td bgcolor="#EAEAEA" width="268" align="center">

							<? if ($f2[tres]==0){ ?> <SELECT NAME="1nota[<?php echo $i; ?>]">							
 							<? if ($filass['nota1']=='') {$selec = ''; } else {$selec = '';}?>

							<option value="<?echo $filass['nota1'];?>"><?echo $filass['nota1']; echo $selec;?></option>


  							 	<OPTION VALUE="-">-</OPTION> 
  							 	<OPTION VALUE="1">1</OPTION>  
  							 	<OPTION VALUE="2">2</OPTION> 
   								<OPTION VALUE="3">3</OPTION>
   								<OPTION VALUE="4">4</OPTION>
   								<OPTION VALUE="5">5</OPTION>
   								<OPTION VALUE="6">6</OPTION>
   								<OPTION VALUE="7">7</OPTION>
   								<OPTION VALUE="8">8</OPTION>
   								<OPTION VALUE="9">9</OPTION> 
   								<OPTION VALUE="10">10</OPTION> 
							</SELECT> <? } else echo $filass['nota1'];?></td>	
							<td width="174" bgcolor="#EAEAEA" align="center"><? if ($f2[cuatro]==0){ $valor6="SELECT * FROM nota order by id";
							menu4($valor6,$filass['21cua'],$i); } else mostrar($filass['21cua']);?></td>
							<td bgcolor="#EAEAEA" width="268" align="center"><? if ($f2[cinco]==0){ $valor7="SELECT * FROM nota order by id";
							menu5($valor7,$filass['22cua'],$i); } else mostrar($filass['22cua']);?></td>
							<td width="174" bgcolor="#EAEAEA" align="center">
							<? if ($f2[seis]==0){ ?>	<SELECT NAME="2nota[<?php echo $i; ?>]">
							
 							<? if ($filass['nota2']=='') {$selec = ''; } else {$selec = '';}?>

							<option value="<?echo $filass['nota2'];?>"><?echo $filass['nota2']; echo $selec;?></option>
  							 	<OPTION VALUE="-">-</OPTION> 
  							 	<OPTION VALUE="1">1</OPTION>  
  							 	<OPTION VALUE="2">2</OPTION> 
   								<OPTION VALUE="3">3</OPTION>
   								<OPTION VALUE="4">4</OPTION>
   								<OPTION VALUE="5">5</OPTION>
   								<OPTION VALUE="6">6</OPTION>
   								<OPTION VALUE="7">7</OPTION>
   								<OPTION VALUE="8">8</OPTION>
   								<OPTION VALUE="9">9</OPTION> 
   								<OPTION VALUE="10">10</OPTION> 
							</SELECT><? } else echo $filass['nota2']; ?></td>
							<td bgcolor="#EAEAEA" width="268" align="center">
							<? if ($f2[siete]==0){ ?>	<SELECT NAME="pond[<?php echo $i; ?>]">
							
 							<? if ($filass['ponderacion']=='') {$selec = ''; } else {$selec = '';}?>

							<option value="<?echo $filass['ponderacion'];?>"><?echo $filass['ponderacion']; echo $selec;?></option>
  							 	<OPTION VALUE="-">-</OPTION> 
  							 	<OPTION VALUE="1">1</OPTION>  
  							 	<OPTION VALUE="2">2</OPTION> 
   								<OPTION VALUE="3">3</OPTION>
   								<OPTION VALUE="4">4</OPTION>
   								<OPTION VALUE="5">5</OPTION>
   								<OPTION VALUE="6">6</OPTION>
   								<OPTION VALUE="7">7</OPTION>
   								<OPTION VALUE="8">8</OPTION>
   								<OPTION VALUE="9">9</OPTION> 
   								<OPTION VALUE="10">10</OPTION> 
							</SELECT><? } else echo $filass['ponderacion'];?></td>
							<td width="174" bgcolor="#EAEAEA" align="center">
							<? if ($f2[ocho]==0){ ?>	<SELECT NAME="dic[<?php echo $i; ?>]">
							
 							<? if ($filass['dic']=='') {$selec = ''; } else {$selec = '';}?>

							<option value="<?echo $filass['dic'];?>"><?echo $filass['dic']; echo $selec;?></option>
  							 	<OPTION VALUE="-">-</OPTION> 
  							 	<OPTION VALUE="1">1</OPTION>  
  							 	<OPTION VALUE="2">2</OPTION> 
   								<OPTION VALUE="3">3</OPTION>
   								<OPTION VALUE="4">4</OPTION>
   								<OPTION VALUE="5">5</OPTION>
   								<OPTION VALUE="6">6</OPTION>
   								<OPTION VALUE="7">7</OPTION>
   								<OPTION VALUE="8">8</OPTION>
   								<OPTION VALUE="9">9</OPTION>
   								<OPTION VALUE="10">10</OPTION> 
							</SELECT><? } else echo $filass['dic'];?></td>
							<td bgcolor="#EAEAEA" width="268" align="center">
							<? if ($f2[nueve]==0){ ?>	<SELECT NAME="feb[<?php echo $i; ?>]">
							
 							<? if ($filass['feb']=='') {$selec = ''; } else {$selec = '';}?>

							<option value="<?echo $filass['feb'];?>"><?echo $filass['feb']; echo $selec;?></option>
  							 	<OPTION VALUE="-">-</OPTION>   							 	
								<OPTION VALUE="1">1</OPTION>  
  							 	<OPTION VALUE="2">2</OPTION> 
   								<OPTION VALUE="3">3</OPTION>
   								<OPTION VALUE="4">4</OPTION>
   								<OPTION VALUE="5">5</OPTION>
   								<OPTION VALUE="6">6</OPTION>
   								<OPTION VALUE="7">7</OPTION>
   								<OPTION VALUE="8">8</OPTION>
   								<OPTION VALUE="9">9</OPTION> 
   								<OPTION VALUE="10">10</OPTION>
							</SELECT><? } else echo $filass['feb'];?></td>
							<td width="174" bgcolor="#EAEAEA" align="center">
							<? if ($f2[diez]==0){ ?>	<SELECT NAME="final[<?php echo $i; ?>]">
										
 							<? if ($filass['final']=='') {$selec = ''; } else {$selec = '';}?>

							<option value="<?echo $filass['final'];?>"><?echo $filass['final']; echo $selec;?></option>
  							 	<OPTION VALUE="-">-</OPTION>  
  							 	<OPTION VALUE="1">1</OPTION>  
  							 	<OPTION VALUE="2">2</OPTION> 
   								<OPTION VALUE="3">3</OPTION>
   								<OPTION VALUE="4">4</OPTION>
   								<OPTION VALUE="5">5</OPTION>
   								<OPTION VALUE="6">6</OPTION>
   								<OPTION VALUE="7">7</OPTION>
   								<OPTION VALUE="8">8</OPTION>
   								<OPTION VALUE="9">9</OPTION>
   								<OPTION VALUE="10">10</OPTION> 
							</SELECT><? } else echo $filass['final'];?></td>			
							
						</tr>
						<input type="hidden" name="dni[<?php echo $i; ?>]" id="alumnos" value="<? echo $filass[alumno]; ?>" />

		   				<? 


						$i=$i+1;
						}
						
 						?>


						<tr>
						

						</tr>
						<tr>
							<td width="834" bgcolor="#EAEAEA" align="left" colspan="12">
							<p align="center"><input type="submit" value="     Grabar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
						</tr>
						</table>
					</div>
					<p align="right">&nbsp;</div>
					<hr>
					</td>
				</tr>
				<?
include 'footer.php';
?>
			</table>
			</div>
		</tr>
	</table>

<input type="hidden" name="materia" value="<?echo $materia;?>">
<input type="hidden" name="divi" value="<?echo $divi;?>">
<input type="hidden" name="cur" value="<?echo $cur;?>">
<input type="hidden" name="i" id="i" value="<? echo $i; ?>" />

	</form>
</div>
</body>
<?
}
else
{

$now=date("Y-m-d");
	$i=$_POST['i'];
	$materia=$_POST['materia'];
	$cur=$_POST['cur'];
	$divi=$_POST['divi'];


for($k=1; $k < $i; $k++)
{ 


$deni=$_POST['dni'][$k];

$t11=$_POST['unouno'][$k];

$t12=$_POST['unodos'][$k];

$t21=$_POST['dosuno'][$k];

$t22=$_POST['dosdos'][$k];

$not1=$_POST['1nota'][$k];

$not2=$_POST['2nota'][$k];

$pond=$_POST['pond'][$k];

$dic=$_POST['dic'][$k];

$feb=$_POST['feb'][$k];

$final=$_POST['final'][$k];





$anio=date("Y");

$yaesta = mysql_query ("SELECT * FROM calificador where alumno=$deni and materia=$materia and division=$divi and curso='$cur'");
if (mysql_num_rows ($yaesta) > 0)
	{ 
		
	
		if (mysql_query ("UPDATE calificador SET 11cua='$t11', 12cua='$t12', nota1=$not1, 21cua='$t21', 22cua='$t22',nota2=$not2, ponderacion=$pond, dic=$dic , feb=$feb, final=$final ,fecha='$now' where alumno=$deni and materia=$materia and curso='$cur' and division=$divi and anio='$anio'"))
		{
printf("actualizo");

		}
	}
	else
	{
		
		if (mysql_query ("INSERT INTO calificador VALUES ($deni,'$t11','$t12','$not1','$t21','$t22','$not2','$pond','$dic','$feb','$final','$materia','$now','$cur',$divi,'-','-','$anio')"))
		{	
				
		}

	}
}

?>
				<script>
				var answer=alert("Notas Actualizadas Correctamente")
				</script> 
						<meta http-equiv='refresh' content='0; URL=calificador.php'>
						<? 



}

?>
</html>
<? } ?>
