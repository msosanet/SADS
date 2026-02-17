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
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="shortcut icon" href="../imag/favicon.ico">
<link href="css/calendario.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="tablacalif.css" />

<script src="js/calendar.js" type="text/javascript"></script>
<script src="js/calendar-es.js" type="text/javascript"></script>
<script src="js/calendar-setup.js" type="text/javascript"></script>
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

$con = conectar ();

echo "<br>";
echo "<br>";

$curso=$_GET['curso']; //SI TIENE VALOR
$division=$_GET['division'];//IDEM

$sql = "SELECT * FROM curso2 WHERE habilitado='1'order by curso,division ASC";
$result = mysql_query($sql);




echo "<form method='GET' action='boletin.php'>";
echo "Curso: ";

echo "<select name='curso'>";
while ($row = mysql_fetch_assoc($result))
{ if ($curso==$row['idcurso'])
	{echo "<option value=".$row['idcurso']." selected>".$row['descripcion']."</option>";}
  else
	{echo "<option value=".$row['idcurso'].">".$row['descripcion']."</option>";}

}
echo "</select>";





/*echo "<select name='curso'>";
while ($row = mysql_fetch_assoc($result))
{
if ($curso==$row['curso']) //SI YA HABIA UN CURSO SELECCIONADO LO DEJO COMO SELECTED
{echo "<option selected value=".$row['curso'].">".$row['curso']."</option>";}
else
{echo "<option value=".$row['curso'].">".$row['curso']."</option>";}
}
echo "</select>";*/


/*$sql = "SELECT DISTINCT division FROM alumnos_curso WHERE division !='' ORDER BY division ASC";
$result = mysql_query($sql);

//CARGO LAS DIVISIONES RECORDANDO SI HABIA UNA ELEGIDA
echo "Division: ";
echo "<select name='division'>";

while ($row = mysql_fetch_assoc($result))
{ if ($row['division']!=''){
if ($division==$row['division']) //SI YA HABIA UNA DIVISION SELECCIONADA LA DEJO COMO SELECTED
{echo "<option selected value=".$row['division'].">".$row['division']."</option>";}
else
{echo "<option value=".$row['division'].">".$row['division']."</option>";}
}}
echo "</select>";*/







echo "<br>";
echo "<br>";
echo "<br>";

 $meses = array();
 $meses[1] = "Enero";
 $meses[2] = "Febrero";
 $meses[3] = "Marzo";
 $meses[4] = "Abril";
 $meses[5] = "Mayo";
 $meses[6] = "Junio";
 $meses[7] = "Julio";
 $meses[8] = "Agosto";
 $meses[9] = "Septiembre";
 $meses[10] = "Octubre";
 $meses[11] = "Noviembre";
 $meses[12] = "Diciembre";
 
 if (isset($_GET['mes'])) 
 {$mex = $_GET['mes'];}
else
 {$mex=date("m");}
 
 
   echo "Seleccione Mes: ";
   echo "<select name=\"mes\">";           
   for($mes=1; $mes<=12; $mes++){ //si es el mes en curso lo marca como selected
      if ($mex == $mes){
         echo "<option value=\"$mes\" selected>$meses[$mes]</option>";
      }
      else {
         echo "<option value=\"$mes\">$meses[$mes]</option>";
      }
   }
   echo"</select>";


echo "<input type='submit' name='mostrar' value='Ver Planilla Asistencia'/>";


//echo "['".$row['fecha']."', ".$row['total'].", ".$row['tipo']".],";

