<?php
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
 * Site Helper
 *
 * @subpackage  helpers/
 */

if ( ! function_exists('render_page')) {
    //start render page function
    function render_page($view, $data = null, $render = false)
    {
        $ci = & get_instance();
        return $ci->batch_model->render_page($view, $data, $render);
    }//end render page fun
 }
 
 if ( ! function_exists('get_rows')) {
    //get rows function with filter and sql properties
    function get_rows($filters = array(), $sql_properties = array())
    {
    	$ci = & get_instance();
    	return $ci->batch_model->get_rows($filters, $sql_properties);
    }//end get rows fun
 }

if ( ! function_exists('save_data')) {
    //save data function
    function save_data($table = NULL, $data = NULL, $comparison_fields = NULL)
    {
    	$ci = & get_instance();
    	return $ci->batch_model->save_data($table, $data, $comparison_fields);
    }//end save data function
}

if ( ! function_exists('delete_rows')) {
    //delete rows function
    function delete_rows($table = NULL, $comparison_fields = NULL, $row_ids = NULL)
    {
    	$ci = & get_instance();
    	return $ci->batch_model->delete_rows($table, $comparison_fields, $row_ids);
    }//end delete rows function
}

if ( ! function_exists('ajax_single_update')) {
    //ajax single update function
    function ajax_single_update($table = NULL)
    {
    	$ci = & get_instance();
    	return $ci->batch_model->ajax_single_update($table);
    }//endajax single update function
}

if ( ! function_exists('row_pagination')) {
    //pagination function
    function row_pagination($filters = array(), $sql_properties = NULL)
    {
    	$ci = & get_instance();
    	return $ci->batch_model->row_pagination($filters, $sql_properties);
    }//end pagination function
}

if ( ! function_exists('row_counter')) {
    //table row counter function
    function row_counter($filters = array(), $sql_properties = NULL)
    {
    	$ci = & get_instance();
    	return $ci->batch_model->row_counter($filters, $sql_properties);
    }//end table row counter function
}

if ( ! function_exists('set_data')) {
    //set table row data function
    function set_data($filters = array(), $sql_properties = array())
    {
    	$ci = & get_instance();
    	return $ci->batch_model->set_data($filters, $sql_properties);
    }//end set table row data function
}

if ( ! function_exists('menus')) {
    //get menus list from database
    function menus($filters = array())
    {
    	$ci = & get_instance();
    	return $ci->site_library->menus($filters);
    }//end get menus list from database
}

if ( ! function_exists('widget_menu')) {
    //get widget menu from database
    function widget_menu($filters = array())
    {
    	$ci = & get_instance();
    	return $ci->site_library->widget_menu($filters);
    }//end get widget menu from database
}

if ( ! function_exists('widget_snippet')) {
    //get widget snippet with table rows section_id from database
    function widget_snippet()
    {
    	$data = array();
    
    	$widgets = get_rows(array('status'=>'1'), array('TABLE'=>'widgets', 'LIMIT'=>100));
    	foreach($widgets as $key=>$section) {
    		$data["{$section['section_id']}"] = $section;		
    	}
    
    	return $data;
    }//end get widget snippet with table rows section_id from database
}

if ( ! function_exists('users_rules')) {
    //user rules function
    function users_rules($filters = array(), $check_addon = FALSE, $preg_match = FALSE)
    {
    	$ci = & get_instance();
    	return $ci->site_library->users_rules($filters, $check_addon, $preg_match);
    }//end user rules function
}

if ( ! function_exists('cur_sess')) {
    //current session function
    function cur_sess()
    {
    	$ci = & get_instance();
    	return $ci->site_library->cur_sess();
    }//end current session function
}

if ( ! function_exists('options')) {
    //options list function
    function options($filters = array(), $sql_properties = array()) {
    	$ci = & get_instance();
    	return $ci->site_library->options($filters, $sql_properties);
    }//endoptions list function
}

if ( ! function_exists('cur_user_data')) {
    //current user dara function
    function cur_user_data()
    {
    	$cur_sess = cur_sess();
    	return get_rows(array('id'=>$cur_sess['sessUserID']), array('TABLE'=>'users', 'LIMIT'=>1));
    }//end current user dara function
}

