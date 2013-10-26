<?php
/**
 * FaraGostaresh (http://www.faragostaresh.com)
 *
 * @link            http://www.faragostaresh.com/page/repository for the FaraGostaresh source repository
 * @copyright       Copyright (c) FaraGostaresh http://www.faragostaresh.com
 * @license         http://www.faragostaresh.com/page/license New BSD License
 */

// require class
require_once 'fg_config.php';
require_once 'fg_tools.php';
require_once 'fg_db.php';
// set headers 
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
//header('Content-type: application/json');
header('Content-Type: text/html; charset=utf-8');
// set default json
$output = array('message' => '');
// Set get
$get = faragostaresh_tootls::tools_processing_get($_GET);
// Check get not empty
if (!empty($get) && !empty($get['part'])) {
	// load DB object
    $db = new faragostaresh_db();
    // Check is object
    if (is_object($db)) {
    	// process DB
    	switch ($get['part']) {
	    	// Get single item from DB
	    	case 'single':
	        	if (!empty($get['table']) && !empty($get['id'])) {
	    	    	$output = $db->db_select_id($get['table'], $get['id']);
	        	}
		    	break;
	    	// Get list of items from DB
        	case 'list':
            	if (!empty($get['table'])) {
	    	    	$output = $db->db_select_list($get['table'], $get['start'], $get['limit']);
	        	}
		    	break;
		    // Send mail
		    case 'mail':
		        $post = faragostaresh_tootls::tools_processing_post($_POST);
		        if (!empty($post)) {
		        	$output = faragostaresh_tootls::tools_mail($post);
		        }
		    	break;
    	}
    }	
}
// Make json output
echo faragostaresh_tootls::tools_json($output);