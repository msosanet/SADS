<?PHP
// Usado por cargar_ina.php
    function debug_to_console($data)
        {
            $output = $data;
            if (is_array($output)) {
                $output = implode(',', $output);
            }

            echo "<script>console.log('" . $output . "' );</script>";
        }
    session_start();

	$_SESSION['probando'] = true; // Comentar en producción

    if ($_SESSION['estado']==1) {
        include 'conexion55.php';
        conectaralumnos();
        if (isset($_SESSION['probando'])) if ($_SESSION['probando']) mysql_select_db('alumnos-prueba');

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
                /* Estilos base para el cartel */
                .alerta {
                    display: none;
                    position: fixed;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    border-radius: 10px;
                    border: 1px solid #707070;
                    padding: 20px;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra para profundidad */
                    text-align: center; /* Centrar el texto */
                    width: 300px; /* Ancho fijo para consistencia */
                }

                /* Estilos para el motivo y mensaje */
                .alerta h2 {
                    font-size: 20px;
                    color: #333;
                    margin-bottom: 10px;
                }

                .alerta p {
                    font-size: 16px;
                    color: #555;
                    margin-bottom: 20px;
                }

                /* Estilos específicos para acceso concedido */
                .alerta.concedido {
                    background-color: #e8f5e9; /* Verde claro */
                    border-color: #a5d6a7; /* Verde más oscuro para el borde */
                }

                alerta.concedido h2 {
                    color: #43a047; /* Verde oscuro para el título */
                }

                /* Estilos específicos para acceso denegado */
                .alerta.denegado {
                    background-color: #ffebee; /* Rojo claro */
                    border-color: #ef9a9a; /* Rojo más oscuro para el borde */
                }

                alerta.denegado h2 {
                    color: #e57373; /* Rojo oscuro para el título */
                }
                a.disabled { /* Esta clase sirve para dehsabilitar el boton Anular asistencia */
                    pointer-events: none;
                    cursor: default;
                    display: none;
                }
                .botonAnular {
                    background-color: #ffff;
                }
            </style>
            <script>
            function establecerFoco() {
				document.getElementById("scanInput").focus();
            }
            </script>
        </head>
        <?PHP
            include 'header.php';
        ?>

        <body onload="establecerFoco()">
            <div style="align:center;max-width: 980px">
                <?
                    if ($_SESSION['valor']==3) include 'menuppal3.php';

                    if(isset($_GET['anular']) && isset($_GET['id'])) {
                        $sql = "UPDATE comedor_asistencia SET permitido = 0 WHERE id = " . $_GET['id'];

                        debug_to_console('Anulado -> ' .$_GET['anular'] . '' .$_GET['id']);
                        if(mysql_query($sql)) {
                            echo "Registro actualizado correctamente";
                        } else {
                            echo "Error al actualizar registro: " . $conn->error;
                        }
                    }

                ?>
            <!--    <form method="GET" action="<?=$_SERVER['PHP_SELF']?>">  -->

                <br>
           <!--     <p style="background-color: red; color: white" align="center" class="titulo">NO USAR - MODULO EN DESARROLLO</p> -->

                <p align="center" class="titulo">Acá se ingresa el código</p>
                <p align="center" class="titulo">por lector o manualmente</p>

                <input id="scanInput" name="scanInput" oninput="debounceEnviarFormulario()" />
                <br>
                    <div align="left">

                    <table border="0">
                        <tr>
                            <!-- <td class="titulo2">Ingrese el Apellido, D.N.I. o parte de él:</td>
                            <td align="right">&nbsp;<input type="text" name="descripcion" id="descripcion" size="35" maxlength="40" value="" autofocus/></td>
                            <td><input type="submit" value="   Buscar   " name="muestra2" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td> -->
                        </tr>
                    </table>
                    </div>
                <br>
                <?
                    // if (isset($_GET['muestra2'])) {
                    //     $descripcion = $_GET['descripcion'];
                        $_pagi_sql = "SELECT a.apellido, a.nombre, a.dni,c.id,c.fecha,c.permitido FROM alumno as a JOIN comedor_asistencia as c ON a.dni = c.dni_alumno ORDER BY c.fecha,c.id DESC";
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
                            <tr>
                                <td class="text1b" colspan="5" height="40" align="left">
                                &nbsp;Resultado de la B&uacute;squeda</td>
                            </tr>
                            <tr bgcolor="#CCCCCC">
                                <td width="50" align="center" height="36">DNI</td>
                                <td width="200" align="center" height="36">Nombre</td>
                                <td width="200" align="center" height="36">Apellido</td>
                                <td width="100" align="center" height="36">Fecha</td>
                                <td width="200" align="center" height="36">Permitdo</td>
                                <td width="200" align="center" height="36">Anular</td>
                            </tr>
                            <?
                            while ($fila2 = mysql_fetch_array($_pagi_result)) {
                                if ($fila2['permitido']==0)
                                    {
                                        $estado="Acceso Denegado - Anulado";
                                        $colorhab="FF0000";
                                        $hab=0;
                                        $clase="disabled";
                                    }
                                else
                                    {
                                        $estado="Acceso Permitido";
                                        $colorhab="00FF00";
                                        $hab=1;
                                        $clase="";
                                    }
                                    ?> <tr bgcolor="#EEEEEE">
                                    <td width="20" align="center"><? echo $fila2['dni']; ?></td>
                                    <td width="20" align="center"><? echo $fila2['nombre']; ?></td>
                                    <td width="20" align="center"><? echo $fila2['apellido']; ?></td>
                                    <td width="20" align="center"><? echo $fila2['fecha']; ?></td>
                                    <td bgcolor="<?echo $colorhab; ?>"><?echo $estado;?></td>
                                    <td class="botonAnular"><a class="<?=$clase; ?>" href="<?=$_SERVER['PHP_SELF']?>?anular=<?=$fila2['dni'];?>&id=<?=$fila2['id'];?>">Anular asistencia</a></td>




                                </tr>
                            <?
                                }
                            ?>
                        </table>
                <?
                    // }  // Cierre de la tabla
                ?>
                <!-- </form> -->
                <div id="alertaAccesoConcedido" class="alerta concedido">
                    <h2>Acceso Concedido</h2>
                    <p>Puede ingresar al comedor.</p>
                </div>

                <div id="alertaAccesoDenegado" class="alerta denegado">
                    <h2>Acceso Denegado</h2>
                    <p>No tiene permisos para ingresar al comedor.</p>
                </div>
                <!-- <div id="alertaLimiteDias" >
                    <p id="motivoAlerta" ></p>
                    <p id="mensajeAlerta" ></p>
                </div> -->
                </div>
            </body>

        <?
        include 'footer.php';
        ?>

        <script language=javascript>

            const fecha = new Date();

            const anio =fecha.getFullYear();
            const mes = String(fecha.getMonth()+1).padStart(2, '0'); // Los meses van de 0 a 11
            const dia = String(fecha.getDate()).padStart(2, '0');

            const fechaFormateada = `${anio}-${mes}-${dia}`;

            async function fetchAsistencia(codigo) {

                try {
                    const response = await fetch('consultaAsistenciaDelDia.php',{
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded' // Importante para enviar datos en el cuerpo de la petición
                        },
                        body: `codigo=${codigo}&fecha=${fechaFormateada}` // Enví­a los datos en el cuerpo de la petición
                    })

                    if (!response.ok) { // Manejo de errores de respuesta HTTP
                        throw new Error(`error HTTP - estado: ${response.status}`);
                    }

                    const data = await response.json();
                    console.log(data)
                    // Posible logica de confirmacion de la asistencia
                    return data; // Retorna la cantidad
                } catch (error) {
                    console.error('Error en consultar consultaAsistenciaDelDia:', error);
                    return undefined; // Retorna undefined en caso de error
                }
            }
            let temporizador;
            function mostrarAlerta(tipo) {
                document.getElementById(tipo ? "alertaAccesoConcedido" : "alertaAccesoDenegado").style.display = "block";

                // document.getElementById("alertaLimiteDias").style.display = "block";k
            }
            function cerrarAlerta(e) {
                document.getElementById("alertaAccesoConcedido").style.display = "none";
                document.getElementById("alertaAccesoDenegado").style.display = "none";
                location.reload();
            }
            function debounceEnviarFormulario() {
                var scanInput = document.getElementById("scanInput");
                clearTimeout(temporizador); // Limpia el temporizador anterior

                temporizador = setTimeout(async function() {
                    if (scanInput.value.trim() !== "") {
                        const data = await fetchAsistencia(scanInput.value);

                        if(data.asistio > 0 && data.habilitado == 0) {
                            mostrarAlerta(false)
                            setTimeout(() => cerrarAlerta(),1500)
                        } else if (data.habilitado == 1) {
                            mostrarAlerta(true)
                            setTimeout(() => cerrarAlerta(),1500)
                        } else {
                            mostrarAlerta(false)
                            setTimeout(() => cerrarAlerta(),1500)
                        }
                    }
                }, 1000);
			}



        </script>
    </html>
<? } ?>
