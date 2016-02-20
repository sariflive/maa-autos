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
 * Settings Controller
 *
 * @subpackage  controllers/admin
 */
class Settings extends CI_Controller {

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
     * Controller For 'Admin settings page'
     * 
     * @access public
     * @return redirect config
     */
	public function index()
	{
		redirect(site_url("admin/settings/config")); return;
	}

    /**
     * configration list (Admin)
     * 
     * @access public
     * @param $offset (integer)
     * @return type View
     */
	public function config()
	{
		$this->data['module'] = 'settings';
        $this->data['sub_module'] = 'config';
        $this->data['page_js'] = 'config';
		$this->data['segment'] = 'admin/settings/config';
		$this->data['page_header'] = '<h2><i class="fa fa-asterisk"></i>Configaration <span>configaration page</span></h2>';
		//breadcrumb
		$this->data['breadcrumb'] = '';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-home"></i> <a href="'.site_url("admin/dashboard").'">Dashboard</a><i class="fa fa-angle-right"></i></li>';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-asterisk"></i> Configaration</li>';
		//breadcrumb
		$this->data['page'] = array(
							'pageTitle' => "Configaration Settings"
						);

		$this->data['configs'] = get_enum_values('config', 'group');
		render_page("admin/template", $this->data);
	}

    /**
     * config manage (Admin)
     * 
     * @access public (ajax)
     * @param $offset (integer)
     * @return mixed
     */
	public function config_manage()
	{
        $ajax = ajax_check(); //Check AJAX
        if(!$ajax || !$table || !$id) { redirect(site_url("admin/sign-in")); return; }  //if not ajax request or table or ID

		$user_type = $this->session->userdata("user_type");
		$json['error'] = '';

		if ($this->form_validation->run('config') == TRUE) {
			if($user_type != 'demo') {
				$parsed_data['group'] = $this->input->post('group', TRUE);
				$parsed_data['option'] = strtolower(str_replace(' ', '_', $this->input->post('option', TRUE))); 
				$parsed_data['value'] = $this->input->post('value', TRUE); 
				$parsed_data['read'] = 1; 
				$parsed_data['write'] = 1; 
				$parsed_data['delete'] = 1;
				$db_status = save_data('config', $parsed_data); //save post data
				if($db_status) $json['error'] = "<div class=\"alert alert-success\"><button class=\"close\" data-dismiss=\"alert\" type=\"button\"><span aria-hidden=\"true\">&times;</span></button><strong>Success!</strong> Your form was submitted and information saved successfully!</div>"; //success		
				else $json['error'] = '<div class="alert alert-warning"><button class="close" data-dismiss="alert" type="button"><span aria-hidden=\"true\">&times;</span></button><strong>Notice! Saved failed.</strong></div>'; //notice
			}
			else $json['error'] = admin_errors(5); //demo user
		}
		else if(validation_errors()) $json['error'] = '<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button"><span aria-hidden=\"true\">&times;</span></button><strong>Error! </strong> <br />'. validation_errors() .'</div>'; //validation errors

        ajax_response($json); return; //JSON Response
	}

