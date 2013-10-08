<?php
/**
 * FaraGostaresh (http://www.faragostaresh.com)
 *
 * @link            http://www.faragostaresh.com/page/repository for the FaraGostaresh source repository
 * @copyright       Copyright (c) FaraGostaresh http://www.faragostaresh.com
 * @license         http://www.faragostaresh.com/page/license New BSD License
 */

class faragostaresh_db
{
	public $db_table = array(
		'cookcat', 'cooking', 'datav', 'foodmenu', 'gallery', 'locations', 
		'marq', 'namebank', 'photocat', 'ratings', 'respics' 
	);

	public function __construct()
	{
		$this->db_connect();
	}

	public function db_connect()
	{
		$config = faragostaresh_config::config_db();
		mysql_connect($config['host'], $config['username'], $config['password']);
        mysql_select_db($config['name']);
        mysql_query("SET NAMES 'utf8'");
	}

	public function db_select_id($table, $id)
	{
		$row = array();
		if (in_array($table, $this->db_table)) {
			$sql = sprintf('SELECT * FROM `%s` WHERE `id` = %s LIMIT 1', $table, $id);
			$result = mysql_query($sql);
			if (!$result) {
           		trigger_error('Invalid query: ' . mysql_error());
        	}
			$row = mysql_fetch_assoc($result);
		}
		return $row;
	}

	public function db_select_list($table, $start, $limit)
	{
		$rows = array();
		if (in_array($table, $this->db_table)) {
			$sql = sprintf('SELECT * FROM `%s` WHERE (`id` > %s ) ORDER BY `id` ASC LIMIT %s', $table, $start, $limit);
			$result = mysql_query($sql);
			if (!$result) {
           		trigger_error('Invalid query: ' . mysql_error());
        	}
			while($row = mysql_fetch_assoc($result)) 
			{
				$rows[] = $row;
			}
		}	
		return $rows;
	}

	public function db_set_log($sql)
	{
		return '';
	}
}