<?PHP
session_start();
include 'conexion.php';
?>

<html>

<head>



<title>Bienvenido al SiDoS</title>


</head>




<?
include 'header.php';



$usuario = $_SESSION['usuario']; 
$contrasenia = $_SESSION['contrasenia'];  

	if ($usuario!="")
{
	$conexion = conectar ();
	$error = 0;

	$result = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario'");
	if (mysql_num_rows ($result) == 0 )
	{ 
		$error=1;

	}
	if (mysql_num_rows ($result) != 0)
	{		
			$fila = mysql_fetch_array($result) ;
			if ( $fila[pass] != $contrasenia )	
			{
			 
				$error = 1;


			}
	}

}	
else
{
			 
	$error = 1;
}

if ($error==0)
{


$_SESSION['estado']=1;
$_SESSION['valor']=$fila[valor];
$_SESSION['sector']=$fila[sector];


?>

</p>
<?
}
else {
	?>
				<script>
				var answer=alert("Datos incorrectos")
				</script> 
				<meta http-equiv='refresh' content='0; URL=index.php'>

				<? 

}
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
?><BR><BR><BR>
				<tr>
				
					<td>
					<?
						$archivo="&nbsp;"; 
						
					?>

					<p align="left">&nbsp;&nbsp;<B><?echo $fila[nombre]?><?echo $archivo?><?echo $fila[apellido]?></B>, Bienvenido al Sistema de Docentes del Sobral</p>
			

			<br>
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