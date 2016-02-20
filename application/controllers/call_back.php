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
 * Call Back Controller
 *
 * @subpackage  controllers
 */
class Call_back extends CI_Controller {

    public $data = array();    // Included view data array;

	function __construct()
	{
        // Call the Controller constructor
		parent::__construct();
		$this->config->load_db_items();
	}

    /**
     * Call Back
     *
     * @access public
     * @return mixed
     */
	public function index()
	{
		if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
		    //default error message
			$json['error'] = '';

            //form validation
			$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email|xss_clean');
			$this->form_validation->set_rules('country', 'Country', 'trim|required|xss_clean');
			$this->form_validation->set_rules('phone', 'Phone', 'trim|required|xss_clean');
			$this->form_validation->set_rules('message', 'Message', 'trim|required|xss_clean');
            //form validation
			if ($this->form_validation->run() == FALSE) {
			    //if validation errors
				if(validation_errors()) $json['error'] = '<div class="alert alert-danger"><i class="fa fa-cancel-circled"></i> <button type="button" class="close" data-dismiss="alert">×</button>'.validation_errors().'</div>';
			}
			else {
			    //post data
				$parsed_data = $this->parsed_data();

                //save post data
				$db_status = save_data('callback', $parsed_data);
				if($db_status) {
				    //load library
					$this->load->library(array("email_library", 'email'));
					$this->email_library->send_callback($parsed_data);
                    //success message
					$json['error'] = '<div class="alert alert-success"><i class="fa fa-check"></i> <button type="button" class="close" data-dismiss="alert">×</button><strong>Success! </strong>Thank You! We will contact you soon.</div>';
				}
				else {
				    //error message
				    $json['error'] = '<div class="alert alert-danger"><i class="fa fa-info-circled"></i> <button type="button" class="close" data-dismiss="alert">×</button><strong>Error! </strong>Mail sent failed, please try again. If problem persist, please contact '.$this->config->item("company_email").' Thanks.</div>';
			    }
			}

            // return json result
			ajax_response($json); return; //JSON Response
		}

		$this->data['right_side'] = TRUE;
		$this->data['active'] = 'call-back';
        $this->data['page_js'] = 'call-back';
        //breadcrumbs
		$this->data['breadcrumbs'] = "";
		$this->data['breadcrumbs'] .= "<li class=\"active\">Request a Callback</li>";
		$this->data['page_title'] = "<h1>Request a Callback</h1>";

        //vehicle range
        $this->data['vehicle_range'] = vehicle_range();
        //currency symbol
        $this->data['currency_symbol'] = $this->config->item("currency_symbol");

        //meta data
		$this->data['page'] = array(
							'meta_title'=> 'Request a Callback - ' . $this->config->item('site_title'),
							'meta_keyword'=> 'Request a Callback - ' . $this->config->item('site_title'),
							'meta_description'=> 'Request a Callback - ' . $this->config->item('site_title'),
							'url'=>'call-back'
						);

        //widgets
		$wds = widget_snippet();
		foreach($wds as $key=>$section) {
			$this->data["{$section['section_id']}"] = $section;		
		}
		$this->data['segment'] = 'call-back/call-back';
		render_page("template", $this->data);
	}//end call back index function

    /**
     * call back parsed data
     * 
     * @access private
     * @return array
     */
    private function parsed_data()
    {
        $parsed_data = array();

        //post data
        $parsed_data['name'] = $this->input->post("name", TRUE);
        $parsed_data['email'] = $this->input->post("email", TRUE);
        $parsed_data['countryID'] = $this->input->post("country", TRUE);
        $parsed_data['phone'] = $this->input->post("phone", TRUE);
        $parsed_data['message'] = $this->input->post("message", TRUE);
        $parsed_data['IP'] = $this->input->ip_address();
        $parsed_data['browser'] = $this->input->user_agent();
        //post data

        return $parsed_data;
    }
}
/* End of file call_back.php */
/* Location: ./application/controllers/call_back.php */