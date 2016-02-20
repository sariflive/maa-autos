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
 * Color Controller
 *
 * @subpackage  controllers/admin
 */
class Color extends CI_Controller {

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
     * Controller For 'Admin color Page'
     * 
     * @access public
     * @return redirect manage
     */
	public function index($offset=0)
	{
		redirect(site_url("admin/color/manage")); return;
	}

    /**
     * Color Manage (Admin)
     *
     * @access public
     * @param $mode
     * @param $id (alphaID)
     * @return mixed
     */
	public function manage($mode='add', $id=0, $offset=0) {
		$user_type = $this->session->userdata("user_type");
		$limit = 15;

		$valid_modes = array('add', 'edit', 'delete', 'search', 'bulk_delete'); //valid mode
		if(!in_array($mode, $valid_modes)) $mode = 'add'; //check mode

		$this->data['module'] = 'website-settings';
		$this->data['sub_module'] = 'color';
		$this->data['segment'] = 'admin/website-settings/color';
		$this->data['page_header'] = '<h2><i class="fa fa-asterisk"></i>Color</h2>';
        //breadcrumb
		$this->data['breadcrumb'] = '';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-home"></i> <a href="'.site_url("admin/dashboard").'">Dashboard</a><i class="fa fa-angle-right"></i></li>';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-asterisk"></i> Color</li>';
		//end breadcrumb
		$this->data['page'] = array(
							     'pageTitle' => "Color Website Settings"
						      );
		$this->data['mode'] = $mode;
		$this->data['color_id'] = $id;
		$id = alphaID($id, TRUE);

		if($_POST) {
		    //bulk delete
			if($mode == 'bulk_delete') {
                $row_sel = $this->input->post("row_sel", TRUE); //post rows
                ajax_bulk_delete('color', $row_sel, $user_type); return; //bulk delete
			} //end bulk delete

			if($mode == 'edit') $this->form_validation->set_rules('color', 'Color', 'required|trim');
			else $this->form_validation->set_rules('color', 'Color', 'required|trim|callback_check_color');
			if($mode == 'edit') $this->form_validation->set_rules('hex_code', 'HEX Code', 'required|trim');
			else $this->form_validation->set_rules('hex_code', 'HEX Code', 'required|trim|callback_check_hex_code');
			$this->form_validation->set_rules('status', 'Status', 'required|trim');
			if ($this->form_validation->run() == TRUE) {
				if($user_type != 'demo') {
				    //post data
					$parsed_data['color'] = $this->input->post('color', TRUE);
					$parsed_data['hex_code'] = $this->input->post('hex_code', TRUE);
					$parsed_data['status'] = $this->input->post('status', TRUE);

					$comparison_fields = NULL;
					if($mode == 'edit') {
						$comparison_fields['NAME'] = 'ID';
						$comparison_fields['VALUE'] =	$id;		
					}
					$db_status = save_data('color', $parsed_data, $comparison_fields);	//save data

					if($db_status) $this->data['error'] = admin_errors(1); //success			
					else $this->data['error'] = admin_errors(2); //saved failed
				}
				else $this->data['error'] = admin_errors(5); //demo user error
			}
			else if(validation_errors()) $this->data['error'] = admin_errors(); //validation errors
		}

        //delete
		if($mode == 'delete') {
            ajax_single_delete('color', $id, 'ID', $user_type); return; //single delete
		} //end delete

		//edit
		if($mode == 'edit') {
			$return_data = get_rows(array('ID'=>$id), array('TABLE'=>'color', 'LIMIT'=>1));
			if(isset($return_data['ID'])) $this->data['color_data'] = $return_data;
			else { $this->data['mode'] = 'add'; }
		} //end edit

		$filters = array();
        $total_results = FALSE;
        $site_url = "admin/color/manage/show/0/";

	    $sql_properties['TABLE'] = 'color';
		$sql_properties['LIMIT'] = $limit;
		$sql_properties['OFFSET'] = $offset;
		$sql_properties['ORDER_BY'] = 'color';
		$sql_properties['ORDER_TYPE'] = 'asc';
        //search
		if ($mode == 'search') {
			$search_color = $this->input->get("color", TRUE);
			$search_hex_code = $this->input->get("hex_code", TRUE);
			$search_status = $this->input->get("status", TRUE);
			if($search_color) {
				$sql_properties['LIKE'][] = 'color.color';
				$sql_properties['LIKE_VALUE'][] = $search_color;
			}
			if($search_hex_code) {
				$sql_properties['LIKE'][] = 'color.hex_code';
				$sql_properties['LIKE_VALUE'][] = $search_hex_code;
			}
			if($search_status != '') $filters['color.status'] = $search_status;
            $total_results = row_counter($filters, $sql_properties); //count rows
            $site_url = "admin/color/manage/search/0/";
		} //end search

		$this->data['colors'] = get_rows($filters, $sql_properties);
		$this->data['pagination'] = row_pagination($filters, array('LIMIT'=>$limit, 'TABLE'=>'color', 'SITE_URL'=>$site_url, 'URI_SEGMENT'=>6, 'TOTAL_RESULTS'=>$total_results));

		render_page("admin/template", $this->data);
	}

    /**
     * Color Check
     * 
     * @access public
     * @return boolean
     */
	public function check_color($color)
	{
		$check = get_rows(array('color'=>$color), array('TABLE'=>'color', 'LIMIT'=>1));
		if(isset($check['ID'])) {
			$this->form_validation->set_message('check_color', 'Color already is being used. Please try with another Color.');
			return FALSE;
		}
		else return TRUE;
	}

    /**
     * Check Color HEX Code
     * 
     * @access public
     * @return boolean
     */
	public function check_hex_code($hex_code)
	{
		$check = get_rows(array('hex_code'=>$hex_code), array('TABLE'=>'color', 'LIMIT'=>1));
		if(isset($check['ID'])) {
			$this->form_validation->set_message('check_hex_code', 'HEX Code already is being used. Please try with another HEX Code.');
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
		if($user_type != 'demo') $db_status = ajax_single_update("color"); //update
        $result = (isset($db_status) && $db_status) ? 1 : 0; //set result

		ajax_response($result); return; //JSON Response
	}
	
}
/* End of file admin/color.php */
/* Location: ./application/controllers/admin/color.php */