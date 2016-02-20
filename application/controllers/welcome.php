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
 * Welcome Controller
 *
 * The base controller which displays the homepage of the Maa Autos site.
 * 
 * @subpackage  controllers
 */
class Welcome extends CI_Controller {

    public $data = array();    // Included view data array;
	
	function __construct()
	{
        // Call the Controller constructor
		parent::__construct();
		$this->config->load_db_items();	
	}

     /**
     * home page
     *
     * @access public
     * @return type view
     */
	public function index()
	{
	    //widget
		$wds = widget_snippet();
		foreach($wds as $key=>$section) {
			$this->data["{$section['section_id']}"] = $section;	
		}

        //vehicle range
        $this->data['vehicle_range'] = vehicle_range();
        //currency symbol
        $this->data['currency_symbol'] = $this->config->item("currency_symbol");

		//slider images
		$this->data['slider'] = TRUE;
		$this->data['slider_image']  = get_rows(array('type'=>'Slider Image', 'status'=>'1'), array('TABLE'=>'media', 'LIMIT'=>25));

		//recent vehicle listing
		$sql_properties['SELECT'] = 'vehicles.*, showrooms.dealership_name, makers.name as maker_name, models.model as model_name, vehicle_types.type_name';
		$sql_properties['TABLE'] = 'vehicles';
		$sql_properties['LIMIT'] = 15;
		$sql_properties['ORDER_BY'] = 'ID';
		$sql_properties['ORDER_TYPE'] = 'desc';
		$sql_properties['GLUE'][] = 'showrooms';
		$sql_properties['PIECES'][] = 'showrooms.ID = vehicles.showroomID';
		$sql_properties['GLUE'][] = 'makers';
		$sql_properties['PIECES'][] = 'makers.ID = vehicles.makerID';
		$sql_properties['GLUE'][] = 'models';
		$sql_properties['PIECES'][] = 'models.ID = vehicles.modelID';
		$sql_properties['GLUE'][] = 'vehicle_types';
		$sql_properties['PIECES'][] = 'vehicle_types.ID = vehicles.typeID';
		$this->data['vehicles_recent_listing'] = get_rows(array('vehicles.status !='=>'Sold out'), $sql_properties);
		//recent vehicle listing

		//popular vehicle
		$sql_properties['LIMIT'] = 3;
		$sql_properties['ORDER_BY'] = 'popularity';
		$sql_properties['ORDER_TYPE'] = 'desc';
		$this->data['vehicles_popular_listing'] = get_rows(array('vehicles.status !='=>'Sold out'), $sql_properties);
		//popular vehicle

		//hot vehicle for top
		$sql_properties['LIMIT'] = 15;
		$sql_properties['ORDER_BY'] = 'hotcar';
		$sql_properties['ORDER_TYPE'] = 'desc';
		$this->data['top_hot_vehicles_listing'] = get_rows(array('vehicles.status !='=>'Sold out'), $sql_properties);
		//hot vehicle for top

		//hot vehicle
		$sql_properties['LIMIT'] = 2;
		$sql_properties['ORDER_BY'] = 'hotcar';
		$sql_properties['ORDER_TYPE'] = 'random';
		$this->data['hot_vehicles_listing'] = get_rows(array('vehicles.status !='=>'Sold out'), $sql_properties);
		//hot vehicle

		//recent news 
		$this->data['recent_news']  = get_rows(array('status'=>'1'), array('TABLE'=>'news', 'LIMIT'=>3, 'ORDER_BY'=>'publish_date', 'ORDER_TYPE'=>'desc'));
		$this->data['segment'] = 'welcome';
		render_page("template", $this->data);
	}//end home page
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */