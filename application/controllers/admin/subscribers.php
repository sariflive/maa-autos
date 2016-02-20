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
 * Subscribers Controller
 *
 * @subpackage  controllers/admin
 */
class Subscribers extends CI_Controller {

    public $data = array();    // Included view data array;

	function __construct()
	{
        // Call the Controller constructor
		parent::__construct();
		$this->load->model('admin/signin_model');
		$this->load->helper(array("admin", "form"));
		$this->signin_model->auth_user();
	}

    /**
     * Controller For 'Admin subscribers page'
     * 
     * @access public
     * @return redirect manage
     */
	public function index($offset=0)
	{
		redirect(site_url("admin/subscribers/manage")); return;
	}

    /**
     * subscriber manage (Admin)
     *
     * @access public
     * @param $mode
     * @param $id (alphaID)
     * @param $offset
     * @return mixed
     */
	public function manage($mode='add', $id=0, $offset=0)
	{
		$user_type = $this->session->userdata("user_type");
		$limit = 15;

		$valid_modes = array('add', 'edit', 'delete', 'search', 'bulk_delete'); //valid mode
		if(!in_array($mode, $valid_modes)) $mode = 'add'; //check mode

		$this->data['module'] = 'addons';
		$this->data['sub_module'] = 'subscribers';
		$this->data['segment'] = 'admin/addons/subscribers';
		$this->data['page_header'] = '<h2><i class="fa fa-asterisk"></i>Subscribers <span>subscribers page</span></h2>';
		//breadcrumb
		$this->data['breadcrumb'] = '';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-home"></i> <a href="'.site_url("admin/dashboard").'">Dashboard</a><i class="fa fa-angle-right"></i></li>';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-asterisk"></i> Subscribers</li>';
		//breadcrumb
		$this->data['page'] = array(
							'pageTitle' => "Subscribers Website Settings"
						);
		$this->data['mode'] = $mode;
		$this->data['subscriber_id'] = $id;
		$id = alphaID($id, TRUE);

        //post
		if($_POST) {
		    //bulk delete
			if($mode == 'bulk_delete') {
                $row_sel = $this->input->post("row_sel", TRUE); //post rows
                ajax_bulk_delete('subscribers', $row_sel, $user_type); return; //bulk delete
			} //end bulk delete

			$this->form_validation->set_rules('name', 'Name', 'required|trim');
			if($mode == 'edit') $this->form_validation->set_rules('email', 'E-mail', 'required|trim');
			else $this->form_validation->set_rules('email', 'E-mail', 'required|trim|callback_check_email');
			$this->form_validation->set_rules('status', 'Status', 'required|trim');
			if ($this->form_validation->run() == TRUE) {
				if($user_type != 'demo') {
				    //post data
					$parsed_data['name'] = $this->input->post('name', TRUE);
					$parsed_data['email'] = $this->input->post('email', TRUE);
					$parsed_data['status'] = $this->input->post('status', TRUE);
		
					$comparison_fields = NULL;
					if($mode == 'edit') {
						$comparison_fields['NAME'] = 'ID';
						$comparison_fields['VALUE'] =	$id;		
					}
					$db_status = save_data('subscribers', $parsed_data, $comparison_fields); //save post data
	
					if($db_status) $this->data['error'] = admin_errors(1); //success			
					else $this->data['error'] = admin_errors(2); //saved failed
				}
				else $this->data['error'] = admin_errors(5); //demo user error
			}
			else if(validation_errors()) $this->data['error'] = admin_errors(); //validation errors
		} //post

		//delete
		if($mode == 'delete') {
            ajax_single_delete('subscribers', $id, 'ID', $user_type); return; //single delete
		} //end delete

		//edit
		if($mode == 'edit') {
			$return_data = get_rows(array('ID'=>$id), array('TABLE'=>'subscribers', 'LIMIT'=>1));
			if(isset($return_data['ID'])) $this->data['subscriber_data'] = $return_data;
			else { $this->data['mode'] = 'add'; }
		} //end edit

		$filters = array();
		$sql_properties['TABLE'] = 'subscribers';
		$sql_properties['LIMIT'] = $limit;
		$sql_properties['OFFSET'] = $offset;
		$sql_properties['ORDER_BY'] = 'name';
		$sql_properties['ORDER_TYPE'] = 'asc';
        //search
		if ($mode == 'search') {
			$search_name = $this->input->get("name", TRUE);
			$search_email = $this->input->get("email", TRUE);
			$search_status = $this->input->get("status", TRUE);
			if($search_name) {
				$sql_properties['LIKE'][] = 'subscribers.name';
				$sql_properties['LIKE_VALUE'][] = $search_name;
			}
			if($search_email) {
				$sql_properties['LIKE'][] = 'subscribers.email';
				$sql_properties['LIKE_VALUE'][] = $search_email;
			}
			if($search_status != '') $filters['subscribers.status'] = $search_status;
			$this->data['subscribers'] = get_rows($filters, $sql_properties);
			$total_results = row_counter($filters, $sql_properties);
			$this->data['pagination'] = row_pagination($filters, array('LIMIT'=>$limit, 'TABLE'=>'subscribers', 'SITE_URL'=>'admin/subscribers/manage/search/0/', 'URI_SEGMENT'=>6, 'TOTAL_RESULTS'=>$total_results));
		} //end search
		else {
			$this->data['subscribers'] = get_rows($filters, $sql_properties);
			$this->data['pagination'] = row_pagination($filters, array('LIMIT'=>$limit, 'TABLE'=>'subscribers', 'SITE_URL'=>'admin/subscribers/manage/show/0/', 'URI_SEGMENT'=>6));
		}

		render_page("admin/template", $this->data);
	}

    /**
     * check email
     * 
     * @access public
     * @return boolean
     */
	public function check_email($email)
	{
		$check = get_rows(array('email'=>$email), array('TABLE'=>'subscribers', 'LIMIT'=>1));
		if(isset($check['ID'])) {
			$this->form_validation->set_message('check_email', 'E-mail already is being used. Please try with another E-mail.');
			return FALSE;
		}
		else return TRUE;
	}

    /**
     * status update
     * 
     * @access public (ajax)
     * @return boolean
     */
	public function status_update()
	{
        $ajax = ajax_check(); //Check AJAX
        if(!$ajax) { redirect(site_url("admin/sign-in")); return; }  //if not ajax request

        $user_type = $this->session->userdata("user_type");
		if($user_type != 'demo') $db_status = ajax_single_update("subscribers"); //update
        $result = (isset($db_status) && $db_status) ? 1 : 0; //set result
		ajax_response($result); return; //JSON Response
	}
	
}
/* End of file admin/subscribers.php */
/* Location: ./application/controllers/admin/subscribers.php */