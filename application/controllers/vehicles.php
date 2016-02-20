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
 * Vehicles Controller
 *
 * @subpackage  controllers
 */
class Vehicles extends CI_Controller {

    public $data = array();    // Included view data array;

	function __construct()
	{
        // Call the Controller constructor
		parent::__construct();
		$this->config->load_db_items();
	}

     /**
     * vehicles
     *
     * @access public
     * @param $offset
     * @param $offset1
     * @return type view
     */
	public function index($offset=0, $offset1=0)
	{
		$this->data['right_side'] = TRUE;
        //breadcrumbs
		$this->data['breadcrumbs'] = '';

        //filters
		$filters = array('vehicles.status'=>'Available');
        //sql properties
        $sql_properties = $this->_sql_properties();

        //widget
		$wds = widget_snippet();
		foreach($wds as $key=>$section) {
			$this->data["{$section['section_id']}"] = $section;		
		}

        //vehicle range
        $this->data['vehicle_range'] = vehicle_range();
        //currency symbol
        $this->data['currency_symbol'] = $this->config->item("currency_symbol");

		if($offset && !is_numeric($offset)) {
			//popular vehicles
			if($offset === 'popular') {
			    $this->_popular_vehicles($this->data, $filters, $sql_properties, $offset1);
                return;
			} //popular vehicles

			//hot vehicles
			elseif($offset === 'hot') {
                $this->_hot_vehicles($this->data, $filters, $sql_properties, $offset1);
                return;
			} //hot vehicles

			//vehicle details
			else {
                $this->_vehicle_details($this->data, $filters, $sql_properties, $offset);
                return;
			}
		}
		else {
            $this->_vehicle_list($this->data, $filters, $sql_properties, $offset);
            return;
		}

        redirect(base_url());
        return;
	}//end vehicles index function

     /**
     * vehicle List
     *
     * @access private
     * @param $data array
     * @param $filters array
     * @param $sql_properties array
     * @param $offset int
     * @return type view
     */
	private function _vehicle_list($data=array(), $filters=array(), $sql_properties=array(), $offset=0)
	{
        //breadcrumbs
        $data['breadcrumbs'] .= "<li class=\"active\">Vehicles</li>";
        $data['page_title'] = "<h1><strong>Vehicles</strong> List</h1>";
        //meta data
        $data['page'] = array(
                            'meta_title'=> 'Vehicles List of ' . $this->config->item('site_title'),
                            'meta_keyword'=> 'Vehicles List of ' . $this->config->item('site_title'),
                            'meta_description'=> 'Vehicles List of ' . $this->config->item('site_title'),
                            'url'=>'vehicles'
                        );
        $data['segment'] = 'vehicles/vehicles';
        $data['show_hotcar'] = TRUE;

        //sql properties
        $sql_properties['LIMIT'] = 18;
        $sql_properties['OFFSET'] = $offset;
        $data['vehicles_recent_listing'] = get_rows($filters, $sql_properties);
        //count row
        $total_results = row_counter($filters, $sql_properties);
        $sql_properties['SITE_URL'] = 'vehicles';
        $sql_properties['URI_SEGMENT'] = 2;
        $sql_properties['TOTAL_RESULTS'] = $total_results;
        //pagination
        $data['pagination'] = row_pagination($filters, $sql_properties);

        //hot vehicles listing
        $data['hot_vehicles_listing'] = $this->_hot_vehicles_listing($sql_properties);
        //hot vehicles listing
        render_page("template", $data);
	}

	private function _vehicle_details($data=array(), $filters=array(), $sql_properties=array(), $url='')
	{
        //filters
        $filters['vehicles.url'] = $url;
        $sql_properties['LIMIT'] = 1;
        //check vehicle
        $vehicle_details = get_rows($filters, $sql_properties);
        if(!isset($vehicle_details['ID'])) { redirect(site_url("vehicles")); }
        //vehicle images
        $data['vehicle_images'] = get_rows(array('vehicleID'=>$vehicle_details['ID']), array('TABLE'=>'vehicle_images', 'LIMIT'=>20, 'ORDER_BY'=>'sequence', 'ORDER_TYPE'=>'asc'));
        $data['feature_title'] = get_rows(array('status'=>'1'), array('TABLE'=>'feature_title', 'LIMIT'=>20, 'ORDER_BY'=>'title', 'ORDER_TYPE'=>'asc'));
        //increment popularity
        set_data(array('ID'=>$vehicle_details['ID']), array('TABLE'=>'vehicles', 'SET_FIELD'=>'popularity'));

        $vehicles_url = site_url("vehicles");
        //breadcrumbs
        $data['breadcrumbs'] .= "<li><a href=\"{$vehicles_url}\">Vehicles</a></li>";
        $data['breadcrumbs'] .= "<li class=\"active\">{$vehicle_details['name']}</li>";
        $data['page_title'] = "<h1><strong>{$vehicle_details['name']}</strong></h1>";
        //meta data
        $data['page'] = array(
                            'meta_title'=> $vehicle_details['meta_title'],
                            'meta_keyword'=> $vehicle_details['meta_keyword'],
                            'meta_description'=> $vehicle_details['meta_description'],
                            'url'=>"vehicles/{$url}"
                        );
        $data['vehicle'] = $vehicle_details;
        $data['car_details'] = TRUE;
        $data['segment'] = 'vehicles/vehicle-details';

        //hot vehicles listing
        $data['hot_vehicles_listing'] = $this->_hot_vehicles_listing($sql_properties);
        //hot vehicles listing
        render_page("template", $data);
	}

