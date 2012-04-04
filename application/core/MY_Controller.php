<?php

/**
* @property CI_DB_active_record $db
* @property CI_DB_forge $dbforge
* @property CI_Benchmark $benchmark
* @property CI_Calendar $calendar
* @property CI_Cart $cart
* @property CI_Config $config
* @property CI_Controller $controller
* @property CI_Email $email
* @property CI_Encrypt $encrypt
* @property CI_Exceptions $exceptions
* @property CI_Form_validation $form_validation
* @property CI_Ftp $ftp
* @property CI_Hooks $hooks
* @property CI_Image_lib $image_lib
* @property CI_Input $input
* @property CI_Language $language
* @property CI_Loader $load
* @property CI_Log $log
* @property CI_Model $model
* @property CI_Output $output
* @property CI_Pagination $pagination
* @property CI_Parser $parser
* @property CI_Profiler $profiler
* @property CI_Router $router
* @property CI_Session $session
* @property CI_Sha1 $sha1
* @property CI_Table $table
* @property CI_Trackback $trackback
* @property CI_Typography $typography
* @property CI_Unit_test $unit_test
* @property CI_Upload $upload
* @property CI_URI $uri
* @property CI_User_agent $user_agent
* @property CI_Validation $validation
* @property CI_Xmlrpc $xmlrpc
* @property CI_Xmlrpcs $xmlrpcs
* @property CI_Zip $zip
* @property Image_Upload $image_upload
* @property Lang_Detect $lang_detect
* @property profile $profile
* @property statistics $statistics
* @property googleplus_post $googleplus_post
*
*/

class MY_Controller extends CI_Controller {
	function __construct(){
		parent::__construct();

		$this->view_vars = array();
		$this->layout_vars= array();
		$this->load->library('session');

		$this->default_layout = 'layout/default';
//
		$this->layout_vars['layout_title'] = "All your social stats in one spot - SocialStatistics";
		$this->layout_vars['meta_description'] = "Track followers and engagement of your Facebook, Twitter and Google+ stats. All in one place.";
		$this->layout_vars['canonical'] = current_url();


		// loading default libraries

	}
}

/**
 * Print debug info of var with invocation line
 * @param mixed $var
 */
function debug($var = ''	) {
	$calledFrom =  debug_backtrace();
	echo '<strong>' . str_replace(APPPATH, '/', $calledFrom[0]['file']) . '</strong>';
	echo ' (line <strong>' . $calledFrom[0]['line'] . '</strong>)';

	echo "\n<pre class=\"debug\">\n";
	if(is_object($var) || is_array($var)){
		$var = print_r($var, true);
		//$var = var_dump($var);
	}
	elseif(func_get_args()){
		$var = var_dump($var);
	}
	echo $var . "\n</pre>\n";
}


function print_json($success =false , $data = array()) {
	$array = array('success' => $success, 'data' => $data);
	header('Cache-Control: no-cache, must-revalidate');
	header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
	header('Content-type: application/json');
	echo json_encode($array);
	exit();
}