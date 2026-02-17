<?php

/*
 * The form object to create a form
 *
 */

class form
{
	function get_items($flags, $params, $value, $position)
	{
		global $config, $theme, $db;
		
		$manual_items = array();
		$query_items = array();
		foreach ($flags as $flag)
		{
			if (preg_match(sprintf('/^(\s*?)((%s)(\s*?)(\(.*?\)))(\s*?);/', 'add_item'), $flag))
			{
				$values = get_multiflag_values(array($flag), 'add_item', 3);
				$values[2] = (int)$values[2];
				$manual_items[] = $values;
			}
		}
		if (is_flag($flags, 'sql_query'))
		{
			list($query_id, $selected_index) = get_multiflag_values($flags, 'sql_query', 2);
			$result = $db->query(sprintf('SELECT db, query FROM %s WHERE id = %s LIMIT 1', $config['mysql_queries_table'], $query_id));
			if (!sizeof($result))
			{
				header(sprintf('location: %s/index.php?action=error&error=%s', $this->url, base64_encode(sprintf($theme['errors']['form']['query_error'], $query_id))));;
				exit();
			}
			$db->db =  $result[0][0];
			$query_result = $db->query(set_query_params($result[0][1], $params));
			for ($i = 0; $i < sizeof($query_result); $i++)
			{
				$values = array();
				$values[] = $query_result[$i][0];
				$values[] = $query_result[$i][1];
				$values[] = $i == $selected_index ? 1 : 0;
				$query_items[] = $values;
			}
		}
		$items = $position ? array_merge($manual_items, $query_items) : array_merge($query_items, $manual_items);
		if (!is_null($this->query_db) && !is_null($this->query_string) && is_flag($flags, 'sql_query_compare'))
		{
			$db->db = $config['mysql_db'];
			$result = $db->query(sprintf('SELECT db, query FROM %s WHERE id = %s LIMIT 1', $config['mysql_queries_table'], (int)get_flag_value($flags, 'sql_query_compare')));
			if (!sizeof($result))
			{
				header(sprintf('location: %s/index.php?action=error&error=%s', $this->url, base64_encode(sprintf($theme['errors']['form']['query_error'], (int)get_flag_value($flags, 'sql_query_compare')))));
				exit();
			}
			for ($i = 0; $i < sizeof($items); $i++)
			{
				$db->db = $result[0][0];
				$query_result = $db->query(set_query_params($result[0][1], $params));
				$query_result = str_replace(':itt', $items[$i][0], $query_result);
				$query_result = str_replace(':itv', $items[$i][1], $query_result);
				$items[$i][2] = sizeof($query_result) ? 1 : 0;
			}
		}
		else if (!is_null($this->query_db) && !is_null($this->query_string))
		{
			for ($i = 0; $i < sizeof($items); $i++)
			{
				$items[$i][2] = $items[$i][1] == $value ? 1 : 0;
			}
		}
		return $items;
	}

	function get_query_value($query_index)
	{
		return isset($this->query_values[$query_index]) ? $this->query_values[$query_index] : null;
	}

	function get_query_values()
	{
		global $config, $theme, $db;
		
		$db->db = $this->query_db;
		$result = $db->query($this->query_string);
		if (sizeof($result) > 1)
		{
			header(sprintf('location: %s/index.php?action=error&error=%s', $this->url, base64_encode(sprintf($theme['errors']['form']['query_result_error'], $this->query_db, $this->query_string))));
			exit();
		}
		$query_values = array();
		foreach ($result as $row => $column)
		{
			for ($i = 0; $i < $db->fields_number($this->query_string); $i++)
			{
				$query_values[] = $column[$i];
			}
		}
		$db->db = $config['mysql_db'];
		return $query_values;
	}

