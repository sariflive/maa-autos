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
 * Dashboard Controller
 *
 * @subpackage  controllers/admin
 */
class Dashboard extends CI_Controller {

    public $data = array();    // Included view data array;

	function __construct()
	{
        // Call the Controller constructor
		parent::__construct();
        //load model
		$this->load->model(array('admin/signin_model', 'api_model'));
        //load helper (admin, table)
		$this->load->helper(array("admin", "form"));
        //check auth user
		$this->signin_model->auth_user();
	}

    /**
     * Controller For 'Admin Dashboard Page'
     * 
     * @access public
     * @return view
     */
	public function index()
	{
		$this->data['segment'] = 'admin/dashboard';
		$this->data['page_header'] = '<h2><i class="fa fa-file-o"></i>Dashboard</h2>';
        //breadcrumb
		$this->data['breadcrumb'] = '';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-home"></i> Dashboard</li>';
        //end breadcrumb

        //callback
		$sql_properties['SELECT'] = 'callback.*, countries.name as country_name';
		$sql_properties['TABLE'] = 'callback';
		$sql_properties['LIMIT'] = 10;
		$sql_properties['ORDER_BY'] = 'callback.ID';
		$sql_properties['ORDER_TYPE'] = 'desc';
		$sql_properties['GLUE'] = 'countries';
		$sql_properties['PIECES'] = 'countries.ID = callback.countryID';
		$this->data['callback'] = get_rows(array(), $sql_properties);
        //end callback

        //enquiries
		$enquiriy_sql_properties['SELECT'] = 'vehicle_enquiries.*, countries.name as country_name, vehicles.name as vehicle_name, vehicles.ID as vehicle_ID';
		$enquiriy_sql_properties['TABLE'] = 'vehicle_enquiries';
		$enquiriy_sql_properties['LIMIT'] = 10;
		$sql_properties['ORDER_BY'] = 'vehicle_enquiries.ID';
		$sql_properties['ORDER_TYPE'] = 'desc';
		$enquiriy_sql_properties['GLUE'][] = 'countries';
		$enquiriy_sql_properties['PIECES'][] = 'countries.ID = vehicle_enquiries.countryID';
		$enquiriy_sql_properties['GLUE'][] = 'vehicles';
		$enquiriy_sql_properties['PIECES'][] = 'vehicles.vehicleCode = vehicle_enquiries.vehicleCode';
		$this->data['enquiries'] = get_rows(array(), $enquiriy_sql_properties);
        //end enquiries

		render_page('admin/template', $this->data);
	}
}
/* End of file admin/dashboard.php */
/* Location: ./application/controllers/admin/dashboard.php */