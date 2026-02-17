<?PHP
session_start();
if ($_SESSION['estado']==1) { 

include 'conexion.php';

//Calcula el numero de dias entre dos fechas.
// Da igual el formato de las fechas (dd-mm-aaaa o aaaa-mm-dd),
// pero el caracter separador debe ser un guiÃ³n.
function diasEntreFechas($fechainicio, $fechafin){
    return (((strtotime($fechafin)-strtotime($fechainicio))/86400)+1);
}

//esto pasa las mayusculas acentuadas a minusculas acentuadas
function strtolowerExtended($str)
{
        $low = array(chr(193) => chr(225), //ÃƒÂ¡
                    chr(201) => chr(233), //ÃƒÂ©
                    chr(205) => chr(237), //ÃƒÂ­Ã‚Â­
                   chr(211) => chr(243), //ÃƒÂ³
                   chr(218) => chr(250), //ÃƒÂº
                  chr(220) => chr(252), //ÃƒÂ¼
                    chr(209) => chr(241)  //ÃƒÂ±
                    );
 
      return strtolower(strtr($str,$low)); 
} 


?>

