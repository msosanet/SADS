<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta charset="UTF-8"/>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<script type="text/javascript" language="JavaScript1.2" src="../csjs/stm31.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../csjs/images.js"></script>
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" type="text/css" href="tablacalif.css" />


<link rel="shortcut icon" href="../imag/favicon.ico">
<title>Calificaciones por curso</title>
	
	<style>
      p {
        writing-mode: vertical-rl;
        text-orientation: mixed;
      }
    </style>







</head>
<?
include 'header.php';
$conexion = conectar ();
$conexioncalif = conectarcalif ();
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
// Da error porque falta select_db antes de la cunsulta previa y no se usa en el resto del script
// $filatt = mysql_fetch_array($resultt) ;
if (isset($_GET['curso'])){ $curso=$_GET['curso']; }

function validarFecha($fechax)
		{
		$fechades = date("j,n,Y",strtotime($fechax)); 
//		$valores = explode(",",$fechades);
		$valores = explode("-",$fechax);
		$anoF = $valores[0];
		$mesF = $valores[1];
		$diaF = $valores[2];
		/*echo "dia".$diaF."mes:".$mesF."ano".$anoF;
		echo "valor:".checkdate($diaF,$mesF,$anoF);		*/
		return checkdate($mesF,$diaF,$anoF);
		}





?>

<body>




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

</table>
</div></div>
<br><br>
<div align="center">
<h1>CALIFICADORES</h1>			
</div>	
<div align="center">		
<?
echo "<form method='POST' action='vercalif2.php' >	";
	echo "<br><br>\n";
			$result79 = mysql_query ("SELECT * FROM curso2 WHERE habilitado='1'order by descripcion ASC,curso ASC,division ASC");
							
			
			echo "<select name=curso>";
				while ($fila79 = mysql_fetch_array($result79))
				{ 	
					if (isset($_POST['curso']) && $_POST['curso']==$fila79['idcurso'])
					{echo "<option value=".$fila79['idcurso']." selected>".$fila79['descripcion']."</option>\n";}
					else
					{echo "<option value=".$fila79['idcurso'].">".$fila79['descripcion']."</option>\n";}
					
				}	
				
			echo "</select>";
	echo "<br>";
	echo "<br>";
	
		$result79 = mysql_query ("SELECT DISTINCT cf.* FROM calificador2 c, calificaciones cf WHERE c.idnota=cf.id");
							
			
			echo "<select name=quenota>";
				while ($fila79 = mysql_fetch_array($result79))
				{ 	
					if (isset($_POST['quenota']) && $_POST['quenota']==$fila79['id'])
					{echo "<option value=".$fila79['id']." selected>".$fila79['descripcion']."</option>";}
					else
					{echo "<option value=".$fila79['id'].">".$fila79['descripcion']."</option>";}
					
				}	
				
			echo "</select>";
		
		
		
		
		echo "<input type='submit' value='Ver' name='submitcurso' />";
		

echo "</div>";

