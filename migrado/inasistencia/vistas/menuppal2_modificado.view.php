<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=windows-1252" />
<title></title>
<!-- link rel="stylesheet" href="style2.css" type="text/css" / -->
<!-- ++++++++++++++++++++ ESTILOS MENU ++++++++++++++++++++++ -->
<style>
ul {
  list-style: none;
  padding: 0;
  margin: 0;
  background: #C7C8CA;
}

ul li {
  display: block;
  position: relative;
  float: left;
  background: #C7C8CA;
  border-bottom: 1px solid #ffffff;
}

/* This hides the dropdowns */


li ul {
  display: none;
}

ul li a {
  display: block;
  padding: 0.5em;
  text-decoration: none;
  white-space: nowrap;
  color: #000000;
}

ul li a:hover {
  background: #F05936;
  color: #000000;
}

/* Display the dropdown */


li:hover > ul {
  display: block;
  position: absolute;
  width: 220px;
}

li:hover li {
  float: none;
}

li:hover a {
   background: #b0b0b0; /*gris más oscuro*/
}

li:hover li a:hover {
  background: #F05936;
  color: #ffffff;
}

.main-navigation li ul li {
  /*border-bottom: 1px solid #ffffff;*/
}

/* Displays second level dropdowns to the right of the first level dropdown */


ul ul ul {
  left: 100.5%;
  top: 0;
}

/* Simple clearfix */



ul:before,
ul:after {
  content: " "; /* 1 */
  display: table; /* 2 */
}

ul:after {
  clear: both;
}

</style>
<!-- ++++++++++++++++++++++ FIN ESTILOS MENU +++++++++++++++++ -->

</head>
<body>

