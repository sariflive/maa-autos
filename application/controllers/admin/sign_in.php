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
 * Sign In Controller
 *
 * @subpackage  controllers/admin
 */
class Sign_in extends CI_Controller {

    public $data = array();    // Included view data array;

	function __construct()
	{
        // Call the Controller constructor
		parent::__construct();
        //load model
		$this->load->model(array('admin/signin_model', 'api_model'));
        //load helper (admin, form)
		$this->load->helper(array("admin", "form"));
	}

    //start default index function
	public function index()
	{
        //start if form submitted
		if($_POST) {
		    //check form validation
            $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
			//start if form validate success
			if ($this->form_validation->run() == TRUE) {
                //receive post data
                $user_email = clean_data($this->input->post('email', TRUE));
                $user_password = clean_data($this->input->post('password', TRUE));
                //end receive post data

                 //checking valid email
                 if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
                     //if not valid
                     $this->data['error'] = '<div class="alert alert-danger"><a data-dismiss="alert" class="close">×</a><strong>Error! </strong>Please enter a valid email.</div>';
                 }
                 else {
    			    //checking user
    				$user_data = $this->signin_model->check_user($user_email, $user_password);
    
                    //if user is not valid
    				if(!$user_data) $this->data['error'] = '<div class="alert alert-danger"><a data-dismiss="alert" class="close">×</a><strong>Error! </strong>E-mail / Password Error.</div>';
    				//if user is valid
    				else {
            			$expire_after = 30 * 24 * 60 * 60;
                        $time = time() + $expire_after;
                        $token_data[] = $user_data['ID']. '|' .$time;
                        $token_data[] = $user_data['email'];
                        $token_data[] = $user_data['password'];
                        $set_sess['token'] = $this->api_model->make_token($token_data, $time);
                        $this->session->set_userdata($set_sess);
    				    redirect(site_url("admin/dashboard"));
    				    return;
                    }
                }
			} //end form validate success
			else {
			    //if form validate failed
				if(validation_errors()) $this->data['error'] = '<div class="msgbar msg_Alert hide_onC"><span class="iconsweet">! </span>'.validation_errors().'</div>';
			}
		}
        //end if form submitted

		render_page('admin/sign-in/sign-in', $this->data);
	}//end default index function
}
/* End of file admin/sign_in.php */
/* Location: ./application/controllers/admin/sign_in.php */