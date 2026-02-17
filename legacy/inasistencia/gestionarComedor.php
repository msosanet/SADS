<?PHP
// Usado por cargar_ina.php
    session_start();
    function debug_to_console($data)
    {
        $output = $data;
        if (is_array($output)) {
            $output = implode(',', $output);
        }

        echo "<script>console.log('" . $output . "' );</script>";
    }


    if ($_SESSION['estado']==1) {
        include 'conexion55.php';
        conectaralumnos();
		if (isset($_SESSION['probando'])) if ($_SESSION['probando']) mysql_select_db('alumnos-prueba');
	$descripcion = isset($_GET['descripcion']) ? $_GET['descripcion'] : "";;

?>
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
            include 'generarCodigoBarra.php';
            $sql = "SELECT * FROM comedor_habilitados";
            $a =mysql_query($sql);
            $res = mysql_fetch_assoc($a);

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
                    generarCodigoBarraFunc( $_GET['alumno'] . $digito);
                }
                $sql="INSERT INTO comedor_habilitados (habilitado,dni_alumno,   digito_control) VALUES ('" . $_GET['hab'] . "', '" . $_GET['alumno'] . "', " . $digito . ") ";

                if (mysql_query($sql)) {
                    if($_GET['hab'] == 1) {
                        ?>
                            <script>
                            var answer=alert("Alumno habilitado")
                            </script>
                            <meta content='0; URL=gestionarComedor.php'>
                        <?
                    } else {
                        ?>
                            <script>
                            var answer=alert("Alumno deshabilitado")
                            </script>
                            <meta content='0; URL=gestionarComedor.php'>
                        <?
                    }
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
                if ($_SESSION['valor']==3) include 'menuppal3.php';
				if (isset($_SESSION['probando'])) printf("<p>PRUEBA PRUEBA PRUEBA PRUEBA PRUEBA PRUEBA PRUEBA PRUEBA </p>");
            ?>
            <br>
            <p align="center" class="titulo">Buscar alumno</p>
            <br>
                <div align="left">

                <table border="0">
                    <tr>
                        <td class="titulo2">Ingrese el Apellido, D.N.I. o parte de él:</td>
                        <td align="right">&nbsp;<input type="text" name="descripcion" id="descripcion" size="35" maxlength="40" value="<?=$descripcion?>" autofocus/></td>
                        <td><input type="submit" value="   Buscar   " name="muestra2" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
                    </tr>
                </table>
                </div>
            <br>
            <?
                
                // Obtengo el ultimo estado del permiso de un alumno, si esta habilitado o no
                if(strlen($descripcion)) {// Teniendo en cuenta la descripcion
                    $_pagi_sql = "SELECT alumno,curso,divi,COALESCE(habilitado,0) AS habilitado,digito_control,CONCAT(apellido, ' ',nombre) AS estudiante FROM (SELECT * FROM (SELECT alumno,curso,divi FROM `cursa` WHERE control = 1 AND anio = '2025' AND divi NOT LIKE '-%' AND divi NOT LIKE 'E%' AND divi NOT LIKE 'L%') AS nuestros LEFT JOIN (SELECT * FROM comedor_habilitados AS ch WHERE ch.fecha = (SELECT MAX(fecha) FROM comedor_habilitados WHERE dni_alumno = ch.dni_alumno )) estadoc ON estadoc.dni_alumno = nuestros.alumno) AS sit_comedor LEFT JOIN alumno ON sit_comedor.alumno = alumno.dni WHERE apellido LIKE '%$descripcion%' OR nombre LIKE '%$descripcion%' OR dni LIKE '%$descripcion%' ORDER BY habilitado DESC,apellido,nombre"; 
                } else { // Todos los alumnos
                    $_pagi_sql = "SELECT alumno,curso,divi,COALESCE(habilitado,0) AS habilitado,digito_control,CONCAT(apellido, ' ',nombre) AS estudiante FROM (SELECT * FROM (SELECT alumno,curso,divi FROM `cursa` WHERE control = 1 AND anio = '2025' AND divi NOT LIKE '-%' AND divi NOT LIKE 'E%' AND divi NOT LIKE 'L%') AS nuestros LEFT JOIN (SELECT * FROM comedor_habilitados AS ch WHERE ch.fecha = (SELECT MAX(fecha) FROM comedor_habilitados WHERE dni_alumno = ch.dni_alumno )) estadoc ON estadoc.dni_alumno = nuestros.alumno) AS sit_comedor LEFT JOIN alumno ON sit_comedor.alumno = alumno.dni ORDER BY habilitado DESC,apellido,nombre";
                }

                $_pagi_cuantos = 20;
                $_pagi_conteo_alternativo = true;
                $_pagi_nav_num_enlaces = 10;
                include("paginator.inc.php");
            ?>
            <p align="left">
            <?
            echo "$_pagi_navegacion";
            ?>
            <br><br>
            </p>
                    <table border="1" width="900" id="table1" cellpadding="0" cellspacing="0" bordercolor="#C0C0C0">
					<thead>
                    <?PHP  if (strlen($descripcion)) { echo '  <tr> 
                            <td class="text1b" colspan="6" height="40" align="left"> 
                            &nbsp;Resultado de la B&uacute;squeda</td> 
					</tr> '; } ?>
                        <tr bgcolor="#CCCCCC">
                            <td style="text-align: center">DNI</td>
                            <td>Estudiante</td>
                            <td style="text-align: center">Curso</td>
                            <td style="text-align: center">División</td>
                            <td>Habilitado</td>
							<td>Acci&oacute;n</td>
                        </tr>
					</thead>
                        <?
                        while ($fila2 = mysql_fetch_array($_pagi_result)) {

                            if ($fila2['habilitado']==1)
                                {

                                $estado="Deshabilitar";
								$iconoEstado = "habilitado.png";
                                $colorhab="#00FF00";
                                $hab=0;
                                }
                            else
                            {
                                $estado="Habilitar";
								$iconoEstado = "deshabilitado.png";
                                $colorhab="#FF0000";
                                $hab=1;
                            }
                                ?> <tr bgcolor="#EEEEEE">

                                <td style="text-align: center"><a href="alumnopreceptor.php?dni=<?=$fila2['alumno']?>"><?=$fila2['alumno']?></a></td>
                                <td><a href="alumnopreceptor.php?dni=<?=$fila2['alumno']?>"><?=$fila2['estudiante']; ?></a></td>
                                <td style="text-align: center"><?=$fila2['curso']; ?></td>
                                <td style="text-align: center"><?=$fila2['divi']; ?></td>
								<td style="text-align:center;background-color:<?=$colorhab?>"><img src="<?=$iconoEstado?>" alt="estado" style="horizontal-align:middle" width="20"></td>
                                <td><a href = "gestionarComedor.php?alumno=<?=$fila2['alumno'];?>&hab=<?echo $hab;?>"><?echo $estado;?></a></td>


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
<br>

        <?
        include 'footer.php';
        ?>

    </html>
<? }
printf("<!-- %s -->",var_export($_SESSION,true));
 ?>