if ( ! function_exists('create_folder')) {
    //create directory function
    function create_folder($path = '') {
    	if(!file_exists($path)) {
    	   @mkdir($path);
    	}
    	return;
    }//end create directory function
}

if ( ! function_exists('site_errors')) {
    //site errors function
    function site_errors($error = 0, $msg = '')
    {
        $ci = & get_instance();
        return $ci->site_library->admin_errors($error, $msg);
    }//end site errors function
}

if ( ! function_exists('vehicle_range')) {
    //site errors function
    function vehicle_range()
    {
        $ci = & get_instance();
        return $ci->site_library->vehicle_range();
    }//end site errors function
}

if ( ! function_exists('social_network')) {
    //company social network function
    function social_network()
    {
        $ci = & get_instance();
        return $ci->site_library->social_network();
    }//end company social network function
}

if ( ! function_exists('company_contact')) {
    //company contact information function
    function company_contact()
    {
        $ci = & get_instance();
        return $ci->site_library->company_contact();
    }//end company contact informations function
}

if ( ! function_exists('get_enum_values')) {
    //DB Forge - Enum Field
    function get_enum_values($table = '',$list = FALSE)
    {
    	$CI =& get_instance();

    	// Another Custom Function to Check Exists Files
    	if(!function_exists('check_file')) { $CI->load->helper('file'); }

    	// path + filename ( filename = tablename )
    	$file = $CI->config->item('system_file_path').'system/list/'.$table;

    	// Check if File exists
    	if(file_exists($file)) {
    		// File exists = No need to do MySQL Request
    		// Get the Data
    		$data = read_file($file);
    		// Unserialize the Return Data
    		$return = unserialize($data);
    		// In the Case several Lists are request
    		// return as array
    	    if($list){return (array_key_exists($list,$return)) ? $return[$list] : $return; }
    	    else{ return $return;}
    	}
    	else {
    		// File doesn't exists
    		// Prepare MySql Query 
    		// The Query asked only for type 'enum'
    		$sql    =    'SHOW COLUMNS FROM '.$CI->db->dbprefix($table).' WHERE type LIKE "enum%"';
    		$query    =    $CI->db->query($sql);

    		if($query->num_rows() > 0){
    		    foreach($query->result() as $item){
    				// Clean Up the Typ List
    				// preg_match is a mighty function
    				// to mighty for the little function
    				// so, just str_replace is enough
    				$tmp_array_list = explode(',',    str_replace(array('enum(',')',"'"),'',$item->Type) );
    
    				// prepare every single enum field as list                            
    				foreach($tmp_array_list as $entry){
    				    $lists[$item->Field][$entry] = ucwords($entry);
    				}
    				// the first entry isn't 0 ( is 1 )
    				// 0 is empty
    				// add NULL (0) as first array entry 
    				array_unshift($lists[$item->Field], NULL);
    			}

    			// write the serialize lists on the table file
    			write_file($file, serialize($lists));
    
    			// Asked several list = return as array
                if($list){
                	return (array_key_exists($list,$lists)) ? $lists[$list] : $lists;
                }
                else{
                	return $lists;
                }
    		}
    	}
    }
}

