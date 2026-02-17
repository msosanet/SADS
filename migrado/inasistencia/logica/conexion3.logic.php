<?php
function conectar()
{
	mysql_connect("localhost", "fgoicoechea", "sobral2011");
	mysql_select_db("base_sobral");
}

function desconectar()
{
	mysql_close();
}


function conectarsobral()
{
	mysql_connect("localhost", "fgoicoechea", "sobral2011");
	mysql_select_db("base_sobral");
}

function desconectarsobral()
{
	mysql_close();
}

?>

