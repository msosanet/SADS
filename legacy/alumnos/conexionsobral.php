<?php
function conectarsobral()
{
	mysql_connect("192.168.0.249", "calificadores", "msi2010");
	mysql_select_db("base_sobral");
}

function desconectarsobral()
{
	mysql_close();
}

?>