<html> 
<body> 
  
<?php 
$link = mysql_connect("localhost", "root","msi2010"); 
mysql_select_db("sid", $link); 
$result = mysql_query("SELECT * FROM alumnos", $link); 
$filax2 = mysql_fetch_array($resultxx);

if ($row = mysql_fetch_array($result)){ 
   echo "<table border = '1'> \n"; 
   echo "<tr><td>Alumno</td><td>DNI</td><td>Materia</td></tr> \n"; 
   do { 
      echo "<tr><td>".$row["alumno"]."</td><td>".$row["dni"]."</td><td>".$row[""]."</td></tr> \n"; 
   } while ($row = mysql_fetch_array($result)); 
   echo "</table> \n"; 
} else { 
echo "¡ No se ha encontrado ningún registro !"; 
} 
?> 
  
</body> 
</html>
