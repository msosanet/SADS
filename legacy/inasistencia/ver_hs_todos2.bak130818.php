<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<script type="text/javascript" language="JavaScript1.2" src="../csjs/stm31.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../csjs/images.js"></script>
<link rel="stylesheet" type="text/css" href="style2.css" />
<link href="css/calendario.css" type="text/css" rel="stylesheet">
<script src="js/calendar.js" type="text/javascript"></script>
<script src="js/calendar-es.js" type="text/javascript"></script>
<script src="js/calendar-setup.js" type="text/javascript"></script>

<link rel="shortcut icon" href="../imag/favicon.ico">
<title>DATOS DOCENTES</title>




</head>
<?
include 'header.php';
$conexion = conectar ();
$actor=$_GET["actor"];


$resultt = mysql_query ("SELECT * FROM docentes WHERE dni = '$actor'");
$filatt = mysql_fetch_array($resultt);

$result100 = mysql_query ("SELECT * FROM legajo WHERE dni = '$actor'");


$resulttipo = mysql_query ("SELECT * FROM estados order by descripcion asc ");




$hayerrores = 0;

  $flag = 0;
  if (isset($_GET["submitx"])) {
     // verifico los errores en los campos

	 if (trim($_GET["apellido"]) == '' ) { $errorapellido = 1; $hayerrores = 1; }
	 if (trim($_GET["nombre"]) == '' ) { $errornombre = 1; $hayerrores = 1; }
	 if (trim($_GET["direccion"]) == '' ) { $errordireccion = 1; $hayerrores = 1; }
	 if (trim($_GET["numero"]) == '' ) { $errornumero = 1; $hayerrores = 1; }
	 if (trim($_GET["telefono"]) == '' ) { $errortelefono = 1; $hayerrores = 1; }

$result = mysql_query ("SELECT * FROM formulario where numero=$form");
$fila = mysql_fetch_array($result) ;

}
 else
  {
    $flag = 1;
  }
  
