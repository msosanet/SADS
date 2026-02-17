<!-- LISTA DE DOCENTES PARA ELEGIR *********************************** -->                    
			<!-- span class="titulo">Docente: </span -->
            <select style="border: 1px solid #888888; background-color: #ffffff; border-radius: 5px; padding: 4px 0 4px 0; box-shadow: 0 0 2px #555555;" size="1" name="docente" autofocus="true">
            <option>- - - - - -</option>
            <? $listadocentes = mysql_query ("SELECT * FROM docentes WHERE identificacion = 1 ORDER BY apellido,nombre");
            
            	while ($docente = mysql_fetch_array($listadocentes)) {			
					echo "<option>" . $docente[apellido] . " " . $docente[nombre] . " - D.N.I. Nº " . $docente[dni] . "</option>";
				    }
		    ?>
            </select>
<!-- FIN LISTA DE DOCENTES PARA ELEGIR *********************************************** -->