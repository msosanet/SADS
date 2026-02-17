<?php
function conectar()
{
	mysql_connect("192.168.0.249", "root", "msi2010");
	mysql_select_db("alumnos");
}

function desconectar()
{
	mysql_close();
}

?>
