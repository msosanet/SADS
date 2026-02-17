<?php

/*
 * The common functions library
 *
 */

function set_flags($flags)
{
	$result = array();
	while (preg_match('/^(\s*?)(([a-z_]*)(\s*?)(\(.*?\)))(\s*?);/', $flags, $regular))
	{
		$result[] = $regular[0];
		$flags = str_replace($regular[0], null, $flags);
	}
	return $result;
}

function is_flag($flags, $flag_name)
{
	foreach ($flags as $flag)
	{
		if (preg_match(sprintf('/^(\s*?)((%s)(\s*?)(\(.*?\)))(\s*?);/', $flag_name), $flag)) return true;
	}
	return false;
}

function get_flag($flags, $flag_name)
{
	$result = array();
	foreach ($flags as $flag)
	{
		if (preg_match(sprintf('/^(\s*?)((%s)(\s*?)(\(.*?\)))(\s*?);/', $flag_name), $flag))
		{
			preg_match('/\((\s*?)"(\s*?).*?(\s*?)"(\s*?)\)(\s*?)(?=;)/', $flag, $result);
		}
	}
	if (sizeof($result)) $result = trim(substr(trim($result[0]), 1, strlen(trim($result[0])) - 2)); else $result = null;
	return $result;
}

function parse_flag($flag)
{
	if (is_null($flag)) return array();
	$result = array();
	while (preg_match('/^(\s*?)"[\s\w\\ºª|@#€¡!·$%&\/\(\)\'¿?_,;:.\{\}\[\]\+\*=-]*"(\s*?),/', $flag, $regular))
	{
		$result[] = trim($regular[0]);
		$flag = trim(str_replace(trim($regular[0]), null, $flag));
	}
	$result[] = $flag;
	$flag = array();
	foreach ($result as $value)
	{
		preg_match('/^.*(?=,)/', $value, $values);
		$flag[] = isset($values[0]) ? trim(substr(trim($values[0]), 1, strlen(trim($values[0])) - 2)) : trim(substr(trim($value), 1, strlen(trim($value)) - 2));
	}
	return sizeof($flag) ? $flag : array();
}

function get_flag_value($flags, $flag_name)
{
	$result = parse_flag(get_flag($flags, $flag_name));
	return isset($result[0]) ? $result[0] : null;
}

function get_multiflag_values($flags, $flag_name, $flags_number)
{
	global $config, $theme;

	$result = parse_flag(get_flag($flags, $flag_name));
	if ($flags_number && sizeof($result) != $flags_number)
	{
		header(sprintf('location: %s/index.php?action=error&error=%s', $config['url'], base64_encode(sprintf($theme['errors']['form']['flag_error'], $flag_name))));
		exit();
	}
	return $result;
}

function set_query_params($query_string, $query_params)
{
	if (strpos($query_string, ':qp') && !is_null($query_params))
	{
		$query_params = split(',', $query_params);
		$current_param = 0;
		while (preg_match('/:qp\d+/', $query_string))
		{
			$query_string = str_replace(sprintf(':qp%s', $current_param), trim(isset($query_params[$current_param]) ? $query_params[$current_param] : null), $query_string);
			$current_param++;
		}
	}
	return $query_string;
}

function get_date($format, $separator)
{
	if ($format == 'ddmmyyyy') return date(sprintf('d%sm%sY', $separator, $separator));
	else return date(sprintf('Y%sm%sd', $separator, $separator));
}

function get_time()
{
	return date('H:i:s');
}

function get_datetime()
{
	return sprintf('%s %s', get_date(), get_time());
}

function set_date($date, $format, $separator)
{
	if (ereg('([0-9]{1,2})(/|-|.)([0-9]{1,2})(/|-|.)([0-9]{4})', $date, $regular))
	{
		$day = $regular[1];
		$month = $regular[3];
		$year = $regular[5];
	}
	else if (ereg('([0-9]{4})(/|-|.)([0-9]{1,2})(/|-|.)([0-9]{1,2})', $date, $regular))
	{
		$year = $regular[1];
		$month = $regular[3];
		$day = $regular[5];
	}
	else return get_date($format, $separator);

	if ($format == 'ddmmyyyy') return sprintf('%s%s%s%s%s', $day, $separator, $month, $separator, $year);
	else return sprintf('%s%s%s%s%s', $year, $separator, $month, $separator, $day);
}
	
function set_time($time)
{
	if (ereg('([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})', $time, $regular))
	{
		$hours = $regular[1];
		$minutes = $regular[2];
		$seconds = $regular[3];
		return sprintf('%s:%s:%s', $hours, $minutes, $seconds);
	}
	else return get_time();
}
	
function set_datetime($datetime, $format, $separator)
{
	return sprintf('%s %s', set_date($datetime, $format, $separator), set_time($datetime));
}

function get_max_upload_size()
{
	$size = ini_get('upload_max_filesize');
	$scan['MB'] = 1024;
	$scan['Mb'] = 1024;
	$scan['M'] = 1024;
	$scan['m'] = 1024;
	$scan['KB'] = 1;
	$scan['Kb'] = 1;
	$scan['K'] = 1;
	$scan['k'] = 1;
	while (list($key) = each($scan))
	{
		if ((strlen($size) > strlen($key)) && (substr($size, strlen($size) - strlen($key)) == $key))
		{
			$size = substr($size, 0, strlen($size) - strlen($key)) * $scan[$key];
			break;
		}
	}
	$result = array();
	while (preg_match('/\d{3}$/', $size, $regular))
	{
		$result[] = $regular[0];
		$size = str_replace($regular[0], null, $size);
	}
	$result[] = $size;
	return implode('.', array_reverse($result));
}

function set_report_row_style($row)
{
	return is_int($row / 2) ? 'report_row_pair' : 'report_row_non';
}

?>