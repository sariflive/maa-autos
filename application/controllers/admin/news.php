<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Maa Autos
 *
 * @package     Maa Autos
 * @author      www.Maa-Autos.com
 * @link        http://www.Maa-Autos.com/preview
 * @since       Version 1.0
 */

// ------------------------------------------------------------------------

/**
 * News Controller
 *
 * @subpackage  controllers/admin
 */
class news extends CI_Controller {

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
     * Controller For 'Admin news page'
     * 
     * @access public
     * @return redirect newslist
     */
	public function index()
	{
		redirect(site_url("admin/news/newslist")); return;
	}

    /**
     * news list (Admin)
     * 
     * @access public
     * @param $offset (integer)
     * @return type View
     */
	public function newslist($offset=0)
	{
		$limit = 15;

		$this->data['module'] = 'addons';
		$this->data['sub_module'] = 'news';
		$this->data['segment'] = 'admin/addons/news/news';
		$this->data['page_header'] = '<h2><i class="fa fa-asterisk"></i>News List <span>news page</span></h2>';
		//breadcrumb
		$this->data['breadcrumb'] = '';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-home"></i> <a href="'.site_url("admin/dashboard").'">Dashboard</a><i class="fa fa-angle-right"></i></li>';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-asterisk"></i> News</li>';
		//breadcrumb
		$this->data['page'] = array(
							'pageTitle' => "News List"
						);

		$filters = array();
		$sql_properties['TABLE'] = 'news';
		$sql_properties['LIMIT'] = $limit;
		$sql_properties['OFFSET'] = $offset;
		$sql_properties['ORDER_BY'] = 'title';
		$sql_properties['ORDER_TYPE'] = 'asc';
		$this->data['news'] = get_rows($filters, $sql_properties);
		$this->data['pagination'] = row_pagination($filters, array('LIMIT'=>$limit, 'TABLE'=>'news', 'SITE_URL'=>'admin/news/newslist/', 'URI_SEGMENT'=>4));
		render_page("admin/template", $this->data);
	}

