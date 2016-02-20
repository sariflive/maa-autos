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
 * Blogs Controller
 *
 * @subpackage  controllers/admin
 */
class Blogs extends CI_Controller {

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
     * Controller For 'Admin Blogs Page'
     * @access public
     * @return redirect bloglist
     */
	public function index()
	{
		redirect(site_url("admin/blogs/blogslist")); return;
	}

    /**
     * Blog List (Admin)
     * 
     * @access public
     * @param $offset (integer)
     * @return type View
     */
	public function blogslist($offset=0)
	{
		$limit = 15;

		$this->data['module'] = 'addons';
		$this->data['sub_module'] = 'blogs';
		$this->data['sub_sub_module'] = 'blogslist';
		$this->data['segment'] = 'admin/addons/blogs/blogs';
		$this->data['page_header'] = '<h2><i class="fa fa-users"></i>Blogs List</h2>';
		$this->data['breadcrumb'] = '';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-home"></i> <a href="'.site_url("admin/dashboard").'">Dashboard</a><i class="fa fa-angle-right"></i></li>';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-users"></i> Blogs List</li>';
		$this->data['page'] = array(
							'pageTitle' => "Blogs List"
						);

		$filters = array();
		$total_results = FALSE;

		$sql_properties['SELECT'] = 'blogs.*, users.firstName, users.lastName';
		$sql_properties['TABLE'] = 'blogs';
		$sql_properties['LIMIT'] = $limit;
		$sql_properties['OFFSET'] = $offset;
		$sql_properties['GLUE'] = 'users';
		$sql_properties['PIECES'] = 'users.ID = blogs.user_id';
        //search
		if(isset($_GET['name'])) {
			$user = $this->input->get("user", TRUE);
			$title = $this->input->get("title", TRUE);
			$date = $this->input->get("date", TRUE);
			$status = $this->input->get("status", TRUE);

			if($title) {
				$sql_properties['LIKE'][] = 'blogs.title';
				$sql_properties['LIKE_VALUE'][] = $title;
			}

			if($user != '')  $filters['blogs.user_id'] = $user;
			if($date != '')  $filters['blogs.date'] = $date;
			if($status != '') $filters['blogs.status'] = $status;

			$total_results = row_counter($filters, $sql_properties);
		}
        //end search

		$this->data['blogs'] = get_rows($filters, $sql_properties);
		$this->data['pagination'] = row_pagination($filters, array('LIMIT'=>$limit, 'TABLE'=>'blogs', 'SITE_URL'=>'admin/blogs/blogslist/', 'URI_SEGMENT'=>4, 'TOTAL_RESULTS'=>$total_results));
		render_page("admin/template", $this->data);
	}

