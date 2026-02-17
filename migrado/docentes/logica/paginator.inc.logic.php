<?php

/**
 * Variables que se pueden definir antes de incluir el script vÃ­a include():
 * ------------------------------------------------------------------------
 * $_pagi_sql 					OBLIGATORIA.	Cadena. Debe contener una sentencia sql vÃ¡lida (y sin la clÃ¡usula "limit").
 
 * $_pagi_cuantos				OPCIONAL.		Entero. Cantidad de registros que contendrÃ¡ como mÃ¡ximo cada pÃ¡gina.
								Por defecto estÃ¡ en 20.
											
 * $_pagi_nav_num_enlaces		OPCIONAL		Entero. Cantidad de enlaces a los nÃºmeros de pÃ¡gina que se mostrarÃ¡n como 
								mÃ¡ximo en la barra de navegaciÃ³n.
								Por defecto se muestran todos.
											
 * $_pagi_mostrar_errores		OPCIONAL		Booleano. Define si se muestran o no los errores de MySQL que se puedan producir.
 								Por defecto estÃ¡ en "true";
											
 * $_pagi_propagar				OPCIONAL		Array de cadenas. Contiene los nombres de las variables que se quiere propagar
								por el url. Por defecto se propagarÃ¡n todas las que ya vengan por el url (GET).
 * $_pagi_conteo_alternativo	OPCIONAL		Booleano. Define si se utiliza mysql_num_rows() (true) o COUNT(*) (false).
								Por defecto estÃ¡ en false.
 * $_pagi_separador				OPCIONAL		Cadena. Cadena que separa los enlaces numÃ©ricos en la barra de navegaciÃ³n entre pÃ¡ginas.
 								Por defecto se utiliza la cadena " | ".
 * $_pagi_nav_estilo			OPCIONAL		Cadena. Contiene el nombre del estilo CSS para los enlaces de paginaciÃ³n.
 								Por defecto no se especifica estilo.
 * $_pagi_nav_anterior			OPCIONAL		Cadena. Contiene lo que debe ir en el enlace a la pÃ¡gina anterior. Puede ser un tag <img>.
 								Por defecto se utiliza la cadena "&laquo; Anterior".
 * $_pagi_nav_siguiente			OPCIONAL		Cadena. Contiene lo que debe ir en el enlace a la pÃ¡gina siguiente. Puede ser un tag <img>.
 								Por defecto se utiliza la cadena "Siguiente &raquo;"
 * $_pagi_nav_primera			OPCIONAL		Cadena. Contiene lo que debe ir en el enlace a la primera pÃ¡gina. Puede ser un tag <img>.
 								Por defecto se utiliza la cadena "&laquo;&laquo; Primera".
 * $_pagi_nav_ultima			OPCIONAL		Cadena. Contiene lo que debe ir en el enlace a la pÃ¡gina siguiente. Puede ser un tag <img>.
 								Por defecto se utiliza la cadena "&Uacute;ltima &raquo;&raquo;"
--------------------------------------------------------------------------
*/


/*
 * VerificaciÃ³n de los parÃ¡metros obligatorios y opcionales.
 *------------------------------------------------------------------------
 */
 if(empty($_pagi_sql)){
	// Si no se definiÃ³ $_pagi_sql... grave error!
	// Este error se muestra sÃ­ o sÃ­ (ya que no es un error de mysql)
	die("<b>Error Paginator : </b>No se ha definido la variable \$_pagi_sql");
 }
 
 if(empty($_pagi_cuantos)){
	// Si no se ha especificado la cantidad de registros por pÃ¡gina
	// $_pagi_cuantos serÃ¡ por defecto 20
	$_pagi_cuantos = 3;
 }
 
 if(!isset($_pagi_mostrar_errores)){
	// Si no se ha elegido si se mostrarÃ¡ o no errores
	// $_pagi_errores serÃ¡ por defecto true. (se muestran los errores)
	$_pagi_mostrar_errores = true;
 }

 if(!isset($_pagi_conteo_alternativo)){
	// Si no se ha elegido el tipo de conteo
	// Se realiza el conteo dese mySQL con COUNT(*)
	$_pagi_conteo_alternativo = false;
 }
 
 if(!isset($_pagi_separador)){
	// Si no se ha elegido un separador
	// Se toma el separador por defecto.
	$_pagi_separador = " | ";
 }
 
  if(isset($_pagi_nav_estilo)){
	// Si se ha definido un estilo para los enlaces, se genera el atributo "class" para el enlace
	$_pagi_nav_estilo_mod = "class=\"$_pagi_nav_estilo\"";
 }else{
 	// Si no, se utiliza una cadena vacÃ­a.
 	$_pagi_nav_estilo_mod = "";
 }
 
 if(!isset($_pagi_nav_anterior)){
	// Si no se ha elegido una cadena para el enlace "siguiente"
	// Se toma la cadena por defecto.
	$_pagi_nav_anterior = "&laquo; Anterior";
 } 
 
 if(!isset($_pagi_nav_siguiente)){
	// Si no se ha elegido una cadena para el enlace "siguiente"
	// Se toma la cadena por defecto.
	$_pagi_nav_siguiente = "Siguiente &raquo;";
 } 

 if(!isset($_pagi_nav_primera)){
	// Si no se ha elegido una cadena para el enlace "primera"
	// Se toma la cadena por defecto.
	$_pagi_nav_primera = "&laquo;&laquo; Primera";
 } 
 
 if(!isset($_pagi_nav_ultima)){
	// Si no se ha elegido una cadena para el enlace "siguiente"
	// Se toma la cadena por defecto.
	$_pagi_nav_ultima = "&Uacute;ltima &raquo;&raquo;";
 } 
 
