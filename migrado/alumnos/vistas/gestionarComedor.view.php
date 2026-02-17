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
            include 'generarCodigoComedor.php';
            $sql = "SELECT * FROM comedor";
            $res = mysql_fetch_assoc(mysql_query($sql));
            
            if(isset($_GET['alumno'])) {

                $sql="SELECT c.dni_alumno,c.digito_control,c.fecha FROM comedor_habilitados AS c WHERE c.dni_alumno='$_GET[alumno]' AND c.digito_control IS NOT NULL ORDER BY c.fecha DESC";
                // Verifico si alguna vez fue habilitado.
                $resultado = mysql_query($sql);
                $digito = null;
                if (mysql_num_rows($resultado) > 0) {
                    // Si fue registrado ya tiene un codigo para comedor.
                    $fila = mysql_fetch_assoc($resultado);
                    $digito = $fila["digito_control"];
                } else {
                    // Si no se lo genera con el documento
                    $digito = generarCodigo($_GET['alumno']);
                }
                $sql="INSERT INTO comedor_habilitados (habilitado,dni_alumno,   digito_control) VALUES ('" . $_GET['hab'] . "', '" . $_GET['alumno'] . "', " . $digito . ") ";
                
                if (mysql_query($sql)) {
                    ?>
                    <script>
                    var answer=alert("Alumno habilitado!")
                    </script>
                    <meta content='0; URL=gestionarComedor.php'>
                    <?
                } else {
                    
                    ?>
                    <script>
                    var answer=alert("No se pudo habilitar al alumno")
                    </script>
                    <meta content='0; URL=gestionarComedor.php'>
                    <?
                }
            }
        ?>
        <body>  

        <div style="align:center;max-width: 980px">
            <form method="GET" action="gestionarComedor.php">
            <? 
                if ($_SESSION['valor']==1) include 'menuppal2.php';
            ?>
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
                    
                    $descripcion = $_GET['descripcion'];
                    if(isset($_GET['descripcion'])) {
                        $_pagi_sql = "SELECT a.apellido, a.nombre, a.dni, COALESCE(c.habilitado, 0) AS habilitado FROM alumno AS a LEFT JOIN comedor_habilitados AS c ON a.dni = c.dni_alumno WHERE a.apellido LIKE '%$descripcion%' OR a.dni LIKE '%$descripcion%' OR a.nombre LIKE '%$descripcion%' AND c.fecha = (SELECT MAX(fecha) FROM comedor_habilitados WHERE dni_alumno = a.dni) ORDER BY a.apellido ASC";
                    } else {
                        $_pagi_sql = "SELECT a.apellido, a.nombre, a.dni, COALESCE(c.habilitado, 0) AS habilitado FROM alumno AS a LEFT JOIN comedor_habilitados AS c ON a.dni = c.dni_alumno ORDER BY a.apellido ASC";
                    }
                    
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
                            <td width="200" align="center" height="36">Apellido</td>
                            <td width="200" align="center" height="36">Nombre</td>
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

                                <td width="20" align="center"><? echo $fila2['dni']; ?></td>
                                <td width="20" align="center"><? echo $fila2['apellido']; ?></td>
                                <td width="20" align="center"><? echo $fila2['nombre']; ?></td>
                                <td bgcolor="<?echo $colorhab; ?>"><a href = "gestionarComedor.php?alumno=<?echo $fila2['dni'];?>&hab=<?echo $hab;?>"><?echo $estado;?></a></td>
                            
                        
                            </tr>
                        <?
                             }
                        ?>    
                    </table>
            <?  
                //}  // Cierre de la tabla
            ?>	
            </form>
            </div>
        </body>

        <?
        include 'footer.php';
        ?>

    </html>
<? } ?>

