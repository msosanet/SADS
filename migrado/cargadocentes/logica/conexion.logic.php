<?php
function conectar()
{
	mysql_connect("localhost", "fgoicoechea", "sobral2011");
	mysql_select_db("sid");
}

function desconectar()
{
	mysql_close();
}



?>

