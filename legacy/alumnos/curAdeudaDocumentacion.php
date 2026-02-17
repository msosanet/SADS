<?PHP
/* Muestra opciones de documentación adeudada para confeccionar planilla
** de reclamo por cursos.
*/
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta charset="UTF-8"/>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" type="text/css" href="tablacalif.css" />

<?
if (isset($_POST['curso'])) {
 $cur = substr($_POST['curso'],0,1);
 $div = substr($_POST['curso'],1);
 echo "<title>" . $cur . "° " . $div . " Adeudan documentación</title>";
}
else {
?>
<title>Adeudan documentación</title>
<?
}
?>
	
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
$usuario=$_SESSION['usuario'];
$pass=$_SESSION['contrasenia'];
$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
// Da error porque falta select_db antes de la cunsulta previa y no se usa en el resto del script
// $filatt = mysql_fetch_array($resultt) ;
if (isset($_POST['curso'])) $curso=$_POST['curso'];


?>

<body>




<div align="center">
			<div align="center">
			<table border="0" width="980">
			<tr><th>

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
			</th></tr>
</table>
</div></div>
<br><br>
<div align="center">
<h1>Documentación adeudada</h1>			
</div>	
		
<?
 if(1)
// if(!isset($_POST["submitcurso"]))
{
echo "<div align='center'>";
echo "<form method='POST' action='curAdeudaDocumentacion.php' >	";
	echo "<br><br>\n";
			$cursos = mysql_query ("SELECT DISTINCT CONCAT(curso,divi) AS cur_div, curso, divi FROM `cursa` WHERE `control` = 1 AND curso != 'L' AND curso != 'E' ORDER BY curso,divi");
							
			
			echo "<select name=curso>\n";
				while ($curso = mysql_fetch_array($cursos))
				{ 	
					if (isset($_POST['curso']) && $_POST['curso']==$curso['cur_div'])
					{echo "<option value=".$curso['cur_div']." selected>".$curso['curso']."° ".$curso['divi']."°"."</option>\n";}
					else
					{echo "<option value=".$curso['cur_div'].">".$curso['curso']."° ".$curso['divi']."°"."</option>\n";}
					
				}	
				
			echo "</select>";
	echo "&nbsp;";
	
		echo "<input type='submit' value='Ver curso' name='submitcurso' />";
		

echo "</form></div>";
}
if(isset($_POST["submitcurso"]))
{
	$qTotalCurso = mysql_query("SELECT COUNT(alumno) AS total FROM `cursa` WHERE `curso` = '$cur' AND `divi` = '$div' AND `control` = 1 ");
	$totalCurso = mysql_fetch_assoc($qTotalCurso);
	$qTiposDoc = mysql_query("SELECT * FROM `documentacion`");

//	$qDocumentos = mysql_query("SELECT DISTINCT id, FROM `docu_alu`");
  ?>
  
  <div style = "align:center">
  <form method="POST" action='adeudaDocumentacion.php' target="_blank">
  <table>
  <?
	
 while($doc_id = mysql_fetch_assoc($qTiposDoc)){
  $qPresentada = mysql_query("SELECT COUNT(alumno) AS cantidad FROM docu_alu WHERE alumno IN (SELECT alumno FROM `cursa` WHERE `curso` = '$cur' AND `divi` = '$div' AND `control` = 1) AND id = '$doc_id[id]' ");
  $presentada = mysql_fetch_assoc($qPresentada);
  $adeudadas = $totalCurso['total'] - $presentada['cantidad'];
  
  if ($doc_id['id']%2){
  
  ?>
  <tr>
   <td>	
    <input type="checkbox" name="tiposDoc[]" value="<?=$doc_id['id']?>">
    <label for="tiposDoc"><?=$doc_id['nombre']." (".$adeudadas.")"?></label>
   </td>
  <?} else {?>
   <td>	
    <input type="checkbox" name="tiposDoc[]" value="<?=$doc_id['id']?>">
    <label for="tiposDoc"><?=$doc_id['nombre']." (".$adeudadas.")"?></label>
   </td>
   </tr>

  <?}
  
 }
 if ($doc_id['id']%2) echo "<td></td></tr>"; // en caso de que haya un nro impar de tipos de documentacion
 ?>
 <tr>
  <td colspan="2" style="vertical-align: middle">
   <label for="parrAdicional">Texto para agregar al pedido: </label>
   <textarea id="parrAdicional" name="parrAdicional" rows="4" cols="50" placeholder="agregue aquí el texto que desea incorporar al pedido de documentación"></textarea>
  </td>
 </tr>
  <input type="hidden" name="curso" value="<?=$cur?>">
  <input type="hidden" name="division" value="<?=$div?>">

  <tr><td colspan="2" style="text-align:center;"><input type='submit' value='Imprimir reclamos' name='reclamos' style="align:center; padding: 0px 5px 0px" /></td></tr>
 </table></form></div>
 <?

}
 ?>
	<br><br><br><br><?//var_dump($_POST);?>
<?PHP	
include 'foot.php';

} ?>