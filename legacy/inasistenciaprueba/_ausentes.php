<?php
/* Funciones para ser utilizadas por "Semanal en Pizarra"
** ver_piza.php
*/
	
$artSombreados = array (
	"5" => "motivo5",
	"89" => "motivo89",
	"55" => "motivo55",
	"10" => "motivo10",
	"11" => "motivo11",
	"12" => "motivo12",
	"13" => "motivo13",
	"1" => "motivo1",
	"39" => "motivo39",
	"32" => "motivo32",
	"27" => "motivo27",
	"81" => "motivo81", 
	"92" => "motivo92",
	"58" => "motivo58",
	"49" => "motivo49",
	"75" => "motivo75",
	"50" => "motivo50",
	"65" => "motivo65",
	"69" => "motivo69"
	);

	
function tabular($ausentes) {
	global $hoy, $ini_semana, $fin_semana;
	$semana = fechasSemana($ini_semana,$fin_semana);
	$lineas_de_tabla = array();
	$docente = $ausentes[0][1];
	$articulo = $ausentes[0][3];
	$ult_fecha = $ausentes[0][2];
	$fecha = date("Y-m-d",strtotime("-15 day",strtotime($hoy)));
	$consecutivos = 1;
	$nL= 0; // numero de linea
	$lineas_de_tabla[$nL] = array (
		"doc" => "<td>&nbsp;</td>",
		"lu" => "<td>&nbsp;</td>",
		"ma" => "<td>&nbsp;</td>",
		"mi" => "<td>&nbsp;</td>",
		"ju" => "<td>&nbsp;</td>",
		"vi" => "<td>&nbsp;</td>",
	);
	$lic_largas = array ();
	foreach ($ausentes as $dia) {
		if ($dia[1]==$docente && $dia[3]==$articulo) { // repite par docente/articulo
			if (strtotime($dia[2])>strtotime($fecha) && strtotime($dia[2])<=strtotime($fin_semana)) {
				//está entre los últimos 14 días y el proximo fin de semana
				if (strtotime($dia[2])==strtotime(siguiente($ult_fecha))) {	$consecutivos++;} 
				else { $consecutivos = 1; }
				if ($consecutivos < 15 && strtotime($dia[2]) >= strtotime($ini_semana)) 
//				if ($consecutivos < 15 && strtotime($dia[2]) >= strtotime($ini_semana) && isset($lineas_de_tabla)) 
					{ $lineas_de_tabla[$nL] = arma_tr($dia,$lineas_de_tabla[$nL]); } // Cuando hay mas de 14 consecutivos se muestra de otro modo
//				else $lineas_de_tabla[$nL] = arma_tr($dia,array());
				if ($consecutivos == 15 && strtotime($dia[2]) >= strtotime($ini_semana)) {
					array_pop($lineas_de_tabla);
					if($nL>0) $nL--;
					array_push($lic_largas,$dia);
				} // los datos van a otro array y se quita la última linea
				$ult_fecha = $dia[2];
			}
		} else { //empieza otro par docente/articulo
			$docente = $dia[1];
			$articulo = $dia[3];
			$ult_fecha = $dia[2];
			$consecutivos = 1;
			$cabeceras = array (
				"doc" => "<td>&nbsp;</td>",
				"lu" => "<td>&nbsp;</td>",
				"ma" => "<td>&nbsp;</td>",
				"mi" => "<td>&nbsp;</td>",
				"ju" => "<td>&nbsp;</td>",
				"vi" => "<td>&nbsp;</td>",
			);
//			if (count(array_diff($lineas_de_tabla,$cabeceras))<>0) {
			if (count(array_diff($lineas_de_tabla[$nL],$cabeceras))<>0) {
				//Crea una nueva línea si se ha completado algo en la anterior
				$nL++;
				$lineas_de_tabla[$nL] = $cabeceras;
			}
//			if (strtotime($dia[2])>=strtotime($ini_semana) && strtotime($dia[2])<=strtotime($fin_semana)) {
			if (strtotime($dia[2])>=strtotime($ini_semana) && strtotime($dia[2])<=strtotime($fin_semana) && isset($lineas_de_tabla[$nL])) {
				$lineas_de_tabla[$nL] = arma_tr($dia,$lineas_de_tabla[$nL]);
			}
		}
	}
	return array($lineas_de_tabla, $lic_largas);
}

