<?php
function conectar()
{
	mysql_connect("localhost", "root", "");
	mysql_select_db("calificadores");
}

function desconectar()
{
	mysql_close();
}



?>


