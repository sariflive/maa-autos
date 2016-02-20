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
 * News Controller
 *
 * @subpackage  controllers
 */
class News extends CI_Controller {

    public $data = array();    // Included view data array;

	function __construct()
	{
        // Call the Controller constructor
		parent::__construct();
		$this->config->load_db_items();	
	}

    /**
     * news
     *
     * @access public
     * @param $offset
     * @return mixed
     */
	public function index($offset=0)
	{
	    //widget
		$wds = widget_snippet();
		foreach($wds as $key => $section) {
			$this->data["{$section['section_id']}"] = $section;		
		}

		$this->data['right_side'] = TRUE;
        //breadcrumbs
		$this->data['breadcrumbs'] = '';

        //vehicle range
        $this->data['vehicle_range'] = vehicle_range();
        //currency symbol
        $this->data['currency_symbol'] = $this->config->item("currency_symbol");

		if($offset && !is_numeric($offset)) {
		    //check news
			$news = get_rows(array('url'=>$offset), array('TABLE'=>'news', 'LIMIT'=>1));
			if(!isset($news['ID'])) { redirect(site_url("news")); return; }

            //meta data
			$this->data['page'] = array(
								'meta_title'=> $news['title'],
								'meta_keyword'=> $news['title'],
								'meta_description'=> $news['title'],
								'url'=>"news/{$offset}"
							);
			$news_url = site_url("news");
            //breadcrumbs
			$this->data['breadcrumbs'] .= "<li><a href=\"{$news_url}\">News</a></li>";
			$this->data['breadcrumbs'] .= "<li class=\"active\">{$news['title']}</li>";
			$this->data['page_title'] = "<h1>{$news['title']}</h1>";
			$this->data['news'] = $news;
			$this->data['segment'] = 'news/news-details';
		}
		else {
           //meta data
			$this->data['page'] = array(
								'meta_title'=> 'Latest News of ' . $this->config->item('site_title'),
								'meta_keyword'=> 'Latest News of ' . $this->config->item('site_title'),
								'meta_description'=> 'Latest News of ' . $this->config->item('site_title'),
								'url'=>'news'
							 );

            //filters
			$filters = array('status'=>'1');
            //sql properties
			$sql_properties['TABLE'] = 'news';
			$sql_properties['LIMIT'] = 10;
			$sql_properties['OFFSET'] = $offset;
			$sql_properties['ORDER_BY'] = 'publish_date';
			$sql_properties['ORDER_TYPE'] = 'desc';
            //news
			$this->data['news'] = get_rows($filters, $sql_properties);
			$sql_properties['SITE_URL'] = 'news';
			$sql_properties['URI_SEGMENT'] = 2;
            //pagination
			$this->data['pagination'] = row_pagination($filters, $sql_properties);
			$this->data['segment'] = 'news/news';
            //breadcrumbs
			$this->data['breadcrumbs'] .= "<li class=\"active\">News</li>";
			$this->data['page_title'] = "<h1>News</h1>";
		}

		render_page("template", $this->data);
	}//end news index function
}
/* End of file news.php */
/* Location: ./application/controllers/news.php */