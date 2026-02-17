<?PHP

session_start();

include 'conexion.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt);
if (!mysql_num_rows($resultt)) {
	$ref = base64_encode($_SERVER['REQUEST_URI']);
	$ref = 'Location: i_admin.php?ref=' . $ref;
	header($ref);
	exit;
}

$nomDia = ["Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"];
$borran_movimientos = ['lrosales','ariviere','goicof','gmfer'];

?>

<?
include 'header.php';
$conexion = conectar ();
$actor=$_GET["actor"];


//BORRA MOVIMIENTO DEL DOCENTES
if (isset($_GET['idel'], $_GET['actor']) && !empty($_GET['idel']) && is_numeric($_GET['idel']) && !empty($_GET['actor']) && ($_SESSION['usuario']=='lrosales' OR $_SESSION['usuario']=='ariviere' ))
{
   $borramov="DELETE FROM alta_baja WHERE id='$_GET[idel]'";
   if (mysql_query($borramov))
	{?>
			<script>
			var answer=alert("Listo! Si te equivocaste dps vemos!")
			</script>
			<meta http-equiv='refresh' content='0; URL=leg_unif.php?actor=<?echo $actor;?>'>
			<?}
}


//BORRA MOVIMIENTO DEL DOCENTES
if (isset($_GET['idela'], $_GET['actor']) && !empty($_GET['idela']) && is_numeric($_GET['idela']) && !empty($_GET['actor']) && ($_SESSION['usuario']=='lrosales' OR $_SESSION['usuario']=='ariviere' OR $_SESSION['usuario']=='goicof' OR $_SESSION['usuario']=='gmfer' ))
{
   $borralic="DELETE FROM alta_baja WHERE id='$_GET[idela]'";
   if (mysql_query($borralic))
	{?>
			<script>
			var answer=alert("Listo! Si te equivocaste dps vemos!")
			</script>
			<meta http-equiv='refresh' content='0; URL=leg_unif.php?actor=<?echo $actor;?>'>
			<?}
}

if (isset($_GET['idelb'], $_GET['actor']) && !empty($_GET['idelb']) && is_numeric($_GET['idelb']) && !empty($_GET['actor']) && ($_SESSION['usuario']=='lrosales' OR $_SESSION['usuario']=='goicof' OR $_SESSION['usuario']=='gmfer' ))
{
   $borramovx="DELETE FROM ausentes2 WHERE codigo='$_GET[idelb]'";
   if (mysql_query($borramovx))
	{?>
			<script>
			var answer=alert("Listo! Si te equivocaste dps vemos!")
			</script>
			<meta http-equiv='refresh' content='0; URL=leg_unif.php?actor=<?echo $actor;?>'>
			<?}
}




if (isset($_GET["borracargobtn"])) {

$dni=$_GET['actor'];
$cargow=$_GET['cargo'];
$id=$_GET['id'];
$actor=$dni;
mysql_query ("DELETE FROM doc_cargo WHERE dni='$dni' and id='$id' AND idcargo='$cargow' ");
//echo "DELETE FROM doc_cargo WHERE dni='$dni' and id='$id' AND idcargo='$cargow' ";
//echo $dni."-".$cargow. "-".$id;
}


$resultt = mysql_query ("SELECT * FROM docentes WHERE dni = '$actor'");
$filatt = mysql_fetch_array($resultt);

$__fnac = explode("-",$filatt['f_nac']);
$filatt['f_nac'] = checkdate($__fnac[1],$__fnac[2],$__fnac[0]) ? $filatt['f_nac'] : "";

$result100 = mysql_query ("SELECT * FROM legajo WHERE dni = '$actor'");


$resulttipo = mysql_query ("SELECT * FROM estados order by descripcion asc ");


$caja = mysql_query ("SELECT * FROM archivo WHERE docente = '$actor'");
$caja = mysql_fetch_array($caja) ;

$titulo = $filatt['apellido'] . " " . $filatt['nombre'] . " - " . $filatt['dni'];

$hayerrores = 0;

  $flag = 0;
  if (isset($_GET["submitx"])) {
     // verifico los errores en los campos

	 if (trim($_GET["apellido"]) == '' ) { $errorapellido = 1; $hayerrores = 1; }
	 if (trim($_GET["nombre"]) == '' ) { $errornombre = 1; $hayerrores = 1; }
	 if (trim($_GET["direccion"]) == '' ) { $errordireccion = 1; $hayerrores = 1; }
	 if (trim($_GET["numero"]) == '' ) { $errornumero = 1; $hayerrores = 1; }

$result = mysql_query ("SELECT * FROM formulario where numero=$form");
$fila = mysql_fetch_array($result) ;

}
 else
  {
    $flag = 1;
  }

