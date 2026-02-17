<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion3.php';

//esto pasa las mayusculas acentuadas a minusculas acentuadas
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


?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<script type="text/javascript" language="JavaScript1.2" src="../csjs/stm31.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../csjs/images.js"></script>
<link href="css/calendario.css" type="text/css" rel="stylesheet">
<script src="js/calendar.js" type="text/javascript"></script>
<script src="js/calendar-es.js" type="text/javascript"></script>
<script src="js/calendar-setup.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="shortcut icon" href="../imag/favicon.ico">
<link rel="stylesheet" type="text/css" href="tablacalif.css" />

<title>SID</title>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=300,height=300,scrollbars=NO") 
} 
</script> 
</head>
<?
include 'header.php';
?>
<body background="bgris.gif" >

<p>


<style type="text/css">
<!--
.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.Estilo6 {
	font-size: 16px;
	font-weight: bold;
}
.Estilo7 {font-size: 16px; font-weight: bold; color: #FF0000; }
-->
</style>


<div align="center">
	<table border="0" width="980" bgcolor="#FFFFFF">
		<tr>
			<td>


<div align="center">
			<table border="0" width="980">

<?
if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';
?>	


			</table>
			</div>
		</td>
		</tr>
	</table>
</div>
<?	
// Make a MySQL Connection
mysql_connect("localhost", "root", "msi2010") or die(mysql_error());
mysql_select_db("base_sobral") or die(mysql_error());
//$fecha = date("Y-m-d");






$page=1;
if(isset($_GET['pg']))
{$page = $_GET['pg']; //si el valor pg existe en nuestra url, significa que estamos en una pagina en especifico.
}
if (isset($_GET['fecha'])) {
    $fecha = $_GET['fecha'];
} else {
    $fecha = date("Y-m-d"); 
	}
echo "<form method='GET' action='alumnosptes.php'>";

$ano=date("Y");


$sql1 = "SELECT ac.dni,CONCAT(ac.apellido, ' ', ac.nombre) as alumno,c.curso,c.divi,af.tipo,af.injus FROM alumno ac,alumnos_faltas af, cursa c WHERE c.control='1' AND c.anio='$ano' AND ac.dni=af.dni AND ac.dni=c.alumno AND af.fecha='$fecha' AND af.injus='5' ORDER BY alumno,c.curso,c.divi";
$resulte = mysql_query($sql1);
$conteo = mysql_num_rows($resulte);
$max_num_paginas = intval($conteo/20); //en esto caso 25
$sql = "SELECT ac.dni,CONCAT(ac.apellido, ' ', ac.nombre) as alumno,c.curso,c.divi,af.tipo,af.injus FROM alumno ac,alumnos_faltas af, cursa c WHERE c.control='1' AND c.anio='$ano' AND ac.dni=af.dni AND ac.dni=c.alumno AND af.fecha='$fecha' AND af.injus='5' ORDER BY alumno,c.curso,c.divi LIMIT ".(($page-1)*20).",20";
$result = mysql_query($sql);


echo "<input type='submit' name='actualizar' value='Actualizar'/>";
echo  "</br></br>";
for($i=0; $i<=$max_num_paginas;$i++){
         echo "<a href='alumnostarde.php?pg=".($i+1)."&fecha=".$fecha."'>".($i+1)."</a> | ";
      }      

echo  "<table border='1' id='customers' style='width: 50%;'>";
echo  "<tr>";
echo  "<th>DNI</th>";
echo  "<th>Nombre y Apellido</th>";
echo  "<th>Curso</th>";
echo  "<th>Division</th>";
echo  "<th>Materia</th>";
echo  "<th>Tipo</th>";
echo  "<th>Borrar</th>";
echo  "<th>Tarde 0.25</th>";
echo  "<th>Tarde 0.50</th>";
echo  "<th>Ausente con Perm.</th>";
echo  "<th>Justificado</th>";
echo  "<th>Injustificado</th>";
echo  "</tr></br>";

echo "<input type='hidden' name='fecha' value='".$fecha."'/>";

while ($row = mysql_fetch_assoc($result))
            {
				if ($row['injus']==1)
				{$injus='Injustificada';}
				if ($row['injus']==0)
				{$injus='Justificada';}
				if ($row['injus']==2)
				{$injus='Tarde 0.25';}
				if ($row['injus']==3)
				{$injus='Ausente con Perm.';}
				if ($row['injus']==4)
				{$injus='Tarde 0.5';}
			if ($row['injus']==5)
				{$injus='Pendiente';}
			
				echo "<td width=100 align=center>".$row['dni']."</td>";
                echo "<td width=300>".$row['alumno']."</td>";
				echo "<td width=50 align=center>".$row['curso']."</td>";
				echo "<td width=50 align=center>".$row['divi']."</td>";
				echo "<td width=50 align=center>".$row['tipo']."</td>";
				echo "<td width=50 align=center>".$injus."</td>";
				echo "<td align=center><input type='radio' name='t[".$row['dni']."]' value='B'></td>";
			    echo "<td align=center><input type='radio' name='t[".$row['dni']."]' value='T1'></td>";
			    echo "<td align=center><input type='radio' name='t[".$row['dni']."]' value='T2'></td>";
				echo "<td align=center><input type='radio' name='t[".$row['dni']."]' value='AP'></td>";
				echo "<td align=center><input type='radio' name='t[".$row['dni']."]' value='J'></td>";
				echo "<td align=center><input type='radio' name='t[".$row['dni']."]' value='I'></td>";
				
				echo "<input type='hidden' name='d[".$row['dni']."]' value='".$row['dni']."'/>";
				echo "<input type='hidden' name='tipo[".$row['dni']."]' value='".$row['tipo']."'/>";
				echo "<input type='hidden' name='i[".$row['dni']."]' value='".$row['injus']."'/>";
                              
            }
echo "</table>";
echo  "</br></br>";
echo "<input type='hidden' name='pg' value='".$page."'/>";
echo "<input type='hidden' name='fecha' value='".$fecha."'/>";
echo "<input type='submit' name='actualizar' value='Actualizar'/>";
echo  "</br></br>";
for($i=0; $i<=$max_num_paginas;$i++){
         echo "<a href='alumnostarde.php?pg=".($i+1)."&fecha=".$fecha."'>".($i+1)."</a> | ";
      }      
echo "</form>";




$aver=$_GET['actualizar'];
//echo "$aver";
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['actualizar']) && $_GET['actualizar'] == 'Actualizar') 
{

foreach ($_GET['d'] as $d) 
{$rb=$_GET['t'][$d];
 $tpo=$_GET['tipo'][$d];
 $ij=$_GET['i'][$d];
 $fec=$_GET['fecha'];
 $page = $_GET['pg'];
// echo "$ij";
 /*echo "$rb";
 echo "$tpo";*/

	
		if ($rb=='T1')
		{$sql = "UPDATE alumnos_faltas SET injus='2' WHERE dni='".$d."' AND tipo='".$tpo."' AND fecha='".$fec."'" ;
         //echo $sql;
		 $result = mysql_query($sql);
		
		 }
		 
		 if ($rb=='T2')
		{$sql = "UPDATE alumnos_faltas SET injus='4' WHERE dni='".$d."' AND tipo='".$tpo."' AND fecha='".$fec."'" ;
         //echo $sql;
		 $result = mysql_query($sql);
		 
		 }
		 
		if ($rb=='B')
		{$sql = "DELETE FROM alumnos_faltas WHERE dni='".$d."' AND tipo='".$tpo."' AND fecha='".$fec."'";
         $result = mysql_query($sql);
		 }
		 
		 if ($rb=='AP')
		{$sql = "UPDATE alumnos_faltas SET injus='3' WHERE dni='".$d."' AND tipo='".$tpo."' AND fecha='".$fec."'" ;
         //echo $sql;
		 $result = mysql_query($sql);
		 
		 }
		 
		 if ($rb=='J')
		{$sql = "UPDATE alumnos_faltas SET injus='0' WHERE dni='".$d."' AND tipo='".$tpo."' AND fecha='".$fec."'" ;
         //echo $sql;
		 $result = mysql_query($sql);}
		 
		 if ($rb=='I')
		{$sql = "UPDATE alumnos_faltas SET injus='1' WHERE dni='".$d."' AND tipo='".$tpo."' AND fecha='".$fec."'" ;
         $result = mysql_query($sql);}
		 
	
}
				
	
	
	?>
		<script>
			var answer=alert("Se han modificado los registros seleccionados")
		</script> 	
				
				
	<?
	
//	echo "<meta http-equiv='refresh' content='0; URL='alumnosptes.php?fecha='".$fec."'&pg=".$page."'>";
    echo "<meta http-equiv='refresh' content='0; URL=alumnosptes.php?fecha=" . urlencode($fec) . "&pg=" . $page . "'>";

	exit;
	}






}?>



















