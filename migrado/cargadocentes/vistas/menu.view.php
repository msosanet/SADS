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

	$result = mysql_query ("SELECT * FROM docentes WHERE dni = '$docente'");
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
include 'menuppal2.php';

?><BR><BR><BR>
				<tr>
				
					<td>
					<?
						$archivo="&nbsp;"; 
						
					?>

					<p align="left">&nbsp;&nbsp;<B><?echo $fila[nombre]?><?echo $archivo?><?echo $fila[apellido]?></B>, Bienvenido al Sistema de Carga, seleccione la opci&oacute;n deseada del men&uacute; superior</p>
			

			<br>
					<br>
<center>
<b><a href="instructivo.doc" target="_blank" >Descargar Instructivo de carga</a></b><br>
				
					
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
