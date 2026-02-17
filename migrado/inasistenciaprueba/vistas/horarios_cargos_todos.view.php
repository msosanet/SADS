<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style2.css">
<title>HORARIOS CARGOS - TODOS</title>

</head>

<?
include 'header.php';  
$conexion = conectar();
?>


<body>
<div id="marco980" align="center"><!-- ***** DIV PRINCIPAL *** -->
<?
include 'snipet_barramenu.php';
?> 
<br>
<!-- *************** GRILLA MUESTRA HORARIOS ******************** -->    					
	<table border="1" cellpadding="1" cellspacing="0">
    	<tr bgcolor="#CCCCCC" align="center">          
    		<td width="180" bgcolor="#f4bc42">DOCENTE</td>
    		<td width="180" bgcolor="#f4bc42">CARGO</td>
    		<td width="80">LUNES</td>
    		<td width="80">MARTES</td>
    		<td width="80">MIÉRCOLES</td>
    		<td width="80">JUEVES</td>
    		<td width="80">VIERNES</td>
    		<td width="80">SÁBADO</td>  
    		<td width="40">ACCIÓN</td>
    	</tr>

<?
$buscahorarios = mysql_query ("SELECT * FROM horarios_cargos WHERE ver = '1' ORDER BY dni_docente");
while ($horariosdeldocente = mysql_fetch_array($buscahorarios)) {
?>

    	<tr bgcolor="#FFFFFF" align="center">
            <td align="left">
                <?
                    $dni_docente = $horariosdeldocente[dni_docente];
                    $docentestodos = mysql_query ("SELECT * FROM docentes WHERE dni = $dni_docente");
                    $docente = mysql_fetch_array ($docentestodos);
                    echo "<b>" . $docente[apellido] . ", " . $docente[nombre] . "</b>"; 
                ?>
            </td>
            <td>
                <?
                    $codigocurso = $horariosdeldocente[cargo];
                    $cargostodos = mysql_query ("SELECT * FROM curso WHERE codigo = $codigocurso");
                    $cargo = mysql_fetch_array ($cargostodos);
                    echo $cargo[descripcion]; 
                ?>
            </td>
    		<td><? echo substr($horariosdeldocente[lun_ent],0,5) . " a " . substr($horariosdeldocente[lun_sal],0,5); ?></td>
    		<td><? echo substr($horariosdeldocente[mar_ent],0,5) . " a " . substr($horariosdeldocente[mar_sal],0,5); ?></td>
    		<td><? echo substr($horariosdeldocente[mie_ent],0,5) . " a " . substr($horariosdeldocente[mie_sal],0,5); ?></td>
    		<td><? echo substr($horariosdeldocente[jue_ent],0,5) . " a " . substr($horariosdeldocente[jue_sal],0,5); ?></td>
    		<td><? echo substr($horariosdeldocente[vie_ent],0,5) . " a " . substr($horariosdeldocente[vie_sal],0,5); ?></td>
    		<td><? echo substr($horariosdeldocente[sab_ent],0,5) . " a " . substr($horariosdeldocente[sab_sal],0,5); ?></td> 
    		<td><? echo "<a href=\"horarios_cargos_modificar.php?id=$horariosdeldocente[id]\"><img src='images/b_edit.png'></a>"; ?>
                          <? echo "<a href=\"horarios_cargos_ocultar.php?id=$horariosdeldocente[id]\"><img src='images/b_drop.png'>"; ?></td>
            <!-- td><!-- ? echo substr($horariosdeldocente[id],0,5); ?></td -->
    	</tr>
        
<? } ?>		
    </table> 
</div>    
    <!-- *************** FIN GRILLA MUESTRA HORARIOS ******************** --> 
</body>
</html>
<? } ?> <!-- FIN BRACKET SESION -->
