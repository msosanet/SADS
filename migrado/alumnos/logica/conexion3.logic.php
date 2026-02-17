<?php
function conectar()
{
	mysql_connect("localhost", "root", "msi2010");
	mysql_select_db("calificadores");
}

function desconectar()
{
	mysql_close();
}



?>

