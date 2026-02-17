<!DOCTYPE html>

<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="style2.css">

<title>NORMATIVA</title>
</head>

<body>

<div id="marco980">

<!-- **************** ENCABEZADO Y BARRA DE MENÚS *************** -->
<?
include 'header.php';

if ($_SESSION['valor']==1)
{
include 'menuppal2.php';
}
if ($_SESSION['valor']==0)
{
include 'menuppal.php';
}
if ($_SESSION['valor']==3)
{
include 'menuppal3.php';
}
if ($_SESSION['valor']==4)
{
include 'menuppal4.php';
}
if ($_SESSION['valor']==5)
{
include 'menuppal5.php';
}
?>
<!-- **************** FIN BARRA DE MENÚS *************** -->
<br>
<p class="titulo">NORMATIVA Y DOCUMENTOS DE REFERENCIA</p><br>

<div id="normativa">  <!-- ++++++++ MENU NORMATIVA +++++++++++ -->

<div class="menu">
<ul>
    <li><a href="#" id="current">Leyes</a>
           <ul>
               <li><a href="webinfo/legislacion/Leyes%20nacionales/" target="main_normativa">Nacionales</a></li>
               <li><a href="webinfo/legislacion/Leyes%20provinciales/" target="main_normativa">Provinciales</a></li>
               <li><a href="webinfo/legislacion/Leyes%20y%20decretos%20Territoriales" target="main_normativa">Territoriales</a></li>
           </ul>
    </li>
    <li><a href="#" id="current">Decretos</a>
           <ul>
               <li><a href="webinfo/legislacion/Decretos%20nacionales/" target="main_normativa">Nacionales</a></li>
               <li><a href="webinfo/legislacion/Decretos%20provinciales/" target="main_normativa">Provinciales</a></li>
               <li><a href="webinfo/legislacion/Leyes%20y%20decretos%20Territoriales/" target="main_normativa">Territoriales</a></li>
           </ul>
    </li>
</li>
<li><a href="#" id="current">Resol MinEduc</a>
    <ul>
 	<li><a href="webinfo/legislacion/Resoluciones%20Ministerio%20Educacion/2019" target="main_normativa">2019</a></li>
        <li><a href="webinfo/legislacion/Resoluciones%20Ministerio%20Educacion/2018" target="main_normativa">2018</a></li>
        <li><a href="webinfo/legislacion/Resoluciones%20Ministerio%20Educacion/2017" target="main_normativa">2017</a></li>
        <li><a href="webinfo/legislacion/Resoluciones%20Ministerio%20Educacion/2016" target="main_normativa">2016</a></li>
        <li><a href="webinfo/legislacion/Resoluciones%20Ministerio%20Educacion/2015" target="main_normativa">2015</a></li>
        <li><a href="webinfo/legislacion/Resoluciones%20Ministerio%20Educacion/2014" target="main_normativa">2014</a></li>
        <li><a href="webinfo/legislacion/Resoluciones%20Ministerio%20Educacion/2013" target="main_normativa">2013</a></li>
        <li><a href="webinfo/legislacion/Resoluciones%20Ministerio%20Educacion/2012" target="main_normativa">2012</a></li>
        <li><a href="webinfo/legislacion/Resoluciones%20Ministerio%20Educacion/2011" target="main_normativa">2011</a></li>
        <li><a href="webinfo/legislacion/Resoluciones%20Ministerio%20Educacion/2010" target="main_normativa">2010</a></li>
        <li><a href="webinfo/legislacion/Resoluciones%20Ministerio%20Educacion/2009" target="main_normativa">2009</a></li>
        <li><a href="webinfo/legislacion/Resoluciones%20Ministerio%20Educacion/2008" target="main_normativa">2008</a></li>
        <li><a href="webinfo/legislacion/Resoluciones%20Ministerio%20Educacion/2007" target="main_normativa">2007</a></li>
        <li><a href="webinfo/legislacion/Resoluciones%20Ministerio%20Educacion/2006" target="main_normativa">2006</a></li>
        <li><a href="webinfo/legislacion/Resoluciones%20Ministerio%20Educacion/1978%20a%202005" target="main_normativa">1978 a 2005</a></li>
    </ul>
    </li>
        <li><a href="#" id="current">Por tema</a>
        <ul>   
            <li><a href="webinfo/legislacion/Agrupados%20por%20tema/SIGE-COMEGE" target="main_normativa">SIGE - COMEGE</a></li>   
            <li><a href="webinfo/legislacion/Agrupados%20por%20tema/SIEP" target="main_normativa">SIEP</a></li>
            <li><a href="webinfo/legislacion/Agrupados%20por%20tema/educacion_sexual" target="main_normativa">Educación Sexual</a></li>
            <li><a href="webinfo/legislacion/Agrupados%20por%20tema/implem%204%20ESO" target="main_normativa">Implementación 4º año E.S.O.</a></li>
            <li><a href="webinfo/legislacion/Agrupados%20por%20tema/calendario%20escolar%202017/" target="main_normativa">Calendario Escolar 2017</a></li>
            <li><a href="webinfo/legislacion/Agrupados%20por%20tema/Estudiantes%20extranjeros" target="main_normativa">Estudiantes extranjeros</a></li>
            <li><a href="webinfo/legislacion/Agrupados%20por%20tema/Fines" target="main_normativa">Plan FinEs</a></li>
            <li><a href="webinfo/legislacion/Agrupados%20por%20tema/Pomys%20resoluciones" target="main_normativa">P.O.M. y S.</a></li>
            <li><a href="webinfo/legislacion/Documentos Consejo Federal de Educación" target="main_normativa">Consejo Federal de Educación</a></li>
            <li><a href="webinfo/legislacion/Agrupados%20por%20tema/Titularizacion" target="main_normativa">Titularización</a></li>
            <li><a href="webinfo/legislacion/Agrupados%20por%20tema/Normativa vigente 2016.pdf" target="main_normativa">Normativa vigente 2016</a></li>
            <li><a href="webinfo/legislacion/Agrupados%20por%20tema/viajes_de_estudio/" target="main_normativa">Viajes de Estudio</a></li>
            <li><a href="webinfo/legislacion/Agrupados%20por%20tema/EstatutoDocente" target="main_normativa">Estatuto del Docente</a></li>
            </ul>
        </li>
    <li><a href="#" id="current">Circulares por tema</a>
           <ul>
               <li><a href="webinfo/legislacion/Decretos%20nacionales/" target="main_normativa">Ausentismo en día de paro</a></li>
           </ul>
    </li>
</ul>
</div>
</div> <!-- +++++++++ FIN MENU NORMATIVA ++++++++++++ -->
<div align="center"><!-- +++++++++++++++ MARCO MUESTRA NORMA ++++++++++++++ -->

  <iframe name="main_normativa" width=960 height=500 src="webinfo/blank.htm" border="yes"></iframe>

</div><!-- +++++++++++++++ MARCO MUESTRA NORMA ++++++++++++++ -->
</div>
</body>
</html>

<? } ?>
