<?php
class Api_model extends CI_Model {

	public function __construct()
	{
       parent::__construct();
   	}

	public function validate_session()
	{
        $signin_status = $this->signin_model->auth_user();
		if($signin_status === TRUE) {
            $token_data = $this->extract_token($this->session->userdata("token"));
            $filters['email'] = $token_data['user_email'];
            $filters['ID'] = $token_data['user_id'];
            $filters['password'] = $token_data['user_pass'];

            $check_user = get_rows($filters, array('TABLE'=>'users', 'LIMIT'=>'1'));
            if(isset($check_user['ID'])) {
    			if($token_data['expire_time'] >= time()) {	
    				return $token_data;
    			}
    			else {
    				$expire_after = 30 * 24 * 60 * 60;
    				$time = time() + $expire_after;
    				if(isset($token_data['expire_time'])) unset($token_data['expire_time']);			

    				$new_token = $this->make_token($token_data, $time);
                    return $new_token;
    			}
            }
            else {
                redirect(site_url('admin/sign-in')); exit;
            }
		}
		else {
		    redirect(site_url('admin/sign-in')); exit;
		}
	}

	public function make_token($token_data=array(), $time=0)
	{
		$token = '';

		foreach($token_data as $key=>$part) {
			$enc_time = ($key == 0) ? 0 : $time;
			$token .= $this->_encryptIt($part, $enc_time);
		}

		return $token;
	}

	public function extract_token($token=FALSE)
	{
		if(!$token) {
			if(!isset($_SERVER['QUERY_STRING'])) {
				redirect(site_url('admin/sign-in')); exit;
			}
			else {
				$token = $_SERVER['QUERY_STRING'];
				$token = urldecode($token);
				$token = str_replace(' ', '+', $token);		
			}
		}

		if(!$token) {
			redirect(site_url('admin/sign-in')); exit;		
			exit;
		}

		$exploded = explode("=", $token);

		if(count($exploded) < 3) {
			redirect(site_url('admin/sign-in')); exit;
		}

		$combined_id_time = $this->_decryptIt( $exploded[0].'=', 0 );
		$explode_id_time = explode('|',$combined_id_time);

		if(count($explode_id_time) < 2) {
			redirect(site_url('admin/sign-in')); exit;
		}

		$data['expire_time'] = $explode_id_time[1];
		$data['user_email'] = $this->_decryptIt( $exploded[1].'=', $data['expire_time'] );
		$data['user_id'] = $explode_id_time[0];
		$data['user_pass'] = $this->_decryptIt( $exploded[2].'=', $data['expire_time'] );

		foreach($data as $str) {
			if(!$this->_isAscii($str)) {
				redirect(site_url('admin/sign-in')); exit;
			}
		}

		return $data;	
	}

	private function _isAscii($str)
	{
	    return mb_check_encoding($str, 'ASCII');
	}	

	private function _encryptIt( $q, $time=0)
	{
	    $cryptKey  = 'k3rNe1bDc0rpOr@ti0N3nCrYpT3R'.$time;
	    $qEncoded  = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
	    return( $qEncoded );
	}

	private function _decryptIt( $q, $time=0)
	{
	    $cryptKey  = 'k3rNe1bDc0rpOr@ti0N3nCrYpT3R'.$time;
	    $qDecoded  = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
	    return( $qDecoded );
	}	
}