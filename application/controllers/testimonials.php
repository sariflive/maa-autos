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
 * @subpackage  controllers
 */
class Testimonials extends CI_Controller {

    public $data = array();    // Included view data array;

	function __construct()
	{
        // Call the Controller constructor
		parent::__construct();
		$this->config->load_db_items();	
	}

     /**
     * testimonials
     *
     * @access public
     * @param $offset
     * @return mixed
     */
	public function index($offset=0)
	{
		$this->data['right_side'] = TRUE;

        //widget
		$wds = widget_snippet();
		foreach($wds as $key=>$section) {
			$this->data["{$section['section_id']}"] = $section;		
		}

        //vehicle range
        $this->data['vehicle_range'] = vehicle_range();
        //currency symbol
        $this->data['currency_symbol'] = $this->config->item("currency_symbol");

        //meta data
		$this->data['page'] = array(
							'meta_title'=> 'Testimonials From Our Great Customers - ' . $this->config->item('site_title'),
							'meta_keyword'=> 'Testimonials From Our Great Customers - ' . $this->config->item('site_title'),
							'meta_description'=> 'Testimonials From Our Great Customers - ' . $this->config->item('site_title'),
							'url'=>'testimonials'
						);
        //breadcrumbs
		$this->data['breadcrumbs'] = "";
		$this->data['breadcrumbs'] .= "<li class=\"active\">Testimonials</li>";
		$this->data['page_title'] = "<h1>Testimonials</h1>";

        //filters
		$filters = array('status'=>'1');
        //sql properties
		$sql_properties['TABLE'] = 'testimonials';
		$sql_properties['LIMIT'] = 10;
		$sql_properties['OFFSET'] = $offset;
        //testimonials
		$this->data['testimonials'] = get_rows($filters, $sql_properties);
		$sql_properties['SITE_URL'] = 'testimonials/';
		$sql_properties['URI_SEGMENT'] = 2;
        //pagination
		$this->data['pagination'] = row_pagination($filters, $sql_properties);
		$this->data['segment'] = 'testimonials/testimonials';
		render_page('template', $this->data);
	}//end testimonial index function
}
/* End of file testimonials.php */
/* Location: ./application/controllers/testimonials.php */