<?php




/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

function checkqhoras($curso)
{
	mysql_connect("192.168.0.249", "fgoicoechea", "sobral2011");
	mysql_select_db("sid");
	//$resultt = mysql_query ("SELECT COUNT(idmateria) as Q, FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
	$sql="SELECT COUNT(h.idmateria) AS Q, mc.nombre, mc.cant_hs,mc.id FROM horariox2 h JOIN materia_cargo mc ON h.idmateria = mc.id WHERE h.idcurso = '$curso' GROUP BY h.idmateria, mc.nombre, mc.cant_hs HAVING COUNT(h.idmateria) != mc.cant_hs";
	//echo $sql;
	$resultt = mysql_query($sql);
	//$filatt = mysql_fetch_array($resultt);
	while ($qh= mysql_fetch_assoc($resultt))
			{
			$output .= "Plaza: <a href=vermovplaza.php?id=$qh[id] target=_blank>".$qh['id']."</a> Materia: <a href=vermovplaza.php?id=$qh[id] target=_blank>" . $qh['nombre'] . "</a> - Cantidad de clases: " . $qh['Q'] . " - Horas asignadas: " . $qh['cant_hs'] . "<br>";
			}
	return $output;
	mysql_close;
}

function loginvalido($usuario,$pass,$pagina)
{
	mysql_connect("192.168.0.249", "fgoicoechea", "sobral2011");
	mysql_select_db("sid");
	$resultt = mysql_query ("SELECT * FROM usuarios WHERE usuario = '$usuario' and pass='$pass'");
	$filatt = mysql_fetch_array($resultt);
	if (!mysql_num_rows($resultt)) {
		$ref = base64_encode($_SERVER['REQUEST_URI']);
		$ref = 'Location: i_admin.php?ref=' . $ref;
		header($ref);
		exit;
	}
	else
	{	
		return "OK";
	}
	mysql_close;
}



function detallefaltas($dni,$injus)
{
	mysql_connect("192.168.0.249", "fgoicoechea", "sobral2011");
	mysql_select_db("base_sobral");
	$faltas="SELECT tipo,COUNT(dni) as total FROM `alumnos_faltas` WHERE YEAR(fecha)=YEAR(CURDATE()) AND dni='$dni' AND injus='$injus' GROUP BY tipo ";
	$faltax = mysql_query($faltas);	
	$resultadoFaltas='';
	while ($faltar= mysql_fetch_assoc($faltax))
	{
	$resultadoFaltas=$resultadoFaltas ." ".$faltar['tipo'].": ".$faltar['total'];
	}
	//echo $faltas;
		return $resultadoFaltas;

}	
	