    /**
     * news manage (Admin)
     *
     * @access public
     * @param $mode
     * @param $id (alphaID)
     * @param $offset
     * @return mixed
     */
	public function manage($mode = 'add', $id = 0, $offset = 0)
	{
		$user_type = $this->session->userdata("user_type");

		$valid_modes = array('add', 'edit', 'delete', 'search', 'bulk_delete'); //valid mode
		if(!in_array($mode, $valid_modes)) $mode = 'add'; //check mode
		$table = 'news';

        $this->data['page_js'] = 'manage-news';
        $this->data['module'] = 'addons';
		$this->data['sub_module'] = 'news';
		$this->data['segment'] = 'admin/addons/news/manage-news';
		$this->data['page_header'] = '<h2><i class="fa fa-asterisk"></i>Manage News <span>news page</span></h2>';
		//breadcrumb
		$this->data['breadcrumb'] = '';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-home"></i> <a href="'.site_url("admin/dashboard").'">Dashboard</a><i class="fa fa-angle-right"></i></li>';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-asterisk"></i> News</li>';
		//breadcrumb
		$this->data['page'] = array(
							'pageTitle' => "Manage News"
						);
		$this->data['mode'] = $mode;
		$this->data['news_id'] = $id;
		$id = alphaID($id, TRUE);

        //post
		if($_POST) {
		    //bulk delete
			if($mode == 'bulk_delete') {
                $row_sel = $this->input->post("row_sel", TRUE); //post rows
                ajax_bulk_delete($table, $row_sel, $user_type, './images/news/'); return; //bulk delete
			} //end bulk delete

			$this->form_validation->set_rules('title', 'Title', 'required|trim');
			$this->form_validation->set_rules('meta_keyword', 'Meta Keyword', 'required|trim');
			$this->form_validation->set_rules('meta_description', 'Meta Description', 'required|trim');
			$this->form_validation->set_rules('tags', 'Tags', 'required|trim');
			$this->form_validation->set_rules('details', 'Details', 'required|trim');
			if($mode == 'edit') $this->form_validation->set_rules('url', 'URL', 'required|trim');
			else $this->form_validation->set_rules('url', 'URL', 'required|trim|callback_check_url');
			$this->form_validation->set_rules('publish_date', 'Publish Date', 'required|trim');
			$this->form_validation->set_rules('status', 'Status', 'required|trim');
			if ($this->form_validation->run() == TRUE) {
				if($user_type != 'demo') {
				    //post data
					$parsed_data['title'] = $this->input->post('title', TRUE);
					$parsed_data['meta_keyword'] = $this->input->post('meta_keyword', TRUE);
					$parsed_data['meta_description'] = $this->input->post('meta_description', TRUE);
					$parsed_data['tags'] = $this->input->post('tags', TRUE);
					$parsed_data['details'] = close_tags($this->input->post('details', TRUE));
					$parsed_data['url'] = url_title(strtolower($this->input->post('url', TRUE)));
					$parsed_data['publish_date'] = $this->input->post('publish_date', TRUE);
					$parsed_data['status'] = $this->input->post('status', TRUE);

                    //post file
					if(isset($_FILES['userfile']['name'])) {
						//upload user image
						$this->load->library('upload');
						$title = strtolower(url_title($parsed_data['url']));
						if($title) {
							$fileExt = strtolower(array_pop(explode(".", $_FILES['userfile']['name'])));	
							$config['file_name']  = "{$title}.{$fileExt}";
						}
						$config['overwrite'] = TRUE;
						$config['upload_path'] = "./images/news/";
						$config['allowed_types'] = 'png|jpg|jpeg';

						$this->upload->initialize($config);

						if ($this->upload->do_upload()) {
							$upload_data = $this->upload->data();
							if ( ! $this->upload->do_upload('userfile')) $this->data['error'] = '<div class="alert alert-danger"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button><strong>Error! </strong> '. $this->upload->display_errors() .'</div>';
							else {
								$config['image_library'] = 'gd2';
								$config['source_image'] = "./images/news/{$upload_data['file_name']}";
								$config['create_thumb'] = FALSE;
								$config['maintain_ratio'] = TRUE;
								$config['max_width'] = $this->config->item("news_image_max_width");
								$config['max_height'] = $this->config->item("news_image_max_height");

								$this->load->library('image_lib', $config);
								$this->image_lib->resize();

								$parsed_data['image'] = $upload_data['file_name'];
								$upload_status = 1;
							}
						}
					} //end post file

					$comparison_fields = NULL;
					if($mode == 'edit') {
						$comparison_fields['NAME'] = 'ID';
						$comparison_fields['VALUE'] =	$id;		
					}
					$db_status = save_data($table, $parsed_data, $comparison_fields); //save post data

					$status = (isset($upload_status)) ? $upload_status : $db_status;
					if($status) $this->data['error'] = admin_errors(1); //success			
					else $this->data['error'] = admin_errors(2); //saved failed
				}
				else $this->data['error'] = admin_errors(5); //demo user error
			}
			else if(validation_errors()) $this->data['error'] = admin_errors(); //validation errors
		} //end post

		//delete
		if($mode == 'delete') {
            ajax_single_delete($table, $id, 'ID', $user_type, './images/news/'); return; //single delete
		} //end delete

		//edit
		if($mode == 'edit') {
			$return_data = get_rows(array('ID'=>$id), array('TABLE'=>$table, 'LIMIT'=>1));
			if(isset($return_data['ID'])) $this->data['news_data'] = $return_data;
			else { $this->data['mode'] = 'add'; }
		} //end edit

		$filters = array();
		$sql_properties['TABLE'] = $table;
		$sql_properties['LIMIT'] = 15;
		$sql_properties['OFFSET'] = $offset;
		$sql_properties['ORDER_BY'] = 'title';
		$sql_properties['ORDER_TYPE'] = 'asc';
        //search
		if ($mode == 'search') {
			$this->data['segment'] = 'admin/addons/news';

			$search_title = $this->input->get("title", TRUE);
			$search_publish_date = $this->input->get("publish_date", TRUE);
			$search_status = $this->input->get("status", TRUE);
			if($search_title) {
				$sql_properties['LIKE'][] = 'news.title';
				$sql_properties['LIKE_VALUE'][] = $search_title;
			}
			if($search_publish_date != '') $filters['news.publish_date'] = $search_publish_date;
			if($search_status != '') $filters['news.status'] = $search_status;
			$this->data['news'] = get_rows($filters, $sql_properties);
			$total_results = row_counter($filters, $sql_properties);
			$this->data['pagination'] = row_pagination($filters, array('LIMIT'=>15, 'TABLE'=>$table, 'SITE_URL'=>'admin/news/manage/search/0/', 'URI_SEGMENT'=>6, 'TOTAL_RESULTS'=>$total_results));
		} //end search

		render_page("admin/template", $this->data);
	}

    /**
     * check url
     * 
     * @access public
     * @return boolean
     */
	public function check_url($url)
	{
		$check = get_rows(array('url'=>$url), array('TABLE'=>'news', 'LIMIT'=>1));
		if(isset($check['ID'])) {
			$this->form_validation->set_message('check_url', 'URL already is being used. Please try with another URL.');
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
		if($user_type != 'demo') $db_status = ajax_single_update("news");
        $result = (isset($db_status) && $db_status) ? 1 : 0; //set result

		ajax_response($result); return; //JSON Response
	}

    /**
     * make url
     * 
     * @access public (ajax)
     * @return url
     */
	public function url()
	{
        $ajax = ajax_check(); //Check AJAX
        if(!$ajax) { redirect(site_url("admin/sign-in")); return; }  //if not ajax request

		$title = $this->input->post("title");
		$json['url'] = url_title(strtolower($title)); //make url
        ajax_response($json); return; //JSON Response
	}
	
}
/* End of file admin/news.php */
/* Location: ./application/controllers/admin/news.php */