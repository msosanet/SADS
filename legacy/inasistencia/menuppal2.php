 <?PHP

?>
<link rel="stylesheet" href="menu_style.css" type="text/css" />
	<div class="menu">
	<ul>
		<li><a href="menu.php" >Inicio</a></li>
		<li><a href="novedades.php">Lic.</a></li>
		<li><a href="">A. publico</a>
      <ul>


  <?PHP /* ?>       <li><a href="nov_aviso_nuevo.php">Aviso Nuevo</a></li>
        <li><a href="nov_docentes_vertodo.php">Ver todos los avisos</a></li> <?PHP */ ?> 
        <li><a href="planilla_actopublico.php">Subir actos publicos</a></li>
        <li><a href="actopublico_ver.php">RESULTADOS actos publicos</a></li>
      </ul>
      </li>
		<li><a href="#">Info</a>
      <ul>
         <li><a href="infoutil_datos.php">Datos</a></li>
         <li><a href="infoutil_normativa.php">Normativa</a></li>
         <li><a href="infoutil_mesaent.php">Mesa de Entradas-Tr&aacute;mites</a></li>
         <li><a href="infoutil_alumnos.php?id=0">Alumnos-Tr&aacute;mites</a></li>
         <li><a href="infoutil_docentes.php">Docentes-Tr&aacute;mites</a></li>
         <li><a href="https://intranet.educaciontdf.ml/web/juntasec/JuntaSec.htm" target="_blank">Junta C y D Secundaria</a></li>
         <li><a href="infoutil_originales.php">Originales</a></li>
         <li><a href="infoutil_admin.php">Panel de administración</a></li>
         <li><a href="infoutil_articulo_nuevo.php">Nueva p&aacute;gina info &uacute;til</a></li>
      </ul>
      </li>
		<li><a href="menu.php" id="current">Notas</a>
			<ul>
				<li><a href="notas.php">Num. Nota</a></li>
				<li><a href="comunicado.php">Num. Comunicado</a></li>
				<li><a href="ver_notas.php">Buscar notas</a></li>
				<li><a href="ver_comu.php">Buscar Comunicado</a></li>
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
		<li><a href="menu.php" id="current">DJ-Disp-Notif.</a>
			<ul>
				<li><a href="add-dec.php">Agregar DDJJ</a></li>
				<li><a href="buscar_dj.php">Consultar / Mover DDJJ</a></li>
				<li><a href="dispo.php">Nro. Disposici&oacute;n</a></li>
				<li><a href="ver_dispo.php">Buscar Disposic.</a></li>
				<li><a href="notificaciones.php">N&uacute;mero Notificaci&oacute;n</a></li>
				<li><a href="ver_notificaciones.php">Buscar Notificaciones</a></li>
			</ul>
		</li>
