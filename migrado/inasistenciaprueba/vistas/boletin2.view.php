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
mysql_connect("localhost", "root", "") or die(mysql_error());
mysql_select_db("base_sobral") or die(mysql_error());

$con = conectar ();

echo "<br>";
echo "<br>";

$curso=$_GET['curso']; //SI TIENE VALOR
$division=$_GET['division'];//IDEM

$sql = "SELECT * FROM curso2 WHERE habilitado='1'order by curso,division ASC";
$result = mysql_query($sql);




echo "<form method='GET' action='boletin2.php'>";
echo "Curso: ";

echo "<select name='curso'>";
while ($row = mysql_fetch_assoc($result))
{ if ($curso==$row['idcurso'])
	{echo "<option value=".$row['idcurso']." selected>".$row['descripcion']."</option>";}
  else
	{echo "<option value=".$row['idcurso'].">".$row['descripcion']."</option>";}

}
echo "</select>";

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
echo "<br>";
echo "<br>";
echo "<br>";

echo "<h2>PLANILLA DE ASISTENCIA $mess-$year</h2>";
echo "<h3>Cantidad de dias del mes: $days </h3>";

$re=$mec-$mess;

if ($re==0) //si estamos en el mes en curso solo recorre hasta los dias que hayan pasado
{$days=date(d);	}
//CARGO LOS DIAS DEL MES

if ($re<0)//si el mes en curso es mayor no busca nada porque todavia no deberia haber novedades. esto puede cambiar mas adelante
{$days=0;	}
 
 
 
echo "<table border='1'>";
echo "<tablehead>";
echo "<tr>";
for ($j = 0; $j <= $days; $j++) {
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
			
					
				//cambiar tabla!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
					$ausentex=mysql_query("SELECT * FROM alumnos_faltas2 WHERE fecha='$fecha' AND dni='".$row['dni']."'");
					$total = mysql_num_rows($ausentex);
					$rowz = mysql_fetch_assoc($ausentex);
					//echo $total;
					if ($rowz['justificado']=="1")
					{$color="FF0000";} //si es injustificado va en rojo
					else 
					{$color="FBFF00";} //sino naranja
					
					if ($total=='0') //SI NO HAY REGISTRO no hubo actividad
						{echo "<td align='center' bgcolor='#00FFAA'>S/A</td>";
						 //$presente++;
						}	
						
					if ($total=='1') //hay un registro de ausencia
						{ $ausentec=0;
					
							if ($rowz['tipo']=="EF") //es educacion fisica?
							{
								if ($rowz['injus']=="1") //si esta presente
								{ echo "<td align='center' bgcolor='#2AFF00'><a href='alumnostarde2.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>P</a></td>";	}	
								if ($rowz['injus']=="0") //si es ausente
								{ echo "<td align='center' bgcolor='#$color'><a href='alumnostarde2.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>P/AJ</a></td>"; }	
								if ($rowz['injus']=="2") //si es tarde 0.25f
								{ echo "<td align='center' bgcolor='#$color'><a href='alumnostarde2.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>P/T</a></td>";}
								 if ($rowz['injus']=="4") //si es tarde 0.5f
								{echo "<td align='center' bgcolor='#$color'><a href='alumnostarde2.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>P/TT</a></td>";}
								if ($rowz['injus']=="3") //si es ausente con permanencia
								{echo "<td align='center' bgcolor='#$color'><a href='alumnostarde2.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>P/T</a></td>";}
							
						/*	if ($rowp["justificado"]=='1') //injustificado
									{$injust=$ausentec+$injust;
									$justi='I';}
								else 
									{$just=$ausentec+$just;
									$justi='J';}
							*/
							}
							
							
							if ($rowz['tipo']=="General") //ES GENERAL
							{	
								if ($rowz['injus']=="1") //si esta presente
								{echo "<td align='center' bgcolor='#2AFF00'><a href='alumnostarde2.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>P</a></td>";	}	
								if ($rowz['injus']=="3") //si es ausente con permanencia
								{echo "<td align='center' bgcolor='#$color'><a href='alumnostarde2.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>AP</a></td>";}
								if ($rowz["injus"]=="0")//ausente
								{echo "<td align='center' bgcolor='#$color'><a href='alumnostarde2.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>A</a></td>";}	
								if ($rowz["injus"]=="2")//T
								{echo "<td align='center' bgcolor='#$color'><a href='alumnostarde2.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>T</a></td>";}	
								if ($rowz["injus"]=="4")//TT
								{echo "<td align='center' bgcolor='#$color'><a href='alumnostarde2.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>TT</a></td>";}									 
							
							
						
							} 
						
						
								
						
						
						} //SI ES 1
				

					
		 				if ($total==2) //hay dos registros de inasistencia de ef y gral
						{$fi=0;
						 $fj=0;
						 $fap=0;
						 $ft=0;
						 $ftt=0;
						 $pres=0;
						 //$presente=0;
						 
						 $ausentez=mysql_query("SELECT * FROM alumnos_faltas2 WHERE fecha='$fecha' AND dni='".$row['dni']."'");
							while($rowp = mysql_fetch_assoc($ausentez)) 
							{ 
															
								if ($rowp["injus"]=='1') //presente
								{$pres++;}	
												
								if ($rowp["injus"]=='3') //aus con perm
								{  $fap++; }	
								
								if ($rowp["injus"]=='0') //ausente
								{$fj++;	}	
								if ($rowp["injus"]=='2') //tarde
								{$ft++;}
								
								if ($rowp["injus"]=='4') //TT
								{$ftt++;	 }	
								
							}
																
								if ($ft==2)
								{echo "<td align='center' bgcolor='#$color'><a href='alumnostarde2.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>T|T</a></td>";}
								if ($ftt==2)
								{echo "<td align='center' bgcolor='#$color'><a href='alumnostarde2.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>TT|TT</a></td>";}
								if ($fj==2)
								{echo "<td align='center' bgcolor='#$color'><a href='alumnostarde2.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>A|A</a></td>";}
								if ($fj==1 && $ft==1)
								{echo "<td align='center' bgcolor='#$color'><a href='alumnostarde2.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>A|T</a></td>";}
								if ($fj==1 && $ftt==1)
								{echo "<td align='center' bgcolor='#$color'><a href='alumnostarde2.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>A|TT</a></td>";}
								if ($fj==1 && $fap==1)
								{echo "<td align='center' bgcolor='#$color'><a href='alumnostarde2.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>A|AP</a></td>";}
								if ($fap==2)
								{echo "<td align='center' bgcolor='#$color'><a href='alumnostarde2.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>AP|AP</a></td>";}
								if ($fap==1 && $ft==1)
								{echo "<td align='center' bgcolor='#$color'><a href='alumnostarde2.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>AP|T</a></td>";}
								if ($fap==1 && $ftt==1)
								{echo "<td align='center' bgcolor='#$color'><a href='alumnostarde2.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>AP|TT</a></td>";}
								if ($ft==1 && $ftt==1)
								{echo "<td align='center' bgcolor='#$color'><a href='alumnostarde2.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>T|TT</a></td>";}
								if ($pres==2)
								{echo "<td align='center' bgcolor='#2AFF00'><a href='alumnostarde2.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>P|P</a></td>";}
								if ($pres==1 && $ft==1)
								{echo "<td align='center' bgcolor='#$color'><a href='alumnostarde2.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>P|T</a></td>";}
								if ($pres==1 && $fj==1)
								{echo "<td align='center' bgcolor='#$color'><a href='alumnostarde2.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>P|A</a></td>";}
								if ($pres==1 && $ftt==1)
								{echo "<td align='center' bgcolor='#$color'><a href='alumnostarde2.php?fecha=".$fecha."&dni=".$dni."' target='_blank'>P|TT</a></td>";}
															
							
						} 
	
	
				} 

}//aca termina el for
$jus=0;
$injus=0;
$ausentec=0;
$presente=0;
echo "<td>";
$juz=mysql_query("SELECT SUM(t.valor) as sum, a.dni FROM tipofalta t, alumnos_faltas2 a WHERE MONTH(a.fecha)=".$mess." AND a.injus=t.id AND a.dni='".$row['dni']."' AND a.justificado='0' AND a.injus!='1' GROUP BY a.dni");
while($rowj = mysql_fetch_assoc($juz)) 
{   $jus=$rowj['sum'];
	echo $jus; }
