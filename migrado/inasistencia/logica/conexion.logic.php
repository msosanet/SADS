<?
function conectar()
{
	mysql_connect("192.168.0.249", "fgoicoechea", "sobral2011");
	mysql_select_db("sid");
	return true;
}

function desconectar()
{
	mysql_close();
}

function conectaralumnos()
{
	mysql_connect("192.168.0.249", "fgoicoechea", "sobral2011");
	mysql_select_db("sid");
	return true;
}

function desconectaralumnos()
{
	mysql_close();
}
?>

