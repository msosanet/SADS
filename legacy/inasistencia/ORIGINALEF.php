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
<title>SIDOS</title>

<script language=javascript>
function ventanaSecundaria (URL){
   window.open(URL,"ventana1","width=300,height=300,scrollbars=NO")
}
</script>
</head>
<?
include 'header.php';

 if (isset($_GET["submitx"])) {
     // verifico los errores en los campos
	$conexion = conectar ();
	//print_r($_GET)."<br>";
	//$t=array_count_values($_GET));
	//echo $t;
	foreach ($_GET as $hora => $subarreglo)
	{
		foreach ($subarreglo as $dia => $curso)
		{
        /*echo "hora: ".$subindice;
		echo "dia: ".$indice;
		echo "curso: ".$valor."<br>";*/
					$sql = "SELECT * FROM edfisica WHERE dia='$dia' AND hora='$hora'";
					//echo $sql;
					$consulta=mysql_query($sql);
					$actualiza = mysql_num_rows($consulta);
					//echo $actualiza;

					//INSERTA O ACTUALIZA LOS HORARIOS
					if ($actualiza=='0')
					{
						$sql = "INSERT INTO edfisica VALUES ('$curso','$dia','$hora')";
						//echo $sql."<br>";
						mysql_query($sql);
					}

					if ($actualiza=='1')
					{
						$sql = "UPDATE edfisica SET idcurso='$curso' WHERE dia='$dia' AND hora='$hora'";
						//echo $sql."<br>";
						mysql_query($sql);
					}




					$sqlEF = "SELECT * FROM matcur WHERE idcurso='$curso' AND idmateria='71'";
					$cargaef=mysql_query($sqlEF);
					$actualizaEF = mysql_num_rows($cargaef);
					if ($actualizaEF=='0')
					{
						$sql = "INSERT INTO matcur VALUES ('$curso','71','0')";
						mysql_query($sql);
					}


		}
	}

	/*for($dia=1;$dia<6;$dia++)
		{
			for($hora=1;$hora<=32;$hora++)
				//for($dia=1;$dia<7;$dia++)
				{
					$cual[$hora]=$_GET[$hora][$dia];
					echo "curso: ".$cual[$hora]."dia: ".$dia."hora: ".$hora."<br>";
					$sql = "SELECT * FROM edfisica WHERE dia='$dia' AND hora='$hora'";
					//echo $sql;
					$consulta=mysql_query($sql);
					$actualiza = mysql_num_rows($consulta);
					//echo $actualiza;

					//INSERTA O ACTUALIZA LOS HORARIOS
					if ($actualiza=='0')
					{
						$sql = "INSERT INTO edfisica VALUES ('$cual[$hora]','$dia','$hora')";
						echo $sql."<br>";
						//mysql_query($sql);
					}

					if ($actualiza=='1')
					{
						$sql = "UPDATE edfisica SET idcurso='$cual[$hora]' WHERE dia='$dia' AND hora='$hora'";
						echo $sql."<br>";
						//mysql_query($sql);
					}




					$sqlEF = "SELECT * FROM matcur WHERE idcurso='$cual[$hora]' AND idmateria='71'";
					$cargaef=mysql_query($sqlEF);
					$actualizaEF = mysql_num_rows($cargaef);
					if ($actualizaEF=='0')
					{
						$sql = "INSERT INTO matcur VALUES ('$cual[$hora]','71','0')";
						mysql_query($sql);
					}
				//}//FIN FOR 30




		}*///FIN FOR6






//BORRA LAS MATERIAS QUE TIENEN ASIGNADO UN PROFESOR Y YA NO PERTENECEN AL CURSO PORQUE EN EL HORARIO SE MODIFICO.
//$sql = "DELETE mc FROM matcur mc WHERE NOT EXISTS (SELECT H.idmateria FROM horariox H WHERE H.idcurso=$curso) AND mc.idcurso=$curso";
//echo $sql;
//mysql_query($sql);

}




?>
<body>

<?
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$materia=$_GET['materia'];
$cursox=$_GET['curso'];

