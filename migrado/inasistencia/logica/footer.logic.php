<?PHP
if (isset($_SESSION['usuario'])) $fondoPie = ($_SESSION['usuario'] == "goicof" OR $_SESSION['usuario'] == "fgoicoechea")? "style='background-color:gray; background-image: none'" : "";
?>




<footer <?=$fondoPie?>>Colegio Provincial Dr. Jos&eacute; Mar&iacute;a Sobral - Copyright <?=date('Y')?> Todos los derechos reservados
</footer>

</html>

