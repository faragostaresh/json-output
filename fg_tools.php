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
        // Set start
        $get['start'] = self::tools_clean_vars($global, 'start', 0, 'int');
        // Set limit
        $get['limit'] = self::tools_clean_vars($global, 'limit', 100, 'int');
        // return
        return $get;
    }

    public static function tools_processing_post($global)
    {
		$post = array();
        // Set title
        $post['title'] = self::tools_clean_vars($global, 'title', '', 'string');
        // Set phone
        $post['phone'] = self::tools_clean_vars($global, 'phone', '', 'string');
        // Set mobile
        $post['mobile'] = self::tools_clean_vars($global, 'mobile', '', 'string');
        // Set type
        $post['type'] = self::tools_clean_vars($global, 'type', '', 'string');
        // Set submiter
        $post['submiter'] = self::tools_clean_vars($global, 'submiter', '', 'string');
        // Set address
        $post['address'] = self::tools_clean_vars($global, 'address', '', 'string');
        // Set mail
        $post['mail'] = self::tools_clean_vars($global, 'mail', '', 'mail');
        // return
        return $post;
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
		if (is_array($json)) {
			return json_encode($json);
		}
		return '';
	}

	public static function tools_mail($info)
	{
		// Get config
		$config = faragostaresh_config::config_main();
        // Set mail
		$subject = 'Send information';
		// Set headers
		$headers  = '';
		$headers .=  sprintf('From: %s' , $info['mail']) . "\r\n";
        $headers .= 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        // Set message
		$message  = '';
		$message .= sprintf('<p>Title : %s</p>' , $info['title']);
		$message .= sprintf('<p>Phone : %s</p>' , $info['phone']);
		$message .= sprintf('<p>Mobile : %s</p>' , $info['mobile']);
		$message .= sprintf('<p>Type : %s</p>' , $info['type']);
		$message .= sprintf('<p>Submiter : %s</p>' , $info['submiter']);
		$message .= sprintf('<p>Address : %s</p>' , $info['address']);
		$message .= sprintf('<p>Mail : %s</p>' , $info['mail']);
        // Send mail
		if (mail($config['mail'], $subject, $message, $headers)) {
			return array('message' => 'Mail send successfully' , 'status' => 1);
		}
		return array('message' => 'Error on send mail' , 'status' => 0);
	}
}