if(isset($_POST["submitcurso"]))
{
	$curso=$_POST['curso'];
	$quenota=$_POST['quenota'];
	$sqlmat = "SELECT * FROM matcur mc, materias m WHERE mc.idcurso='$curso'AND mc.idmateria=m.idmateria AND m.idmateria!='65' ORDER BY m.descripcion ASC ";
	//echo $sqlmat;
	$resultmat = mysql_query ($sqlmat);
	
	//DATOS DEL CURSO
	$sqlcurso = "SELECT * FROM curso2 WHERE idcurso='$curso' AND habilitado='1'";
	$resultcurso = mysql_query ($sqlcurso);
	$curdesc = mysql_fetch_array($resultcurso);
	$cursod=$curdesc['descripcion'];
	$curx=$curdesc['curso'];
	$divx=$curdesc['division'];
	
	echo "<br><br>";
	echo "<div align='center'>";
	echo "<table border=3 id='customers'>";
		echo "<tr>";
			echo "<td><h1>".$cursod."</h1></td>";
			while ($mat = mysql_fetch_array($resultmat))
			{$colorx = dechex(rand(124,255)) . dechex(rand(124,255)) . dechex(rand(124,255));
			 // $colorx = substr(md5(rand()), 0, 6);
			 echo "<td bgcolor='$colorx' style='padding: 10px;' ><p>".$mat['descripcion']."</p></td>";
			 $array[] = $mat['idmateria'];
			 $color[] = $colorx;					
			 $nombremat[] = $mat['descripcion'];	
			}
		echo "</tr>";
		//print_r($array);
		$sqlalu="SELECT * FROM alumno a,calificador2 c,curso2 cc, cursa cu WHERE cu.alumno=c.dni  AND cu.anio=year(curdate()) AND c.dni=a.dni AND cc.idcurso='$curso' AND cc.idcurso=c.curso AND cc.habilitado='1' AND cc.curso=cu.curso AND cc.division=cu.divi GROUP BY c.dni ORDER BY a.apellido,a.nombre ASC";
		//echo $sqlalu;
		$resultalu = mysql_query ($sqlalu);
		while ($alu = mysql_fetch_array($resultalu))
			{
			
			//POR SI EL ALUMNO SE CAMBIO DE CURSO, O SE FUE DE PASE
			/*$pase='';
			$advertencia='#f2f2f2';
			if ($alu['control']==0)
			{	
				if ($alu['pase']=='0')
				{$fechapase = date("d/m/Y",strtotime($alu['fecha']));
				$pase="(CAMBIO CURSO - ".$fechapase.")";	}
				else
				{
				$fechapase = date("d/m/Y",strtotime($alu['pase']));
				$pase="(PASE - ".$fechapase.")";	}

				$advertencia="#FF7000";

			}*/
				$pase='';
				$advertencia='#FFFFFF';
				$estadepase=0;
				
				if ($alu['control']==0)
				{	
					$squenta = "SELECT * FROM cursa c WHERE c.alumno='$alu[dni]' AND c.anio=year(curdate())";
				//	echo $squenta;
					$resultcuenta = mysql_query($squenta);
					$cambio=mysql_num_rows($resultcuenta);
					//echo "Cambio".$cambio;
					/*$volvio = "SELECT * FROM cursa c WHERE c.alumno='$alu[dni]' AND c.anio=year(curdate()) AND curso='$curx' AND divi='$divx'";
					//echo $volvio;
					$resultvolvio = mysqli_query($linkcalif, $volvio);
					$volvioq=mysqli_num_rows($resultvolvio);*/
					//echo $volvioq;
					
					//if ($volvioq<2)
					//{
						if ($cambio>1)
						{
							
							$fechacurso = "SELECT * FROM cursa c WHERE c.alumno='$alu[dni]' AND c.anio=year(curdate()) AND c.control=1";
							$resultcurso = mysql_query($fechacurso);
							$curxxx = mysql_fetch_array($resultcurso);
							if ($curxxx['fecha']==NULL){$fechacambio=$alu['fecha'];}else{$fechacambio=$curxxx['fecha'];}


							$fechacambio = date("d/m/Y",strtotime($fechacambio));
							$pase="(CAMBIO CURSO - ".$fechacambio.")";
							

							$cambiox=1;
						}
						
							
						
						
						if ($alu['pase']!=0 AND $cambiox!=1)
							{
							$fechapase = date("d/m/Y",strtotime($alu['pase']));
							$pase="(PASE - ".$fechapase.")";
							$estadepase=1;
							}
						
						//echo "pase".$crowalu['pase'];
						/*if ((validarFecha($alu['fecha'])==1) AND (validarFecha($alu['pase']==1)))
							{
							$fechapase = date("d/m/Y",strtotime($alu['fecha']));
							$pase="(BAJA DEF. - ".$fechapase.")";
							}*/
							
							if ($cambiox!=1 AND $estadepase!=1)
							{
							$fechapase = date("d/m/Y",strtotime($alu['fecha']));
							$pase="(BAJA DEF. - ".$fechapase.")";
							}
					
				$advertencia="#FF7000";

				//}
				}


		
			echo "<tr>";
				$nombre=$alu['apellido'].",".$alu['nombre'];
			 echo "<td bgcolor='$advertencia'><a href='vercalifalumno.php?dni=$alu[dni]&nombre=$nombre&curso=$_POST[curso]' target='_blank' >".$alu['apellido'].", ".$alu['nombre']."   ".$pase."</a></td>";
				$count = count($array);
				for ($i = 0; $i < $count; $i++) 
				{$sqlcalif="SELECT * FROM calificador2 c WHERE c.dni='$alu[dni]' AND c.curso='$curso' AND c.materia='$array[$i]' AND idnota='$quenota'";
				
				 $resultcalif = mysql_query ($sqlcalif);
				 $cantidadx=mysql_num_rows($resultcalif);
				 $calif = mysql_fetch_array($resultcalif);
				
				if ($calif['nota']==0)
				 {$calificacion='S/C';
				  $colormat='999999';}
				 else
				 {$calificacion=$calif['nota'];}
				
				
				
				
				
				if ($cantidadx==0)
				 {$calificacion='';}
				 
				 if ($calificacion>=1 AND $calificacion<=3 )
				 {$colormat='FF0000';}
				if ($calificacion>=4 AND $calificacion<=5 )
				 {$colormat='FFFF00';}
				if ($calificacion>=6 AND $calificacion<=10 )
				 {$colormat='00FF00';}
				 
						 
				
				  echo "<td bgcolor='$colormat'style='padding: 10px;  text-align: center;'><span title='$alu[apellido],$alu[nombre] - $nombremat[$i] - $calificacion'>".$calificacion."</span></td>";
				
				}
			 echo "</tr>";
			}
		
	
	echo "</table>";
echo "</div>";
}
if (isset($_POST['curso'])){
?>
<br><br>
	<div align="center">
	 <a href='planillaCalif_pdf.php?cd=<?=$_POST['curso']?>' target="_blank">Imprimir tablas de calificaciones por estudiante</a>
	</div>
<? } ?>
	<br><br><br><br>
<?PHP	
include 'foot.php';

} ?>
