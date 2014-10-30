<?php
/**
 * Created by PhpStorm.
 * User: anhnt01682
 * Date: 7/17/14
 * Time: 10:29 AM
 */

class brand_model extends CI_Model{
    protected $_table = "brand";
    protected $_primary = "brand_id";

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function listBrand($name_value="",$sort=""){
        $data = array();
        $this->db->like("brand_name",$name_value);
        if($sort) $this->db->order_by($sort);
        return $this->db->get($this->_table)->result_array();
    }

    public function listBrandLimit($limit,$start,$sort,$name_value=""){
        $data = array();
        if($name_value) $this->db->like("brand_name",$name_value);
        $this->db->order_by($sort);
        return $this->db->get($this->_table,$limit,$start)->result_array();
    }

    public function get_brand($id)
    {
        $this->db->where($this->_primary ,  $id);
        $result = $this->db->get($this->_table);
        return $result->row_array();
    }
    public function updateBrand($id, $data)
    {
        $this->db->where('brand_id' ,$id);
        $result = $this->db->update($this->_table, $data);
        return $result;
    }
    public function delete_brand($id)
    {
        $this->db->where("brand_id = $id");
        return $this->db->delete($this->_table);

    }
    public function get()
    {
        $query = $this->db->get($this->_table);
        $result = $query->result_array();
        return $result;
    }

    public function insertBrand($data = array()){
        $this->db->insert($this->_table,$data);
    }

}