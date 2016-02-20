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
 * Search Controller
 *
 * @subpackage  controllers
 */
class Search extends CI_Controller {

    public $data = array();    // Included view data array;
	
	function __construct()
	{
        // Call the Controller constructor
		parent::__construct();
		$this->config->load_db_items();	
	}

    /**
     * search
     *
     * @access public
     * @return type view
     */
	public function index($offset=0)
	{
	    //wigets
		$wds = widget_snippet();
		foreach($wds as $key=>$section) {
			$this->data["{$section['section_id']}"] = $section;	
		}

        //meta data
		$this->data['page'] = array(
							'meta_title'=> 'Search Vehicles - ' . $this->config->item('site_title'),
							'meta_keyword'=> 'Search Vehicles - ' . $this->config->item('site_title'),
							'meta_description'=> 'Search Vehicles - ' . $this->config->item('site_title'),
							'url'=>'search'
						);
        //breadcrumbs
		$this->data['breadcrumbs'] = '';
		$this->data['breadcrumbs'] .= "<li class=\"active\">Search</li>";
        //breadcrumbs
		$this->data['page_title'] = "<h1>Search <strong>Vehicles</strong></h1>";

		$this->data['segment'] = 'search/search';
        //vehicle range
        $this->data['vehicle_range'] = vehicle_range();
        //currency symbol
        $this->data['currency_symbol'] = $this->config->item("currency_symbol");

        //start if get
		if($_GET) {
			$this->data['right_side'] = TRUE;
			$this->data['segment'] = 'vehicles/vehicles';
            //filters
			$filters = array('vehicles.status'=>'Available');
            //sql properties
			$sql_properties['SELECT'] = 'vehicles.*, showrooms.dealership_name, makers.name as maker_name, models.model as model_name, vehicle_types.type_name, conditions.name as condition_name, fuel_types.name as fuel_name';
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
			$sql_properties['GLUE'][] = 'transmissions';
			$sql_properties['PIECES'][] = 'transmissions.ID = vehicles.transmissionID';
			$sql_properties['GLUE'][] = 'color';
			$sql_properties['PIECES'][] = 'color.ID = vehicles.interior_color';
			$sql_properties['GLUE'][] = 'conditions';
			$sql_properties['PIECES'][] = 'conditions.ID = vehicles.conditionID';
			$sql_properties['GLUE'][] = 'fuel_types';
			$sql_properties['PIECES'][] = 'fuel_types.ID = vehicles.fuelID';
			$sql_properties['LIMIT'] = 18;
			$sql_properties['OFFSET'] = $offset;

            //name
			$name = $this->input->get("name", TRUE);
			if($name) {
				$sql_properties['LIKE'][] = 'vehicles.name';
				$sql_properties['LIKE_VALUE'][] = $name;
			}

            //maker
			$maker = $this->input->get("maker", TRUE);
			if($maker) $filters['makers.name'] = $maker;

            //model
			$model = $this->input->get("model", TRUE);
			if($model) $filters['models.model'] = $model;

            //year
			$year = $this->input->get("year", TRUE);
			if($year) $filters['vehicles.year'] = $year;

            //condition
			$condition = $this->input->get("condition", TRUE);
			if($condition) $filters['conditions.name'] = $condition;

            //fuel
			$fuel = $this->input->get("fuel", TRUE);
			if($fuel) $filters['fuel_types.name'] = $fuel;

            //transmissions
			$transmission = $this->input->get("transmission", TRUE);
			if($transmission) $filters['transmissions.name'] = $transmission;

            //drive
			$drive = $this->input->get("drive", TRUE);
			if($drive) $filters['vehicles.drive'] = $drive;

            //interior color
			$interior_color = $this->input->get("interior_color", TRUE);
			if($interior_color) {
				$sql_properties['LIKE'][] = 'color.color';
				$sql_properties['LIKE_VALUE'][] = $interior_color;
			}

            //exterior color
			$exterior_color = $this->input->get("exterior_color", TRUE);
			if($exterior_color) {
				$sql_properties['LIKE'][] = 'color.color';
				$sql_properties['LIKE_VALUE'][] = $exterior_color;
			}

            //seats
			$seats = $this->input->get("seats", TRUE);
			if($seats) $filters['vehicles.seats'] = $seats;

            //doors
			$doors = $this->input->get("doors", TRUE);
			if($doors) $filters['vehicles.doors'] = $doors;

            //hot car
			$hotcar = $this->input->get("hotcar", TRUE);
			if($hotcar != '') $filters['vehicles.hotcar'] = $hotcar;

            //engine
			$engine = $this->input->get("engine", TRUE);
			if($engine) {
				$sql_properties['LIKE'][] = 'vehicles.engine';
				$sql_properties['LIKE_VALUE'][] = $engine;
			}

			$min_price = '';
			$max_price = '';
			$min_mileage = '';
			$max_mileage = '';
            //price
			$price = $this->input->get("price", TRUE);
			if($price) {
				$price = @explode(',', $price);
				$min_price = (isset($price[0])) ? $price[0] : 0;
				$max_price = (isset($price[1])) ? $price[1] : 0;
			}
            //mileage
			$mileage = $this->input->get("cc", TRUE);
			if($mileage) {
				$mileage = @explode(',', $mileage);
				$min_mileage = (isset($mileage[0])) ? $mileage[0] : 0;
				$max_mileage = (isset($mileage[1])) ? $mileage[1] : 0;
			}

            //sql query (price and mileage)
			$sql = '';
			if($min_price !='' && $max_price !='' && $min_mileage !='' && $max_mileage !='') {
				$sql = "(`cars`.`price` >= '{$min_price}' AND `cars`.`price` <= '{$max_price}') AND  (`cars`.`cc` >= '{$min_mileage}' AND `cars`.`cc` <= '{$max_mileage}')";
			}
			elseif ($min_price !='' && $max_price !='') {
				$sql = "(`cars`.`price` >= '{$min_price}' AND `cars`.`price` <= '{$max_price}')";
			}
			elseif ($min_mileage !='' && $max_mileage !='') {
				$sql = "(`cars`.`cc` >= '{$min_mileage}' AND `cars`.`cc` <= '{$max_mileage}')";
			}
			$sql_properties['SQL_WHERE'] = $sql;
            //sql query (price and mileage)

            //features
			$features = get_rows(array(), array('TABLE'=>'features', 'LIMIT'=>1000));
			foreach ($features as $key => $value) {
				$featureID = alphaID($value['ID']);
				$selected_feature = $this->input->get("{$featureID}", TRUE);
				if($selected_feature) {
					$sql_properties['LIKE'][] = 'vehicles.options';
					$sql_properties['LIKE_VALUE'][] = $value['feature'];
				}
			}
            //features

            //vehicles
			$this->data['vehicles_recent_listing'] = get_rows($filters, $sql_properties);
            //count row
			$total_results = row_counter($filters, $sql_properties);
			$sql_properties['SITE_URL'] = 'search';
			$sql_properties['URI_SEGMENT'] = 2;
			$sql_properties['TOTAL_RESULTS'] = $total_results;
			//pagination
			$this->data['pagination'] = row_pagination($filters, $sql_properties);
		}
        //end if get

		render_page("template", $this->data);
	}//end search index function
}
/* End of file search.php */
/* Location: ./application/controllers/search.php */