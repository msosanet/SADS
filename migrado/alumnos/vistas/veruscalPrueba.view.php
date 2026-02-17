<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta charset="UTF-8"/>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style.css" />

<title>Habilitaciï¿½n de usuarios</title>

<style>
	thead th {
		background-color: white;
	}
	.floatingButton {
		border-radius: 10%;
		position: fixed;
		bottom: 50%;
		right: 20px;
		box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.2);
		background-color:  #36a0f9 ;
		color: white;
		padding: 15px 32px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		margin: 4px 2px;
		cursor: pointer;
		z-index: 1;
}
</style>

</head>
<?
include 'header.php';
//$conexion = conectar ();
$conexioncalif = conectarcalif ();
//$conexionsobral=conectarsobral ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
//$resultt = mysql_query("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
//$filatt = mysql_fetch_array($resultt) ;

if (isset($_GET['usuario']))
{mysql_select_db("calificadores");
if ($_GET['hab']==1)
{$sql="UPDATE users SET habilitado=1 WHERE username='$_GET[usuario]'";}
else
{$sql="UPDATE users SET habilitado=0 WHERE username='$_GET[usuario]'";}

mysql_query ($sql) ;//or die('Consulta no vÃ¡lida: ' . mysql_error());

if (mysql_query ($sql))
	{

				?>
				<script>
				var answer=alert("Usuario habilitado!")
				</script>
				<meta http-equiv='refresh' content='0; URL=veruscal.php'>
				<?
	}
	else {
				?>
				<script>
				var answer=alert("No se pudo habilitar el usuario")
				</script>
				<meta http-equiv='refresh' content='0; URL=veruscal.php'>
				<?
		}







}

/*if (isset($_GET['blanquear']))
{
//$2y$10$
$salt= uniqid(mt_rand(), true);
$options=['salt'=>$salt, 'cost'=>10];
$mypassword=$argv[1];
$cryptpwd=crypt($mypassword,'$2y$10$'.$salt.'$');
//$pwdhash=password_hash($mypassword, PASSWORD_DEFAULT, $options);
echo $cryptpwd;
echo $pwdhash;
//$2y$10$oje5wD.NupBacGticF3Uu.awEuUvFCXjz8IaWkIffgQzYP8/sNi2W
}*/

?>

<body>


<form method="GET" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">

<div style="align:center;max-width: 980px">

<?
if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';
if ($_SESSION['valor']==4) include 'menuppal4.php';

$q_roles = "SELECT * FROM `users-perfil` ";
$__roles = mysql_query($q_roles);
$roles = [];

// Asocia los perfiles con un nombre de usuario
while ($r = mysql_fetch_assoc($__roles)) $roles[$r['usuario']][] = $r['perfil'];

 printf("<!-- %s -->",var_export($_SESSION,true));

//  TODO: Por quÃ© el nombre de esta variables ?
$result79 = mysql_query ("SELECT * FROM users ORDER by habilitado ASC,dni ASC");

// TODO: Por quÃ© si uso la var result79, afecta al renderizado posterior de la tabla?
$result80 = mysql_query ("SELECT * FROM users ORDER by habilitado ASC,dni ASC");
$cantidad=mysql_num_rows($result79);
mysqli_select_db($conexioncalif,"calificadores");
$resulfaltan = mysql_query ("SELECT DISTINCT iddocente FROM matcur WHERE iddocente NOT IN (SELECT dni FROM users)");
$faltan=mysql_num_rows($resulfaltan);
$usuarios = [];
$usrDocentes = [];
$usrPreceptores = [];
$usrJefesPrecep = [];
$usrTutores = [];


// TODO: Si reemplazo la var result80 por 79, afecta al renderizado.
while ($row = mysql_fetch_array($result80)) {
	$uId = rand(10000,99999); //crea ID para proteger los datos de la BD
	// Obtengo todos los perfiles actuales asignados, para facilitar el cambio de los mismos posteriormente (?)
	if (array_search('1',$roles[$row['username']])!== false) $usrDocentes[$uId] = $row['username'];
	if (array_search('11',$roles[$row['username']])!== false) $usrPreceptores[$uId] = $row['username'];
	if (array_search('10',$roles[$row['username']])!== false) $usrJefesPrecep[$uId] = $row['username'];
	if (array_search('15',$roles[$row['username']])!== false) $usrTutores[$uId] = $row['username'];
}

debug_to_console(count($usrPreceptores),"Conteo inicial antes de cambios manuales");

