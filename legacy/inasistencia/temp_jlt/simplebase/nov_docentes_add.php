<html>
<head>
    <title>Add Data</title>
</head>
 
<body>
<?php
//including the database connection file
include_once("conexion.php");
 
if(isset($_POST['Submit'])) {    
    $tema = $_POST['tema'];
    $aviso = $_POST['aviso'];
        
    // checking empty fields
    if(empty($tema) || empty($tema)) {
        if(empty($tema)) {
            echo "<font color='red'>Asunto field is empty.</font><br/>";
        }
        
        if(empty($aviso)) {
            echo "<font color='red'>Aviso field is empty.</font><br/>";
        }
        
        //link to the previous page
        echo "<br/><a href='javascript:self.history.back();'>Volver</a>";
    } else { 
        // if all the fields are filled (not empty)             
        //insert data to database
        $result = mysqli_query($mysqli, "INSERT INTO nov_docentes(codigo,tema,aviso,fecha,grabo,borrado) VALUES(0,'$tema','$aviso',0,'x',1)");
        
        //display success message
        echo "<font color='green'>Datos agregados correctamente.";
        echo "<br/><a href='index.php'>Ver resultado</a>";
    }
}
?>
</body>
</html>
