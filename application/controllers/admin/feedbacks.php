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
 * Feedbacks Controller
 *
 * @subpackage  controllers/admin
 */
class Feedbacks extends CI_Controller {

    public $data = array();    // Included view data array;

	function __construct()
	{
        // Call the Controller constructor
		parent::__construct();
		$this->load->model('admin/signin_model');
		$this->load->helper(array("admin", "form"));
		$this->signin_model->auth_user();
		$this->config->load_db_items();
	}

    /**
     * Controller For 'Admin feedbacks page'
     * 
     * @access public
     * @return redirect manage
     */
	public function index()
	{
		redirect(site_url("admin/feedbacks/feedbackslist")); return;
	}

    /**
     * feedbacks list (Admin)
     * 
     * @access public
     * @param $offset (integer)
     * @return type View
     */
	public function feedbackslist($offset=0)
	{
		$limit = 15;

		$this->data['module'] = 'addons';
		$this->data['sub_module'] = 'feedbacks';
		$this->data['segment'] = 'admin/addons/feedbacks/feedbacks';
		$this->data['page_header'] = '<h2><i class="fa fa-asterisk"></i>Feedbacks List <span>feedbacks list page</span></h2>';
		$this->data['breadcrumb'] = '';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-home"></i> <a href="'.site_url("admin/dashboard").'">Dashboard</a><i class="fa fa-angle-right"></i></li>';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-asterisk"></i> Feedbacks</li>';
		$this->data['page'] = array(
							'pageTitle' => "Feedbacks List"
						);

		$filters = array();
		$this->data['feedbacks'] = get_rows($filters, array('TABLE'=>'feedbacks', 'LIMIT'=>$limit, 'OFFSET'=>$offset, 'ORDER_BY'=>'ID', 'ORDER_TYPE'=>'desc'));
		$this->data['pagination'] = row_pagination($filters, array('LIMIT'=>$limit, 'TABLE'=>'feedbacks', 'SITE_URL'=>'admin/feedbacks/feedbackslist/', 'URI_SEGMENT'=>4));
		render_page("admin/template", $this->data);
	}

    /**
     * feedback manage (Admin)
     *
     * @access public
     * @param $mode
     * @param $id (alphaID)
     * @param $offset
     * @return mixed
     */
	public function manage($mode='reply', $id=0, $offset=0)
	{
		$user_type = $this->session->userdata("user_type");

		$valid_modes = array('reply', 'delete', 'search', 'bulk_delete', 'view'); //valid modes
		if(!in_array($mode, $valid_modes)) $mode = 'add'; //check mode

		$this->data['module'] = 'addons';
		$this->data['sub_module'] = 'feedbacks';
		$this->data['segment'] = 'admin/addons/feedbacks/feedbacks';
		$this->data['page_header'] = '<h2><i class="fa fa-asterisk"></i>Feedbacks List</h2>';
        //breadcrumb
		$this->data['breadcrumb'] = '';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-home"></i> <a href="'.site_url("admin/dashboard").'">Dashboard</a><i class="fa fa-angle-right"></i></li>';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-asterisk"></i> Feedbacks</li>';
		//breadcrumb
		$this->data['page'] = array(
							'pageTitle' => "Feedbacks List"
						);
		$this->data['feedback_id'] = $id;
		$id = alphaID($id, TRUE);

        //post
		if($_POST) {
			if($mode == 'bulk_delete') {
                $row_sel = $this->input->post("row_sel", TRUE); //post rows
                ajax_bulk_delete('feedbacks', $row_sel, $user_type); return; //bulk delete
			}
		} //end post

		//reply
		if($mode == 'reply') {
            $this->data['page_js'] = 'reply-feedback';
			$this->data['segment'] = 'admin/addons/feedbacks/reply-feedback';

            //post
			if($_POST) {
				if ($this->form_validation->run('feedback_reply') == TRUE) {
					if($user_type != 'demo') {
						$db_status = $this->feedback_library->reply_feedback($feedback_id); //reply feedback
	
						if($db_status) $this->data['error'] = admin_errors(1, '<strong>Congratulations!</strong> Your reply send successfully!'); //success		
						else $this->data['error'] = admin_errors(2, '<strong>Notice!</strong> Mail send failed, Please try again.'); //notice
					}
					else $this->data['error'] = admin_errors(5); //demo user error
				}
				else if(validation_errors()) $this->data['error'] = admin_errors(); //validation errors
			} //end post
			
			$this->data['feedback'] = get_rows(array('ID'=>$id), array('TABLE'=>'feedbacks', 'LIMIT'=>1));
		} //end reply

		//view
		if($mode == 'view') {
			$this->data['segment'] = 'admin/addons/feedbacks/view-feedback';
			$this->data['feedback'] = get_rows(array('ID'=>$id), array('TABLE'=>'feedbacks', 'LIMIT'=>1));
		} //end view

		//delete
		if($mode == 'delete') {
            ajax_single_delete('feedbacks', $id, 'ID', $user_type); return; //single delete
		} //end delete

		//search
		if($mode == 'search') {
			$filters = array();
			$sql_properties['TABLE'] = 'feedbacks';
			$sql_properties['LIMIT'] = 15;
			$sql_properties['OFFSET'] = $offset;
			$sql_properties['ORDER_BY'] = 'ID';
			$sql_properties['ORDER_TYPE'] = 'desc';

			$search_name = $this->input->get("name", TRUE);
			$search_email = $this->input->get("email", TRUE);
			$search_subject = $this->input->get("subject", TRUE);
			$search_date = $this->input->get("date", TRUE);
			if($search_name) {
				$sql_properties['LIKE'][] = 'name';
				$sql_properties['LIKE_VALUE'][] = $search_name;
			}
			if($search_subject) {
				$sql_properties['LIKE'][] = 'subject';
				$sql_properties['LIKE_VALUE'][] = $search_subject;
			}
			if($search_date) {
				$sql_properties['LIKE'][] = 'date_timestamp';
				$sql_properties['LIKE_VALUE'][] = $search_date;
			}
			if($search_email != '') $filters['email'] = $search_email;
			$this->data['feedbacks'] = get_rows($filters, $sql_properties);
			$total_results = row_counter($filters, $sql_properties);
			$this->data['pagination'] = row_pagination($filters, array('LIMIT'=>15, 'TABLE'=>'feedbacks', 'SITE_URL'=>'admin/feedbacks/manage/search/0/', 'URI_SEGMENT'=>6, 'TOTAL_RESULTS'=>$total_results));
		} //end search

		render_page("admin/template", $this->data);
	}

    /**
     * feedbacks status update
     * 
     * @access public (ajax)
     * @return boolean
     */
	public function status_update()
	{
        $ajax = ajax_check(); //Check AJAX
        if(!$ajax) { redirect(site_url("admin/sign-in")); return; }  //if not ajax request

        $user_type = $this->session->userdata("user_type");
		if($user_type != 'demo') $db_status = ajax_single_update("feedbacks"); //update
        $result = (isset($db_status) && $db_status) ? 1 : 0; //set result

		ajax_response($result); return; //JSON Response
	}

}
/* End of file admin/feedbacks.php */
/* Location: ./application/controllers/admin/feedbacks.php */