if ( ! function_exists('alphaID')) {
    //create dynamic id
    function alphaID($in, $to_num = false, $pass_key = 'Maa-Autos', $pad_up = 8)
    {
    	$out   =   '';
      	$index = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      	$base  = @strlen($index);
    
      	if ($pass_key !== null) {		
        	for ($n = 0; $n < strlen($index); $n++) {
          		$i[] = @substr($index, $n, 1);
        	}
    
        	$pass_hash = @hash('sha256', $pass_key);
        	$pass_hash = (@strlen($pass_hash) < @strlen($index) ? @hash('sha512', $pass_key) : $pass_hash);
    
        	for ($n = 0; $n < strlen($index); $n++) {
          		$p[] =  @substr($pass_hash, $n, 1);
        	}
    
        	@array_multisort($p, SORT_DESC, $i);
        	$index = @implode($i);
      	}
    
      	if ($to_num) {
        	// Digital number  <<--  alphabet letter code
        	$len = @strlen($in) - 1;
    
        	for ($t = $len; $t >= 0; $t--) {
          		$bcp = @bcpow($base, $len - $t);
          		$out = $out + @strpos($index, @substr($in, $t, 1)) * $bcp;
        	}
    
        	if (@is_numeric($pad_up)) {
          		$pad_up--;
    
          		if ($pad_up > 0)$out -= @pow($base, $pad_up);
        	}
      	}
      	else {
        	// Digital number  -->>  alphabet letter code
        	if (@is_numeric($pad_up)) {
          		$pad_up--;
    
          		if ($pad_up > 0) $in += @pow($base, $pad_up);
        	}
    
        	for ($t = ($in != 0 ? @floor(@log($in, $base)) : 0); $t >= 0; $t--) {
          		$bcp = @bcpow($base, $t);
          		$a   = @floor($in / $bcp) % $base;
          		$out = $out . @substr($index, $a, 1);
          		$in  = $in - ($a * $bcp);
        	}
      	}
    
      return $out;
    }//end create dynamic id
}

if ( ! function_exists('clean_data')) {
    function clean_data($string = '', $htmlspecialchars = FALSE)
    {
        //remove data image
        $string = @preg_replace('#data:image/[^;]+;base64,#', '', $string);
        //remove script tags
        $string = @preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $string);
        //double check script tags
        $string = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $string);
        //check $htmlspecialchars is TRUE
        if($htmlspecialchars) $string = htmlspecialchars($string);
    
        return $string;
    }
}

if ( ! function_exists('close_tags')) {
    //dynamically close all tags
    function close_tags($string='')
    {
        $string = clean_data($string);
        // coded by Constantin Gross <connum at googlemail dot com> / 3rd of June, 2006
        // (Tiny little change by Sarre a.k.a. Thijsvdv)
        $donotclose = array('br','img','input', 'hr'); //Tags that are not to be closed
    
        //prepare vars and arrays
        $tagstoclose='';
        $tags=array();
    
        //put all opened tags into an array  /<(([A-Z]|[a-z]).*)(( )|(>))/isU
        @preg_match_all("/<(([A-Z]|[a-z]).*)(( )|(>))/isU",$string,$result);
        $openedtags=$result[1];
        // Next line escaped by Sarre, otherwise the order will be wrong
        // $openedtags=array_reverse($openedtags);
    
        //put all closed tags into an array
        @preg_match_all("/<\/(([A-Z]|[a-z]).*)(( )|(>))/isU",$string,$result2);
        $closedtags=$result2[1];
    
        //look up which tags still have to be closed and put them in an array
        for ($i=0;$i<count($openedtags);$i++) {
           if (in_array($openedtags[$i],$closedtags)) { unset($closedtags[array_search($openedtags[$i],$closedtags)]); }
               else array_push($tags, $openedtags[$i]);
        }
    
        $tags = array_reverse($tags); //now this reversion is done again for a better order of close-tags
    
        //prepare the close-tags for output
        for($x=0;$x<count($tags);$x++) {
        	$add=strtolower(trim($tags[$x]));
        	if(!in_array($add,$donotclose)) $tagstoclose.='</'.$add.'>';
    	}
    
    	//and finally
    	$html = $string . $tagstoclose;
    	
    	$ci = & get_instance();
    	//$html = $ci->site_library->fix_unsafe_attributes($html);
    	return $html;
    }
}

if ( ! function_exists('word_limiter')) {
    //string word limiter
    function word_limiter($str, $n = 100, $end_char = '…')
    {
        if (strlen($str) < $n)
        {
            return close_tags($str);
        }
    
        $words = explode(' ', preg_replace("/\s+/", ' ', preg_replace("/(\r\n|\r|\n)/", " ", $str)));
    
        if (count($words) <= $n)
        {
            return close_tags($str);
        }
    
        $str = '';
        for ($i = 0; $i < $n; $i++)
        {
            $str .= $words[$i].' ';
        }
    
        $str = close_tags($str);
        return trim($str).$end_char;
    }
}
/* End of file site_helper.php */
/* Location: ./application/helpers/site_helper.php */