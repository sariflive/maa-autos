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
 * Menu Builder Controller
 *
 * @subpackage  controllers/admin
 */
class Menu_builder extends CI_Controller {

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
     * Controller For 'Admin menu builder page'
     * 
     * @access public
     * @return redirect manage
     */
	public function index()
	{
		redirect(site_url("admin/menu_builder/menulist")); return;
	}

    /**
     * menu list (Admin)
     * 
     * @access public
     * @param $offset (integer)
     * @return type View
     */
	public function menulist($offset=0)
	{
		$limit = 15;
		$filters = array();

		$this->data['module'] = 'website-pages';
		$this->data['sub_module'] = 'menu-builder';
		$this->data['segment'] = 'admin/website-pages/menu-builder/menu-builders';
		$this->data['page_header'] = '<h2><i class="fa fa-asterisk"></i>Menu List <span>menu list page</span></h2>';
		//breadcrumb
		$this->data['breadcrumb'] = '';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-home"></i> <a href="'.site_url("admin/dashboard").'">Dashboard</a><i class="fa fa-angle-right"></i></li>';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-asterisk"></i> Menu List</li>';
		//breadcrumb
		$this->data['page'] = array(
							'pageTitle' => "Menu List"
						);

		$this->data['menus'] = get_rows($filters, array('TABLE'=>'menu', 'LIMIT'=>$limit, 'OFFSET'=>$offset, 'ORDER_BY'=>'name', 'ORDER_TYPE'=>'asc'));
		$this->data['pagination'] = row_pagination($filters, array('LIMIT'=>$limit, 'TABLE'=>'menu', 'SITE_URL'=>'admin/menu_builder/menulist/', 'URI_SEGMENT'=>4));
		render_page("admin/template", $this->data);
	}

    /**
     * menu builder manage (Admin)
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

		$this->data['show_menu_js'] = TRUE;
		$this->data['module'] = 'website-pages';
		$this->data['sub_module'] = 'menu-builder';
		$this->data['segment'] = 'admin/website-pages/menu-builder/manage-menu';
		$this->data['page_header'] = '<h2><i class="fa fa-asterisk"></i>Manage Menu <span>manage menu builder</span></h2>';
		//breadcrumb
		$this->data['breadcrumb'] = '';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-home"></i> <a href="'.site_url("admin/dashboard").'">Dashboard</a><i class="fa fa-angle-right"></i></li>';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-asterisk"></i> Manage Menu</li>';
		//breadcrumb
		$this->data['page'] = array(
							'pageTitle' => "Manage Menu"
						);
		$this->data['mode'] = $mode;
		$this->data['menu_id'] = $id;
		$id = alphaID($id, TRUE);

        //post
		if($_POST) {
		    //bulk delete
			if($mode == 'bulk_delete') {
                $row_sel = $this->input->post("row_sel", TRUE); //post rows
                ajax_bulk_delete('menu', $row_sel, $user_type); return; //bulk delete
			} //end bulk delete

			($mode == 'edit') ? $form_validation = "menu_builder_edit" : $form_validation = "menu_builder";
			if ($this->form_validation->run($form_validation) == TRUE) {
				if($user_type != 'demo') {
				    //post data
					$parsed_data['name'] = $this->input->post('name', TRUE);
					$parsed_data['content'] = $this->input->post('content', TRUE); 
					$parsed_data['menu_class'] = $this->input->post('menuclass', TRUE); 
					$parsed_data['menu_id'] = $this->input->post('menuid', TRUE); 
					$parsed_data['status'] = $this->input->post('status', TRUE);

					$comparison_fields = NULL;
					if($mode == 'edit') {
						$comparison_fields['NAME'] = 'ID';
						$comparison_fields['VALUE'] =	$id;		
					}
					$db_status = save_data('menu', $parsed_data, $comparison_fields); //save post data	

					if($db_status) $this->data['error'] = admin_errors(1); //success			
					else $this->data['error'] = admin_errors(2); //saved failed
				}
				else $this->data['error'] = admin_errors(5); //demo user error
			}
			else if(validation_errors()) $this->data['error'] = admin_errors(); //validation errors
		}

        //delete
		if($mode == 'delete') {
            ajax_single_delete('menu', $id, 'ID', $user_type); return; //single delete
		} //end delete

		//edit
		if($mode == 'edit') {
			$return_data = get_rows(array('ID'=>$id), array('TABLE'=>'menu', 'LIMIT'=>1));
			if(isset($return_data['ID'])) $this->data['menu'] = $return_data;
			else { $this->data['mode'] = 'add'; }
		} //end edit

		$filters = array();
		$sql_properties['TABLE'] = 'menu';
		$sql_properties['LIMIT'] = $limit;
		$sql_properties['OFFSET'] = $offset;
		$sql_properties['ORDER_BY'] = 'name';
		$sql_properties['ORDER_TYPE'] = 'asc';
        //search
		if ($mode == 'search') {
			$this->data['segment'] = 'admin/website-pages/menu-builder/menu-builders';

			$search_name = $this->input->get("name", TRUE);
			$search_class = $this->input->get("class", TRUE);
			$search_id = $this->input->get("id", TRUE);
			$search_status = $this->input->get("status", TRUE);
			if($search_name) {
				$sql_properties['LIKE'][] = 'menu.name';
				$sql_properties['LIKE_VALUE'][] = $search_name;
			}
			if($search_class) {
				$sql_properties['LIKE'][] = 'menu.menu_class';
				$sql_properties['LIKE_VALUE'][] = $search_class;
			}
			if($search_id) {
				$sql_properties['LIKE'][] = 'menu.menu_id';
				$sql_properties['LIKE_VALUE'][] = $search_id;
			}
			if($search_status != '') $filters['menu.status'] = $search_status;
			$this->data['menus'] = get_rows($filters, $sql_properties);
			$total_results = row_counter($filters, $sql_properties);
			$this->data['pagination'] = row_pagination($filters, array('LIMIT'=>$limit, 'TABLE'=>'menu', 'SITE_URL'=>'admin/menu_builder/manage/search/0/', 'URI_SEGMENT'=>6, 'TOTAL_RESULTS'=>$total_results));
		} //end search

		render_page("admin/template", $this->data);
	}

    /**
     * check name
     * 
     * @access public
     * @return boolean
     */
	public function check_name($name)
	{
		$check = get_rows(array('name'=>$name), array('TABLE'=>'menu', 'LIMIT'=>1));
		if(isset($check['ID'])) {
			$this->form_validation->set_message('check_name', 'Name already is being used. Please try with another Name.');
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
		if($user_type != 'demo') $db_status = ajax_single_update("menu"); //update
        $result = (isset($db_status) && $db_status) ? 1 : 0; //set result

		ajax_response($result); return; //JSON Response
	}

}
/* End of file admin/menu_builder.php */
/* Location: ./application/controllers/admin/menu_builder.php */