<?php
function conectar()
{
	mysql_connect("192.168.0.249", "root", "");
	mysql_select_db("alumnos");
}

function desconectar()
{
	mysql_close();
}

?>

