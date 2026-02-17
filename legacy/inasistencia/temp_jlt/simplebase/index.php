<?php
//including the database connection file
include_once("config.php");
 
//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
$result = mysqli_query($mysqli, "SELECT * FROM users ORDER BY id DESC"); // using mysqli_query instead
?>
 
<html>
<head>    
    <title>Homepage</title>
</head>
 
<body>
    <a href="add.html">AGREGAR DATOS</a><br/><br/>
 
    <table width='80%' border=1 cellspacing="0" cellpadding="2">
        <tr align="center" bgcolor='#CCCCCC' height="40">
            <td>Nombre</td>
            <td>Edad</td>
            <td>Email</td>
            <td>Editar</td>
        </tr>
        <?php 
        //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array 
        while($res = mysqli_fetch_array($result)) {         
            echo "<tr height='40'>";
            echo "<td>".$res['name']."</td>";
            echo "<td align='center'>".$res['age']."</td>";
            echo "<td>".$res['email']."</td>";    
            echo "<td align='center'><a href=\"edit.php?id=$res[id]\">Cambiar</a> | <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Borrar</a></td>";        
        }
        ?>
    </table>
</body>
</html>