    /**
     * Blog Manage (Admin)
     *
     * @access public
     * @param $mode (add, edit, delete, search, bulk_delete)
     * @param $id (alphaID)
     * @param $offset (integer)
     * @return type View
     */
	public function manage($mode='add', $id=0, $offset=0) {
		$user_type = $this->session->userdata("user_type");
		$cur_sess = cur_sess();

		$valid_modes = array('add', 'edit', 'delete', 'bulk_delete'); //valid mode
		if(!in_array($mode, $valid_modes)) $mode = 'add'; //check mode
		$table = 'blogs';

        $this->data['page_js'] = 'manage-blog';
        $this->data['module'] = 'addons';
		$this->data['sub_module'] = 'blogs';
		$this->data['sub_sub_module'] = 'blog-manage';
		$this->data['segment'] = 'admin/addons/blogs/manage-blog';
		$this->data['page_header'] = '<h2><i class="fa fa-users"></i>Manage Blog</h2>';
		$this->data['breadcrumb'] = '';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-home"></i> <a href="'.site_url("admin/dashboard").'">Dashboard</a><i class="fa fa-angle-right"></i></li>';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-users"></i> Manage Blog List</li>';
		$this->data['page'] = array(
							'pageTitle' => "Manage Blog List"
						);
		$this->data['mode'] = $mode;
		$this->data['blog_id'] = $id;
		$id = alphaID($id, TRUE);

		//Bulk Delete
		if($mode == 'bulk_delete') {
            $row_sel = $this->input->post("row_sel", TRUE); //post rows
            ajax_bulk_delete($table, $row_sel, $user_type, './images/blog/'); return;
		}
		//Bulk Delete End

		($mode == 'edit') ? $form_validation = "blogs_edit" : $form_validation = "blogs";
		if ($this->form_validation->run($form_validation) == TRUE) {
			if($user_type != 'demo') {
			    $parsed_data = $this->_parsed_data($cur_sess['sessUserID']);

				//upload user image
				$this->load->library('upload');
				$title = $parsed_data['url'];
				if($title) {
					$fileExt = strtolower(array_pop(explode(".", $_FILES['userfile']['name'])));	
					$config['file_name']  = "{$title}.{$fileExt}";
				}
				$config['overwrite'] = TRUE;
				$config['upload_path'] = "./images/blog/";
				$config['allowed_types'] = 'png|jpg|jpeg';

				$this->upload->initialize($config);

				if ($this->upload->do_upload()) {
					$upload_data = $this->upload->data();
					if ( ! $this->upload->do_upload('userfile')) $this->data['error'] = '<div class="alert alert-danger"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button><strong>Error! </strong> '. $this->upload->display_errors() .'</div>';
					else {
						$config['image_library'] = 'gd2';
						$config['source_image'] = "./images/blog/{$upload_data['file_name']}";
						$config['create_thumb'] = FALSE;
						$config['maintain_ratio'] = TRUE;
						$config['max_width'] = $this->config->item("blog_image_max_width");
						$config['max_height'] = $this->config->item("blog_image_max_height");

						$this->load->library('image_lib', $config);
						$this->image_lib->resize();

						$parsed_data['image'] = $upload_data['file_name'];
						$upload_status = 1;
					}
				}

				$comparison_fields = NULL;
				if($mode == 'edit') {
					$comparison_fields['NAME'] = 'ID';
					$comparison_fields['VALUE'] = $id;		
				}
				$db_status = save_data($table, $parsed_data, $comparison_fields);		

				$status = (isset($upload_status)) ? $upload_status : $db_status;
				if($status) $this->data['error'] = admin_errors(1); //success			
				else $this->data['error'] = admin_errors(2); //saved failed
			}
			else $this->data['error'] = admin_errors(5); //demo user error
		}
		else if(validation_errors()) $this->data['error'] = admin_errors(); //validation errors

		if($mode == 'delete') {
            ajax_single_delete($table, $id, 'ID', $user_type, './images/blog/'); return; //single delete
		}

		if($mode == 'edit') {
			$return_data = get_rows(array('ID'=>$id), array('TABLE'=>$table, 'LIMIT'=>1));
			if(isset($return_data['ID'])) $this->data['blog_data'] = $return_data;
			else {$this->data['mode'] = 'add';}
		}

		render_page("admin/template", $this->data);
	}

    /**
     * Blog Status Update
     * 
     * @access public (ajax)
     * @return boolean
     */
	public function status_update()
	{
        $ajax = ajax_check(); //Check AJAX
        if(!$ajax) { redirect(site_url("admin/sign-in")); return; }  //if not ajax request

		$user_type = $this->session->userdata("user_type");
		if($user_type != 'demo') $db_status = ajax_single_update("blogs"); //update
        $result = (isset($db_status) && $db_status) ? 1 : 0; //set result

        ajax_response($result); return; //JSON Response
	}

    /**
     * Blog URL Check
     * 
     * @access public
     * @return boolean
     */	
	public function check_url($url)
	{
		$check = get_rows(array('url'=>$url), array('TABLE'=>'blogs', 'LIMIT'=>1));
		if(isset($check['ID'])) {
			$this->form_validation->set_message('check_url', 'URL already is being used. Please try with another URL.');
			return FALSE;
		}
		else return TRUE;
	}

