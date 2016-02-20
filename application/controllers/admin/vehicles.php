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
 * Vehicles Controller
 *
 * @subpackage  controllers/admin
 */
class Vehicles extends CI_Controller {

    public $data = array();    // Included view data array;

	function __construct()
	{
        // Call the Controller constructor
		parent::__construct();
		$this->load->model('admin/signin_model');
		$this->load->helper(array("admin", "form"));
		$this->signin_model->auth_user();
		$this->config->load_db_items();
	}

    /**
     * Controller For 'Admin vehicles page'
     * 
     * @access public
     * @return redirect vehicles list
     */
	public function index()
	{
		redirect(site_url("admin/vehicles/vehicleslist")); return;
	}

    /**
     * vehicles list (Admin)
     * 
     * @access public
     * @param $offset (integer)
     * @return type View
     */
	public function vehicleslist($offset=0)
	{
		$limit = 15;

		$this->data['module'] = 'vehicles';
		$this->data['sub_module'] = 'vehicleslist';
		$this->data['segment'] = 'admin/vehicle/vehicles';
		$this->data['page_header'] = '<h2><i class="fa fa-users"></i>Vehicle List <span>vehicle list page</span></h2>';
		//breadcrumb
		$this->data['breadcrumb'] = '';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-home"></i> <a href="'.site_url("admin/dashboard").'">Dashboard</a><i class="fa fa-angle-right"></i></li>';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-users"></i> Vehicle List</li>';
		//breadcrumb
		$this->data['page'] = array(
							'pageTitle' => "Vehicle List"
						);

		$filters = array();
		$total_results = FALSE;

		$sql_properties['SELECT'] = 'vehicles.*, showrooms.dealership_name, makers.name as maker_name, models.model as model_name';
		$sql_properties['TABLE'] = 'vehicles';
		$sql_properties['LIMIT'] = $limit;
		$sql_properties['OFFSET'] = $offset;
		$sql_properties['ORDER_BY'] = 'ID';
		$sql_properties['ORDER_TYPE'] = 'desc';
		$sql_properties['GLUE'][] = 'showrooms';
		$sql_properties['PIECES'][] = 'showrooms.ID = vehicles.showroomID';
		$sql_properties['GLUE'][] = 'makers';
		$sql_properties['PIECES'][] = 'makers.ID = vehicles.makerID';
		$sql_properties['GLUE'][] = 'models';
		$sql_properties['PIECES'][] = 'models.ID = vehicles.modelID';
		//search
		if(isset($_GET['name'])) {
			$showroom = $this->input->get("showroom", TRUE);
			$name = $this->input->get("name", TRUE);
			$code = $this->input->get("code", TRUE);
			$maker = $this->input->get("maker", TRUE);
			$year = $this->input->get("year", TRUE);
			$condition = $this->input->get("condition", TRUE);
			$fuel = $this->input->get("fuel", TRUE);
			$status = $this->input->get("status", TRUE);

			if($name) {
				$sql_properties['LIKE'][] = 'vehicles.name';
				$sql_properties['LIKE_VALUE'][] = $name;
			}
			if($code) {
				$sql_properties['LIKE'][] = 'vehicles.vehicleCode';
				$sql_properties['LIKE_VALUE'][] = $code;
			}

			if($showroom != '')  $filters['vehicles.showroomID'] = $showroom;
			if($maker != '')  $filters['vehicles.makerID'] = $maker;
			if($year != '') $filters['vehicles.year'] = $year;
			if($condition != '') $filters['vehicles.conditionID'] = $condition;
			if($fuel != '') $filters['vehicles.fuelID'] = $fuel;
			if($status != '') $filters['vehicles.status'] = $status;

			$total_results = row_counter($filters, $sql_properties);
		} //end search

		$this->data['vehicles'] = get_rows($filters, $sql_properties);
		$this->data['pagination'] = row_pagination($filters, array('LIMIT'=>$limit, 'TABLE'=>'vehicles', 'SITE_URL'=>'admin/vehicles/vehicleslist/', 'URI_SEGMENT'=>4, 'TOTAL_RESULTS'=>$total_results));
		render_page("admin/template", $this->data);
	}

