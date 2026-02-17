<?PHP
$linkcalif2 = mysqli_connect("localhost", "root", "msi2010", "calificadores") or die ("ERROR!!!"); 
$sqlplazoxmateria="SELECT DISTINCT c.curso, c.materia, c2.division, c2.curso AS cursox FROM calificador2 c JOIN curso2 c2 ON c.curso = c2.idcurso WHERE idnota = '7' AND anio = '2023'";
$resultplazoxmat = mysqli_query ($linkcalif2,$sqlplazoxmateria);

while ($fila2 = mysqli_fetch_array($resultplazoxmat))
		{	
		$insertapermiso="INSERT INTO plazocarga VALUES ('','2024-03-01 00:00:00','2024-03-03 23:59:59','7','$fila2[cursox]','$fila2[division]','$fila2[materia]','')";
		echo $insertapermiso;
		
		}
?>