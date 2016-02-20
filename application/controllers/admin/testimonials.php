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
 * Testimonials Controller
 *
 * @subpackage  controllers/admin
 */
class Testimonials extends CI_Controller {

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
     * Controller For 'Admin testimonials Page'
     * @access public
     * @return redirect testimonialslist
     */
	public function index()
	{
		redirect(site_url("admin/testimonials/testimonialslist")); return;
	}

    /**
     * testimonials list (Admin)
     * 
     * @access public
     * @param $offset (integer)
     * @return type View
     */
	public function testimonialslist($offset=0)
	{
		$limit = 15;
		
		$this->data['module'] = 'addons';
		$this->data['sub_module'] = 'testimonials';
		$this->data['segment'] = 'admin/addons/testimonials/testimonials';
		$this->data['page_header'] = '<h2><i class="fa fa-asterisk"></i>Testimonials List <span>testimonials list page</span></h2>';
		//breadcrumb
		$this->data['breadcrumb'] = '';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-home"></i> <a href="'.site_url("admin/dashboard").'">Dashboard</a><i class="fa fa-angle-right"></i></li>';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-asterisk"></i> Testimonials List</li>';
		//breadcrumb
		$this->data['page'] = array(
							'pageTitle' => "Testimonials List"
						);

		$filters = array();
		$sql_properties['TABLE'] = 'testimonials';
		$sql_properties['LIMIT'] = $limit;
		$sql_properties['OFFSET'] = $offset;
		$sql_properties['ORDER_BY'] = 'ID';
		$sql_properties['ORDER_TYPE'] = 'desc';
		$this->data['testimonials'] = get_rows($filters, $sql_properties);
		$sql_properties['SITE_URL'] = 'admin/testimonials/testimonialslist/';
		$sql_properties['URI_SEGMENT'] = 4;
		$this->data['pagination'] = row_pagination($filters, $sql_properties);
		render_page("admin/template", $this->data);
	}