    /**
     * vehicle images (Admin)
     * 
     * @access public
     * @param $id
     * @param $offset (integer)
     * @return type View
     */
	public function images($id=0, $offset=0)
	{
		$user_type = $this->session->userdata("user_type");
		$limit = 15;

        $this->data['page_js'] = 'vehicle-images';
		$this->data['vehicle_id'] = $id;
		$this->data['offset'] = $offset;
		$id = alphaID($id, TRUE);

		$this->data['module'] = 'vehicles';
		$this->data['sub_module'] = 'vehicleslist';
		$this->data['segment'] = 'admin/vehicle/vehicle-images';
		$this->data['page_header'] = '<h2><i class="fa fa-users"></i>Vehicle List <span>vehicle list page</span></h2>';
		//breadcrumb
		$this->data['breadcrumb'] = '';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-home"></i> <a href="'.site_url("admin/dashboard").'">Dashboard</a><i class="fa fa-angle-right"></i></li>';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-users"></i> Vehicle List</li>';
		//breadcrumb
		$this->data['page'] = array(
							'pageTitle' => "Vehicle List"
						);

		if($user_type != 'demo') {
		    //post file
			if(isset($_FILES['userfile'])) {
                $ajax = ajax_check(); //Check AJAX
                if(!$ajax) { redirect(site_url("admin/sign-in")); return; }  //if not ajax request or table or rows

                //folder name
				$FolderName = alphaID($id, FALSE, $this->config->item("site_name").'MAA-AUTOS');
				create_folder("./uploads/vehicles/{$FolderName}"); //make folder

				$this->load->library('upload');
				$cu_time = time().rand(0, 10000000);
				$name = url_title(strtolower($_FILES['userfile']['name'])); //file name
				$config['overwrite'] = TRUE;
				$config['upload_path'] = './uploads/vehicles/'.$FolderName.'/';
				$config['allowed_types'] = 'gif|png|jpg|jpeg';
				$config['file_name']  = "{$cu_time}_{$this->data['vehicle_id']}_{$name}";
				$this->upload->initialize($config);
				if (!$this->upload->do_upload()) {
					//Upload Error
				}
				else {
					$upload_data = $this->upload->data();
					$config['image_library'] = 'gd2';
					$config['source_image'] = "./uploads/vehicles/{$FolderName}/{$upload_data['file_name']}";
					$config['create_thumb'] = FALSE;
					$config['maintain_ratio'] = TRUE;
					$config['max_width'] = $this->config->item("vehicle_image_max_width");
					$config['max_height'] = $this->config->item("vehicle_image_max_height");									
					$this->load->library('image_lib', $config);			
					$this->image_lib->resize();
	
					$images = get_rows(array('vehicleID'=>$id), array('table'=>'vehicle_images', 'limit'=>1, 'ORDER_BY'=>'sequence', 'ORDER_TYPE'=>'desc'));
					$parsed_data['vehicleID'] = $id;
					$parsed_data['sequence'] = (isset($images['sequence'])) ? ($images['sequence'] + 1) : 1;
					$parsed_data['image'] = $upload_data['file_name'];
					$db_status = save_data('vehicle_images', $parsed_data);

					$de_images = get_rows(array('vehicleID'=>$id), array('TABLE'=>'vehicle_images', 'LIMIT'=>1, 'ORDER_BY'=>'sequence', 'ORDER_TYPE'=>'asc'));
					if(isset($de_images['ID'])) {
						$def_data['defaultImage'] = $de_images['image'];
						$def_comparison_fields['NAME'] = 'ID';
						$def_comparison_fields['VALUE'] = $id;
						save_data('vehicles', $def_data, $def_comparison_fields);
					}

					//upload success message
					ajax_response('1'); return; //JSON Response
				}
			} //end post file
		}

		$this->data['vehicle_data'] = get_rows(array('ID'=>$id), array('TABLE'=>'vehicles', 'LIMIT'=>1));
		$filters = array('vehicleID'=>$id);
		$this->data['images'] = get_rows($filters, array('TABLE'=>'vehicle_images', 'LIMIT'=>$limit, 'offset'=>$offset, 'ORDER_BY'=>'sequence', 'ORDER_TYPE'=>'asc'));
		$this->data['pagination'] = row_pagination($filters, array('LIMIT'=>$limit, 'TABLE'=>'vehicle_images', 'SITE_URL'=>'admin/vehicles/images/'.$this->data['vehicle_id'].'/', 'URI_SEGMENT'=>5));
		render_page("admin/template", $this->data);
	}

