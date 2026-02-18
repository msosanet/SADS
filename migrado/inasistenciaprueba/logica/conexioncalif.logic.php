<?php
function conectarcalif()
{
	mysql_connect("192.168.0.249", "root", "");
	mysql_select_db("calificadores");
}

function desconectarcalif()
{
	mysql_close();
}

?>

