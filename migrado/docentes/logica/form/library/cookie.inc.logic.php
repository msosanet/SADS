<?php

/*
 * The cookie object for controlling cookies
 *
 */

class cookie
{
	function cookie()
	{
		global $config;

		$this->name = $config['oper_cookie'];
		$this->path = '/';
	}

	function read($param)
	{
		if (isset($_COOKIE[$this->name]))
		{
			return $_COOKIE[$this->name];
		}
		else return null;
	}

	function write($value)
	{
		setcookie($this->name, $value, null, $this->path);
	}

	function clear()
	{
		setcookie($this->name, $_COOKIE[$this->name], time() - 1000, $this->path);
	}
}

?>
