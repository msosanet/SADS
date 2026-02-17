<?php

function conectarcalif()
{
	$bdobj = new mysqli("192.168.0.249", "root", "msi2010","calificadores");
	return $bdobj;

}

function desconectarcalif($bdobj)
{
	$bdobj->close();
}

?>

