<?PHP
session_start();
if ($_SESSION['estado']==1) { 

//include 'conexion.php';
include 'conexion55.php';
?>
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
<title>DATOS DEL Alumno</title>




</head>
<?
include 'header.php';
//$conexion = conectar ();
$conexion55 = conectarX ();

$actor=$_GET["dni"];


$resultt = mysql_query ("SELECT * FROM alumno WHERE dni = $actor");
$filatt = mysql_fetch_array($resultt);



$resulcc = mysql_query ("SELECT * FROM folio WHERE dni = $actor");
$filacc = mysql_fetch_array($resulcc);


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
<form method="GET" action="alumnopreceptor.php?actor=<? echo $actor; ?>">

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
include 'menuppal3.php'; //preceptor
}
?>
				<tr>
				

					<td>
					
					<BR><p align="left" class="text1b">LEGAJO DEL ALUMNO</p><BR>
					<p align="center" class="text1b"><? if($hayerrores) { echo "<h4><font color=red>Existen errores en el ingreso de datos, están marcado con color ROJO</font></h4>";} ?>
</p><div align="left">				<div align="center">
					
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
<!--							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="f_nac" size="10" maxlength="10" value="<?echo $filatt['f_nac'];?>" />&nbsp;AAAA-MM-DD</td> -->
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="date" name="f_nac" size="10" maxlength="10" value="<?echo $filatt['f_nac'];?>" /></td>
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
							
					
					
							<td width="190" bgcolor="#EAEAEA" align="right">Tipo:
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
<!--							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="f_ingreso" size="10" maxlength="10" value="<?echo $filatt['f_ingreso'];?>" />&nbsp;AAAA-MM-DD</td> -->
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="date" name="f_ingreso" size="10" maxlength="10" value="<?echo $filatt['f_ingreso'];?>" /></td>
							</td>
							
							<td width="190" bgcolor="#EAEAEA" align="right">Edad al 30/06/<? echo $anio; ?>
							</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><H2><? echo busca_edad($filatt['f_nac']);?></H2></td>
							</td>
							
							

							
						</tr>
						<tr>


							<td width="190" bgcolor="#EAEAEA" align="right">
							Libro:</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="libro" size="4" maxlength="4" value="<?echo $filacc['libro'];?>" /></td>
							</td>
							
							<td width="190" bgcolor="#EAEAEA" align="right">Folio:
							</td>
							<td bgcolor="#EAEAEA" width="265" align="left"><input type="text" name="folio" size="4" maxlength="4" value="<?echo $filacc['folio'];?>" /></td>
							</td>
							
							

							
						</tr>


						 <tr>
							<td width="834" bgcolor="#EAEAEA" align="left" colspan="4">
							<p align="center"></td>
						</tr>
						

					</table>
				<tr>
					<td>


<center>


<br>
<br>

</font>


<?
$cur = mysql_query ("SELECT * FROM cursa WHERE alumno = $actor ORDER BY anio DESC");

$previ = mysql_query ("SELECT * FROM previas WHERE alumno = $actor ORDER BY materia,fecha");

?>
					
           
<div align="center" style="width: 900px; background-color: #ddcccc">

<table border="0" width="900" bordercolor="#dddddd" cellspacing="0">
   <tr>
       <td colspan="7" align="center" class="text1b" bgcolor="#BB6666">INFORMACION DE PREVIAS</span></td>
   
   <tr>
        <td valign="top"> 
        
          
            <table width="500" border="1" cellspacing="0">
                <tr bgcolor="#dddddd">
      <br>
                </tr>
                
                <tr bgcolor="#dddddd">
                    <td align="center"><b>MATERIA</b></td>
                    <td align="center"><b>NOTA</b></td> 
                    <td align="center"><b>FECHA</b></td>
                    <td align="center"><b>FOLIO</b></td>
                    <td align="center"><b>OBSERVACIONES</b></td>       
                </tr>
                                    
<? while ($prev = mysql_fetch_array($previ))
	{ 
?>        
                <tr>
      			<td align='center' style='background: white'> <? echo $prev[materia]; ?></td>  
      			<td align='center' style='background: white'> <? echo $prev[nota]; ?></td>  
      			<td align='center' style='background: white'> <? echo $prev[fecha]; ?></td>  
      			<td align='center' style='background: white'> <? echo $prev[folio]; ?></td> 
      			<td align='center' style='background: white'> <? echo $prev[observacion]; ?></td>  

                                
                </tr>
<? 
} 
?>
            </table>


    </tr> 
