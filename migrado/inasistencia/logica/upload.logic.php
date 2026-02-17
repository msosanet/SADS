<?php
    session_start();
if ($_SESSION['estado']==1) {
	include 'header.php';
	include 'conexion.php';
	$conexion = conectar ();
	echo "<br>";
	echo "<br>";
	
/*	ini_set('display_errors', 1);
error_reporting(E_ALL);*/
	
	$currentDirectory = getcwd();
    
    
	$idregistro=$_POST['idregistro'];
	$tiporegistro=$_POST['tiporegistro'];
	
	if ($tiporegistro=='N') 
	{$tipo="notas";
	 $tabla="notasnuevo";
	}
	if ($tiporegistro=='D') 
	{$tipo="dispo";
	 $tabla="disponueva";
	}
	if ($tiporegistro=='NF') 
	{$tipo="notificaciones";
	 $tabla="notificaciones";
	}
	
	$uploadDirectory = "/uploads/".$tipo."/";
	//echo $uploadDirectory;


    $errors = []; // Store errors here

    $fileExtensionsAllowed = ['pdf']; // unica extension permitida

    $fileName = $_FILES['elarchivo']['name'];
    $fileSize = $_FILES['elarchivo']['size'];
    $fileTmpName  = $_FILES['elarchivo']['tmp_name'];
    $fileType = $_FILES['elarchivo']['type'];
    $fileExtension = strtolower(end(explode('.',$fileName)));
	$fileName = $idregistro.".".$fileExtension;
    $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName); 

	//echo $uploadPath;
    
	if (isset($_POST['Subir'])) {

      if (! in_array($fileExtension,$fileExtensionsAllowed)) {
      
		$errors[] = "La extension de este archivo no esta permitida, por favor suba un archivo PDF Firmado.";
      }

      if ($fileSize > 40000000) {
        
		 $errors[] = "El archivo excede el tamaÃ±o maximo. (40MB)";
      }

      if (empty($errors)) {
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

        if ($didUpload) {
          echo "El archivo " . basename($fileName) . " se subio correctamente";
		  $sql2="UPDATE ".$tabla ." SET path='$fileName' WHERE id='$idregistro'";
		 //echo $sql2;
		  mysql_query ($sql2);
		  
		  //$result = mysql_query($sql2);	
		
		} else {
          //echo "An error occurred. Please contact the administrator.";
		  echo "Ocurrio un error!";
        }
      } else {
        foreach ($errors as $error) {
          //echo $error . "These are the errors" . "\n";
		  echo $error . "Estos son los errores: " . "\n";
        }
      }
$url = $_SERVER['HTTP_REFERER'];
?>
    <p>
	
	<a href="<?php echo $url;?>" title="Volver a la Mesa de Salida">&laquo; Volver</a>
	</p>
<?
	/*<a href="ver_mi_nota_salida.php?descripcion=<?php echo $numero;?>&usuarioz=<?php echo $_SESSION['usuario'];?>&queletra=<?php echo $numeroletra."|".$tipoid;?>&muestra2=+++Buscar+++" title="Volver a la Mesa de Salida">&laquo; Volver a Mesa de Salida</a>*/
	
	}
	}
?>

