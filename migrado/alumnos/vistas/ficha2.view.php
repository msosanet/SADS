<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="Content-Language" content="es-ar">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<script type="text/javascript" language="JavaScript1.2" src="../csjs/stm31.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../csjs/images.js"></script>
<link rel="stylesheet" type="text/css" href="style2.css" />
<link href="css/calendario.css" type="text/css" rel="stylesheet">
<script src="js/calendar.js" type="text/javascript"></script>
<script src="js/calendar-es.js" type="text/javascript"></script>
<script src="js/calendar-setup.js" type="text/javascript"></script>

<link rel="shortcut icon" href="../imag/favicon.ico">
<title>Inscripcion de alumnos</title>




</head>
<?
include 'header.php';
$conexion = conectar ();
$actor=$_GET["dni"];


$resultt = mysql_query ("SELECT * FROM alumno WHERE dni = $actor");
$filatt = mysql_fetch_array($resultt);


$resultp = mysql_query ("SELECT * FROM alu_fami,familiares WHERE alu_fami.alumno=$actor and alu_fami.tipo='P' and familiares.dni=alu_fami.familiar");
$padre = mysql_num_rows($resultp);
$filap = mysql_fetch_array($resultp);

$resultm = mysql_query ("SELECT * FROM alu_fami,familiares WHERE alu_fami.alumno=$actor and alu_fami.tipo='M' and familiares.dni=alu_fami.familiar");
$madre = mysql_num_rows($resultm);
$filam = mysql_fetch_array($resultm);

$resultt = mysql_query ("SELECT * FROM alu_fami,familiares WHERE alu_fami.alumno=$actor and alu_fami.tipo='T' and familiares.dni=alu_fami.familiar");
$tutor = mysql_num_rows($resultt);
$filat = mysql_fetch_array($resultt);



$resultt2 = mysql_query ("SELECT * FROM familiares WHERE dni = $dni");
$filatt2 = mysql_fetch_array($resultt2);


$anio=date("Y");

$ye2 = mysql_query ("SELECT modalidad FROM cursa where alumno=$actor and control=1");
$data=mysql_fetch_array($ye2);
//$res=mysql_fetch_assoc($data);

$ye3 = mysql_query ("SELECT divi FROM cursa where alumno=$actor and control=1");
$data3=mysql_fetch_array($ye3);


$ye4 = mysql_query ("SELECT curso FROM cursa where alumno=$actor and control=1");
$data2=mysql_fetch_array($ye4);

$plan = mysql_query ("SELECT * FROM plan order by id");
//$plan2=mysql_fetch_array($plan);



//$resultmotivo = mysql_query ("SELECT distinct cursos FROM cursa WHERE anio='$anio' order by curso"); 
//$resultmotivo2 = mysql_query ("SELECT distinct divi FROM cursa WHERE anio='$anio' order by divi"); 



//------------------------------------------------

function busca_edad($fecha_nacimiento){
$dia=30;
$mes=06;
$ano=date("Y");


$dianaz=date("d",strtotime($fecha_nacimiento));
$mesnaz=date("m",strtotime($fecha_nacimiento));
$anonaz=date("Y",strtotime($fecha_nacimiento));


//si el mes es el mismo pero el día inferior aun no ha cumplido años, le quitaremos un año al actual

if (($mesnaz == $mes) && ($dianaz > $dia)) {
$ano=($ano-1); }

//si el mes es superior al actual tampoco habrá cumplido años, por eso le quitamos un año al actual

if ($mesnaz > $mes) {
$ano=($ano-1);}

 //ya no habría mas condiciones, ahora simplemente restamos los años y mostramos el resultado como su edad

$edad=($ano-$anonaz);


return $edad;


}


