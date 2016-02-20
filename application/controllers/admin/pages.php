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
 * Pages Controller
 *
 * @subpackage  controllers/admin
 */
class Pages extends CI_Controller {

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
     * Controller For 'Admin pages page'
     * 
     * @access public
     * @return redirect pageslist
     */
	public function index()
	{
		redirect(site_url("admin/pages/pageslist")); return;
	}

    /**
     * pages list (Admin)
     * 
     * @access public
     * @param $offset (integer)
     * @return type View
     */
	public function pageslist($offset=0)
	{
		$limit = 15;
		$filters = array();

		$this->data['module'] = 'website-pages';
		$this->data['sub_module'] = 'pages';
		$this->data['segment'] = 'admin/website-pages/pages/pages';
		$this->data['page_header'] = '<h2><i class="fa fa-asterisk"></i>Pages List <span>pages list page</span></h2>';
		//breadcrumb
		$this->data['breadcrumb'] = '';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-home"></i> <a href="'.site_url("admin/dashboard").'">Dashboard</a><i class="fa fa-angle-right"></i></li>';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-asterisk"></i> Pages List</li>';
		//breadcrumb
		$this->data['page'] = array(
							'pageTitle' => "Pages List"
						);

		$this->data['pages'] = get_rows($filters, array('TABLE'=>'pages', 'LIMIT'=>$limit, 'OFFSET'=>$offset, 'ORDER_BY'=>'page', 'ORDER_TYPE'=>'asc'));
		$this->data['pagination'] = row_pagination($filters, array('LIMIT'=>$limit, 'TABLE'=>'pages', 'SITE_URL'=>'admin/pages/pageslist/', 'URI_SEGMENT'=>4));
		render_page("admin/template", $this->data);
	}

