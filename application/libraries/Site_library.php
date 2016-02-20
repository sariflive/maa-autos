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
 * Site Library
 *
 * @subpackage  libraries/
 */
class Site_library {
	var $CI;

	public function Site_library()
	{
		$this->CI =& get_instance();	
    }

    //current user session function
	public function cur_sess()
	{
		$cur_sess = array();

        //current user ID
		$cur_sess['sessUserID'] = (int)alphaID($this->CI->session->userdata('sessUserID'), TRUE, 'user-login-key');
        //current user email
		$cur_sess['sessUserEmail'] = $this->CI->session->userdata('sessUserEmail');
        //current user group
		$cur_sess['sessUserGroup'] = $this->CI->session->userdata('sessUserGroup');

        //current user details
		return $cur_sess;
	}//end current user session function

	//user rules
	public function users_rules($filters = array(), $check_addon = FALSE, $preg_match = FALSE)
	{
		if($check_addon != FALSE && $preg_match != FALSE) {
			$addon_rules = $this->CI->session->userdata("addon_rules");
			if(isset($addon_rules['All']) && preg_match('/1:1:1/',$addon_rules['All']) || isset($addon_rules["{$check_addon}"]) && preg_match("{$preg_match}", $addon_rules["{$check_addon}"])) $return = 1;
			else $return = 0;
			return $return;
		}
		else {
			$users_rules = get_rows($filters, array('TABLE'=>'users_rules', 'LIMIT'=>10000));
			$rules['addon_rules'] = array();
			foreach($users_rules as $key=>$rule) {
				$addon = $rule['addon'];
				$rules['addon_rules']["{$addon}"] = "{$rule['read']}:{$rule['write']}:{$rule['delete']}";
			}

			return $rules;
		}
	}//end user rules

	//select options from database table
	public function options($filters = array(), $sql_properties = array()) {
		$data = array();

        //default selected option
		$default = (isset($sql_properties['DEFAULT'])) ? $sql_properties['DEFAULT'] : '';
        //option value
		$option_value = (isset($sql_properties['OPTION_VALUE'])) ? $sql_properties['OPTION_VALUE'] : 'ID';
        //option text
		$option = (isset($sql_properties['OPTION'])) ? $sql_properties['OPTION'] : 'ID';

		$data['options'] = get_rows($filters, $sql_properties);
		$data['option_list'] = "";
		//if count options grater than zero
		if(count($data['options']) > 0) {
    		foreach($data['options'] as $row) {
    				$row_value = $row[$option_value];
    				$row_option = $row[$option];
    				if($default == $row_value) $selected = 'selected="selected"'; else $selected = '';

    				$data['option_list'] .= "<option value=\"{$row_value}\" {$selected}>{$row_option}</option>";
    		}
        }
        //if option data count less than one
        else $data['option_list'] = "<option value=\"\"></option>";

		return $data;
	}//end select options from database table

	//get media image list with option
	public function get_image_list($filters = array('status'=>'1'), $default = '')
	{
		$data = array();
		$values = get_rows($filters, array('TABLE'=>'media', 'LIMIT'=>100));
		$data['image_list'] = "<option value=\"\"></option>";
		foreach($values as $value) {
				$this_image = (file_exists("{$value['url']}")) ? base_url() . "{$value['url']}" : base_url() . "responsive/img/avatars/avatar.png";
				if($default == $value['url']) $selected = 'selected="selected"'; else $selected = '';				
				$data['image_list'] .= "<option value=\"{$value['url']}\" {$selected} data-image='{$this_image}' data-title='{$value['title']}'>{$value['title']}</option>" ;
		} 
		return $data;
	}//end get media image list with option

	//get menus list
	public function menus($filters = array())
	{
		$data = array();
		$values = get_rows($filters, array('TABLE'=>'pages', 'LIMIT'=>1000));
		$data['page_list'] = "";
		foreach($values as $value) {
				$url = site_url("{$value['url']}");		
				$data['page_list'] .= "<li><a href=\"{$url}\">{$value['page']}</a></li>" ;
		}
		return $data;
	}//end get menus list

	//widget menu
	public function widget_menu($filters=array()) {
		$data = array();
		if(!isset($filters['status'])) $filters['status'] = 1;
		$values = get_rows($filters, array('TABLE'=>'menu', 'LIMIT'=>1));
		return (isset($values['content'])) ? $values['content'] : '';;
	}//end widget menu

	//users options
	public function users($filters = array(), $default = '')
	{
		$data = array();
		$values = get_rows($filters, array('TABLE'=>'users', 'LIMIT'=>'1000', 'ORDER_BY'=>'firstName', 'ORDER_TYPE'=>'asc'));
		$data['user_list'] = '';
		foreach ($values as $key => $row) {
			$selected = ($row['ID'] == $default) ? ' selected' : '';
			$data['user_list'] .= "<option value=\"{$row['ID']}\"{$selected}>{$row['firstName']} {$row['lastName']}</option>";
		}
		
		return $data;
	}//end users options

