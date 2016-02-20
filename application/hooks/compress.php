<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
function compress() {
	$exec = TRUE;	
	$CI =& get_instance();
	$buffer = $CI->output->get_output();
 
	$current_page = (isset($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : ''; 
	$search = array(
		'/\n/',			// replace end of line by a space
		'/\>[^\S ]+/s',		// strip whitespaces after tags, except space
		'/[^\S ]+\</s',		// strip whitespaces before tags, except space
	 	'/(\s)+/s'		// shorten multiple whitespace sequences
	  );
 
	 $replace = array(' ','>','<','\\1');
	 
	//if(!preg_match('/admin/si',$current_page)) 
	$buffer = preg_replace($search, $replace, $buffer);

	$options = array('clean' => true,'hide-comments' => true,'indent' => true);
	//$buffer = tidy_parse_string($buffer, $options, 'utf8');
	//tidy_clean_repair($buffer);
	$CI->output->set_output($buffer);
	$CI->output->_display();
}
 
/* End of file compress.php */
/* Location: ./system/application/hools/compress.php */