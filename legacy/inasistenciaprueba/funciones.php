<?php




/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/


/*function validarFecha($fechax)
	{
		$fechades = date("j,n,Y",strtotime($fechax)); 
		$valores = explode(",",$fechades);
		$diaF = $valores[0];
		$mesF = $valores[1];
		$anoF = $valores[2];
		
	}*/
	
function consultahorario($dia,$materia,$es)
{
	mysql_connect("192.168.0.249", "fgoicoechea", "sobral2011");
	mysql_select_db("sid");
	$qhor="SELECT * FROM cargo_horas WHERE idcargo='$materia' AND iddia='$dia'";
//	echo $qhor;
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