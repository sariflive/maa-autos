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
 * Faqs Controller
 *
 * @subpackage  controllers
 */
class Faqs extends CI_Controller {

    public $data = array();    // Included view data array;

	function __construct()
	{
        // Call the Controller constructor
		parent::__construct();
		$this->config->load_db_items();	
	}

    /**
     * faqs
     *
     * @access public
     * @return mixed
     */
	public function index()
	{
	    //get all faqs from database
		$faqs = get_rows(array('status'=>'1'), array('TABLE'=>'faqs', 'LIMIT'=>100));		
		$this->data['faqs']  = $faqs;

        //vehicle range
        $this->data['vehicle_range'] = vehicle_range();
        //currency symbol
        $this->data['currency_symbol'] = $this->config->item("currency_symbol");

        //widget
		$wds = widget_snippet();
		foreach($wds as $key=>$section) {
			$this->data["{$section['section_id']}"] = $section;		
		}

        //meta data
		$this->data['page'] = array(
							'meta_title'=> 'Frequently Asked Question ' . $this->config->item('site_title'),
							'meta_keyword'=> 'Frequently Asked Question ' . $this->config->item('site_title'),
							'meta_description'=> 'Frequently Asked Question ' . $this->config->item('site_title'),
							'url'=>'faqs'
						);
		$this->data['right_side'] = TRUE;
        //breadcrumbs
		$this->data['breadcrumbs'] = '';
		$this->data['breadcrumbs'] .= "<li class=\"active\">FAQ</li>";
        //breadcrumbs
		$this->data['page_title'] = "<h1>Frequently Asked <strong>Questions</strong></h1>";
		$this->data['segment'] = 'faqs';
		render_page("template", $this->data);
	}//end faqs index function	
}
/* End of file faqs.php */
/* Location: ./application/controllers/faqs.php */