?>
			<table border="0">
<tr><td><h1><p align="center">Administrar usuarios para Calificadores.</h1></p></td></tr>
<tr><td><h1><p align="center"><?echo $cantidad; ?></h1></p> <p align="center"><a href="docfal2.php">Faltan (<?echo $faltan; ?> </a>)</p></td></tr>
</form>

<?
	// En respuesta al sumbit del formulario se deberÃ­a modificar la base de datos
	
	if (isset($_POST["nuevosPermisos"])) {
		// debug_to_console(var_dump($usrDocentes),"POST seted ");
	 // Si hay datos en el arreglo docente
	if(isset($_POST['docentes'])) compararArreglos($usrDocentes,$_POST['docentes'],'Docentes');
		// Camino B - Evitar modificar datos si no hay nuevos docentes

			// foreach ($_POST['docentes'] as $docente) { // Recorro el arreglo y modifico los permisos de docentes.
			// 	// $query = "INSERT INTO `plazoscarga`(`desde`, `hasta`, `instancia`, `curso`, `division`, `materia`, `quien`) VALUES (CURRENT_TIMESTAMP(),'$finPlazo','$instancia','$curso','$division','$idmat','$usuario')";
			// 	// mysql_query($query)
			// }
		

		
	if(isset($_POST['preceptores'])) compararArreglos($usrPreceptores,$_POST['preceptores'],'Preceptores');

			// foreach ($_POST['preceptores'] as $preceptor) {
				
			// 	// $query = "INSERT INTO `plazoscarga`(`desde`, `hasta`, `instancia`, `curso`, `division`, `materia`, `quien`) VALUES (CURRENT_TIMESTAMP(),'$finPlazo','$instancia','$curso','$division','$idmat','$usuario')";
			// 	// mysql_query($query)
			// }
		
	if(isset($_POST['jefesPreceptor'])) compararArreglos($usrJefesPrecep,$_POST['jefesPreceptor'],'jefesPreceptor');	

	if(isset($_POST['tutores'])) compararArreglos($usrTutores,$_POST['tutores'],'tutores');	
}

	// if(isset($_POST['jefesPreceptor'])) {
			
	// 		if (count(array_diff($usrJefesPrecep,$_POST['jefesPreceptor'])) > 0) {
	// 			foreach ($_POST['jefesPreceptor'] as $jefe) {
	// 				// $query = "INSERT INTO `plazoscarga`(`desde`, `hasta`, `instancia`, `curso`, `division`, `materia`, `quien`) VALUES (CURRENT_TIMESTAMP(),'$finPlazo','$instancia','$curso','$division','$idmat','$usuario')";
	// 				// mysql_query($query)
	// 			}
	// 		}
	// 	}
	// 	if(isset($_POST['tutores'])) {
			
	// 		if (count(array_diff($usrTutores,$_POST['tutores'])) > 0) {
	// 			foreach ($_POST['tutores'] as $tutor) {
	// 				// $query = "INSERT INTO `plazoscarga`(`desde`, `hasta`, `instancia`, `curso`, `division`, `materia`, `quien`) VALUES (CURRENT_TIMESTAMP(),'$finPlazo','$instancia','$curso','$division','$idmat','$usuario')";
	// 				// mysql_query($query)
	// 			}
	// 		}
	// 	}
	
	
?>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">

</table>
</div>
<br><br>
	<div align="center">
		<table border="2" width="750" bgcolor="#FFFFFF">
			<thead><tr>
				<th>DNI</th>
				<th>Correo Electronico</th>
				<th>Nombre y Apellido</th>
				<th>Habilitar</th>
				<th>Blanquear Pass (DNI)</th>
				<th>Docente</th>
				<th>Preceptore</th>
				<th>Jefatura Prec</th>
				<th>Tutore</th>
			</tr></thead>