    /**
     * vehicle images position (Admin)
     * 
     * @access public (ajax)
     * @return JSON Response
     */
	public function images_position()
	{
        $ajax = ajax_check(); //Check AJAX
        if(!$ajax) { redirect(site_url("admin/sign-in")); return; }  //if not ajax request or table or rows

		$user_type = $this->session->userdata("user_type");
        //post data
		$nestable = $this->input->post("nestable", TRUE);
		$offset = $this->input->post("offset", TRUE);

		$id = 0;
		$nestable = json_decode($nestable);
		if($user_type != 'demo') {
			if(is_array($nestable)) {
				foreach ($nestable as $key => $row) {
					$id = alphaID($row->id, TRUE);
					$this->data['sequence'] = ($offset + $key);
					$comparison_fields['NAME'] = 'ID';
					$comparison_fields['VALUE'] = $id;

					save_data('vehicle_images', $this->data, $comparison_fields); //save data
				}
			}

			if($id) {
				$check_image = get_rows(array('ID'=>$id), array('TABLE'=>'vehicle_images', 'LIMIT'=>1));
				if(isset($check_image['ID'])) {
					$de_images = get_rows(array('vehicleID'=>$check_image['vehicleID']), array('TABLE'=>'vehicle_images', 'LIMIT'=>1, 'ORDER_BY'=>'sequence', 'ORDER_TYPE'=>'asc'));
					if(isset($de_images['ID'])) {
						$def_data['defaultImage'] = $de_images['image'];
						$def_comparison_fields['NAME'] = 'ID';
						$def_comparison_fields['VALUE'] = $check_image['vehicleID'];
						save_data('vehicles', $def_data, $def_comparison_fields); //save data
					}
				}
			}
		}

		ajax_response('1'); return; //JSON Response
	}

    /**
     * delete image
     * 
     * @access public (ajax)
     * @return boolean
     */
	public function delete_image($id=0)
	{
        $ajax = ajax_check(); //Check AJAX
        if(!$ajax) { redirect(site_url("admin/sign-in")); return; }  //if not ajax request or table or rows

		$user_type = $this->session->userdata("user_type");
		$id = alphaID($id, TRUE);
		$delete_status = 0;

		if($user_type != 'demo') {
			//delete vehicle images
			$check_images = get_rows(array('vehicleID'=>$id), array('TABLE'=>'vehicle_images', 'LIMIT'=>1000));
			foreach ($check_images as $key => $value) {
				@unlink("./uploads/vehicles/{$value['image']}");
			}
			//delete vehicle images

			$comparison_fields['NAME'] = 'ID';
			$comparison_fields['VALUE'] = $id;
			$delete_status = delete_rows('vehicle_images', $comparison_fields);
	
			$de_images = get_rows(array('vehicleID'=>$id), array('TABLE'=>'vehicle_images', 'LIMIT'=>1, 'ORDER_BY'=>'sequence', 'ORDER_TYPE'=>'asc'));
			if(isset($de_images['ID'])) {
				$def_data['defaultImage'] = $de_images['image'];
				$def_comparison_fields['NAME'] = 'ID';
				$def_comparison_fields['VALUE'] = $id;
				save_data('vehicles', $def_data, $def_comparison_fields); //save post data
			}
		}

        $result = ($delete_status) ? 1 : 0;
        ajax_response($result); return; //JSON Response
	}

