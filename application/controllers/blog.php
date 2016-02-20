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
 * Blog Controller
 *
 * @subpackage  controllers
 */
class Blog extends CI_Controller {

    public $data = array();    // Included view data array;

	function __construct()
	{
        // Call the Controller constructor
		parent::__construct();
		$this->config->load_db_items();	
	}

    /**
     * Blog
     *
     * @access public
     * @param $offset
     * @return mixed
     */
	public function index($offset=0)
	{
	    //widget
		$wds = widget_snippet();
		foreach($wds as $key=>$section) {
			$this->data["{$section['section_id']}"] = $section;		
		}

		$this->data['right_side'] = TRUE;
        $this->data['breadcrumbs'] = '';

        //vehicle range
        $this->data['vehicle_range'] = vehicle_range();
        //currency symbol
        $this->data['currency_symbol'] = $this->config->item("currency_symbol");

        //sql properties
		$sql_properties['SELECT'] = 'blogs.*, users.firstName, users.lastName';
		$sql_properties['TABLE'] = 'blogs';
		$sql_properties['LIMIT'] = 1;
		$sql_properties['GLUE'] = 'users';
		$sql_properties['PIECES'] = 'users.ID = blogs.user_id';

		if($offset && !is_numeric($offset)) {
		    //check blog
			$blog = get_rows(array('url'=>$offset), $sql_properties);
			if(!isset($blog['ID'])) { redirect(site_url("blog")); return; }

			if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
				//set default error message  
				$json['error'] = '';	
				if($_POST) {
				    //form validation
					$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
					$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email|xss_clean');
					$this->form_validation->set_rules('comment', 'Comment', 'trim|required|xss_clean');
					if ($this->form_validation->run() == FALSE) {
					    //if validation error
						if(validation_errors()) $json['error'] = '<div class="alert alert-danger"><i class="fa fa-cancel-circled"></i><button type="button" class="close" data-dismiss="alert">×</button><strong> Error! </strong><br/>'.validation_errors().'</div>';
					}
					else {
					    //post parsed data
					    $parsed_data = $this->parsed_data($blog['ID']);

						$db_status = save_data('blog_comments', $parsed_data);
						if($db_status) {
						    //seccess message
                            $json['error'] = '<div class="alert alert-success"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert">×</button><strong> Success! </strong>Comment Saved successfully.</div>';
                        }
						else {
						    //error message
                            $json['error'] = '<div class="alert alert-danger"><i class="fa fa-info-circled"></i><button type="button" class="close" data-dismiss="alert">×</button><strong> Error! </strong>Saved failed.</div>';
                        }
                    }
				}

				//return json message
				ajax_response($json); return; //JSON Response
			}

			//cooment sql properties
			$cooment_sql_properties['TABLE'] = 'blog_comments';
			$cooment_sql_properties['LIMIT'] = 100;
            //comments
			$this->data['comments'] = get_rows(array('blogID'=>$blog['ID'], 'status'=>'1'), $cooment_sql_properties);
			$this->data['total_comments'] = row_counter(array('blogID'=>$blog['ID'], 'status'=>'1'), $cooment_sql_properties);

            //meta data
			$this->data['page'] = array(
								'meta_title'=> $blog['title'],
								'meta_keyword'=> $blog['title'],
								'meta_description'=> $blog['title'],
								'url'=>"blog/{$offset}"
							);
			$this->data['blog'] = $blog;
			$this->data['segment'] = 'blog/blog-details';
			$this->data['page_js'] = 'blog-details';
			$blog_url = site_url("blog");
			//breadcrumbs
			$this->data['breadcrumbs'] .= "<li><a href=\"{$blog_url}\">Blog</a></li>";
			$this->data['breadcrumbs'] .= "<li class=\"active\">{$blog['title']}</li>";
			$this->data['page_title'] = "<h1>".substr($blog['title'],0,60)."</h1>";
		}
		else {
		    //meta data
			$this->data['page'] = array(
								'meta_title'=> 'Latest Blog of ' . $this->config->item('site_title'),
								'meta_keyword'=> 'Latest Blog of ' . $this->config->item('site_title'),
								'meta_description'=> 'Latest Blog of ' . $this->config->item('site_title'),
								'url'=>'blog'
							 );
            //filters
			$filters = array('blogs.status'=>'1');
            //sql properties
			$sql_properties['LIMIT'] = 2;
			$sql_properties['OFFSET'] = $offset;
            //blogs
			$this->data['blogs'] = get_rows($filters, $sql_properties);
			$sql_properties['SITE_URL'] = 'blog';
			$sql_properties['URI_SEGMENT'] = 2;
            //pagination
			$this->data['pagination'] = row_pagination($filters, $sql_properties);
			$this->data['segment'] = 'blog/blogs';
            //breadcrumbs
			$this->data['breadcrumbs'] .= "<li class=\"active\">Blog</li>";
			$this->data['page_title'] = "<h1>Blog</h1>";
		}

		render_page("template", $this->data);
	}//end blog index function

    /**
     * blog parsed data
     * 
     * @access private
     * @return array
     */
    private function parsed_data($blog_id=0)
    {
        $parsed_data = array();

        //post data
        $parsed_data['blogID'] = $blog_id;
        $parsed_data['name'] = $this->input->post("name", TRUE);
        $parsed_data['email'] = $this->input->post("email", TRUE);
        $parsed_data['website'] = $this->input->post("website", TRUE);
        $parsed_data['comment'] = $this->input->post("comment", TRUE);
        $parsed_data['status'] = '1';
        //post data

        return $parsed_data;
    }//end blog parsed data function
}
/* End of file blog.php */
/* Location: ./application/controllers/blog.php */