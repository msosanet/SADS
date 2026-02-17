<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta http-equiv="Content-Language" content="es-ar">
<script type="text/javascript" language="JavaScript1.2" src="../csjs/stm31.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../csjs/images.js"></script>
<link rel="stylesheet" type="text/css" href="style2.css" />
<title>HORARIOS CARGOS</title>
</head>


<?
include 'header.php';

$conexion = conectar ();
$actor=$_GET["actor"];

$resultt = mysql_query ("SELECT * FROM docentes");
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

<form method="GET" action="ver_hs_todos2.php?actor=<? echo $actor; ?>">

<div id="marco980">  <!-- ************ DIVISION PRINCIPAL ***********************-->

			<div align="center">
            
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

					
<p align="left" class="text1b">HORARIOS DE DOCENTES CON CARGOS</p>

<div align="center">
					
<!-- ******************* NUEVA PROPUESTA DE HORARIO ************************* -->            
<div align="center" style="width: 900px; background-color: #ddcccc">



<table border="0" width="900" bordercolor="#dddddd" cellspacing="0"><!-- EMPIEZA CUADRO DE HORARIOS -->
   <tr>
       <td colspan="7" align="center" class="text1b" bgcolor="#BB6666">Horario declarado por <span style="color:white"><? echo $filatt[apellido] . ", " . $filatt[nombre]; ?></span></td>
   
   <tr>
        <td valign="top"> 
<? 
$horarios = mysql_query ("SELECT * FROM horarios ORDER BY hs_entrada");
?>        
          
            <table width="130" border="1" cellspacing="0"><!-- DETALLE DE CARGOS -->

                
                <tr bgcolor="#dddddd">
                    <td align="center"><b>CARGO</b></td>       
                </tr>
                                    
<? while ($horariodato = mysql_fetch_array($horarios))
	{ 
?>        
                <tr>
                    <?  if ($horariodato[cod_dia] ==1) {
                        $codigocurso = $horariodato[cod_curso];
                        $cargostodos = mysql_query ("SELECT * FROM curso WHERE codigo = $codigocurso");
                        $cargo = mysql_fetch_array ($cargostodos);
                     echo "<td align='center' style='background: white'>" . $cargo[descripcion]; }?>
                            </td>       
                </tr>
<? 
} 
?>
            </table><!-- FIN CARGOS -->
        <td valign="top"> 
<? 
$horarios = mysql_query ("SELECT * FROM horarios ORDER BY hs_entrada");
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
$horarios = mysql_query ("SELECT * FROM horarios ORDER BY hs_entrada");
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
$horarios = mysql_query ("SELECT * FROM horarios ORDER BY hs_entrada");
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
$horarios = mysql_query ("SELECT * FROM horarios ORDER BY hs_entrada");
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
$horarios = mysql_query ("SELECT * FROM horarios ORDER BY hs_entrada");
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
$horarios = mysql_query ("SELECT * FROM horarios ORDER BY hs_entrada");
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
<p class="text1b"><a href="add_cargos.php?actor=<? echo $actor; ?>">AGREGAR HORARIO DE CARGO</a> - <a href="mod_cargos2.php?actor=<? echo $actor; ?>">MODIFICAR HORARIO DE CARGO</a></p>
<br>
</div> 

<!-- ******************* FIN NUEVA PROPUESTA DE HORARIO ************************* -->     
      
<br>     
            
			<?
			include 'footer.php';
			?>

</div>


<input type="hidden" name="actor" value="<?echo $actor;?>">
</form>
 </td>

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
</div> <!-- ************ FIN DIVISION PRINCIPAL ***********************-->
</html>
<? } ?>
