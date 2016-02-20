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
 * Contact Controller
 *
 * @subpackage  controllers
 */
class Contact extends CI_Controller {

    public $data = array();    // Included view data array;
	
	function __construct()
	{
        // Call the Controller constructor
		parent::__construct();
		$this->config->load_db_items();	
	}

    /**
     * Contact
     *
     * @access public
     * @return mixed
     */
	public function index()
	{
		if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
			//form validation
			$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('subject', 'Subject', 'trim|xss_clean');
			$this->form_validation->set_rules('company', 'Company', 'trim|xss_clean');
			$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email|xss_clean');
			$this->form_validation->set_rules('message', 'Message', 'trim|required|xss_clean');
            //form validation

			if ($this->form_validation->run() == FALSE) {
			    //validation error
				$json['error'] = '<div class="alert alert-danger"><i class="fa fa-cancel-circled"></i> <button type="button" class="close" data-dismiss="alert">×</button>'.validation_errors().'</div>';
			}
			else {
			    //post data
				$parsed_data = $this->parsed_data();

				$db_status = save_data('feedbacks', $parsed_data);
				if($db_status) {
				    //load library
					$this->load->library(array("feedback_library", 'email'));
                    //send email
					$this->feedback_library->send($parsed_data);
                    //success message
					$json['error'] = '<div class="alert alert-success"><i class="fa fa-check"></i> <button type="button" class="close" data-dismiss="alert">×</button><strong>Success! </strong>Your feedback has been sent successfully.</div>';
				}
				else {
				    //error message
					$json['error'] = '<div class="alert alert-danger"><i class="fa fa-info-circled"></i> <button type="button" class="close" data-dismiss="alert">×</button><strong>Error! </strong>Mail sent failed, please try again. If problem persist, please contact '.$this->config->item("company_email").' Thanks.</div>';
				}
			}

            //return json
			ajax_response($json); return; //JSON Response
		}

        //widget
		$wds = widget_snippet();
		foreach($wds as $key=>$section) {
			$this->data["{$section['section_id']}"] = $section;	
		}

        //breadcrumbs
		$this->data['breadcrumbs'] = "";
		$this->data['breadcrumbs'] .= "<li class=\"active\">Contact</li>";
		$this->data['page_title'] = "<h1>Contact</h1>";
        $this->data['page_js'] = "contact";

        //meta data
		$this->data['page'] = array(
							'meta_title'=> 'Contact Us of ' . $this->config->item('site_title'),
							'meta_keyword'=> 'Contact Us of ' . $this->config->item('site_title'),
							'meta_description'=> 'Contact Us of ' . $this->config->item('site_title'),
							'url'=>'contact'
						);

        //company contact details
        $this->data['location_latitude'] = $this->config->item("location_latitude");
        $this->data['location_longitude'] = $this->config->item("location_longitude");

        $this->data['company_phone'] = $this->config->item("company_phone");
        $this->data['company_email'] = $this->config->item("company_email");
        $this->data['company_address'] = $this->config->item("company_address");
        $this->data['company_city'] = $this->config->item("company_city");
        $this->data['company_country'] = $this->config->item("company_country");
        $this->data['company_url'] = $this->config->item("company_url");
        $this->data['company_name'] = $this->config->item("company_name");
        $this->data['company_fax'] = $this->config->item("company_fax");

        //company support contact details
        $this->data['support_phone'] = $this->config->item("support_phone");
        $this->data['support_fax'] = $this->config->item("support_fax");
        $this->data['support_address'] = $this->config->item("support_address");
        $this->data['support_email'] = $this->config->item("support_email");
        $this->data['support_city'] = $this->config->item("support_city");
        $this->data['support_country'] = $this->config->item("support_country");

        //company sales contact details
        $this->data['sales_phone'] = $this->config->item("sales_phone");
        $this->data['sales_fax'] = $this->config->item("sales_fax");
        $this->data['sales_address'] = $this->config->item("sales_address");
        $this->data['sales_email'] = $this->config->item("sales_email");
        $this->data['sales_city'] = $this->config->item("sales_city");
        $this->data['sales_country'] = $this->config->item("sales_country");
        //company contact details

		$this->data['segment'] = 'contact';
		render_page("template", $this->data);
	}//end contact index function

	/**
     * contact parsed data
     * 
     * @access private
     * @return array
     */
	private function parsed_data()
	{
	    $parsed_data=array();

        //post data
        $parsed_data['name'] = $this->input->post("name", TRUE);
        $parsed_data['company'] = $this->input->post("company", TRUE);
        $parsed_data['email'] = $this->input->post("email", TRUE);
        $parsed_data['subject'] = $this->input->post("subject", TRUE);
        $parsed_data['message'] = $this->input->post("message", TRUE);
        $parsed_data['IP'] = $this->input->ip_address();
        $parsed_data['browser'] = $this->input->user_agent();
        //post data

        return $parsed_data;
	}
}
/* End of file contact.php */
/* Location: ./application/controllers/contact.php */