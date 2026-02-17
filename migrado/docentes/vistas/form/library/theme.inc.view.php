<html>';
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