//------------------------------------------------------------------------


/*
 * Establecimiento de la pÃ¡gina actual.
 *------------------------------------------------------------------------
 */
 if (empty($_GET['_pagi_pg'])){
	// Si no se ha hecho click a ninguna pÃ¡gina especÃ­fica
	// O sea si es la primera vez que se ejecuta el script
    	// $_pagi_actual es la pagina actual-->serÃ¡ por defecto la primera.
	$_pagi_actual = 1;
 }else{
	// Si se "pidiÃ³" una pÃ¡gina especÃ­fica:
	// La pÃ¡gina actual serÃ¡ la que se pidiÃ³.
    	$_pagi_actual = $_GET['_pagi_pg'];
 }
//------------------------------------------------------------------------


/*
 * Establecimiento del nÃºmero de pÃ¡ginas y del total de registros.
 *------------------------------------------------------------------------
 */
 // Contamos el total de registros en la BD (para saber cuÃ¡ntas pÃ¡ginas serÃ¡n)
 // La forma de hacer ese conteo dependerÃ¡ de la variable $_pagi_conteo_alternativo
 if($_pagi_conteo_alternativo == false){
 	$_pagi_sqlConta = eregi_replace("select[[:space:]](.*)[[:space:]]from", "SELECT COUNT(*) FROM", $_pagi_sql);
 	
	$_pagi_result2 = mysql_query($_pagi_sqlConta);
	// Si ocurriÃ³ error y mostrar errores estÃ¡ activado
 	if($_pagi_result2 == false && $_pagi_mostrar_errores == true){
		die (" Error en la consulta de conteo de registros: $_pagi_sqlConta. Mysql dijo: <b>".mysql_error()."</b>");
 	}
 	$_pagi_totalReg = mysql_result($_pagi_result2,0,0);//total de registros
 }else{
	$_pagi_result3 = mysql_query($_pagi_sql);
	// Si ocurriÃ³ error y mostrar errores estÃ¡ activado
 	if($_pagi_result3 == false && $_pagi_mostrar_errores == true){
		die (" Error en la consulta de conteo alternativo de registros: $_pagi_sql. Mysql dijo: <b>".mysql_error()."</b>");
 	}
	$_pagi_totalReg = mysql_num_rows($_pagi_result3);
 }
 // Calculamos el nÃºmero de pÃ¡ginas (saldrÃ¡ un decimal)
 // con ceil() redondeamos y $_pagi_totalPags serÃ¡ el nÃºmero total (entero) de pÃ¡ginas que tendremos
 $_pagi_totalPags = ceil($_pagi_totalReg / $_pagi_cuantos);

//------------------------------------------------------------------------


/*
 * PropagaciÃ³n de variables por el URL.
 *------------------------------------------------------------------------
 */
 // La idea es pasar tambiÃ©n en los enlaces las variables hayan llegado por url.
 $_pagi_enlace = $_SERVER['PHP_SELF'];
 $_pagi_query_string = "?";
 
 if(!isset($_pagi_propagar)){
 	//Si no se definiÃ³ quÃ© variables propagar, se propagarÃ¡ todo el $_GET (por compatibilidad con versiones anteriores)
	//PerdÃ³n... no todo el $_GET. Todo menos la variable _pagi_pg
	if (isset($_GET['_pagi_pg'])) unset($_GET['_pagi_pg']); // Eliminamos esa variable del $_GET
	$_pagi_propagar = array_keys($_GET);
 }elseif(!is_array($_pagi_propagar)){
	// si $_pagi_propagar no es un array... grave error!
	die("<b>Error Paginator : </b>La variable \$_pagi_propagar debe ser un array");
 }
 
 foreach($_pagi_propagar as $var){
 	if(isset($GLOBALS[$var])){
		// Si la variable es global al script
		$_pagi_query_string.= $var."=".$GLOBALS[$var]."&";
	}elseif(isset($_REQUEST[$var])){
		// Si no es global (o register globals estÃ¡ en OFF)
		$_pagi_query_string.= $var."=".$_REQUEST[$var]."&";
	}
 }

 // AÃ±adimos el query string a la url.
 $_pagi_enlace .= $_pagi_query_string;
 
