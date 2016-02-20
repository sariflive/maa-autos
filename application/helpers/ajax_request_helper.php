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
 * Ajax Request Helper
 *
 * @subpackage  helpers/
 */
if ( ! function_exists('ajax_check'))
{
    /**
     * Check AJAX
     * 
     * Checks to see if you (or the royal I) are dealing with an AJAX call.
     * 
     * @return TRUE or FALSE
     */
    function ajax_check()
    {
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
}

if ( ! function_exists('ajax_response')) {
    /**
     * JSON Response Wrapper
     * 
     * Wraps up any data nicely for sending back to an ajax call
     *
     * @return  string
     */
    function ajax_response($data) {
        // Set the JSON header appropriately
        header('Content-Type: application/json');
        // Echo out the array into json
        echo json_encode($data);
        return;
    }
}

if ( ! function_exists('ajax_force_fail')) {
    /**
     * Force AJAX Failure
     * 
     * If you ever need to, force an AJAX to fail
     */
    function ajax_force_fail() {
        $_ci =& get_instance();
        $_ci->output->set_status_header(500);
    }
}
/* End of file ajax_request_helper.php */
/* Location: ./application/helpers/ajax_request_helper.php */