<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="es-ar">

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


<style>
    select {
        width: 150px;
        margin: 10px;
    }
    select:focus {
        min-width: 150px;
        width: 300px;
    }
</style>




</head>
<?
include 'header.php';

 if (isset($_GET["submitx"])) {
     // verifico los errores en los campos
$conexion = conectar ();
$curso=$_GET['curso'];
$turno=$_GET['turno'];
//echo "Curso: ".$curso;
//BORRO LAS MATERIAS EN MATCUR QUE NO ESTEN EN HORARIOS PARA QUE DESAPAREZCAN EN LA ASIGNACION DEL DOCENTE

$sql2 = ("DELETE FROM matcur  WHERE idmateria NOT IN (SELECT h.idmateria FROM horariox h WHERE h.idcurso='$curso') AND idcurso='$curso' AND idmateria!='71'");
//echo $sql2;
mysql_query($sql2);

//for($hora=1;$hora<10;$hora++)
for($dia=1;$dia<6;$dia++)
	{
		for($hora=0;$hora<=10;$hora++)
			//for($dia=1;$dia<7;$dia++)
			{ 
			$cual[$hora]=$_GET[$hora][$dia];
			
			
//if 	($cual[$hora]!='65')		
//{	
$consulta=mysql_query("SELECT * FROM horariox WHERE idcurso='$curso' AND dia='$dia' AND hora='$hora'");
$actualiza = mysql_num_rows($consulta);
//echo $actualiza;

//INSERTA O ACTUALIZA LOS HORARIOS
if ($actualiza=='0')
{
	
$sql = "INSERT INTO horariox VALUES ('$curso','$dia','$hora',$cual[$hora])";
//echo $sql;
mysql_query($sql);
}

if ($actualiza=='1')
{	
$sql = "UPDATE horariox SET idmateria='$cual[$hora]' WHERE idcurso='$curso' AND dia='$dia' AND hora='$hora'";
//echo $sql;
mysql_query($sql);

}



$matx=$cual[$hora];
$consultax=mysql_query("SELECT * FROM matcur where idcurso='$curso' AND idmateria='$matx'");
$actualizax = mysql_num_rows($consultax);


if ($actualizax==0)
{
	
$sql = "INSERT INTO matcur VALUES ('$curso','$matx',0)";
//echo $sql;
mysql_query($sql);

}

//}
}
	
	
	

	}






//BORRA LAS MATERIAS QUE TIENEN ASIGNADO UN PROFESOR Y YA NO PERTENECEN AL CURSO PORQUE EN EL HORARIO SE MODIFICO.
$sql = "DELETE mc FROM matcur mc WHERE NOT EXISTS (SELECT H.idmateria FROM horariox H WHERE H.idcurso=$curso) AND mc.idcurso='$curso'";
//echo $sql;
mysql_query($sql);

}//FIN SUBMIT




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

<?
$conexion = conectar ();
$usuario=$_SESSION['usuario'];
$materia=$_GET['materia'];
$cursox=$_GET['curso'];
//echo $cursox;

$rr = mysql_query ("SELECT * FROM curso2 where idcurso='$cursox' and habilitado=1");
$rr = mysql_fetch_array($rr);


$cursillo=$rr['descripcion'];
$turno=$rr['turno'];
$cursotext = mysql_query ("SELECT * FROM materiax where curso='$cursillo'");
$cursotext = mysql_fetch_array($resulturno);





?>

<form method="GET" action="ORIGINAL.php">

</p>
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
			<?
			//include 'footer.php';
			?>

			</td>
		</tr>
	</table>
</div>
<div align="center">
<table border="1" style="background-color:#FFFFFF; width: 80%;" cellpadding="1" cellspacing="0">
	<tr>
		<td>
					<p align="center" class="text1b">Horario de  <?echo $rr['descripcion']; ?></p><br>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, est&aacute;n marcado con color ROJO</font></h4>";} ?></p>
		</td>
	</tr>
					
			
