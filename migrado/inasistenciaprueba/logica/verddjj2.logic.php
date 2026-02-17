<?
include 'conexion.php';
$conexion = conectar ();
/A continuación le pasamos a la función el nombre de la carpeta "padre" donde queremos comenzar a leer
 

	function leer_carpeta("ddjj") 
	{
		$leercarpeta = $leercarpeta . "/"; 
		if(is_dir($leercarpeta))
		{
			if($dir = opendir($leercarpeta))
			{
				while(($archivo = readdir($dir)) !== false)
				{
					if($archivo != '.' && $archivo != '..') 
					{
					echo $archivo; 
					} 
				}
			closedir($dir);
			} 
		} 
	}




function listar_carpetas($carpeta) {
					$ruta = $carpeta . "/";
					$ruta = strtolower($ruta);
					if(is_dir($ruta)) 
					{
						if($dir = opendir($ruta)) 
						{
							while(($archivo = readdir($dir)) !== false) 
							{
								if($archivo != '.' && $archivo != '..') 
								{
									if (is_dir($ruta.$archivo)) 
									{
										leer_carpeta($ruta.$archivo);
									} 
								} 	
							}
						closedir($dir);
						} 
					} 
				}



$carpet="ddjj";
listar_carpetas($carpet);