    /**
     * vehicle manage (Admin)
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

		$valid_modes = array('add', 'edit', 'delete', 'bulk_delete', 'view'); //valid modes
		if(!in_array($mode, $valid_modes)) $mode = 'add'; //check mode

        $this->data['page_js'] = 'manage-vehicle';
		$this->data['module'] = 'vehicles';
		$this->data['sub_module'] = 'manage-vehicle';
		$this->data['segment'] = 'admin/vehicle/manage-vehicle';
		$this->data['page_header'] = '<h2><i class="fa fa-users"></i>Manage Vehicle <span>manage vehicle page</span></h2>';
		//breadcrumb
		$this->data['breadcrumb'] = '';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-home"></i> <a href="'.site_url("admin/dashboard").'">Dashboard</a><i class="fa fa-angle-right"></i></li>';
		$this->data['breadcrumb'] .= '<li class="active"><i class="fa fa-users"></i> Manage Vehicle</li>';
		//breadcrumb
		$this->data['page'] = array(
							'pageTitle' => "Manage Vehicle"
						);
		$this->data['mode'] = $mode;
		$this->data['vehicle_id'] = $id;
		$id = alphaID($id, TRUE);

		//Bulk Delete
		if($mode == 'bulk_delete') {
            $ajax = ajax_check(); //Check AJAX
            if(!$ajax) { redirect(site_url("admin/sign-in")); return; }  //if not ajax request or table or rows

            //bulk delete
            $this->_bulk_delete($user_type); return;
		}
		//Bulk Delete End

		$this->form_validation->set_rules('showroom', 'Showroom', 'required|trim|xss_clean');
		$this->form_validation->set_rules('name', 'Vehicle Title', 'required|trim|xss_clean');
		if($mode == 'edit') $this->form_validation->set_rules('vehicleCode', 'Vehicle Code', 'required|trim|xss_clean');
		else $this->form_validation->set_rules('vehicleCode', 'Vehicle Code', 'required|trim|xss_clean|callback_check_vehicleCode');
		$this->form_validation->set_rules('maker', 'Vehicle Maker', 'required|trim|xss_clean');
		$this->form_validation->set_rules('model', 'Vehicle Model', 'required|trim|xss_clean');
		$this->form_validation->set_rules('type', 'Vehicle Type', 'required|trim|xss_clean');
		$this->form_validation->set_rules('condition', 'Vehicle Condition', 'required|trim|xss_clean');
		$this->form_validation->set_rules('drive', 'Vehicle Drive', 'required|trim|xss_clean');
		$this->form_validation->set_rules('fuel', 'Vehicle Fuel', 'required|trim|xss_clean');
		$this->form_validation->set_rules('transmission', 'Vehicle Transmission', 'required|trim|xss_clean');
		$this->form_validation->set_rules('interior_color', 'Vehicle Interior Color', 'required|trim|xss_clean');
		$this->form_validation->set_rules('exterior_color', 'Vehicle Exterior Color', 'required|trim|xss_clean');
		$this->form_validation->set_rules('seats', 'Vehicle Seats', 'required|trim|xss_clean');
		$this->form_validation->set_rules('doors', 'Vehicle Doors', 'required|trim|xss_clean');
		$this->form_validation->set_rules('km', 'Vehicle KM', 'required|trim|xss_clean');
		$this->form_validation->set_rules('cc', 'Vehicle CC', 'required|trim|xss_clean');
		$this->form_validation->set_rules('engine', 'Vehicle Engine', 'required|trim|xss_clean');
		$this->form_validation->set_rules('status', 'Vehicle Status', 'required|trim|xss_clean');
		$this->form_validation->set_rules('price', 'Vehicle Price', 'required|trim|xss_clean');
		if($mode == 'edit') $this->form_validation->set_rules('url', 'Vehicle URL', 'required|trim|xss_clean');
		else $this->form_validation->set_rules('url', 'Vehicle URL', 'required|trim|xss_clean|callback_check_url');
		$this->form_validation->set_rules('meta_title', 'Vehicle Meta Title', 'required|trim|xss_clean');
		$this->form_validation->set_rules('meta_keyword', 'Vehicle Meta Keyword', 'required|trim|xss_clean');
		$this->form_validation->set_rules('meta_description', 'Vehicle Meta Description', 'required|trim|xss_clean');
		if ($this->form_validation->run() == TRUE) {
			if($user_type != 'demo') {
			    //post data
			    $parsed_data = $this->_parsed_data();

				$comparison_fields = NULL;
				if($mode == 'edit') {
					$comparison_fields['NAME'] = 'ID';
					$comparison_fields['VALUE'] = $id;		
				}
				$db_status = save_data('vehicles', $parsed_data, $comparison_fields); //save post data

				//post file
				if($_FILES) {
					//upload user image
					$FolderName = alphaID($id, FALSE, $this->config->item("site_name").'MAA-AUTOS'); //folder name
					create_folder("./uploads/vehicles/{$FolderName}"); //create folder
					$this->load->library('upload');
					$config['overwrite'] = TRUE;
					$config['upload_path'] = "./uploads/vehicles/{$FolderName}/";
					$config['allowed_types'] = 'gif|png|jpg|jpeg';
					$this->upload->initialize($config);
		
					if ($this->upload->do_upload()) {
						$upload_data = $this->upload->data();
						if ( ! $this->upload->do_upload('userfile')) $this->data['error'] = '<div class="alert alert-danger"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button><strong>Error! </strong> '. $this->upload->display_errors() .'</div>';
						else {
							$config['image_library'] = 'gd2';
							$config['source_image'] = "./uploads/vehicles/{$FolderName}/{$upload_data['file_name']}";
							$config['create_thumb'] = FALSE;
							$config['maintain_ratio'] = TRUE;
							$config['max_width'] = $this->config->item("vehicle_image_max_width");
							$config['max_height'] = $this->config->item("vehicle_image_max_height");	
		
							$this->load->library('image_lib', $config);
							$this->image_lib->resize();
	
							$image_comparison_fields['NAME'] = 'ID';
							$image_comparison_fields['VALUE'] = $id;	
							$image_parsed_data['defaultImage'] = $upload_data['file_name'];
							$db_status = save_data('vehicles', $image_parsed_data, $image_comparison_fields);
						}
					}
				} //end post file

                $vehicleID = ($mode == 'edit') ? $id : $db_status;

				if(isset($image_parsed_data['defaultImage'])) {
				    $this->_default_image($vehicleID, $mode); //set default image
				}

                $db_status = $this->_save_vehicle_features($vehicleID, $mode); // save vehicle features

				if($db_status) $this->data['error'] = admin_errors(1); //success			
				else $this->data['error'] = admin_errors(2); //saved failed
			}
			else $this->data['error'] = admin_errors(5); //demo user error
		}
		else if(validation_errors()) $this->data['error'] = admin_errors(); //validation errors

		//delete
		if($mode == 'delete') {
            $ajax = ajax_check(); //Check AJAX
            if(!$ajax) { redirect(site_url("admin/sign-in")); return; }  //if not ajax request or table or rows
            $this->_delete($id, $user_type); return;
		} //end delete

		//edit
		if($mode == 'edit') {
			$return_data = get_rows(array('ID'=>$id), array('TABLE'=>'vehicles', 'LIMIT'=>1));
			if(isset($return_data['ID'])) $this->data['vehicle_data'] = $return_data;
			else { $this->data['mode'] = 'add'; }
		} //end edit

		//view
		if($mode == 'view') {
			$this->data['segment'] = 'admin/vehicle/view-vehicle';
			$view_sql_properties['SELECT'] = 'vehicles.*, showrooms.dealership_name, makers.name as maker_name, models.model as model_name, vehicle_types.type_name, conditions.name as condition_name';
			$view_sql_properties['TABLE'] = 'vehicles';
			$view_sql_properties['LIMIT'] = 1;
			$view_sql_properties['GLUE'][] = 'showrooms';
			$view_sql_properties['PIECES'][] = 'showrooms.ID = vehicles.showroomID';
			$view_sql_properties['GLUE'][] = 'makers';
			$view_sql_properties['PIECES'][] = 'makers.ID = vehicles.makerID';
			$view_sql_properties['GLUE'][] = 'models';
			$view_sql_properties['PIECES'][] = 'models.ID = vehicles.modelID';
			$view_sql_properties['GLUE'][] = 'vehicle_types';
			$view_sql_properties['PIECES'][] = 'vehicle_types.ID = vehicles.typeID';
			$view_sql_properties['GLUE'][] = 'conditions';
			$view_sql_properties['PIECES'][] = 'conditions.ID = vehicles.conditionID';
			$return_data = get_rows(array('vehicles.ID'=>$id), $view_sql_properties);
			if(isset($return_data['ID'])) {
				$this->data['vehicle'] = $return_data;

				$feature_sql_properties['SELECT'] = 'feature_title.*';
				$feature_sql_properties['TABLE'] = 'vehicle_features';
				$feature_sql_properties['LIMIT'] = 100;
				$feature_sql_properties['GROUP_BY'] = 'features.titleID';
				$feature_sql_properties['GLUE'][] = 'features';
				$feature_sql_properties['PIECES'][] = 'features.ID = vehicle_features.featureID';
				$feature_sql_properties['GLUE'][] = 'feature_title';
				$feature_sql_properties['PIECES'][] = 'feature_title.ID = features.titleID';
				$this->data['features'] = get_rows(array('vehicle_features.vehicleID'=>$return_data['ID']), $feature_sql_properties);
			}
			else { redirect(site_url("admin/sign-in")); return; }
		} //end view

		render_page("admin/template", $this->data);
	}

    /**
     * status update
     * 
     * @access public (ajax)
     * @return boolean
     */
	public function status_update()
	{
        $ajax = ajax_check(); //Check AJAX
        if(!$ajax) { redirect(site_url("admin/sign-in")); return; }  //if not ajax request

        $user_type = $this->session->userdata("user_type");
		if($user_type != 'demo') $db_status = ajax_single_update("vehicles"); //update
        $result = (isset($db_status) && $db_status) ? 1 : 0; //set result

		ajax_response($result); return; //JSON Response
	}