function consultahorario($dia,$materia,$es,$docente)
{
	mysql_connect("192.168.0.249", "fgoicoechea", "sobral2011");
	mysql_select_db("sid");
	$qhor="SELECT * FROM cargo_horas WHERE idcargo='$materia' AND iddia='$dia'";
	if ($docente!='')$qhor="SELECT * FROM cargo_horas WHERE idcargo='$materia' AND iddia='$dia' AND docente='$docente'";
	//echo $qhor;
	$horariox = mysql_query ($qhor);
	$elegidox = mysql_num_rows($horariox);
		if ($elegidox>0)
		{	$horaz = mysql_fetch_array($horariox);
			if ($es=='E') {return $horaz['entrada'] ;}
			if ($es=='S') {return $horaz['salida'] ;}
		}
		else
		{	
			return 0;
		}
}

	function vermovimientos($plaza)
	{
		mysql_connect("192.168.0.249", "fgoicoechea", "sobral2011");
		mysql_select_db("sid");
		$movimientos="SELECT * FROM alta_baja ab, docentes d,caracter c WHERE ab.sit_revista=c.codigo AND ab.materia=$plaza AND d.dni=ab.docente ORDER BY finicio ASC";
		$resultmovi = mysql_query($movimientos);	
			while ($movi= mysql_fetch_assoc($resultmovi))
			{	$fechaD = date("d-m-Y", strtotime($movi[fdesde]));
				$fechaH = date("d-m-Y", strtotime($movi[fhasta]));
				if ($movi[fhasta]=='0000-00-00') $fechaH="S/D";
				
			
				$consultamovi[] = "Desde: ".$fechaD." Hasta: ".$fechaH." Docente: ".$movi[apellido]." ".$movi[nombre]." Sit.Revista: ".$movi[descripcion];
				//  $consultamovi[]=
			}

		return $consultamovi;
		//return $movimientos;
	
	}
	
	function estadodocente($dni,$altabaja)
	{
		mysql_connect("192.168.0.249", "fgoicoechea", "sobral2011");
		mysql_select_db("sid");
	
		if ($altabaja=="baja") $consultaestado="SELECT * FROM docentes d, alta_baja ab WHERE d.dni='$dni' AND ab.activa=1 AND d.identificacion='1'";
		if ($altabaja=="alta") $consultaestado="SELECT * FROM docentes d, alta_baja ab WHERE d.dni='$dni' AND ab.activa=1 AND d.identificacion='3'";		
			$resultestado = mysql_query ($consultaestado);
			$q=mysql_num_rows($resultestado);
					if ($q==0)
						{
							if ($altabaja=="baja") $actualizarestado="UPDATE docentes SET identificacion='3' WHERE dni='$dni' AND identificacion='1'"; //doble check
							if ($altabaja=="alta") $actualizarestado="UPDATE docentes SET identificacion='1' WHERE dni='$dni' AND identificacion='3'"; //doble check	
							echo $actualizarestado;
							mysql_query($actualizarestado);
							mysql_query ("INSERT INTO log (id,fecha,obs) VALUES ('',NOW(),'$actualizarestado')");
						}
	
	echo $consultaestado." ".$actualizarestado."<br>";
	}






































/*function validarFecha($fechax)
	{
		$fechades = date("j,n,Y",strtotime($fechax)); 
		$valores = explode(",",$fechades);
		$diaF = $valores[0];
		$mesF = $valores[1];
		$anoF = $valores[2];
		
	}*/

/*function promedio($cual,$quien,$ano)
		{
			$linkcalif2 = mysqli_connect("localhost", "root", "msi2010", "calificadores") or die ("ERROR!!!"); 
			$sqlprom="SELECT AVG(n.valor) as pr FROM calificador2 c,notas n WHERE c.nota=n.id AND c.dni='$quien' AND c.idnota='$cual' and c.nota!='0' AND c.nota!='1001' AND c.anio='$ano'";
			//echo $sqlprom;
			$resultprom = mysqli_query ($linkcalif2,$sqlprom);
			$prom = mysqli_fetch_array($resultprom);
			//echo $prom['pr'];
			return round($prom['pr'], 2);
		}
	

function obtenernota($alumno,$cualnota,$curso,$materia)
	{		
			
			$linkcalif2 = mysqli_connect("localhost", "root", "msi2010", "calificadores") or die ("ERROR!!!"); 
			if($linkcalif2 == false){
			die("ERROR: Could not connect. " . mysqli_connect_error());
			}
			else
			{//echo "PRUEBA PRUEBA PRUEBA PRUEBA PRUEBA PRUEBA ";	
			}
			
			$sqlnota="SELECT * FROM calificador2 WHERE dni='$alumno' AND idnota='$cualnota' AND curso='$curso' AND materia='$materia'";
			$resultnota = mysqli_query ($linkcalif2,$sqlnota);
			$notax = mysqli_fetch_array($resultnota);
			$estax=mysqli_num_rows($resultnota);
			if ($estax==0 or is_null($estax)){$nota='';} else {$nota=$notax['nota']; if ($nota==0) {$nota=''; }}
			//echo $notax['nota'];
			return $nota;
	}




			function colornota($calificacion)
			{	
			
			
				if ($calificacion=='' OR $calificacion==0)
				 {$colormat='FFFFFF';}
				 
				 if ($calificacion>=1 AND $calificacion<=3 )
				 {$colormat='FF0000';}
				if ($calificacion>=4 AND $calificacion<=5 )
				 {$colormat='FFFF00';}
				if ($calificacion>=6 AND $calificacion<=10 )
				 {$colormat='00FF00';}
				//0800FF
				if ($calificacion=='A' or $calificacion=='S/C')
				 {$colormat='002EFF';}
				return $colormat;
			 }*/
?>