<?PHP /*		<!-- li><a href="menu.php" id="current">Dispo.</a>
			<ul>
				<li><a href="dispo.php">Disposiciones</a></li>
				<li><a href="ver_dispo.php">Buscar Dispo</a></li>
         </ul>
		</li>
		<li><a href="menu.php" id="current">Notif.</a>
			<ul>

				<li><a href="notificaciones.php">N&uacute;mero Notificaci&oacute;n</a></li>
				<li><a href="ver_notificaciones.php">Buscar Notificaciones</a></li>			</ul>
		</li -->          */?>

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
				<li><a href="ver_ina3.php">Especifico por Fecha y docente</a></li>
				<li><a href="ver_piza.php">Semanal en Pizarra docentes</a></li>
				<li><a href="ver_piza2.php">Semanal en Pizarra no doc.</a></li>
				<li><a href="ver_ina4.php">Especifico por Fecha y Pomy</a></li>
				<li><a href="xdia.php">Cantidad de dias</a></li>
				<li><a href="selcurparver.php">Parte Diario Preceptores</a></li>
				<li><a href="partepreceptoresmodif.php">Modificar Parte Preceptores</a></li>
			</ul>
		</li>
		<li><a href="menu.php" id="current">Ver</a>
			<ul>
				<li><a href="cv_todos2.php">Datos Personas y Horario</a></li>
				<li><a href="constancias.php">Constancias Jornadas</a></li>
				<li><a href="constancias2.php">Constancias Mesas</a></li>
				<li><a href="const_todos.php">Constancias Todos</a></li>
				<li><a href="estadisticas.php">Estadisticas</a></li>
				<li><a href="legajo3.php">Doc. por Materia</a></li>
				<li><a href="ver_parte.php">Ver Parte</a></li>
				<li><a href="examen.php">Ver Articulos</a></li>
				<li><a href="ver_enf.php">Ver x enfermedad</a></li>
				<li><a href="ver_nov3.php">Ver novedades doc</a></li>
				<li><a href="tribu.php">Ver tribu</a></li>
				<li><a href="plazas3.php">Ver Plazas</a></li>
				<li><a href="paros.php">Ver PAROS</a></li>
				<li><a href="inasiste.php">Ver QUIEN FALTO</a></li>

			</ul>
		</li>
		<li><a href="menu.php" id="current">Altas</a>
			<ul>
				<li><a href="inasistencias.php">Inasistencias</a></li>
				<li><a href="legajos.php">Legajos</a></li>
				<li><a href="partediario.php">Parte diario</a></li>
				<li><a href="alta_docente.php">Datos del Docente</a></li>
				<li><a href="buscar_doc.php">Cargos a Docentes</a></li>
				<li><a href="buscar_doc2.php">Hs a Docentes</a></li>
				<li><a href="buscar_doc3.php">hs Ed. fisica a Docentes</a></li>
				<li><a href="calificadores2.php">Calificadores</a></li>
				<!-- li><a href="add_motivo.php">Motivos de Ausencia</a></li>
				<li><a href="add_motivo2.php">Motivos de Ausencia Pomys</a></li -->
				<li><a href="cargar_nov2.php">Novedad de Toma</a></li>
				<li><a href="come.php">Altas a comedor</a></li>
				<li><a href="alta_materia.php">Alta Materias</a></li>
				<li><a href="alta_horarios.php">Horarios a plazas</a></li>
			</ul>
		</li>
		<li><a href="menu.php" id="current">Bajas</a>
			<ul>
				<li><a href="baja_ina1.php">Borrar Inasistencias</a></li>
				<li><a href="modif_ina1.php">Modif. Inasistencias</a></li>
				<li><a href="modif_parte1.php">Borrar Parte</a></li>
				<li><a href="borrar_parte.php">Modif. Parte</a></li>
				<li><a href="ver_nov2.php">Listar Nov. Toma</a></li>

				<li><a href="modif_mat.php">Modif. materias</a></li>
				<li><a href="editar_horarios.php">Modif. hs plazas</a></li>
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
				<li><a href="faltas6.php">Gen Plla ausentes cargos</a></li>
				<li><a href="listado-doc.php">Listado doc activos</a></li>
			</ul>
		</li>

		<li><a href="menu.php" id="current">Mesas</a>
			<ul>
				<li><a href="mesas.php">Crear Mesa</a></li>
				<li><a href="veo_mesas.php">Buscar/Imprimir Mesa</a></li>
				<li><a href="mesas4.php" target="_blank">Listar alumnos Mesa</a></li>
				<li><a href="mesas5.php" target="_blank">Listar Materias Mesa</a></li>
				<li><a href="mesas6.php" target="_blank">Listar Todos Mesa PDF</a></li>
				<li><a href="genxlsmesaB.php" target="_blank">Listar Todos Mesa xls</a></li>
				<li><a href="mesas7.php" target="_self">Listar x Profe Mesa</a></li>
				<li><a href="borrarmesas.php">Borrar alumnos en mesas</a></li>
				<li><a href="borrarmesas2.php">Borrar mesas creadas</a></li>
			</ul>
		</li>
	<li><a href="menu.php" id="current">Llamados</a>
			<ul>
				<li><a href="ofrecimiento.php">Crear Ofrecimientos</a></li>
				<li><a href="ver_ofre.php">agregar/ver llamados</a></li>

			</ul>
		</li>

		<li><a href="menu.php" id="current">Horarios</a>
				<ul>
					<li><a href="selcurso.php">Cargar Grilla de Curso</a></li>
					<li><a href="selcursodoc.php">Asignar Docentes a Materias</a></li>
					<li><a href="selcurhor.php">Ver Horarios de Cursos</a></li>
					<li><a href="buscaprof.php">Ver Horarios de Docentes</a></li>
					<li><a href="ORIGINALEF.php">Cargar Horario Ed. Fisica</a></li>
					<li><a href="ORIGINALVEF.php">Ver Horario Ed. Fisica</a></li>
					<li><a href="materiasindocentes.php">Materias sin docentes</a></li>
					<li><a href="ver_horario_cargo.php">Horarios Cargos x dia</a></li>
					<li><a href="vercursodoc.php">Ver Docentes-Materias x Curso</a></li>
					<li><a href="versindoc.php">Ver Materias sin Profesor</a></li>
					<li><a href="gestioncursos.php">Gestion de Cursos</a></li>
					<li><a href="selcurhor_fran.php">Prueba Fran</a></li>
<?PHP if ($_SESSION['usuario']=='cecigon') echo '<li><a href="asigMatArea.php">&Aacute;reas de espacios curriculares</a></li>'; ?>

				 </ul></li>
	<?PHP


	/*	<li><a href="menu.php" id="current">Horarios Virtuales</a>
				<ul>
					<li><a href="selcursoVIRTUAL.php">Cargar Grilla de Curso</a></li>
					<li><a href="selcursodocVIRTUAL.php">Asignar Docentes a Materias</a></li>
					<li><a href="selcurhorVIRTUAL.php">Ver Horarios de Cursos</a></li>
					<li><a href="buscaprofVIRTUAL.php">Ver Horarios de Docentes</a></li>
					<li><a href="ORIGINALEFVIRTUAL.php">Cargar Horario Ed. Fisica VIRTUAL</a></li>
					<li><a href="ORIGINALVEFVIRTUAL.php">Ver Horario Ed. Fisica VIRTUAL</a></li>
				</ul></li>*/

	?>

	<li><a href="menu.php" id="current">Sis</a>
			<ul>
				<li><a href="https://nube.colegiosobral.edu.ar" alt="archivos" target="_blank">Archivos</a></li>
				<li><a href="https://remoto.colegiosobral.edu.ar" alt="Fox">Fox</a>
</li>
			</ul>




		<li><a href="logout.php" alt="Cerrar sesión" title="Cerrar sesión de <?=$_SESSION['usuario']?>" style="padding: .2em .2em "><svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 512 512" ><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V256c0 17.7 14.3 32 32 32s32-14.3 32-32V32zM143.5 120.6c13.6-11.3 15.4-31.5 4.1-45.1s-31.5-15.4-45.1-4.1C49.7 115.4 16 181.8 16 256c0 132.5 107.5 240 240 240s240-107.5 240-240c0-74.2-33.8-140.6-86.6-184.6c-13.6-11.3-33.8-9.4-45.1 4.1s-9.4 33.8 4.1 45.1c38.9 32.3 63.5 81 63.5 135.4c0 97.2-78.8 176-176 176s-176-78.8-176-176c0-54.4 24.7-103.1 63.5-135.4z"/></svg></a>
		</li>
	</ul>
	</div>
