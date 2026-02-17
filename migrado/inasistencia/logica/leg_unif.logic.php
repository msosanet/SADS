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