    /**
     * check url
     * 
     * @access public
     * @return boolean
     */
	public function check_url($url)
	{
		$check = get_rows(array('url'=>$url), array('TABLE'=>'vehicles', 'LIMIT'=>1));
		if(isset($check['ID'])) {
			$this->form_validation->set_message('check_url', 'URL already is being used. Please try with another URL.');
			return FALSE;
		}
		else return TRUE;
	}

    /**
     * check vehicle code
     * 
     * @access public
     * @return boolean
     */
	public function check_vehicleCode($vehicleCode)
	{
		$check = get_rows(array('vehicleCode'=>$vehicleCode), array('TABLE'=>'vehicles', 'LIMIT'=>1));
		if(isset($check['ID'])) {
			$this->form_validation->set_message('check_vehicleCode', 'Vehicle Code already is being used. Please try with another Vehicle Code.');
			return FALSE;
		}
		else return TRUE;
	}

    /**
     * models
     * 
     * @access public (ajax)
     * @return html
     */
	public function json_models()
	{
        $ajax = ajax_check(); //Check AJAX
        if(!$ajax) { redirect(site_url("admin/sign-in")); return; }  //if not ajax request

		$json['models'] = '';
		$maker = $this->input->post("maker");
		if($maker) {
			$models = get_rows(array("maker"=>$maker, 'status'=>'1'), array('TABLE'=>'models', 'LIMIT'=>1000));
			if(count($models) > 0) {
				foreach ($models as $key => $row) {
					$json['models'] .= "<option value=\"{$row['ID']}\">{$row['model']}</option>";
				}
			}
			else $json['models'] = '<option value="">Not Found Model</option>';
		}

		ajax_response($json); return; //JSON Response
	}