if (isset($_GET['mostrar']))
{ 
$curso=substr($_GET['curso'], 0,1);
$division=substr($_GET['curso'], 1);
$mess = $_GET['mes']; //traigo el mes seleccionado
$year  = date(Y);
$day   = date(d);
$mec = date(m); //mes en curso

if (isset($_GET['mes'])) {
    $mess = $_GET['mes'];
}

$days = cal_days_in_month(CAL_GREGORIAN, $mess, $year); //CANTIDAD DE DIAS DEL MES SELECCIONADO

echo "<br>";
echo "<br>";echo "<br>";
echo "<br>";

echo "<h2>PLANILLA DE ASISTENCIA $mess-$year</h2>";
echo "<h3>Cantidad de dias del mes: $days </h3>";

$re=$mec-$mess;

if ($re==0) //si estamos en el mes en curso solo recorre hasta los dias que hayan pasado
{$days=date(d);	}
//CARGO LOS DIAS DEL MES

if ($re<0)//si el mes en curso es mayor no busca nada porque todavia no deberia haber novedades. esto puede cambiar mas adelante
{$days=0;	}
 
 
 
echo "<table border='1' id='customers' style='width: 75%;'>";
echo "<tablehead>";
echo "<tr>";
echo "<th width='15%'>Alumno</th>";
for ($j = 1; $j <= $days; $j++) {
    
	echo "<th>$j/$mess</th>";
}
echo "<th>Total A. Justificadas</th>";
echo "<th>Total A. Injustificadas</th>";
echo "<th>Total Ausencias (I+J+T)</th>";
echo "<th>Total Presentes</th>";
echo "<th>%</th>";
echo "</tr>";
echo "</tablehead>";
//TRAE LOS ALUMNOS DEL CURSO Y DIVISION SELECCIONADO
$ano=date("Y");
$alumnos = mysql_query("SELECT CONCAT(a.apellido,  ' ', a.nombre) as alumno,a.dni FROM alumno a, cursa c WHERE c.alumno=a.dni AND c.curso='$curso' AND c.divi='$division' AND c.anio='$ano' AND c.control='1' ORDER BY alumno ASC") or die(mysql_error());
while($row = mysql_fetch_assoc($alumnos)) { 
echo "<tr>";
echo "<td>";
echo "<a href='ver_alu.php?actor=".$row['dni']."' target='_blank'>".$row['alumno']."</a>"; 
echo "</td>";
$dni=$row['dni'];

$presente=0;
$ausentec=0;
$finde=0;
$injust=0;
$just=0;
$tarde=0;
//$z=1;
//$days = cal_days_in_month(CAL_GREGORIAN, $month, $year); //CANTIDAD DE DIAS DEL MES SELECCIONADO

for ($z = 1; $z <= $days; $z++) 
{ $flag=0;
  $fecha="$year-$mess-$z";
  $dia=date("w",mktime(0,0,0,$mess,$z,$year));
			
					
			
			
			//CADA ALUMNO TIENE UN TURNO EN LA TABLA ALUMNOS, DEBERIA CREAR UNA TABLA CON LA FECHA Y EL TURNO DE LA "SUSPENSION" DE ACTIVIDADES, 
			//SI EL ALUMNO ES DE TURNO X Y HAY SUSPENSION EN TURNO X ENTONCES INDICAR "SA" Y QUE NO CUENTE PARA LA ESTADISTICA DE ASISTENCIA. 
			//ya esta creada la tabla hay que hacer el abm para las suspensiones asi lo pueden cargar los preceptores ya de paso hacemos para los feriados. "asuetos y suspension de actividades"
			
			
				if($dia=='0')//DOMINGO MARCA COMO FINDE
				{  
					$flag=1;
					echo "<td align='center' bgcolor='#f0f8ff'>D</td>";
				}	
				
				if($dia=='6')//SABADO MARCA COMO FINDE
				{  $flag=1;
					echo "<td align='center' bgcolor='#f0f8ff'>S</td>";
				}	
				
				$feriado=mysql_query("SELECT * FROM feriados WHERE fecha='$fecha'");
				$feri = mysql_num_rows($feriado);
					
				if ($feri>'0'&& $flag=='0') //SI HAY ALGUN REGISTRO ES FERIADO
				{ $flag=1;
				  echo "<td align='center' bgcolor='#f0f8ff'>F</td>";}	


				
				if ($flag=='0')
				{ //SI NO ES FINDE
			
					
				
					$ausentex=mysql_query("SELECT * FROM alumnos_faltas WHERE fecha='$fecha' AND dni='".$row['dni']."'");
					$total = mysql_num_rows($ausentex);
					$rowz = mysql_fetch_assoc($ausentex);
					/*echo "SELECT * FROM alumnos_faltas WHERE fecha='$fecha' AND dni='".$row['dni']."'";
					echo $total;
					echo $dia;
					echo "<br>";*/
					//echo $total;
					if ($total=='0') //SI NO HAY REGISTRO ESTA PRESENTE
						{echo "<td align='center' bgcolor='#00FF00'>P</td>";
						 $presente++;
						}	
						
					if ($total=='1') //hay un registro de ausencia
						{ 
					
							if ($rowz['tipo']=="EF") //es educacion fisica?
							{ 		//echo "pase";			 
								if ($rowz['injus']=="1") //si es injustificada
								{$ausentec=$ausentec+0.5;
						         $injust=$injust+0.5;
								 $presente=$presente+0.5;
								 echo "<td align='center' bgcolor='#ffd700'><a href='alumnostarde.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>P/AI</a></td>";	}	
								if ($rowz['injus']=="0") //si es justificada
								{$ausentec=$ausentec+0.5;
								 $just=$just+0.5;
								 $presente=$presente+0.5;
								 echo "<td align='center' bgcolor='#ffd700'><a href='alumnostarde.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>P/AJ</a></td>"; }	
								if ($rowz['injus']=="2") //si es tarde 0.25f
								{$ausentec=$ausentec+0.25;
								 $presente=$presente+0.75;				
								 echo "<td align='center' bgcolor='#ffd700'><a href='alumnostarde.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>P/T</a></td>";}
								 if ($rowz['injus']=="4") //si es tarde 0.5f
								{$ausentec=$ausentec+0.50;
								 $presente=$presente+0.50;				
								 echo "<td align='center' bgcolor='#ffd700'><a href='alumnostarde.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>P/TT</a></td>";}
								if ($rowz['injus']=="3") //si es ausente con permanencia
								{$ausentec=$ausentec+1;
								 $presente=$presente+0;				
								 echo "<td align='center' bgcolor='#ffd700'><a href='alumnostarde.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>P/T</a></td>";}
							}
							if ($rowz['tipo']=="General") //ES GENERAL
							{	
								if ($rowz["injus"]=="1")
								{$ausentec=$ausentec+1;
								 $injust++;
								 echo "<td align='center' bgcolor='#ff0000'><a href='alumnostarde.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>AI</a></td>";
								}	
								if ($rowz['injus']=="3") //si es ausente con permanencia
								{$ausentec=$ausentec+1;
								 $presente=$presente+0;				
								 echo "<td align='center' bgcolor='#ffd700'><a href='alumnostarde.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>AP</a></td>";}
								if ($rowz["injus"]=="0")
								{$ausentec=$ausentec+1;
								 $just++;
								 echo "<td align='center' bgcolor='#ff0000'><a href='alumnostarde.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>AJ</a></td>";}	
								if ($rowz["injus"]=="2")
								{$ausentec=$ausentec+0.25;
								 $presente=$presente+0.75;				
								 echo "<td align='center' bgcolor='#ffd700'><a href='alumnostarde.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>T</a></td>";}	
								if ($rowz["injus"]=="4")
								{$ausentec=$ausentec+0.50;
								 $presente=$presente+0.50;				
								 echo "<td align='center' bgcolor='#ffd700'><a href='alumnostarde.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>TT</a></td>";}									 
							} //ELSE SI NO ES EF
						} //SI ES 1
				

					
		 				if ($total==2) //hay dos registros de inasistencia de ef y gral
						{$fi=0;
						 $fj=0;
						 $fap=0;
						 $ft=0;
						 $ftt=0;
						 $ausentez=mysql_query("SELECT * FROM alumnos_faltas WHERE fecha='$fecha' AND dni='".$row['dni']."'");
							while($rowp = mysql_fetch_assoc($ausentez)) 
							{ 
								if ($rowp["injus"]=='1') //injustificada
								{$ausentec=$ausentec+1;
								 $injust++;
								 $fi++;	 }	
								 
								if ($rowp["injus"]=='0') //justificada
								{
								 $ausentec=$ausentec+1;
								 $just++;
								 $fj++;
								}	
								if ($rowp["injus"]=='2') //tarde
								{$ft++;
								 $injust=$injust+0.25;
								 $ausentec=$ausentec+0.25;
								 $presente=$presente+0.75;
								}
								if ($rowp["injus"]=='3') //aus con perm
								{$ausentec=$ausentec+1;
								 $presente=$presente+0;
								 $injust=$injust+1;
								 $fap++;	 }	
								 
								if ($rowp["injus"]=='4') //aus con perm
								{$ausentec=$ausentec+0.5;
								 $presente=$presente+0.5;
								 $injust=$injust+0.5;
								 $ftt++;	 }	
								
								
								
							}
								if ($fi==2)
								{echo "<td align='center' bgcolor='#ff0000'><a href='alumnostarde.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>AI|AI</a></td>";}
								if ($fj==2)
								{echo "<td align='center' bgcolor='#ff0000'><a href='alumnostarde.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>AJ|AJ</a></td>";}
								if ($ft==2)
								{echo "<td align='center' bgcolor='#d78100'><a href='alumnostarde.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>T|T</a></td>";}
								if ($ftt==2)
								{echo "<td align='center' bgcolor='#d78100'><a href='alumnostarde.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>TT|TT</a></td>";}
								if ($fi==1 && $fj==1)
								{echo "<td align='center' bgcolor='#ff0000'><a href='alumnostarde.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>AI|AJ</a></td>";}
								if ($fi==1 && $ft==1)
								{echo "<td align='center' bgcolor='#ff0000'><a href='alumnostarde.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>AI|T</a></td>";}
								if ($fi==1 && $fap==1)
								{echo "<td align='center' bgcolor='#ff0000'><a href='alumnostarde.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>AI|AP</a></td>";}
								if ($fi==1 && $ftt==1)
								{echo "<td align='center' bgcolor='#ff0000'><a href='alumnostarde.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>AI|TT</a></td>";}
								if ($fj==1 && $ft==1)
								{echo "<td align='center' bgcolor='#ff0000'><a href='alumnostarde.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>AJ|T</a></td>";}
								if ($fj==1 && $ftt==1)
								{echo "<td align='center' bgcolor='#ff0000'><a href='alumnostarde.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>AJ|TT</a></td>";}
								if ($fj==1 && $fap==1)
								{echo "<td align='center' bgcolor='#ff0000'><a href='alumnostarde.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>AJ|AP</a></td>";}
								if ($fap==2)
								{echo "<td align='center' bgcolor='#ff0000'><a href='alumnostarde.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>AP|AP</a></td>";}
								if ($fap==1 && $ft==1)
								{echo "<td align='center' bgcolor='#ff0000'><a href='alumnostarde.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>AP|T</a></td>";}
								if ($fap==1 && $ftt==1)
								{echo "<td align='center' bgcolor='#ff0000'><a href='alumnostarde.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>AP|TT</a></td>";}
								if ($ft==1 && $ftt==1)
								{echo "<td align='center' bgcolor='#d78100'><a href='alumnostarde.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>T|TT</a></td>";}
							
							
							
						} 
	
	
				} 


}//aca termina el for
echo "<td>";
echo $just; 
echo "</td>";
echo "<td>";
echo $injust; 
echo "</td>";
echo "<td>";
echo $ausentec; 
echo "</td>";
echo "<td>";
echo $presente; 
echo "</td>";
$porcentajex=($presente/($ausentec+$presente))*100;
$porcentaje = number_format($porcentajex, 2, '.', '');
echo "<td>";
echo $porcentaje; 
echo "</td>";
//}}
echo "</tr>";
}//ACA TERMINA EL WHILE
echo "</table>";

  

echo "<br>";
echo "<br>";
echo "<br>";echo "<br>";
echo "<br>";
echo "<br>";

}









if (isset($_GET['enviar']))
{ 
//$hoy = date("Y-m-d");
//$hoy = date('Y-m-d', strtotime($hoy));
/*$hoy=$_GET['fecha'];
$materia=$_GET['materia'];*/
foreach ($_GET['ausentes'] as $checkbox) 
{
//$sql = "INSERT INTO alumnos_faltas VALUES ('$checkbox','$hoy','$materia')";
//mysql_query($sql);
}?>
<script>var answer=alert("Datos Guardados")</script> 
<?
}

echo "</form>";

}?>



















