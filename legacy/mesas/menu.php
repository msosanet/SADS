<?PHP
session_start();
include 'conexion.php';
?>

<html>

<head>

<title>Colegio Dr J. M. Sobral</title>

</head>

<?
include 'header.php';

$docente = $_SESSION['docente']; 

	if ($docente!="")
{
	$conexion = conectar ();
	$error = 0;
$rest1 = substr($docente, 0, 2);
$rest2 = substr($docente, 2, 3);
$rest3 = substr($docente, 5, 3);

$rest4 =$rest1.".".$rest2.".".$rest3;

	$result = mysql_query ("SELECT * FROM alumnos WHERE dni = '$rest4'");
	if (mysql_num_rows ($result) == 0 )
	{ 
		$error=1;
	}
}	
else
{
			 
	$error = 1;
}

if ($error==0)
{


$rest1 = substr($docente, 0, 2);
$rest2 = substr($docente, 2, 3);
$rest3 = substr($docente, 5, 3);

$rest4 =$rest1.".".$rest2.".".$rest3;

$resultxx = mysql_query ("SELECT * FROM alumnos WHERE dni = '$rest4'");
$filax2 = mysql_fetch_array($resultxx);

$i=0;
$a=0;
$findme="ADEUDA";


$pos1 = stripos($filax2[nota_1], $findme);
$pos2= stripos($filax2[nota_2], $findme);
$pos3= stripos($filax2[nota_3], $findme);
$pos4= stripos($filax2[nota_4], $findme);
$pos5= stripos($filax2[nota_5], $findme);
$pos6= stripos($filax2[nota_6], $findme);
$pos7= stripos($filax2[nota_7], $findme);
$pos8= stripos($filax2[nota_8], $findme);
$pos9= stripos($filax2[nota_9], $findme);
$pos10= stripos($filax2[nota_10], $findme);
$pos11= stripos($filax2[nota_11], $findme);






if ($pos1 !== false)
{ 
	$vector[$i]=$filax2[materia_1];
	$i=$i+1;
	$a=$a+1;
}

if ($pos2 !== false)
{ 
	$vector[$i]=$filax2[materia_2];
	$i=$i+1;
	$a=$a+1;
}

if ($pos3 !== false)

{ 
	$vector[$i]=$filax2[materia_3];
	$i=$i+1;
	$a=$a+1;
}
if ($pos4 !== false)
{ 
	$vector[$i]=$filax2[materia_4];
	$i=$i+1;
	$a=$a+1;
}

if ($pos5 !== false)
{ 
	$vector[$i]=$filax2[materia_5];
	$i=$i+1;
	$a=$a+1;
}
if ($pos6 !== false)
{ 
	$vector[$i]=$filax2[materia_6];
	$i=$i+1;
	$a=$a+1;
}
if ($pos7 !== false)
{ 
	$vector[$i]=$filax2[materia_7];
	$i=$i+1;
	$a=$a+1;
}
if ($pos8 !== false)
{ 
	$vector[$i]=$filax2[materia_8];
	$i=$i+1;
	$a=$a+1;
}
if ($pos9 !== false)
{ 
	$vector[$i]=$filax2[materia_9];
	$i=$i+1;
	$a=$a+1;
}
if ($pos10 !== false)
{ 
	$vector[$i]=$filax2[materia_10];
	$i=$i+1;
	$a=$a+1;
}
if ($pos11 !== false)
{ 
	$vector[$i]=$filax2[materia_11];
	$i=$i+1;
	$a=$a+1;
}

$_SESSION['estado']=1;



?>

</p>
<?
}
else {


	?>
				<script>
				var answer=alert("Usted no se encuentra en nuestra base, por favor informelo en la Secretaria")
				</script> 
				<meta http-equiv='refresh' content='0; URL=index.php'>

				<? 

}
$fila = mysql_fetch_array($result) ;
?> 

<body >
<div align="center">
	<table border="0" width="980" cellspacing="0" cellpadding="0">
		

<tr>
			


	<table border="0" width="980" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0">
		<tr>
			<td>
			<div align="center">
				<table border="0" width="980" cellspacing="0" cellpadding="0">
					</table>
				
				</div>
			<table border="0" width="980">

<?

if ($a > 0)	{	
include 'menuppal2.php';}
else
{	
include 'menuppal3.php';}

?><BR><BR><BR>
				<tr>
				
					<td>
					<?
						$archivo="&nbsp;"; 
						
					?>

					<p align="left">&nbsp;&nbsp;<B><?echo $fila[alumno]?></B>, Bienvenido al Sistema de Mesas, seleccione la opci&oacute;n deseada del men&uacute; superior</p>
			
			<br>
					<p align="left">&nbsp;&nbsp;Usted debe Rendir las siguientes materias: <B>
														<?
															while ($i >= 0){ 
															echo utf8_encode($vector[$i]);
															$i=$i-1;
															echo " - ";
															$debe=$debe." - ".utf8_encode($vector[$i]);
															} $_SESSION['debe']=$debe; 
														?>
														</B></p>

			<br>
					
				
					
						</p>
				
					
					<div align="center">
					<table border="0" width="29%">
						<tr>
							<td>
								<p align="center">
								<img border="0" src="atencion.png" width="580" height="156">
							</td>
						</tr>
					</table>
					</div>
					
						
					</td>
				</tr>

			</table>

							</td>
							
						</tr>
					</table>
						</div>

						
</td>
				</tr>
				<?
include 'footer.php';
?>
			</table>
		
		</tr>
	</table>
	
</div>
			</td>
		</tr>
	</table>
</div>
<p>



</body>

</html>