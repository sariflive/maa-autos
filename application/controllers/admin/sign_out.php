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
 * Sign Out Controller
 *
 * @subpackage  controllers/admin
 */
class Sign_out extends CI_Controller {

	function __construct()
	{
        // Call the Controller constructor
		parent::__construct();
        //load admin sign in model
		$this->load->model('admin/signin_model');
        //sign out
		$this->signin_model->sign_out();
	}
}
/* End of file admin/sign_out.php */
/* Location: ./application/controllers/admin/sign_out.php */