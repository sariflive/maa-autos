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
 * User Controller
 *
 * @subpackage  controllers/admin
 */
class User extends CI_Controller {

    public $data = array();    // Included view data array;

	function __construct()
	{
        // Call the Controller constructor
		parent::__construct();
		$this->load->model('admin/signin_model');
		$this->load->helper(array("admin", "form"));
		$this->signin_model->auth_user();
	}

    /**
     * Controller For 'Admin user page'
     * 
     * @access public
     * @return redirect userlist
     */
	public function index()
	{
		redirect(site_url("admin/user/userlist")); return;
	}

    /**
     * user list (Admin)
     * 
     * @access public
     * @param $offset (integer)
     * @return type View
     */
	public function userlist($offset=0)
	{
		$limit = 15;
		$user = cur_user_data();

		$this->data['module'] = 'settings';
		$this->data['sub_module'] = 'user-management';
		$this->data['sub_sub_module'] = 'userlist';
		$this->data['segment'] = 'admin/user/users-list';
		$this->data['page_header'] = '<h2><i class="fa fa-users"></i>Users List <span>user list page</span></h2>';
		//breadcrumb
		$this->data['breadcrumb'] = '';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-home"></i> <a href="'.site_url("admin/dashboard").'">Dashboard</a><i class="fa fa-angle-right"></i></li>';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-users"></i> Users List</li>';
		//breadcrumb
		$this->data['page'] = array(
							'pageTitle' => "User List"
						);

		$filters = array();
		$total_results = FALSE;

		$sql_properties['SELECT'] = "users.*, user_groups.group as userGroup";
		$sql_properties['TABLE'] = 'users';
		$sql_properties['LIMIT'] = $limit;
		$sql_properties['OFFSET'] = $offset;
		$sql_properties['GLUE'] = 'user_groups';
		$sql_properties['PIECES'] = 'user_groups.ID = users.group';
        //search
		if(isset($_GET['name'])) {
			$name = $this->input->get("name", TRUE);
			$email = $this->input->get("email", TRUE);
			$group = $this->input->get("group", TRUE);
			$status = $this->input->get("status", TRUE);
			
			if($name) {
				$sql_properties['LIKE'][] = 'users.firstName';
				$sql_properties['LIKE_VALUE'][] = $name;
				$sql_properties['LIKE'][] = 'users.lastName';
				$sql_properties['LIKE_VALUE'][] = $name;
			}

			if($group != '')  $filters['users.group'] = $group;
			if($status != '') $filters['users.status'] = $status;
			
			$total_results = row_counter($filters, $sql_properties);
		} //end search

		$this->data['users'] = get_rows($filters, $sql_properties);
		$this->data['pagination'] = row_pagination($filters, array('LIMIT'=>$limit, 'TABLE'=>'users', 'SITE_URL'=>'admin/user/userlist/', 'URI_SEGMENT'=>4, 'TOTAL_RESULTS'=>$total_results));
		render_page("admin/template", $this->data);
	}

