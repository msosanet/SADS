<?PHP

function colores($calificacion)
		{
				if ($calificacion>=1 AND $calificacion<=3 )
				 {$colormat='FF0000';}
				if ($calificacion>=4 AND $calificacion<=5 )
				 {$colormat='FFFF00';}
				if ($calificacion>=6 AND $calificacion<=10 )
				 {$colormat='00FF00';}
				if ($calificacion=='0')
				{$colormat='E1EAFF';}
		
		return $colormat;
		}

function sincalif($calif) //la modifiquÃ© para que en todos los casos muestre S/C en lugar de dejar el casillero vacÃ­o
		{
			if ($calif==NULL) $calif=' - ';
			if ($calif==1001) $calif='S/C';
			if ($calif==1000) $calif='Aus';
			return $calif;
		}
		
		
function promedio($cual,$quien,$ciclo)
		{
			$sqlprom="SELECT AVG(nota) as pr FROM calificador2 c WHERE c.dni='$quien' AND c.idnota='$cual' AND c.nota NOT IN (1000,1001,0) AND c.anio = $ciclo";
			//echo $sqlprom;
			$resultprom = mysql_query ($sqlprom);
			$prom = mysql_fetch_array($resultprom);
			//echo $prom['pr'];
			return round($prom['pr'], 2);
		}












	
?>
