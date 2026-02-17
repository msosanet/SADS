<?php

echo "INICIO: ".date('Y-m-d H:i:s');

$host="127.0.0.1"; // Host name
$username="root"; // Mysql username
$password="msi2010"; // Mysql password
$db_name="sid"; // Database name
//$tbl_name="alumnos"; // Table name

$conn=mysql_connect("$host", "$username", "$password")or die("No se puede conectar");
mysql_select_db("$db_name")or die("Imposible Conectar a la base de datos");



	


//--------------------------------------------CONSULTA SQL-----------------------

#$sql="SELECT L.DNI, A.TIPO, A.fecha, A.hora FROM ACCESOS A, LEGAJOS L WHERE A.LEGAJO=L.COD ";
//$sql2="SELECT D.dni,C.CheckType,C.CheckTime,C.Sensorid FROM docentes D, Checkinout C WHERE C.Userid=D.idreloj AND YEAR(C.CheckTime)=YEAR(curdate())";
//$sql2="SELECT D.dni,C.CheckType,C.CheckTime,C.Sensorid FROM docentes D, Checkinout C WHERE C.Userid=D.idreloj AND YEAR(C.CheckTime)=YEAR(curdate()) AND DATE(C.CheckTime)=CURDATE()";
//echo $sql2."<br>";;


//$sql2="SELECT DISTINCT C.*,D.dni FROM docentes D, Checkinout C WHERE C.Userid=D.idreloj AND YEAR(C.CheckTime)=YEAR(curdate())";
$sql2="SELECT MAX(C.Logid) AS Logid, C.*, D.dni FROM docentes D JOIN Checkinout C ON C.Userid = D.idreloj WHERE YEAR(C.CheckTime) = YEAR(CURDATE()) GROUP BY C.Logid ORDER BY C.CheckTime DESC";

if (isset($_GET['fecha']))
{	
$sql2="SELECT D.dni,C.CheckType,C.CheckTime,C.Sensorid FROM docentes D, Checkinout C WHERE C.Userid=D.idreloj AND YEAR(C.CheckTime)=YEAR(curdate()) AND DATE(C.CheckTime)=CURDATE()";
}
echo $sql2;

$result = mysql_query($sql2);
$i=0;
while ($row = mysql_fetch_array($result)){

$legajo=$row['dni'];
$tipo='Salida';
if ($row['CheckType']=='0') //EL reloj que esta en el pasillo identifica los registros de entrada y salida de manera diferente que el que esta dentro de secretaria
	{
		$tipo='Entrada';    
	}

if ($row['CheckType']=='1') //EL reloj que esta en el pasillo identifica los registros de entrada y salida de manera diferente que el que esta dentro de secretaria
	{
		$tipo='Salida';    
	}
	
if ($row['CheckType']=='2') //EL reloj que esta en el pasillo identifica los registros de entrada y salida de manera diferente que el que esta dentro de secretaria
	{
		$tipo='Break';    
	}
	
//----------------------------------FECHA-----------------------------------
$fecha = date("Y-m-d",strtotime($row['CheckTime']));
//----------------------------------DIA-------------------------------------
$dia=strftime("%w",strtotime($row['CheckTime']));
//----------------------------------HORA-------------------------------------
/*$datetime = "$row[3]";
$date_arr= explode(" ", $datetime);
$date= $date_arr[0];
$time= $date_arr[1];*/
$time= date("H:i:s",strtotime($row['CheckTime']));
//--------------------------------------------------------------------------
//echo $legajo."|";
//echo $time."|";
//echo $dia."|";
//echo $fecha."|";
//echo $tipo."|";*/

$sql = "INSERT IGNORE INTO diario".
       "(dni,horario,dia,lic,fecha,tipo) ".
       "VALUES('$legajo','$time','$dia','-','$fecha','$tipo')";

//echo $sql."<br>";

$consulta = mysql_query( $sql, $conn );
$i=$i+1;
/*if(! $consulta )
{
  die('ERROR!.: ' . mysql_error());
}*/


}
//MUESTRA CANTIDAD DE REGISTROS AGREGADOS A LA TABLA
echo $i;
echo "FIN: ".date('Y-m-d H:i:s');
//VACIAMOS LA TABLA

$query = "delete from Checkinout";  
$result = mysql_query($query); 
?>