    /**
     * user manage (Admin)
     *
     * @access public
     * @param $mode
     * @param $id (alphaID)
     * @param $offset
     * @return mixed
     */
	public function manage($mode='add', $id=0, $offset=0)
	{
		$user_type = $this->session->userdata("user_type");
		
		$valid_modes = array('add','edit','delete', 'bulk_delete');
		if(!in_array($mode, $valid_modes)) $mode = 'add'; //check mode

		$this->data['module'] = 'settings';
		$this->data['sub_module'] = 'user-management';
		$this->data['sub_sub_module'] = 'userlist';
		$this->data['mode'] = $mode;
		$this->data['user_id'] = $id;
		$id = alphaID($id, TRUE);
		$this->data['segment'] = 'admin/user/manage-user';
		$this->data['page_header'] = '<h2><i class="fa fa-user"></i>'.ucfirst($mode).' User <span>manage user page</span></h2>';
		//breadcrumb
		$this->data['breadcrumb'] = '';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-home"></i> <a href="'.site_url("admin/dashboard").'">Dashboard</a><i class="fa fa-angle-right"></i></li>';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-user"></i> '.ucfirst($mode).' User</li>';
		//breadcrumb
		$this->data['page'] = array(
							'pageTitle' => "Manage User"
						);

		//Bulk Delete
		if($mode == 'bulk_delete') {
            $row_sel = $this->input->post("row_sel", TRUE); //post rows
            ajax_bulk_delete('users', $row_sel, $user_type, './images/admin/users/'); return; //bulk delete
		}
		//Bulk Delete End

		($mode == 'edit') ? $form_validation = "user_edit" : $form_validation = "user";
		if ($this->form_validation->run($form_validation) == TRUE) {
			if($user_type != 'demo') {
			    //post data
				$parsed_data['firstName'] = $this->input->post("first_name", TRUE);
				$parsed_data['lastName'] = $this->input->post("last_name", TRUE);
				$parsed_data['email'] = $this->input->post("email", TRUE);
				$parsed_data['password'] = $this->input->post("password", TRUE);
				$parsed_data['group'] = $this->input->post("group", TRUE);
				$parsed_data['status'] = $this->input->post("status", TRUE);

                //upload file
				if(isset($_FILES['userfile']['name']) && !empty($_FILES['userfile']['name'])) {
	
					if($mode == 'edit') {
						$user_id = $id;
						//delete current user image
						$check_image = get_rows(array('ID'=>$user_id), array('TABLE'=>'users', 'LIMIT'=>1));
						if(isset($check_image['image']) && !empty($check_image['image'])) @unlink("./images/admin/users/{$check_image['image']}");
					}
					else $user_id = $this->db->insert_id();
	
					//upload user image
					$this->load->library('upload');
					$title = strtolower(url_title($parsed_data['firstName'].'-'.$parsed_data['lastName'].'-'.$user_id));
					if($title) {
						$fileExt = strtolower(array_pop(explode(".", $_FILES['userfile']['name']))); //file name	
						$config['file_name']  = "{$title}.{$fileExt}";
					}
					$config['overwrite'] = TRUE;
					$config['upload_path'] = "./images/admin/users/";
					$config['allowed_types'] = 'gif|png|jpg|jpeg';

					$this->upload->initialize($config);
	
					if ($this->upload->do_upload()) {
						$upload_data = $this->upload->data();
						if ( ! $this->upload->do_upload('userfile')) $this->data['error'] = '<div class="alert alert-danger"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button><strong>Error! </strong> '. $this->upload->display_errors() .'</div>';
						else {
							$config['image_library'] = 'gd2';
							$config['source_image'] = "./images/admin/users/{$upload_data['file_name']}";
							$config['create_thumb'] = FALSE;
							$config['maintain_ratio'] = TRUE;
							$config['max_width'] = $this->config->item("user_image_max_width");
							$config['max_height'] = $this->config->item("user_image_max_height");

							$this->load->library('image_lib', $config);
							$this->image_lib->resize();

							$parsed_data['image'] = $upload_data['file_name'];
							$upload_status = 1;
						}
					}
				} //end upload file
	
				$comparison_fields = NULL;
				if($mode == 'edit') {
					$comparison_fields['NAME'] = 'ID';
					$comparison_fields['VALUE'] = $id;		
				}
				$db_status = save_data('users', $parsed_data, $comparison_fields); //save post data	
	
				$status = (isset($upload_status)) ? $upload_status : $db_status;
				if($status) $this->data['error'] = "<div class=\"alert alert-success\"><button class=\"close\" aria-hidden=\"true\" data-dismiss=\"alert\" type=\"button\">×</button><strong>Success!</strong> User saved successfully.</div>";			
				else $this->data['error'] = '<div class="alert alert-warning"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button><strong>Notice! No changes made.</strong></div>';
			}
			else $this->data['error'] = admin_errors(5); //demo user error
		}
		else if(validation_errors()) $this->data['error'] = '<div class="alert alert-error"><a data-dismiss="alert" class="close">×</a><strong>Error! </strong> <br />'. validation_errors() .'</div>';

        //delete
		if($mode == 'delete') {
            ajax_single_delete('users', $id, 'ID', $user_type, './images/admin/users/'); return; //single delete
		} //end delete

		//edit
		if($mode == 'edit') {
			$return_data = get_rows(array('ID'=>$id), array('TABLE'=>'users', 'LIMIT'=>1));
			if(isset($return_data['ID'])) $this->data['user'] = $return_data;
			else {$this->data['mode'] = 'add';}
		} //end edit

		$this->data['js_css'] = array('parsley', 'select2', 'fileinput');
		render_page("admin/template", $this->data);
	}

    /**
     * status update
     * 
     * @access public (ajax)
     * @return boolean
     */
	public function user_status_update()
	{
        $ajax = ajax_check(); //Check AJAX
        if(!$ajax) { redirect(site_url("admin/sign-in")); return; }  //if not ajax request

        $user_type = $this->session->userdata("user_type");
		if($user_type != 'demo') $db_status = ajax_single_update("users"); //update
        $result = (isset($db_status) && $db_status) ? 1 : 0; //set result
		ajax_response($result); return; //JSON Response
	}

