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
 * Media Images Controller
 *
 * @subpackage  controllers/admin
 */
class Media_images extends CI_Controller {

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
     * Controller For 'Admin media images page'
     * 
     * @access public
     * @return redirect manage
     */
	public function index()
	{
		redirect(site_url("admin/media_images/manage")); return;
	}

    /**
     * media images manage (Admin)
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

		$this->data['module'] = 'website-pages';
		$this->data['sub_module'] = 'media-manager';
		$this->data['sub_sub_module'] = 'media-images';
        $this->data['page_js'] = 'media-manager';
		$this->data['segment'] = 'admin/media-manager/media-images/images';
		$this->data['page_header'] = '<h2><i class="fa fa-asterisk"></i>Media Images List <span>media images list page</span></h2>';
		//breadcrumb
		$this->data['breadcrumb'] = '';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-home"></i> <a href="'.site_url("admin/dashboard").'">Dashboard</a><i class="fa fa-angle-right"></i></li>';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-asterisk"></i> Media Images List</li>';
		//breadcrumb
		$this->data['page'] = array(
							'pageTitle' => "Media Images List"
						);
		$this->data['mode'] = $mode;
		$this->data['media_id'] = $id;
		$id = alphaID($id, TRUE);

        //post
		if($_POST) {
		    //bulk delete
			if($mode == 'bulk_delete') {
                $row_sel = $this->input->post("row_sel", TRUE); //post rows
                ajax_bulk_delete('media', $row_sel, $user_type, './', 'url'); return; //bulk delete
			} //end bulk delete

			$this->form_validation->set_rules('type', 'Type', 'required|trim');
			$this->form_validation->set_rules('title', 'Title', 'required|trim');
			if ($this->form_validation->run() == TRUE) {
				if($user_type != 'demo') {
				    //post data
					$input_type = $this->input->post('type', TRUE);
					$input_title = $this->input->post('title', TRUE);
					$title = strtolower(url_title($input_title));
	
					$parsed_data['title'] = $input_title;
					$parsed_data['type'] = $input_type;

                    //upload image
					if(isset($_FILES['userfile']['name'])) {
						$this->load->library('upload');	
						$fileExt = strtolower(array_pop(explode(".", $_FILES['userfile']['name']))); //file name
						$config['overwrite'] = TRUE;
						$type_dirname = strtolower(str_replace(' ', '_', $input_type)); //direction name
						//client logo
						if($type_dirname == 'client_logo') {
							$config['upload_path'] = './uploads/media/client_logo/';
							$config['allowed_types'] = 'png|jpg';
							$config['file_name']  = "{$title}.{$fileExt}";
						}
                        //slider image
						else if($type_dirname == 'slider_image') {
							$config['upload_path'] = './uploads/media/slider_image/';
							$config['allowed_types'] = 'jpg|png';
							$config['file_name']  = "{$title}.{$fileExt}";
						}
                        //widget image
						else if($type_dirname == 'widget_image') {
							$config['upload_path'] = './uploads/media/widget_image/';
							$config['allowed_types'] = 'jpg|png';
							$config['file_name']  = "{$title}.{$fileExt}";
						}
                        //page banner
						else if($type_dirname == 'page_banner') {
							$config['upload_path'] = './uploads/media/page_banner/';
							$config['allowed_types'] = 'jpg|png';
							$config['file_name']  = "{$title}.{$fileExt}";
						}
                        //news
						else if($type_dirname == 'news') {
							$config['upload_path'] = './uploads/media/news/';
							$config['allowed_types'] = 'jpg|png';
							$config['file_name']  = "{$title}.{$fileExt}";
						}
                        //portfolio
						else if($type_dirname == 'portfolio') {
							$config['upload_path'] = './uploads/media/portfolio/';
							$config['allowed_types'] = 'jpg|png';
							$config['file_name']  = "{$title}.{$fileExt}";
						}
                        //photo gallery
						else if($type_dirname == 'photo_gallery') {
							$config['upload_path'] = './uploads/media/photo_gallery/';
							$config['allowed_types'] = 'jpg|png';
							$config['file_name']  = "{$title}.{$fileExt}";
						}
                        //site logo
						else if($type_dirname == 'site_logo') {
							$config['upload_path'] = './uploads/media/site_logo/';
							$config['allowed_types'] = 'jpg|png';
							$config['file_name']  = "{$title}.{$fileExt}";
						}

						$this->upload->initialize($config);
						if (!$this->upload->do_upload()) $this->data['error'] = admin_errors(4);
						else {
							$upload_data = $this->upload->data();

							$title = strtolower(url_title($parsed_data['title']));
							$url = "uploads/media/{$type_dirname}/{$upload_data['file_name']}";
							$parsed_data['url'] = $url;

                            //edit
							if($mode == 'edit') {
								//delete user image
								$check_image = get_rows(array('ID'=>$id, 'url'=>$parsed_data['url']), array('TABLE'=>'media', 'LIMIT'=>1));
								if(!isset($check_image['url'])) @unlink("./{$parsed_data['url']}");
							} //end edit
	
							$config['image_library'] = 'gd2';
							$config['source_image'] = "./uploads/media/{$upload_data['file_name']}";
							$config['create_thumb'] = FALSE;
							$config['maintain_ratio'] = TRUE;
                            //client logo
							if($type_dirname == 'client_logo') { 
								$config['width'] = $this->config->item('client_logo_width');
								$config['height'] = $this->config->item('client_logo_height');
							}
                            //slider image
							else if($type_dirname == 'slider_image'){ 
								$config['width'] = $this->config->item('slider_width');
								$config['height'] = $this->config->item('slider_height');
							}
                            //widget image
							else if($type_dirname == 'widget_image'){ 
								$config['width'] = $this->config->item('widget_image_width');
								$config['height'] = $this->config->item('widget_image_height');
							}
                            //page banner
							else if($type_dirname == 'page_banner'){ 
								$config['width'] = $this->config->item('page_banner_width');
								$config['height'] = $this->config->item('page_banner_height');
							}
                            //news
							else if($type_dirname == 'news'){ 
								$config['width'] = $this->config->item('news_image_width');
								$config['height'] = $this->config->item('news_image_height');
							}
                            //portfolio
							else if($type_dirname == 'portfolio'){ 
								$config['width'] = $this->config->item('portfolio_image_width');
								$config['height'] = $this->config->item('portfolio_image_height');
							}
                            //phtot gallery
							else if($type_dirname == 'photo_gallery'){ 
								$config['width'] = $this->config->item('photogallery_image_width');
								$config['height'] = $this->config->item('photogallery_image_height');
							}
                            //site logo
							else if($type_dirname == 'site_logo'){ 
								$config['width'] = $this->config->item('site_logo_image_width');
								$config['height'] = $this->config->item('site_logo_image_height');
							}

							$this->load->library('image_lib', $config);			
							$this->image_lib->resize();
							$upload_status = 1;
						}
					} //end upload image

					$comparison_fields = NULL;
					if($mode == 'edit') {
						$comparison_fields['NAME'] = 'ID';
						$comparison_fields['VALUE'] =	$id;		
					}
					$db_status = save_data('media', $parsed_data, $comparison_fields); //save post data
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
            ajax_single_delete('color', $id, 'ID', $user_type, './', 'url'); return; //single delete
		} //end delete

		//edit
		if($mode == 'edit') {
			$return_data = get_rows(array('ID'=>$id), array('TABLE'=>'media', 'LIMIT'=>1));
			if(isset($return_data['ID'])) $this->data['media_data'] = $return_data;
			else { $this->data['mode'] = 'add'; }
		} //end edit

		$filters = array();
		$sql_properties['TABLE'] = 'media';
		$sql_properties['LIMIT'] = $limit;
		$sql_properties['OFFSET'] = $offset;
		$sql_properties['ORDER_BY'] = 'ID';
		$sql_properties['ORDER_TYPE'] = 'desc';
        //search
		if ($mode == 'search') {
			$search_type = $this->input->get("type", TRUE);
			$search_status = $this->input->get("status", TRUE);
			if($search_type != '') $filters['media.status'] = $search_type;
			if($search_status != '') $filters['media.status'] = $search_status;
			$this->data['media_images'] = get_rows($filters, $sql_properties);
			$total_results = row_counter($filters, $sql_properties);
			$this->data['pagination'] = row_pagination($filters, array('LIMIT'=>$limit, 'TABLE'=>'media', 'SITE_URL'=>'admin/media_images/manage/search/0/', 'URI_SEGMENT'=>6, 'TOTAL_RESULTS'=>$total_results));
		} //end search
		else {
			$this->data['media_images'] = get_rows($filters, $sql_properties);
			$this->data['pagination'] = row_pagination($filters, array('LIMIT'=>$limit, 'TABLE'=>'media', 'SITE_URL'=>'admin/media_images/manage/show/0/', 'URI_SEGMENT'=>6));
		}

		render_page("admin/template", $this->data);
	}
}
/* End of file admin/media_images.php */
/* Location: ./application/controllers/admin/media_images.php */