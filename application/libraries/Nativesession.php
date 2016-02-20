<?php if (!defined('BASEPATH'))exit( 'No direct script access allowed' );
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
 * Nativesession Library
 *
 * @subpackage  libraries/
 */
class Nativesession{
    public function __construct(){
        @session_start();
    }

    public function set( $key, $value ){
        $_SESSION[$key] = $value;
    }

    public function get( $key ){
        return isset( $_SESSION[$key] ) ? $_SESSION[$key] : null;
    }

    public function regenerateId( $delOld = false ){
        @session_regenerate_id( $delOld );
    }

    public function delete( $key ){
        unset( $_SESSION[$key] );
    }
}
/* End of file nativesession.php */
/* Location: ./application/library/nativesession.php */