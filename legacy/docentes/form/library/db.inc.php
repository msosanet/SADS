<?php

/*
 * The db object to access to mySQL database server
 *
 */

$mysql_link = 0;

class db
{
	function db()
	{
		global $config, $theme, $mysql_link;
				
		$this->db = $config['mysql_db'];
		$mysql_link = @mysql_connect(sprintf('%s:%s', $config['mysql_host'], $config['mysql_port']), $config['mysql_user'], $config['mysql_pass']);
		if (mysql_errno())
		{
			header(sprintf('location: %s/index.php?action=error&error=%s', $config['url'], base64_encode(sprintf($theme['errors']['connection_error'], $config['mysql_host'], $config['mysql_port']))));
			exit();
		}
	}

	function new_db($db)
	{
		global $config, $mysql_link;
		
		mysql_query(sprintf('CREATE DATABASE IF NOT EXISTS %s', $db), $mysql_link);
		if (mysql_errno())
		{
			header(sprintf('location: %s/index.php?action=error&error=%s', $config['url'], base64_encode(sprintf($theme['errors']['sql_command_error'], $this->db, $command))));
			exit();
		}
	}

	function is_db($db)
	{
		global $mysql_link;

		$dbs = mysql_list_dbs($mysql_link);
		$i = mysql_num_rows($dbs) - 1;
		$result = false;
		while ($i >= 0)
		{
			if (mysql_db_name($dbs, $i) == $db) $result = true;
			$i--;
		}
		return $result;
	}

	function is_tb($db, $tb)
	{
		global $mysql_link;

		$result = false;
		if ($this->is_db($db))
		{
			$tbs = mysql_list_tables($db, $mysql_link);
			$i = mysql_num_rows($tbs) - 1;
			while ($i >= 0)
			{
				if (mysql_tablename($tbs, $i) == $tb) $result = true;
				$i--;
			}
		}
		return $result;
	}

	function query($query)
	{
		global $config, $theme, $mysql_link;

		$rows = array();
		$result = mysql_db_query($this->db, $query, $mysql_link);
		if (mysql_errno())
		{
			header(sprintf('location: %s/index.php?action=error&error=%s', $config['url'], base64_encode(sprintf($theme['errors']['sql_query_error'], $this->db, $query))));
			exit();
		}
		while ($row = mysql_fetch_row($result)) $rows[] = $row;
		return $rows;
	}

	function command($command)
	{
		global $config, $theme, $mysql_link;

		mysql_db_query($this->db, $command, $mysql_link);
		if (mysql_errno())
		{
			header(sprintf('location: %s/index.php?action=error&error=%s', $config['url'], base64_encode(sprintf($theme['errors']['sql_command_error'], $this->db, $command))));
			exit();
		}
		return mysql_insert_id($mysql_link);
	}

	function rows_number($query)
	{
		global $config, $theme, $mysql_link;

		$result = mysql_db_query($this->db, $query, $mysql_link);
		if (mysql_errno())
		{
			header(sprintf('location: %s/index.php?action=error&error=%s', $config['url'], base64_encode(sprintf($theme['errors']['sql_query_error'], $this->db, $query))));
			exit();
		}
		return mysql_num_rows($result);
	}

	function fields_number($query)
	{
		global $config, $theme, $mysql_link;

		$result = mysql_db_query($this->db, $query, $mysql_link);
		if (mysql_errno())
		{
			header(sprintf('location: %s/index.php?action=error&error=%s', $config['url'], base64_encode(sprintf($theme['errors']['sql_query_error'], $this->db, $query))));
			exit();
		}
		return mysql_num_fields($result);
	}

	function field_name($query, $field)
	{
		global $config, $theme, $mysql_link;

		$result = mysql_db_query($this->db, $query, $mysql_link);
		if (mysql_errno())
		{
			header(sprintf('location: %s/index.php?action=error&error=%s', $config['url'], base64_encode(sprintf($theme['errors']['sql_query_error'], $this->db, $query))));
			exit();
		}
		return mysql_field_name($result, $field);
	}
}

?>