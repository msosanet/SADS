<?PHP
session_start();


include 'conexion.php';
?>



<title>Comedor Sobral</title>
</head>
<?
include 'header.php';


?>

<body >

<form method="GET" action="i_admin.php">

<div align="center">
	<table border="0" width="980" cellspacing="0" cellpadding="0" height="440" background="todo.jpg">
		<tr>
			<td>&nbsp;<p>&nbsp;</p>
			<p>&nbsp; </p>


			<div align="center">
				<table border="0" width="78%">
					<tr>
						<td width="34%" colspan="2">
						<p align="right"><font face="Arial" size="2"><b>DNI (sin puntos):</b>
						</font></td>
						<td width="65%" colspan="2">
						<p align="center">
						<input name="docente" size="20" style="float: left"></td>
					</tr>
					<tr>
						<td width="34%" colspan="2">&nbsp;</td>
						<td width="65%" colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td width="34%" colspan="2">
						<p align="right"><font face="Arial"><font size="4"></font>&nbsp;&nbsp;
						</font></td>
						<td width="65%" colspan="2">
						<p align="center">
						</td>
					</tr>
					<tr>
						<td width="34%" colspan="2">&nbsp;</td>
						<td width="65%" colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td align="center">
						<p align="center">
						&nbsp;</td>
						<td align="center" width="25%">
						&nbsp;</td>
						<td align="center" width="19%">
						<input type="submit" value="Enviar" name="muestra" style="float: right"></td>
						<td align="center" width="45%">
						&nbsp;</td>
					</tr>
				</table>
			</div>
			<p>&nbsp;</p>
			<p>&nbsp;</td>
		</tr>
	</table>
</div>
<?
if (isset($_GET['enviar']))
{ 


	$dni=$_GET['docente'];
printf("DNI".$dni);

	$rest1 = substr($docente, 0, 2);
	$rest2 = substr($docente, 2, 3);
	$rest3 = substr($docente, 5, 3);
	$rest4 =$rest1.".".$rest2.".".$rest3;

	$hora=getdate();
	$hs=$hora[hours].":".$hora[minutes].":".$hora[seconds];

	$hoyx=date("Y/m/d");
	$hoy = str_replace("/","-",$hoyx);
	$dia=date("d");

	

	$result2 = mysql_query ("SELECT * FROM alumno_comedor WHERE alumno = '28119465'");
//	$fila2 = mysql_fetch_array($result2);


	if (mysql_num_rows($result2)!=0)
	{

		$result3 = mysql_query ("SELECT * FROM menu WHERE dia = $dia");
		$fila3 = mysql_fetch_array($result3);


				if (mysql_query ("INSERT INTO comedor VALUES (0,'$dni','$hoy','$hs',$fila3[id],$ok)"))
				{	
					
				}
				else 
				{	
					?>
					<script>
					var answer=alert("No se pudo grabar en la BD, contactese con el personal Administrativo ")
					</script> 
				<? 	
				}					
			
		?> 
<span style="font-size: 17pt"><?echo $fila2[apellido];?>,&nbsp;<?echo $fila2[nombre];?>&nbsp;&nbsp;&nbsp;<?echo $hs;?>



<meta http-equiv="refresh" content="2;url=i_admin.php"> 

				
<? 

}

	else {	
				?>
				<script>
				var answer=alert("El Alumno no se encuentra autorizado para ingresar al comedor")
				</script> 
				
	<? }	


}

?> 



</form>




</body>

</html>