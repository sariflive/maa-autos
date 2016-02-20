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
 * Ajax Controller
 *
 * @subpackage  controllers
 */
class Ajax extends CI_Controller {

    public $json_data = array();    // Included view data array;

	function __construct()
	{
        // Call the Controller constructor
		parent::__construct();
		$this->config->load_db_items();
        $this->load->helper('ajax_request');
        $ajax_check = ajax_check();
        if(!$ajax_check) { show_404(); return; }
	}

    /**
     * enquiry
     * 
     * @access public (ajax)
     * @return string
     */
	public function enquiry()
	{
	    //default message
	    $json['error'] = '';

	    //form validation
		$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('comments', 'Comments', 'trim|required|xss_clean');
		if ($this->form_validation->run() == FALSE) {
		    //if validation errors
			if(validation_errors()) $json['error'] = '<div class="alert alert-danger"><i class="icon-cancel-circled"></i><button type="button" class="close" data-dismiss="alert">×</button>'.validation_errors().'</div>';
		}
		else {
		    //post data
		    $parsed_data = $this->enquiry_parsed_data();

            //save post data
			$db_status = save_data('vehicle_enquiries', $parsed_data);
			if($db_status) {
				$this->load->library(array("email_library", 'email'));
				$this->email_library->send_enquiry($parsed_data);
                //return success message
				$json['error'] = '<div class="alert alert-success"><i class="fa fa-check"></i> <button type="button" class="close" data-dismiss="alert">×</button><strong>Success! </strong>Thank you for your interest in this vehicle. We will contact you as soon as possible.</div>';
			}
			else {
			    //return error message
			    $json['error'] = '<div class="alert alert-danger"><i class="fa fa-info-circled"></i> <button type="button" class="close" data-dismiss="alert">×</button><strong>Error! </strong>Query sent failed, please try again. If problem persist, please contact '.$this->config->item("company_email").' Thanks.</div>';
            }
        }

        //return message
        ajax_response($json); return; //JSON Response
	}//end enquiry function

    /**
     * newsletter
     * 
     * @access public (ajax)
     * @return string
     */
	public function newsletter()
	{
	    $json['error'] = '';

	    //form validation
		$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email|xss_clean');
		if ($this->form_validation->run() == FALSE) {
		    //if validation errors
			if(validation_errors()) $json['error'] = '<div class="alert alert-danger"><i class="fa fa-cancel-circled"></i> <button type="button" class="close" data-dismiss="alert">×</button>'.validation_errors().'</div>';
		}
		else {
		    //post data
			$parsed_data['name'] = $this->input->post("name", TRUE);
			$parsed_data['email'] = $this->input->post("email", TRUE);
            //check user exist
			$check_user = get_rows(array('email'=>$parsed_data['email']), array('TABLE'=>'subscribers', 'LIMIT'=>1));
			if(isset($check_user['email'])) {
				$json['error'] = '<div class="alert alert-warning"><i class="fa fa-info-circled"></i> <button type="button" class="close" data-dismiss="alert">×</button><strong>Notice! </strong>You are already have in our Subscriber list, Thanks.</div>';
			}
			else {
			    //save post data
				$db_status = save_data('subscribers', $parsed_data);
				if($db_status) {
				    //success message
					$json['error'] = '<div class="alert alert-success"><i class="fa fa-check"></i> <button type="button" class="close" data-dismiss="alert">×</button><strong>Success! </strong>You are successfully added Newsletter Subscribers.</div>';
				}
				else {
				    //error message
					$json['error'] = '<div class="alert alert-danger"><i class="fa fa-info-circled"> </i><button type="button" class="close" data-dismiss="alert">×</button><strong>Error! </strong>Saved failed, please try again. If problem persist, please contact '.$this->config->item("company_email").' Thanks.</div>';
				}
			}
		}

        //return message
        ajax_response($json); return; //JSON Response
	}//end newsletter function

    /**
     * zones
     * 
     * @access public (ajax)
     * @return string
     */
	public function zones()
	{
	    //default message
		$json['ports'] = '';
		$country = $this->input->get("c", TRUE);
        //get zones
		$zones = get_rows(array("country"=>$country, 'enabled'=>'1'), array('table'=>'zones', 'limit'=>1000));
		if(count($zones) > 0) {
			foreach ($zones as $key => $row) {
			    //return zone ports
				$json['ports'] .= "<option value=\"{$row['seaport_value']}\">{$row['seaport']}</option>";
			}
		}
        //return if not found
		else $json['ports'] = '<option value="">Not Available</option>';

        //return message
        ajax_response($json); return; //JSON Response
	}//end zones function

    /**
     * models
     * 
     * @access public (ajax)
     * @return string
     */
	public function models()
	{
	    //default message
		$json['models'] = '<option value="">---SELECT---</option>';
        //get maker
		$maker = $this->input->get("m", TRUE);
		$maker = get_rows(array("name"=>$maker), array('TABLE'=>'makers', 'LIMIT'=>1));

		if(isset($maker['ID'])) {
		    //models
			$models = get_rows(array("maker"=>$maker['ID'], 'status'=>'1'), array('TABLE'=>'models', 'LIMIT'=>1000, 'ORDER_BY'=>'model', 'ORDER_TYPE'=>'asc'));
			if(count($models) > 0) {
				foreach ($models as $key => $row) {
				    //return models
					$json['models'] .= "<option value=\"{$row['model']}\">{$row['model']}</option>";
				}
			}
            //return if not found
			else $json['models'] = '<option value="">Not Available</option>';
		}

        //return message
        ajax_response($json); return; //JSON Response
	}//end models function

    /**
     * enquiry parsed data
     * 
     * @access private
     * @return array
     */
    private function enquiry_parsed_data()
    {
        $parsed_data = array();

        //post data
        $parsed_data['vehiclecode'] = $this->input->post("vehiclecode", TRUE);
        $parsed_data['name'] = $this->input->post("name", TRUE);
        $parsed_data['email'] = $this->input->post("email", TRUE);
        $parsed_data['phone'] = $this->input->post("phone", TRUE);
        $parsed_data['address'] = $this->input->post("address", TRUE);
        $parsed_data['countryID'] = $this->input->post("country", TRUE);
        $parsed_data['comments'] = $this->input->post("comments", TRUE);
        $parsed_data['IP'] = $this->input->ip_address();
        $parsed_data['browser'] = $this->input->user_agent();
        //post data

        return $parsed_data;
    }//end enquiry parsed data function
}
/* End of file ajax.php */
/* Location: ./application/controllers/ajax.php */