<div class="menu">
<ul>
		<li><a href="menu.php" >Inicio</a></li>
		<li><a href="nov_docentes_ver2.php">Avisos</a>
      <ul>
         <li><a href="nov_aviso_nuevo.php">Aviso Nuevo</a></li>
         <!-- li><a href="nov_aviso_modificar.php">Modificar Aviso</a></li -->
         <li><a href="mas_de_2_dias.php">Docentes con m&aacute;s de 2 d&iacute;as</a></li>
         <!-- li><a href="#">tres</a></li -->
      </ul>
  </li>
		<li><a href="#">Info &uacute;til</a>
      <ul>
         <li><a href="infoutil_institucionales.php">Datos Institucionales</a></li>
         <li><a href="infoutil_normativa.php">Normativa</a></li>
         <li><a href="infoutil_rutina.php">Rutina anual</a></li>
         <li><a href="infoutil_telef_int.php">Tel&eacute;fonos internos</a></li>
         <li><a href="infoutil_telefonos.php">Tel&eacute;fonos</a></li>
         <li><a href="#">Tr&aacute;mites de docentes</a>
              <ul>
                  <li><a href="infoutil_gremiales.php">Gremiales</a></li>
                  <li><a href="infoutil_legajos.php">Legajos</a></li>
                  <li><a href="infoutil_decjuradas.php">Decl. jurada</a></li>
                  <li><a href="infoutil_asigfliares.php">Asig. Fliares.</a></li>
                  <li><a href="infoutil_licencias.php">Licencias</a></li>
              </ul>
         </li>
         <li><a href="infoutil_telefonos.php">Tr&aacute;mites de alumnos</a></li>
      </ul>
  </li>
		<li><a href="menu.php" id="current">Notas</a>
			<ul>
				<li><a href="notas.php">Num. Nota</a></li>
				<li><a href="ver_notas.php">Buscar notas</a></li>
				<li><a href="ver_notastodas.php">Buscar notas años anteriores</a></li>
				<li><a href="add_nota.php">Agregar Notas Entrada</a></li>
				<li><a href="ver_nota_entrada.php">Ver notas entrada</a></li>
				<li><a href="add_nota2.php">Agregar Notas Salida</a></li>
				<li><a href="add_nota22.php">Agregar Notas Salida c/fecha</a></li>
				<li><a href="ver_nota_salida.php">Ver notas Salida</a></li>
				<li><a href="enviadas.php">Ver notas no enviadas</a></li>
				<li><a href="add_tipo_nota.php">Agregar tipo nota</a></li>
			</ul>
		</li>
		<li><a href="menu.php" id="current">DDJJ</a>
			<ul>
				<li><a href="add-dec.php">Agregar DDJJ</a></li>
				<li><a href="buscar_dj.php">Mover DDJJ</a></li>
			</ul>
		</li>
		<li><a href="menu.php" id="current">Dispo.</a>
			<ul>
				
				<li><a href="dispo.php">Disposiciones</a></li>
				<li><a href="ver_dispo.php">Buscar Dispo</a></li>			</ul>
		</li>
		<li><a href="menu.php" id="current">Notif.</a>
			<ul>
				
				<li><a href="notificaciones.php">N&uacute;mero Notificaci&oacute;n</a></li>
				<li><a href="ver_notificaciones.php">Buscar Notificaciones</a></li>			</ul>
		</li>			
		<li><a href="menu.php" id="current">Ingreso</a>
			<ul>
				<li><a href="cv.php">Docentes Por Apellido</a></li>
				<li><a href="tarde.php">Docentes Tarde</a></li>
				<li><a href="hora-doc.php">Docentes Por Dia</a></li>
				<li><a href="consulta.php">Ausentes Semanales</a></li>
				<li><a href="cv2.php">No Docentes Por Apellido</a></li>
				<li><a href="hora.php">No Docentes Por Dia</a></li>
				<li><a href="tarde-pomy.php">No Docentes Tarde</a></li>
				<li><a href="mensual.php">Mensual Pomys</a></li>

			</ul>
		</li>

		<li><a href="menu.php" id="current">Faltas</a>
			<ul>
				<li><a href="ver_ina.php">Todos por Fecha</a></li>
				<li><a href="ver_ina2.php">Especifico por Fecha y docente</a></li>
				<li><a href="ver_piza.php">Semanal en Pizarra docentes</a></li>
				<li><a href="ver_piza2.php">Semanal en Pizarra no doc.</a></li>
				<li><a href="ver_ina4.php">Especifico por Fecha y Pomy</a></li>
				<li><a href="xdia.php">Cantidad de dias</a></li>
			</ul>
		</li>
		<li><a href="menu.php" id="current">Consultas</a>
			<ul>
				<li><a href="cv_todos2.php">Datos Personas/modif</a></li>
				<li><a href="constancias.php">Constancias Jornadas</a></li>
				<li><a href="constancias2.php">Constancias Mesas</a></li>
				<li><a href="const_todos.php">Constancias Todos</a></li>
				<li><a href="legajo.php">Ver Legajo</a></li>
				<li><a href="estadisticas.php">Estadisticas</a></li>
				<li><a href="legajo3.php">Doc. por Materia</a></li>
				<li><a href="ver_parte.php">Ver Parte</a></li>
				<li><a href="examen.php">Ver Articulos</a></li>
				<li><a href="ver_enf.php">Ver x enfermedad</a></li>
				<li><a href="ver_nov3.php">Ver novedades doc</a></li>
			</ul>
		</li>
		<li><a href="menu.php" id="current">Altas</a>
			<ul>
				<li><a href="inasistencias.php">Inasistencias</a></li>
				<li><a href="partediario.php">Parte diario</a></li>
				<li><a href="alta_docente.php">Datos del Docente</a></li>
				<li><a href="buscar_doc.php">Cargos a Docentes</a></li>
				<li><a href="buscar_doc2.php">Hs a Docentes</a></li>
				<li><a href="buscar_doc3.php">hs Ed. fisica a Docentes</a></li>
				<li><a href="calificadores2.php">Calificadores</a></li>
				<li><a href="add_motivo.php">Motivos de Ausencia</a></li>
				<li><a href="add_motivo2.php">Motivos de Ausencia Pomys</a></li>
				<li><a href="cargar_nov2.php">Novedad de Toma</a></li>
			</ul>
		</li>
		<li><a href="menu.php" id="current">Bajas</a>
			<ul>
				<li><a href="baja_ina1.php">Borrar Inasistencias</a></li>
				<li><a href="modif_ina1.php">Modif. Inasistencias</a></li>
				<li><a href="modif_parte1.php">Borrar Parte</a></li>
				<li><a href="borrar_parte.php">Modif. Parte</a></li>
				<li><a href="ver_nov2.php">Listar Nov. Toma</a></li>
			</ul>
		</li>
		<li><a href="menu.php" id="current">Justif.</a>
			<ul>
				<li><a href="ver_inax.php">Justificar</a></li>
				<li><a href="sube.php">Cargar ina. justif</a></li>
				<li><a href="planilla.php">Gen. planilla inasis.</a></li>
				<li><a href="diario_reloj0.php">Gen planilla diario_reloj</a></li>
				<li><a href="parte_diario0.php">Gen planilla parte diario</a></li>
				<li><a href="planilla4.php">Gen. planilla inas gremial</a></li>
				<li><a href="pedido1.php">Gen planilla inasis x doc</a></li>
				<li><a href="faltas.php">Generar planilla hs Doc.</a></li>
				<li><a href="faltas3.php">Gen planilla NO Doc. reloj</a></li>
				<li><a href="faltasxx.php">Gen planilla NO Doc.</a></li>
			</ul>
		</li>
		<li><a href="menu.php" id="current">Alumnos</a>
			<ul>
				<li><a href="ver_nov.php">Listar Novedades</a></li>
				<li><a href="cargar_nov.php">Cargar Novedades</a></li>
				<li><a href="autogestion.php">Constancias AR</a></li>
				<li><a href="verificar.php">Validar codigo</a></li>
				<li><a href="veo_cursos.php">Ver cursos</a></li>
				<li><a href="veo_alumno.php">Ver datos de alumnos</a></li>
			</ul>
		</li>
		<li><a href="menu.php" id="current">Mesas</a>
			<ul>
				<li><a href="mesas.php">Crear Mesa</a></li>
				<li><a href="veo_mesas.php">Buscar/Imprimir Mesa</a></li>
				<li><a href="mesas4.php" target="_blank">Listar alumnos Mesa</a></li>
				<li><a href="mesas5.php" target="_blank">Listar Materias Mesa</a></li>
				<li><a href="mesas6.php" target="_blank">Listar Todos Mesa</a></li>
				<li><a href="mesas7.php" target="_self">Listar x Profe Mesa</a></li>
				<li><a href="borrarmesas.php">Borrar alumnos en mesas</a></li>
				<li><a href="borrarmesas2.php">Borrar mesas creadas</a></li>
			</ul>
		</li>
		<li><a href="logout.php">Salir</a>
		</li>
</ul>
</div>

</body>
</html>