    /**
     * user profile (Admin)
     * 
     * @access public
     * @param $offset (integer)
     * @return type View
     */
	public function profile()
	{
		$user_type = $this->session->userdata("user_type");
		$cur_sess = cur_sess();
		$user_id = $cur_sess['sessUserID'];

		$this->data['segment'] = 'admin/user/profile';
		$this->data['page_header'] = '<h2><i class="fa fa-user"></i>Profile <span>user profile page</span></h2>';
		//breadcrumb
		$this->data['breadcrumb'] = '';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-home"></i> <a href="'.site_url("admin/dashboard").'">Dashboard</a><i class="fa fa-angle-right"></i></li>';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-user"></i> Profile</li>';
		//breadcrumb
		$this->data['page'] = array(
							'pageTitle' => "Profile"
						);

        //post
		if($_POST) {
			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				if(validation_errors()) $this->data['error'] = '<div class="alert alert-danger"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button><strong>Error! </strong> <br />'. validation_errors() .'</div>';
			}
			else {
				if($user_type != 'demo') {
				    //post data
					$parsed_data['firstName'] = $this->input->post("first_name", TRUE);
					$parsed_data['lastName'] = $this->input->post("last_name", TRUE);

					//upload file
					if(isset($_FILES['userfile']['name']) && !empty($_FILES['userfile']['name'])) {
						//delete current user image
						$check_image = get_rows(array('ID'=>$user_id), array('TABLE'=>'users', 'LIMIT'=>1));
						if(isset($check_image['image']) && !empty($check_image['image'])) @unlink("./images/admin/users/{$check_image['image']}");

						//upload user image
						$this->load->library('upload');
						$title = strtolower(url_title($parsed_data['firstName'].'-'.$parsed_data['lastName'].'-'.$user_id));
						if($title) {
							$fileExt = strtolower(array_pop(explode(".", $_FILES['userfile']['name'])));	
							$config['file_name']  = "{$title}.{$fileExt}";
						}
						$config['overwrite'] = TRUE;
						$config['upload_path'] = "./images/admin/users/";
						$config['allowed_types'] = 'gif|png|jpg|jpeg';
	
						$this->upload->initialize($config);
	
						if ($this->upload->do_upload()) {
							$upload_data = $this->upload->data();
							if ( ! $this->upload->do_upload('userfile')) $this->data['error'] = '<div class="alert alert-danger"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button><strong>Error! </strong> '. $this->upload->display_errors() .'</div>';
							else {
								$config['image_library'] = 'gd2';
								$config['source_image'] = "./images/admin/users/{$upload_data['file_name']}";
								$config['create_thumb'] = FALSE;
								$config['maintain_ratio'] = TRUE;
								$config['max_width'] = $this->config->item("media_image_width");
								$config['max_height'] = $this->config->item("media_image_height");
		
								$this->load->library('image_lib', $config);
								$this->image_lib->resize();
		
								$parsed_data['image'] = $upload_data['file_name'];
								$upload_status = 1;
							}
						}
					} //end upload file

					$db_status = 0;
					$comparison_fields['NAME'] = 'ID';
					$comparison_fields['VALUE'] = $user_id;
					if(isset($parsed_data)) $db_status = save_data('users', $parsed_data, $comparison_fields); //save post data

					$status = (isset($upload_status)) ? $upload_status : $db_status;
					if($status) $this->data['error'] = "<div class=\"alert alert-success\"><button class=\"close\" aria-hidden=\"true\" data-dismiss=\"alert\" type=\"button\">×</button><strong>Success!</strong> Profile information updated successfully.</div>"; //success			
					else $this->data['error'] = '<div class="alert alert-warning"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button><strong>Notice! No changes made.</strong></div>'; //notice
			
				}
				else $this->data['error'] = admin_errors(5); //demo user error
			}
		} //end post

