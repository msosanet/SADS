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

	$result = mysql_query ("SELECT * FROM alumnos_mesas WHERE dni = '$rest4'");
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

$resultxx = mysql_query ("SELECT * FROM alumnos_mesas WHERE dni = '$rest4'");
$filax2 = mysql_fetch_array($resultxx);

$i=0;
$a=0;
if ($filax2[nota_1]=='ADEUDA')
{ 
	$vector[$i]=$filax2[materia_1];
	$i=$i+1;
	$a=$a+1;
}

if ($filax2[nota_2]=='ADEUDA')
{ 
	$vector[$i]=$filax2[materia_2];
	$i=$i+1;
	$a=$a+1;
}

if ($filax2[nota_3]=='ADEUDA')
{ 
	$vector[$i]=$filax2[materia_3];
	$i=$i+1;
	$a=$a+1;
}
if ($filax2[nota_4]=='ADEUDA')
{ 
	$vector[$i]=$filax2[materia_4];
	$i=$i+1;
	$a=$a+1;
}

if ($filax2[nota_5]=='ADEUDA')
{ 
	$vector[$i]=$filax2[materia_5];
	$i=$i+1;
	$a=$a+1;
}
if ($filax2[nota_6]=='ADEUDA')
{ 
	$vector[$i]=$filax2[materia_6];
	$i=$i+1;
	$a=$a+1;
}
if ($filax2[nota_7]=='ADEUDA')
{ 
	$vector[$i]=$filax2[materia_7];
	$i=$i+1;
	$a=$a+1;
}
if ($filax2[nota_8]=='ADEUDA')
{ 
	$vector[$i]=$filax2[materia_8];
	$i=$i+1;
	$a=$a+1;
}
if ($filax2[nota_9]=='ADEUDA')
{ 
	$vector[$i]=$filax2[materia_9];
	$i=$i+1;
	$a=$a+1;
}
if ($filax2[nota_10]=='ADEUDA')
{ 
	$vector[$i]=$filax2[materia_10];
	$i=$i+1;
	$a=$a+1;
}
if ($filax2[nota_11]=='ADEUDA')
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
