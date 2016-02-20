<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* CodeIgniter Config Extended Library
*
* This class extends the config to a database. Based on class written by Tim Wood (aka codearachnid).
*
* @package       CodeIgniter
* @subpackage    Extended Libraries
* @author        Arnas Lukosevicius (aka steelaz)
* @link          http://www.arnas.net/blog/
*
*/

class MY_Config extends CI_Config
{
    /**
     * CodeIgniter instance
     *
     * @var object
     */
    private $CI = NULL;

    /**
     * Database table name
     *
     * @var string
     */
    private $table = 'ma_config';


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Load config items from database
     *
     * @return void
     */
    public function load_db_items()
    {
        if (is_null($this->CI)) $this->CI = get_instance();

        if (!$this->CI->db->table_exists($this->table))
        {
           $this->create_table();
        }

        $query = $this->CI->db->get($this->table);

        foreach ($query->result() as $row)
        {
            $this->set_item($row->option, $row->value);
        }

    }

    /**
     * Save config item to database
     *
     * @return bool
     * @param string $name
     * @param string $value
     */
    public function save_db_item($name, $value)
    {
        if (is_null($this->CI)) $this->CI = get_instance();

        $where = array('option' => $name);
        $found = $this->CI->db->get_where($this->table, $where, 1);

        if ($found->num_rows > 0)
        {
            return $this->CI->db->update($this->table, array('value' => $value), $where);
        }
        else
        {
            return $this->CI->db->insert($this->table, array('option' => $name, 'value' => $value));
        }
    }

    /**
     * Remove config item from database
     *
     * @return bool
     * @param string $name
     */
    public function remove_db_item($name)
    {
        if (is_null($this->CI)) $this->CI = get_instance();

        return $this->CI->db->delete($this->table, array('option' => $name));
    }

    /**
     * Create database table (using "IF NOT EXISTS")
     *
     * @return void
     */
    public function create_table()
    {
        if (is_null($this->CI)) $this->CI = get_instance();

        $this->CI->load->dbforge();

        $this->CI->dbforge->add_field("`id` int(11) NOT NULL auto_increment");
        $this->CI->dbforge->add_field("`updated` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP");
        $this->CI->dbforge->add_field("`option` varchar(255) NOT NULL");
        $this->CI->dbforge->add_field("`value` text NOT NULL");
		//$this->CI->dbforge->add_field("`read_access` int(5) NOT NULL");
		//$this->CI->dbforge->add_field("`write_access` int(5) NOT NULL");
		$this->CI->dbforge->add_field("`comment` text NOT NULL");

        $this->CI->dbforge->add_key('id', TRUE);

        $this->CI->dbforge->create_table($this->table, TRUE);
    }
}

/* End of file MY_Config.php */
/* Location: ./application/libraries/MY_Config.php */  