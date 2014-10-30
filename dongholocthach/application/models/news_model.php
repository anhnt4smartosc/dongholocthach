<?php
class news_model extends CI_Model
{
    protected $_table = 'tbl_user';
    protected $_primary = 'id';
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function getAll()
    {
        // Lay ra danh sach cac ban ghi trong table
        return $this->db->get($this->_table)->result_array();
    }
    public function insert($data)
    {
        $this->db->insert($this->_table,$data);
    }
    public function detail($id)
    {
        $this->db->where("id = $id");
        return $this->db->get($this->_table)->row_array();
    }
    public function update($data,$id)
    {
        $this->db->where("id = $id");
        $this->db->update($this->_table,$data);
    }
    public function deleteUser($id)
    {
        $this->db->where("id = $id");
        $this->db->delete($this->_table);
    }    
}