//------------------------------------------------------------------------


/*
 * GeneraciÃ³n de los enlaces de paginaciÃ³n.
 *------------------------------------------------------------------------
 */
 // La variable $_pagi_navegacion contendrÃ¡ los enlaces a las pÃ¡ginas.
 $_pagi_navegacion_temporal = array();
 if ($_pagi_actual != 1){
	// Si no estamos en la pÃ¡gina 1. Ponemos el enlace "primera"
	$_pagi_url = 1; //serÃ¡ el nÃºmero de pÃ¡gina al que enlazamos
	$_pagi_navegacion_temporal[] = "<a ".$_pagi_nav_estilo_mod." href='".$_pagi_enlace."_pagi_pg=".$_pagi_url."'>$_pagi_nav_primera</a>";

	// Si no estamos en la pÃ¡gina 1. Ponemos el enlace "anterior"
	$_pagi_url = $_pagi_actual - 1; //serÃ¡ el nÃºmero de pÃ¡gina al que enlazamos
	$_pagi_navegacion_temporal[] = "<a ".$_pagi_nav_estilo_mod." href='".$_pagi_enlace."_pagi_pg=".$_pagi_url."'>$_pagi_nav_anterior</a>";
 }
 
 // La variable $_pagi_nav_num_enlaces sirve para definir cuÃ¡ntos enlaces con 
 // nÃºmeros de pÃ¡gina se mostrarÃ¡n como mÃ¡ximo.
 // Ojo: siempre se mostrarÃ¡ un nÃºmero impar de enlaces. MÃ¡s info en la documentaciÃ³n.
 
 if(!isset($_pagi_nav_num_enlaces)){
	// Si no se definiÃ³ la variable $_pagi_nav_num_enlaces
	// Se asume que se mostrarÃ¡n todos los nÃºmeros de pÃ¡gina en los enlaces.
	$_pagi_nav_desde = 1;//Desde la primera
	$_pagi_nav_hasta = $_pagi_totalPags;//hasta la Ãºltima
 }else{
	// Si se definiÃ³ la variable $_pagi_nav_num_enlaces
	// Calculamos el intervalo para restar y sumar a partir de la pÃ¡gina actual
	$_pagi_nav_intervalo = ceil($_pagi_nav_num_enlaces/2) - 1;
	
	// Calculamos desde quÃ© nÃºmero de pÃ¡gina se mostrarÃ¡
	$_pagi_nav_desde = $_pagi_actual - $_pagi_nav_intervalo;
	// Calculamos hasta quÃ© nÃºmero de pÃ¡gina se mostrarÃ¡
	$_pagi_nav_hasta = $_pagi_actual + $_pagi_nav_intervalo;
	
	// Ajustamos los valores anteriores en caso sean resultados no vÃ¡lidos
	
	// Si $_pagi_nav_desde es un nÃºmero negativo
	if($_pagi_nav_desde < 1){
		// Le sumamos la cantidad sobrante al final para mantener el nÃºmero de enlaces que se quiere mostrar. 
		$_pagi_nav_hasta -= ($_pagi_nav_desde - 1);
		// Establecemos $_pagi_nav_desde como 1.
		$_pagi_nav_desde = 1;
	}
	// Si $_pagi_nav_hasta es un nÃºmero mayor que el total de pÃ¡ginas
	if($_pagi_nav_hasta > $_pagi_totalPags){
		// Le restamos la cantidad excedida al comienzo para mantener el nÃºmero de enlaces que se quiere mostrar.
		$_pagi_nav_desde -= ($_pagi_nav_hasta - $_pagi_totalPags);
		// Establecemos $_pagi_nav_hasta como el total de pÃ¡ginas.
		$_pagi_nav_hasta = $_pagi_totalPags;
		// Hacemos el Ãºltimo ajuste verificando que al cambiar $_pagi_nav_desde no haya quedado con un valor no vÃ¡lido.
		if($_pagi_nav_desde < 1){
			$_pagi_nav_desde = 1;
		}
	}
 }

 for ($_pagi_i = $_pagi_nav_desde; $_pagi_i<=$_pagi_nav_hasta; $_pagi_i++){//Desde pÃ¡gina 1 hasta Ãºltima pÃ¡gina ($_pagi_totalPags)
	if ($_pagi_i == $_pagi_actual) {
		// Si el nÃºmero de pÃ¡gina es la actual ($_pagi_actual). Se escribe el nÃºmero, pero sin enlace y en negrita.
		$_pagi_navegacion_temporal[] = "<span ".$_pagi_nav_estilo_mod.">$_pagi_i</span>";
	}else{
		// Si es cualquier otro. Se escibe el enlace a dicho nÃºmero de pÃ¡gina.
		$_pagi_navegacion_temporal[] = "<a ".$_pagi_nav_estilo_mod." href='".$_pagi_enlace."_pagi_pg=".$_pagi_i."'>".$_pagi_i."</a>";
	}
 }

 if ($_pagi_actual < $_pagi_totalPags){
	// Si no estamos en la Ãºltima pÃ¡gina. Ponemos el enlace "Siguiente"
	$_pagi_url = $_pagi_actual + 1; //serÃ¡ el nÃºmero de pÃ¡gina al que enlazamos
	$_pagi_navegacion_temporal[] = "<a ".$_pagi_nav_estilo_mod." href='".$_pagi_enlace."_pagi_pg=".$_pagi_url."'>$_pagi_nav_siguiente</a>";

	// Si no estamos en la Ãºltima pÃ¡gina. Ponemos el enlace "Ãšltima"
	$_pagi_url = $_pagi_totalPags; //serÃ¡ el nÃºmero de pÃ¡gina al que enlazamos
	$_pagi_navegacion_temporal[] = "<a ".$_pagi_nav_estilo_mod." href='".$_pagi_enlace."_pagi_pg=".$_pagi_url."'>$_pagi_nav_ultima</a>";
 }
 $_pagi_navegacion = implode($_pagi_separador, $_pagi_navegacion_temporal);

