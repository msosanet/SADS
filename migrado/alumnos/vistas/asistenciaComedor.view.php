<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
            <meta http-equiv="Content-Language" content="es-ar">
            <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
            <link rel="stylesheet" type="text/css" href="style2.css" />

            <title>Comedor</title>

            <style>
                    
            </style>
        </head>
        <?PHP
            include 'header.php';
        ?>
        <body>  
            <div style="align:center;max-width: 980px">
                <? 
                    if ($_SESSION['valor']==1) include 'menuppal2.php';
                ?>
                <?
                    include 'generarCodigoBarra.php';
                    if (isset($_GET['generador'])) {
                        
                        if (isset($_GET['scanInput'])) {
                            debug_to_console("Esta seteado");
                            generarCodigoBarraFunc($_GET['scanInput']);
                        }
                    }
                ?>
                <form method="GET" action="asistenciaComedor.php">
                    <input id="scanInput" name="scanInput" />
                    <input type="submit" value="   Generar codigo   " name="generador" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" />
                </form>
                <form method="GET" action="asistenciaComedor.php">
                
                <br>
                <p align="left" class="titulo">Buscar alumno</p>
                <br>
                    <div align="left">
                            
                    <table border="0">
                        <tr>
                            <td class="titulo2">Ingrese el Apellido, D.N.I. o parte de él:</td>
                            <td align="right">&nbsp;<input type="text" name="descripcion" id="descripcion" size="35" maxlength="40" value="" autofocus/></td>
                            <td><input type="submit" value="   Buscar   " name="muestra2" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
                        </tr>
                    </table>
                    </div>
                <br>
                <?
                    // if (isset($_GET['muestra2'])) { 
                    //     $descripcion = $_GET['descripcion'];
                        $_pagi_sql = "SELECT * FROM comedor_habilitados";
                        $_pagi_cuantos = 20;
                        $_pagi_conteo_alternativo = true;
                        $_pagi_nav_num_enlaces = 10;
                        include("paginator.inc.php"); 
                ?>
                        <table border="1" width="900" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
                            <tr>
                                <td class="text1b" colspan="5" height="40" align="left">
                                &nbsp;Resultado de la B&uacute;squeda</td>
                            </tr>
                            <tr bgcolor="#CCCCCC">
                                <td width="20" align="center" height="36">DNI</td>
                                <!-- <td width="200" align="center" height="36">Apellido</td>
                                <td width="200" align="center" height="36">Nombre</td> -->
                                <td width="200" align="center" height="36">Habilitado</td>
                            </tr>
                            <? 
                            while ($fila2 = mysql_fetch_array($_pagi_result)) {	
                                if ($fila2['habilitado']==1)
                                    {
                                    $estado="Deshabilitar";
                                    $colorhab="FF0000";
                                    $hab=0;
                                    }
                                else
                                {
                                    $estado="Habilitar";
                                    $colorhab="00FF00";
                                    $hab=1;
                                    }
                                    ?> <tr bgcolor="#EEEEEE"> 

                                    <td width="20" align="center"><? echo $fila2['dni_alumno']; ?></td>
                                    <!-- <td width="20" align="center"><? echo $fila2['apellido']; ?></td>
                                    <td width="20" align="center"><? echo $fila2['nombre']; ?></td> -->
                                    <td bgcolor="<?echo $colorhab; ?>"><a href = "asistenciaComedor.php?alumno=<?echo $fila2['dni'];?>&hab=<?echo $hab;?>"><?echo $estado;?></a></td>
                                
                            
                                </tr>
                            <?
                                }
                            ?>    
                        </table>
                <?  
                    // }  // Cierre de la tabla
                ?>	
                </form>
                </div>
            </body>

        <?
        include 'footer.php';
        ?>

        <script language=javascript> 
        
        </script>
    </html>
<? } ?>

