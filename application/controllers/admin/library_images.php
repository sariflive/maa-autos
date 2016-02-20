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
 * Library Images Controller
 *
 * @subpackage  controllers/admin
 */
class Library_images extends CI_Controller {

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
     * Controller For 'Admin library images page'
     * 
     * @access public
     * @return view
     */
	public function index()
	{
		$limit = 15;
		$user = cur_user_data();

		$this->data['module'] = 'website-pages';
		$this->data['sub_module'] = 'media-manager';
		$this->data['sub_sub_module'] = 'library-images';
		$this->data['segment'] = 'admin/media-manager/library-images/images';
		$this->data['page_header'] = '<h2><i class="fa fa-users"></i>Library Images <span>library images page</span></h2>';
        //breadcrumb
		$this->data['breadcrumb'] = '';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-home"></i> <a href="'.site_url("admin/dashboard").'">Dashboard</a><i class="fa fa-angle-right"></i></li>';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-users"></i> Library Images</li>';
		//breadcrumb
		$this->data['page'] = array(
							'pageTitle' => "Library Images"
						);
		$this->data['js_css'] = array('file_manager');
		$this->data['kc_browser_type'] = 'images';

		render_page("admin/template", $this->data);
	}
	
}
/* End of file admin/library_images.php */
/* Location: ./application/controllers/admin/library_images.php */