echo "<div style='max-width:980px'>";
if ($_SESSION['valor']==1) include 'menuppal2.php';
if ($_SESSION['valor']==0) include 'menuppal.php';
if ($_SESSION['valor']==3) include 'menuppal3.php';
echo "</div>";

?>

<form method="GET" action="<?=$_SERVER['PHP_SELF']?>">



<div align="center">
	<table border="0" width="980">
		<tr>
			<td>
			<br>
			<p align="left" class="text1b">Horarios de  Educacion Fisica<?echo $rr['descripcion']; ?></p><br>

		<div align="center">

		<table border="1" bordercolor="#000000" style="background-color:#FFFFFF" width="895" cellpadding="1" cellspacing="0">
		<tr>
			<td width="895" bgcolor="#EAEAEA" align="center" colspan="7"><font color="FF0000"><b>HORARIOS DE EDUCACION FISICA</b></font></td>
		</tr>
		<tr>
			<td bgcolor="#EAEAEA" align="center"><b>Hora</b></td>
			<td bgcolor="#EAEAEA" align="center"><b>Lunes</b></td>
			<td bgcolor="#EAEAEA" align="center"><b>Martes</b></td>
			<td bgcolor="#EAEAEA" align="center"><b>Miercoles</b></td>
			<td bgcolor="#EAEAEA" align="center"><b>Jueves</b></td>
			<td bgcolor="#EAEAEA" align="center"><b>Viernes</b></td>

		</tr>

<?php
		$hora='1';
		//for($hora=1;$hora<=32;$hora++)
		$cons=("SELECT * FROM horax where turno='EF' ORDER BY desde ASC,hora ASC,desde ASC");
		$hor = mysql_query ("$cons");
		$hora=1;
		while ($horax = mysql_fetch_array($hor))
		{

		echo "<tr>";


		$desde = $horax['desde'];
		$hasta = $horax['hasta'];
		$horaz = $horax['hora'];

		$horax=$desde."-".$hasta;

		echo "<td bgcolor='#EAEAEA' align='center'><b>".$horax."</b></td>";


		for($dia=1;$dia<6;$dia++)
		{
			echo "<td bgcolor='#EAEAEA' align='center'>";

			$result79 = mysql_query ("SELECT * FROM curso2 WHERE habilitado='1'order by curso,division ASC");


			echo "<select name='".$horaz."[".$dia."]'>";
				while ($fila79 = mysql_fetch_array($result79))
				{ 	$curso=$fila79['idcurso'];
					$qef="SELECT * FROM edfisica where idcurso='$curso' AND dia='$dia' AND hora='$horaz'";

					$consulta=mysql_query($qef);
					$elegido = mysql_num_rows($consulta);



							if ($elegido!='0')
							{
							echo "<option selected value=".$curso.">".$fila79['descripcion']."</option>";
							}
							else
							{
							echo "<option value=".$curso.">".$fila79['descripcion']."</option>";
							}

				}
			echo "</select>";
			//echo $qef;
			echo "</td>";

		 }
		 echo "</tr>";
		$hora++;
		}//fin while

	?>


<input name="curso" type="hidden" value ="<?php echo $_GET['curso'] ?>"/>
<input name="division" type="hidden" value ="<?php echo $_GET['division'] ?>"/>

			<tr>
				<td width="895" bgcolor="#EAEAEA" align="center" colspan="7">
				<p align="center">&nbsp;</td>
			</tr>

			<tr>
				<td width="895" bgcolor="#EAEAEA" align="center" colspan="7">

				<p align="center"><input type="submit" value="     Grabar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #ff0000; font-weight:700; float:center" /></td>
			</tr>
			<tr>
				<td width="895" bgcolor="#EAEAEA" align="center" colspan="7">
				<br><br>
				<a href="menu.php">Volver</a>
				<p align="center">&nbsp;</td>

			</tr>
		</table>

		<hr>
		</td>
	</tr>


	</table>
	</div>

</div>
</form>
</body>
<?

include 'footer.php';


}


  ?>


</html>
