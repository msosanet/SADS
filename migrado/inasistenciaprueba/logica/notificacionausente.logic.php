
<?PHP

session_start();
if ($_SESSION['estado']==1) { 

include 'conexion3.php';
include 'conexion4.php';
$dni=$_GET['dnix'];
$fechafalta=$_GET['fechaxxx'];
$materia=$_GET['materiax'];
$curso=$_GET['cursox'];
$turno=$_GET['turnox'];
$observaciones=$_GET['observacionex'];
$observaciones=$_GET['observacionex'];
$tipo=$_GET['tipox'];
$vista=$_GET['vistax'];

if ($tipo=='A'){$movi='inasistencia';}
if ($tipo=='T'){$movi='tardanza';}


//$numero=$_GET['numero'];
if ($turno=='M'){$turno='Mañana';}
if ($turno=='T'){$turno='Tarde';}
if ($turno=='V'){$turno='Vespertino';}



//$conexionx = conectarx ();
$conexion = conectar ();

$result = mysql_query ("SELECT CONCAT(D.apellido, ' ', D.nombre) as nombredoc,D.direccion,D.numero,D.piso,D.depto FROM docente D WHERE D.dni = '$dni'");
$fila = mysql_fetch_array($result) ;

$nya=$fila['nombredoc'];
$domicilio=$fila['direccion']." ".$fila['numero'];


//***********************************NOTIFICACION**********************************************************************
$enlace = mysql_connect('localhost', 'root', '');
if (!$enlace) {
    die('No se pudo conectar: ' . mysql_error());
}
mysql_select_db('sid');

$agente=$_SESSION['usuario'];
$anio=strftime('%Y',strtotime($fechafalta));
$asunto="FALTA - ".$nya." FECHA: ".$fechafalta." MATERIA: ".$materia." CURSO: ".$curso. " TURNO: ".$turno;

$result = mysql_query ("SELECT * FROM notificaciones WHERE descripcion='$asunto' AND anio='$anio'");
$fila = mysql_fetch_array($result);
$numero=$fila['codigo'];

//echo $vista;
if($vista=="N")
{	
	if ($fila['codigo']=='')
	{$resultado=mysql_query ("INSERT INTO notificaciones VALUES (0,'$asunto','$agente','$anio')") or die(mysql_error());
	$numero=mysql_insert_id();
	}
}


//*************************************************************************************************************************

//esto pasa las mayusculas acentuadas a minssdsdsdusculas acentuadas
function strtolowerExtended($str)
{
        $low = array(chr(193) => chr(225), //á
                    chr(201) => chr(233), //é
                    chr(205) => chr(237), //í­
                   chr(211) => chr(243), //ó
                   chr(218) => chr(250), //ú
                  chr(220) => chr(252), //ü
                    chr(209) => chr(241)  //ñ
                    );
 
      return strtolower(strtr($str,$low)); 
} 

}
//numero de notificacion,apellido y nombre, dni, domicilio, fecha de inasistencia, curso de la inasistencia, turno del curso, 

/*$diae=date(l);
$dian=date(d);
$mes=date(F);
$ano=date(Y);*/
setlocale(LC_TIME, 'spanish');
$diae=strftime('%A',strtotime(date(l)));
$dian=strftime('%d',strtotime(date(l)));
$mes=strftime('%B',strtotime(date(l)));
$ano=strftime('%Y',strtotime(date(l)));

$faltadiae=strftime('%A',strtotime($fechafalta));
$faltadian=strftime('%d',strtotime($fechafalta));
$faltames=strftime('%B',strtotime($fechafalta));
$faltaano=strftime('%Y',strtotime($fechafalta));



?>


