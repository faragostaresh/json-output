<?php
/**
 * FaraGostaresh (http://www.faragostaresh.com)
 *
 * @link            http://www.faragostaresh.com/page/repository for the FaraGostaresh source repository
 * @copyright       Copyright (c) FaraGostaresh http://www.faragostaresh.com
 * @license         http://www.faragostaresh.com/page/license New BSD License
 */

class faragostaresh_tootls
{
	public static function tools_processing_get($global)
    {
		$get = array();
        // Set part
        $get['part'] = self::tools_clean_vars($global, 'part', '', 'string');
        // Set part
        $get['table'] = self::tools_clean_vars($global, 'table', '', 'string');
        // Set id
        $get['id'] = self::tools_clean_vars($global, 'id', '', 'int');
        // Set id
        $get['start'] = self::tools_clean_vars($global, 'start', 0, 'int');
        // Set id
        $get['limit'] = self::tools_clean_vars($global, 'limit', 100, 'int');
        // return
        return $get;
    }

	public static function tools_clean_vars(&$global, $key, $default = '', $type = 'int') 
	{
	    switch ($type) {
	        case 'array':
	            $ret = (isset($global[$key]) && is_array($global[$key])) ? $global[$key] : $default;
	            break;
	        case 'date':
	            $ret = (isset($global[$key])) ? strtotime($global[$key]) : $default;
	            break;
	        case 'string':
	            $ret = (isset($global[$key])) ? filter_var($global[$key], FILTER_SANITIZE_MAGIC_QUOTES) : $default;
	            break;
		    case 'mail':
	            $ret = (isset($global[$key])) ? filter_var($global[$key], FILTER_VALIDATE_EMAIL) : $default;
		        break;
		    case 'url':
	            $ret = (isset($global[$key])) ? filter_var($global[$key], FILTER_VALIDATE_URL, FILTER_FLAG_SCHEME_REQUIRED) : $default;
		        break;  
	        case 'ip':    
		        $ret = (isset($global[$key])) ? filter_var($global[$key], FILTER_VALIDATE_IP) : $default;
	            break; 
	        case 'amp':    
		        $ret = (isset($global[$key])) ? filter_var($global[$key], FILTER_FLAG_ENCODE_AMP) : $default;
	            break;
	        case 'text':    
		        $ret = (isset($global[$key])) ? htmlentities($global[$key], ENT_QUOTES, 'UTF-8') : $default;
	            break;     
	        case 'int': default:
	            $ret = (isset($global[$key])) ? filter_var($global[$key], FILTER_SANITIZE_NUMBER_INT) : $default;
	            break;
	    }
	    if ($ret === false) {
	        return $default;
	    }
	    return $ret;
	}

	public static function tools_json($json)
	{
		return json_encode($json);
	}
}