    /**
     * check option
     * 
     * @access public
     * @return boolean
     */
	public function check_option($option)
	{
		$check = get_rows(array('option'=>$option), array('TABLE'=>'config', 'LIMIT'=>1));
		if(isset($check['ID'])) {
			$this->form_validation->set_message('check_option', 'Option already is being used. Please try with another Option.');
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
	public function config_ajax_update()
	{
        $ajax = ajax_check(); //Check AJAX
        if(!$ajax) { redirect(site_url("admin/sign-in")); return; }  //if not ajax request

		$user_type = $this->session->userdata("user_type");
		if($user_type != 'demo') $db_status = ajax_single_update("config"); //update
		$result = (isset($db_status) && $db_status) ? 1 : 0; //set result

        ajax_response($result); return; //JSON Response
	}

    /**
     * delete config
     * 
     * @access public (ajax)
     * @return boolean
     */
	public function config_delete($id = 0)
	{
        $ajax = ajax_check(); //Check AJAX
        if(!$ajax) { redirect(site_url("admin/sign-in")); return; }  //if not ajax request

		$user_type = $this->session->userdata("user_type");
		$delete_status = 0;

		if($user_type != 'demo') {
			$config_id = alphaID($id, TRUE);
			if($config_id != '') {
				$config = get_rows(array('ID'=>$config_id), array('TABLE'=>'config', 'LIMIT'=>1));
				$delete = (isset($config['delete'])) ? $config['delete'] : 0;
				if($delete == 1) {
					$comparison_fields['NAME'] = 'ID';
					$comparison_fields['VALUE'] = $config_id;
					$delete_status = delete_rows('config', $comparison_fields);
				}
			}
		}

        $result = ($delete_status) ? 1 : 0;
        ajax_response($result); return; //JSON Response
	}

    /**
     * addons page (Admin)
     *
     * @access public
     * @param $mode
     * @param $id (alphaID)
     * @param $offset
     * @return mixed
     */
	public function addons($mode='add', $id=0, $offset=0)
	{
		$user_type = $this->session->userdata("user_type");
		$limit = 15;

		$valid_modes = array('add', 'edit', 'delete', 'search', 'bulk_delete'); //valid mode
		if(!in_array($mode, $valid_modes)) $mode = 'add'; //check mode

		$this->data['module'] = 'settings';
		$this->data['offset'] = $offset;
		$this->data['sub_module'] = 'addons';
		$this->data['segment'] = 'admin/settings/addons';
		$this->data['page_header'] = '<h2><i class="fa fa-asterisk"></i>Addons <span>addons page</span></h2>';
		//breadcrumb
		$this->data['breadcrumb'] = '';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-home"></i> <a href="'.site_url("admin/dashboard").'">Dashboard</a><i class="fa fa-angle-right"></i></li>';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-asterisk"></i> Addons</li>';
		//breadcrumb
		$this->data['page'] = array(
							'pageTitle' => "Addons"
						);
		$this->data['mode'] = $mode;
		$this->data['addon_id'] = $id;
		$id = alphaID($id, TRUE);

        //post
		if($_POST) {
		    //bulk delete
			if($mode == 'bulk_delete') {
                $row_sel = $this->input->post("row_sel", TRUE); //post rows
                ajax_bulk_delete('addons', $row_sel, $user_type); return; //bulk delete
			} //end bulk delete

			if($mode == 'edit') $this->form_validation->set_rules('addon', 'Addon', 'required|trim');
			else $this->form_validation->set_rules('addon', 'Addon', 'required|trim|callback_check_addon');
			$this->form_validation->set_rules('group', 'Group', 'required|trim');
			$this->form_validation->set_rules('status', 'Status', 'required|trim');
			if ($this->form_validation->run() == TRUE) {
				if($user_type != 'demo') {
				    //post data
					$parsed_data['addon'] = $this->input->post('addon', TRUE);
					$parsed_data['group'] = $this->input->post('group', TRUE);
					$parsed_data['description'] = $this->input->post('description', TRUE);
					$parsed_data['status'] = $this->input->post('status', TRUE);

					$comparison_fields = NULL;
					if($mode == 'edit') {
						$comparison_fields['NAME'] = 'ID';
						$comparison_fields['VALUE'] =	$id;		
					}
					$db_status = save_data('addons', $parsed_data, $comparison_fields); //save post data
		
					if($db_status) $this->data['error'] = admin_errors(1); //success			
					else $this->data['error'] = admin_errors(2); //saved failed
				}
				else $this->data['error'] = admin_errors(5); //demo user error
			}
			else if(validation_errors()) $this->data['error'] = admin_errors(); //validation errors
		} //end post

		//delete
		if($mode == 'delete') {
            ajax_single_delete('addons', $id, 'ID', $user_type); return; //single delete
		} //end delete

		//edit
		if($mode == 'edit') {
			$return_data = get_rows(array('ID'=>$id), array('TABLE'=>'addons', 'LIMIT'=>1));
			if(isset($return_data['ID'])) $this->data['addon_data'] = $return_data;
			else { $this->data['mode'] = 'add'; }
		} //end edit

		//search
		if ($mode == 'search') {
			$search_addon = $this->input->get("addon", TRUE);
			$search_group = $this->input->get("group", TRUE);
			$search_status = $this->input->get("status", TRUE);
			$sql_properties['TABLE'] = 'addons';
			$sql_properties['LIMIT'] = $limit;
			$sql_properties['OFFSET'] = $offset;
			$sql_properties['ORDER_BY'] = 'addon';
			$sql_properties['ORDER_TYPE'] = 'asc';
			if($search_addon) {
				$sql_properties['LIKE'][] = 'addon';
				$sql_properties['LIKE_VALUE'][] = $search_addon;
			}
			if($search_group) {
				$sql_properties['LIKE'][] = 'group';
				$sql_properties['LIKE_VALUE'][] = $search_group;
			}
			if($search_status != '') $filters = array('status'=>$search_status);
			else $filters = array();
			$this->data['addons'] = get_rows($filters, $sql_properties);
			$total_results = row_counter($filters, $sql_properties);
			$this->data['pagination'] = row_pagination(array(), array('LIMIT'=>$limit, 'TABLE'=>'addons', 'SITE_URL'=>'admin/settings/addons/search/0/', 'URI_SEGMENT'=>6, 'TOTAL_RESULTS'=>$total_results));
		} //end search
		else {
			$this->data['addons'] = get_rows(array(), array('TABLE'=>'addons', 'LIMIT'=>$limit, 'OFFSET'=>$offset, 'ORDER_BY'=>'addon', 'ORDER_TYPE'=>'asc'));
			$this->data['pagination'] = row_pagination(array(), array('LIMIT'=>$limit, 'TABLE'=>'addons', 'SITE_URL'=>'admin/settings/addons/show/0/', 'URI_SEGMENT'=>6));
		}

		render_page("admin/template", $this->data);
	}

    /**
     * check addon
     * 
     * @access public
     * @return boolean
     */
	public function check_addon($addon)
	{
		$check = get_rows(array('addon'=>$addon), array('TABLE'=>'addons', 'LIMIT'=>1));
		if(isset($check['ID'])) {
			$this->form_validation->set_message('check_addon', 'Addon already is being used. Please try with another Addon.');
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
	public function addons_status_update()
	{
        $ajax = ajax_check(); //Check AJAX
        if(!$ajax) { redirect(site_url("admin/sign-in")); return; }  //if not ajax request

        $user_type = $this->session->userdata("user_type");
		if($user_type != 'demo') $db_status = ajax_single_update("addons"); //update
        $result = (isset($db_status) && $db_status) ? 1 : 0; //set result

		ajax_response($result); return; //JSON Response
	}

    /**
     * languages manage (Admin)
     *
     * @access public
     * @param $mode
     * @param $id (alphaID)
     * @param $offset
     * @return mixed
     */
	public function languages($mode='add', $id=0, $offset=0)
	{
		$user_type = $this->session->userdata("user_type");
		$limit = 15;

		$valid_modes = array('add', 'edit', 'delete', 'search', 'bulk_delete'); //valid mode
		if(!in_array($mode, $valid_modes)) $mode = 'add'; //check mode

		$this->data['module'] = 'settings';
		$this->data['sub_module'] = 'languages';
		$this->data['segment'] = 'admin/settings/languages';
		$this->data['page_header'] = '<h2><i class="fa fa-asterisk"></i>Languages <span>languages page</span></h2>';
		//breadcrumb
		$this->data['breadcrumb'] = '';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-home"></i> <a href="'.site_url("admin/dashboard").'">Dashboard</a><i class="fa fa-angle-right"></i></li>';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-asterisk"></i> Languages</li>';
		//breadcrumb
		$this->data['page'] = array(
							'pageTitle' => "Languages"
						);
		$this->data['mode'] = $mode;
		$this->data['language_id'] = $id;
		$id = alphaID($id, TRUE);

        //post
		if($_POST) {
		    //bulk delete
			if($mode == 'bulk_delete') {
                $row_sel = $this->input->post("row_sel", TRUE); //post rows
                ajax_bulk_delete('languages', $row_sel, $user_type); return; //bulk delete
			} //end bulk delete

			if($mode == 'edit') $this->form_validation->set_rules('language', 'Language', 'required|trim');
			else $this->form_validation->set_rules('language', 'Language', 'required|trim|callback_check_language');
			$this->form_validation->set_rules('lang', 'Lang', 'required|trim');
			$this->form_validation->set_rules('direction', 'Direction', 'required|trim');
			$this->form_validation->set_rules('status', 'Status', 'required|trim');
			if ($this->form_validation->run() == TRUE) {
				if($user_type != 'demo') {
				    //post data
					$parsed_data['language'] = $this->input->post('language', TRUE);
					$parsed_data['lang'] = $this->input->post('lang', TRUE);
					$parsed_data['direction'] = $this->input->post('direction', TRUE);
					$parsed_data['status'] = $this->input->post('status', TRUE);
		
					$comparison_fields = NULL;
					if($mode == 'edit') {
						$comparison_fields['NAME'] = 'ID';
						$comparison_fields['VALUE'] =	$id;		
					}
					$db_status = save_data('languages', $parsed_data, $comparison_fields); //save post data
		
					if($db_status) $this->data['error'] = admin_errors(1); //success			
					else $this->data['error'] = admin_errors(2); //saved failed
				}
				else $this->data['error'] = admin_errors(5); //demo user error
			}
			else if(validation_errors()) $this->data['error'] = admin_errors(); //validation errors
		} //end post

		//delete
		if($mode == 'delete') {
            ajax_single_delete('languages', $id, 'ID', $user_type); return; //single delete
		} //end delete

		//edit
		if($mode == 'edit') {
			$return_data = get_rows(array('ID'=>$id), array('TABLE'=>'languages', 'LIMIT'=>1));
			if(isset($return_data['ID'])) $this->data['language_data'] = $return_data;
			else { $this->data['mode'] = 'add'; }
		} //end edit

		$this->data['languages'] = get_rows(array(), array('TABLE'=>'languages', 'LIMIT'=>$limit, 'OFFSET'=>$offset, 'ORDER_BY'=>'language', 'ORDER_TYPE'=>'asc'));
		$this->data['pagination'] = row_pagination(array(), array('LIMIT'=>$limit, 'TABLE'=>'languages', 'SITE_URL'=>'admin/settings/languages/show/0/', 'URI_SEGMENT'=>6));

		render_page("admin/template", $this->data);
	}

    /**
     * check language
     * 
     * @access public
     * @return boolean
     */
	public function check_language($language)
	{
		$check = get_rows(array('language'=>$language), array('TABLE'=>'languages', 'LIMIT'=>1));
		if(isset($check['ID'])) {
			$this->form_validation->set_message('check_language', 'Language already is being used. Please try with another Language.');
			return FALSE;
		}
		else return TRUE;
	}

    /**
     * language status update
     * 
     * @access public (ajax)
     * @return boolean
     */
	public function language_status_update()
	{
        $ajax = ajax_check(); //Check AJAX
        if(!$ajax) { redirect(site_url("admin/sign-in")); return; }  //if not ajax request

        $user_type = $this->session->userdata("user_type");
		if($user_type != 'demo') $db_status = ajax_single_update("languages"); //update
        $result = (isset($db_status) && $db_status) ? 1 : 0; //set result

		ajax_response($result); return; //JSON Response
	}

}
/* End of file admin/settings.php */
/* Location: ./application/controllers/admin/settings.php */