function menu($ssql,$valor,$nombre){ 
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

function menu2($ssql,$valor,$nombre){ 
  	echo "<select name='$nombre'>"; 
  	$resultado=mysql_query($ssql); 
  	while ($fila=mysql_fetch_row($resultado)){ 
    	if ($fila[0]==$valor){ 
      	echo "<option selected value='$fila[0]'>$fila[0]";	
    	} 
    	else{ 
      	echo "<option value='$fila[0]'>$fila[0]";	
    	} 
  } 
  	echo "</select>";	
}



$anio=date("Y");

$hayerrores = 0;

  $flag = 0;
  if (isset($_GET["submitx"])) {
     // verifico los errores en los campos




}
 else
  {
    $flag = 1;
  }
  
if ($hayerrores OR $flag) {
?>

<body background="bgris.gif" >
<form method="GET" action="ficha2.php?actor=<? echo $actor; ?>">

<div align="center">
	<table border="0" width="980" bgcolor="#FFFFFF">
		<tr>
			<td>
			<div align="center">
			<table border="0" width="980">
<?if ($_SESSION['valor']==1)
{		
include 'menuppal2.php';
}
if ($_SESSION['valor']==0)
 {		
include 'menuppal.php';
}
if ($_SESSION['valor']==3)
 {		
include 'menuppal3.php';
}
?>
				<tr>
				

					<td>
					
					<BR><p align="left" class="text1b">FICHA DE INSCRIPCION</p><BR>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, están marcado con color ROJO</font></h4>";} ?>
</p><div align="left">				<div align="center"><p align="center" class="text1b">ALUMNO</p>
					
					<table border="0" width="895" id="table1" cellpadding="2" cellspacing="4">

						
						<tr>
						

							<td width="174" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">D.N.I.:</td>
							<td bgcolor="#EAEAEA" width="268" align="left">
							<?echo $filatt['dni']; ?>
							</td>
					
							

							<td width="190" bgcolor="#EAEAEA" align="right">Sexo:
							</td></font>
							<td width="190" bgcolor="#EAEAEA" align="left">
							<select name="sexo">
							 <? if ($filatt['sexo']=='') {$selec = 'Seleccione el Sexo'; } else {$selec = '';}?>

								<option value="<?echo $filatt['sexo'];?>"><?echo $filatt['sexo']; echo $selec;?></option>
								<option value="M">M</option>
								<option value="F">F</option>
					
   							</select>
							</td>
							
						</tr>

						
							

								<td width="74" bgcolor="#cccccc" align="right"><font color="<?echo $color;?>">Apellido:</td>
							</font>
							<td bgcolor="#cccccc" width="425" align="left">

							<input type="text" name="apellido" size="40" maxlength="40" value="<? echo $filatt['apellido']; ?>" />
							</td>												

							

								<td width="74" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">Nombre:</td>
							</font>
							<td bgcolor="#EAEAEA" width="425" align="left">

							<input type="text" name="nombre" size="40" maxlength="40" value="<?echo $filatt['nombre']; ?>" />
							</td>

							<tr>


							<td width="190" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">
							Direccion:</td></font>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="direccion" size="30" maxlength="30" value="<?echo $filatt['domicilio'];?>" /></td>
							</td>
							
					
					

					

							<td width="190" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">

							Fecha de Nac.:</td></font>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="f_nac" size="10" maxlength="10" value="<?echo $filatt['f_nac'];?>" /></td>
							</td>
							
						</tr>
									<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Ciudad:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="ciudad" size="30" maxlength="30" value="<?echo $filatt['ciudad'];?>" /></td>
							</td>

						
					

							<td width="190" bgcolor="#EAEAEA" align="right">
							Provincia:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="provincia" size="20" maxlength="20" value="<?echo $filatt['provincia'];?>" /></td>
							</td>
							
						</tr>
									<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Pais:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="pais" size="30" maxlength="30" value="<?echo $filatt['pais'];?>" /></td>
							</td>

						
					

							<td width="190" bgcolor="#EAEAEA" align="right">
							E-mail:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="mail" size="50" maxlength="50" value="<?echo $filatt['mail'];?>" /></td>
							</td>
							
							
							</td>
						</tr>
										
						<tr>
						<?
	  					if ($errortelefono==1) {$color="#FF0000";}
						else{$color="#000000";}
						?>


							<td width="190" bgcolor="#EAEAEA" align="right"><font color="<?echo $color;?>">
							Tel&eacute;fono:</td></font>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="tel" size="30" maxlength="30" value="<?echo $filatt['tel'];?>" /></td>
							</td>
							
					
					
							<td width="190" bgcolor="#EAEAEA" align="right">Tribu:
							</td></font>

							<td width="190" bgcolor="#EAEAEA" align="left">
							<select name="tribu">
							 <? if ($filatt['sexo']=='') {$selec = 'Seleccione la tribu'; } else {$selec = '';}?>

								<option value="<?echo $filatt['tribu'];?>"><?echo $filatt['tribu']; echo $selec;?></option>
								<option value="-">-</option>
								<option value="Yamana">Yamana</option>
								<option value="Ona">Ona</option>
					
   							</select>

							</td>

							
						</tr>
						<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Fecha de Ingreso:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="f_ingreso" size="10" maxlength="10" value="<?echo $filatt['f_ingreso'];?>" /></td>
							</td>
							
							<td width="190" bgcolor="#EAEAEA" align="right">Edad al 30/06/<? echo $anio; ?>
							</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><H2><? echo busca_edad($filatt['f_nac']);?></H2></td>
							</td>
							
							

							
						</tr>
						<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Escuela:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="escuela" size="30" maxlength="100" value="<?echo $filatt['escuela'];?>" /></td>
							</td>
							
							<td width="190" bgcolor="#EAEAEA" align="right">Localidad Escuela
							</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="loca_esc" size="30" maxlength="100" value="<?echo $filatt['localidad_esc'];?>" /></td>
							</td>
							
						</tr>
						<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Grado/Año:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="grado" size="30" maxlength="100" value="<?echo $filatt['grado'];?>" /></td>
							</td>
							
							<td width="190" bgcolor="#EAEAEA" align="right">
							</td>
							<td bgcolor="#EAEAEA" width="265" align="left"></td>
							</td>
							
						</tr>



						

					</table>
				<tr>
					<td>



<div align="center">
<p align="center" class="text1b">CURSO</p>

					
					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">

						
						<tr>
						
						
						
						  <td width="174" bgcolor="#bbCbbb" align="right"><font color="<?echo $color;?>">Curso:</td>
						  <td bgcolor="#bbCbbb" width="268" align="left">

   
							<? 	$valor2="SELECT distinct curso FROM cursos order by curso";
							menu2($valor2,$data2['curso'],'curso'); ?>
                          
     
						</td>

							

						  <td width="174" bgcolor="#bbCbbb" align="right"><font color="<?echo $color;?>">Division:</td>
						  <td bgcolor="#bbCbbb" width="268" align="left">
                          
							<? 	$valor3="SELECT distinct division FROM cursos order by division";
							menu2($valor3,$data3['divi'],'divi'); ?>
						</td>
							
						</tr>
						
							<tr>
						
						
						
						  <td width="174" bgcolor="#bbCbbb" align="right"><font color="<?echo $color;?>">Modalidad:</td>
						  <td bgcolor="#bbCbbb" width="268" align="left">

							   							
							<? 	$valor="SELECT * FROM plan order by id";
							menu($valor,$data['modalidad'],'modalidad'); ?>
		

                          
     
						</td>

							

						  <td width="174" bgcolor="#bbCbbb" align="right"><font color="<?echo $color;?>"></td>
						  <td bgcolor="#bbCbbb" width="268" align="left">
                          

						</td>
							
						</tr>
		
					
						</table>


<center>


<br>
<br>

</font>

<p align="center" class="text1b">FAMILIARES</p>
<br>

<? if ($madre > 0) { ?>


<p align="center" class="text1b">MADRE</p>

						
						

						</table>
<div align="center">
					
					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">

						
						<tr>
						

							<td width="174" bgcolor="#EAAA7B" align="right"><font color="<?echo $color;?>">D.N.I.:</td>
							<td bgcolor="#EAAA7B" width="268" align="left">
							<?echo $filam['dni']; ?>
							</td>
					
							

							<td width="74" bgcolor="#EAAA7B" align="right"><font color="<?echo $color;?>">Apellido:</td>
							</font>
							<td bgcolor="#EAAA7B" width="425" align="left">

							<input type="text" name="apellidom" size="40" maxlength="40" value="<?echo $filam['apellido']; ?>" />
							</td>	
							
						</tr>

						
							

								<td width="74" bgcolor="#EAAA7B" align="right"><font color="<?echo $color;?>">Nombre:</td>
							</font>
							<td bgcolor="#EAAA7B" width="425" align="left">

							<input type="text" name="nombrem" size="40" maxlength="40" value="<?echo $filam['nombre']; ?>" />
							</td>												

							

							<td width="190" bgcolor="#EAAA7B" align="right">
							Domicilio:</td>
							<td bgcolor="#EAAA7B" width="265" align="left"><input type="text" name="domiciliom" size="40" maxlength="40" value="<?echo $filam['domicilio'];?>" /></td>
							</td>
							

						<tr>


							<td width="190" bgcolor="#EAAA7B" align="right">
							Telefono personal:</td>
							<td bgcolor="#EAAA7B" width="265" align="left"><input type="text" name="telefonom" size="20" maxlength="20" value="<?echo $filam['tel'];?>" /></td>
							</td>
							
					
					


							<td width="190" bgcolor="#EAAA7B" align="right">
							Lugar de trabajo:</td>
							<td bgcolor="#EAAA7B" width="265" align="left"><input type="text" name="trabajom" size="30" maxlength="30" value="<?echo $filam['trabajo'];?>" /></td>
							</td>

							
						</tr>
									<tr>

							<td width="190" bgcolor="#EAAA7B" align="right">
							Telefono del trabajo:</td>
							<td bgcolor="#EAAA7B" width="265" align="left"><input type="text" name="tel2m" size="30" maxlength="30" value="<?echo $filam['tel_trabajo'];?>" /></td>
							</td>

						
					

							<td width="190" bgcolor="#EAAA7B" align="right">
							E-mail personal:</td>
							<td bgcolor="#EAAA7B" width="265" align="left"><input type="text" name="mailm" size="30" maxlength="50" value="<?echo $filam['email'];?>" /></td>
							</td>
							
						</tr>
									

			
						<tr>
							
						</tr>



						</table>
<? } ?>

<br>

<? if ($padre > 0) { ?>


<p align="center" class="text1b">PADRE</p>

						
						

						</table>
<div align="center">
					
					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">

						
						<tr>
						

							<td width="174" bgcolor="#B8E1FF" align="right"><font color="<?echo $color;?>">D.N.I.:</td>
							<td bgcolor="#B8E1FF" width="268" align="left">
							<?echo $filap['dni']; ?>
							</td>
					
							

							<td width="74" bgcolor="#B8E1FF" align="right"><font color="<?echo $color;?>">Apellido:</td>
							</font>
							<td bgcolor="#B8E1FF" width="425" align="left">

							<input type="text" name="apellidop" size="40" maxlength="40" value="<?echo $filap['apellido']; ?>" />
							</td>	
							
						</tr>

						
							

								<td width="74" bgcolor="#B8E1FF" align="right"><font color="<?echo $color;?>">Nombre:</td>
							</font>
							<td bgcolor="#B8E1FF" width="425" align="left">

							<input type="text" name="nombrep" size="40" maxlength="40" value="<?echo $filap['nombre']; ?>" />
							</td>												

							

							<td width="190" bgcolor="#B8E1FF" align="right">
							Domicilio:</td>
							<td bgcolor="#B8E1FF" width="265" align="left"><input type="text" name="domiciliop" size="40" maxlength="40" value="<?echo $filap['domicilio'];?>" /></td>
							</td>
							

						<tr>


							<td width="190" bgcolor="#B8E1FF" align="right">
							Telefono personal:</td>
							<td bgcolor="#B8E1FF" width="265" align="left"><input type="text" name="telefonop" size="20" maxlength="20" value="<?echo $filap['tel'];?>" /></td>
							</td>
							
					
					


							<td width="190" bgcolor="#B8E1FF" align="right">
							Lugar de trabajo:</td>
							<td bgcolor="#B8E1FF" width="265" align="left"><input type="text" name="trabajop" size="30" maxlength="30" value="<?echo $filap['trabajo'];?>" /></td>
							</td>

							
						</tr>
									<tr>

							<td width="190" bgcolor="#B8E1FF" align="right">
							Telefono del trabajo:</td>
							<td bgcolor="#B8E1FF" width="265" align="left"><input type="text" name="tel2p" size="30" maxlength="30" value="<?echo $filap['tel_trabajo'];?>" /></td>
							</td>

						
					

							<td width="190" bgcolor="#B8E1FF" align="right">
							E-mail personal:</td>
							<td bgcolor="#B8E1FF" width="265" align="left"><input type="text" name="mailp" size="30" maxlength="50" value="<?echo $filap['email'];?>" /></td>
							</td>
							
						</tr>
									

			
						<tr>
							
						</tr>



						</table>
<? } ?>

<br>

<? if ($tutor > 0) { ?>


<p align="center" class="text1b">TUTOR</p>

						
						

						</table>
<div align="center">
					
					<table border="0" width="895" id="table1" cellpadding="0" cellspacing="4">

						
						<tr>
						

							<td width="174" bgcolor="#D6B8FF" align="right"><font color="<?echo $color;?>">D.N.I.:</td>
							<td bgcolor="#D6B8FF" width="268" align="left">
							<?echo $filat['dni']; ?>
							</td>
					
							

							<td width="74" bgcolor="#D6B8FF" align="right"><font color="<?echo $color;?>">Apellido:</td>
							</font>
							<td bgcolor="#D6B8FF" width="425" align="left">

							<input type="text" name="apellidot" size="40" maxlength="40" value="<?echo $filat['apellido']; ?>" />
							</td>	
							
						</tr>

						
							

								<td width="74" bgcolor="#D6B8FF" align="right"><font color="<?echo $color;?>">Nombre:</td>
							</font>
							<td bgcolor="#D6B8FF" width="425" align="left">

							<input type="text" name="nombret" size="40" maxlength="40" value="<?echo $filat['nombre']; ?>" />
							</td>												

							

							<td width="190" bgcolor="#D6B8FF" align="right">
							Domicilio:</td>
							<td bgcolor="#D6B8FF" width="265" align="left"><input type="text" name="domiciliot" size="40" maxlength="40" value="<?echo $filat['domicilio'];?>" /></td>
							</td>
							

						<tr>


							<td width="190" bgcolor="#D6B8FF" align="right">
							Telefono personal:</td>
							<td bgcolor="#D6B8FF" width="265" align="left"><input type="text" name="telefonot" size="20" maxlength="20" value="<?echo $filat['tel'];?>" /></td>
							</td>
							
					
					


							<td width="190" bgcolor="#D6B8FF" align="right">
							Lugar de trabajo:</td>
							<td bgcolor="#D6B8FF" width="265" align="left"><input type="text" name="trabajot" size="30" maxlength="30" value="<?echo $filat['trabajo'];?>" /></td>
							</td>

							
						</tr>
									<tr>

							<td width="190" bgcolor="#D6B8FF" align="right">
							Telefono del trabajo:</td>
							<td bgcolor="#D6B8FF" width="265" align="left"><input type="text" name="tel2t" size="30" maxlength="30" value="<?echo $filat['tel_trabajo'];?>" /></td>
							</td>

						
					

							<td width="190" bgcolor="#D6B8FF" align="right">
							E-mail personal:</td>
							<td bgcolor="#D6B8FF" width="265" align="left"><input type="text" name="mailt" size="30" maxlength="50" value="<?echo $filat['email'];?>" /></td>
							</td>
							
						</tr>
									

			
						<tr>
							
						</tr>



						</table>
<? } ?>



					</div>
						 <tr>
							<td width="834" bgcolor="#B8E1FF" align="left" colspan="4">
							<p align="center"><input type="submit" value="     Actualizar     " name="submitx" style="border: 1px solid #C0C0C0; padding-right: 3px; background-color: #EBEBEB; font-weight:700; float:center" /></td>
						</tr><br>
<br>
<p align="center">
<a href="des_ficha.php?alumno=<?php echo $actor?>" target="_blank"><img src="pdf.png" alt="generar" height="50" width="50" align="center"> Descargar ficha de inscripcion</a><a href="des_salud.php?alumno=<?php echo $actor?>" target="_blank"><img src="pdf.png" alt="generar" height="50" width="50" align="center"> Descargar ficha de Salud</a>
</p>
<br>
<br>
            
			<?
			include 'footer.php';
			?>

			</td>
		</tr>
	</table>
</div>


<input type="hidden" name="actor" value="<?echo $actor;?>">
</form>
 </td>

</div>

</body>
<?
}
else
{

	$actor=$_GET['actor'];


$resultp = mysql_query ("SELECT * FROM alu_fami,familiares WHERE alu_fami.alumno=$actor and alu_fami.tipo='P' and familiares.dni=alu_fami.familiar");
$padre = mysql_num_rows($resultp);
$filap = mysql_fetch_array($resultp);

$resultm = mysql_query ("SELECT * FROM alu_fami,familiares WHERE alu_fami.alumno=$actor and alu_fami.tipo='M' and familiares.dni=alu_fami.familiar");
$madre = mysql_num_rows($resultm);
$filam = mysql_fetch_array($resultm);

$resultt = mysql_query ("SELECT * FROM alu_fami,familiares WHERE alu_fami.alumno=$actor and alu_fami.tipo='T' and familiares.dni=alu_fami.familiar");
$tutor = mysql_num_rows($resultt);
$filat = mysql_fetch_array($resultt);



	$nombre=$_GET['nombre'];
	$apellido=$_GET['apellido'];
	$direccion=$_GET['direccion'];
	$mail=$_GET['mail'];
	$sexo=$_GET['sexo'];
	$f_nac=$_GET['f_nac'];
	$tel=$_GET['tel'];
	$pais=$_GET['pais'];
	$ciudad=$_GET['ciudad'];
	$provincia=$_GET['provincia'];
	$tribu=$_GET['tribu'];
	$f_ingreso=$_GET['f_ingreso'];
	$escuela=$_GET['escuela'];
	$loca_esc=$_GET['loca_esc'];
	$grado=$_GET['grado'];
	$curso=$_GET['curso'];
	$divi=$_GET['divi'];
	$anio=date("Y");
	$modalidad=$_GET['modalidad'];
	$now=date("Y-m-d");

printf("modalidad:".$modalidad);

$ye = mysql_query ("SELECT * FROM cursa where alumno=$actor and anio='$anio' and control=1");
$yaesta = mysql_num_rows($ye);
$fil = mysql_fetch_array($ye); 



if ($yaesta >= 1) { 
			//mysql_query ("INSERT INTO cursa VALUES ($actor,'$curso','$divi','$anio',0,1,'$now',$modalidad)");
/* Anulada hasta que resolvamos poner un desplegable para elegir el año que cursa
			mysql_query ("UPDATE cursa SET modalidad=$modalidad, fecha='$now' where curso='$fil[curso]' and divi='$fil[divi]' and alumno=$actor and anio='$anio' and control=1"); 
*/	
			//mysql_query ("UPDATE cursa SET control=0, fecha='$now' where curso='$fil[curso]' and divi='$fil[divi]' and alumno=$actor and anio='$anio' and control=1"); 


			$control=1;
		 }
else 		{ 
/* Anulada hasta reconfigurar la asignación de curso
			mysql_query ("INSERT INTO cursa VALUES ($actor,'$curso','$divi','$anio',0,1,'$now',$modalidad)");
*/
			$control=1;
		}







if ($madre > 0) { 


	$nombrem=ucfirst($_GET['nombrem']);
	$apellidom=strtoupper($_GET['apellidom']);
	$domiciliom=ucfirst($_GET['domiciliom']);
	$telefonom=$_GET['telefonom'];
	$mailm=$_GET['mailm'];
	$tel2m=$_GET['tel2m'];
	$trabajom=$_GET['trabajom'];

	mysql_query ("UPDATE familiares SET nombre='$nombrem', apellido='$apellidom', domicilio='$domiciliom', tel='$telefonom', trabajo='$trabajom', tel_trabajo='$tel2m', email='$mailm' where dni=$filam[dni]");


	}


if ($padre > 0) { 


	$nombrep=ucfirst($_GET['nombrep']);
	$apellidop=strtoupper($_GET['apellidop']);
	$domiciliop=ucfirst($_GET['domiciliop']);
	$telefonop=$_GET['telefonop'];
	$mailp=$_GET['mailp'];
	$tel2p=$_GET['tel2p'];
	$trabajop=$_GET['trabajop'];

	mysql_query ("UPDATE familiares SET nombre='$nombrep', apellido='$apellidop', domicilio='$domiciliop', tel='$telefonop', trabajo='$trabajop', tel_trabajo='$tel2p', email='$mailp' where dni=$filap[dni]");


	}

if ($tutor > 0) { 


	$nombret=ucfirst($_GET['nombret']);
	$apellidot=strtoupper($_GET['apellidot']);
	$domiciliot=ucfirst($_GET['domiciliot']);
	$telefonot=$_GET['telefonot'];
	$mailt=$_GET['mailt'];
	$tel2t=$_GET['tel2t'];
	$trabajot=$_GET['trabajot'];

	mysql_query ("UPDATE familiares SET nombre='$nombret', apellido='$apellidot', domicilio='$domiciliot', tel='$telefonot', trabajo='$trabajot', tel_trabajo='$tel2t', email='$mailt' where dni=$filat[dni]");


	}




	$materia1=$_GET['materia1'];
	$materia2=$_GET['materia2'];
	$materia3=$_GET['materia3'];
	$materia4=$_GET['materia4'];
	$materia5=$_GET['materia5'];
	$materia6=$_GET['materia6'];
	$materia7=$_GET['materia7'];




if (mysql_query ("UPDATE alumno SET nombre='$nombre',apellido='$apellido',domicilio='$direccion',mail='$mail',sexo='$sexo',f_nac='$f_nac',tel='$tel',pais='$pais',ciudad='$ciudad',provincia='$provincia', tribu='$tribu',f_ingreso='$f_ingreso',escuela='$escuela',localidad_esc='$loca_esc',grado='$grado' where dni=$actor"))
{	
				?>
				<script>
				var answer=alert("Datos Actualizados Correctamente")
				</script> 
						<meta http-equiv='refresh' content='0; URL=ficha2.php?dni=<?php echo $actor?>'>
						<? 
}
				else {	
				?>
				<script>
				var answer=alert("No se pudo grabar en la BD")
				</script> 
				<meta http-equiv='refresh' content='0; URL=menu.php'>
				<? 
				     }					


}

?>
</html>
<? } ?>