	private function _hot_vehicles($data=array(), $filters=array(), $sql_properties=array(), $offset=0)
	{
        //breadcrumbs
        $data['breadcrumbs'] .= "<li class=\"active\">Hot Vehicles</li>";
        $data['page_title'] = "<h1><strong>Hot Vehicles</strong> List</h1>";
        //meta data
        $data['page'] = array(
                            'meta_title'=> 'Hot Vehicles List of ' . $this->config->item('site_title'),
                            'meta_keyword'=> 'Hot Vehicles List of ' . $this->config->item('site_title'),
                            'meta_description'=> 'Hot Vehicles List of ' . $this->config->item('site_title'),
                            'url'=>'vehicles/hot'
                        );
        $data['segment'] = 'vehicles/vehicles';
        $data['show_hotcar'] = TRUE;

        //sql properties
        $sql_properties['LIMIT'] = 18;
        $sql_properties['OFFSET'] = $offset;
        $data['vehicles_recent_listing'] = get_rows($filters, $sql_properties);
        //count row
        $total_results = row_counter($filters, $sql_properties);
        $sql_properties['SITE_URL'] = 'vehicles/hot';
        $sql_properties['URI_SEGMENT'] = 3;
        $sql_properties['TOTAL_RESULTS'] = $total_results;
        //pagination
        $data['pagination'] = row_pagination($filters, $sql_properties);

        //hot vehicles listing
        $data['hot_vehicles_listing'] = $this->_hot_vehicles_listing($sql_properties);
        //hot vehicles listing
        render_page("template", $data);
	}

	private function _popular_vehicles($data=array(), $filters=array(), $sql_properties=array(), $offset=0)
	{
        //breadcrumbs
        $data['breadcrumbs'] .= "<li class=\"active\">Popular Vehicles</li>";
        $data['page_title'] = "<h1><strong>Popular Vehicles</strong> List</h1>";
        //meta data
        $data['page'] = array(
                            'meta_title'=> 'Popular Vehicles List of ' . $this->config->item('site_title'),
                            'meta_keyword'=> 'Popular Vehicles List of ' . $this->config->item('site_title'),
                            'meta_description'=> 'Popular Vehicles List of ' . $this->config->item('site_title'),
                            'url'=>'vehicles/popular'
                        );
        $data['segment'] = 'vehicles/vehicles';
        $data['show_hotcar'] = TRUE;

        //sql properties
        $sql_properties['ORDER_BY'] = 'popularity';
        $sql_properties['ORDER_TYPE'] = 'desc';
        $sql_properties['LIMIT'] = 18;
        $sql_properties['OFFSET'] = $offset;
        //recent vehicle listing
        $data['vehicles_recent_listing'] = get_rows($filters, $sql_properties);
        //row count
        $total_results = row_counter($filters, $sql_properties);
        $sql_properties['SITE_URL'] = 'vehicles/popular';
        $sql_properties['URI_SEGMENT'] = 3;
        $sql_properties['TOTAL_RESULTS'] = $total_results;
        //pagination
        $data['pagination'] = row_pagination($filters, $sql_properties);

        //hot vehicles listing
        $data['hot_vehicles_listing'] = $this->_hot_vehicles_listing($sql_properties);
        //hot vehicles listing
        render_page("template", $data);
	}

    private function _hot_vehicles_listing($sql_properties=array())
    {
        $sql_properties['LIMIT'] = 2;
        $sql_properties['ORDER_BY'] = 'hotcar';
        $sql_properties['ORDER_TYPE'] = 'random';
        return get_rows(array('vehicles.status !='=>'Sold out'), $sql_properties);
    }

    private function _sql_properties()
    {
        $sql_properties = array();

        $sql_properties['SELECT'] = 'vehicles.*, showrooms.dealership_name, makers.name as maker_name, models.model as model_name, vehicle_types.type_name, fuel_types.name as fuel_name, transmissions.name as transmission_name';
        $sql_properties['TABLE'] = 'vehicles';
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
        $sql_properties['GLUE'][] = 'fuel_types';
        $sql_properties['PIECES'][] = 'fuel_types.ID = vehicles.fuelID';
        $sql_properties['GLUE'][] = 'transmissions';
        $sql_properties['PIECES'][] = 'transmissions.ID = vehicles.transmissionID';

        return $sql_properties;
    }
}
/* End of file vehicles.php */
/* Location: ./application/controllers/vehicles.php */