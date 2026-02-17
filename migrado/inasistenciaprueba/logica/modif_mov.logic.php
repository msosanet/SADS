<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion.php';

//esto pasa las mayusculas acentuadas a minusculas acentuadas
function strtolowerExtended($str)
{
        $low = array(chr(193) => chr(225), //Ã¡
                    chr(201) => chr(233), //Ã©
                    chr(205) => chr(237), //Ã­Â­
                   chr(211) => chr(243), //Ã³
                   chr(218) => chr(250), //Ãº
                  chr(220) => chr(252), //Ã¼
                    chr(209) => chr(241)  //Ã±
                    );
 
      return strtolower(strtr($str,$low)); 
} 


function menu($ssql,$valor,$nombre){ 
  	echo "<select name='$nombre'>"; 
  	$resultado=mysql_query($ssql); 
  	while ($fila=mysql_fetch_row($resultado)){ 
    	if ($fila[0]==$valor){  
      	echo "<option selected value='$fila[0]'>$fila[4] $fila[1] $fila[2] $fila[3]";	
    	} 
    	else{ 
      	echo "<option value='$fila[0]'>$fila[4] $fila[1] $fila[2] $fila[3]";	
    	} 
  } 
  	echo "</select>";	
}


function menu2($ssql,$valor,$nombre){ 
  	echo "<select name='$nombre'>"; 
  	$resultado=mysql_query($ssql); 
  	while ($fila=mysql_fetch_row($resultado)){ 
    	if ($fila[0]==$valor){ 
      	echo "<option selected value='$fila[0]'>$fila[1]";	
    	} 
    	else{ 
      	echo "<option value='$fila[0]'>$fila[1]";	
    	} 
  } 
  	echo "</select>";	
}




?>

