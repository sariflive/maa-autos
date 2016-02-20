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
 * XSRF Helper
 *
 * @subpackage  helpers/
 */
if ( ! function_exists('xsrf_get_token')) {
    /**
     * Get XSRF Token
     * 
     * Returns a token that exists for one request that verifies that
     * the action was executed by the person that requested it
     *
     * @return  string
     */
    function xsrf_get_token() {
        $ci =& get_instance();
        if ($ci->session->userdata('xsrf_hash')) {
            $token = $ci->session->userdata('xsrf_hash');
        } else {
            // Generate the token
            $token = sha1(microtime().$ci->uri->uri_string());
            // Set it in the session
            $ci->session->set_userdata('xsrf_hash', $token);
        }

        //Return it
        return $token;
    }
}

if ( ! function_exists('xsrf_get_token_field')) {
    /**
     * Get XSRF Token Field
     * 
     * Returns an xhtml form element to include xsrf token.
     * You can specify the id/name attribute of the input.
     * Has a dependancy to get_xsrf_token().
     *
     * @param   string  The id/name to be used
     * @return  string
     */
    function xsrf_get_token_field($name='auth_token') {
        return '<input type="hidden" id="'.$name.'" name="'.$name.'" value="' .xsrf_get_token(). '" />';
    }
}

if ( ! function_exists('xsrf_delete_token')) {
    /**
     * Delete XSRF Token
     * 
     * Deletes the xsrf token
     *
     * @return  boolean
     */
    function xsrf_delete_token() {
        $ci =& get_instance();
        if ($ci->session->userdata('xsrf_hash')) {
            $ci->session->unset_userdata('xsrf_hash');
            return TRUE;
        } else {
            return FALSE;
        }
    }
}

if ( ! function_exists('xsrf_check_token')) {
    /**
     * Get XSRF Token Field
     * 
     * Checks that the token is still valid, returns true if so. 
     * Deletes old token after valid or fail.
     * Has a dependacy to xsrf_delete_token()
     *
     * @param   string  The challenge token
     * @return  boolean
     */
    function xsrf_check_token($challenge_token) {
        // CI
        $ci =& get_instance();
        // Get the stored token
        $token = $ci->session->userdata('xsrf_hash');
        // Delete the old token
        xsrf_delete_token();
        // Returns if the token is the right token
        return ($token == $challenge_token);
    }
}
/* End of file xsrf_helper.php */
/* Location: ./application/helpers/xsrf_helper.php */