if ($hayerrores OR $flag) {
	$color = "";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<head>

<html lang="es" xml:lang="es" xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style2.css" />
<?/*<link href="css/calendario.css" type="text/css" rel="stylesheet">
<script src="js/calendar.js" type="text/javascript"></script>
<script src="js/calendar-es.js" type="text/javascript"></script>
<script src="js/calendar-setup.js" type="text/javascript"></script>
<script src="js/ordenTabla.js" type="text/javascript"></script> */?>

<style>
.plazaActivaConFin {
	background-image : url('data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cdefs%3E%3Cpattern%20id%3D%22a%22%20width%3D%22180%22%20height%3D%22180%22%20patternUnits%3D%22userSpaceOnUse%22%3E%3Crect%20width%3D%22100%25%22%20height%3D%22100%25%22%20fill%3D%22%232b2b31%22%2F%3E%3Cpath%20fill%3D%22none%22%20stroke%3D%22%23ecc94b%22%20stroke-linecap%3D%22square%22%20d%3D%22M150.23%20130.374c0-2.188-3.881-1.812-3.881-4.605m3.882%2013.818c0-2.19-3.882-1.812-3.882-4.605m3.882-4.608c0%202.19-3.882%201.814-3.882%204.607m3.882%204.606c0%202.19-3.882%201.814-3.882%204.607m-35.991-41.154c2.19%200%201.812-3.884%204.605-3.884m-13.818%203.884c2.19%200%201.812-3.884%204.606-3.884m4.607%203.884c-2.19%200-1.812-3.884-4.605-3.884m-4.608%203.884c-2.19%200-1.812-3.884-4.605-3.884M21.05%2066.402c2.19%200%201.813-3.885%204.606-3.885m-13.818%203.885c2.19%200%201.812-3.885%204.605-3.885m4.608%203.885c-2.19%200-1.814-3.885-4.607-3.885m-4.606%203.885c-2.19%200-1.814-3.885-4.607-3.885m47.994%2075.119c0-2.19-3.885-1.814-3.885-4.608m3.885%2013.82c0-2.19-3.885-1.813-3.885-4.606m3.885-4.606c0%202.19-3.885%201.812-3.885%204.605m3.885%204.606c0%202.19-3.885%201.814-3.885%204.607m97.826-80.36c2.19%200%201.812-3.883%204.605-3.883m-13.818%203.885c2.19%200%201.813-3.885%204.606-3.885m4.605%203.885c-2.19%200-1.81-3.885-4.605-3.885m-4.606%203.885c-2.19%200-1.812-3.885-4.605-3.885m31.852%2094.213c2.19%200%201.812-3.883%204.605-3.882m-13.818%203.882c2.19%200%201.814-3.882%204.607-3.882m4.606%203.882c-2.19%200-1.812-3.882-4.605-3.882m-4.608%203.882c-2.19%200-1.812-3.883-4.605-3.883M41.406%209.465c0-2.19-3.884-1.812-3.884-4.605m3.884%2013.818c0-2.19-3.884-1.812-3.884-4.606m3.884-4.607c0%202.19-3.884%201.812-3.884%204.605m3.884%204.608c0%202.19-3.884%201.812-3.884%204.607m64.386-18.083c0-2.19-3.885-1.815-3.885-4.608m3.885%2013.82c0-2.19-3.885-1.812-3.885-4.607m3.885-4.605c0%202.189-3.885%201.81-3.885%204.605m3.885%204.607c0%202.19-3.885%201.812-3.885%204.605m-30.82-7.937A5.03%205.03%200%200%201%2062.16%206.06a5.03%205.03%200%200%201%205.043-5.019M7.405%2045.548a5.03%205.03%200%200%201%205.02-5.043%205.03%205.03%200%200%201%205.02%205.043m43.014%2040.944a5.043%205.043%200%200%201%2010.086%200M13.09%20171.46a5.03%205.03%200%200%201-5.043-5.02%205.03%205.03%200%200%201%205.043-5.021m96.36-9.155a5.03%205.03%200%200%201%203.119%206.396%205.03%205.03%200%200%201-6.41%203.09m28.36-107.946a5.03%205.03%200%200%201-5.044-5.02%205.03%205.03%200%200%201%205.043-5.02%22%2F%3E%3Cpath%20fill%3D%22none%22%20stroke%3D%22%23f44034%22%20stroke-linecap%3D%22square%22%20d%3D%22M43.252%20112.826h10.03v10.03h-10.03zm.504-64.041h10.03v10.032h-10.03zm71.83%20126.286h10.36v10.364h-10.362zm0-180h10.36V5.435h-10.362zm41.584%2048.7h10.032V53.8H157.17zM39.069%2086.482l-5.759-3.317-5.76-3.32.006%206.644.003%206.65%205.754-3.33zm122.355-67.748-5.76-3.32.006%206.646.003%206.648%205.754-3.329%205.755-3.327zM35.178%20148.58l-6.419%201.725-6.42%201.725%204.704%204.695%204.703%204.7%201.716-6.42zm32.26-86.787%204.704%204.695%204.703%204.698%201.716-6.42%201.716-6.425-6.419%201.727zm88.992%2029.392-6.42%201.725%204.703%204.695%204.702%204.7%201.716-6.423%201.718-6.423zm-34.374%2038.037-3.318%205.76-3.32%205.76%206.646-.006%206.648-.004-3.329-5.754zm40.62%2010.188%206.645-.004%206.648-.003-3.327-5.756-3.328-5.755-3.318%205.76zM94.921%2037.268l-3.318%205.758-3.32%205.76%206.646-.006%206.648-.003-3.327-5.755z%22%2F%3E%3Cpath%20fill%3D%22none%22%20stroke%3D%22%2300bdd6%22%20stroke-linecap%3D%22square%22%20d%3D%22m140.713%20114.267%204.533-4.831m.15%204.681-4.831-4.533M57.649%2035.92l4.533-4.834m.15%204.681L57.5%2031.233m79.46%20126.872%204.534-4.833m.15%204.681-4.833-4.533m-19.662-92.964%204.533-4.834m.15%204.683-4.833-4.533m54.627%2012.015%204.533-4.833m.15%204.683-4.833-4.533M2.278%2029.303l4.535-4.833m.15%204.681-4.835-4.533m2.26%20119.69%204.535-4.833m.15%204.681-4.834-4.533M63.2%20105.456l4.534-4.833m.15%204.683-4.833-4.534m67.392-9.386%208.037-8.037M8.406%2010.08l8.04-8.038m58.495%20147.46%208.037-8.038m-37.222%2029.998H57.12m55.914-143.766h11.367m50.037%2052.838h11.367m-191.367%200H5.806m106.38%2032.845h11.366M46.146%2067.925l5.907%209.71%22%2F%3E%3Cpath%20fill%3D%22none%22%20stroke%3D%22%238059d4%22%20stroke-linecap%3D%22square%22%20d%3D%22M168.72%20180.021a5.043%205.043%200%200%201-5.043%205.043%205.043%205.043%200%200%201-5.043-5.043%205.043%205.043%200%200%201%205.043-5.043%205.043%205.043%200%200%201%205.043%205.043zm0-180a5.043%205.043%200%200%201-5.043%205.043%205.043%205.043%200%200%201-5.043-5.043%205.043%205.043%200%200%201%205.043-5.043A5.043%205.043%200%200%201%20168.72.021zm-80.538%20118.63a5.043%205.043%200%200%201-5.043%205.042%205.043%205.043%200%200%201-5.043-5.043%205.043%205.043%200%200%201%205.043-5.043%205.043%205.043%200%200%201%205.043%205.043zm-72.57-.23a5.043%205.043%200%200%201-5.043%205.043%205.043%205.043%200%200%201-5.043-5.043%205.043%205.043%200%200%201%205.043-5.043%205.043%205.043%200%200%201%205.043%205.043Zm68.39-95.77a5.043%205.043%200%200%201-5.042%205.044%205.043%205.043%200%200%201-5.043-5.043%205.043%205.043%200%200%201%205.043-5.043%205.043%205.043%200%200%201%205.043%205.043zm25.48%2056.276a5.043%205.043%200%200%201-5.042%205.043%205.043%205.043%200%200%201-5.044-5.043%205.043%205.043%200%200%201%205.043-5.041%205.043%205.043%200%200%201%205.041%205.041zm-22.26%2092.556a5.043%205.043%200%200%201-5.045%205.043%205.043%205.043%200%200%201-5.043-5.043%205.043%205.043%200%200%201%205.043-5.043%205.043%205.043%200%200%201%205.045%205.043zm87.142-61.77a1.986%201.986%200%201%201-2.115-3.36%201.986%201.986%200%200%201%202.115%203.36zm-28.059-70.765a1.986%201.986%200%201%201-2.115-3.36%201.986%201.986%200%200%201%202.115%203.36zm-109.258.987a1.985%201.985%200%201%201-2.115-3.36%201.985%201.985%200%200%201%202.115%203.36zm-20.352%2062.52a1.986%201.986%200%201%201-2.115-3.362%201.985%201.985%200%200%201%202.115%203.36zM88.28%2085.65a1.985%201.985%200%201%201-2.115-3.36%201.985%201.985%200%200%201%202.115%203.36zm15.65%2054.638a1.985%201.985%200%201%201-2.114-3.36%201.985%201.985%200%200%201%202.115%203.36z%22%2F%3E%3C%2Fpattern%3E%3C%2Fdefs%3E%3Crect%20width%3D%22800%25%22%20height%3D%22800%25%22%20fill%3D%22url(%23a)%22%2F%3E%3C%2Fsvg%3E');
}

.plazaInactiva {
	background-image : url('data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cdefs%3E%3Cpattern%20id%3D%22a%22%20width%3D%2236%22%20height%3D%2236%22%20patternUnits%3D%22userSpaceOnUse%22%3E%3Crect%20width%3D%22100%25%22%20height%3D%22100%25%22%20fill%3D%22%23f47434%22%2F%3E%3Cpath%20fill%3D%22none%22%20stroke%3D%22%23f4a734%22%20stroke-linecap%3D%22square%22%20stroke-width%3D%22.5%22%20d%3D%22M3.445%203.624a5%205%200%200%201-6.89%200m8.973%204.709a10%2010%200%200%201-11.056%200m2.083%2024.043a5%205%200%200%201%206.89%200m-8.973-4.709a10%2010%200%200%201%2011.056%200M39.444%203.624a5%205%200%200%201-6.889%200m8.973%204.709a10%2010%200%200%201-11.056%200m2.082%2024.043a5%205%200%200%201%206.891%200m-8.973-4.709a10%2010%200%200%201%2011.056%200m-20.082-6.043a5%205%200%200%201-6.891%200m0-7.247a5%205%200%200%201%206.89%200m2.083%2011.956a10%2010%200%200%201-11.056.001m0-16.666a10%2010%200%200%201%2011.056-.001%22%2F%3E%3Cpath%20fill%3D%22none%22%20stroke%3D%22%23f43434%22%20stroke-linecap%3D%22square%22%20stroke-width%3D%22.5%22%20d%3D%22M21.624-3.445a5%205%200%200%201%200%206.89m-7.247%200a5%205%200%200%201%200-6.89m11.956-2.083a10%2010%200%200%201%20.001%2011.056m-16.666%200a10%2010%200%200%201-.002-11.056m11.958%2038.083a5%205%200%200%201%200%206.89m-7.247%200a5%205%200%200%201-.001-6.89m11.956-2.083a10%2010%200%200%201%20.002%2011.056m-16.666%200a10%2010%200%200%201-.002-11.056M3.624%2014.555a5%205%200%200%201%200%206.891m4.71-8.974a10%2010%200%200%201-.001%2011.056m24.042-2.082a5%205%200%200%201%20.001-6.891m-4.71%208.974a10%2010%200%200%201%200-11.056%22%2F%3E%3C%2Fpattern%3E%3C%2Fdefs%3E%3Crect%20width%3D%22800%25%22%20height%3D%22800%25%22%20fill%3D%22url(%23a)%22%2F%3E%3C%2Fsvg%3E');
}
</style>


<title><?=$titulo?> DATOS DOCENTES</title>

   <script>
        function toggleColumn(index, tableId) {
            var table = document.getElementById(tableId);
            var isCollapsed = table.rows[0].cells[index].style.width === '1px';

            for (var row of table.rows) {
                var cell = row.cells[index];
                if (isCollapsed) {
                    cell.style.width = '';
                    cell.style.minWidth = '';
                    cell.style.maxWidth = '';
                    cell.style.overflow = '';
                } else {
                    cell.style.width = '1px';
                    cell.style.minWidth = '1px';
                    cell.style.maxWidth = '1px';
                    cell.style.overflow = 'hidden';
                }
            }
        }


		function isColumnVisible(columnIndex, tableId) {
			var table = document.getElementById(tableId);
			var headerCell = table.rows[0].cells[columnIndex];
			return headerCell.style.display !== 'none';
		}


    </script>




</head>
<body>
<form method="GET" action="<?=$_SERVER['PHP_SELF']?>">


<div align="center" style="max-width: 980px">
<?
if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';
?>

	<table border="0" width="980" bgcolor="#FFFFFF">
			<table border="0" width="980">
				<tr>


					<td>

					<p align="left" class="text1b">MODIFICACION DE DATOS</p>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, están marcado con color ROJO</font></h4>";} ?>
</p><div align="left">				<div align="center">

					<table border="0" width="895" id="table1" cellpadding="2" cellspacing="4">


						<tr>


							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">D.N.I.:</td>
							<td bgcolor="#EAEAEA" width="268" align="left"><input type="text" name="actor" size="8" value="<?=$filatt['dni']?>" disabled>
							</td>



							<td width="190" bgcolor="#EAEAEA" align="right">Sexo:
							</td></font>
							<td width="190" bgcolor="#EAEAEA" align="left">
							<select name="sexo">
							 <? if ($filatt['sexo']=='') {$selec = 'Seleccione el Sexo'; } else {$selec = '';}?>

								<option value="<?echo $filatt['sexo'];?>"><?echo $filatt['sexo']; echo $selec;?></option>
								<option value="M">M</option>
								<option value="F">F</option>

   							</select>
							</td>

						</tr>
						<?
	  					if (isset($errorapellido)) { if ($errorapellido==1) $color="#FF0000";}
						else{$color="#000000";}
						?>



								<td width="74" bgcolor="#cccccc" align="right"><font color="<?echo $color;?>">Apellido:</td>
							</font>
							<td bgcolor="#cccccc" width="425" align="left">

							<input type="text" name="apellido" size="40" maxlength="40" value="<? echo $filatt['apellido']; ?>" required />
							</td>
						<?
	  					if (isset($errornombre)) { if ($errornombre==1) $color="#FF0000";}
						else{$color="#000000";}
						?>


								<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Nombre:</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left">

							<input type="text" name="nombre" size="40" maxlength="40" value="<?echo $filatt['nombre']; ?>" required />
							</td>

							<tr>

						<?
	  					if (isset($errordireccion)) { if ($errordireccion==1) $color="#FF0000";}
						else{$color="#000000";}
						?>
							<td width="190" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">
							Calle:</td></font>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="direccion" size="30" maxlength="30" value="<?echo $filatt['direccion'];?>" required /></td>
							</td>



						<?
	  					if (isset($errornumero)) { if ($errornumero==1) $color="#FF0000";}
						else{$color="#000000";}
						?>

							<td width="190" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">

							N&uacute;mero:</td></font>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="numero" size="10" maxlength="10" value="<?echo $filatt['numero'];?>" required /></td>


						</tr>
									<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Piso:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="piso" size="30" maxlength="30" value="<?echo $filatt['piso'];?>" /></td>
							</td>




							<td width="190" bgcolor="#EAEAEA" align="right">
							Depto:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="depto" size="10" maxlength="10" value="<?echo $filatt['depto'];?>" /></td>
							</td>

						</tr>
									<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Barrio:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="barrio" size="30" maxlength="30" value="<?echo $filatt['barrio'];?>" /></td>
							</td>




							<td width="190" bgcolor="#EAEAEA" align="right">
							E-mail:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="mail" size="50" maxlength="500" value="<?echo $filatt['mail'];?>" /></td>
							</td>


							</td>
						</tr>

						<tr>
						<?
	  					if (isset($errortelefono)) { if ($errortelefono==1) $color="#FF0000";}
						else{$color="#000000";}
						?>


							<td width="190" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">
							Tel&eacute;fono:</td></font>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="telefono" size="20" maxlength="20" value="<?echo $filatt['telefono'];?>" /></td>
							</td>



							<td width="190" bgcolor="#EAEAEA" align="right">Tipo:
							</td></font>

							<td width="190" bgcolor="#EAEAEA" align="left"><select size="1" name="tipo">
							<?	WHILE ($myrow6 = mysql_fetch_array($resulttipo))
							{
								if($filatt['identificacion']==$myrow6['codigo']){ $seleccionado=' selected="selected" ';} else $seleccionado=" ";
								echo "<option value=$myrow6[codigo] $seleccionado> $myrow6[descripcion] </option>";
							}
							?></select>
							</td>


						</tr>
						<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Celular:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="celular" size="20" maxlength="20" value="<?echo $filatt['celular'];?>" /></td>
							</td>

							<td width="190" bgcolor="#EAEAEA" align="right">
							Codigo Reloj:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="relojx" size="50" maxlength="50" value="<?echo $filatt['idreloj'];?>" /></td>
							</td>




						</tr>


						<tr>

							<td width="190" bgcolor="#EAEAEA" align="right">Si tiene ambos seleccione CARGO:
							</td></font>
							<td width="190" bgcolor="#EAEAEA" align="left">

								<select name="cargo">
							 <? if ($filatt['cargo']==1) {$selec = 'CARGO'; } else {$selec = 'HORAS';}?>

								<option value="<?echo $filatt['cargo'];?>"><?echo $selec;?></option>
								<option value="1">CARGO</option>
								<option value="0">HORAS</option>

   							</select>

							</td>
							<td width="190" bgcolor="#EAEAEA" align="right">Fecha Nac.
							</td></font>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="date" name="f_nac" size="10" maxlength="10" value="<?=$filatt['f_nac']?>" /></td>

							</td>

						</tr>
						<tr>

							<td width="190" bgcolor="#EAEAEA" align="right">Tribu:
							</td>
							<td width="190" bgcolor="#EAEAEA" align="left">
							 <select name="tribu">
  							  <option value="Onas" <? if ($filatt['tribu'] == "Onas") echo "selected" ?>>Onas</option>
   							  <option value="Yamanas" <? if ($filatt['tribu'] == "Yamanas") echo "selected" ?>>Yámanas</option>
   							  <option value="Espiritu" <? if ($filatt['tribu'] == "Espiritu") echo "selected" ?>>Espíritu</option>
   							  <option value="Sin asignar" <? if ($filatt['tribu'] == "Sin asignar") echo "selected" ?>>Sin asignar</option>
							 </select>
<!--							<input type="text" name="tribu" size="30" maxlength="30" value="<?echo ""?>" /> -->
							</td>

							<td width="190" bgcolor="#EAEAEA" align="right">Título:
							</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="titulo" size="50" maxlength="500" value="<?echo $filatt['titulo'];?>" /></td>

							</td>

						</tr>

						<?php while ($fila100 = mysql_fetch_array($result100))
						{ ?>


						<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Legajo:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><?echo $fila100['legajo'];?></td>
							</td>

							<td width="190" bgcolor="#EAEAEA" align="right">Cargo:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><?echo $fila100['cargo'];?></td>
							</td>

						</tr>
						<? } ?>
									<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Archivo caja:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="archivo" size="4" maxlength="4" value="<?echo $caja['caja'];?>" /></td>
							</td>




							<td width="190" bgcolor="#EAEAEA" align="right">
							</td>
							<td bgcolor="#EAEAEA" width="265" align="left"></td>
							</td>


							</td>
						</tr>
						<tr>
							<td width="834" bgcolor="#EAEAEA" align="left" colspan="4">
							<p align="center"><input type="submit" value="     Actualizar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
						</tr>
					</table>
					<input type="hidden" name="actor" value="<?echo $actor;?>">
					</form>

<br>

<p class="text1b">- <a target="_self" href="altasybajas.php?curso=<? echo "-+-+-+-+-+-"; ?>&dni=<? echo $actor; ?>">CREAR UN MOVIMIENTO</a>---
<a target="_self" href="altasybajas2.php?curso=<? echo "-+-+-+-+-+-"; ?>&dni=<? echo $actor; ?>">CREAR UN MOV. ANTIGUO</a></p>
<br><a href="constserv.php?actor=<?php echo $actor?>" target="_blank"><img src="pdfww.png" alt="exportar" height="48" width="48"></href><BR>CONST. SERVICIO
<br></a>
<br><a href="constserv2.php?actor=<?php echo $actor?>" target="_blank"><img src="pdfww.png" alt="exportar" height="48" width="48"></href><BR>CONST. SERVICIO prueba
<br></a>





<br>
<br>
<?
if (isset($_GET['ancho'])) $ancho=$_GET['ancho']."%";
else $ancho='895';






?>

<table border="1" bordercolor="#000000" style="background-color:#FFFFFF" width="100%" cellpadding="1" cellspacing="0" id="movDoc">

<caption><a href="leg_unif.php?actor=<? echo $actor; ?>&ancho=100">MOVIMIENTOS DEL DOCENTE</a></caption>

<tr>
		<th onclick="">Plaza</th>
		<th onclick="">Hs</th>
		<th onclick="">Materia</th>
		<th onclick="">Cur</th>
		<th onclick="">Div</th>


		<th onclick="toggleColumn(5,'movDoc')">F. Inicio</th>

		<th onclick="">F. Alta</th>
		<th onclick="">F. Baja</th>
		<th onclick="">Caracter</th>
		<th onclick="">Obs.</th>
		<th onclick="">Activo</th>
		<th onclick="">Baja</th>
		<th onclick="">Modificar</th>
<?		if ($_SESSION['usuario']=='lrosales' OR $_SESSION['usuario']=='ariviere' OR $_SESSION['usuario']=='goicof' OR $_SESSION['usuario']=='gmfer' ){ echo "<th onclick=''>Borrar</th>";}







?>
</tr>







<?



$consultasql="SELECT * from alta_baja where fhasta='0000-00-00' and docente='$actor' ORDER BY fdesde DESC";
//echo $consultasql;
	$result911 = mysql_query ($consultasql);
	while ($fila911 = mysql_fetch_array($result911))
		{
			$resultan = mysql_query ("SELECT * FROM caracter WHERE codigo = '$fila911[sit_revista]'");
			$filata = mysql_fetch_array($resultan);


			$nnn = mysql_query ("SELECT * FROM materia_cargo WHERE id = '$fila911[materia]'");
			$fnn = mysql_fetch_array($nnn);

			if ($fila911['enviado']==1) $env="SI";
			else  $env="NO";

			if ($fila911['activa']==1) $act="SI";
			else  $act="NO";

			$fet="";
			if ($fila911['fhasta']=="0000-00-00") $fet="-";
			else  $fet=date("d-m-Y",strtotime($fila911['fhasta']));

			$colorplaza="";
			if ($fet!="-")  $colorplaza="#fdbcaf";


			echo "<tr  bgcolor=".$colorplaza.">";
			echo "<td  align='center'><a href=vermovplaza.php?id=$fnn[id] target='_blank'>".$fnn['plaza']."</a></td>";
			echo "<td  align='center'>".$fnn['cant_hs']."</td>";

			echo "<td  align='center'><a href=vermovplaza.php?id=$fnn[id] target='_blank'>".$fnn['nombre']."</a></td>";

			echo "<td  align='center'>".$fnn['curso']."</td>";
			echo "<td  align='center'>".$fnn['division']."</td>";

			echo "<td onclick='toggleColumn(5,movDoc)'  align='center'>" . date("d-m-Y", strtotime($fila911['finicio'])) . "</td>";

			echo "<td  align='center'>".date("d-m-Y",strtotime($fila911['fdesde']))."</td>";
			echo "<td  align='center'>".$fet."</td>";

			echo "<td  align='center'>".$filata['descripcion']."</td>";
			echo "<td  align='center'>".$fila911['obs']."</td>";
			echo "<td  align='center'>".$act."</td>";
			echo "<td  align='center'><a href=baja_mov.php?id=$fila911[id] title='Hacer click para darle de baja'>Crear baja</a> </td>";
			echo "<td  align='center'><a href=modif_mov.php?id=$fila911[id] title='Hacer click para modificar movimiento'>Editar</a> </td>";

			if ($_SESSION['usuario']=='lrosales' OR $_SESSION['usuario']=='ariviere' OR $_SESSION['usuario']=='goicof' OR $_SESSION['usuario']=='gmfer' ){ echo "<td  align='center'><a href=leg_unif.php?idel=$fila911[id]&actor=$actor title='Hacer click para borrar movimiento' onclick='return confirm(\"¿Leo estás seguro de que queres borrar este movimiento?\");'>Borrar</a> </td>";}

			echo "</tr>";
		}
	$result911 = mysql_query ("SELECT * from alta_baja where fhasta !='0000-00-00' and docente='$actor' ORDER BY fdesde DESC");
	while ($fila911 = mysql_fetch_array($result911))
		{
			$resultan = mysql_query ("SELECT * FROM caracter WHERE codigo = $fila911[sit_revista]");
			$filata = mysql_fetch_array($resultan);


			$nnn = mysql_query ("SELECT * FROM materia_cargo WHERE id = $fila911[materia]");
			$fnn = mysql_fetch_array($nnn);

			if ($fila911['enviado']==1) $env="SI";
			else  $env="NO";

			if ($fila911['activa']==1) $act="SI";
			else  $act="NO";

			$fet="";
			if ($fila911['fhasta']=="0000-00-00") $fet="-";
			else  $fet=date("d-m-Y",strtotime($fila911['fhasta']));

			$colorplaza="#fdbcaf";

			echo "<tr class='plazaInactiva' >";
			echo "<td  align='center'><a href=vermovplaza.php?id=$fnn[id] target='_blank'>".$fnn['plaza']."</a></td>";
			echo "<td  align='center'>".$fnn['cant_hs']."</td>";

			echo "<td  align='center'><a href=vermovplaza.php?id=$fnn[id] target='_blank'>".$fnn['nombre']."</a></td>";

			echo "<td  align='center'>".$fnn['curso']."</td>";
			echo "<td  align='center'>".$fnn['division']."</td>";

			 echo "<td  align='center'>".date("d-m-Y",strtotime($fila911['finicio']))."</td>";


			echo "<td  align='center'>".date("d-m-Y",strtotime($fila911['fdesde']))."</td>";
			echo "<td  align='center'>".$fet."</td>";

			echo "<td  align='center'>".$filata['descripcion']."</td>";
			echo "<td  align='center'>".$fila911['obs']."</td>";
			echo "<td  align='center'>".$act."</td>";
			//echo "<td  align='center'>".$env."</td>";
			echo "<td  align='center'><a href=baja_mov.php?id=$fila911[id] title='Hacer click para darle de baja'>Crear baja</a> </td>";

			echo "<td  align='center'><a href=modif_mov.php?id=$fila911[id] title='Hacer click para modificar movimiento'>Editar</a> </td>";
			if ($_SESSION['usuario']=='lrosales' OR $_SESSION['usuario']=='ariviere' OR $_SESSION['usuario']=='goicof' OR $_SESSION['usuario']=='gmfer' ){ echo "<td  align='center'><a href=leg_unif.php?idel=$fila911[id]&actor=$actor title='Hacer click para borrar movimiento' onclick='return confirm(\"¿Leo estás seguro de que queres borrar este movimiento?\");'>Borrar</a> </td>";}

			echo "</tr>";
		}









echo "</table>";
?>

<br>
<br>


<table border="1" bordercolor="#000000" style="background-color:#FFFFFF" width="100%" cellpadding="1" cellspacing="0">

<tr>
		<td width="895" bgcolor="#EAEAEA" align="center" colspan="11"><font color="FF0000"><b>LICENCIAS DEL DOCENTE</b></font></td>
</tr>


<tr>
		<td bgcolor="#EAEAEA" align="center"><b>ID</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Plaza</b></td>


		<td bgcolor="#EAEAEA" align="center"><b>Materia</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Cur</b></td>

		<td bgcolor="#EAEAEA" align="center"><b>Div</b></td>

		<td bgcolor="#EAEAEA" align="center"><b>F. Inicio</b></td>

		<td bgcolor="#EAEAEA" align="center"><b>F. Fin</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Motivo Lic</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Obs</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Modif.</b></td>




		<td bgcolor="#EAEAEA" align="center"><b>Borrar</b></td>






</tr>

<?




	$resultlic = mysql_query ("SELECT * from ausentes2 where docente='$actor' and plaza != 770 ORDER BY fecha_desde DESC");
	while ($filalic = mysql_fetch_array($resultlic))
		{
if ($filalic[plaza]==0){

			$licen = mysql_query ("SELECT * FROM materia_cargo WHERE id = $filalic[id]");
			$licen2 = mysql_fetch_array($licen);
}
else {
			$licen = mysql_query ("SELECT * FROM materia_cargo WHERE plaza = $filalic[plaza]");
			$licen2 = mysql_fetch_array($licen);
		}

			$leo = mysql_query ("SELECT * FROM caracter WHERE codigo=$filalic[revista]");
			$leo2 = mysql_fetch_array($leo);

			$mot = mysql_query ("SELECT * FROM motivos WHERE codigo = $filalic[motivo]");
			$motivo = mysql_fetch_array($mot);

			$nnn = mysql_query ("SELECT * FROM materia_cargo WHERE id = $filalic[plaza]");
			$fnn = mysql_fetch_array($nnn);

			if ($fila911['enviado']==1) $env="SI";
			else  $env="NO";

			if ($fila911['activa']==1) $act="SI";
			else  $act="NO";

			if ($filalic['fecha_hasta']=="0000-00-00") $fet2="Continua";
			else  $fet2=date("d-m-Y",strtotime($filalic['fecha_hasta']));


			echo "<tr>";

			echo "<td bgcolor='#EAEAEA' align='center'>".$filalic['id']."</td>";

			echo "<td bgcolor='#EAEAEA' align='center'>".$filalic['plaza']."</td>";

			echo "<td bgcolor='#EAEAEA' align='center'>".$licen2['nombre']." - ".$leo2['descripcion']."</td>";

			echo "<td bgcolor='#EAEAEA' align='center'>".$licen2['curso']."</td>";
			echo "<td bgcolor='#EAEAEA' align='center'>".$licen2['division']."</td>";



			echo "<td bgcolor='#EAEAEA' align='center'>".date("d-m-Y",strtotime($filalic['fecha_desde']))."</td>";

			echo "<td bgcolor='#EAEAEA' align='center'>".$fet2."</td>";



			echo "<td bgcolor='#EAEAEA' align='center'>".$motivo['descripcion']."</td>";
			echo "<td bgcolor='#EAEAEA' align='center'>".$filalic[observaciones]."</td>";
			echo "<td bgcolor='#EAEAEA' align='center'><a href=fin_lic.php?id=$filalic[codigo]&docen=$actor title='Hacer click para modificar Lic.'>Fin. Lic</a></td>";
			if ($_SESSION['usuario']=='lrosales' OR $_SESSION['usuario']=='ariviere' OR $_SESSION['usuario']=='goicof' OR $_SESSION['usuario']=='gmfer' ){ echo "<td  align='center'><a href=leg_unif.php?idelb=$filalic[codigo]&actor=$actor title='Hacer click para borrar Lic' onclick='return confirm(\"¿estás seguro de que queres borrar esta licencia?\");'>Borrar</a> </td>";}

			echo "</tr>";
		}








echo "</table>";
?>



				<tr>
					<td>
					<p align="center"><b>ARCHIVOS ASOCIADOS</p></b>

<center>
<table border="1" width="900" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<tr>
<?php

$dir = "ddjj/".$actor."/";

$directorio=opendir($dir);

echo "<br>";
while ($archivo = readdir($directorio)){


 if($archivo=='.' or $archivo=='..' or $archivo=='index.php' or $archivo=='otro.HTM' or $archivo=='Thumbs.db'){
 echo "";
 }else {
 $archivo2=str_replace(" ", "%20",$archivo);
 $enlace = $dir.$archivo2;
    //si el nombre del archivo contiene un punto es una carpeta por lo que no es necesario quitar la extención
        if (strpos($archivo,".")) {
            $NOMBRE = SUBSTR($archivo, 0, -4);
        }else
        {
            $NOMBRE = $archivo;
        }


?><td align="center" width="100" bgcolor="#EEEEEE">
<p style="margin-top: 0; margin-bottom: 0"><a href=<? echo $enlace ?> target="_blank"><img src='pdf.png'height='48' width='48'><br><? echo $NOMBRE ?></a>
</td><?

 }
 }
closedir($directorio);

?>
   </td>
</tr>
</table>

<br>
<br>

</font>

<!-- ******************* NUEVA PROPUESTA DE HORARIO ************************* -->
<div align="center" style="width: 900px; background-color: #ddcccc">

		<table border="3" width="900" bordercolor="#000000" cellspacing="0">
				<tr>
					<td colspan="9" align="center" class="text1b" bgcolor="#BB6666">Horario declarado por <span style="color:white"><? echo $filatt['apellido'] . ", " . $filatt['nombre']; ?></span></td>
				</tr>


				<tr bgcolor="#dddddd">
                    <td align="center"><h1 style='color:black;font-size:16px;'><b>CARGO</b></h1></td>
					<td align="center"><h1 style='color:black;font-size:16px;'><b>Lunes</b></h1></td>
					<td align="center"><h1 style='color:black;font-size:16px;'><b>Martes</b></h1></td>
					<td align="center"><h1 style='color:black;font-size:16px;'><b>Miercoles</b></h1></td>
					<td align="center"><h1 style='color:black;font-size:16px;'><b>Jueves</b></h1></td>
					<td align="center"><h1 style='color:black;font-size:16px;'><b>Viernes</b></h1></td>
					<td align="center"><h1 style='color:black;font-size:16px;'><b>Sabado</b></h1></td>
					<td align="center"><h1 style='color:black;font-size:16px;'><b>Horario</b></h1></td>
			<!--		<td align="center"><h1 style='color:black;font-size:16px;'><b>Acciones</b></h1></td> -->
                </tr>

				<tr>
	<?
	$conexion = conectar ();
	//$qcargos="SELECT DISTINCT dc.id,c.descripcion,dc.idcargo FROM doc_cargo dc, curso c WHERE dc.dni = '$actor'  AND c.codigo=dc.idcargo ORDER BY id ASC";
	$qcargos="SELECT * FROM alta_baja ab,materia_cargo mc WHERE ab.docente='$actor' AND ab.activa='1' AND mc.id=ab.materia AND mc.codigo!='852'";
//echo $qcargos;
	$cargoxxx = mysql_query ($qcargos);

	while ($cargos = mysql_fetch_array($cargoxxx))
	{ echo "<tr bgcolor='FFFFFF'>";
	  $cargoq=$cargos['id'];
	  $codigocurso=$cargos['idcargo'];

		echo "<td align='center'><a href=add_cargos.php?mat=$cargos[materia]><h1 style='color:black;font-size:15px;'>" . $cargos['nombre']."</h1></a></td>";
		//echo "<td align='center'>$cargos[descripcion]</td>";
			for ($i=1;$i<=6;$i++)
			{
				$qhor="SELECT * FROM cargo_horas WHERE idcargo='$cargos[materia]' AND iddia='$i' AND docente='$actor'";
				//echo $qhor;
				$horariox = mysql_query ($qhor);

				$elegidox = mysql_num_rows($horariox);
				/*if ($elegidox==0)
					{echo "<td align='center'>-</td>";}*/
					echo "<td align='center'>";
					while ($horaz = mysql_fetch_array($horariox))
					{
					echo "<h1 style='color:blue;font-size:14px;'>$horaz[entrada]-$horaz[salida]<h1>";
					}
					echo "</td>";
			}

		echo "<td align='center'><a href=add_cargos.php?mat=$cargos[materia]&actor=$actor><img src='calendario.png' alt='Calendario' width='30' height='30'></a></td>";






	?>
	<!-- <td align='center' style='background: white'><a href="leg_unif.php?actor=<?echo $actor;?>&cargo=<?echo $codigocurso;?>&id=<?echo $cargoq;?>&borracargobtn=Si" onclick="if (confirm('Borrar?')){return true;}else{event.stopPropagation(); event.preventDefault();};" title="Borrar">Borrar</a></td> -->
	<?
	echo "</tr>";
	}
	?>
			</tr>





</table>










				</table>
        </td><!-- FIN HORARIOS DEL SABADO -->





    </tr>

<p class="text1b">- <a target="_blank" href="ORIGINALVD.php?actor=<?=$actor?>">VER HORARIO HORAS</a> - <!--<a href="add_cargos.php?actor=<?=$actor?>">AGREGAR HORARIO DE CARGO</a>--></p>
<br>
</div>

<!-- ******************* FIN NUEVA PROPUESTA DE HORARIO ************************* -->

<br> <br> <center><B>DATOS EXTRAIDOS DEL FOX</B><br>
<?




$db2 = mysql_connect("localhost", "fgoicoechea", "sobral2011");
mysql_select_db("DBF2MYSQL",$db2);




if (strlen($actor) < 8)
{

$rest1 = substr($actor, 0, 1);
$rest2 = substr($actor, 1, 3);
$rest3 = substr($actor, 4, 3);

$dnipuntos=$rest1.".".$rest2.".".$rest3;

$dnipuntos="0".$dnipuntos;

}

else
{

$rest1 = substr($actor, 0, 2);
$rest2 = substr($actor, 2, 3);
$rest3 = substr($actor, 5, 3);

$dnipuntos=$rest1.".".$rest2.".".$rest3;

}

$resultxx = mysql_query ("SELECT * FROM licencias WHERE dni = '$dnipuntos' order by desde DESC",$db2);
$result77 = mysql_query ("SELECT * FROM movimientos WHERE dni = '$dnipuntos' ORDER BY curso DESC, division,espcur,alta",$db2);
//$result77 = mysql_query ("SELECT * FROM movimientos WHERE dni = '$dnipuntos' order by causa ASC,baja DESC,alta DESC,espcur DESC",$db2);

$movimientosFox = array();

?>
<table id="movimFox" border="1" width="900" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">

						<tr>
						<th align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Espacio C.</b></th>
						<th align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Caracter</b></th>
						<th align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Alta</b></th>
						<th align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Baja</b></th>
						<th align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Curso/div</b></th>
						<th align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>hs</b></th>
						<th align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Obs.</b></th>
						<th align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Causa</b></th>

					</tr>

		<?php while ($fila77 = mysql_fetch_array($result77))
		{
			if (checkdate(substr($fila77['baja'],5,2),substr($fila77['baja'],8,2),substr($fila77['baja'],0,4)))	$f_baja = date("d-m-Y",strtotime($fila77['baja']));
			else $f_baja = $fila77['baja'];

			$movimientosFox[] = array("materia"=>$fila77['espcur'],"revista"=>$fila77['caracter'],"fAlta"=>date("d-m-Y",strtotime($fila77['alta'])),"fBaja"=>$f_baja,"curso"=>$fila77['curso'],"divi"=>$fila77['division'],"hsCat"=>$fila77['hs'],"obs"=>$fila77['ob'],"estado"=>$fila77['causa']);

			?> <tr <?PHP
			if ($fila77['baja']=="0000-00-00" OR $fila77['baja'] == '') echo 'style="background-color:#DDCCCC">';
			else echo 'style="background-color:#ffffff">';
			if ($fila77['baja']=="0000-00-00") $sumahs=$sumahs+$fila77['hs'];
			?>

						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">

							<? echo $fila77['espcur'];?>
						</p></td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">

							<? echo $fila77['caracter'];?>
						</p></td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">

							<? echo date("d-m-Y",strtotime($fila77['alta']));?>
						</p></td>
						<td align="center" width="82">
						<p style="margin-top: 0; margin-bottom: 0">

							<? echo $f_baja;?>
						</p></td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">

							<? echo $fila77['curso'];?> / <? echo $fila77['division'];?>
						</p></td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">

							<? echo $fila77['hs'];?>
						</p></td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">

							<? echo $fila77['ob'];?>
						</p></td>
						<td align="center" width="82">
						<p style="margin-top: 0; margin-bottom: 0">

							<? echo $fila77['causa'];?>
						</p></td>

					</tr>
		<?}?>

</table>

<?PHP

/*

?>

<script>
 const movFox = { "pokedata":
<?PHP
printf(json_encode($movimientosFox));
?>
 }


</script>

<div class="table-container">
  <table class="data-table">
    <thead>
      <tr>
        <th><button id="espcur">Esp. Curricular</button></th>
        <th><button id="revista">Sit. Revista</button></th>
        <th><button id="fAlta">Alta</button></th>
        <th><button id="fBaja">Baja</button></th>
        <th><button id="curso">Curso</button></th>
        <th><button id="divi">Div.</button></th>
        <th><button id="hsCat">Horas</button></th>
        <th><button id="obs">Obser.</button></th>
        <th><button id="estado">Estado</button></th>
      </tr>
    </thead>
    <tbody id="table-content"></tbody>
  </table>
 </div>
<script>
const tableContent = document.getElementById("table-content")
const tableButtons = document.querySelectorAll("th button");

const createRow = (obj) => {
  const row = document.createElement("tr");
  const objKeys = Object.keys(obj);
  objKeys.map((key) => {
    const cell = document.createElement("td");
    cell.setAttribute("data-attr", key);
    cell.innerHTML = obj[key];
    row.appendChild(cell);
  });
  return row;
};

const getTableContent = (data) => {
  data.map((obj) => {
    const row = createRow(obj);
    tableContent.appendChild(row);
  });
};

const sortData = (data, param, direction = "asc") => {
  tableContent.innerHTML = '';
  const sortedData =
    direction == "asc"
      ? [...data].sort(function (a, b) {
          if (a[param] < b[param]) {
            return -1;
          }
          if (a[param] > b[param]) {
            return 1;
          }
          return 0;
        })
      : [...data].sort(function (a, b) {
          if (b[param] < a[param]) {
            return -1;
          }
          if (b[param] > a[param]) {
            return 1;
          }
          return 0;
        });

  getTableContent(sortedData);
};

const resetButtons = (event) => {
  [...tableButtons].map((button) => {
    if (button !== event.target) {
      button.removeAttribute("data-dir");
    }
  });
};

window.addEventListener("load", () => {
  getTableContent(movFox.pokedata);

  [...tableButtons].map((button) => {
    button.addEventListener("click", (e) => {
      resetButtons(e);
      if (e.target.getAttribute("data-dir") == "desc") {
        sortData(movFox.pokedata, e.target.id, "desc");
        e.target.setAttribute("data-dir", "asc");
      } else {
        sortData(movFox.pokedata, e.target.id, "asc");
        e.target.setAttribute("data-dir", "desc");
      }
    });
  });
});

</script>

<?PHP
*/
?>


<br>

<b>CANTIDAD DE HS: <? if (isset($sumahs)) echo $sumahs;?> se debe controlar las hs en todos los casos</b>


<br><br>
<table border="1" width="900" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">

						<tr>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Legajo</b></td>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Caracter</b></td>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>categoria</b></td>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Desde</b></td>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Hasta</b></td>
						<td align="center" width="100" bgcolor="#EEEEEE">
						<p style="margin-top: 0; margin-bottom: 0"><b>Observ</b></td>


					</tr>

		<?php while ($filaxx = mysql_fetch_array($resultxx)) {
			if (checkdate(substr($filaxx['hasta'],5,2),substr($filaxx['hasta'],8,2),substr($filaxx['hasta'],0,4)))	$lic_hasta = date("d-m-Y",strtotime($filaxx['hasta']));
			else $lic_hasta = $filaxx['hasta'];
		 ?>
					<tr>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">

							<? echo $filaxx['legajo'];?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">

							<? echo $filaxx['caracter'];?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">

							<? echo $filaxx['categoria'];?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">

							<? echo $filaxx['desde'];?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">

							<?=$lic_hasta?>
						</td>
						<td align="center" width="82">
						 <p style="margin-top: 0; margin-bottom: 0">

							<? echo $filaxx['obser'];?>
						</td>







					</tr>
		<?}?>

</table>
<br>
<br>
<br>



<table border="1" bordercolor="#000000" style="background-color:#FFFFFF" width="895" cellpadding="1" cellspacing="0">

<tr>
		<td width="895" bgcolor="#EAEAEA" align="center" colspan="7"><font color="FF0000"><b>REGISTROS DEL RELOJ (ULTIMOS 5)</b></font></td>
</tr>


<tr>
		<td bgcolor="#EAEAEA" width="20%" align="center"><b>Fecha</b></td>
		<td bgcolor="#EAEAEA" width="20%" align="center"><b>Dia</b></td>
		<td bgcolor="#EAEAEA" width="30%" align="center"><b>Hora</b></td>
		<td bgcolor="#EAEAEA" width="30%" align="center"><b>Movimiento</b></td>


</tr>
<?
	mysql_select_db('sid');

	$result80 = mysql_query ("SELECT fecha,horario,tipo FROM diario WHERE dni='$actor' ORDER BY fecha DESC,horario ASC LIMIT 0,10") or die(mysql_error());




	while ($fila81 = mysql_fetch_array($result80))
	{
		$diax=$nomDia[date('w', strtotime($fila81['fecha']))];
		$fechac=date("d/m/Y", strtotime($fila81['fecha']));
		echo "<tr>";
		echo "<td bgcolor='#FFFFFF' align='center'>".$fechac."</td>";
		echo "<td bgcolor='#FFFFFF' align='center'>".$diax."</td>";
		echo "<td bgcolor='#FFFFFF' align='center'>".$fila81['horario']."</td>";
		echo "<td bgcolor='#FFFFFF' align='center'>".$fila81['tipo']."</td>";

		echo "</tr>";


	}



echo "</table>";
?>









            <br>
			<br>
			<br>
			<?
			include 'footer.php';
			?>

			</td>
		</tr>
	</table>
</div>

 </td>

</div>
</div>

</body>
<?
}
else
{
	$nombre=ucwords(strtolower($_GET['nombre']));
	$apellido=strtoupper($_GET['apellido']);
	$direccion=$_GET['direccion'];
	$numero=$_GET['numero'];
	$telefono=$_GET['telefono'];
	$celular=$_GET['celular'];
	$piso=$_GET['piso'];
	$depto=$_GET['depto'];
	$barrio=$_GET['barrio'];
	$mail=$_GET['mail'];
	$tipo=$_GET['tipo'];
	$sexo=$_GET['sexo'];
	$reloj=$_GET['relojx'];
	$cargo=$_GET['cargo'];
	//$fnac=$_GET['f_nac'];
	$fnac = date("Y-m-d", strtotime($_GET['f_nac']));
	$tribu=$_GET['tribu'];
	$titulo=$_GET['titulo'];
	$archivo=$_GET['archivo'];

	$qActualizaDoc = "UPDATE docentes SET nombre='$nombre',apellido='$apellido',direccion='$direccion',mail='$mail',sexo='$sexo',identificacion=$tipo,telefono='$telefono',piso='$piso',depto='$depto',numero=$numero,barrio='$barrio', celular='$celular', idreloj='$reloj', cargo=$cargo, f_nac='$fnac', tribu='$tribu', titulo='$titulo' where dni='$actor'";

if (mysql_query ($qActualizaDoc))
//if (true)
{


$caj = mysql_query ("SELECT * FROM archivo where docente='$actor'");
$yaesta = mysql_num_rows($caj);

if ($yaesta == 0)
{

mysql_query ("INSERT INTO archivo VALUES ('$actor',$archivo)");


}
else mysql_query ("UPDATE archivo SET caja='$archivo' where docente='$actor'");
				?>
				<script>
				var answer=alert("Datos Actualizados Correctamente")
				</script>
				<meta http-equiv='refresh' content='0; URL=leg_unif.php?actor=<?echo $actor;?>'>
						<?
		//printf('<pre>%s</pre>',$qActualizaDoc);
}
				else {
				?>
				<script>
				var answer=alert("No se pudo grabar en la BD")
				</script>
				<meta http-equiv='refresh' content='0; URL=leg_unif.php?actor=<?echo $actor;?>'>
				<?
					}


}
// echo "<!-- " . var_export($_SERVER,true) . " -->";
?>
</html>