    /**
     * Make URL (Admin)
     * 
     * @access public (ajax)
     * @return url (mixed)
     */ 
	public function url()
	{
        $ajax = ajax_check(); //Check AJAX
        if(!$ajax) { redirect(site_url("admin/sign-in")); return; }  //if not ajax request

		$name = $this->input->post("n", TRUE);
		$year = $this->input->post("y", TRUE);
		$maker = $this->input->post("m", TRUE);
		$maker = get_rows(array("ID"=>$maker, 'status'=>'1'), array('TABLE'=>'makers', 'LIMIT'=>1));
		$maker = (isset($maker['name'])) ? $maker['name'] : '';
		$model = $this->input->post("mo", TRUE);
		$model = get_rows(array("ID"=>$model, 'status'=>'1'), array('TABLE'=>'models', 'LIMIT'=>1));
		$model = (isset($model['model'])) ? $model['model'] : '';
		$json['url'] = url_title(strtolower($name.'-'.$year.'-'.$maker.'-'.$model));
        ajax_response($json); return; //JSON Response
	}

    /**
     *  parsed data(Admin)
     * 
     * @access private
     * @return array
     */ 
    private function _parsed_data()
    {
        $parsed_data = array();

        $parsed_data['showroomID'] = $this->input->post('showroom', TRUE);
        $parsed_data['name'] = $this->input->post('name', TRUE);
        $parsed_data['vehicleCode'] = $this->input->post('vehicleCode', TRUE);
        $parsed_data['makerID'] = $this->input->post('maker', TRUE);
        $parsed_data['modelID'] = $this->input->post('model', TRUE);
        $parsed_data['typeID'] = $this->input->post('type', TRUE);
        $parsed_data['conditionID'] = $this->input->post('condition', TRUE);
        $parsed_data['drive'] = $this->input->post('drive', TRUE);
        $parsed_data['fuelID'] = $this->input->post('fuel', TRUE);
        $parsed_data['transmissionID'] = $this->input->post('transmission', TRUE);
        $parsed_data['interior_color'] = $this->input->post('interior_color', TRUE);
        $parsed_data['exterior_color'] = $this->input->post('exterior_color', TRUE);
        $parsed_data['seats'] = $this->input->post('seats', TRUE);
        $parsed_data['doors'] = $this->input->post('doors', TRUE);
        $parsed_data['km'] = $this->input->post('km', TRUE);
        $parsed_data['cc'] = $this->input->post('cc', TRUE);
        $parsed_data['engine'] = $this->input->post('engine', TRUE);
        $parsed_data['status'] = $this->input->post('status', TRUE);
        $parsed_data['price'] = $this->input->post('price', TRUE);
        $parsed_data['discountPrice'] = $this->input->post('dis_price', TRUE);
        $parsed_data['popularity'] = $this->input->post('popularity', TRUE);
        $parsed_data['hotcar'] = $this->input->post('hotcar', TRUE);
        $parsed_data['url'] = url_title(strtolower($this->input->post('url', TRUE)));
        $parsed_data['meta_title'] = $this->input->post('meta_title', TRUE);
        $parsed_data['meta_keyword'] = $this->input->post('meta_keyword', TRUE);
        $parsed_data['meta_description'] = $this->input->post('meta_description', TRUE);
        $parsed_data['description'] = close_tags($this->input->post('description', TRUE));
        $parsed_data['internal_notes'] = close_tags($this->input->post('internal_notes', TRUE));

        return $parsed_data;
    }

