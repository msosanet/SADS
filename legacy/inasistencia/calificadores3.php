<?PHP
session_start();
if ($_SESSION['estado']==1) { 


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


function redondear_dos_decimal($valor) {
   $float_redondeado=round($valor * 100) / 100;
   return $float_redondeado;
} 


    function rfloor($real,$decimals = 2) {
        return substr($real, 0,strrpos($real,'.',0) + (1 + $decimals));
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
<title>SID</title>


</head>
<?
include 'header.php';
?>
<body background="bgris.gif" >

<p>



<?
include 'conexion.php';
$conexion = conectar ();
$usuario=$_SESSION['usuario'];




$plan=$_GET['plan'];
$curso=$_GET['curso'];
$materia=$_GET['materia'];

$result77 = mysql_query ("SELECT dni FROM alumno_curso where curso='$curso'");

$resultdocente = mysql_query ("SELECT *FROM doc_mat, docentes where doc_mat.curso='$curso' and doc_mat.materia='$materia' and doc_mat.dni=docentes.dni");
$filadocente = mysql_fetch_array($resultdocente); 



$errordoc = 0;
  $hayerrores = 0;



  $flag = 0;
  if (isset($_POST["submitx"])) {


// controlo que el plan no sea 0 

//	if ($_POST["pais"] == 0){ $errorplan = 1; $hayerrores = 1; };
//	if (trim($_POST["estado"]) == ''){ $errorestado = 1; $hayerrores = 1; };
//	if (trim($_POST["ciudad"]) == ''){ $errorciudad = 1; $hayerrores = 1; };





}
 else
  {
    $flag = 1;
  }
  
if ($hayerrores OR $flag) {
?>

<form method="POST" action="calificadores3.php">
</p>
<div align="center">
	<table border="0" width="980" bgcolor="#FFFFFF">
		<tr>
			<td>
			<div align="center">
				<table border="0" width="980" cellspacing="0" cellpadding="0">
					<tr>
						
					</tr>
				</table>
				
				<p></div>
			<div align="center">
			<table border="0" width="980">
<?		
include 'menuppal2.php';

?>	
				<tr>
					<td>
					<br>
					<p align="left" class="text1b">Asignatura: <?echo $materia;?></p>
					<p align="left" class="text1b">Profesor: <?echo $filadocente[apellido];?>, <?echo $filadocente[nombre];?> </p>
					<p align="left" class="text1b">Curso: <?echo $curso;?></p>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?>
</p><div align="left"><? if($error) { echo "<h4><font color=red>Datos vacios o incompletos</font></h4>";} ?><br>
<b></b><br>

	
<br><br>

<div align="center">
					
		<table border="1" bordercolor="#000000" style="background-color:#FFFFFF" width="895" cellpadding="1" cellspacing="0">
	<tr>
		<td bgcolor="#EAEAEA" align="center"><b>Alumno</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>1� Trim</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>2� Trim</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>3� Trim</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Prom.</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Dic.</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Marzo</b></td>
		<td bgcolor="#EAEAEA" align="center"><b>Calif. def.</b></td>
	</tr>
	
<?php 	
$i=1;	
$contar=0;
$promedio=0;
$bandera=0;
		while ($fila77 = mysql_fetch_array($result77))
		{ 

$result22 = mysql_query ("SELECT * FROM alumno where dni='$fila77[dni]'");
$fila22 = mysql_fetch_array($result22); 
$anio=date ("Y");
$result23 = mysql_query ("SELECT * FROM calificador where alumno='$fila77[dni]' and materia='$materia' and anio='$anio'");
$fila23 = mysql_fetch_array($result23); 

if($fila23[uno]<>'' and $fila23[dos]<>'' and $fila23[tres]<>'')
{ 



	if($fila23[uno] == 'A')
	{ 
		$contar=$contar+1;

	}
	if($fila23[dos] == 'A')
	{ 
		$contar=$contar+1;

	}

	if($fila23[tres] == 'A')
	{ 
		$contar=$contar+1;

	}

	if($contar > 0)
	{ 
			$promedio=((int)$fila23[uno]+(int)$fila23[dos]+(int)$fila23[tres])/2;
	}

	
		if($contar == 0)
	{ 
			$promedio=((int)$fila23[uno]+(int)$fila23[dos]+(int)$fila23[tres])/3;
	}

	$promedio=rfloor($promedio,2);



	$arr = explode(".",$promedio);
	$entero = $arr[0];
	$decimal = $arr[1];

	


	if((($plan==2) or ($plan==1)) and ($decimal > 25) and ($decimal < 75))
	{ 
		$promedio=$entero.".50";

	}
	if((($plan==2) or ($plan==1)) && (($decimal >= 0) && ($decimal <= 25)))
	{ 
		$promedio=$entero.".00";

	}
	if((($plan==2) or ($plan==1)) and ($decimal >= 75) )
	{ 
		$promedio=(int)$entero+1;

	}
	if((($plan==3) or ($plan==4)) and ($decimal <= 50) and ($decimal >=0))
	{ 
		$promedio=$entero.".50";

	}
	if((($plan==3) or ($plan==4)) && (($decimal > 50) && ($decimal <= 99) or ($decimal != "")))
	{ 
		$promedio=($entero+1).".00";

	}
	if((($plan==3) or ($plan==4)) && ($decimal == ""))
	{ 
		$promedio=($entero).".00";

	}


}
else
	{ 
		$promedio="-";

	}

		?>

	<tr>
			<td bgcolor="#EAEAEA" align="center"><? echo $fila22[apellido]; ?>, <? echo $fila22[nombre]; ?></td>
			<td bgcolor="#EAEAEA" align="center"><input type="text" name="unotrim[<?php echo $i; ?>]" size="2" maxlength="2" value="<?echo $fila23[uno]; ?>" /> </td>
			<td bgcolor="#EAEAEA" align="center"><input type="text" name="dostrim[<?php echo $i; ?>]" size="2" maxlength="2" value="<?echo $fila23[dos]; ?>" /></td>
			<td bgcolor="#EAEAEA" align="center"><input type="text" name="trestrim[<?php echo $i; ?>]" size="2" maxlength="2" value="<?echo $fila23['tres']; ?>" /></td>
			<td bgcolor="#EAEAEA" align="center"><?echo $promedio; ?></td>
<?		if ($fila23['tres'] > 5 and $promedio >= 6)
		{ ?>
			<td bgcolor="#EAEAEA" align="center">-</td>
			<td bgcolor="#EAEAEA" align="center">-</td>
			<td bgcolor="#EAEAEA" align="center"><?echo $promedio; ?></td>

		<? }

		else 
		{ 
		if($fila23[uno]<>'' and $fila23[dos]<>'' and $fila23[tres]<>'')
		{ 
		?>
			<td bgcolor="#EAEAEA" align="center"><input type="text" name="dic[<?php echo $i; ?>]" size="2" maxlength="2" value="<?echo $fila23['dic']; ?>" /></td>

			<? if ($fila23['dic'] >= 6 )
			{ 
			$promedio2=((int)$fila23[dic]+$promedio)/2;



			?>    
				<td bgcolor="#EAEAEA" align="center"></td>

				<td bgcolor="#EAEAEA" align="center"><?echo $promedio2; ?></td> 
			<?}
			else 	
			{ ?>    			
				<td bgcolor="#EAEAEA" align="center"><input type="text" name="mar[<?php echo $i; ?>]" size="2" maxlength="2" value="<?echo $fila23['marzo']; ?>" /></td>

				<td bgcolor="#EAEAEA" align="center"></td>
			<?}
		}
		else {	?> <td bgcolor="#EAEAEA" align="center">-</td>
			<td bgcolor="#EAEAEA" align="center">-</td>
			<td bgcolor="#EAEAEA" align="center">-</td>
			<?}

		}?>

			<input type="hidden" name="dni[<?php echo $i; ?>]" id="alumnos" value="<? echo $fila77[dni]; ?>" />
		
	</tr><? $i=$i+1;

}?>

</table>

						<tr>
							<td width="895" bgcolor="#EAEAEA" align="center" colspan="8">
							<p align="center"><input type="submit" value="     Grabar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
						</tr>

</table>


					</div>
					<p align="right">&nbsp;</div>
					<hr>
					</td>
				</tr>
				<?
include 'footer.php';
?>
			</table>
			</div>
		</tr>
	</table>

<input type="hidden" name="i" id="i" value="<? echo $i; ?>" />
<input type="hidden" name="materia" id="materia" value="<? echo $materia; ?>" />
<input type="hidden" name="plan" id="plan" value="<? echo $plan; ?>" />


	</form>
</div>
</body>
<?
}
else
{
	$plan=$_POST['plan'];
	$curso=$_POST['estado'];	
	$materia=$_POST['materia'];
	$i=$_POST['i'];


//------------------------------grabo notas-----------------------------------------------------------

$anio=date ("Y");


for($k=1; $k < $i; $k++)
{ 


$deni=$_POST['dni'][$k];
$unotrim=$_POST['unotrim'][$k];
$dostrim=$_POST['dostrim'][$k];
$trestrim=$_POST['trestrim'][$k];
$dic=$_POST['dic'][$k];
$mar=$_POST['mar'][$k];


$yaesta = mysql_query ("SELECT * FROM calificador where alumno='$deni' and materia='$materia' and anio='$anio'");
if (mysql_num_rows ($yaesta) > 0)
{ 
	
		if (mysql_query ("UPDATE calificador SET uno='$unotrim', dos='$dostrim', tres='$trestrim', dic='$dic' , marzo='$mar' where alumno='$deni' and materia='$materia' and anio='$anio'"))
		{
		}
}
else
{


	if (mysql_query ("INSERT INTO calificador VALUES (0,'$deni','$materia','$anio','$unotrim','$dostrim','$trestrim','-','$dic','$mar','-','-')"))
		{	
				
		}

}}
?>
				<script>
				var answer=alert("Se grabo Correctamente")
				</script> 
				<meta http-equiv='refresh' content='0; URL=calificadores2.php?'>
				<? 

}					
?>
</httl>
<? } ?>