    /**
     * page manage (Admin)
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

        $this->data['page_js'] = 'manage-page';
        $this->data['module'] = 'website-pages';
		$this->data['sub_module'] = 'pages';
		$this->data['segment'] = 'admin/website-pages/pages/manage-page';
		$this->data['page_header'] = '<h2><i class="fa fa-asterisk"></i>Manage Page <span>manage page</span></h2>';
		//breadcrumb
		$this->data['breadcrumb'] = '';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-home"></i> <a href="'.site_url("admin/dashboard").'">Dashboard</a><i class="fa fa-angle-right"></i></li>';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-asterisk"></i> Manage Page</li>';
		//breadcrumb
		$this->data['page'] = array(
							'pageTitle' => "Manage Page"
						);
		$this->data['mode'] = $mode;
		$this->data['page_id'] = $id;
		$id = alphaID($id, TRUE);

        //post
		if($_POST) {
		    //bulk delete
			if($mode == 'bulk_delete') {
                $ajax = ajax_check(); //Check AJAX
                if(!$ajax || !$table || !is_array($row_sel)) { redirect(site_url("admin/sign-in")); return; }  //if not ajax request or table or rows

                $result = 1; //deafult result
				if($user_type != 'demo') {
					$row_sel = $this->input->post("row_sel", TRUE);
					foreach ($row_sel as $key => $value) {
                        $cur_row_id = alphaID($value, TRUE); //get ID

                        //delete route
                        $check_route = get_rows(array('ID'=>$id), array('TABLE'=>'pages', 'LIMIT'=>1));
                        if(isset($check_route['url'])) admin_simple_delete('routes', 'slug', $check_route['url']);

                        $row_ids[] = $cur_row_id;
					}
                    $status = delete_rows('pages', NULL, $row_ids); //delete rows
                    $result = ($status) ? 1: 0; //set result
				}

                ajax_response($result); return; //JSON Response
			} //end bulk delete

			($mode == 'edit') ? $form_validation = "pages_edit" : $form_validation = "pages";
			if ($this->form_validation->run($form_validation) == TRUE) {
				if($user_type != 'demo') {
				    //post data
					$parsed_data['page'] = $this->input->post('page', TRUE);
					$parsed_data['url'] = strtolower(url_title($this->input->post('url', TRUE)));
					$parsed_data['meta_title'] = $this->input->post('meta_title', TRUE);
					$parsed_data['meta_keyword'] = $this->input->post('meta_keyword', TRUE);
					$parsed_data['meta_description'] = $this->input->post('meta_description', TRUE);
					$parsed_data['content'] = close_tags($this->input->post('content', TRUE));
					$parsed_data['status'] = $this->input->post('status', TRUE);
					$parsed_data['tags'] = $this->input->post('tags', TRUE);
					$parsed_data['page_banner'] = $this->input->post('page_banner', TRUE);
	
					if($mode == 'edit') $check_route = get_rows(array('slug'=>$parsed_data['url']), array('TABLE'=>'routes', 'LIMIT'=>1));

                    //routes
					if(!isset($check_route['ID'])) {
						$route_data['slug'] = $parsed_data['url'];
						$route_data['controller'] = "contents/index/{$route_data['slug']}";
						$routes = get_rows(array('slug' => $route_data['slug']), array('table'=>'routes', 'limit'=>1));
						$route_comparison_fields = NULL;
						if(isset($routes['slug'])) {
							$route_comparison_fields['name'] = 'slug';
							$route_comparison_fields['value'] = $route_data['slug'];
						}
						save_data('routes', $route_data, $route_comparison_fields);
					} //end routes
	
					$comparison_fields = NULL;
					if($mode == 'edit') {
						$comparison_fields['NAME'] = 'ID';
						$comparison_fields['VALUE'] =	$id;		
					}
					$db_status = save_data('pages', $parsed_data, $comparison_fields); //save post data
	
					if($db_status) $this->data['error'] = admin_errors(1); //success			
					else $this->data['error'] = admin_errors(2); //saved failed
				}
				else $this->data['error'] = admin_errors(5); //demo user error
			}
			else if(validation_errors()) $this->data['error'] = admin_errors(); //validation errors
		} //end post

		//delete
		if($mode == 'delete') {
            $ajax = ajax_check(); //Check AJAX
            if(!$ajax || !$table || !is_array($row_sel)) { redirect(site_url("admin/sign-in")); return; }  //if not ajax request or table or rows

            $result = 1; //deafult result
			if($user_type != 'demo') {
				$check_route = get_rows(array('ID'=>$id), array('TABLE'=>'pages', 'LIMIT'=>1));
				if(isset($check_route['url'])) admin_simple_delete('routes', 'slug', $check_route['url']);
	
				$status = admin_simple_delete('pages', 'ID', $id); //delete
                $result = ($status) ? 1: 0; //set result
			}

            ajax_response($result); return; //JSON Response
		} //end delete

		//edit
		if($mode == 'edit') {
			$return_data = get_rows(array('ID'=>$id), array('TABLE'=>'pages', 'LIMIT'=>1));
			if(isset($return_data['ID'])) $this->data['page_data'] = $return_data;
			else { $this->data['mode'] = 'add'; }
		} //end edit

		$filters = array();
		$sql_properties['TABLE'] = 'pages';
		$sql_properties['LIMIT'] = $limit;
		$sql_properties['OFFSET'] = $offset;
		$sql_properties['ORDER_BY'] = 'page';
		$sql_properties['ORDER_TYPE'] = 'asc';
        //search
		if ($mode == 'search') {
			$this->data['segment'] = 'admin/website-pages/pages/pages';

			$search_page = $this->input->get("page", TRUE);
			$search_title = $this->input->get("title", TRUE);
			$search_tags = $this->input->get("tags", TRUE);
			$search_status = $this->input->get("status", TRUE);
			if($search_page) {
				$sql_properties['LIKE'][] = 'pages.page';
				$sql_properties['LIKE_VALUE'][] = $search_page;
			}
			if($search_title) {
				$sql_properties['LIKE'][] = 'pages.title';
				$sql_properties['LIKE_VALUE'][] = $search_title;
			}
			if($search_tags) {
				$sql_properties['LIKE'][] = 'pages.tags';
				$sql_properties['LIKE_VALUE'][] = $search_tags;
			}
			if($search_status != '') $filters['pages.status'] = $search_status;
			$this->data['pages'] = get_rows($filters, $sql_properties);
			$total_results = row_counter($filters, $sql_properties);
			$this->data['pagination'] = row_pagination($filters, array('LIMIT'=>$limit, 'TABLE'=>'pages', 'SITE_URL'=>'admin/pages/manage/search/0/', 'URI_SEGMENT'=>6, 'TOTAL_RESULTS'=>$total_results));
		} //end search

		render_page("admin/template", $this->data);
	}

    /**
     * check page
     * 
     * @access public
     * @return boolean
     */
	public function check_page($page)
	{
		$check = get_rows(array('page'=>$page), array('TABLE'=>'pages', 'LIMIT'=>1));
		if(isset($check['ID'])) {
			$this->form_validation->set_message('check_page', 'Page already is being used. Please try with another Page.');
			return FALSE;
		}
		else return TRUE;
	}

    /**
     * check url
     * 
     * @access public
     * @return boolean
     */
	public function check_url($url)
	{
		$check = get_rows(array('url'=>$url), array('TABLE'=>'pages', 'LIMIT'=>1));
		if(isset($check['ID'])) {
			$this->form_validation->set_message('check_url', 'Page URL already is being used. Please try with another Page URL.');
			return FALSE;
		}
		else return TRUE;
	}

    /**
     * cmake url
     * 
     * @access public (ajax)
     * @return string (url)
     */
	public function url()
	{
        $ajax = ajax_check(); //Check AJAX
        if(!$ajax) { redirect(site_url("admin/sign-in")); return; }  //if not ajax request

		$page = $this->input->post("page", TRUE);
		$json['url'] = url_title(strtolower($page)); //make url
        ajax_response($json); return; //JSON Response
	}

    /**
     * Color status update
     * 
     * @access public (ajax)
     * @return boolean
     */
	public function status_update()
	{
        $ajax = ajax_check(); //Check AJAX
        if(!$ajax) { redirect(site_url("admin/sign-in")); return; }  //if not ajax request

        $user_type = $this->session->userdata("user_type");
		if($user_type != 'demo') $db_status = ajax_single_update("pages");
        $result = (isset($db_status) && $db_status) ? 1 : 0; //set result
		ajax_response($result); return; //JSON Response
	}

}
/* End of file admin/pages.php */
/* Location: ./application/controllers/admin/pages.php */