<?php

function conectarcalif()
{
	$bdobj = new mysqli("192.168.0.249", "root", "","calificadores");
	return $bdobj;

}

function desconectarcalif($bdobj)
{
	$bdobj->close();
}

?>


