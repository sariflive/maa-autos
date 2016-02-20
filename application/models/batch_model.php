<?php
class Batch_model extends CI_Model {

	public function __construct()
	{
	   // Call the Model constructor
       parent::__construct();
   	}
    
    //start rander page function
    public function render_page($view, $data = null, $render = false)
    {
        $this->viewdata = (empty($data)) ? $this->data : $data;
        $view_html = $this->load->view($view, $this->viewdata, $render);
        if (!$render) return $view_html;
    } //end render_page()

    //start get rows function
	public function get_rows($filters = array(), $sql_properties = array())
	{
	    //if not limit than set default limit
		$limit = (isset($sql_properties['LIMIT'])) ? $sql_properties['LIMIT'] : 10;
        //if not offset than set default offset
		$offset = (isset($sql_properties['OFFSET'])) ? $sql_properties['OFFSET'] : 0;
        //if not table than set default empty
		$table = (isset($sql_properties['TABLE'])) ? $sql_properties['TABLE'] : '';

        //set return variable as $return with default array()
		$return = array();

        //if table empty return FALSE
		if(!$table) return FALSE;

        //if isset sql properties order by and order type for group data from table
		if(isset($sql_properties['ORDER_BY']) && isset($sql_properties['ORDER_TYPE'])) {
			if(is_array($sql_properties['ORDER_BY']) && is_array($sql_properties['ORDER_TYPE'])) {
				foreach($sql_properties['ORDER_BY'] as $key => $value) {
					$this->db->order_by($sql_properties['ORDER_BY'][$key], $sql_properties['ORDER_TYPE'][$key]);
				}
			}
			else $this->db->order_by($sql_properties['ORDER_BY'], $sql_properties['ORDER_TYPE']);
		}

        //if isset sql properties group by for group data from table
		if(isset($sql_properties['GROUP_BY'])) {
			if(is_array($sql_properties['GROUP_BY'])) {
				foreach($sql_properties['GROUP_BY'] as $key => $value) {
					$this->db->group_by($sql_properties['GROUP_BY'][$key]);
				}
			}
			else $this->db->group_by($sql_properties['GROUP_BY']);
		}

        //if isset sql properties select for select data from table
		if(isset($sql_properties['SELECT']) && !empty($sql_properties['SELECT'])) $this->db->select($sql_properties['SELECT']);

        //if isset sql properties glue and pieces for join table
		if(isset($sql_properties['GLUE']) && isset($sql_properties['PIECES'])) {
			if(is_array($sql_properties['GLUE']) && is_array($sql_properties['PIECES'])) {
				foreach($sql_properties['GLUE'] as $key => $value) {
					$this->db->join($sql_properties['GLUE'][$key], $sql_properties['PIECES'][$key], 'left');
				}
			}
			else $this->db->join($sql_properties['GLUE'], $sql_properties['PIECES'], 'left');
		}

        //filter data from table
		$this->db->where($filters);

        //if isset sql properties like for matching data from table
		if(isset($sql_properties['LIKE']) && is_array($sql_properties['LIKE'])) {
			$db_like = 'like';
			foreach ($sql_properties['LIKE'] as $key => $like) {
				if(isset($sql_properties['LIKE_OPTION']["{$key}"])) $like_option = $sql_properties['LIKE_OPTION']["{$key}"];
				else $like_option = 'both';

				$this->db->$db_like($like, $sql_properties['LIKE_VALUE']["{$key}"], $like_option);
				$db_like = 'or_like';
			}
		}

        //if isset sql properties not like for not matching data from table
		if(isset($sql_properties['NOT_LIKE']) && is_array($sql_properties['NOT_LIKE'])) {
			foreach ($sql_properties['NOT_LIKE'] as $key => $like){
				if(isset($sql_properties['NOT_LIKE_OPTION']["{$key}"])) $like_option = $sql_properties['NOT_LIKE_OPTION']["{$key}"];
				else $like_option = 'both';

				$this->db->not_like($like, $sql_properties['NOT_LIKE_VALUE']["{$key}"], $like_option); 
			}
		}

        //if isset sql properties or_where for filters data
		if(isset($sql_properties['OR']))$this->db->or_where($sql_properties['OR']);

        //if isset sql properties whwre_in for filters data
        if(isset($sql_properties['WHERE_IN'])) $this->db->where_in($sql_properties['WHERE_IN'], $sql_properties['WHERE_IN_VALUE']);

        //if isset sql properties or_whwre_in for filters data
		if(isset($sql_properties['OR_WHERE_IN']) && isset($sql_properties['OR_WHERE_IN_VALUE'])) $this->db->or_where_in($sql_properties['OR_WHERE_IN'], $sql_properties['OR_WHERE_IN_VALUE']);

        //if isset sql properties where_not_in for filters data
		if(isset($sql_properties['WHERE_NOT_IN']) && isset($sql_properties['WHERE_NOT_IN_GLUE'])) $this->db->where_not_in($sql_properties['WHERE_NOT_IN_GLUE'], $sql_properties['WHERE_NOT_IN']);

		$this->db->limit($limit, $offset);
		$this->db->from($table);
        //get query
		$query = $this->db->get();

		 //check if count greater than zero
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
			    //check if limit greater than one than return data array()
				if($limit > 1) $return[] = $row;
                //check if limit one than return data
				else $return = $row;
			}
		}

        //return data
		return $return;
	}//end get rows function

    //save data function
	public function save_data($table = NULL, $data = NULL, $comparison_fields = NULL)
	{
	    //if table empty and data not array than return FALSE
		if(!$table || !is_array($data)) return FALSE;

        //if comparison field is array than update data
		if(is_array($comparison_fields)) {
			return $this->update_data($table, $data, $comparison_fields);
		}
		else {
		    //insert query data
			$insert_query = $this->db->insert_string($table, $data);
			$insert_query = str_replace('INSERT INTO','INSERT IGNORE INTO', $insert_query);
			$this->db->query($insert_query);
            //return insert id
			return $this->db->insert_id();
		}
	}//end save data function

	//private update data function
	private function update_data($table = NULL, $data = NULL, $comparison_fields = NULL)
	{
	    //if table empty, data not array and comparison fields empty than return FALSE
		if(!$table || !is_array($data) || !$comparison_fields) return FALSE;

        //compare table rows
		if(is_array($comparison_fields['NAME'])) {
			foreach ($comparison_fields['NAME'] as $key => $val) {
				$this->db->where($comparison_fields['NAME'][$key], $comparison_fields['VALUE'][$key]);
			}
		}
		else if(is_array($comparison_fields)) {
			$this->db->where($comparison_fields['NAME'], $comparison_fields['VALUE']);
		}
        //end compare table rows

        //update table rows
		try {
			$this->db->update($table, $data);
			return $this->db->affected_rows();
		}
		catch(Exception $e)	{
			return FALSE;
		}
	}//end private update data function

	//delete rows function
	function delete_rows($table = NULL, $comparison_fields = NULL, $row_ids = NULL)
	{
	    //compare table rows with $comparison_fields
		if(isset($comparison_fields['NAME']) && is_array($comparison_fields['NAME'])) {
			foreach ($comparison_fields['NAME'] as $key => $val) {
				$this->db->where($comparison_fields['NAME'][$key], $comparison_fields['VALUE'][$key]);
			}
		}
		else if(isset($comparison_fields) && is_array($comparison_fields)){
			$this->db->where($comparison_fields['NAME'], $comparison_fields['VALUE']);
		}

        //compare table rows $comparison_fields
		if($row_ids) {
			if(is_array($row_ids)) $this->db->where_in('ID', $row_ids);
			else $this->db->where('ID', $row_ids);
		}

        //delete table rows
		if($row_ids || $comparison_fields) { 
			$this->db->delete($table);
            //if delete succuess return rows
			return $this->db->affected_rows();
		}	

        //if delete failed return FALSE
		return FALSE;
	}//end delete rows function

    //ajax single update table row
	public function ajax_single_update($table = NULL, $filters = array())
	{
	    //if table empty return FALSE
		if(!$table) return FALSE;

        //set default status value
		$status = 0;

        //get all post data an clean
        //convert alpaID to ID
		$id = (int)alphaID($this->input->post('pk', TRUE), TRUE);
		$name = clean_data($this->input->post('name', TRUE), TRUE);
		$value = clean_data($this->input->post('value', TRUE), TRUE);

		if(!empty($id) && $value !='') {
		    //filters data
			if(count($filters) > 0) $this->db->where($filters);
			else $this->db->where(array('ID'=>$id));
            //update rows
			$this->db->update($table, array($name=>$value));
            //return affected rows status
			$status = $this->db->affected_rows();
		}

		return $status;
	}//end ajax single update table row

    //pagination function
	public function row_pagination($filters = array(), $sql_properties = NULL)
	{
	    //if not limit than set default limit
		$limit = (isset($sql_properties['LIMIT'])) ? $sql_properties['LIMIT'] : 10;
        //if not table than set default empty
        $table = (isset($sql_properties['TABLE'])) ? $sql_properties['TABLE'] : '';
        //if table empty return FALSE
        if(!$table) return FALSE;
        //if not site url than set default site url
		$site_url = (isset($sql_properties['SITE_URL'])) ? site_url("{$sql_properties['SITE_URL']}") : site_url();
        //if not uri segment than set default uri segment
		$uri_segment = (isset($sql_properties['URI_SEGMENT'])) ? $sql_properties['URI_SEGMENT'] : 3;
        //if not total results than set default total results
		$total_results = (isset($sql_properties['TOTAL_RESULTS'])) ? $sql_properties['TOTAL_RESULTS'] : FALSE;
        //if not ul class than set default ul class
		$ul_class = (isset($sql_properties['UL_CLASS'])) ? $sql_properties['UL_CLASS'] : 'pagination';	

        //set default pagination veriable
		$pagination = array();

		//Pagination of result set
		$config['base_url'] = $site_url;
		$config['total_rows'] = ($total_results !== FALSE) ? $total_results : $this->row_counter($filters, $sql_properties);
		$config['per_page'] = $limit;
		$config['uri_segment'] = $uri_segment;
		$config['suffix'] =  '?' . $_SERVER["QUERY_STRING"];
		$config['full_tag_open'] = '<ul class="'.$ul_class.'">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = 'First';
		$config['first_url'] = $config['base_url'].$config['suffix'];
		$config['first_tag_open'] = '<li class="first">';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li class="last">';
		$config['last_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="prev">';
		$config['prev_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li class="next">';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#" >';
		$config['cur_tag_close'] = '</a></li>';

		$this->pagination->initialize($config);
        //create pagination links
		$pagination = $this->pagination->create_links();		

        //return pagination
		return $pagination;	
	}//end pagination function

	//table row counter function
	public function row_counter($filters = array(), $sql_properties = NULL)
	{
	    //if table not set than return FALSE
		if(isset($sql_properties['TABLE'])) $table = $sql_properties['TABLE']; else return FALSE;

        //filters data
		if(count($filters) > 0) $this->db->where($filters);

        //if isset sql properties like for matching data from table
		if(isset($sql_properties['LIKE']) && is_array($sql_properties['LIKE'])) {
			$db_like = 'like';
			foreach ($sql_properties['LIKE'] as $key => $like) {
				if(isset($sql_properties['LIKE_OPTION']["{$key}"])) $like_option = $sql_properties['LIKE_OPTION']["{$key}"];
				else $like_option = 'both';

				$this->db->$db_like($like, $sql_properties['LIKE_VALUE']["{$key}"], $like_option);
				$db_like = 'or_like';
			}
		}

        //if isset sql properties glue and pieces for join table
		if(isset($sql_properties['GLUE']) && isset($sql_properties['PIECES'])) {
			if(is_array($sql_properties['GLUE']) && is_array($sql_properties['PIECES'])) {
				foreach($sql_properties['GLUE'] as $key => $value) {
					$this->db->join($sql_properties['GLUE'][$key], $sql_properties['PIECES'][$key], 'left');
				}
			}
			else $this->db->join($sql_properties['GLUE'], $sql_properties['PIECES'], 'left');
		}

		$this->db->from($table);
        //count all results from database
		$total = $this->db->count_all_results();

        //return total results
		return $total;
	}//end table row counter function

	//row set data function
	public function set_data($filters = array(), $sql_properties = array())
	{
        //if table not set than return FALSE
		if(isset($sql_properties['TABLE'])) $table = $sql_properties['TABLE']; else return FALSE;
        //if set field empty or not isset than default is NULL
		$set_field = (isset($sql_properties['SET_FIELD'])) ? $sql_properties['SET_FIELD'] : NULL;
        //if incriment veriable empty or not isset than default is incriment value one
		$incriment = (isset($sql_properties['INCRIMENT'])) ? $sql_properties['INCRIMENT'] : '+1';

        //filters data with database rows
		$this->db->where($filters);
        //set value
		$this->db->set($set_field, $set_field.$incriment, FALSE);
        //update table
		$this->db->update($table);
        //return status
		return $this->db->affected_rows();
	}//end row set data function
}
?>