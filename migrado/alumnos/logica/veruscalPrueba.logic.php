<?PHP
session_start();
if ($_SESSION['estado']==1) {

include 'conexion.php';
include 'conexioncalif.php';

function debug_to_console($data,$columna) 
{
    $output = $data;
    if (is_array($output)) {
        $output = implode(',', $output);
	}

    echo "<script>console.log('$columna: " . $output . "' );</script>";
}

// Busco obtener si existen nuevos elementos o menos elementos que el arreglo original
function compararArreglos($arrA,$arrB,$referencia)
{
	$arrOriginal = array_map('trim',$arrA); //Elimino espacios en blanco en cada elemento
	sort($arrOriginal); // Ordeno el arreglo
	// debug_to_console($arrOriginal,$referencia);
	debug_to_console(count($arrOriginal),"Conteo de $referencia");
	
	$arrNuevo = array_map('trim',$arrB);
	sort($arrNuevo);
	// debug_to_console($arrNuevo,$referencia);
	debug_to_console(count($arrNuevo),"Conteo de $referencia");
	$elementos_agregados = array_diff($arrNuevo,$arrOriginal);
	$elementos_eliminados = array_diff($arrOriginal,$arrNuevo);
	// debug_to_console($elementos_agregados,$referencia);
	// debug_to_console($elementos_eliminados,$referencia);
	if (!empty($elementos_agregados)) {
		echo "Elementos agregados a $referencia: " . implode(", ", $elementos_agregados) . "\n" ;
	}

	if (!empty($elementos_eliminados)) {
		echo "Elementos eliminados de $referencia: " . implode(", ", $elementos_eliminados) . "\n";
	}
}
//include 'conexionsobral.php';
?>