echo "</td>";


echo "<td>";
$injuz=mysql_query("SELECT SUM(t.valor) as sum, a.dni FROM tipofalta t, alumnos_faltas2 a WHERE MONTH(a.fecha)=".$mess." AND a.injus=t.id AND a.dni='".$row['dni']."' AND a.justificado='1' AND a.injus!='1' GROUP BY a.dni");
while($rowi = mysql_fetch_assoc($injuz)) 
{   $injus=$rowi['sum'];
	echo $injus; }

//echo "SELECT SUM(t.valor) as sum, a.dni FROM tipofalta t, alumnos_faltas2 a WHERE a.injus=t.id AND a.dni=".$row['dni']." AND a.justificado='0' GROUP BY a.dni";
echo "</td>";
echo "<td>";
$ausentec=$jus+$injus;
echo $ausentec; 
echo "</td>";

echo "<td>";
//echo "SELECT SUM(t.valor) as sum, a.dni FROM tipofalta t, alumnos_faltas2 a WHERE a.injus=t.id AND a.dni='".$row['dni']."' AND a.injus='1' GROUP BY a.dni";
$prez=mysql_query("SELECT count(t.valor) as sum, a.dni FROM tipofalta t, alumnos_faltas2 a WHERE MONTH(a.fecha)=".$mess." AND a.injus=t.id AND a.dni='".$row['dni']."' AND a.injus='1' GROUP BY a.dni");
while($rowpr = mysql_fetch_assoc($prez)) 
{   $presente=$rowpr['sum'];
	echo $presente; }
echo "</td>";




$porcentajex=($presente/($presente+$ausentec))*100;
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




echo "</form>";

}?>





















