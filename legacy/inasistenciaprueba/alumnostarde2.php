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


<?PHP

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
	
// Make a MySQL Connection
mysql_connect("localhost", "root", "msi2010") or die(mysql_error());
mysql_select_db("base_sobral") or die(mysql_error());
//$fecha = date("Y-m-d");

if (isset($_GET['fecha']))
{$fecha=$_GET['fecha'];


$dni=$_GET['dni'];

$page=1;
if(isset($_GET['pg']))
{$page = $_GET['pg']; //si el valor pg existe en nuestra url, significa que estamos en una pagina en especifico.
}
//echo "$fecha";
echo "<form method='GET' action='alumnostarde2.php?fecha=$fecha&dni=$dni'>";

$ano=date("Y");

if (isset($_GET['dni']))
{
$dni=$_GET['dni'];
//echo $dni;
$sql1 = "SELECT ac.dni,CONCAT(ac.apellido, ' ', ac.nombre) as alumno,c.curso,c.divi,af.tipo,af.injus,af.justificado FROM alumno ac,alumnos_faltas af, cursa c WHERE ac.dni=af.dni AND ac.dni=c.alumno AND c.control='1' AND c.anio='$ano' AND ac.dni='$dni' AND af.fecha='$fecha' ORDER BY alumno,c.curso,c.divi";
//echo $sqll;
$result = mysql_query($sql1);
$conteo = mysql_num_rows($result);
echo $conteo;

}



echo  "</br></br>";
for($i=0; $i<=$max_num_paginas;$i++){
         echo "<a href='alumnostarde2.php?fecha=".$fecha."&dni=".$dni."'></a>";
      }      

echo  "<table border='1'>";
echo  "<tr>";
echo  "<th>DNI</th>";
echo  "<th>Nombre y Apellido</th>";
echo  "<th>Curso y Division</th>";
echo  "<th>Materia</th>";
//echo  "<th>Tipo</th>";
echo  "<th>Borrar</th>";
echo  "<th>Tarde 0.25</th>";
echo  "<th>Tarde 0.50</th>";
echo  "<th>Ausente con Perm.</th>";
echo  "<th>Presente</th>";
echo  "<th>Ausente</th>";
echo  "<th>Injustificada</th>";
echo  "</tr></br>";

echo "<input type='hidden' name='fecha' value='".$fecha."'/>";

while ($row = mysql_fetch_assoc($result))
            {
				
			echo "Injus: ".$row['injus'];
				echo "<td width=100 align=center>".$row['dni']."</td>";
                echo "<td width=300>".$row['alumno']."</td>";
				echo "<td width=50 align=center>".$row['curso'].$row['divi']."</td>";
				echo "<td width=50 align=center>".$row['tipo']."</td>";
				//echo "<td width=50 align=center>".$injus."</td>";
				echo "<td align=center><input type='radio' name='t[".$row['dni']."]' value='B'></td>";
				if ($row['injus']==2)
				{$injus='Tarde 0.25';
				 echo "<td align=center><input type='radio' name='t[".$row['dni']."]' value='T1' checked></td>";}
				else
				{echo "<td align=center><input type='radio' name='t[".$row['dni']."]' value='T1'></td>";}
				
				if ($row['injus']==4)
				{$injus='Tarde 0.5';
                 echo "<td align=center><input type='radio' name='t[".$row['dni']."]' value='T2' checked></td>";}
				 else
				{echo "<td align=center><input type='radio' name='t[".$row['dni']."]' value='T2'></td>";}
				
				
				if ($row['injus']==3)
				{$injus='Ausente con Perm.';
				echo "<td align=center><input type='radio' name='t[".$row['dni']."]' value='AP' checked></td>";
				}
				else
				{echo "<td align=center><input type='radio' name='t[".$row['dni']."]' value='AP'></td>";}	
				
				if ($row['injus']==1)
				{$injus='Presente';
			    echo "<td align=center><input type='radio' name='t[".$row['dni']."]' value='P' checked></td>";}
				else
				{echo "<td align=center><input type='radio' name='t[".$row['dni']."]' value='P'></td>";}
					 
				if ($row['injus']==0)
				{$injus='Ausente';
				echo "<td align=center><input type='radio' name='t[".$row['dni']."]' value='A' checked></td>";}
				else
				{echo "<td align=center><input type='radio' name='t[".$row['dni']."]' value='A'></td>";}
				
							
				
				if ($row['justificado']=='1')
				{echo "<td align='center'><input  type='checkbox' checked name='just[".$row['dni']."]' value='1'></td></tr>";}
				else 
				{echo "<td align='center'><input  type='checkbox' name='just[".$row['dni']."]' value='1'></td></tr>";}
				echo "<input type='hidden' name='d[".$row['dni']."]' value='".$row['dni']."'/>";
				echo "<input type='hidden' name='tipo[".$row['dni']."]' value='".$row['tipo']."'/>";
				echo "<input type='hidden' name='i[".$row['dni']."]' value='".$row['injus']."'/>";
				echo "<input type='hidden' name='dni' value='".$row['dni']."'/>";
                              
            }
echo "</table>";
echo  "</br></br>";
echo "<input type='hidden' name='pg' value='".$page."'/>";
echo "<input type='submit' name='actualizar' value='Actualizar'/>";
echo  "</br></br>";
for($i=0; $i<=$max_num_paginas;$i++){
         echo "<a href='alumnostarde2.php?fecha=".$fecha."&dni=".$dni."'></a>";
      }      
echo "</form>";




/*$aver=$_GET['actualizar'];
echo "$aver";*/
if (isset($_GET['actualizar']))
{

foreach ($_GET['d'] as $d) 
{	$tpo=$_GET['tipo'][$d];
	$rb=$_GET['t'][$d];
 
 $ij=$_GET['i'][$d];
 $fec=$_GET['fecha'];
 $injus=$_GET['just'][$d];
 $page = $_GET['pg'];
// echo "$ij";
 /*echo "$rb";
 echo "$tpo";*/
if ($injus=='')
{$injus=0;	 } 

//echo "checkbox:".$injus;
//echo $rb;	
		
	
	
		if ($rb=='T1')
		{$sql = "UPDATE alumnos_faltas2 SET injus='2',justificado='".$injus."' WHERE dni='".$d."' AND tipo='".$tpo."' AND fecha='".$fec."'" ;
         //echo $sql;
		 $result = mysql_query($sql);
		// echo "<meta http-equiv='refresh' content='0'; URL='http://inasistencias.colegiosobral.edu.ar/alumnostarde.php?fecha='".$fec."'>";
		 }
		 
		 if ($rb=='T2')
		{$sql = "UPDATE alumnos_faltas2 SET injus='4',justificado='".$injus."' WHERE  dni='".$d."' AND tipo='".$tpo."' AND fecha='".$fec."'" ;
         //echo $sql;
		 $result = mysql_query($sql);
		 
		 }
		 
		if ($rb=='B')
		{$sql = "DELETE FROM alumnos_faltas2 WHERE dni='".$d."' AND tipo='".$tpo."' AND fecha='".$fec."'";
         $result = mysql_query($sql);
		 }
		 
		 if ($rb=='AP')
		{$sql = "UPDATE alumnos_faltas2 SET injus='3',justificado='".$injus."' WHERE dni='".$d."' AND tipo='".$tpo."' AND fecha='".$fec."'" ;
         //echo $sql;
		 $result = mysql_query($sql);
		 
		 }
		 
		 if ($rb=='P')
		{$sql = "UPDATE alumnos_faltas2 SET injus='1',justificado='0' WHERE dni='".$d."' AND tipo='".$tpo."' AND fecha='".$fec."'" ;
         //echo $sql;
		 $result = mysql_query($sql);}
		 
		 if ($rb=='A')
		{$sql = "UPDATE alumnos_faltas2 SET injus='0',justificado='".$injus."' WHERE dni='".$d."' AND tipo='".$tpo."' AND fecha='".$fec."'" ;
		//echo $sql;
         $result = mysql_query($sql);}
	
}
				
	//http://inasistencias.colegiosobral.edu.ar/alumnostarde.php?fecha=2018-06-26&ver=Mostrar
	
	?>

<meta http-equiv='refresh' content='5'; URL='javascript:history.back()'>
		
				
	<?


//http://inasistencias.colegiosobral.edu.ar/alumnostarde.php?fecha=2021-5-19&dni=49229845
//echo "<input type='hidden' name='fecha' value='".$fecha."'/>";

				
				//echo "<meta http-equiv='refresh' content='0'; URL='alumnostarde.php?fecha='".$fec."'>";
	
	

//echo "<meta http-equiv='refresh' content='0'; URL='alumnostarde2.php?fecha=".$fec."&dni=".$d."&pg=1&actualizar=Actualizar'>";
//echo "alumnostarde2.php?fecha=".$fec."&dni=".$d."&pg=1&actualizar=Actualizar";
	}






}}?>

