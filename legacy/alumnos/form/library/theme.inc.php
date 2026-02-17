<?php

/*
 * The visual theme library
 *
 */

$theme = array();
$theme['styles'] = array();
$theme['styles']['body'] = 'background-color: #ffffff; font-family: tahoma; font-size: 11px; color: #000000';
$theme['styles']['box'] = array();
$theme['styles']['box']['title'] = 'background-color: #eeeeee; padding: 4px; font-family: tahoma; font-size: 11px; font-weight: bold; color: #003366';
$theme['styles']['box']['title_border'] = 'border: 1px solid #808080';
$theme['styles']['box']['content'] = 'background-color: #ffffff; padding: 4px; font-family: tahoma; font-size: 11px; color: #000000';
$theme['styles']['box']['content_border'] = 'border-left: 1px solid #808080; border-bottom: 1px solid #808080; border-right: 1px solid #808080';
$theme['styles']['form'] = array();
$theme['styles']['form']['title'] = 'height: 24px; padding: 2px; font-family: tahoma; font-size: 11px; color: #000000';
$theme['styles']['form']['content'] = 'padding: 2px; font-family: tahoma; font-size: 11px; color: #000000';
$theme['styles']['form']['file'] = 'font-family: tahoma; font-size: 10px; color: #000000';
$theme['styles']['form']['button'] = 'font-family: tahoma; font-size: 11px; color: #000000';
$theme['styles']['form']['datetime_picker_layer'] = 'background-color: #ffffff; border: 1px solid #808080';
$theme['styles']['form']['datetime_picker_title'] = ' height: 18px; background-color: #eeeeee; text-align: center; font-family: tahoma; font-size: 10px; color: #003366; font-weight: bold; border-bottom: 1px solid #808080';
$theme['styles']['form']['datetime_picker_week'] = 'width: 16px; background-color: #f6f6f6; padding: 1px; text-align: center; font-family: tahoma; font-size: 10px; color: #003366';
$theme['styles']['form']['datetime_picker_day_cell'] = 'background-color: #ffffff; text-align: right; padding: 1px';
$theme['styles']['form']['datetime_picker_day'] = 'font-family: tahoma; font-size: 10px; color: #000000; text-decoration: none';
$theme['styles']['form']['datetime_picker_today'] = 'font-family: tahoma; font-size: 10px; color: #d75656; text-decoration: none';
$theme['styles']['form']['required'] = 'font-family: tahoma; font-size: 11px; color: #000000';
$theme['styles']['report'] = array();
$theme['styles']['report']['row_border'] = 'border: 1px solid #999999';
$theme['styles']['report']['row_title'] = 'background-color: #eeeeee; padding: 2px; height: 22px; font-family: tahoma; font-size: 11px; font-weight: bold; color: #000000';
$theme['styles']['report']['row_pair'] = 'background-color: #ffffff; padding: 2px; font-family: tahoma; font-size: 11px; color: #000000';
$theme['styles']['report']['row_non'] = 'background-color: #f6f6f6; padding: 2px; font-family: tahoma; font-size: 11px; color: #000000';
$theme['login'] = array();
$theme['login']['title'] = 'Iniciar sesión';
$theme['login']['name'] = 'Nombre de usuario';
$theme['login']['password'] = 'Contraseña';
$theme['install'] = array();
$theme['install']['title'] = 'Instalar';
$theme['install']['mysql_db'] = 'Base de datos';
$theme['install']['mysql_forms_table'] = 'Tabla de formularios';
$theme['install']['mysql_form_elements_table'] = 'Tabla de elementos de formulario';
$theme['install']['mysql_queries_table'] = 'Tabla de consultas SQL';
$theme['admin'] = array();
$theme['admin']['submit_button'] = 'Enviar';
$theme['admin']['reset_button'] = 'Restablecer';
$theme['admin']['preview_button'] = 'Previsualizar';
$theme['admin']['home_button'] = '&laquo; Volver al inicio';
$theme['admin']['query']['new'] = 'Nueva consulta SQL';
$theme['admin']['query']['modify'] = 'Modificar consulta SQL';
$theme['admin']['query']['id'] = 'Id';
$theme['admin']['query']['name'] = 'Nombre';
$theme['admin']['query']['db'] = 'Base de datos';
$theme['admin']['query']['string'] = 'Consulta SQL';
$theme['admin']['query']['list'] = 'Listado de consultas SQL';
$theme['admin']['query']['params'] = 'Parámetros SQL';
$theme['admin']['query']['none'] = 'Ninguna';
$theme['admin']['form'] = array();
$theme['admin']['form']['new'] = 'Nuevo formulario';
$theme['admin']['form']['modify'] = 'Modificar formulario';
$theme['admin']['form']['id'] = 'Id';
$theme['admin']['form']['name'] = 'Nombre';
$theme['admin']['form']['list'] = 'Listado de formularios';
$theme['admin']['form']['preview'] = 'Previsualización de formulario';
$theme['admin']['form']['element'] = array();
$theme['admin']['form']['element']['new'] = 'Nuevo elemento de formulario';
$theme['admin']['form']['element']['modify'] = 'Modificar elemento de formulario';
$theme['admin']['form']['element']['order'] = 'Orden';
$theme['admin']['form']['element']['name'] = 'Nombre';
$theme['admin']['form']['element']['title'] = 'Título';
$theme['admin']['form']['element']['type'] = 'Tipo';
$theme['admin']['form']['element']['flags'] = 'Configuraciones';
$theme['admin']['form']['element']['list'] = 'Listado de elementos de formulario';
$theme['admin']['form']['elements'] = array();
$theme['admin']['form']['elements']['plain_text'] = 'Texto plano';
$theme['admin']['form']['elements']['text_box'] = 'Campo de texto';
$theme['admin']['form']['elements']['password_box'] = 'Campo de contraseña';
$theme['admin']['form']['elements']['search_box'] = 'Campo de búsqueda';
$theme['admin']['form']['elements']['date_box'] = 'Campo de fecha';
$theme['admin']['form']['elements']['time_box'] = 'Campo de hora';
$theme['admin']['form']['elements']['datetime_box'] = 'Campo de fecha/hora';
$theme['admin']['form']['elements']['check_box'] = 'Casilla de verificación';
$theme['admin']['form']['elements']['radio_buttons'] = 'Botones de radio';
$theme['admin']['form']['elements']['combo_box'] = 'Lista desplegable';
$theme['admin']['form']['elements']['list_box'] = 'Lista desplegada';
$theme['admin']['form']['elements']['text_area'] = 'Área de texto';
$theme['admin']['form']['elements']['hidden_field'] = 'Campo oculto';
$theme['admin']['form']['elements']['file_box'] = 'Campo de archivo';
$theme['admin']['report'] = array();
$theme['admin']['report']['titles'] = array();
$theme['admin']['report']['titles']['id'] = 'Id';
$theme['admin']['report']['titles']['name'] = 'Nombre';
$theme['admin']['report']['titles']['order'] = 'Orden';
$theme['admin']['report']['titles']['title'] = 'Título';
$theme['admin']['report']['titles']['type'] = 'Tipo';
$theme['admin']['report']['options'] = array();
$theme['admin']['report']['options']['modify_alt'] = 'Modificar';
$theme['admin']['report']['options']['modify_image'] = 'modify.gif';
$theme['admin']['report']['options']['delete_alt'] = 'Eliminar';
$theme['admin']['report']['options']['delete_image'] = 'delete.gif';
$theme['admin']['report']['options']['delete_confirm'] = '¿Seguro que quieres eliminar este registro?';
$theme['form'] = array();
$theme['form']['submit_button'] = 'Enviar';
$theme['form']['reset_button'] = 'Restablecer';
$theme['form']['datetime_picker_alt'] = 'Abrir calendario';
$theme['form']['datetime_picker_image'] = 'datetime_picker.gif';
$theme['form']['datetime_picker_back_image'] = 'arrow_left.gif';
$theme['form']['datetime_picker_forward_image'] = 'arrow_right.gif';
$theme['form']['datetime_picker_day_names'] = array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo');
$theme['form']['datetime_picker_month_names'] = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
$theme['form']['time_picker_alt'] = 'Poner hora';
$theme['form']['time_picker_image'] = 'time_picker.gif';
$theme['form']['searcher_alt'] = 'Abrir buscador';
$theme['form']['searcher_image'] = 'searcher.gif';
$theme['form']['searcher_default_alt'] = 'Restablecer';
$theme['form']['searcher_default_image'] = 'searcher_default.gif';
$theme['form']['select_all_button_alt'] = 'Seleccionar todo';
$theme['form']['select_all_button_image'] = 'select_all.gif';
$theme['form']['deselect_all_button_alt'] = 'Deseleccionar todo';
$theme['form']['deselect_all_button_image'] = 'deselect_all.gif';
$theme['form']['max_upload_size'] = '<small>Máx: %s KB</small>';
$theme['form']['required_field'] = 'El campo es requerido';
$theme['javascript'] = array();
$theme['javascript']['admin_error'] = 'El formulario esta vacío o contiene errores';
$theme['javascript']['form'] = array();
$theme['javascript']['form']['preview_ok'] = 'El formulario está correcto';
$theme['javascript']['form']['form_error'] = 'Error al cargar el formulario';
$theme['javascript']['form']['null_error'] = 'El campo `%s´ no puede quedar vacío';
$theme['javascript']['form']['integer_error'] = 'El campo `%s´ debe ser un número entero';
$theme['javascript']['form']['integer_unsigned_error'] = 'El campo `%s´ debe ser un número entero sin signo';
$theme['javascript']['form']['number_error'] = 'El campo `%s´ debe ser un número';
$theme['javascript']['form']['number_unsigned_error'] = 'El campo `%s´ debe ser un número sin signo';
$theme['javascript']['form']['alpha_error'] = 'El campo `%s´ debe contener solo caracteres alfabéticos';
$theme['javascript']['form']['alphanum_error'] = 'El campo `%s´ debe contener solo caracteres alfanuméricos';
$theme['javascript']['form']['email_error'] = 'El campo `%s´ debe ser una dirección de correo electrónico';
$theme['javascript']['form']['url_error'] = 'El campo `%s´ debe ser una URL válida';
$theme['javascript']['form']['date_error'] = 'El campo `%s´ debe ser una fecha';
$theme['javascript']['form']['time_error'] = 'El campo `%s´ debe ser una hora';
$theme['javascript']['form']['datetime_error'] = 'El campo `%s´ debe ser una fecha/hora';
$theme['javascript']['form']['password_error'] = 'Las contraseñas no concuerdan';
$theme['javascript']['form']['check_box_error'] = 'La casilla de verificación `%s´ debe estar chequeada';
$theme['javascript']['form']['radio_buttons_error'] = 'Debe chequear uno de los botones de radio `%s´';
$theme['javascript']['form']['combo_box_error'] = 'La lista desplegable `%s´ no puede quedar vacía ni contener valores nulos';
$theme['javascript']['form']['list_box_error'] = 'La lista desplegada `%s´ no puede quedar vacía';
$theme['javascript']['form']['list_box_multiselect_error'] = 'La lista desplegada `%s´ no puede quedar vacía';
$theme['errors'] = array();
$theme['errors']['title'] = 'Error';
$theme['errors']['connection_error'] = 'No se pudo conectar al servidor mySQL en <b>%s</b>:<b>%s</b>. Por favor, revisa el archivo de configuraión "config.inc.php".';
$theme['errors']['sql_query_error'] = 'Tienes un error en la consulta SQL. <blockquote><li>Base de datos: "%s" <li>Consulta SQL: "%s"</blockquote>';
$theme['errors']['sql_command_error'] = 'Tienes un error en el comando SQL. <blockquote><li>Base de datos: "%s" <li>Comando SQL: "%s"</blockquote>';
$theme['errors']['form'] = array();
$theme['errors']['form']['form_error'] = 'No hay ningún formulario con id igual a "%s".';
$theme['errors']['form']['query_error'] = 'No hay ninguna consulta SQL con id igual a "%s".';
$theme['errors']['form']['query_result_error'] = 'La consulta SQL devolvió más de un registro. <blockquote><li>Base de datos: "%s" <li>Consulta SQL: "%s"</blockquote>';
$theme['errors']['form']['flag_error'] = 'Hay un error en la configuración del parámetro "%s".';

