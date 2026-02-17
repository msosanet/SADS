<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar" />
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />

<link rel="stylesheet" type="text/css" href="style2.css" />
<title>Administrador Alumnos</title>


</head>
<?php
include 'header.php';

$usuario = $_SESSION['usuario'];
$contrasenia = $_SESSION['contrasenia'];

// Calcula el numero de dias entre dos fechas.
// Da igual el formato de las fechas (dd-mm-aaaa o aaaa-mm-dd),
// pero el caracter separador debe ser un guión.
function diasEntreFechas($fechainicio, $fechafin){
    return (((strtotime($fechafin)-strtotime($fechainicio))/86400)+1);
}

    function invertirFecha( $fechaz ){
      return implode( "-", array_reverse( preg_split( "/\D/", $fechaz ) ) );
    }

    function calcularFecha($dias){

    $calculo = strtotime("$dias days");
    return date("Y-m-d", $calculo);
    }




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
			if ( $fila['pass'] != $contrasenia )
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
	$_SESSION['valor']=$fila['valor'];
	$_SESSION['sector']=$fila['sector'];
}
else {
?>
				<script>
				var answer=alert("Datos incorrectos")
				</script>
				<meta http-equiv='refresh' content='0; URL=index.php'>
<?php
}
?>

<body>
<div style="max-width:980px;align:center">
<!-- +++++++++++++ BARRA DE MENÚS +++++++++++++ -->
			<!-- table border="1" width="1100" bgcolor="#FFFFFF">      -->

<?php if ($_SESSION['valor']==1)  // +++++++++++++++++ ADMINISTRACIÓN +++++++++++++++
{
include 'menuppal2.php';
}
if ($_SESSION['valor']==0)  // ++++++++++++++++++ DIRECTIVO ++++++++++++++++++++
{
include 'menuppal.php';
}
if ($_SESSION['valor']==3)  // +++++++++++++++ PRECEPTOR +++++++++++++++
{
include 'menuppal3.php';
}
if ($_SESSION['valor']==4)  // ++++++++++++++ E.O.E. +++++++++++++++++++
{
include 'menuppal4.php';
}
if ($_SESSION['valor']==5)
{
include 'menuppal5.php';
}
?>
	<table border="0" width="980" cellspacing="0" cellpadding="0">
		<tr>
			<td><br><p align="left">&nbsp;&nbsp;<B><?php echo $fila['nombre'] . " " . $fila['apellido'] ?></B>, Bienvenido al Sistema de Alumnos.</p>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
			</td>
		</tr>
	</table>

</div>
<?php
include 'footer.php';
?>

</body>

</html>

<!-- ++++++++++++ PAPELERA ++++++++++++ -->