	function form()
	{
		global $config;
		
		$this->id = 0;
		$this->name = null;
		$this->action = null;
		$this->method = 'post';
		$this->enctype = 'multipart/form-data';
		$this->target = '_self';
		$this->module = null;
		$this->option = null;
		$this->query = 0;
		$this->query_db = null;
		$this->query_string = null;
		$this->query_params = null;
		$this->query_values = array();
		$this->date_format = $config['date_format'];
		$this->date_separator = $config['date_separator'];
		$this->url = $config['url'];
		$this->preview = 0;
	}

	function html()
	{
		global $config, $theme, $db;

		$result = $db->query(sprintf('SELECT name FROM %s WHERE id = %s LIMIT 1', $config['mysql_forms_table'], $this->id));
		if (!sizeof($result))
		{
			header(sprintf('location: %s/index.php?action=error&error=%s', $this->url, base64_encode(sprintf($theme['errors']['form']['form_error'], $this->id))));
			exit();
		}
		foreach ($result as $row => $column)
		{
			$this->name = $column[0];
		}
		
		if ($this->query)
		{
			$result = $db->query(sprintf('SELECT db, query FROM %s WHERE id = %s LIMIT 1', $config['mysql_queries_table'], $this->query));
			if (!sizeof($result))
			{
				header(sprintf('location: %s/index.php?action=error&error=%s', $this->url, base64_encode(sprintf($theme['errors']['form']['query_error'], $this->query))));;
				exit();
			}
			foreach ($result as $row => $column)
			{
				$this->query_db = $column[0];
				$this->query_string = set_query_params($column[1], $this->query_params);
			}
		}
		
		if (!is_null($this->query_db) && !is_null($this->query_string))
		{
			$this->query_values = $this->get_query_values();
		}

		$result = $db->query(sprintf('SELECT title, name, type, flags FROM %s WHERE form_id = %s ORDER BY ord ASC', $config['mysql_form_elements_table'], $this->id));
		$current_query_index = 0;
		$html = '<style type="text/css">';
		foreach (array_keys($theme['styles']['form']) as $key)
		{
			$html .= '.form_' . $key . ' { ' . $theme['styles']['form'][$key] . ' }';
		}
		$html .= '</style>';
		$html .= '<table cellspacing="2" cellpadding="4" border="0">';
		$javascript = sprintf('if (!document.forms["%s"]) { alert("%s"); false }', $this->name, $theme['javascript']['form']['form_error']);
		foreach ($result as $row => $column)
		{
			$title = $column[0];
			$name = $column[1];
			$type = $column[2];
			$flags = set_flags($column[3]);
			$value = (is_null($this->query_db) && is_null($this->query_string)) ? get_flag_value($flags, 'value') : (is_flag($flags, 'sql_query_jump') ? null : $this->get_query_value($current_query_index));

			switch ($type)
			{
				case 'plain_text':
					$html .= '<tr>';
					$html .= sprintf('<td class="form_title">%s</td>', $title);
					$open_style = is_flag($flags, 'bold') ? '<b>' : null;
					$open_style .= is_flag($flags, 'italic') ? '<i>' : null;
					$open_style .= is_flag($flags, 'underline') ? '<u>' : null;
					$close_style = is_flag($flags, 'underline') ? '</u>' : null;
					$close_style .= is_flag($flags, 'italic') ? '</i>' : null;
					$close_style .= is_flag($flags, 'bold') ? '</b>' : null;
					$html .= sprintf('<td class="form_content"><input type="hidden" name="%s" value="%s">%s%s%s</td>', $name, $value, $open_style, $value, $close_style);
					$html .= '</tr>';
				break;
				case 'text_box':
					$html .= '<tr>';
					$html .= sprintf('<td class="form_title">%s%s</td>', $title, (is_flag($flags, 'not_null') ? ' <b>*</b>' : null));
					$html .= sprintf('<td class="form_content"><input type="text" name="%s" value="%s" maxlength="%s" size="%s" class="form_content"></td>', $name, $value, get_flag_value($flags, 'max_length'), get_flag_value($flags, 'size'));
					$html .= '</tr>';
					$javascript .= is_flag($flags, 'not_null') ? sprintf(' else if (is_null(document.forms["%s"].elements["%s"].value)) { alert("%s"); false }', $this->name, $name, sprintf($theme['javascript']['form']['null_error'], $title)) : null;
					if (is_flag($flags, 'int'))
					{
						$javascript .= !is_flag($flags, 'unsigned') ? sprintf(' else if (!is_int(document.forms["%s"].elements["%s"].value)) { alert("%s"); false }', $this->name, $name, sprintf($theme['javascript']['form']['integer_error'], $title)) : null;
						$javascript .= is_flag($flags, 'unsigned') ? sprintf(' else if (!is_uint(document.forms["%s"].elements["%s"].value)) { alert("%s"); false }', $this->name, $name, sprintf($theme['javascript']['form']['integer_unsigned_error'], $title)) : null;
					}
					else if (is_flag($flags, 'number'))
					{
						$javascript .= !is_flag($flags, 'unsigned') ? sprintf(' else if (!is_num(document.forms["%s"].elements["%s"].value)) { alert("%s"); false }', $this->name, $name, sprintf($theme['javascript']['form']['number_error'], $title)) : null;
						$javascript .= is_flag($flags, 'unsigned') ? sprintf(' else if (!is_unum(document.forms["%s"].elements["%s"].value)) { alert("%s"); false }', $this->name, $name, sprintf($theme['javascript']['form']['number_unsigned_error'], $title)) : null;
					}
					else if (is_flag($flags, 'alpha'))
					{
						$javascript .= sprintf(' else if (!is_alpha(document.forms["%s"].elements["%s"].value)) { alert("%s"); false }', $this->name, $name, sprintf($theme['javascript']['form']['alpha_error'], $title));
					}
					else if (is_flag($flags, 'alphanum'))
					{
						$javascript .= sprintf(' else if (!is_alphanum(document.forms["%s"].elements["%s"].value)) { alert("%s"); false }', $this->name, $name, sprintf($theme['javascript']['form']['alphanum_error'], $title));
					}
					else if (is_flag($flags, 'email'))
					{
						$javascript .= sprintf(' else if (!is_email(document.forms["%s"].elements["%s"].value)) { alert("%s"); false }', $this->name, $name, sprintf($theme['javascript']['form']['email_error'], $title));
					}
					else if (is_flag($flags, 'url'))
					{
						$javascript .= sprintf(' else if (!is_url(document.forms["%s"].elements["%s"].value)) { alert("%s"); false }', $this->name, $name, sprintf($theme['javascript']['form']['url_error'], $title));
					}
				break;
				case 'password_box':
					$html .= '<tr>';
					$html .= sprintf('<td class="form_title">%s%s</td>', $title, (is_flag($flags, 'not_null') ? ' <b>*</b>' : null));
					$html .= sprintf('<td class="form_content"><input type="password" name="%s" value="%s" maxlength="%s" size="%s" class="form_content"></td>', $name, $value, get_flag_value($flags, 'max_length'), get_flag_value($flags, 'size'));
					$html .= '</tr>';
					$javascript .= is_flag($flags, 'not_null') ? sprintf(' else if (is_null(document.forms["%s"].elements["%s"].value)) { alert("%s"); false }', $this->name, $name, sprintf($theme['javascript']['form']['null_error'], $title)) : null;
					if (is_flag($flags, 'int'))
					{
						$javascript .= sprintf(' else if (!is_uint(document.forms["%s"].elements["%s"].value)) { alert("%s"); false }', $this->name, $name, sprintf($theme['javascript']['form']['integer_unsigned_error'], $title));
					}
					else if (is_flag($flags, 'alpha'))
					{
						$javascript .= sprintf(' else if (!is_alpha(document.forms["%s"].elements["%s"].value)) { alert("%s"); false }', $this->name, $name, sprintf($theme['javascript']['form']['alpha_error'], $title));
					}
					else if (is_flag($flags, 'alphanum'))
					{
						$javascript .= sprintf(' else if (!is_alphanum(document.forms["%s"].elements["%s"].value)) { alert("%s"); false }', $this->name, $name, sprintf($theme['javascript']['form']['alphanum_error'], $title));
					}
					$javascript .= is_flag($flags, 'pwd_compare') ? sprintf(' else if (document.forms["%s"].elements["%s"].value != document.forms["%s"].elements["%s"].value) { alert("%s"); false }', $this->name, $name, $this->name, get_flag_value($flags, 'pwd_compare'), $theme['javascript']['form']['password_error']) : null;
				break;
				case 'search_box':
					$html .= '<tr>';
					$html .= sprintf('<td class="form_title">%s%s</td>', $title, (is_flag($flags, 'not_null') ? ' <b>*</b>' : null));
					$html .= sprintf('<td class="form_content"><table cellspacing="0" cellpadding="0"><tr><td><input type="text" name="%s" value="%s" size="%s" class="form_content" readonly></td><td style="padding-left: 2px"><a href="javascript: searcher(\'%s\', \'%s\', \'%s\')"><img src="%s/images/%s" border="0" alt="%s"></a></td><td style="padding-left: 2px"><a href="javascript: searcher_default(\'%s\', \'%s\', \'%s\')"><img src="%s/images/%s" border="0" alt="%s"></a></td></tr></table></td>', $name, $value, get_flag_value($flags, 'size'), get_flag_value($flags, 'search_url'), $this->name, $name, $this->url, $theme['form']['searcher_image'], $theme['form']['searcher_alt'], $this->name, $name, $value, $this->url, $theme['form']['searcher_default_image'], $theme['form']['searcher_default_alt']);
					$html .= '</tr>';
					$javascript .= is_flag($flags, 'not_null') ? sprintf(' else if (is_null(document.forms["%s"].elements["%s"].value)) { alert("%s"); false }', $this->name, $name, sprintf($theme['javascript']['form']['null_error'], $title)) : null;
				break;
				case 'date_box':
					$html .= '<tr>';
					$html .= sprintf('<td class="form_title">%s%s</td>', $title, (is_flag($flags, 'not_null') ? ' <b>*</b>' : null));
					$html .= sprintf('<td class="form_content"><table cellspacing="0" cellpadding="0"><tr><td><input type="text" name="%s" value="%s" maxlength="10" size="10" class="form_content"></td><td style="padding-left: 2px"><a id="%s_image" href="javascript: calendar.show(\'%s\', \'%s\', \'%s_image\', \'date\')"><img src="%s/images/%s" border="0" alt="%s"></a></td></tr></table></td>', $name, set_date($value, $this->date_format, $this->date_separator), $name, $this->name, $name, $name, $this->url, $theme['form']['datetime_picker_image'], $theme['form']['datetime_picker_alt']);
					$html .= '</tr>';
					$javascript .= sprintf(' else if (!is_date(document.forms["%s"].elements["%s"].value, "%s", "%s")) { alert("%s"); false }', $this->name, $name, $this->date_format, $this->date_separator, sprintf($theme['javascript']['form']['date_error'], $title));
				break;
				case 'time_box':
					$html .= '<tr>';
					$html .= sprintf('<td class="form_title">%s%s</td>', $title, (is_flag($flags, 'not_null') ? ' <b>*</b>' : null));
					$html .= sprintf('<td class="form_content"><table cellspacing="0" cellpadding="0"><tr><td><input type="text" name="%s" value="%s" maxlength="8" size="8" class="form_content"></td><td style="padding-left: 2px"><a href="javascript: calendar.push_time(\'%s\', \'%s\')"><img src="%s/images/%s" border="0" alt="%s"></a></td></tr></table></td>', $name, set_time($value), $this->name, $name, $this->url, $theme['form']['time_picker_image'], $theme['form']['time_picker_alt']);
					$html .= '</tr>';
					$javascript .= sprintf(' else if (!is_time(document.forms["%s"].elements["%s"].value)) { alert("%s"); false }', $this->name, $name, sprintf($theme['javascript']['form']['time_error'], $title));
				break;
				case 'datetime_box':
					$html .= '<tr>';
					$html .= sprintf('<td class="form_title">%s%s</td>', $title, (is_flag($flags, 'not_null') ? ' <b>*</b>' : null));
					$html .= sprintf('<td class="form_content"><table cellspacing="0" cellpadding="0"><tr><td><input type="text" name="%s" value="%s" maxlength="19" size="19" class="form_content"></td><td style="padding-left: 2px"><a id="%s_image" href="javascript: calendar.show(\'%s\', \'%s\', \'%s_image\', \'datetime\')"><img src="%s/images/%s" border="0" alt="%s"></a></td></tr></table></td>', $name, set_datetime($value, $this->date_format, $this->date_separator), $name, $this->name, $name, $name, $this->url, $theme['form']['datetime_picker_image'], $theme['form']['datetime_picker_alt']);
					$html .= '</tr>';
					$javascript .= sprintf(' else if (!is_datetime(document.forms["%s"].elements["%s"].value, "%s", "%s")) { alert("%s"); false }', $this->name, $name, $this->date_format, $this->date_separator, sprintf($theme['javascript']['form']['datetime_error'], $title));
				break;
				case 'check_box':
					$html .= '<tr>';
					$html .= sprintf('<td class="form_title">&nbsp;</td>');
					$html .= sprintf('<td class="form_content"><table cellspacing="0" cellpadding="0"><tr><td><input type="checkbox" name="%s" id="%s"%s></td><td><label for="%s" class="form_content">%s%s</label></td></tr></table></td>', $name, $name, ((int)$value ? ' checked' : (is_null($this->query_db) && is_null($this->query_string) && is_flag($flags, 'checked') ? ' checked' : null)), $name, $title, (is_flag($flags, 'not_null') ? ' <b>*</b>' : null));
					$html .= '</tr>';
					$javascript .= is_flag($flags, 'not_null') ? sprintf(' else if (!document.forms["%s"].elements["%s"].checked) { alert("%s"); false }', $this->name, $name, sprintf($theme['javascript']['form']['check_box_error'], $title)) : null;
				break;
				case 'radio_buttons':
					$items = $this->get_items($flags, $this->query_params, $value, (!is_flag($flags, 'show_query_first') ? true : false));
					$radio_buttons = '<table cellspacing="0" cellpadding="0">';
					$radio_buttons .= is_flag($flags, 'in_line') ? '<tr>' : null;
					$i = 0;
					foreach ($items as $item)
					{
						$radio_buttons .= sprintf('%s<td><input type="radio" name="%s" id="%s" value="%s" class="form_content"%s></td><td><label for="%s" class="form_content">%s</label></td>%s', (!is_flag($flags, 'in_line') ? '<tr>' : null), $name, $name . $i, $item[1], ($item[2] ? ' checked' : null), $name . $i, (is_flag($flags, 'show_values') ? $item[1] . get_flag_value($flags, 'show_values') : null) . $item[0], (!is_flag($flags, 'in_line') ? '</tr>' : null));
						$i++;
					}
					$radio_buttons .= is_flag($flags, 'in_line') ? '</tr>' : null;
					$radio_buttons .= '</table>';
					$html .= '<tr>';
					$html .= sprintf('<td class="form_title">%s%s</td>', $title, (is_flag($flags, 'not_null') ? ' <b>*</b>' : null));
					$html .= sprintf('<td class="form_content">%s</td>', $radio_buttons);
					$html .= '</tr>';
					$javascript .= is_flag($flags, 'not_null') ? sprintf(' else if (!check_radios("%s", "%s")) { alert("%s"); false }', $this->name, $name, sprintf($theme['javascript']['form']['radio_buttons_error'], $title)) : null;
				break;
				case 'combo_box':
					$items = $this->get_items($flags, $this->query_params, $value, (!is_flag($flags, 'show_query_first') ? true : false));
					$options = null;
					foreach ($items as $item)
					{
						$options .= sprintf('<option value="%s"%s>%s</option>', $item[1], ($item[2] ? ' selected' : null), (is_flag($flags, 'show_values') ? $item[1] . get_flag_value($flags, 'show_values') : null) . $item[0]);
					}
					$html .= '<tr>';
					$html .= sprintf('<td class="form_title">%s%s</td>', $title, (is_flag($flags, 'not_null') ? ' <b>*</b>' : null));
					$html .= sprintf('<td class="form_content"><select name="%s" class="form_content">%s</select></td>', $name, $options);
					$html .= '</tr>';
					$javascript .= is_flag($flags, 'not_null') ? sprintf(' else if (is_null(document.forms["%s"].elements["%s"].options[document.forms["%s"].elements["%s"].options.selectedIndex].value)) { alert("%s"); false }', $this->name, $name, $this->name, $name, sprintf($theme['javascript']['form']['combo_box_error'], $title)) : null;
				break;
				case 'list_box':
					$items = $this->get_items($flags, $this->query_params, $value, (!is_flag($flags, 'show_query_first') ? true : false));
					$options = null;
					foreach ($items as $item)
					{
						$options .= sprintf('<option value="%s"%s>%s</option>', $item[1], ($item[2] ? ' selected' : null), (is_flag($flags, 'show_values') ? $item[1] . get_flag_value($flags, 'show_values') : null) . $item[0]);
					}
					$buttons = sprintf('<table cellspacing="2" cellpadding="0" align="left"><tr><td><a href="javascript: select_items(\'%s\', \'%s\', true)"><img src="%s/images/%s" border="0" alt="%s"></a></td><td><a href="javascript: select_items(\'%s\', \'%s\', false)"><img src="%s/images/%s" border="0" alt="%s"></a></td></tr></table>', $this->name, $name, $this->url, $theme['form']['select_all_button_image'], $theme['form']['select_all_button_alt'], $this->name, $name, $this->url, $theme['form']['deselect_all_button_image'], $theme['form']['deselect_all_button_alt']);
					$html .= '<tr>';
					$html .= sprintf('<td class="form_title">%s%s</td>', $title, (is_flag($flags, 'not_null') ? ' <b>*</b>' : null));
					$html .= sprintf('<td class="form_content"><select name="%s" size="%s" class="form_content"%s>%s</select>%s</td>', $name . (is_flag($flags, 'multiselect') ? '[]' : null), ((int)get_flag_value($flags, 'rows') ? get_flag_value($flags, 'rows') : 4), (is_flag($flags, 'multiselect') ? ' multiple' : null), $options, (is_flag($flags, 'multiselect') ? $buttons : null));
					$html .= '</tr>';
					$javascript .= (is_flag($flags, 'not_null') && !is_flag($flags, 'multiselect')) ? sprintf(' else if (document.forms["%s"].elements["%s"].options.selectedIndex < 0) { alert("%s"); false }', $this->name, $name, sprintf($theme['javascript']['form']['list_box_error'], $title)) : null;
					$javascript .= (is_flag($flags, 'not_null') && is_flag($flags, 'multiselect')) ? sprintf(' else if (!check_list_box("%s", "%s")) { alert("%s"); false }', $this->name, $name, sprintf($theme['javascript']['form']['list_box_multiselect_error'], $title)) : null;
				break;
				case 'text_area':
					$html .= '<tr>';
					$html .= sprintf('<td class="form_title">%s%s</td>', $title, (is_flag($flags, 'not_null') ? ' <b>*</b>' : null));
					$html .= sprintf('<td class="form_content"><textarea name="%s" cols="%s" rows="%s" class="form_content">%s</textarea></td>', $name, get_flag_value($flags, 'cols'), get_flag_value($flags, 'rows'), $value);
					$html .= '</tr>';
					$javascript .= is_flag($flags, 'not_null') ? sprintf(' else if (is_null(document.forms["%s"].elements["%s"].value)) { alert("%s"); false }', $this->name, $name, sprintf($theme['javascript']['form']['null_error'], $title)) : null;
				break;
				case 'hidden_field':
					$html .= sprintf('<input type="hidden" name="%s" value="%s">', $name, $value);
				break;
				case 'file_box':
					$html .= '<tr>';
					$html .= sprintf('<td class="form_title">%s%s<br>%s</td>', $title, (is_flag($flags, 'not_null') ? ' <b>*</b>' : null), (is_flag($flags, 'show_max_size') ? sprintf($theme['form']['max_upload_size'], get_max_upload_size()) : null));
					$html .= sprintf('<td class="form_content"><input type="file" name="%s" size="%s" class="form_file"></td>', $name, get_flag_value($flags, 'size'));
					$html .= '</tr>';
					$javascript .= is_flag($flags, 'not_null') ? sprintf(' else if (is_null(document.forms["%s"].elements["%s"].value)) { alert("%s"); false }', $this->name, $name, sprintf($theme['javascript']['form']['null_error'], $title)) : null;
				break;
			}

			if (!is_flag($flags, 'sql_query_jump') && !is_flag($flags, 'sql_query_compare'))
			{
				$current_query_index++;
			}
		}
		$html .= sprintf('</table>');
		
		$form = sprintf('<form name="%s" action="%s" method="%s" enctype="%s" target="%s" onSubmit="return form_submit(error_message)">', $this->name, $this->action, $this->method, $this->enctype, $this->target);
		$form .= sprintf('<input type="hidden" name="module" value="%s">', $this->module);
		$form .= sprintf('<input type="hidden" name="option" value="%s">', $this->option);
		$form .= $html;
		$form .= sprintf('<p align="center"><input type="submit" value="%s" class="form_button"> <input type="reset" value="%s" class="form_button"></p>', $theme['form']['submit_button'], $theme['form']['reset_button']);
		$form .= sprintf('</form>');
		$form .= sprintf('<script language="javascript1.2">');
		$names = null;
		for($i = 0; $i < sizeof($theme['form']['datetime_picker_day_names']); $i++)
		{
			$names .= '\'' . $theme['form']['datetime_picker_day_names'][$i] . '\'';
			$names .= $i < sizeof($theme['form']['datetime_picker_day_names']) - 1 ? ', ' : null;
		}
		$form .= sprintf('var day_names = new Array(%s);', $names);
		$names = null;
		for($i = 0; $i < sizeof($theme['form']['datetime_picker_month_names']); $i++)
		{
			$names .= '\'' . $theme['form']['datetime_picker_month_names'][$i] . '\'';
			$names .= $i < sizeof($theme['form']['datetime_picker_month_names']) - 1 ? ', ' : null;
		}
		$form .= sprintf('var month_names = new Array(%s);', $names);
		$form .= sprintf('</script>');
		$form .= sprintf('<script language="javascript1.2" src="%s/library/form.js"></script>', $this->url);
		$form .= sprintf('<script language="javascript1.2">calendar = new datetime_picker(\'calendar\', \'%s\', \'%s\', \'%s/images/%s\', \'%s/images/%s\'); calendar.create();</script>', $this->date_format, $this->date_separator, $this->url, $theme['form']['datetime_picker_back_image'], $this->url, $theme['form']['datetime_picker_forward_image']);
		if ($this->preview)
		{
			$javascript .= sprintf(' else { alert("%s"); false }', $theme['javascript']['form']['preview_ok']);
		}
		$form .= sprintf('<script language="javascript1.2">var error_message = \'%s\';</script>', $javascript);
		$form .= sprintf('<p align="left" class="form_required"><small>(</small><b>*</b><small>)</small> <small>%s</small></p>', $theme['form']['required_field']);
		return $form;
	}
}

?>