    /**
     * Make URL (Admin)
     * 
     * @access public (ajax)
     * @return url (mixed)
     */ 
	public function url()
	{
	    $ajax = ajax_check(); //Check AJAX
	    if(!$ajax) { redirect(site_url("admin/sign-in")); return; }  //if not ajax request

		$title = $this->input->post("title");
		$json['url'] = url_title(strtolower($title)); //make URL
        ajax_response($json); return;
	}

    /**
     * Comment List (Admin)
     * 
     * @access public
     * @param $offset (integer)
     * @return type View
     */	
	public function commentslist($offset=0)
	{
		$limit = 15;

		$this->data['module'] = 'addons';
		$this->data['sub_module'] = 'blogs';
		$this->data['sub_sub_module'] = 'commentslist';
		$this->data['segment'] = 'admin/addons/blogs/blog-comments';
		$this->data['page_header'] = '<h2><i class="fa fa-users"></i>Blog Comments</h2>';
        //breadcrumb
		$this->data['breadcrumb'] = '';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-home"></i> <a href="'.site_url("admin/dashboard").'">Dashboard</a><i class="fa fa-angle-right"></i></li>';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-users"></i> Blog Comments List</li>';
		//end breadcrumb
		$this->data['page'] = array(
							'pageTitle' => "Blog Comments List"
						);

		$filters = array();
		$total_results = FALSE;

		$sql_properties['SELECT'] = 'blog_comments.*, blogs.title';
		$sql_properties['TABLE'] = 'blog_comments';
		$sql_properties['LIMIT'] = $limit;
		$sql_properties['OFFSET'] = $offset;
		$sql_properties['GLUE'] = 'blogs';
		$sql_properties['PIECES'] = 'blogs.ID = blog_comments.blogID';
        //search
		if(isset($_GET['name'])) {
			$name = $this->input->get("name", TRUE);
			$title = $this->input->get("title", TRUE);
			$date = $this->input->get("date", TRUE);
			$status = $this->input->get("status", TRUE);

			if($name) {
				$sql_properties['LIKE'][] = 'blog_comments.name';
				$sql_properties['LIKE_VALUE'][] = $name;
			}

			if($title) {
				$sql_properties['LIKE'][] = 'blog_comments.title';
				$sql_properties['LIKE_VALUE'][] = $title;
			}

			if($date) {
				$sql_properties['LIKE'][] = 'blog_comments.date';
				$sql_properties['LIKE_VALUE'][] = $date;
			}

			if($status != '') $filters['blog_comments.status'] = $status;

			$total_results = row_counter($filters, $sql_properties);
		} //end search

		$this->data['comments'] = get_rows($filters, $sql_properties);
		$this->data['pagination'] = row_pagination($filters, array('LIMIT'=>$limit, 'TABLE'=>'blog_comments', 'SITE_URL'=>'admin/blogs/blogcomments/', 'URI_SEGMENT'=>4, 'TOTAL_RESULTS'=>$total_results));
		render_page("admin/template", $this->data);
	}

