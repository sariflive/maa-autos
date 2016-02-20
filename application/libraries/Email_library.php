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
 * Email Library
 *
 * @subpackage  libraries/
 */
class Email_library {
	var $CI;

	function __construct() {
		$this->CI =& get_instance();	
    }

	public function send_callback($data = array())
	{
		//Mail Library
		$config['wordwrap'] = TRUE;	
		$config['charset'] = 'utf-8';
		$config['mailtype'] = 'html';					
		$this->CI->email->initialize($config);

		$name = $data['name'];
		$email = $data['email'];
		$country = $data['countryID'];
        //get country name
		if($country) {
			$countries = get_rows(array('ID'=>$country), array('TABLE'=>'countries', 'LIMIT'=>1));
            //check country
			$country = (isset($countries['name'])) ? $countries['name'] : '';
		}
		$phone = $data['phone'];
		$message = $data['message'];
		$subject = 'New Call Back Request';	

		//admin message
		$admin_msg = '';
		$admin_msg .= '<h2>'.$subject.'</h2><br />';
		$admin_msg .= "Name: {$name} <br />";
		$admin_msg .= "E-Mail: {$email} <br />";
		$admin_msg .= "Country: {$country} <br />";
		$admin_msg .= "Phone: {$phone} <br />";		
		$admin_msg .= "Message: {$message} <br />";	

		$department_email = $this->CI->config->item("query_received_email");
		$cc_email = $this->CI->config->item("company_cc_email");
		$bcc_email = 'info@oddyet.com';
        //Send Email
		$this->CI->email->from($email, $name);
		$this->CI->email->to($department_email);
		$this->CI->email->cc($cc_email);
		$this->CI->email->bcc($bcc_email);
		$this->CI->email->subject($subject);
		$this->CI->email->message($admin_msg);
		$status  = @$this->CI->email->send();

		return $status;			
	}

	public function send_enquiry($data = array())
	{
		$config['wordwrap'] = TRUE;
		$config['charset'] = 'utf-8';
		$config['mailtype'] = 'html';
		$this->CI->email->initialize($config);

		$subject = "Enquiry for Vehicle";
		$vehiclecode = $data['vehiclecode'];
		$name = $data['name'];
		$email = $data['email'];
		$phone = $data['phone'];
		$address = $data['address'];
		$country = $data['countryID'];
		$country_name = '';
		if($country) {
			$country_data = get_rows(array('ID'=>$country), array('TABLE'=>'countries', 'LIMIT'=>1));
			$country_name = ($country_data['name']) ? $country_data['name'] : '';
		}
		$comments = $data['comments'];

		if($vehiclecode) {
			$sql_properties['SELECT'] = 'vehicles.*, showrooms.dealership_name, makers.name as maker_name, models.model as model_name';
			$sql_properties['TABLE'] = 'vehicles';
			$sql_properties['LIMIT'] = 1;
			$sql_properties['ORDER_BY'] = 'ID';
			$sql_properties['ORDER_TYPE'] = 'desc';
			$sql_properties['GLUE'][] = 'showrooms';
			$sql_properties['PIECES'][] = 'showrooms.ID = vehicles.showroomID';
			$sql_properties['GLUE'][] = 'makers';
			$sql_properties['PIECES'][] = 'makers.ID = vehicles.makerID';
			$sql_properties['GLUE'][] = 'models';
			$sql_properties['PIECES'][] = 'models.ID = vehicles.modelID';

			$vehicle_info = get_rows(array('vehicles.vehicleCode'=>$vehiclecode), $sql_properties);	
		}
		$maker = (isset($vehicle_info['maker_name'])) ? $vehicle_info['maker_name'] : '';
		$model = (isset($vehicle_info['model'])) ? $vehicle_info['model'] : '';
		$vehicle_name = (isset($vehicle_info['name'])) ? $vehicle_info['name'] : '';

		//msg admin
		$admin_msg = '';
		$admin_msg .= "<strong>Vehicle Code:</strong>  {$vehiclecode} <br />";
		$admin_msg .= "<strong>Name:</strong>  {$vehicle_name} <br />";
		$admin_msg .= "<strong>Maker:</strong>  {$maker} <br />";
		$admin_msg .= "<strong>Model:</strong>  {$model} <br /><hr />";
		$admin_msg .= "<h3>Customer Info</h3>";
		$admin_msg .= "<strong>Name:</strong> {$name} <br />";
		$admin_msg .= "<strong>From:</strong> {$email} <br />";
		$admin_msg .= "<strong>Phone:</strong> {$phone} <br />";
		$admin_msg .= "<strong>Address:</strong> {$address} <br />";	
		$admin_msg .= "<strong>Comments:</strong> {$comments} <br />";	

		$department_email = $this->CI->config->item("query_received_email");
		$cc_email = $this->CI->config->item("company_cc_email");
		$bcc_email = 'info@oddyet.com';
		$this->CI->email->from($email, $name);
		$this->CI->email->to($department_email);
		$this->CI->email->cc($cc_email);
		$this->CI->email->bcc($bcc_email);
		$this->CI->email->subject($subject);
		$this->CI->email->message($admin_msg);
		$status  = @$this->CI->email->send();
		//msg admin end

		//msg user
		$company_name = $this->CI->config->item("company_name");
		$company_phone = $this->CI->config->item("company_phone");
		$company_fax = $this->CI->config->item("company_fax");
		$company_email = $this->CI->config->item("company_email");
		$company_url = $this->CI->config->item("company_url");
		$company_url = str_replace('http://', '', $company_url);
		$subject = 'Thanks for Interest';
		$user_msg = '';
		$user_msg .= "Dear Sir,<br />
		Thank you for visiting our company website today.<br />
		We appreciate that you took time from your busy day to contact us, and we will get back to you as soon as possible.<br />
		Best Regards,<br />
		<strong>{$company_name}</strong><br /><br />";
		
		$user_msg .= "<strong>TEL:</strong> {$company_phone}<br />";
		$user_msg .= "<strong>FAX:</strong> {$company_fax}<br />";
		$user_msg .= "<strong>Email:</strong><a href='mailto:{$company_email}'>{$company_email}</a><br />";
		$user_msg .= "URL: <a href='http://{$company_url}'>{$company_url}</a>";
		$this->CI->email->from($department_email, $company_name);
		$this->CI->email->to($email);
		$this->CI->email->cc($cc_email);
		$this->CI->email->bcc($bcc_email);
		$this->CI->email->subject($subject);
		$this->CI->email->message($user_msg);
		$status  = @$this->CI->email->send();		
		//msg user end

		return $status;			
	}

	public function reply_enquiry() {
		//Mail Library
		$this->CI->load->library('email');
		$config['wordwrap'] = TRUE;	
		$config['charset'] = 'utf-8';
		$config['mailtype'] = 'html';					
		$this->CI->email->initialize($config);

        $sender_email = $this->CI->input->post('sender_email');
        $email = $this->CI->input->post('email');
        $msg = $this->CI->input->post('comments');
        $subject = $this->CI->input->post('subject');
		$company_name = $this->CI->config->item('company_name');

		//Prepend and send mail
		$this->CI->email->from($sender_email, $company_name);
		$this->CI->email->to($email);
		$this->CI->email->reply_to($sender_email, $company_name);
		$this->CI->email->subject($subject);
		$this->CI->email->message(htmlspecialchars_decode(html_entity_decode($msg)));
		$return = @$this->CI->email->send();

		return $return;			
	} 
	
}
/* End of file emaillibrary.php */
/* Location: ./application/library/email_library.php */