	//error messages
	public function admin_errors($error = 0, $msg = '')
	{
	    //error 1 success message
		if($error == 1) {
			$success_msg = ($msg != '') ? $msg : '<strong>Congratulations!</strong> Your form was submitted and information saved successfully!';
			$return = "<div class=\"alert alert-success\"><button class=\"close\" aria-hidden=\"true\" data-dismiss=\"alert\" type=\"button\">×</button>{$success_msg}</div>";
		}
         //error 2 warning message
		elseif ($error == 2) {
			$notice_msg = ($msg != '') ? $msg : '<strong>Notice!</strong> No changes made.';
			$return = '<div class="alert alert-warning"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>'.$notice_msg.'</div>';
		}
         //error 3 warniing for listing data
		elseif ($error == 3) {
			$notice_msg = ($msg != '') ? $msg : '<strong>No Result found.</strong>';
			$return = '<br /><div class="alert alert-warning">'.$notice_msg.'</div>';
		}
        //error 4 for upload file error message
		elseif ($error == 4) {
			$return = '<div class="alert alert-danger"><a data-dismiss="alert" class="close">×</a><strong>Error! </strong> <br />'. $this->CI->upload->display_errors() .'</div>';
		}
        //error 5 for disabled demo version message
		elseif ($error == '5') {
			$return = '<div class="alert alert-warning"><a data-dismiss="alert" class="close">×</a><strong>Notice!</strong> Sorry, this feature is disabled in demo mode.</div>';
		}
         //error 6 for from validation error message
		else $return = '<div class="alert alert-danger"><a data-dismiss="alert" class="close">×</a><strong>Error! </strong> <br />'. validation_errors() .'</div>';

        //return message
		return $return;
	}//end error messages

	//vehicle price end cc range
	public function vehicle_range()
	{
	    $data = array();

        //vehicle min price
        $vehicle_min_price = get_rows(array('status'=>'Available'), array('TABLE'=>'vehicles', 'LIMIT'=>1, 'ORDER_BY'=>'price', 'ORDER_TYPE'=>'asc'));
        $data['vehicle_min_price'] = (isset($vehicle_min_price['price'])) ? $vehicle_min_price['price'] : 0;

        //vehicle max price
        $vehicle_max_price = get_rows(array('status'=>'Available'), array('TABLE'=>'vehicles', 'LIMIT'=>1, 'ORDER_BY'=>'price', 'ORDER_TYPE'=>'desc'));
        $data['vehicle_max_price'] = (isset($vehicle_max_price['price'])) ? $vehicle_max_price['price'] : 0;

        //vehicle min cc
        $vehicle_min_cc = get_rows(array('status'=>'Available'), array('TABLE'=>'vehicles', 'LIMIT'=>1, 'ORDER_BY'=>'cc', 'ORDER_TYPE'=>'asc'));
        $data['vehicle_min_cc'] = (isset($vehicle_min_cc['price'])) ? $vehicle_min_cc['price'] : 0;

        //vehicle max cc
        $vehicle_max_cc = get_rows(array('status'=>'Available'), array('TABLE'=>'vehicles', 'LIMIT'=>1, 'ORDER_BY'=>'cc', 'ORDER_TYPE'=>'desc'));
        $data['vehicle_max_cc'] = (isset($vehicle_max_cc['price'])) ? $vehicle_max_cc['price'] : 0;
        
        return $data;
	}//end vehicle price end cc range

	//company social network function
	public function social_network()
	{
		$data = array();

        $facebook = $this->CI->config->item("facebook_link");
        $twitter = $this->CI->config->item("twitter_link");
        $linkedin = $this->CI->config->item("linkedin_link");
        $skype = $this->CI->config->item("skype_link");
        $googleplus = $this->CI->config->item("googleplus_link");
        $dribbble = $this->CI->config->item("dribbble_link");
        $pinterest = $this->CI->config->item("pinterest_link");

        //set if empty
        $data['facebook'] = (!empty($facebook)) ? $facebook : '#';
        $data['twitter'] = (!empty($twitter)) ? $twitter : '#';
        $data['linkedin'] = (!empty($linkedin)) ? $linkedin : '#';
        $data['skype'] = (!empty($skype)) ? 'skype:'.$skype.'?add' : '#';
        $data['googleplus'] = (!empty($googleplus)) ? $googleplus : '#';
        $data['dribbble'] = (!empty($dribbble)) ? $dribbble : '#';
        $data['pinterest'] = (!empty($pinterest)) ? $pinterest : '#';

        return $data;
	}//end company social network function

	//company contact information function
	public function company_contact()
	{
        $data = array();

        $company_phone = $this->CI->config->item("company_phone");
        $data['company_phone'] = (!empty($company_phone)) ? $company_phone : '+0000 0000 000';

        $data['company_email'] = $this->CI->config->item("company_email");
        $data['company_support_email'] = $this->CI->config->item("company_support_email");
        $data['company_address'] = $this->CI->config->item("company_address");
        $data['company_city'] = $this->CI->config->item("company_city");
        $data['company_country'] = $this->CI->config->item("company_country");
        $data['company_url'] = $this->CI->config->item("company_url");
        $data['company_name'] = $this->CI->config->item("company_name");
        $data['company_fax'] = $this->CI->config->item("company_fax");  
    
        $data['currency'] = $this->CI->config->item("currency");
        $data['currency_symbol'] = $this->CI->config->item("currency_symbol");

        return $data;
	}//end company contact informations function
}
/* End of file site_library.php */
/* Location: ./application/library/site_library.php */