function html($title, $content)
{
	$html = '<html>';
	$html .= '<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">';
	$html .= '<meta http-equiv="pragma" content="no-cache">';
	$html .= sprintf('%s', head($title));
	$html .= sprintf('%s', body($content));
	$html .= '</html>';
	print $html;
}

function head($title)
{
	global $theme;

	$html = '<head>';
	$html .= sprintf('<title>%s</title>', $title);
	$html .= '</head>';
	return $html;
}

function body($content)
{
	global $theme;

	$html = sprintf('<style type="text/css">body { %s }</style>', $theme['styles']['body']);
	$html .= sprintf('<body class="body">%s</body>', $content);
	return $html;
}

function box($title, $content, $content_align, $width, $align)
{
	global $config, $theme;

	$style = '<style type="text/css">';
	foreach (array_keys($theme['styles']['box']) as $key) $style .= sprintf('.box_%s { %s }', $key, $theme['styles']['box'][$key]);
	$style .= '</style>';

	$html = $style;
	$html .= sprintf('<table cellspacing="0" cellpadding="0" border="0" width="%s" align="%s">', $width, $align);
	$html .= sprintf('<tr><td height="25" class="box_title box_title_border">&nbsp;<img src="%s/images/arrow_right.gif">&nbsp;&nbsp;%s</td></tr>', $config['url'], $title);
	$html .= sprintf('<tr><td align="%s" valign="top" class="box_content box_content_border">%s</td></tr>', $content_align, $content);
	$html .= '</table>';
	return $html;
}

?>