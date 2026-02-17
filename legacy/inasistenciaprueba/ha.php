<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta type="text/javascript" language="JavaScript1.2" src="../csjs/stm31.js"></script>
<script http-equiv="Content-Type" content="text/html; charset=windows-1252"></script>
<script type="text/javascript" language="JavaScript1.2" src="../csjs/images.js"></script>
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="shortcut icon" href="../imag/favicon.ico">
<title></title>




</head>
<?
include 'header.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
//$dni=$_GET["actor"];
//$resultdocente = mysql_query ("SELECT * FROM alumnos where dni='$dni'");
//$filadocente = mysql_fetch_array($resultdocente); 
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
$filatt = mysql_fetch_array($resultt) ;
?>

<body background="bgris.gif" >

<?
if ($_SESSION['valor']==1)
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



$alumnos = mysql_query("SELECT * FROM asignaturas") or die(mysql_error());
while($row = mysql_fetch_assoc($alumnos)) 
{
$materia=$row['espcur'];
$curso=$row['curso'];
$division=$row['division'];
$docente=$row['nombre'];
$turno=$row['turno'];
$lu1=$row['lu1'];
$lu2=$row['lu2'];
$lu3=$row['lu3'];
$lu4=$row['lu4'];
$lu5=$row['lu5'];
$lu6=$row['lu6'];
$lu7=$row['lu7'];
$lu8=$row['lu8'];
$ma1=$row['ma1'];
$ma2=$row['ma2'];
$ma3=$row['ma3'];
$ma4=$row['ma4'];
$ma5=$row['ma5'];
$ma6=$row['ma6'];
$ma7=$row['ma7'];
$ma8=$row['ma8'];
$mi1=$row['mi1'];
$mi2=$row['mi2'];
$mi3=$row['mi3'];
$mi4=$row['mi4'];
$mi5=$row['mi5'];
$mi6=$row['mi6'];
$mi7=$row['mi7'];
$mi8=$row['mi8'];
$ju1=$row['ju1'];
$ju2=$row['ju2'];
$ju3=$row['ju3'];
$ju4=$row['ju4'];
$ju5=$row['ju5'];
$ju6=$row['ju6'];
$ju7=$row['ju7'];
$ju8=$row['ju8'];
$vi1=$row['vi1'];
$vi2=$row['vi2'];
$vi3=$row['vi3'];
$vi4=$row['vi4'];
$vi5=$row['vi5'];
$vi6=$row['vi6'];
$vi7=$row['vi7'];
$vi8=$row['vi8'];

$docnom=explode(",",$docente);
echo $docnom[0];
echo "<br>";
echo $docnom[1];
echo "<br>";
//echo "<br>";

$resultdni = mysql_query ("select * from docentes WHERE apellido LIKE '%$docnom[0]%' AND nombre LIKE '%$docnom[1]%' ");
$filanotas = mysql_fetch_array($resultdni);
$docdni=$filanotas['dni'];


$dias = array
  (
  array("$lu1","$lu2","$lu3","$lu4","$lu5","$lu6","$lu7","$lu8"),
  array("$ma1","$ma2","$ma3","$ma4","$ma5","$ma6","$ma7","$ma8"),
  array("$mi1","$mi2","$mi3","$mi4","$mi5","$mi6","$mi7","$mi8"),
  array("$ju1","$ju2","$ju3","$ju4","$ju5","$ju6","$ju7","$ju8"),
  array("$vi1","$vi2","$vi3","$vi4","$vi5","$vi6","$vi7","$vi8"),
  );
 

if ($materia !== '' || $division !== '0' || $curso !== '0')
{
	for ($i = 0; $i <= 4; $i++) {
		for ($j = 0; $j <= 7; $j++) {
			if($dias[$i][$j]=='T')
			{$dia=$i+1;
			 $hora=$j+1;
		/*	 $sql = "INSERT INTO horfox VALUES (0,'$materia','$division','$curso','$turno','$dia','$hora','$docente')";
			 mysql_query($sql);*/
			}	

}		
}
}		
}
}
?>
		
</form>
</body>
</html>