    /**
     * Admin Comment
     *
     * @access public
     * @param $mode (add, edit, delete, search, bulk_delete)
     * @param $id (alphaID)
     * @param $offset (integer)
     * @return type View
     */
	public function comment($mode='add', $id=0, $offset=0) {
		$user_type = $this->session->userdata("user_type");
		$limit = 15;

		$valid_modes = array('add', 'edit', 'delete', 'search', 'bulk_delete'); //valid mode
		if(!in_array($mode, $valid_modes)) $mode = 'add'; //check mode

		$this->data['module'] = 'addons';
		$this->data['sub_module'] = 'blogs';
		$this->data['sub_sub_module'] = 'commentslist';
		$this->data['segment'] = 'admin/addons/blogs/manage-blog-comment';
		$this->data['page_header'] = '<h2><i class="fa fa-users"></i>Manage Blog Comment</h2>';
        //breadcrumb
		$this->data['breadcrumb'] = '';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-home"></i> <a href="'.site_url("admin/dashboard").'">Dashboard</a><i class="fa fa-angle-right"></i></li>';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-users"></i> Manage Blog Comment</li>';
		//end breadcrumb
		$this->data['page'] = array(
							'pageTitle' => "Manage Blog Comment"
						);
		$this->data['mode'] = $mode;
		$this->data['comment_id'] = $id;
		$id = alphaID($id, TRUE);

        //post
		if($_POST) {
		    //bulk delete
			if($mode == 'bulk_delete') {
                $row_sel = $this->input->post("row_sel", TRUE); //post rows
                ajax_bulk_delete('blog_comments', $row_sel, $user_type); return; //bulk delete
			} //end bulk delete

			$this->form_validation->set_rules('blog', 'Blog', 'required|trim');
			$this->form_validation->set_rules('name', 'Name', 'required|trim');
			$this->form_validation->set_rules('email', 'E-mail', 'required|valid_email|trim');
			$this->form_validation->set_rules('comment', 'Comment', 'required|trim');
			$this->form_validation->set_rules('status', 'Status', 'required|trim');
			if ($this->form_validation->run() == TRUE) {
				if($user_type != 'demo') {
				    //parsed post data
				    $parsed_data = $this->_comment_parsed_data();

					$comparison_fields = NULL;
					if($mode == 'edit') {
						$comparison_fields['NAME'] = 'ID';
						$comparison_fields['VALUE'] =	$id;		
					}
					$db_status = save_data('blog_comments', $parsed_data, $comparison_fields); //save data

					if($db_status) $this->data['error'] = admin_errors(1); //success
					else $this->data['error'] = admin_errors(2); //saved failed
				}
				else $this->data['error'] = admin_errors(5); //demo user error
			}
			else if(validation_errors()) $this->data['error'] = admin_errors(); //validation errors
		}//end post

		//delete
		if($mode == 'delete') {
            ajax_single_delete('blog_comments', $id, 'ID', $user_type); return; //single delete
		}//end delete

		//edit
		if($mode == 'edit') {
			$return_data = get_rows(array('ID'=>$id), array('TABLE'=>'blog_comments', 'LIMIT'=>1));
			if(isset($return_data['ID'])) $this->data['comment_data'] = $return_data;
			else { $this->data['mode'] = 'add'; }
		}//end edit

		render_page('admin/template', $this->data);
	}

    /**
     * Comment Status Update
     * 
     * @access public (ajax)
     * @return boolean
     */
	public function comment_status_update()
	{
        $ajax = ajax_check(); //Check AJAX
        if(!$ajax) { redirect(site_url("admin/sign-in")); return; }  //if not ajax request

		$user_type = $this->session->userdata("user_type");
		if($user_type != 'demo') $db_status = ajax_single_update("blog_comments");
        $result = (isset($db_status) && $db_status) ? 1 : 0; //set result
		ajax_response($result); return; //JSON Response
	}

    /**
     * blog post data
     * 
     * @access private
     * @return post data
     */
    private function _parsed_data($user_id=0)
    {
        $parsed_data = array();

        $parsed_data['user_id'] = $user_id;
        $parsed_data['title'] = $this->input->post('title', TRUE);
        $parsed_data['tags'] = $this->input->post('tags', TRUE);
        $parsed_data['details'] = close_tags($this->input->post('details', TRUE));
        $parsed_data['url'] = strtolower(url_title($this->input->post('url', TRUE)));
        $parsed_data['date'] = $this->input->post('date', TRUE);
        $parsed_data['status'] = $this->input->post('status', TRUE);

        return $parsed_data;
    }

    /**
     * Comment post data
     * 
     * @access private
     * @return post data
     */
    private function _comment_parsed_data()
    {
        $parsed_data = array();

        $parsed_data['blogID'] = $this->input->post('blog', TRUE);
        $parsed_data['name'] = $this->input->post('name', TRUE);
        $parsed_data['email'] = $this->input->post('email', TRUE);
        $parsed_data['website'] = $this->input->post('website', TRUE);
        $parsed_data['comment'] = close_tags($this->input->post('comment', TRUE));
        $parsed_data['status'] = $this->input->post('status', TRUE);

        return $parsed_data;
    }

}
/* End of file admin/blogs.php */
/* Location: ./application/controllers/admin/blogs.php */