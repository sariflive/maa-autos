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
 * Contents Controller
 *
 * @subpackage  controllers
 */
class Contents extends CI_Controller {

    public $data = array();    // Included view data array;

	function __construct()
	{
        // Call the Controller constructor
		parent::__construct();
		$this->config->load_db_items();	
	}

    /**
     * Contents
     *
     * @access public
     * @param $page_url
     * @return mixed
     */
	public function index($page_url='')
	{
	    //check page url
		if(empty($page_url) || is_numeric($page_url)) { redirect(base_url()); return; }

        //widget
		$wds = widget_snippet();
		foreach($wds as $key=>$section) {
			$this->data["{$section['section_id']}"] = $section;		
		}

        //vehicle range
        $this->data['vehicle_range'] = vehicle_range();
        //currency symbol
        $this->data['currency_symbol'] = $this->config->item("currency_symbol");

        //check page
		$page = get_rows(array('url'=>$page_url, 'status'=>'1'), array('TABLE'=>'pages', 'LIMIT'=>1));
		if(!isset($page['page'])) { redirect(base_url()); return; }

        //meta data
		$this->data['page'] = array(
							'meta_title' => $page['meta_title'],
							'meta_keyword' => $page['meta_keyword'],
							'meta_description' => $page['meta_description'],
							'url' =>"{$page_url}",
							'page_banner' => $page['page_banner'],
							'page_title' => $page['page']
						);
		$this->data['page_data'] = $page;
		$this->data['right_side'] = TRUE;
        //breadcrumbs
		$this->data['breadcrumbs'] = '';
		$this->data['breadcrumbs'] .= "<li class=\"active\">{$page['page']}</li>";
        //breadcrumbs
		$this->data['page_title'] = "<h1>{$page['page']}</h1>";

		$this->data['segment'] = 'contents';
		render_page("template", $this->data);
	}
}
/* End of file contents.php */
/* Location: ./application/controllers/contents.php */