function siguiente($fecha) { //devuelve el dia siguiente de $fecha
	return date("Y-m-d",strtotime("+1 day",strtotime($fecha)));
}

function arma_tr($dia,$tr) {
	// prepara <tr> para docente, articulo
	global $hoy, $ini_semana, $fin_semana;
	$semana = fechasSemana($ini_semana,$fin_semana);
//	global $semana;
		$tr["doc"] = "<td>" . $dia[11] . ", " . $dia[10] . /*" (" . $dia[0] . ")" . */"</td>"; 
		switch (strtotime($dia[2])) {
			case $semana["lunes"]:
				$tr["lu"] = infoVisible($dia);
				continue;
			case $semana["martes"]:
				$tr["ma"] = infoVisible($dia);
				continue;
			case $semana["miercoles"]:
				$tr["mi"] = infoVisible($dia);
				continue;
			case $semana["jueves"]:
				$tr["ju"] = infoVisible($dia);
				continue;
			case $semana["viernes"]:
				$tr["vi"] = infoVisible($dia); 
		}
	return $tr;
}

function infoVisible($dia){
	global $hoy,$artSombreados;
	if ($dia[6]==0) { 
				if ($dia[3]=='20' OR $dia[3]=='21' OR $dia[3]=='89' OR $dia[3]=='10' OR $dia[3]=='12' OR $dia[3]=='16' OR $dia[3]=='22'  OR $dia[3]=='25'  OR $dia[3]=='24' OR $dia[3]=='75' OR $dia[3]=='84'){
					$observa = $dia[8] . " <dfn>" . $dia[4] . "</dfn>";
				} 
				else { $observa=$dia[8]; }
	} else {
		if(isset($dia[12])){
					$observa = $dia[12];
				} else { $observa="<dfn>Ausente</dfn>";}
	}//revisar para art 16 y 27
	if (strtotime($dia[2])==strtotime($hoy)){ $realce = " style=\"border:ridge;\" ";}
	else { $realce="";}
	if (array_key_exists($dia[3],$artSombreados)) {
		$id = " id=\"" . $artSombreados[$dia[3]] . "\"";
	} else { $id = ""; }
	$info = "<td align=\"center\"" . $id . $realce . ">" . $observa . "</td>";
	return $info;
}


function fechasSemana($ini_semana,$fin_semana) {
	return array (
	"lunes" => strtotime($ini_semana),
	"martes" => strtotime("next Tuesday",strtotime($ini_semana)),
	"miercoles" => strtotime("next Wednesday",strtotime($ini_semana)),
	"jueves" => strtotime("last Thursday",strtotime($fin_semana)),
	"viernes" => strtotime($fin_semana)
	);		
}

function mostrar($array) {
//	echo "<table><tr><th>Docente</th><th>Lunes</th><th>Martes</th>" . "<th>Miércoles</th><th>Jueves</th><th>Viernes</th></tr>\n";
	echo "<table>\n";
	foreach ($array as $linea ) {
		echo "<tr><td>" . implode($linea) . "</td></tr>\n";
//		htmlentities(var_export($linea),ENT_COMPAT | ENT_XHTML,"cp1252");
//		htmlentities(var_export(iconv("ISO-8859-1","UTF-8",$linea[3])),ENT_COMPAT | ENT_XHTML,"cp1252");
//		echo "<br>";
	}
	echo "</table>";
}

