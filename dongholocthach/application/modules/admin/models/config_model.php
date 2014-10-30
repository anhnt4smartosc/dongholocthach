<?php
class Config_model extends CI_Model
{
    protected $_primary;
    protected $_table;
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->_primary = 'config_id';
        $this->_table = 'config';
    }
    
    public function configs($num, $start=0)
    {
        $this->db->limit($num, $start);
        $query = $this->db->get($this->_table);
        return $query->result_array();
    }
    
    public function get_config($config_id)
    {
        $this->db->where($this->_primary,$config_id);
        $query = $this->db->get($this->_table);
        return $query->first_result();
    }
    public function create_one($data)
    {
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();
    }
    public function delete($id, $where = '')
    {
        if(!is_array){
            $where = array();
        }
        $where[$this->_primary] = $id;
        $this->db->delete($this->_table, $where);
    }
    public function update($id, $data, $where = '')
    {
        if (is_array($data) && !empty($data) && is_array ($data[0]))
        {
            $this->db->update_batch($this->_table, $data, $id);
            return;
        }
        if (!is_array($where)) {
            $where = array();
        }
        $where[$this->_primary] = $id;
        $this->where($where);
        $this->db->update($this->_table, $data);        
    }
    public function total_configs()
    {
        $this->db->select($this->_primary);
        $query = $this->db->get($this->_table);
        return $query->num_rows();
    }
    public function get_value($id)
    {
        $this->db->select($this->_primary);
        $this->db->where($this->_primary, $id);
        $query = $this->db->get($this->_table);
        $result = $query->first_result();        
    }
}
?>