if ($hayerrores OR $flag) {
?>

<body background="bgris.gif" >
<form method="GET" action="ver_hs_todos2.php?actor=<? echo $actor; ?>">

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
				<tr>
				

					<td>
					
					<p align="left" class="text1b">MODIFICACION DE DATOS</p>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, están marcado con color ROJO</font></h4>";} ?>
</p><div align="left">				<div align="center">
					
					<table border="0" width="895" id="table1" cellpadding="2" cellspacing="4">

						
						<tr>
						

							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">D.N.I.:</td>
							<td bgcolor="#EAEAEA" width="268" align="left">
							<?echo $filatt['dni']; ?>
							</td>
					
							

							<td width="190" bgcolor="#EAEAEA" align="right">Sexo:
							</td></font>
							<td width="190" bgcolor="#EAEAEA" align="left">
							<select name="sexo">
							 <? if ($filatt['sexo']=='') {$selec = 'Seleccione el Sexo'; } else {$selec = '';}?>

								<option value="<?echo $filatt['sexo'];?>"><?echo $filatt['sexo']; echo $selec;?></option>
								<option value="M">M</option>
								<option value="F">F</option>
					
   							</select>
							</td>
							
						</tr>
						<?
	  					if ($errorapellido==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>
						
							

								<td width="74" bgcolor="#cccccc" align="right"><font color="<?echo $color;?>">Apellido:</td>
							</font>
							<td bgcolor="#cccccc" width="425" align="left">

							<input type="text" name="apellido" size="40" maxlength="40" value="<? echo $filatt['apellido']; ?>" />
							</td>												
						<?
	  					if ($errornombre==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>
							

								<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Nombre:</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left">

							<input type="text" name="nombre" size="40" maxlength="40" value="<?echo $filatt['nombre']; ?>" />
							</td>

							<tr>

						<?
	  					if ($errordireccion==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>
							<td width="190" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">
							Calle:</td></font>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="direccion" size="30" maxlength="30" value="<?echo $filatt['direccion'];?>" /></td>
							</td>
							
					
					
						<?
	  					if ($errornumero==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>

							<td width="190" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">

							N&uacute;mero:</td></font>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="numero" size="10" maxlength="10" value="<?echo $filatt['numero'];?>" /></td>
							</td>
							
						</tr>
									<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Piso:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="piso" size="30" maxlength="30" value="<?echo $filatt['piso'];?>" /></td>
							</td>

						
					

							<td width="190" bgcolor="#EAEAEA" align="right">
							Depto:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="depto" size="10" maxlength="10" value="<?echo $filatt['depto'];?>" /></td>
							</td>
							
						</tr>
									<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Barrio:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="barrio" size="30" maxlength="30" value="<?echo $filatt['barrio'];?>" /></td>
							</td>

						
					

							<td width="190" bgcolor="#EAEAEA" align="right">
							E-mail:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="mail" size="50" maxlength="50" value="<?echo $filatt['mail'];?>" /></td>
							</td>
							
							
							</td>
						</tr>
										
						<tr>
						<?
	  					if ($errortelefono==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>


							<td width="190" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">
							Tel&eacute;fono:</td></font>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="telefono" size="20" maxlength="20" value="<?echo $filatt['telefono'];?>" /></td>
							</td>
							
					
					
							<td width="190" bgcolor="#EAEAEA" align="right">Tipo:
							</td></font>

							<td width="190" bgcolor="#EAEAEA" align="left"><select size="1" name="tipo">
							<?	WHILE ($myrow6 = mysql_fetch_array($resulttipo))
							{			
								if($filatt['identificacion']==$myrow6[codigo]){ $seleccionado=' selected="selected" ';} else $seleccionado=" ";
								echo "<option value=$myrow6[codigo] $seleccionado> $myrow6[descripcion] </option>";
							}
							?></select> 
							</td>

							
						</tr>
						<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Celular:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="celular" size="20" maxlength="20" value="<?echo $filatt['celular'];?>" /></td>
							</td>
							
							<td width="190" bgcolor="#EAEAEA" align="right">
							Codigo Reloj:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="relojx" size="50" maxlength="50" value="<?echo $filatt['idreloj'];?>" /></td>
							</td>
							
							

							
						</tr>
						<?php while ($fila100 = mysql_fetch_array($result100))
						{ ?>


						<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Legajo:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><?echo $fila100['legajo'];?></td>
							</td>
							
							<td width="190" bgcolor="#EAEAEA" align="right">Cargo:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><?echo $fila100['cargo'];?></td>
							</td>
	
						</tr>
						<? } ?>
						<tr>
							<td width="834" bgcolor="#EAEAEA" align="left" colspan="4">
							<p align="center"><input type="submit" value="     Actualizar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
						</tr>
					</table>
				<tr>
					<td>
					<p align="center"><b>ARCHIVOS ASOCIADOS</p></b>

<center>
<table border="1" width="900" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
						<tr>  
<?php
                              
$dir = "ddjj/".$actor."/";

$directorio=opendir($dir);
                              
echo "<br>";
while ($archivo = readdir($directorio)){


 if($archivo=='.' or $archivo=='..' or $archivo=='index.php' or $archivo=='otro.HTM' or $archivo=='Thumbs.db'){
 echo "";
 }else {
 $archivo2=str_replace(" ", "%20",$archivo);
 $enlace = $dir.$archivo2;
    //si el nombre del archivo contiene un punto es una carpeta por lo que no es necesario quitar la extención
        if (strpos($archivo,".")) {
            $NOMBRE = SUBSTR($archivo, 0, -4);
        }else
        {
            $NOMBRE = $archivo;
        }


?><td align="center" width="100" bgcolor="#EEEEEE">
<p style="margin-top: 0; margin-bottom: 0"><a href=<? echo $enlace ?> target="_blank"><img src='pdf.png'height='80' width='80'><br><? echo $NOMBRE ?></a>
</td><?
 
 }
 }
closedir($directorio);

?> 
   </td>
</tr>
</table>

<br>
<br>

</font>
					
<!-- ******************* NUEVA PROPUESTA DE HORARIO ************************* -->            
<div align="center" style="width: 900px; background-color: #ddcccc">



<table border="0" width="900" bordercolor="#dddddd" cellspacing="0"><!-- EMPIEZA CUADRO DE HORARIOS -->
   <tr>
       <td colspan="7" align="center" class="text1b" bgcolor="#BB6666">Horario declarado por <span style="color:white"><? echo $filatt[apellido] . ", " . $filatt[nombre]; ?></span></td>
   
   <tr>
        <td valign="top"> 
<? 
$horarios = mysql_query ("SELECT * FROM horarios WHERE dni = '$actor' ORDER BY hs_entrada");
?>        
          
            <table width="130" border="1" cellspacing="0"><!-- DETALLE DE CARGOS -->

                
                <tr bgcolor="#dddddd">
                    <td align="center"><b>CARGO</b></td>       
                </tr>
                                    
<? while ($horariodato = mysql_fetch_array($horarios))
	{ 
?>        
                <tr>
                    <? if ($horariodato[cod_dia] ==1) 
							{ echo "<td align='center' style='background: white'>" . $horariodato[cod_curso]; } ?>
                            </td>       
                </tr>
<? 
} 
?>
            </table><!-- FIN CARGOS -->
        <td valign="top"> 
<? 
$horarios = mysql_query ("SELECT * FROM horarios WHERE dni = '$actor' ORDER BY hs_entrada");
?>        
          
            <table width="100" border="1" cellspacing="0"><!-- HORARIOS DEL LUNES -->

                
                <tr bgcolor="#dddddd">
                    <td align="center"><b>LUNES</b></td>       
                </tr>
                                    
<? while ($horariodato = mysql_fetch_array($horarios))
	{ 
?>        
                <tr>
                    <? if ($horariodato[cod_dia] ==1) 
							{ echo "<td align='center' style='background: white'>" . substr($horariodato[hs_entrada], 0, 5) . " a " . substr($horariodato[hs_salida], 0, 5); } ?>
                            </td>       
                </tr>
<? 
} 
?>
            </table><!-- FIN HORARIOS DEL LUNES --> 
        </td>
        <td valign="top">
<? 
$horarios = mysql_query ("SELECT * FROM horarios WHERE dni = '$actor' ORDER BY hs_entrada");
?>        
          
            <table width="100" border="1" cellspacing="0"><!-- HORARIOS DEL MARTES -->

                
                <tr bgcolor="#dddddd">
                    <td align="center"><b>MARTES</b></td>       
                </tr>
                                    
<? while ($horariodato = mysql_fetch_array($horarios))
	{ 
?>        
                <tr>
                    <? if ($horariodato[cod_dia] ==2) 
							{ echo "<td align='center' style='background: white'>" . substr($horariodato[hs_entrada], 0, 5) . " a " . substr($horariodato[hs_salida], 0, 5); } ?>
                            </td>       
                </tr>
<? 
} 
?>
            </table><!-- FIN HORARIOS DEL MARTES --> 
        </td>
        <td valign="top"><!-- HORARIOS DEL MIÉRCOLES -->
<?
$horarios = mysql_query ("SELECT * FROM horarios WHERE dni = '$actor' ORDER BY hs_entrada");
?>        
          
            <table width="100" border="1" cellspacing="0">

                
                <tr bgcolor="#dddddd">
                    <td align="center"><b>MIÉRCOLES</b></td>       
                </tr>
                                    
<? while ($horariodato = mysql_fetch_array($horarios))
	{ 
?>        
                <tr>
                    <? if ($horariodato[cod_dia] ==3) 
							{ echo "<td align='center' style='background: white'>" . substr($horariodato[hs_entrada], 0, 5) . " a " . substr($horariodato[hs_salida], 0, 5); } ?>
                            </td>       
                </tr>
<? 
} 
?>
            </table> 
        </td><!-- FIN HORARIOS DEL MIÉRCOLES -->
        
        
        <td valign="top"><!-- HORARIOS DEL JUEVES -->
<?
$horarios = mysql_query ("SELECT * FROM horarios WHERE dni = '$actor' ORDER BY hs_entrada");
?>        
          
            <table width="100" border="1" cellspacing="0">

                
                <tr bgcolor="#dddddd">
                    <td align="center"><b>JUEVES</b></td>       
                </tr>
                                    
<? while ($horariodato = mysql_fetch_array($horarios))
	{ 
?>        
                <tr>
                    <? if ($horariodato[cod_dia] ==4) 
							{ echo "<td align='center' style='background: white'>" . substr($horariodato[hs_entrada], 0, 5) . " a " . substr($horariodato[hs_salida], 0, 5); } ?>
                            </td>       
                </tr>
<? 
} 
?>
            </table> 
        </td><!-- FIN HORARIOS DEL JUEVES -->
        
        
        <td valign="top"><!-- HORARIOS DEL VIERNES -->
<? 
$horarios = mysql_query ("SELECT * FROM horarios WHERE dni = '$actor' ORDER BY hs_entrada");
?>        
          
            <table width="100" border="1" cellspacing="0">

                
                <tr bgcolor="#dddddd">
                    <td align="center"><b>VIERNES</b></td>       
                </tr>
                                    
<? while ($horariodato = mysql_fetch_array($horarios))
	{ 
?>        
                <tr>
                    <? if ($horariodato[cod_dia] ==5) 
							{ echo "<td align='center' style='background: white'>" . substr($horariodato[hs_entrada], 0, 5) . " a " . substr($horariodato[hs_salida], 0, 5); } ?>
                            </td>       
                </tr>
<? 
} 
?>
            </table> 
        </td><!-- FIN HORARIOS DEL VIERNES -->
        
        
        <td valign="top"><!-- HORARIOS DEL SABADO -->
<? 
$horarios = mysql_query ("SELECT * FROM horarios WHERE dni = '$actor' ORDER BY hs_entrada");
?>        
          
            <table width="100" border="1" cellspacing="0">

                
                <tr bgcolor="#dddddd">
                    <td align="center"><b>SABADO</b></td>       
                </tr>
                                    
<? while ($horariodato = mysql_fetch_array($horarios))
	{ 
?>        
                <tr>
                    <? if ($horariodato[cod_dia] ==6) 
							{ echo "<td align='center' style='background: white'>" . substr($horariodato[hs_entrada], 0, 5) . " a " . substr($horariodato[hs_salida], 0, 5); } ?>
                            </td>       
                </tr>
<? 
} 
?>
            </table> 
        </td><!-- FIN HORARIOS DEL SABADO -->


    </tr> 
</table>  
<p class="text1b"><a href="add_cargos.php?actor=<? echo $actor; ?>">AGREGAR HORARIO DE CARGO</a></p>
<br>
</div> 

<!-- ******************* FIN NUEVA PROPUESTA DE HORARIO ************************* -->     
      
<br>     
            
			<?
			include 'footer.php';
			?>

			</td>
		</tr>
	</table>
</div>


<input type="hidden" name="actor" value="<?echo $actor;?>">
</form>
 </td>

</div>

</body>
<?
}
else
{

	$nombre=$_GET['nombre'];
	$apellido=$_GET['apellido'];
	$direccion=$_GET['direccion'];
	$numero=$_GET['numero'];
	$telefono=$_GET['telefono'];
	$celular=$_GET['celular'];
	$piso=$_GET['piso'];
	$depto=$_GET['depto'];
	$barrio=$_GET['barrio'];
	$mail=$_GET['mail'];
	$tipo=$_GET['tipo'];
	$sexo=$_GET['sexo'];
	$reloj=$_GET['relojx'];


if (mysql_query ("UPDATE docentes SET nombre='$nombre',apellido='$apellido',direccion='$direccion',mail='$mail',sexo='$sexo',identificacion=$tipo,telefono='$telefono',piso='$piso',depto='$depto',numero=$numero,barrio='$barrio', celular='$celular', idreloj='$reloj' where dni='$actor'"))
{	
				?>
				<script>
				var answer=alert("Datos Actualizados Correctamente")
				</script> 
						<meta http-equiv='refresh' content='0; URL=menu.php?'>
						<? 
}
				else {	
				?>
				<script>
				var answer=alert("No se pudo grabar en la BD")
				</script> 
				<meta http-equiv='refresh' content='0; URL=menu.php?'>
				<? 
					}					


}

?>
</html>
<? } ?>