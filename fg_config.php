<?php
/**
 * FaraGostaresh (http://www.faragostaresh.com)
 *
 * @link            http://www.faragostaresh.com/page/repository for the FaraGostaresh source repository
 * @copyright       Copyright (c) FaraGostaresh http://www.faragostaresh.com
 * @license         http://www.faragostaresh.com/page/license New BSD License
 */

class faragostaresh_config
{
	public static function config_db()
    {
		$config = array();
		$config['host'] = 'localhost';
		$config['username'] = '';
		$config['password'] = '';
		$config['name'] = '';
		return $config;
    }

    public static function config_main()
    {
		$config = array();
		$config['url'] = '';
		$config['path'] = '';
		return $config;
    }

    public static function config_extra()
    {
		$config = array();
		return $config;
    }

    public static function config_version()
    {
		$config = array();
		$config['number'] = '1';
		$config['situation'] = 'alpha';
		$config['release'] = '2013/10/10';
		return $config;
    }
}