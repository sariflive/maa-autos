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
 * Faqs Controller
 *
 * @subpackage  controllers/admin
 */
class Faqs extends CI_Controller {

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
     * Controller For 'Admin faqs page'
     * 
     * @access public
     * @return redirect manage
     */
	public function index($offset=0)
	{
		redirect(site_url("admin/faqs/manage")); return;
	}

    /**
     * faqs manage (Admin)
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
        $this->data['sub_module'] = 'faqs';
        $this->data['page_js'] = 'faqs';
		$this->data['segment'] = 'admin/addons/faqs';
		$this->data['page_header'] = '<h2><i class="fa fa-asterisk"></i>FAQ</h2>';
        //breadcrumb
		$this->data['breadcrumb'] = '';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-home"></i> <a href="'.site_url("admin/dashboard").'">Dashboard</a><i class="fa fa-angle-right"></i></li>';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-asterisk"></i> FAQs</li>';
		//breadcrumb
		$this->data['page'] = array(
							'pageTitle' => "FAQ"
						);
		$this->data['mode'] = $mode;
		$this->data['faq_id'] = $id;
		$id = alphaID($id, TRUE);

        //post
		if($_POST) {
		    //bulk delete
			if($mode == 'bulk_delete') {
                $row_sel = $this->input->post("row_sel", TRUE); //post rows
                ajax_bulk_delete('widgets', $row_sel, $user_type); return; //bulk delete
			} //end bulk delete

			if($mode == 'edit') $this->form_validation->set_rules('question', 'Question', 'required|trim');
			else $this->form_validation->set_rules('question', 'Question', 'required|trim|callback_check_question');
			$this->form_validation->set_rules('answer', 'Answer', 'required|trim');
			$this->form_validation->set_rules('status', 'Status', 'required|trim');
			if ($this->form_validation->run() == TRUE) {
				if($user_type != 'demo') {
				    //post data
					$parsed_data['question'] = $this->input->post('question', TRUE);
					$parsed_data['answer'] = close_tags($this->input->post('answer', TRUE));
					$parsed_data['status'] = $this->input->post('status', TRUE);

					$comparison_fields = NULL;
					if($mode == 'edit') {
						$comparison_fields['NAME'] = 'ID';
						$comparison_fields['VALUE'] =	$id;		
					}
					$db_status = save_data('faqs', $parsed_data, $comparison_fields); //save post data	
	
					if($db_status) $this->data['error'] = admin_errors(1); //success			
					else $this->data['error'] = admin_errors(2); //saved failed
				}
				else $this->data['error'] = admin_errors(5); //demo user error
			}
			else if(validation_errors()) $this->data['error'] = admin_errors(); //validation errors
		} //end post

		//delete
		if($mode == 'delete') {
            ajax_single_delete('faqs', $id, 'ID', $user_type); return; //single delete
		} //end delete

		//edit
		if($mode == 'edit') {
			$return_data = get_rows(array('ID'=>$id), array('TABLE'=>'faqs', 'LIMIT'=>1));
			if(isset($return_data['ID'])) $this->data['faq_data'] = $return_data;
			else { $this->data['mode'] = 'add'; }
		}//end edit

		$filters = array();
		$sql_properties['TABLE'] = 'faqs';
		$sql_properties['LIMIT'] = $limit;
		$sql_properties['OFFSET'] = $offset;
		$sql_properties['ORDER_BY'] = 'question';
		$sql_properties['ORDER_TYPE'] = 'asc';
        //search
		if ($mode == 'search') {
			$search_question = $this->input->get("question", TRUE);
			$search_status = $this->input->get("status", TRUE);
			if($search_question) {
				$sql_properties['LIKE'][] = 'faqs.question';
				$sql_properties['LIKE_VALUE'][] = $search_question;
			}
			if($search_status != '') $filters['faqs.status'] = $search_status;
			$this->data['faqs'] = get_rows($filters, $sql_properties);
			$total_results = row_counter($filters, $sql_properties);
			$this->data['pagination'] = row_pagination($filters, array('LIMIT'=>$limit, 'TABLE'=>'faqs', 'SITE_URL'=>'admin/faqs/manage/search/0/', 'URI_SEGMENT'=>6, 'TOTAL_RESULTS'=>$total_results));
		} //end search
		else {
			$this->data['faqs'] = get_rows($filters, $sql_properties);
			$this->data['pagination'] = row_pagination($filters, array('LIMIT'=>$limit, 'TABLE'=>'faqs', 'SITE_URL'=>'admin/faqs/manage/show/0/', 'URI_SEGMENT'=>6));
		}

		render_page("admin/template", $this->data);
	}

    /**
     * check question
     * 
     * @access public
     * @return boolean
     */
	public function check_question($question)
	{
		$check = get_rows(array('question'=>$question), array('TABLE'=>'faqs', 'LIMIT'=>1));
		if(isset($check['ID'])) {
			$this->form_validation->set_message('check_question', 'Question already is being used. Please try with another Question.');
			return FALSE;
		}
		else return TRUE;
	}

    /**
     * faqs status update
     * 
     * @access public (ajax)
     * @return boolean
     */
	public function status_update()
	{
        $ajax = ajax_check(); //Check AJAX
        if(!$ajax) { redirect(site_url("admin/sign-in")); return; }  //if not ajax request

		$user_type = $this->session->userdata("user_type");
		if($user_type != 'demo') $db_status = ajax_single_update("faqs"); //update
        $result = (isset($db_status) && $db_status) ? 1 : 0; //set result

        ajax_response($result); return; //JSON Response
	}
	
}
/* End of file admin/faqs.php */
/* Location: ./application/controllers/admin/faqs.php */