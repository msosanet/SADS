<?php

/*
 * The login page for administration front-end
 *
 */

include ('./library/sylex.inc.php');
include ('./library/modules.inc.php');

if (isset($_GET['action']) && isset($_GET['login']) && isset($_GET['password']) && $_GET['action'] == 'login')
{
	if ($_GET['login'] == $config['oper_login'] && $_GET['password'] == $config['oper_password'])
	{
		$cookie->write($config['oper_cookie']);
		header('Location: index.php?module=home');
	}
	else header(sprintf('Location: index.php?login=%s', $_GET['login']));
}
else if (isset($_GET['action']) && $_GET['action'] == 'logout')
{
	$cookie->clear();
	header('Location: index.php');
}
else if (isset($_GET['action']) && $_GET['action'] == 'error')
{
	get_module('error', (isset($_GET['error']) ? $_GET['error'] : null));
}
else if (isset($_GET['module']) || isset($_POST['module']))
{
	if (!isset($_COOKIE[$config['oper_cookie']]))
	{
		header(sprintf('Location: index.php?login=%s', $_GET['login']));
		exit();
	}
	
	$module = isset($_GET['module']) ? $_GET['module'] : $_POST['module'];
	$option = isset($_GET['option']) ? $_GET['option'] : (isset($_POST['option']) ? $_POST['option'] : null);

	get_module($module, $option);
}
else get_module('login', (isset($_GET['login']) ? $_GET['login'] : null))

?>
