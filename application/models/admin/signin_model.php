<?php
class Signin_model extends CI_Model {

	function __construct()
	{
        // Call the Model constructor
        parent::__construct();
        //load default database
        $this->load->database();
	}

    //check user fun
	public function check_user($user_email='', $user_password='')
	{
		//check user
		$query = $this->db->get_where('users', array('email'=>"{$user_email}", 'password'=>"{$user_password}"), 1, 0);
		if ($query->num_rows() > 0) {
			$row = $query->row_array();

			//check user status
			if($row['status'] != '1') {
				return FALSE; 
			}

			//Update Login info
			$this->db->where('email', $user_email);
			$this->db->update('users', array('lastIP'=>$this->input->ip_address(), 'lastBrowser'=>$this->input->user_agent(), 'lastLogin'=>time()));

			//get user group
			$group = get_rows(array('ID'=>$row['group']), array('TABLE'=>'user_groups', 'LIMIT'=>1));

			//start insert login history
			$history_data['userID'] = $row['ID'];
			$history_data['login'] = time();
			$history_data['IP'] = $this->input->ip_address();
			$history_data['browser'] = $this->input->user_agent();
			save_data('user_login_history', $history_data);
            //end insert login history

			//set current user session
			//convert ID to alphaID with key for secure 
			$set_sess['sessUserID'] = alphaID($row['ID'], FALSE, 'user-login-key');
			$set_sess['user_type'] = $row['user_type'];
			$set_sess['sessUserEmail'] = $row['email'];
			$set_sess['sessUserGroup'] = (isset($group['group'])) ? $group['group'] : '';
			$this->session->set_userdata($set_sess);

			$users_rules = users_rules(array('group' => $row['group']), FALSE);
			$this->session->set_userdata($users_rules);

            //set nativesession
			$this->load->library('nativesession');
			$file_manager['KCFINDER']['disabled'] = false;
			$this->nativesession->set( 'KCFINDER', $file_manager['KCFINDER'] );
            //end set nativesession

			return $row;
		}
		else {
			//user not valid
			return FALSE; 
		}
	}//end check user fun

	//check admin use
	function auth_user()
	{
	    //get session data from admin helper
		$cur_sess = cur_sess();

		if(!empty($cur_sess['sessUserID']) && !empty($cur_sess['sessUserEmail'])) {
		    //query user
			$query = $this->db->get_where('users', array('email'=>"{$cur_sess['sessUserEmail']}", 'ID'=>$cur_sess['sessUserID']), 1, 0);
			if ($query->num_rows() > 0) {
			    //if valid user
				return TRUE;
			}
		}
		else {
		    //if user not valid
			redirect(site_url('admin/sign-in'));
			return FALSE;
		}
	}

    //admin sign out fun
	public function sign_out() {
	    //destroy all session
		$this->session->sess_destroy();	
		redirect(site_url('admin/sign-in'));
		return;
	} //end admin sign out fun
}
?>