    /**
     * testimonials manage (Admin)
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

        $this->data['page_js'] = 'manage-testimonial';
        $this->data['module'] = 'addons';
		$this->data['sub_module'] = 'testimonials';
		$this->data['segment'] = 'admin/addons/testimonials/manage-testimonial';
		$this->data['page_header'] = '<h2><i class="fa fa-asterisk"></i>Manage Testimonial <span>testimonial page</span></h2>';
		//breadcrumb
		$this->data['breadcrumb'] = '';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-home"></i> <a href="'.site_url("admin/dashboard").'">Dashboard</a><i class="fa fa-angle-right"></i></li>';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-asterisk"></i> Manage Testimonial</li>';
		//breadcrumb
		$this->data['page'] = array(
							'pageTitle' => "Manage Testimonial"
						);
		$this->data['mode'] = $mode;
		$this->data['testimonial_id'] = $id;
		$id = alphaID($id, TRUE);

        //post
		if($_POST) {
		    //bulk delete
			if($mode == 'bulk_delete') {
                $row_sel = $this->input->post("row_sel", TRUE); //post rows
                ajax_bulk_delete('testimonials', $row_sel, $user_type, './uploads/media/testimonials/'); return; //bulk delete
			} //end bulk delete

			if ($this->form_validation->run('testimonials') == TRUE) {
				if($user_type != 'demo') {
				    //post data
					$parsed_data['testimonial'] = close_tags($this->input->post('testimonial', TRUE));
					$parsed_data['name'] = $this->input->post('name', TRUE);
					$parsed_data['company_name'] = $this->input->post('company_name', TRUE);
					$parsed_data['designation'] = $this->input->post('designation', TRUE);
					$parsed_data['phone'] = $this->input->post('phone', TRUE);
					$parsed_data['mobile'] = $this->input->post('mobile', TRUE);
					$parsed_data['email'] = $this->input->post('email', TRUE);
					$parsed_data['web'] = $this->input->post('web', TRUE);
					$parsed_data['publish_date'] = $this->input->post('publish_date', TRUE);
					$parsed_data['status'] = $this->input->post('status', TRUE);

                    //upload file
					$cu_time = time();
					$fileExt = strtolower(array_pop(explode(".", $_FILES['userfile']['name'])));
					$config['overwrite'] = TRUE;
					$config['upload_path'] = "./uploads/media/testimonials/";
					$config['allowed_types'] = 'jpg|png|jpeg';
					$config['file_name']  = "{$cu_time}_tml.{$fileExt}";
					$this->load->library('upload', $config);
					if ($this->upload->do_upload()) {
						$upload_data = $this->upload->data();
						$config['overwrite'] = TRUE;
						$config['image_library'] = 'gd2';
						$config['source_image'] = "./uploads/media/testimonials/{$upload_data['file_name']}";
						$config['create_thumb'] = FALSE;
						$config['maintain_ratio'] = FALSE;
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();
	
						$parsed_data['image'] = $upload_data['file_name'];
					}
                    //end upload file

					$comparison_fields = NULL;
					if($mode == 'edit') {
						$comparison_fields['NAME'] = 'ID';
						$comparison_fields['VALUE'] =	$id;		
					}
					$db_status = save_data('testimonials', $parsed_data, $comparison_fields); //save post data
	
					if($db_status) $this->data['error'] = admin_errors(1); //success			
					else $this->data['error'] = admin_errors(2); //saved failed
				}
				else $this->data['error'] = admin_errors(5); //demo user error
			}
			else if(validation_errors()) $this->data['error'] = admin_errors(); //validation errors
		} //post

		//delete
		if($mode == 'delete') {
            ajax_single_delete('testimonials', $id, 'ID', $user_type, './uploads/media/testimonials/'); return; //single delete
		} //end delete

		//edit
		if($mode == 'edit') {
			$return_data = get_rows(array('ID'=>$id), array('TABLE'=>'testimonials', 'LIMIT'=>1));
			if(isset($return_data['ID'])) $this->data['testimonial_data'] = $return_data;
			else { $this->data['mode'] = 'add'; }
		} //end edit

		$filters = array();
		$sql_properties['TABLE'] = 'testimonials';
		$sql_properties['LIMIT'] = 15;
		$sql_properties['OFFSET'] = $offset;
		$sql_properties['ORDER_BY'] = 'ID';
		$sql_properties['ORDER_TYPE'] = 'asc';
        //search
		if ($mode == 'search') {
			$this->data['segment'] = 'admin/addons/testimonials/testimonials';

			$search_name = $this->input->get("name", TRUE);
			$search_email = $this->input->get("email", TRUE);
			$search_company_name = $this->input->get("company_name", TRUE);
			$search_status = $this->input->get("status", TRUE);
			if($search_name) {
				$sql_properties['LIKE'][] = 'testimonials.name';
				$sql_properties['LIKE_VALUE'][] = $search_name;
			}
			if($search_email) {
				$sql_properties['LIKE'][] = 'testimonials.email';
				$sql_properties['LIKE_VALUE'][] = $search_email;
			}
			if($search_company_name) {
				$sql_properties['LIKE'][] = 'testimonials.company_name';
				$sql_properties['LIKE_VALUE'][] = $search_company_name;
			}
			if($search_status != '') $filters['testimonials.status'] = $search_status;
			$this->data['testimonials'] = get_rows($filters, $sql_properties);
			$total_results = row_counter($filters, $sql_properties);
			$sql_properties['SITE_URL'] = 'admin/testimonials/manage/search/0/';
			$sql_properties['URI_SEGMENT'] = 6;
			$sql_properties['TOTAL_RESULTS'] = $total_results;
			$this->data['pagination'] = row_pagination($filters, $sql_properties);
		} //end search

		render_page("admin/template", $this->data);
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
		if($user_type != 'demo') $db_status = ajax_single_update("testimonials"); //update
        $result = (isset($db_status) && $db_status) ? 1 : 0; //set result

		ajax_response($result); return; //JSON Response
	}

}
/* End of file admin/testimonials.php */
/* Location: ./application/controllers/admin/tesimonials.php */