</table>
</div>



<div align="center">  
<table border="1" style="background-color:#FFFFFF; width: 80%;" cellpadding="1" cellspacing="0" id="horarioTable">
    <tr>
      <td bgcolor="#EAEAEA" align="center" colspan="7"><font color="FF0000"><b>HORARIO PARA EL CURSO</b></font></td>
    </tr>
    <tr>
      <td bgcolor="#EAEAEA" align="center"><b>Hora</b></td>
      <td bgcolor="#EAEAEA" align="center"><b>Lunes</b></td>
      <td bgcolor="#EAEAEA" align="center"><b>Martes</b></td>
      <td bgcolor="#EAEAEA" align="center"><b>Mi&eacute;rcoles</b></td>
      <td bgcolor="#EAEAEA" align="center"><b>Jueves</b></td>
      <td bgcolor="#EAEAEA" align="center"><b>Viernes</b></td>
    </tr>

    <?php
    $hora = '0';
	$consultaqhoras="SELECT * FROM horariox where idcurso='$cursox' ORDER BY hora DESC limit 0,1";
	//echo $consultaqhoras;
	$qhorasresult = mysql_query($consultaqhoras);
    $qhoras = mysql_fetch_array($qhorasresult);
	
    for ($hora = 0; $hora <= $qhoras['hora']; $hora++) {
      echo "<tr>";
      $cons = ("SELECT * FROM horax where turno='$turno' AND hora='$hora'");
      $hor = mysql_query("$cons");
      $hor = mysql_fetch_array($hor);
      $desde = $hor['desde'];
      $hasta = $hor['hasta'];
      $horax = $desde . "-" . $hasta;
      echo "<td bgcolor='#EAEAEA' align='center'><b>" . $horax . "</b></td>";

      for ($dia = 1; $dia < 6; $dia++) {
        echo "<td bgcolor='#EAEAEA' align='center'>";
        $result79 = mysql_query("SELECT * FROM materias ORDER BY descripcion DESC");
        echo "<select name='" . $hora . "[" . $dia . "]' style=width: 50px;>";
        while ($fila79 = mysql_fetch_array($result79)) {
          $horita = $fila79['idmateria'];
          $consulta = mysql_query("SELECT * FROM horariox where idcurso='$cursox' AND idmateria='$horita' AND dia='$dia' AND hora='$hora'");
          $elegido = mysql_num_rows($consulta);

          if ($elegido != '0') {
            echo "<option selected value=" . $fila79['idmateria'] . ">" . strtoupper($fila79['descripcion']) . "</option>";
          } else {
            echo "<option value=" . $fila79['idmateria'] . ">" . strtoupper($fila79['descripcion']) . "</option>";
          }
        }
        echo "</select>";
        echo "</td>";
      }
      echo "</tr>";
    }
    ?>

    <input name="curso" type="hidden" value="<?php echo $_GET['curso'] ?>" />
    <input name="division" type="hidden" value="<?php echo $_GET['division'] ?>" />
	 <input name="turno" type="hidden" value="<?php echo $turno; ?>" />

    <tr id="addHorarioButtonRow">
      <td bgcolor="#EAEAEA" align="center" colspan="7">
        <p align="center">  <button type="button" onclick="agregarHorario()"> (+) Agregar Horario</button></td>
      </tr>

    <tr>
      <td bgcolor="#EAEAEA" align="center" colspan="7">
        <p align="center"><input type="submit" value="Grabar" name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #ff0000; font-weight:700; float:center" /></td>
    </tr>
    <tr>
      <td bgcolor="#EAEAEA" align="center" colspan="7">
        <br><br>
        <a href="selcurso.php">Volver</a>
        <p align="center">&nbsp;</td>
      </tr>
  </table>
</div>





	</form>
<?
include 'footer.php';
?>
</body>
<?
}

  
  
  
  
  ?>


</html>

