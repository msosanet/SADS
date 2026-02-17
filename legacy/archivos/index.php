<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Colegio Dr. Jose Maria Sobral</title>
<?php
include 'header.php'; ?>

</head>
 
<body>


<br><br>

<script type="text/javascript">
function download(d) {
        if (d == 'Seleccione el Curso') return;
        window.location = 'http://archivos.colegiosobral.edu.ar/' + d;
}
</script>



<p align="left">
 <br><br><font size="6">PASO 1:</font> Descargue el archivo del curso donde ud. dicta clases, seleccione el curso y automaticamente se descargara una planilla de Excel con los alumnos de su curso y division:
<br><br></p>



<p align="center">
<select name="download" onChange="download(this.value)">
<option>Seleccione el Curso</option>
<option value="aa.xlsx">Aula Aceleracion</option>
<option value="11.xlsx">1ro 1ra</option>
<option value="12.xlsx">1ro 2da</option>
<option value="13.xlsx">1ro 3ra</option>
<option value="14.xlsx">1ro 4ta</option>
<option value="15.xlsx">1ro 5ta</option>
<option value="16.xlsx">1ro 6ta</option>
<option value="17.xlsx">1ro 7ma</option>
<option value="110.xlsx">1ro 10ma</option>
<option value="111.xlsx">1ro 11va</option>

<option value="21.xlsx">2do 1ra</option>
<option value="22.xlsx">2do 2da</option>
<option value="23.xlsx">2do 3ra</option>
<option value="24.xlsx">2do 4ta</option>
<option value="25.xlsx">2do 5ta</option>
<option value="27.xlsx">2do 7ma</option>
<option value="28.xlsx">2do 8va</option>
<option value="29.xlsx">2do 9na</option>
<option value="210.xlsx">2do 10ma</option>
<option value="211.xlsx">2do 11va</option>

<option value="31.xlsx">3ro 1ra</option>
<option value="32.xlsx">3ro 2da</option>
<option value="33.xlsx">3ro 3ra</option>
<option value="34.xlsx">3ra 4ta</option>
<option value="35.xlsx">3ro 5ta</option>
<option value="36.xlsx">3ro 6ta</option>
<option value="37.xlsx">3ro 7ma</option>
<option value="38.xlsx">3ro 8va</option>
<option value="39.xlsx">3ro 9na</option>

<option value="41.xlsx">4to 1ra</option>
<option value="42.xlsx">4to 2da</option>
<option value="43.xlsx">4to 3ra</option>
<option value="44.xlsx">4to 4ta</option>
<option value="45.xlsx">4to 5ta</option>
<option value="46.xlsx">4to 6ta</option>
<option value="47.xlsx">4to 7ma</option>
<option value="48.xlsx">4to 8va</option>
<option value="49.xlsx">4to 9na</option>

<option value="51.xlsx">5to 1ra</option>
<option value="52.xlsx">5to 2da</option>
<option value="53.xlsx">5to 3ra</option>
<option value="54.xlsx">5to 4ta</option>
<option value="55.xlsx">5to 5ta</option>
<option value="56.xlsx">5to 6ta</option>
<option value="57.xlsx">5to 7ma</option>

<option value="61.xlsx">6to 1ra</option>
<option value="62.xlsx">6to 2da</option>
<option value="63.xlsx">6to 3ra</option>
<option value="64.xlsx">6to 4ta</option>
<option value="65.xlsx">6to 5ta</option>
<option value="66.xlsx">6to 6ta</option>
<option value="67.xlsx">6to 7ma</option>



</select></p>

<br><br><center><img src="separador.png" alt="pero que separador mas lindo!"></center>

<p align="left">

<br><font size="6">PASO 2:</font> Complete el archivo descargado con su apellido y asignatura junto con los calificadores para cada alumno.</p><br><br>
<center><img src="profeasigna.png" alt="para los profes"></center>
<p align="left">
<br>Recuerde que el nombre del archivo debera contener Curso - Division - Materia - Apellido<br/>
<br>Ej: Profesor Perez de Geografia de 1ro 4ta <br/>
<br>Ej: 1-4-Geografia-Perez <br/>
<br><br></p>

<br><br><center><img src="separador.png" alt="pero que separador mas lindo!"></center>

<p align="left">

<br><br><font size="6">PASO 3:</font> Seleccione el/los archivo/s que completo presionando el boton "Elegir Archivos" y luego presione "Enviar.</p><br><br>
</p>

<?php

    
    
# definimos la carpeta destino
    $carpetaDestino="archivos/";
 
    # si hay algun archivo que subir
    if($_FILES["archivo"]["name"][0])
    {
 
        # recorremos todos los arhivos que se han subido
        for($i=0;$i<count($_FILES["archivo"]["name"]);$i++)
        {
 
            # si es un formato valido
            if($_FILES["archivo"]["type"][$i]=="application/vnd.openxmlformats-officedocument.wordprocessingml.document" || $_FILES["archivo"]["type"][$i]=="application/vnd.ms-excel" || $_FILES["archivo"]["type"][$i]=="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" || $_FILES["archivo"]["type"][$i]=="application/msword")
            {
 
                # si exsite la carpeta o se ha creado
                if(file_exists($carpetaDestino) || @mkdir($carpetaDestino))
                {
                    $origen=$_FILES["archivo"]["tmp_name"][$i];
                    $destino=$carpetaDestino.$_FILES["archivo"]["name"][$i];
 
                    # movemos el archivo
                    if(@move_uploaded_file($origen, $destino))
                    {
                        echo "<br>".$_FILES["archivo"]["name"][$i]." ARCHIVO SUBIDO CORRECTAMENTE";
                    }else{
                        echo "<br>ERROR! No se ha podido mover el archivo: ".$_FILES["archivo"]["name"][$i];
                    }
                }else{
                    echo "<br>No se ha podido crear la carpeta: up/".$user;
                }
            }else{
                echo "<br>".$_FILES["archivo"]["name"][$i]." - EL ARCHIVO QUE DESEA SUBIR NO ES COMPATIBLE, solo son aceptados archivos de word, excel y pdf";
            }
        }
    }else{
        echo "<br>No se ha subido ningun archivo<br/>";
    }
    ?>
 
    <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data" name="inscripcion">
        <br><input type="file" name="archivo[]" multiple="multiple"><br/>
        <br><br><br><input type="submit" value="Enviar"  class="trig">
    </form>


</body>
</html>