    /**
     * save vehicle features (Admin)
     * 
     * @access private
     * @return string
     */ 
    private function _save_vehicle_features($vehicle_id=0, $mode='')
    {
        if(!$vehicle_id) return FALSE;

        //insert vehicle features
        //if mode edit delete old vehicle features
        if($mode == 'edit') {
            $features_comparison_fields['NAME'] = 'vehicleID';
            $features_comparison_fields['VALUE'] = $vehicle_id;
            $delete_status = delete_rows('vehicle_features', $features_comparison_fields);
        }

        $all_feature_list = array();
        $features = get_rows(array(), array('TABLE'=>'features', 'LIMIT'=>1000));
        foreach ($features as $key => $value) {
            $curID = $this->input->post(alphaID($value['ID']), TRUE);
            if($curID) {
                $features_parsed_data['vehicleID'] = $vehicle_id;
                $features_parsed_data['featureID'] = $value['ID'];
                //save
                $db_status = save_data('vehicle_features', $features_parsed_data);

                //all features in array
                $all_feature_list[] = $value['feature'];
            }
        }

        $option_comparison_fields['NAME'] = 'ID';
        $option_comparison_fields['VALUE'] = $vehicle_id;    
        $option_feature_data['options'] = @implode(', ', $all_feature_list);
        //save
        $db_status = save_data('vehicles', $option_feature_data, $option_comparison_fields);
        //insert vehicle features

        return $db_status;
    }

