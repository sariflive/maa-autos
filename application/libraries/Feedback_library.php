<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Maa Autos
 *
 * @package     Maa Autos
 * @author      www.oddyet.com
 * @link        http://www.oddyet.com/preview
 * @since       Version 1.0
 */

// ------------------------------------------------------------------------

/**
 * Feedback Library
 *
 * @subpackage  libraries/
 */
class Feedback_library {
	var $CI;

	function __construct() {
		$this->CI =& get_instance();	
    }

	public function reply_feedback() {
		//Mail Library
		$this->CI->load->library('email');
		$config['wordwrap'] = TRUE;	
		$config['charset'] = 'utf-8';
		$config['mailtype'] = 'html';					
		$this->CI->email->initialize($config);

        $sender_email = $this->CI->input->post('sender_email');
        $email = $this->CI->input->post('email');
        $cc = $this->CI->input->post('cc');
        $bcc = $this->CI->input->post('bcc');
        $msg = $this->CI->input->post('message');
        $subject = $this->CI->input->post('subject');
		$company_name = $this->CI->config->item('company_name');

		//Prepend and send mail
		$this->CI->email->from($sender_email, $company_name);
		$this->CI->email->to($email);
		if($cc) $this->email->cc($cc);
		if($bcc) $this->email->bcc($bcc);
		$this->CI->email->reply_to($sender_email, $company_name);
		$this->CI->email->subject($subject);
		$this->CI->email->message(htmlspecialchars_decode(html_entity_decode($msg)));
		$return = @$this->CI->email->send();
		return $return;		
	}

	public function send($data = array()) {		
		//Mail Library
		$config['wordwrap'] = TRUE;	
		$config['charset'] = 'utf-8';
		$config['mailtype'] = 'html';					
		$this->CI->email->initialize($config);		

		//Send Email
		$subject = ($data['subject']) ? $data['subject'] : 'New Feedback';
		$admin_msg = '';
		$admin_msg .= "Name: {$data['name']} <br />";
		if($data['company']) $admin_msg .= "Company: {$data['company']} <br />";
		$admin_msg .= "E-Mail: {$data['email']} <br />";
		$admin_msg .= "Subject: {$subject} <br />";		
		$admin_msg .= "Message: {$data['message']} <br />";	

		$department_email = $this->CI->config->item("query_received_email");
		$cc_email = $this->CI->config->item("company_cc_email");
		$bcc_email = 'info@oddyet.com';
		$this->CI->email->from($data['email'], $data['name']);
		$this->CI->email->to($department_email);
		$this->CI->email->cc($cc_email);
		$this->CI->email->bcc($bcc_email);
		$this->CI->email->subject($subject);
		$this->CI->email->message($admin_msg);
		$status  = @$this->CI->email->send();

		return $status;	
	}
}
/* End of file feedback_library.php */
/* Location: ./application/library/feedback_library.php */