function acomodarClaves($array) {
	if (is_array($array)) {
		$arreglado = array();
	foreach ($array as $clave => $valor) {
		if (isset($valor[12])) {
			$arreglado[$clave] = array(
				11 => $valor[11],
				10 => $valor[10],
				6 => $valor[6],
				3 => $valor[3],
				8 => $valor[8],
				1 => $valor[1],
				3 => $valor[3],
				4 => $valor[4],
				12 => $valor[12]
				);
		} else {
			$arreglado[$clave] = array(
				11 => $valor[11],
				10 => $valor[10],
				6 => $valor[6],
				3 => $valor[3],
				8 => $valor[8],
				1 => $valor[1],
				3 => $valor[3],
				4 => $valor[4]
				);
		}
	}}
	return $arreglado; 
}

function mostrarld($array) {
	if (is_array($array) && count($array,1)>1) {
		echo "<table id='tableam' ><tr><th>Personal justificado por más de 10 días consecutivos</th></tr>\n";
		foreach ($array as $linea ) {
			if ($linea[6]==0) {
				if ($linea[3]=='20' OR $linea[3]=='21' OR $linea[3]=='89' OR $linea[3]=='10' OR $linea[3]=='12' OR $linea[3]=='16' OR $linea[3]=='22'  OR $linea[3]=='25'  OR $linea[3]=='24' OR $linea[3]=='75' OR $linea[3]=='84') {
					$info = " por "  . $linea[8] . " <dfn>" . $linea[4] . "</dfn>";
				} else { $info = " por "  . $linea[8]; }
			} else {
				if(isset($linea[12])){
					$info = $linea[12];
				} else { $info = "";}
			} //Revisar para art 16 y 27
		echo "<tr><td>" . $linea[11] . ", " . $linea[10] . " hasta el " . finArt($linea[1],$linea[3]) . $info .  "</td></tr>\n";
		}
		echo "</table>\n";
	}
}

function finArt($doc,$motivo) {
	//consultar a la BD por el último día para $doc y $motivo
	$fin_art = mysql_query("SELECT MAX(fecha_hasta) FROM ausentes WHERE docente = $doc AND motivo = $motivo");
	$hasta_arr = mysql_fetch_array($fin_art);
	return date("d/m/Y",strtotime($hasta_arr[0])); 
//	return date("d/m/Y");
}

function capturarArt($array) {
	//capturar art 16 y 27 (llega tarde/anula)
	$revisando = true;
	do {
		foreach ($array as $key => $dia) {
			if ($dia[3]=="16" || $dia[3]=="27") {
				$revisando = true;
				$linea = $dia;
				$kBorrar = $key;
				break;
			}
			$revisando = false;
		}
		if (isset($kBorrar)){
			array_splice($array,$kBorrar,1);
			unset($kBorrar);
			foreach ($array as &$otroMvo) {
				if ($linea[1]==$otroMvo[1] && $linea[2]==$otroMvo[2]) {
					switch ($linea[3]) {
						case "16":
							if($otroMvo[6]==0) {
								$otroMvo[8] = "<mark id=\"motivo16\">(Llega más tarde)</mark> " . $otroMvo[8];
							} else {
								$otroMvo[] = "<mark id=\"motivo16\">(Llega más tarde)</mark>";
							}
							continue;
						case "27":
							if($otroMvo[6]==0) {
								$otroMvo[8] = "<mark id=\"motivo27\">(Anulado)</mark> " . $otroMvo[8];
							} else {
								$otroMvo[] = "<mark id=\"motivo27\">(Anulado)</mark>";
							}
					}
				}
			}
			unset ($linea);
		}
	} while ($revisando);
	return $array;
}

function sanitizarChars($ause){
	foreach ($ause as &$fila) {
		if (is_array($fila)){
			foreach ($fila as &$valor) {
				$valor = iconv("ISO-8859-1","UTF-8",$valor);
			}
		}
	}
	return $ause;
}

function consultaArchivo($nom_archivo) {
	if ($tabla = fopen($nom_archivo,'r')) {
		$i = 0;
		while ($array[$i] = fgetcsv($tabla,0,';','"')) { $i++; }
		fclose($tabla);
	}
	return $array;
}
?>
