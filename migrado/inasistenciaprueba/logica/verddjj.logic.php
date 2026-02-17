<?

include 'conexion.php';
$conexion = conectar ();


function listarArchivos( $path )
{
		$cont=0;
		$dir = opendir($path);
		$files = array();
		while ($elemento = readdir($dir))
		{
			if( $elemento != "." && $elemento != "..")
			{
				if( is_dir($path.$elemento) )
				{
					listarArchivos( $path.$elemento.'/' );
				}
					else
					{
						$files[] = $elemento;
					}
			}
		}

		$rest1 = substr($path,5,8);
		$resultt = mysql_query ("SELECT * FROM docentes WHERE dni = '$rest1'");
		$filatt = mysql_fetch_array($resultt);
		echo $filatt[dni]; 
		echo " ";
		echo $filatt[apellido];
		echo " ";
		echo $filatt[nombre];
		for($x=0; $x<count( $files ); $x++)
		{	
			$rest2 = substr($files[$x],14,6);
			echo " ";
			echo $rest2;
			echo " ";
		}
		echo "<BR>";
}

listarArchivos( 'ddjj/' );
?>
