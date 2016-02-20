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
 * Widgets Controller
 *
 * @subpackage  controllers/admin
 */
class Widgets extends CI_Controller {

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
     * Controller For 'Admin widgets Page'
     * @access public
     * @return redirect widgetslist
     */
	public function index()
	{
		redirect(site_url("admin/widgets/widgetslist")); return;
	}

    /**
     * widgets list (Admin)
     * 
     * @access public
     * @param $offset (integer)
     * @return type View
     */
	public function widgetslist($offset=0)
	{
		$limit = 15;
		$filters = array();

		$this->data['module'] = 'website-pages';
		$this->data['sub_module'] = 'widgets';
		$this->data['sub_sub_module'] = 'widgetslist';
		$this->data['segment'] = 'admin/website-pages/widgets/widgets';
		$this->data['page_header'] = '<h2><i class="fa fa-asterisk"></i>Widgets List <span>widgets list page</span></h2>';
		//breadcrumb
		$this->data['breadcrumb'] = '';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-home"></i> <a href="'.site_url("admin/dashboard").'">Dashboard</a><i class="fa fa-angle-right"></i></li>';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-asterisk"></i> Widgets List</li>';
		//breadcrumb
		$this->data['page'] = array(
							'pageTitle' => "Widgets List"
						);

		$this->data['widgets'] = get_rows($filters, array('TABLE'=>'widgets', 'LIMIT'=>$limit, 'OFFSET'=>$offset, 'ORDER_BY'=>'title', 'ORDER_TYPE'=>'asc'));
		$this->data['pagination'] = row_pagination($filters, array('LIMIT'=>$limit, 'TABLE'=>'widgets', 'SITE_URL'=>'admin/widgets/widgetslist/', 'URI_SEGMENT'=>4));
		render_page("admin/template", $this->data);
	}

    /**
     * widget manage (Admin)
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

        $this->data['page_js'] = 'manage-widget';
		$this->data['module'] = 'website-pages';
		$this->data['sub_module'] = 'widgets';
		$this->data['sub_sub_module'] = 'widget-manage';
		$this->data['segment'] = 'admin/website-pages/widgets/manage-widget';
		$this->data['page_header'] = '<h2><i class="fa fa-asterisk"></i>Manage Widget <span>manage page</span></h2>';
		//breadcrumb
		$this->data['breadcrumb'] = '';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-home"></i> <a href="'.site_url("admin/dashboard").'">Dashboard</a><i class="fa fa-angle-right"></i></li>';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-asterisk"></i> Manage Widget</li>';
		//breadcrumb
		$this->data['page'] = array(
							'pageTitle' => "Manage Page"
						);
		$this->data['mode'] = $mode;
		$this->data['widget_id'] = $id;
		$id = alphaID($id, TRUE);

        //post
		if($_POST) {
		    //bulk delete
			if($mode == 'bulk_delete') {
                $row_sel = $this->input->post("row_sel", TRUE); //post rows
			    ajax_bulk_delete('widgets', $row_sel, $user_type); return; //bulk delete
			} //end bulk delete

			($mode == 'edit') ? $form_validation = "widgets_edit" : $form_validation = "widgets";
			if ($this->form_validation->run($form_validation) == TRUE) {
				if($user_type != 'demo') {
				    //post data
					$parsed_data['widget'] = $this->input->post('widget', TRUE);
					$parsed_data['title'] = $this->input->post('title', TRUE);
					$parsed_data['section_id'] = str_replace(' ', '_', strtolower($parsed_data['widget']));
					if($mode == 'add') {
						$check_section = get_rows(array('section_id'=>$parsed_data['section_id']), array('TABLE'=>'widgets', 'LIMIT'=>1));
						if(isset($check_section['ID'])) $parsed_data['section_id'] = $parsed_data['section_id'].'1';
					}
					$parsed_data['description'] = close_tags($this->input->post('description', TRUE));
					$parsed_data['status'] = $this->input->post('status', TRUE);
					$parsed_data['image'] = $this->input->post('image', TRUE);
	
					$comparison_fields = NULL;
					if($mode == 'edit') {
						$comparison_fields['NAME'] = 'ID';
						$comparison_fields['VALUE'] =	$id;		
					}
					$db_status = save_data('widgets', $parsed_data, $comparison_fields); //save post data
	
					if($db_status) $this->data['error'] = admin_errors(1); //success			
					else $this->data['error'] = admin_errors(2); //saved failed
				}
				else $this->data['error'] = admin_errors(5); //demo user error
			}
			else if(validation_errors()) $this->data['error'] = admin_errors(); //validation errors
		}

        //delete
		if($mode == 'delete') {
		    ajax_single_delete('widgets', $id, 'ID', $user_type); return; //single delete
		} //end delete

		//edit
		if($mode == 'edit') {
			$return_data = get_rows(array('ID'=>$id), array('TABLE'=>'widgets', 'LIMIT'=>1));
			if(isset($return_data['ID'])) $this->data['widget_data'] = $return_data;
			else { $this->data['mode'] = 'add'; }
		} //end edit

		$filters = array();
		$sql_properties['TABLE'] = 'widgets';
		$sql_properties['LIMIT'] = $limit;
		$sql_properties['OFFSET'] = $offset;
		$sql_properties['ORDER_BY'] = 'title';
		$sql_properties['ORDER_TYPE'] = 'asc';
        //search
		if ($mode == 'search') {
			$this->data['segment'] = 'admin/website-pages/widgets/widgets';

			$search_widget = $this->input->get("widget", TRUE);
			$search_title = $this->input->get("title", TRUE);
			$search_status = $this->input->get("status", TRUE);
			if($search_widget) {
				$sql_properties['LIKE'][] = 'widgets.widget';
				$sql_properties['LIKE_VALUE'][] = $search_widget;
			}
			if($search_title) {
				$sql_properties['LIKE'][] = 'widgets.title';
				$sql_properties['LIKE_VALUE'][] = $search_title;
			}
			if($search_status != '') $filters['widgets.status'] = $search_status;
			$this->data['widgets'] = get_rows($filters, $sql_properties);
			$total_results = row_counter($filters, $sql_properties);
			$this->data['pagination'] = row_pagination($filters, array('LIMIT'=>$limit, 'TABLE'=>'widgets', 'SITE_URL'=>'admin/widgets/manage/search/0/', 'URI_SEGMENT'=>6, 'TOTAL_RESULTS'=>$total_results));
		} //end search

		render_page("admin/template", $this->data);
	}

    /**
     * check widget
     * 
     * @access public
     * @return boolean
     */
	public function check_widget($widget)
	{
		$check = get_rows(array('widget'=>$widget), array('TABLE'=>'widgets', 'LIMIT'=>1));
		if(isset($check['ID'])) {
			$this->form_validation->set_message('check_widget', 'Widget already is being used. Please try with another Widget.');
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
		if($user_type != 'demo') $db_status = ajax_single_update("widgets"); //update
        $result = (isset($db_status) && $db_status) ? 1 : 0; //set result

		ajax_response($result); return; //JSON Response
	}
}
/* End of file admin/widgets.php */
/* Location: ./application/controllers/admin/widgets.php */