    /**
     * delete (Admin)
     * 
     * @access private (ajax)
     * @return mixed
     */ 
    private function _delete($id=0, $user_type='')
    {
        $result = 1;
        if($user_type != 'demo') {
            //delete vehicle images
            $check_images = get_rows(array('vehicleID'=>$id), array('TABLE'=>'vehicle_images', 'LIMIT'=>1000));
            foreach ($check_images as $key => $value) {
                @unlink("./uploads/vehicles/{$value['image']}");
            }
    
            $image_comparison_fields['NAME'] = 'ID';
            $image_comparison_fields['VALUE'] = $cur_row_id;
            delete_rows('vehicle_images', $image_comparison_fields);
            //delete vehicle images
    
            //delete vehicle
            $comparison_fields['NAME'] = 'ID';
            $comparison_fields['VALUE'] = $id;
            $status = delete_rows('vehicles', $comparison_fields);
            $result = ($status) ? 1: 0; //set result
        }
    
        ajax_response($result); return; //JSON Response
    }

    /**
     * Make URLbulk delete (Admin)
     * 
     * @access private (ajax)
     * @return mixed
     */ 
    private function _bulk_delete($user_type='')
    {
        $status = 1;
        if($user_type != 'demo') {
            $row_sel = $this->input->post("row_sel", TRUE);
            foreach ($row_sel as $key => $value) {
                $cur_row_id = alphaID($value, TRUE);
                //delete vehicle images
                $check_images = get_rows(array('vehicleID'=>$cur_row_id), array('TABLE'=>'vehicle_images', 'LIMIT'=>1000));
                foreach ($check_images as $key => $value) {
                    @unlink("./uploads/vehicles/{$value['image']}");
                }

                $image_comparison_fields['NAME'] = 'ID';
                $image_comparison_fields['VALUE'] = $cur_row_id;
                delete_rows('vehicle_images', $image_comparison_fields);
                //delete vehicle images

                $row_ids[] = alphaID($value, TRUE);
            }

            $status = delete_rows('vehicles', NULL, $row_ids);
            $result = ($status) ? 1: 0; //set result
        }

        ajax_response($result); return; //JSON Response
    }

    /**
     * default image (Admin)
     * 
     * @access private
     * @return boolean
     */ 
    private function _default_image($vehicle_id=0, $mode='')
    {
        if(!$vehicle_id) return FALSE;

        //insert Default Image
        $parsed_default_image['image'] = $image_parsed_data['defaultImage'];
        $parsed_default_image['sequence'] = '1';
        $parsed_default_image['vehicleID'] = $vehicle_id;

        //update sequence
        if($mode == 'edit') {
            $images = get_rows(array(), array('TABLE'=>'vehicle_images', 'LIMIT'=>100));
            foreach ($images as $key => $value) {
                set_data(array(), array('TABLE'=>'vehicle_images', 'SET_FIELD'=>'sequence'));
            }
        }
        //update sequence

        if($mode == 'edit') $check_image = get_rows(array('vehicleID'=>$vehicle_id, 'image'=>$parsed_default_image['image']), array('TABLE'=>'vehicle_images', 'LIMIT'=>1));
        if(!isset($check_image['image'])) save_data('vehicle_images', $parsed_default_image);
        //Insert Default Image
 
        return TRUE;
    }
}
/* End of file admin/vehicles.php */
/* Location: ./application/controllers/admin/vehicles.php */