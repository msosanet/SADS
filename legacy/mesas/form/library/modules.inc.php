<?php

/*
 * Modules for administration/installation front-end
 *
 */

function get_module($module, $option)
{
	global $config, $theme, $db;
	
	if ($module == 'home')
	{
		$installed = true;
		$installed = $db->is_db($config['mysql_db']);
		$installed = $installed ? $db->is_tb($config['mysql_db'], $config['mysql_forms_table']) : false;
		$installed = $installed ? $db->is_tb($config['mysql_db'], $config['mysql_form_elements_table']) : false;
		$installed = $installed ? $db->is_tb($config['mysql_db'], $config['mysql_queries_table']) : false;
		if (!$installed)
		{
			header('location: index.php?module=install');
			exit();
		}
	}

	$header = box($theme['form_class'] . ' / ' . $theme['form_class_version'], null, 'center', '100%', 'center');

	$style = '<style type="text/css">';
	foreach (array_keys($theme['styles']['form']) as $key) $style .= sprintf('.form_%s { %s }', $key, $theme['styles']['form'][$key]);
	foreach (array_keys($theme['styles']['report']) as $key) $style .= sprintf('.report_%s { %s }', $key, $theme['styles']['report'][$key]);
	$style .= '</style>';

	switch ($module)
	{
		case 'install':
			$install = sprintf('<form action="index.php" method="post" enctype="multipart/form-data">', $theme['javascript']['admin_error']);
			$install .= '<input type="hidden" name="module" value="installs">';
			$install .= '<input type="hidden" name="option" value="install">';
			$install .= '<table cellspacing="2" cellpadding="3" border="0" align="center">';
			$install .= '<tr>';
			$install .= sprintf('<td class="form_title">%s</td>', $theme['install']['mysql_db']);
			$install .= sprintf('<td class="form_content"><input type="text" name="db" size="35" maxlength="50" value="%s" class="form_content" readonly></td>', $config['mysql_db']);
			$install .= '</tr>';
			$install .= '<tr>';
			$install .= sprintf('<td class="form_title">%s</td>', $theme['install']['mysql_forms_table']);
			$install .= sprintf('<td class="form_content"><input type="text" name="forms_table" size="35" maxlength="50" value="%s" class="form_content" readonly></td>', $config['mysql_forms_table']);
			$install .= '</tr>';
			$install .= '<tr>';
			$install .= sprintf('<td class="form_title">%s</td>', $theme['install']['mysql_form_elements_table']);
			$install .= sprintf('<td class="form_content"><input type="text" name="form_elements_table" size="35" maxlength="50" value="%s" class="form_content" readonly></td>', $config['mysql_form_elements_table']);
			$install .= '</tr>';
			$install .= '<tr>';
			$install .= sprintf('<td class="form_title">%s</td>', $theme['install']['mysql_queries_table']);
			$install .= sprintf('<td class="form_content"><input type="text" name="queries_table" size="35" maxlength="50" value="%s" class="form_content" readonly></td>', $config['mysql_queries_table']);
			$install .= '</tr>';
			$install .= '</table>';
			$install .= sprintf('<p align="center"><input type="submit" value="%s" class="form_button"> <input type="reset" value="%s" class="form_button"></p>', $theme['admin']['submit_button'], $theme['admin']['reset_button']);
			$install .= '</form>';
			$install = box($theme['install']['title'], $install, 'center', '50%', 'center');
			$html = $style;
			$html .= '<table cellspacing="4" cellpaddin="4" border="0" align="center" width="100%">';
			$html .= sprintf('<tr><td height="50" colspan="2" valign="top">%s</td></tr>', $header);
			$html .= sprintf('<tr><td valign="top">%s</td></tr>', $install);
			$html .= '</table>';
			html($theme['form_class'], $html);
		break;
		case 'installs':
			switch ($option)
			{
				case 'install':
					$db->new_db($_POST['db']);
					$db->command(sprintf('CREATE TABLE IF NOT EXISTS %s (id int(10) unsigned NOT NULL auto_increment, form_id int(5) unsigned NOT NULL default "0", ord int(3) unsigned NOT NULL default "0", title varchar(50) NOT NULL default "", name varchar(50) NOT NULL default "", type varchar(15) NOT NULL default "", flags text, PRIMARY KEY (id), FULLTEXT KEY flags (flags)) TYPE = MyISAM', $_POST['form_elements_table']));
					$db->command(sprintf('CREATE TABLE IF NOT EXISTS %s (id int(10) unsigned NOT NULL auto_increment, name varchar(50) NOT NULL default "", PRIMARY KEY  (id)) TYPE = MyISAM', $_POST['forms_table']));
					$db->command(sprintf('CREATE TABLE IF NOT EXISTS %s (id int(10) unsigned NOT NULL auto_increment, name varchar(50) NOT NULL default "", db varchar(50) NOT NULL default "", query text NOT NULL, PRIMARY KEY (id), FULLTEXT KEY query (query)) TYPE = MyISAM', $_POST['queries_table']));
					header('location: index.php?module=home');
				break;
			}
		break;
		case 'login':
			$login = '<form action="index.php" method="get" enctype="multipart/form-data">';
			$login .= '<input type="hidden" name="action" value="login">';
			$login .= '<table cellspacing="2" cellpadding="3" border="0" align="center">';
			$login .= '<tr>';
			$login .= sprintf('<td class="form_title">%s</td>', $theme['login']['name']);
			$login .= sprintf('<td class="form_content"><input type="text" name="login" size="30" maxlength="20" value="%s" class="form_content"></td>', $option);
			$login .= '</tr>';
			$login .= '<tr>';
			$login .= sprintf('<td class="form_title">%s</td>', $theme['login']['password']);
			$login .= '<td class="form_content"><input type="password" name="password" size="20" value="" maxlength="14" class="form_content"></td>';
			$login .= '</tr>';
			$login .= '</table>';
			$login .= sprintf('<p align="center"><input type="submit" value="%s" class="form_button"> <input type="reset" value="%s" class="form_button"></p>', $theme['admin']['submit_button'], $theme['admin']['reset_button']);
			$login .= '</form>';
			$login = box($theme['login']['title'], $login, 'center', '50%', 'center');
			$html = $style;
			$html .= '<table cellspacing="4" cellpaddin="4" border="0" align="center" width="100%">';
			$html .= sprintf('<tr><td height="50" colspan="2" valign="top">%s</td></tr>', $header);
			$html .= sprintf('<tr><td valign="top">%s</td></tr>', $login);
			$html .= '</table>';
			html($theme['form_class'], $html);
		break;
		case 'home':
			$new_form = sprintf('<form action="index.php" method="post" enctype="multipart/form-data" onSubmit="return new_form(this, \'%s\')">', $theme['javascript']['admin_error']);
			$new_form .= '<input type="hidden" name="module" value="forms">';
			$new_form .= '<input type="hidden" name="option" value="insert">';
			$new_form .= '<table cellspacing="2" cellpadding="3" border="0" align="center">';
			$new_form .= '<tr>';
			$new_form .= sprintf('<td class="form_title">%s</td>', $theme['admin']['form']['name']);
			$new_form .= '<td class="form_content"><input type="text" name="name" size="35" maxlength="50" value="" class="form_content"></td>';
			$new_form .= '</tr>';
			$new_form .= '</table>';
			$new_form .= sprintf('<p align="center"><input type="submit" value="%s" class="form_button"> <input type="reset" value="%s" class="form_button"></p>', $theme['admin']['submit_button'], $theme['admin']['reset_button']);
			$new_form .= '</form>';
			$new_form = box($theme['admin']['form']['new'], $new_form, 'center', '100%', 'center');
			$forms = '<table cellspacing="2" cellpaddin="2" border="0" align="center" width="100%">';
			$forms .= sprintf('<tr><td class="report_row_title report_row_border" width="40" align="center">%s</td><td class="report_row_title report_row_border" width="*" align="center">%s</td><td></td>', $theme['admin']['report']['titles']['id'], $theme['admin']['report']['titles']['name']);
			$result = $db->query(sprintf('SELECT id, name FROM %s ORDER BY id ASC', $config['mysql_forms_table']));
			$i = 0;
			foreach ($result as $row => $column)
			{
				$forms .= sprintf('<tr><td class="%s report_row_border" width="40" align="right">%s</td><td class="%s report_row_border" width="*" align="left">%s</td><td class="%s report_row_border" width="40"><table cellspacing="1" cellpadding="0"><tr><td><a href="index.php?module=form&id=%s"><img src="%s/images/%s" alt="%s" border="0"></a></td><td><a href="javascript: if (confirm(\'%s\')) window.location.href=\'index.php?module=forms&option=delete&id=%s\'"><img src="%s/images/%s" alt="%s" border="0"></a></td></tr></table></td>', set_report_row_style($i), $column[0], set_report_row_style($i), $column[1], set_report_row_style($i), $column[0], $config['url'], $theme['admin']['report']['options']['modify_image'], $theme['admin']['report']['options']['modify_alt'], $theme['admin']['report']['options']['delete_confirm'], $column[0], $config['url'], $theme['admin']['report']['options']['delete_image'], $theme['admin']['report']['options']['delete_alt']);
				$i++;
			}
			$forms .= '</table>';
			$forms = box($theme['admin']['form']['list'], $forms, 'center', '100%', 'center');
			$new_query = sprintf('<form action="index.php" method="post" enctype="multipart/form-data" onSubmit="return new_query(this, \'%s\')">', $theme['javascript']['admin_error']);
			$new_query .= '<input type="hidden" name="module" value="queries">';
			$new_query .= '<input type="hidden" name="option" value="insert">';
			$new_query .= '<table cellspacing="2" cellpadding="3" border="0" align="center">';
			$new_query .= '<tr>';
			$new_query .= sprintf('<td class="form_title">%s</td>', $theme['admin']['query']['name']);
			$new_query .= '<td class="form_content"><input type="text" name="name" size="35" maxlength="50" value="" class="form_content"></td>';
			$new_query .= '</tr>';
			$new_query .= '</table>';
			$new_query .= sprintf('<p align="center"><input type="submit" value="%s" class="form_button"> <input type="reset" value="%s" class="form_button"></p>', $theme['admin']['submit_button'], $theme['admin']['reset_button']);
			$new_query .= '</form>';
			$new_query = box($theme['admin']['query']['new'], $new_query, 'center', '100%', 'center');
			$queries = '<table cellspacing="2" cellpaddin="2" border="0" align="center" width="100%">';
			$queries .= sprintf('<tr><td class="report_row_title report_row_border" width="40" align="center">%s</td><td class="report_row_title report_row_border" width="*" align="center">%s</td><td></td>', $theme['admin']['report']['titles']['id'], $theme['admin']['report']['titles']['name']);
			$result = $db->query(sprintf('SELECT id, name FROM %s ORDER BY id ASC', $config['mysql_queries_table']));
			$i = 0;
			foreach ($result as $row => $column)
			{
				$queries .= sprintf('<tr><td class="%s report_row_border" width="40" align="right">%s</td><td class="%s report_row_border" width="*" align="left">%s</td><td class="%s report_row_border" width="40"><table cellspacing="1" cellpadding="0"><tr><td><a href="index.php?module=query&id=%s"><img src="%s/images/%s" alt="%s" border="0"></a></td><td><a href="javascript: if (confirm(\'%s\')) window.location.href=\'index.php?module=queries&option=delete&id=%s\'"><img src="%s/images/%s" alt="%s" border="0"></a></td></tr></table></td>', set_report_row_style($i), $column[0], set_report_row_style($i), $column[1], set_report_row_style($i), $column[0], $config['url'], $theme['admin']['report']['options']['modify_image'], $theme['admin']['report']['options']['modify_alt'], $theme['admin']['report']['options']['delete_confirm'] , $column[0], $config['url'], $theme['admin']['report']['options']['delete_image'], $theme['admin']['report']['options']['delete_alt']);
				$i++;
			}
			$queries .= '</table>';
			$queries = box($theme['admin']['query']['list'], $queries, 'center', '100%', 'center');
			$html = $style;
			$html .= '<script language="javascript1.2" src="library/admin.js"></script></title>';
			$html .= '<table cellspacing="4" cellpaddin="4" border="0" align="center" width="100%">';
			$html .= sprintf('<tr><td height="50" colspan="2" valign="top">%s</td></tr>', $header);
			$html .= '<tr>';
			$html .= '<td valign="top"><table cellspacing="4" cellpaddin="4" width="100%">';
			$html .= sprintf('<tr><td>%s</td></tr><tr><td>&nbsp;</td></tr><tr><td>%s</td></tr>', $new_form, $forms);
			$html .= '</table></td>';
			$html .= '<td valign="top"><table cellspacing="4" cellpaddin="4" width="100%">';
			$html .= sprintf('<tr><td>%s</td></tr><tr><td>&nbsp;</td></tr><tr><td>%s</td></tr></table></td>', $new_query, $queries);
			$html .= '</table></td>';
			$html .= '</tr>';
			$html .= '</table>';
			html($theme['form_class'], $html);
		break;
		case 'form':
			$result = $db->query(sprintf('SELECT name FROM %s WHERE id = %s LIMIT 1', $config['mysql_forms_table'], $_GET['id']));
			$form = sprintf('<form action="index.php" method="post" enctype="multipart/form-data" onSubmit="return modify_form(this, \'%s\')">', $theme['javascript']['admin_error']);
			$form .= '<input type="hidden" name="module" value="forms">';
			$form .= '<input type="hidden" name="option" value="update">';
			$form .= sprintf('<input type="hidden" name="id" value="%s">', $_GET['id']);
			$form .= '<table cellspacing="2" cellpadding="3" border="0" align="center">';
			$form .= '<tr>';
			$form .= sprintf('<td class="form_title">%s</td>', $theme['admin']['form']['id']);
			$form .= sprintf('<td class="form_content"><b>%s</b></td>', $_GET['id']);
			$form .= '</tr>';
			$form .= '<tr>';
			$form .= sprintf('<td class="form_title">%s</td>', $theme['admin']['form']['name']);
			$form .= sprintf('<td class="form_content"><input type="text" name="name" size="35" maxlength="50" value="%s" class="form_content"></td>', (isset($result[0][0]) ? $result[0][0] : null));
			$form .= '</tr>';
			$form .= '</table>';
			$form .= sprintf('<p align="center"><input type="submit" value="%s" class="form_button"> <input type="reset" value="%s" class="form_button"></p>', $theme['admin']['submit_button'], $theme['admin']['reset_button']);
			$form .= '</form>';
			$form = box($theme['admin']['form']['modify'], $form, 'center', '100%', 'center');
			$preview = '<form action="index.php" method="get" enctype="multipart/form-data" target="form_preview" onSubmit="return preview_form()">';
			$preview .= '<input type="hidden" name="module" value="preview">';
			$preview .= sprintf('<input type="hidden" name="form" value="%s">', $_GET['id']);
			$preview .= '<table cellspacing="2" cellpadding="3" border="0" align="center">';
			$preview .= '<tr>';
			$preview .= sprintf('<td class="form_title">%s</td>', $theme['admin']['query']['name']);
			$result = $db->query(sprintf('SELECT id, name FROM %s ORDER BY id ASC', $config['mysql_queries_table']));
			$options = sprintf('<option value="0" selected>%s</option>', $theme['admin']['query']['none']);
			foreach ($result as $row => $column)
			{
				$options .= sprintf('<option value="%s">%s</option>', $column[0], $column[1]);
			}
			$preview .= sprintf('<td class="form_content"><select name="query" class="form_content">%s</select></td>', $options);
			$preview .= '</tr>';
			$preview .= '<tr>';
			$preview .= sprintf('<td class="form_title">%s</td>', $theme['admin']['query']['params']);
			$preview .= '<td class="form_content"><input type="text" name="params" size="10" value="" class="form_content"></td>';
			$preview .= '</tr>';
			$preview .= '</table>';
			$preview .= sprintf('<p align="center"> <input type="submit" value="%s" class="form_button"></p>', $theme['admin']['preview_button']);
			$preview .= '</form>';
			$preview = box($theme['admin']['form']['preview'], $preview, 'center', '100%', 'center');
			$elements = '<table cellspacing="2" cellpaddin="2" border="0" align="center" width="100%">';
			$elements .= sprintf('<tr><td class="report_row_title report_row_border" width="60" align="center">%s</td><td class="report_row_title report_row_border" width="*" align="center">%s</td><td class="report_row_title report_row_border" width="*" align="center">%s</td><td class="report_row_title report_row_border" width="*" align="center">%s</td><td></td>', $theme['admin']['report']['titles']['order'], $theme['admin']['report']['titles']['title'], $theme['admin']['report']['titles']['name'], $theme['admin']['report']['titles']['type']);
			$result = $db->query(sprintf('SELECT id, ord, title, name, type FROM %s WHERE form_id = %s ORDER BY ord ASC', $config['mysql_form_elements_table'], $_GET['id']));
			$i = 0;
			foreach ($result as $row => $column)
			{
				$elements .= sprintf('<tr><td class="%s report_row_border" width="60" align="right">%s</td><td class="%s report_row_border" width="*" align="left">%s</td><td class="%s report_row_border" width="*" align="left">%s</td><td class="%s report_row_border" width="*" align="left">%s</td><td class="%s report_row_border" width="40">', set_report_row_style($i), $column[1], set_report_row_style($i), $column[2], set_report_row_style($i), $column[3], set_report_row_style($i), $theme['admin']['form']['elements'][$column[4]], set_report_row_style($i));
				$elements .= sprintf('<table cellspacing="1" cellpadding="0"><tr><td><a href="index.php?module=element&id=%s"><img src="%s/images/%s" alt="%s" border="0"></a></td><td><a href="javascript: if (confirm(\'%s\')) window.location.href=\'index.php?module=elements&option=delete&form=%s&id=%s\'"><img src="%s/images/%s" alt="%s" border="0"></a></td></tr></table></td>', $column[0], $config['url'], $theme['admin']['report']['options']['modify_image'], $theme['admin']['report']['options']['modify_alt'], $theme['admin']['report']['options']['delete_confirm'], $_GET['id'], $column[0], $config['url'], $theme['admin']['report']['options']['delete_image'], $theme['admin']['report']['options']['delete_alt']);
				$i++;
			}
			$elements .= '</table>';
			$elements = box($theme['admin']['form']['element']['list'], $elements, 'center', '100%', 'center');
			$new_element = sprintf('<form action="index.php" method="post" enctype="multipart/form-data" onSubmit="return new_form_element(this, \'%s\')">', $theme['javascript']['admin_error']);
			$new_element .= '<input type="hidden" name="module" value="elements">';
			$new_element .= '<input type="hidden" name="option" value="insert">';
			$new_element .= sprintf('<input type="hidden" name="form_id" value="%s">', $_GET['id']);
			$new_element .= '<table cellspacing="2" cellpadding="3" border="0" align="center">';
			$new_element .= '<tr>';
			$new_element .= sprintf('<td class="form_title">%s</td>', $theme['admin']['form']['element']['order']);
			$new_element .= sprintf('<td class="form_content"><input type="text" name="ord" size="5" maxlength="3" value="%s" class="form_content"></td>', sizeof($result) + 1);
			$new_element .= '</tr>';
			$new_element .= '<tr>';
			$new_element .= sprintf('<td class="form_title">%s</td>', $theme['admin']['form']['element']['title']);
			$new_element .= '<td class="form_content"><input type="text" name="title" size="40" maxlength="50" value="" class="form_content"></td>';
			$new_element .= '</tr>';
			$new_element .= '<tr>';
			$new_element .= sprintf('<td class="form_title">%s</td>', $theme['admin']['form']['element']['name']);
			$new_element .= '<td class="form_content"><input type="text" name="name" size="30" maxlength="50" value="" class="form_content"></td>';
			$new_element .= '</tr>';
			$new_element .= '<tr>';
			$new_element .= sprintf('<td class="form_title">%s</td>', $theme['admin']['form']['element']['type']);
			$options = null;
			foreach (array_keys($theme['admin']['form']['elements']) as $key)
			{
				$options .= sprintf('<option value="%s">%s</option>', $key, $theme['admin']['form']['elements'][$key]);
			}
			$new_element .= sprintf('<td class="form_content"><select name="type" class="form_content">%s</select></td>', $options);
			$new_element .= '</tr>';
			$new_element .= '<tr>';
			$new_element .= sprintf('<td class="form_title">%s</td>', $theme['admin']['form']['element']['flags']);
			$new_element .= '<td class="form_content"><textarea name="flags" cols="50" rows="8" class="form_content"></textarea></td></td>';
			$new_element .= '</tr>';
			$new_element .= '</table>';
			$new_element .= sprintf('<p align="center"><input type="submit" value="%s" class="form_button"> <input type="reset" value="%s" class="form_button"></p>', $theme['admin']['submit_button'], $theme['admin']['reset_button']);
			$new_element .= '</form>';
			$new_element = box($theme['admin']['form']['element']['new'], $new_element, 'center', '50%', 'center');
			$html = $style;
			$html .= '<script language="javascript1.2" src="library/admin.js"></script></title>';
			$html .= '<table cellspacing="4" cellpaddin="4" border="0" align="center" width="100%">';
			$html .= sprintf('<tr><td height="50" valign="top">%s</td></tr>', $header);
			$html .= '<tr>';
			$html .= sprintf('<td valign="top">&nbsp;&nbsp;<input type="button" value="%s" class="form_button" onClick="document.location.href=\'index.php?module=home\'"></td>', $theme['admin']['home_button']);
			$html .= '</tr>';
			$html .= '<tr><td>&nbsp;</td></tr>';
			$html .= '<tr>';
			$html .= '<td valign="top">';
			$html .= '<table cellspacing="4" cellpaddin="4" width="100%">';
			$html .= '<tr>';
			$html .= sprintf('<td valign="top">%s</td>', $form);
			$html .= sprintf('<td valign="top">%s</td>', $preview);
			$html .= '</tr>';
			$html .= '</table>';
			$html .= '</td>';
			$html .= '</tr>';
			$html .= '<tr><td>&nbsp;</td></tr>';
			$html .= '<tr>';
			$html .= '<td valign="top">';
			$html .= '<table cellspacing="4" cellpaddin="4" width="100%">';
			$html .= sprintf('<tr><td valign="top">%s</td></tr>', $elements);
			$html .= '</table>';
			$html .= '</td>';
			$html .= '</tr>';
			$html .= '<tr><td>&nbsp;</td></tr>';
			$html .= '<tr>';
			$html .= '<td valign="top">';
			$html .= '<table cellspacing="4" cellpaddin="4" width="100%">';
			$html .= sprintf('<tr><td valign="top">%s</td></tr>', $new_element);
			$html .= '</table>';
			$html .= '</td>';
			$html .= '</tr>';
			$html .= '</table>';
			html($theme['form_class'], $html);
		break;
		case 'forms':
			switch ($option)
			{
				case 'insert':
					$db->command(sprintf('INSERT INTO %s (name) VALUES ("%s")', $config['mysql_forms_table'], $_POST['name']));
					header('location: index.php?module=home');
				break;
				case 'update':
					$db->command(sprintf('UPDATE %s SET name = "%s" WHERE id = %s', $config['mysql_forms_table'], $_POST['name'], $_POST['id']));
					header(sprintf('location: index.php?module=form&id=%s', $_POST['id']));
				break;
				case 'delete':
					$db->command(sprintf('DELETE FROM %s WHERE id = %s LIMIT 1', $config['mysql_forms_table'], $_GET['id']));
					$db->command(sprintf('DELETE FROM %s WHERE form_id = %s', $config['mysql_form_elements_table'], $_GET['id']));
					header('location: index.php?module=home');
				break;
			}
		break;
		case 'element':
			$result = $db->query(sprintf('SELECT form_id, ord, title, name, type, flags FROM %s WHERE id = %s LIMIT 1', $config['mysql_form_elements_table'], $_GET['id']));
			$element = sprintf('<form action="index.php" method="post" enctype="multipart/form-data" onSubmit="return modify_form_element(this, \'%s\')">', $theme['javascript']['admin_error']);
			$element .= '<input type="hidden" name="module" value="elements">';
			$element .= '<input type="hidden" name="option" value="update">';
			$element .= sprintf('<input type="hidden" name="form" value="%s">', (isset($result[0][0]) ? $result[0][0] : null));
			$element .= sprintf('<input type="hidden" name="id" value="%s">', $_GET['id']);
			$element .= '<table cellspacing="2" cellpadding="3" border="0" align="center">';
			$element .= '<tr>';
			$element .= sprintf('<td class="form_title">%s</td>', $theme['admin']['form']['element']['order']);
			$element .= sprintf('<td class="form_content"><input type="text" name="ord" size="5" maxlength="3" value="%s" class="form_content"></td>', (isset($result[0][1]) ? $result[0][1] : null));
			$element .= '</tr>';
			$element .= '<tr>';
			$element .= sprintf('<td class="form_title">%s</td>', $theme['admin']['form']['element']['title']);
			$element .= sprintf('<td class="form_content"><input type="text" name="title" size="40" maxlength="50" value="%s" class="form_content"></td>', (isset($result[0][2]) ? $result[0][2] : null));
			$element .= '</tr>';
			$element .= '<tr>';
			$element .= sprintf('<td class="form_title">%s</td>', $theme['admin']['form']['element']['name']);
			$element .= sprintf('<td class="form_content"><input type="text" name="name" size="30" maxlength="50" value="%s" class="form_content"></td>', (isset($result[0][3]) ? $result[0][3] : null));
			$element .= '</tr>';
			$element .= '<tr>';
			$element .= sprintf('<td class="form_title">%s</td>', $theme['admin']['form']['element']['type']);
			$options = null;
			$type = isset($result[0][4]) ? $result[0][4] : null;
			foreach (array_keys($theme['admin']['form']['elements']) as $key)
			{
				$selected = $type == $key ? ' selected' : null;
				$options .= sprintf('<option value="%s"%s>%s</option>', $key, $selected, $theme['admin']['form']['elements'][$key]);
			}
			$element .= sprintf('<td class="form_content"><select name="type" class="form_content">%s</select></td>', $options);
			$element .= '</tr>';
			$element .= '<tr>';
			$element .= sprintf('<td class="form_title">%s</td>', $theme['admin']['form']['element']['flags']);
			$element .= sprintf('<td class="form_content"><textarea name="flags" cols="50" rows="8" class="form_content">%s</textarea></td></td>', (isset($result[0][5]) ? $result[0][5] : null));
			$element .= '</tr>';
			$element .= '</table>';
			$element .= sprintf('<p align="center"><input type="submit" value="%s" class="form_button"> <input type="reset" value="%s" class="form_button"></p>', $theme['admin']['submit_button'], $theme['admin']['reset_button']);
			$element .= '</form>';
			$element = box($theme['admin']['form']['element']['modify'], $element, 'center', '50%', 'center');
			$html = $style;
			$html .= '<script language="javascript1.2" src="library/admin.js"></script></title>';
			$html .= '<table cellspacing="4" cellpaddin="4" border="0" align="center" width="100%">';
			$html .= sprintf('<tr><td height="50" colspan="2" valign="top">%s</td></tr>', $header);
			$html .= '<tr>';
			$html .= sprintf('<td valign="top">%s</td>', $element);
			$html .= '</tr>';
			$html .= '</table>';
			html($theme['form_class'], $html);
		break;
		case 'elements':
			switch ($option)
			{
				case 'insert':
					$db->command(sprintf('INSERT INTO %s (form_id, ord, name, title, type, flags) VALUES (%s, %s, "%s", "%s", "%s", "%s")', $config['mysql_form_elements_table'], $_POST['form_id'], $_POST['ord'], $_POST['name'], $_POST['title'], $_POST['type'], mysql_escape_string($_POST['flags'])));
					header(sprintf('location: index.php?module=form&id=%s', $_POST['form_id']));
				break;
				case 'update':
					$db->command(sprintf('UPDATE %s SET ord = %s, name = "%s", title = "%s", type = "%s", flags = "%s" WHERE id = %s', $config['mysql_form_elements_table'], $_POST['ord'], $_POST['name'], $_POST['title'], $_POST['type'], mysql_escape_string($_POST['flags']), $_POST['id']));
					header(sprintf('location: index.php?module=form&id=%s', $_POST['form']));
				break;
				case 'delete':
					$db->command(sprintf('DELETE FROM %s WHERE id = %s LIMIT 1', $config['mysql_form_elements_table'], $_GET['id']));
					header(sprintf('location: index.php?module=form&id=%s', $_GET['form']));
				break;
			}
		break;
		case 'query':
			$result = $db->query(sprintf('SELECT name, db, query FROM %s WHERE id = %s LIMIT 1', $config['mysql_queries_table'], $_GET['id']));
			$query = sprintf('<form action="index.php" method="post" enctype="multipart/form-data" onSubmit="return modify_query(this, \'%s\')">', $theme['javascript']['admin_error']);
			$query .= '<input type="hidden" name="module" value="queries">';
			$query .= '<input type="hidden" name="option" value="update">';
			$query .= sprintf('<input type="hidden" name="id" value="%s">', $_GET['id']);
			$query .= '<table cellspacing="2" cellpadding="3" border="0" align="center">';
			$query .= '<tr>';
			$query .= sprintf('<td class="form_title">%s</td>', $theme['admin']['query']['id']);
			$query .= sprintf('<td class="form_content"><b>%s</b></td>', $_GET['id']);
			$query .= '</tr>';
			$query .= '<tr>';
			$query .= sprintf('<td class="form_title">%s</td>', $theme['admin']['query']['name']);
			$query .= sprintf('<td class="form_content"><input type="text" name="name" size="35" maxlength="50" value="%s" class="form_content"></td>', (isset($result[0][0]) ? $result[0][0] : null));
			$query .= '</tr>';
			$query .= '<tr>';
			$query .= sprintf('<td class="form_title">%s</td>', $theme['admin']['query']['db']);
			$query .= sprintf('<td class="form_content"><input type="text" name="db" size="25" maxlength="50" value="%s" class="form_content"></td>', (isset($result[0][1]) ? $result[0][1] : null));
			$query .= '</tr>';
			$query .= '<tr>';
			$query .= sprintf('<td class="form_title">%s</td>', $theme['admin']['query']['string']);
			$query .= sprintf('<td class="form_content"><textarea name="query" cols="50" rows="15" class="form_content">%s</textarea></td>', (isset($result[0][2]) ? $result[0][2] : null));
			$query .= '</tr>';
			$query .= '</table>';
			$query .= sprintf('<p align="center"><input type="submit" value="%s" class="form_button"> <input type="reset" value="%s" class="form_button"></p>', $theme['admin']['submit_button'], $theme['admin']['reset_button']);
			$query .= '</form>';
			$query = box($theme['admin']['query']['modify'], $query, 'center', '50%', 'center');
			$html = $style;
			$html .= '<script language="javascript1.2" src="library/admin.js"></script></title>';
			$html .= '<table cellspacing="4" cellpaddin="4" border="0" align="center" width="100%">';
			$html .= sprintf('<tr><td height="50" colspan="2" valign="top">%s</td></tr>', $header);
			$html .= '<tr>';
			$html .= sprintf('<td valign="top">%s</td>', $query);
			$html .= '</tr>';
			$html .= '</table>';
			html($theme['form_class'], $html);
		break;
		case 'queries':
			switch ($option)
			{
				case 'insert':
					$db->command(sprintf('INSERT INTO %s (name) VALUES ("%s")', $config['mysql_queries_table'], $_POST['name']));
					header('location: index.php?module=home');
				break;
				case 'update':
					$db->command(sprintf('UPDATE %s SET name = "%s", db = "%s", query = "%s" WHERE id = %s', $config['mysql_queries_table'], $_POST['name'], $_POST['db'], mysql_escape_string($_POST['query']), $_POST['id']));
					header('location: index.php?module=home');
				break;
				case 'delete':
					$db->command(sprintf('DELETE FROM %s WHERE id = %s LIMIT 1', $config['mysql_queries_table'], $_GET['id']));
					header('location: index.php?module=home');
				break;
			}
		break;
		case 'preview':
			$form = new form();
			$form->id = isset($_GET['form']) ? $_GET['form'] : 0;
			$form->query = isset($_GET['query']) ? $_GET['query'] : 0;
			$form->query_params = isset($_GET['params']) ? $_GET['params'] : null;
			$form->preview = 1;
			$html = box($theme['admin']['form']['preview'], $form->html(), 'center', '100%', 'center');
			html($theme['form_class'], $html);
		break;
		case 'error':
			$error = box($theme['errors']['title'], base64_decode($option), 'left', '75%', 'center');
			$html = $style;
			$html .= '<table cellspacing="4" cellpaddin="4" border="0" align="center" width="100%">';
			$html .= sprintf('<tr><td height="50" colspan="2" valign="top">%s</td></tr>', $header);
			$html .= sprintf('<tr><td valign="top">%s</td></tr>', $error);
			$html .= '</table>';
			html($theme['form_class'], $html);
		break;
	}
}

?>