//------------------------------------------------------------------------


/*
 * ObtenciÃ³n de los registros que se mostrarÃ¡n en la pÃ¡gina actual.
 *------------------------------------------------------------------------
 */
 // Calculamos desde quÃ© registro se mostrarÃ¡ en esta pÃ¡gina
 // Recordemos que el conteo empieza desde CERO.
 $_pagi_inicial = ($_pagi_actual-1) * $_pagi_cuantos;
 
 // Consulta SQL. Devuelve $cantidad registros empezando desde $_pagi_inicial
 $_pagi_sqlLim = $_pagi_sql." LIMIT $_pagi_inicial,$_pagi_cuantos";
 $_pagi_result = mysql_query($_pagi_sqlLim);
 // Si ocurriÃ³ error y mostrar errores estÃ¡ activado
 if($_pagi_result == false && $_pagi_mostrar_errores == true){
 	die ("Error en la consulta limitada: $_pagi_sqlLim. Mysql dijo: <b>".mysql_error()."</b>");
 }

//------------------------------------------------------------------------


/*
 * GeneraciÃ³n de la informaciÃ³n sobre los registros mostrados.
 *------------------------------------------------------------------------
 */
 // NÃºmero del primer registro de la pÃ¡gina actual
 $_pagi_desde = $_pagi_inicial + 1;
 
 // NÃºmero del Ãºltimo registro de la pÃ¡gina actual
 $_pagi_hasta = $_pagi_inicial + $_pagi_cuantos;
 if($_pagi_hasta > $_pagi_totalReg){
 	// Si estamos en la Ãºltima pÃ¡gina
	// El ultimo registro de la pÃ¡gina actual serÃ¡ igual al nÃºmero de registros.
 	$_pagi_hasta = $_pagi_totalReg;
 }
 
 $_pagi_info = "Resultado $_pagi_desde hasta el $_pagi_hasta de un total de $_pagi_totalReg";

//------------------------------------------------------------------------


/**
 * Variables que quedan disponibles despuÃ©s de incluir el script vÃ­a include():
 * ------------------------------------------------------------------------
 
 * $_pagi_result		Identificador del resultado de la consulta a la BD para los registros de la pÃ¡gina actual. 
 				Listo para ser "pasado" por una funciÃ³n como mysql_fetch_row(), mysql_fetch_array(), 
				mysql_fetch_assoc(), etc.
							
 * $_pagi_navegacion		Cadena que contiene la barra de navegaciÃ³n con los enlaces a las diferentes pÃ¡ginas.
 				Ejemplo: "<<primera | <anterior | 1 | 2 | 3 | 4 | siguiente> | Ãºltima>>".
							
 * $_pagi_info			Cadena que contiene informaciÃ³n sobre los registros de la pÃ¡gina actual.
 				Ejemplo: "desde el 16 hasta el 30 de un total de 123";				

*/
?>