		$this->data['cur_sess'] = $cur_sess;
		render_page("admin/template", $this->data);
	}

    /**
     * user change password (Admin)
     * 
     * @access public
     * @param $offset (integer)
     * @return type View
     */
	public function changepassword()
	{
		$user_type = $this->session->userdata("user_type");
		$cur_sess = cur_sess();
		$user_id = $cur_sess['sessUserID'];

		$this->data['segment'] = 'admin/user/change-password';
		$this->data['page_header'] = '<h2><i class="fa fa-key"></i>Change password <span>change password page</span></h2>';
		//breadcrumb
		$this->data['breadcrumb'] = '';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-home"></i> <a href="'.site_url("admin/dashboard").'">Dashboard</a><i class="fa fa-angle-right"></i></li>';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-key"></i> Change Password</li>';
		//breadcrumb
		$this->data['page'] = array(
							'pageTitle' => "Change Password"
						);

        //post
		if($_POST) {
			$this->form_validation->set_rules('cpassword', 'Current Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('password', 'New Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('rpassword', 'Confirm New Password', 'trim|required|matches[password]|xss_clean');

			if ($this->form_validation->run() == FALSE) {
				if(validation_errors()) $this->data['error'] = '<div class="alert alert-danger"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button><strong>Error! </strong> <br />'. validation_errors() .'</div>'; //validation errors
			}
			else {
				if($user_type != 'demo') {
				    //post data
					$cPassword = $this->input->post('cpassword', TRUE);
	
					$user = get_rows(array('id'=>$user_id), array('TABLE'=>'users', 'LIMIT'=>1));
					if(isset($user['email']) && !empty($user['email'])) {
						if($user['password'] !== $cPassword) $this->data['error'] = '<div class="alert alert-danger"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button><strong>Error!</strong> Your current password not match.</div>'; //error
						else {
							$parsed_data['password'] = $this->input->post("password", TRUE);
	
							$comparison_fields['NAME'] = 'id';
							$comparison_fields['VALUE'] = $user_id;
	
							$db_status = save_data('users', $parsed_data, $comparison_fields); //change password
							if($db_status) $this->data['error'] = '<div class="alert alert-success"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button><strong>Success!</strong> Password has been changed successfully.</div>'; //success
							else $this->data['error'] = '<div class="alert alert-warning"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button><strong>Notice! No changes made.</strong></div>'; //notice
						}
					}
					else {
						redirect("admin/sign-out"); return;
					}
				}
				else $this->data['error'] = admin_errors(5); //demo user error
			}
		} //end post

		$this->data['js_css'] = array('parsley');
		$this->data['cur_sess'] = $cur_sess;
		render_page("admin/template", $this->data);
	}

    /**
     * rules manage (Admin)
     *
     * @access public
     * @param $mode
     * @param $id (alphaID)
     * @param $offset
     * @return mixed
     */
	public function rules($manage = '', $mode = 'add', $id = 0, $offset = 0)
	{
		$user_type = $this->session->userdata("user_type");
		$limit = 15;

        //manage
		if($manage == 'manage') {
			$valid_modes = array('add', 'edit', 'delete', 'search', 'bulk_delete'); //valid mode
			if(!in_array($mode, $valid_modes)) $mode = 'add'; //check mode
		}

		$this->data['module'] = 'settings';
		$this->data['offset'] = $offset;
		$this->data['sub_module'] = 'user-management';
		$this->data['sub_sub_module'] = 'rules';
		$this->data['segment'] = 'admin/user/rules';
		$this->data['page_header'] = '<h2><i class="fa fa-file-o"></i>User rules <span>user rules page</span></h2>';
		//breadcrumb
		$this->data['breadcrumb'] = '';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-home"></i> <a href="'.site_url("admin/dashboard").'">Dashboard</a><i class="fa fa-angle-right"></i></li>';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-key"></i> User rules</li>';
		//breadcrumb
		$this->data['page'] = array(
							'pageTitle' => "User Rules"
						);
        //manage
		if($manage == 'manage') {
			$this->data['segment'] = 'admin/user/manage-rule';
			$this->data['mode'] = $mode;
			$this->data['rule_id'] = $id;
			$id = alphaID($id, TRUE);

            //post
			if($_POST) {
			    //bulk delete
				if($mode == 'bulk_delete') {
                    $row_sel = $this->input->post("row_sel", TRUE); //post rows
                    ajax_bulk_delete('users_rules', $row_sel, $user_type); return; //bulk delete
				} //end bulk delete

				if($mode == 'edit') $this->form_validation->set_rules('group', 'Group', 'required|trim|xss_clean');
				else $this->form_validation->set_rules('group', 'Group', 'required|trim|xss_clean|callback_check_group_with_addon');
				$this->form_validation->set_rules('addon', 'Addon', 'required|trim|xss_clean');
				$this->form_validation->set_rules('read', 'Read', 'required|trim|xss_clean');
				$this->form_validation->set_rules('write', 'Write', 'required|trim|xss_clean');
				$this->form_validation->set_rules('delete', 'Delete', 'required|trim|xss_clean');
				if ($this->form_validation->run() == TRUE) {
					if($user_type != 'demo') {
					    //post data
						$parsed_data['group'] = $this->input->post('group', TRUE);
						$parsed_data['addon'] = $this->input->post('addon', TRUE);
						$parsed_data['read'] = $this->input->post('read', TRUE);
						$parsed_data['write'] = $this->input->post('write', TRUE);
						$parsed_data['delete'] = $this->input->post('delete', TRUE);

						$comparison_fields = NULL;
						if($mode == 'edit') {
							$comparison_fields['NAME'] = 'ID';
							$comparison_fields['VALUE'] =	$id;		
						}
						$db_status = save_data('users_rules', $parsed_data, $comparison_fields); //save post data	
			
						if($db_status) $this->data['error'] = admin_errors(1); //success			
						else $this->data['error'] = admin_errors(2); //saved failed
					}
					else $this->data['error'] = admin_errors(5); //demo user error
				}
				else if(validation_errors()) $this->data['error'] = admin_errors(); //validation errors
			} //end post

            //delete
			if($mode == 'delete') {
                ajax_single_delete('users_rules', $id, 'ID', $user_type); return; //single delete
			} //end delete

			//edit
			if($mode == 'edit') {
				$return_data = get_rows(array('ID'=>$id), array('TABLE'=>'users_rules', 'LIMIT'=>1));
				if(isset($return_data['ID'])) $this->data['rule_data'] = $return_data;
				else { $this->data['mode'] = 'add'; }
			} //end edit
		} //end manage

		$this->data['groups'] = get_rows(array(), array('TABLE'=>'user_groups', 'LIMIT'=>$limit, 'OFFSET'=>$offset, 'ORDER_BY'=>'group', 'ORDER_TYPE'=>'asc'));
		render_page("admin/template", $this->data);
	}

    /**
     * check group with addon
     * 
     * @access public
     * @return boolean
     */
	public function check_group_with_addon($group)
	{
		$addon = $this->input->post('addon');
		$check = get_rows(array('group'=>$group, 'addon'=>$addon), array('TABLE'=>'users_rules', 'LIMIT'=>1));
		if(isset($check['ID'])) {
			$this->form_validation->set_message('check_group_with_addon', 'Addon already is being used with this Group. Please try with another Addon.');
			return FALSE;
		}
		else return TRUE;
	}

    /**
     * rule status update
     * 
     * @access public (ajax)
     * @return boolean
     */
	public function rule_status_update()
	{
        $ajax = ajax_check(); //Check AJAX
        if(!$ajax) { redirect(site_url("admin/sign-in")); return; }  //if not ajax request

        $user_type = $this->session->userdata("user_type");
		if($user_type != 'demo') $db_status = ajax_single_update("users_rules"); //update
        $result = (isset($db_status) && $db_status) ? 1 : 0; //set result

		ajax_response($result); return; //JSON Response
	}

    /**
     * groups manage (Admin)
     *
     * @access public
     * @param $mode
     * @param $id (alphaID)
     * @param $offset
     * @return mixed
     */
	public function groups($mode='add', $id=0, $offset=0)
	{
		$user_type = $this->session->userdata("user_type");
		$limit = 15;

		$valid_modes = array('add', 'edit', 'delete', 'search', 'bulk_delete'); //valid mode
		if(!in_array($mode, $valid_modes)) $mode = 'add'; //check mode

		$this->data['module'] = 'settings';
		$this->data['offset'] = $offset;
		$this->data['sub_module'] = 'user-management';
		$this->data['sub_sub_module'] = 'groups';
		$this->data['segment'] = 'admin/user/groups';
		$this->data['page_header'] = '<h2><i class="fa fa-file-o"></i>User Groups <span>user groups page</span></h2>';
		//breadcrumb
		$this->data['breadcrumb'] = '';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-home"></i> <a href="'.site_url("admin/dashboard").'">Dashboard</a><i class="fa fa-angle-right"></i></li>';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-key"></i> User Groups</li>';
		//breadcrumb
		$this->data['page'] = array(
							'pageTitle' => "User Groups"
						);
		$this->data['mode'] = $mode;
		$this->data['group_id'] = $id;
		$id = alphaID($id, TRUE);

        //post
		if($_POST) {
		    //bulk delete
			if($mode == 'bulk_delete') {
                $row_sel = $this->input->post("row_sel", TRUE); //post rows
                ajax_bulk_delete('user_groups', $row_sel, $user_type); return; //bulk delete
			} //end bulk delete

			if($mode == 'edit') $this->form_validation->set_rules('group', 'Group', 'required|trim|xss_clean');
			else $this->form_validation->set_rules('group', 'Group', 'required|trim|xss_clean|callback_check_group');
			$this->form_validation->set_rules('status', 'Status', 'required|trim|xss_clean');
			if ($this->form_validation->run() == TRUE) {
				if($user_type != 'demo') {
				    //post data
					$parsed_data['group'] = $this->input->post('group', TRUE);
					$parsed_data['status'] = $this->input->post('status', TRUE);

					$comparison_fields = NULL;
					if($mode == 'edit') {
						$comparison_fields['NAME'] = 'ID';
						$comparison_fields['VALUE'] =	$id;		
					}
					$db_status = save_data('user_groups', $parsed_data, $comparison_fields); //save post data	
	
					if($db_status) $this->data['error'] = admin_errors(1); //success			
					else $this->data['error'] = admin_errors(2); //saved failed
				}
				else $this->data['error'] = admin_errors(5); //demo user error
			}
			else if(validation_errors()) $this->data['error'] = admin_errors(); //validation errors
		} //end post

		//delete
		if($mode == 'delete') {
            ajax_single_delete('user_groups', $id, 'ID', $user_type); return; //single delete
		} //delete

		//edit
		if($mode == 'edit') {
			$return_data = get_rows(array('ID'=>$id), array('TABLE'=>'user_groups', 'LIMIT'=>1));
			if(isset($return_data['ID'])) $this->data['group_data'] = $return_data;
			else { $this->data['mode'] = 'add'; }
		} //end edit

		//search
		if($mode == 'search') {
			$search_group = $this->input->get("group", TRUE);
			$search_status = $this->input->get("status", TRUE);
			$sql_properties['TABLE'] = 'user_groups';
			$sql_properties['LIMIT'] = $limit;
			$sql_properties['OFFSET'] = $offset;
			$sql_properties['ORDER_BY'] = 'group';
			$sql_properties['ORDER_TYPE'] = 'asc';
			if($search_group) {
				$sql_properties['LIKE'][] = 'group';
				$sql_properties['LIKE_VALUE'][] = $search_group;
			}
			if($search_status != '') $filters = array('status'=>$search_status);
			else $filters = array();
			$this->data['groups'] = get_rows($filters, $sql_properties);
			$total_results = row_counter($filters, $sql_properties);
			$this->data['pagination'] = row_pagination(array(), array('LIMIT'=>$limit, 'TABLE'=>'user_groups', 'SITE_URL'=>'admin/user/groups/search/0/', 'URI_SEGMENT'=>6, 'TOTAL_RESULTS'=>$total_results));
		} //end search
		else {
			$this->data['groups'] = get_rows(array(), array('TABLE'=>'user_groups', 'LIMIT'=>$limit, 'OFFSET'=>$offset, 'ORDER_BY'=>'group', 'ORDER_TYPE'=>'asc'));
			$this->data['pagination'] = row_pagination(array(), array('LIMIT'=>$limit, 'TABLE'=>'user_groups', 'SITE_URL'=>'admin/user/groups/show/0/', 'URI_SEGMENT'=>6));
		}

		render_page("admin/template", $this->data);
	}

    /**
     * check group
     * 
     * @access public
     * @return boolean
     */
	public function check_group($group)
	{
		$check = get_rows(array('group'=>$group), array('TABLE'=>'user_groups', 'LIMIT'=>1));
		if(isset($check['ID'])) {
			$this->form_validation->set_message('check_group', 'Group already is being used. Please try with another Group.');
			return FALSE;
		}
		else return TRUE;
	}

    /**
     * group status update
     * 
     * @access public (ajax)
     * @return boolean
     */
	public function group_status_update()
	{
        $ajax = ajax_check(); //Check AJAX
        if(!$ajax) { redirect(site_url("admin/sign-in")); return; }  //if not ajax request

        $user_type = $this->session->userdata("user_type");
		if($user_type != 'demo') $db_status = ajax_single_update("user_groups"); //update
        $result = (isset($db_status) && $db_status) ? 1 : 0; //set result

		ajax_response($result); return; //JSON Response
	}

}
/* End of file admin/user.php */
/* Location: ./application/controllers/admin/user.php */