</table> 
<br> 

<br>
</div> 


</table>
<br>
<br>
<br>


<table border="0" width="900" bordercolor="#dddddd" cellspacing="0">
   <tr>
       <td colspan="7" align="center" class="text1b" bgcolor="#BB6666">INFORMACION DE CURSADA</span></td>
   
   <tr>
        <td valign="top"> 
        
          
            <table width="500" border="1" cellspacing="0">
                <tr bgcolor="#dddddd">
      <br>
                </tr>
                
                <tr bgcolor="#dddddd">
                    <td align="center"><b>CURSO</b></td>
                    <td align="center"><b>DIVI</b></td> 
                    <td align="center"><b>CICLO LECTIVO</b></td>
                    <td align="center"><b>PASE</b></td>
                    <td align="center"><b>ACTUAL</b></td>
                    <td align="center"><b>FECHA MOV.</b></td>
                   <td align="center"><b>MODALIDAD</b></td>            
                </tr>
                                    
<? while ($cursa = mysql_fetch_array($cur))
	{ 


$plaan = mysql_query ("SELECT * FROM plan WHERE id = $cursa[modalidad]");
$plan = mysql_fetch_array($plaan);


?>        
                <tr>
      			<td align='center' style='background: white'> <? echo $cursa[curso]; ?>º</td>  
      			<td align='center' style='background: white'> <? echo $cursa[divi]; ?>º</td>  
      			<td align='center' style='background: white'> <? echo $cursa[anio]; ?></td>  
      			<td align='center' style='background: white'> <? echo $cursa[pase]; ?></td> 
      			<td align='center' style='background: white'> <? if ($cursa[control]==1) echo "SI";
			else echo "NO" ?></td>
      			<td align='center' style='background: white'> <? echo $cursa[fecha]; ?></td>
      			<td align='center' style='background: white'> <? echo $plan[descripcion]; ?></td>   

                                
                </tr>
<? 
} 
?>
            </table>


    </tr> 
</table> 
<br> 

<br>
</div> 


</table>
<br>
<br>
<br>
<?
$family = mysql_query ("SELECT * FROM familiares, alu_fami WHERE alu_fami.alumno = $actor and alu_fami.familiar=familiares.dni ORDER BY alu_fami.tipo");

?>
					
           
<div align="center" style="width: 900px; background-color: #ddcccc">



<table border="0" width="900" bordercolor="#000000" cellspacing="0">
   <tr>
       <td colspan="7" align="center" class="text1b" bgcolor="#c0c0c0">INFORMACION DE LOS FAMILIARES</span></td>
   
   <tr>
        <td valign="top"> 
        
          
            <table width="800" border="1" cellspacing="0">
                <tr bgcolor="#dddddd">
      <br>
                </tr>
                
                <tr bgcolor="#dddddd">
                    <td align="center"><b>TIPO</b></td>
                    <td align="center"><b>DNI</b></td>
                    <td align="center"><b>NOMBRE</b></td> 
                    <td align="center"><b>DIRECCION</b></td>
                    <td align="center"><b>TEL PER.</b></td>
                    <td align="center"><b>LUGAR TRABAJO</b></td>
                    <td align="center"><b>TEL LAB</b></td>   
                    <td align="center"><b>MAIL</b></td>             
                </tr>
                                    
<? while ($fami = mysql_fetch_array($family))
	{ 
	if ($fami[tipo]=='P') $fam="PADRE";
	if ($fami[tipo]=='M') $fam="MADRE";
	if ($fami[tipo]=='T') $fam="TUTOR";


?>        
                <tr>
      			<td align='center' style='background: white'> <? echo $fam; ?></td>  
      			<td align='center' style='background: white'> <? echo $fami[dni]; ?></td>  
      			<td align='center' style='background: white'> <? echo $fami[apellido]; ?>, <? echo $fami[nombre]; ?></td>  
      			<td align='center' style='background: white'> <? echo $fami[domicilio]; ?></td>  
      			<td align='center' style='background: white'> <? echo $fami[tel]; ?></td>
      			<td align='center' style='background: white'> <? echo $fami[trabajo]; ?></td>  
      			<td align='center' style='background: white'> <? echo $fami[tel_trabajo]; ?></td>  
      			<td align='center' style='background: white'> <? echo $fami[email]; ?></td>    

                                
                </tr>
<? 
} 
?>
            </table>


    </tr> 
</table> 

<br> 
<br>
</div> 


</table>
<br>
<br>
<br>



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



}

?>
</html>
<? } ?>