<?
		while ($fila79 = mysql_fetch_array($result79))
			{
				$uId = rand(10000,99999); //crea ID para proteger los datos de la BD
				$usuarios[$uId] = $fila79['username'];

				echo "<tr>";

			if ($fila79['habilitado']==1)
				{
				$estado="Deshabilitar";
				$colorhab="FF0000";
				$hab=0;
				}
			else
			{
				$estado="Habilitar";
				$colorhab="00FF00";
				$hab=1;
				}
			mysql_select_db("sid");
			$resultdoc = mysql_query ("SELECT * FROM docentes WHERE dni='$fila79[dni]'");

			if (!$resultdoc) {
			die('Consulta no vÃ¡lida: ' . mysql_error());
						echo  mysql_error;}

			while ($filadoc = mysql_fetch_array($resultdoc))
			{
				if ($fila79['dni']==$filadoc['dni'])
					{$colordni='00FF00';}
				else
					{$colordni='FF0000';}

				if (trim($fila79['username'])==trim($filadoc['mail']))
					{$colormail='00FF00';}
				else
					{$colormail='FF0000';}

			/*echo trim($fila79['username']);
			echo trim($filadoc['mail']);*/
			/*echo $colordni;
			echo $colormail;*/

			}
?>


			<td bgcolor="<?echo $colordni; ?>"><?echo $fila79['dni']; ?></td>
			<td bgcolor="<?echo $colormail; ?>"><?echo $fila79['username']; ?></td>
			<td><?echo $fila79['nya']; ?></td>
			<td bgcolor="<?echo $colorhab; ?>"><a href = "veruscal.php?usuario=<?echo $fila79['username'];?>&hab=<?echo $hab;?>"><?echo $estado;?></a></td>
			<td><a href ="https://calificadores.colegiosobral.edu.ar/blanq.php?blanquear=<?echo $fila79['dni'];?>" target="_blank" onclick="return  confirm('Esta seguro que desea blanquear la clave?')">Blanquear</a></td>
			
			<td bgcolor='#EAEAEA' align='center'><input type="checkbox" id="docente_<?=$fila79['dni']?>" name="docentes[]" value="<?=$fila79['username']?>" <?=((array_search('1',$roles[$fila79['username']])!== false) ? "checked" : "" )?>></td>
			<td bgcolor='#EAEAEA' align='center'><input type="checkbox" id="preceptor_<?=$fila79['dni']?>" name="preceptores[]" value="<?=$fila79['username']?>"  <?=((array_search('11',$roles[$fila79['username']])!== false) ?  "checked" : "" )?>></td>
			<td bgcolor='#EAEAEA' align='center'><input type="checkbox" id="jefePrecep_<?=$fila79['dni']?>" name="jefesPreceptor[]" value="<?=$fila79['username']?>"  <?=((array_search('10',$roles[$fila79['username']])!== false) ?  "checked" : "" )?>></td>
			<td bgcolor='#EAEAEA' align='center'><input type="checkbox" id="tutor_<?=$fila79['dni']?>" name="tutores[]" value="<?=$fila79['username']?>"  <?=((array_search('15',$roles[$fila79['username']])!== false) ?  "checked" : "" )?>></td>

			<!-- Version anterior -->
			<!-- <td <?PHP if (array_search('1',$roles[$fila79['username']])!== false) echo "style='background-color: lightblue'" ?>></td>
			<td <?PHP if (array_search('11',$roles[$fila79['username']])!== false) echo "style='background-color: lightblue'" ?>></td>
			<td <?PHP if (array_search('10',$roles[$fila79['username']])!== false) echo "style='background-color: lightblue'" ?>></td>
			<td <?PHP if (array_search('15',$roles[$fila79['username']])!== false) echo "style='background-color: lightblue'" ?>></td> -->

<?
	echo "</tr>";

	}
?>
<script>
	const arrayPreceptores = document.getElementsByName('preceptores[]')
	
	if (arrayPreceptores) { // Verifica si se encontraron elementos con ese nombre
	arrayPreceptores.forEach(preceptor => { // Itera sobre la colección
		preceptor.addEventListener('change', function() {
		// Accede al valor del checkbox que cambió
		console.log(preceptor.value); // Valor del checkbox
		console.log(preceptor.checked); // Si está checked o no (true/false)

		// Si necesitas todos los valores de los checkboxes checked
		const valoresSeleccionados = Array.from(arrayPreceptores) // Convertir a array
			.filter(checkbox => checkbox.checked) // Filtrar solo los checked
			.map(checkbox => checkbox.value); // Mapear a sus valores
		console.log("Valores seleccionados:", valoresSeleccionados);

		});
	});
	}
</script>

<button class="floatingButton" name="nuevosPermisos" type="submit">Guardar cambios</button>
</table>
</form>
</div>



<?
$_SESSION['usu'] = $usuarios;

}

else { //vuelve a abrir la pagina actual si se desconecta
	$ref = base64_encode($_SERVER['REQUEST_URI']);
	$ref = 'Location: i_admin.php?ref=' . $ref;
	header($ref);
	exit;
}?>

