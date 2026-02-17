<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style2.css" />
<script language=javascript>
function ventanaSecundaria (URL){
   window.open(URL,"ventana1","width=300,height=300,scrollbars=NO")
}
</script>

<title>HORARIOS CARGOS - VER</title>

</head>

<?
include 'header.php';
$conexion = conectar();

//Tabla "usuarios": usuario - pass - valor - apellido - nombre - sector
$usuario = $_SESSION['usuario'];
$pass = $_SESSION['contrasenia'];
$chkusr = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario'") ;
$userdata = mysql_fetch_array($chkusr);
$fecha = date('Y-m-d');
$fechaDMA = date('d-m-Y');
$hora = date('H:i');
?>

<body>
<div id="marco980" align="center"><!-- ***** DIV PRINCIPAL *** -->


<?
  include 'snipet_barramenu.php'; //********* DESPLIEGA MENU DE ACUERDO CON TIPO DE USUARIO
?>
<p>&nbsp;</p>

<!-- *********** FORMULARIO PARA CONSULTAR HORARIO ***************** -->
<div id="nov_form_container" align="left">

<form action="horarios_cargos_ver.php" method="post" name="form10">

    <p class="titulo" align="center">CONSULTAR HORARIO DE DOCENTE CON CARGO</p>
    <hr>
    <br>

<!-- LISTA DE DOCENTES PARA ELEGIR *********************************** -->                    
			<span class="titulo">Docente: </span>
            <select style="border: 1px solid #888888; background-color: #ffffff; border-radius: 5px; padding: 4px 0 4px 0; box-shadow: 0 0 2px #555555;" size="1" name="docente" autofocus="true">
            <option>- - - - - -</option>
            <? $listadocentes = mysql_query ("SELECT * FROM docentes WHERE identificacion = 1 ORDER BY apellido,nombre");
            
            	while ($docente = mysql_fetch_array($listadocentes)) {			
					echo "<option>" . $docente[apellido] . " " . $docente[nombre] . " - D.N.I. Nº " . $docente[dni] . "</option>";
				    }
		    ?>
            </select>
<!-- FIN LISTA DE DOCENTES PARA ELEGIR *********************************************** -->
       
    &nbsp;<input type="submit" value=" Consultar " name="consultar" style="border: 1px solid #C0C0C0;  border-radius: 5px; padding: 4px 10px 4px 10px; background-color: #ffd56b; font-weight:700; font-size: 14px; box-shadow: 0 0 2px #555555;"/>
              
            <?  
                $docenteMAX = $_POST['docente'];
                $buscadocente = mysql_query("SELECT * FROM docentes WHERE CONCAT(apellido,' ',nombre,' - D.N.I. Nº ',dni) = '$docenteMAX'");
                $docentedatos = mysql_fetch_array($buscadocente);  
            ?>
              
<br>
<br>
<!-- ************ MUESTRA LEYENDA CON NOMBRE DEL DOCENTE ********************* -->
<? 
    if ($_POST['docente'] !== "- - - - - -") {
        echo "<p class='titulo'>Horarios de " . $docenteMAX;// . " - D.N.I. Nº " . number_format($docentedatos[dni],0, '.', '.'); 
        }
    //else { 
    //  echo "<br>";
    //  } 
?> 
<br>

<div align="center"> <!-- *************** GRILLA MUESTRA HORARIOS ******************** -->
    <? $buscahorarios = mysql_query ("SELECT * FROM horarios_cargos WHERE dni_docente = $docentedatos[dni]");
    ?>
    					
	<table border="1" width="100%" cellpadding="1" cellspacing="0">
    	<tr bgcolor="#CCCCCC" align="center">
    		<td width="180" bgcolor="#f4bc42">CARGO</td>
    		<td>LUNES</td>
    		<td>MARTES</td>
    		<td>MIÉRCOLES</td>
    		<td>JUEVES</td>
    		<td>VIERNES</td>
    		<td>SÁBADO</td>  
    		<td>ACCIÓN</td>
    	</tr>
        
        <?  //al cargar la página mostrará una fila en blanco en la grilla de horarios 
            if ($docenteMAX == "- - - - - -") {
                echo "
                <tr bgcolor='#ffffff'>
                   <td width='180'>&nbsp</td>
            	   <td>&nbsp</td>
            	   <td>&nbsp</td>
            	   <td>&nbsp</td>
            	   <td>&nbsp</td>
            	   <td>&nbsp</td>
            	   <td>&nbsp</td>  
            	   <td>&nbsp</td>
                </tr>";
                }
            else {
            while ($horariosdeldocente = mysql_fetch_array($buscahorarios)) {
        ?>
        
    	<tr bgcolor="#FFFFFF" align="center">
            <td>
                <?
                    $codigocurso = $horariosdeldocente[cargo];
                    $cargostodos = mysql_query ("SELECT * FROM curso WHERE codigo = $codigocurso");
                    $cargo = mysql_fetch_array ($cargostodos);
                    echo "<b>" . $cargo[descripcion] . "</b>"; 
                ?>
            </td>
    		<td><? echo substr($horariosdeldocente[lun_ent],0,5) . " a " . substr($horariosdeldocente[lun_sal],0,5); ?></td>
    		<td><? echo substr($horariosdeldocente[mar_ent],0,5) . " a " . substr($horariosdeldocente[mar_sal],0,5); ?></td>
    		<td><? echo substr($horariosdeldocente[mie_ent],0,5) . " a " . substr($horariosdeldocente[mie_sal],0,5); ?></td>
    		<td><? echo substr($horariosdeldocente[jue_ent],0,5) . " a " . substr($horariosdeldocente[jue_sal],0,5); ?></td>
    		<td><? echo substr($horariosdeldocente[vie_ent],0,5) . " a " . substr($horariosdeldocente[vie_sal],0,5); ?></td>
    		<td><? echo substr($horariosdeldocente[sab_ent],0,5) . " a " . substr($horariosdeldocente[sab_sal],0,5); ?></td> 
    		<td><? echo "<a href=\"horarios_cargos_modificar.php?id=$horariosdeldocente[id]\"><img src='images/b_edit.png'></a>"; ?>
                          <? echo "<a href=\"infoutil_articulo_ocultar.php?id=$horariosdeldocente[id]\"><img src='images/b_drop.png'>"; ?></td>
            <!-- td><!-- ? echo substr($horariosdeldocente[id],0,5); ?></td -->
    	</tr>
        
        <? 
            }
        }
        ?>		
    </table> <!-- *************** FIN GRILLA MUESTRA HORARIOS ******************** --> 
<br>
<p align="left"><span class="titulo">REGISTR&Oacute;: </span><? echo $userdata[nombre]; ?></p> <!-- $userdata [nombre] tiene el nombre del usuario activo en la sesión -->  
<br> 

</div>
</div>    <!-- ************* FIN FORMULARIO ******************** -->

</form>
</div>  
<?
        }
?>

<p>&nbsp;</p>

<? include 'footer.php'; ?>

</div> <!-- ****************** FIN DIV PRINCIPAL ************ -->
</body>

<? //} ?>

</html>