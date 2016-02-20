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
 * Admin Helper
 *
 * @subpackage  helpers/
 */
if ( ! function_exists('admin_errors'))
{
    function admin_errors($error = 0, $msg = '')
    {
    	$ci = & get_instance();
    	return $ci->site_library->admin_errors($error, $msg);
    }
}

if ( ! function_exists('admin_simple_delete'))
{
    function admin_simple_delete($table = '', $comparison_fields_name = 'ID', $comparison_fields_value = '')
    {
    	if(!$table || !$comparison_fields_name || !$comparison_fields_value) return FALSE;
    	$comparison_fields['NAME'] = $comparison_fields_name;
    	$comparison_fields['VALUE'] = $comparison_fields_value;
    	delete_rows($table, $comparison_fields);
    	return TRUE;
    }
}

if ( ! function_exists('users'))
{
    function users($filters = array(), $default = '')
    {
    	$ci = & get_instance();
    	return $ci->site_library->users($filters, $default);
    }
}

if ( ! function_exists('get_image_list'))
{
    function get_image_list($filters=array('status'=>'1'), $default = '') {
        $ci = & get_instance();
        return $ci->site_library->get_image_list($filters, $default);
    }
}

if ( ! function_exists('ajax_single_delete'))
{
    function ajax_single_delete($table='', $id=0, $row_name='ID', $user_type='', $image='', $image_field='image') {
        $ajax = ajax_check(); //Check AJAX
        if(!$ajax || !$table || !$id) { redirect(site_url("admin/sign-in")); return; }  //if not ajax request or table or ID

        $result = 1; //deafult result
        if($user_type != 'demo') {
            //delete image
            $check_image = get_rows(array('ID'=>$id), array('TABLE'=>$table, 'LIMIT'=>1));
            if(isset($check_image[$image_field]) && !empty($check_image[$image_field])) {
                $image_field = $check_image[$image_field];
                @unlink($image."{$image_field}");
            }

            $status = admin_simple_delete($table, $row_name, $id); //delete
            $result = ($status) ? 1: 0; //set result
        }

        ajax_response($result); return; //JSON Response
    }
}

if ( ! function_exists('ajax_bulk_delete'))
{
    function ajax_bulk_delete($table='', $row_sel=array(), $user_type='', $image='', $image_field='image') {
        $ajax = ajax_check(); //Check AJAX
        if(!$ajax || !$table || !is_array($row_sel)) { redirect(site_url("admin/sign-in")); return; }  //if not ajax request or table or rows

        $result = 1; //deafult result
        if($user_type != 'demo') {
            foreach ($row_sel as $key => $value) {
                $cur_row_id = alphaID($value, TRUE); //get ID
                if($image !== '') {
                    //delete image
                    $check_image = get_rows(array('ID'=>$cur_row_id), array('TABLE'=>$table, 'LIMIT'=>1));
                    if(isset($check_image[$image_field]) && !empty($check_image[$image_field])) {
                        $image_field = $check_image[$image_field];
                        @unlink($image."{$image_field}");
                    }
                }
                $row_ids[] = $cur_row_id;
            }

            $status = delete_rows($table, NULL, $row_ids); //delete rows
            $result = ($status) ? 1: 0; //set result
        }

        ajax_response($result); return; //JSON Response
    }
}
/* End of file admin_helper.php */
/* Location: ./application/helpers/admin_helper.php */
