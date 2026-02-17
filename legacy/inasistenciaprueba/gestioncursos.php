<?PHP
session_start();
if ($_SESSION['estado']==1) { 





include 'conexion3.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

/* Button used to open the contact form - fixed at the bottom of the page */
.open-button {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}

//--------------------------------------------------------
.caja {
   margin:20px auto 40px auto;	
   border:1px solid #d9d9d9;
   height:30px;
   overflow: hidden;
   width: 230px;
   position:relative;
}
select {
   background: #f1f1f1;
   border: none;
   font-size: 14px;
   height: 45px;
   padding: 5px;
   width: 275px;
}
select:focus{ outline: none;}

.caja::after{
	content:"\025be";
	display:table-cell;
	padding-top:7px;
	text-align:center;
	width:30px;
	height:30px;
	background-color:#d9d9d9;
	position:absolute;
	top:0;
	right:0px;	
	pointer-events: none;
}
</style>








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


//INSERTA NUEVO CURSO

if (isset($_GET["descripcion"]))
{	
$curso=$_GET["curso"];
$division=$_GET["division"];
$descripcion=$_GET["descripcion"];
$turno=$_GET["turno"];
$idcurso=$curso.$division;
$sql="UPDATE curso2 SET descripcion='$descripcion',turno='$turno' WHERE idcurso='$idcurso'";	
}
else
{
	if (isset($idcurso))
{$sql="INSERT INTO curso2 VALUES ('$idcurso','$descripcion','$turno','$curso','$division','0')";	}
}
//echo $sql;
mysql_query ($sql);

//VACIA HORARIO
if (isset($_GET["accion"]))
{	
$curso=$_GET["curso"];
$sql="DELETE FROM matcur WHERE idcurso='$curso'";	
mysql_query ($sql);
$sql2="DELETE FROM horariox WHERE idcurso='$curso'";	
mysql_query ($sql2);


}






//HABILITA - DESHABILITA
if (isset($_GET["curso"]) AND isset($_GET["valor"]) )
{	
$curso=$_GET["curso"];
$mov=$_GET["valor"];
$sql="UPDATE curso2 SET habilitado='$mov' WHERE idcurso='$curso'";	
//echo $sql;
mysql_query ($sql);
}
?>
<body>
<?

if (isset($_GET["agregar"]))
{	


//echo $_GET["turno"];

if (isset($_GET["turno"]))
{
$modif="Modificar Curso";

}
else
{
$modif="Agregar Curso";
}



//VACIAR HORARIO










?>


<button class="open-button" onclick="openForm()"><?echo $modif;?></button>


<div class="form-popup" id="myForm">
  <form action="gestioncursos.php" class="form-container">
    <h1>Agregar Cursos</h1>

    <label for="email"><b>Descripcion</b></label>
    <input type="text" placeholder="Descripcion del Curso" name="descripcion"  value=<?echo $_GET["descripcion"];?> required >

    <label for="psw"><b>Curso</b></label>
    <input type="text" placeholder="Curso" name="curso" value=<?echo $_GET["curso"];?> required >
	
	<label for="psw"><b>Division</b></label>
    <input type="text" placeholder="Division" name="division" value=<?echo $_GET["division"];?> required >
	
	<div class="caja">
	<label for="psw"><b>Turno</b></label>
    <select name="turno" id="turnos" class="custom-select">
		<option <?if ($_GET["turno"]=='M'){echo "selected";}?> value="M">Ma&ntilde;ana</option>
		<option <?if ($_GET["turno"]=='T'){echo "selected";}?> value="T">Tarde</option>
		<option <?if ($_GET["turno"]=='V'){echo "selected";}?> value="V">Vespertino</option>
		<option <?if ($_GET["turno"]=='E'){echo "selected";}?> value="E">Escuela Tecnica</option>
	</select>
	</div>
	<br>
	

    <button type="submit" class="btn">Guardar</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Cerrar</button>
  </form>
</div>
<?



}



?>








<form method="GET" action="gestioncursos.php">

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
	
				
					<?
				/*if (isset($_GET['muestra2']))
{ */

$_pagi_sql="SELECT c.descripcion ,c.habilitado,c.idcurso,c.turno,c.curso,c.division FROM curso2 c WHERE idcurso!='999' ORDER BY c.turno,c.curso,c.division,c.descripcion ASC";




$_pagi_cuantos=100;
$_pagi_conteo_alternativo = true;
$_pagi_nav_num_enlaces=10;
include("paginator.inc.php"); 
?>
<p align="left"><?
echo"$_pagi_navegacion"; 
?>
<br><br>
</p><?

$cont=0;		?> <table border="1" width="450" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<tr>
							<td class="text1b"background="../imag/bar07.gif"  colspan="1" height="40" align="center">CURSOS</td>
							<td colspan="3" width="70" height="35" align="center"><a href="gestioncursos.php?agregar=true"><img src=agregar.png width="48" height="48" alt=<?echo $alt;?> onclick="div_show()" ></img></a></td>
						</tr>




						<tr>
							<td width="150" bgcolor="#808080" align="center" height="36">Curso</td>	
							<td width="25" bgcolor="#808080" align="center" height="36">Turno</td>							
							<td width="35" bgcolor="#808080" align="center" height="36">Hab/Deshab</td>
							<td width="35" bgcolor="#808080" align="center" height="36">Vaciar Horario</td>
				
							
						</tr>

		<?php while ($fila2 = mysql_fetch_array($_pagi_result))
		{
				
						if ($fila2[habilitado]==1)
	 					{$color="#0DBB04";
						 $imagen="deshabilitado.png";
						 $valor=0;
						 $alt="Deshabilitar";
						 
						 }
							else
						{$color="#EB1500";
						 $imagen="habilitado.png";	
						 $valor=1;
						 $alt="Habilitar";}
	?>
						<tr>
							<td width="150" bgcolor="<?echo $color;?>" align="left"><a href="gestioncursos.php?agregar=true&descripcion='<?echo $fila2[descripcion];?>'&curso=<?echo $fila2[curso];?>&division=<?echo $fila2[division];?>&turno=<?echo $fila2[turno];?>"><?echo $fila2[descripcion];?></a></td>
							<td width="25" bgcolor="<?echo $color;?>" align="CENTER"><?echo $fila2[turno];?></td>
							<td width="25" bgcolor="#EAEAEA" align="center"><a href="gestioncursos.php?curso=<?echo $fila2[idcurso];?>&valor=<?echo $valor;?>"><img src=<?echo $imagen;?> width="32" height="32" alt=<?echo $alt;?>></img></a></td>
							<td width="25" bgcolor="#EAEAEA" align="center"><a href="gestioncursos.php?curso=<?echo $fila2[idcurso];?>&accion='vaciar' ". onclick = "if (! confirm('Seguro?')) { return false; }"><img src="horariocancel.png" width="32" height="32" alt="vaciar horario"></img></a></td>
							
						
						
						</tr>
						<?
		}
						?>
						</table><?
//}
	?>					
					</p>
					<p align="center">&nbsp;</td>
				</tr>


			</table>
			</div>
			<?
			include 'footer.php';
			?>

			</td>
		</tr>
	</table>
</div>



</form>
 </td>

</div>

<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>



</body>

</html>
<? } ?>