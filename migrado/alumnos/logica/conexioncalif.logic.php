<?php
function conectarcalif()
{
	mysql_connect("192.168.0.249", "root", "msi2010");
	return (mysql_select_db("calificadores"));

}

function desconectarcalif()
{
	mysql_close();
}
function conectarcalif_bdp()
{
	mysql_connect("192.168.0.249", "root", "msi2010");
	return (mysql_select_db("calificadores-bdprueba"));

}

function desconectarcalif_bdp()
{
	mysql_close();
}

?>

