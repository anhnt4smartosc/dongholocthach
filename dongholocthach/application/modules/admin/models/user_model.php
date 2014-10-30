<?php
class user_model extends CI_Model{
    protected $_table = "user";
    protected $_primary = "user_id";

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function listUser()
    {
        return $this->db->get($this->_table)->result_array();
    }

    public function insertUser($data){
        $this->db->insert($this->_table,$data);
    }

    public function login($username, $password){
        $this->load->database();
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('user_name', $username);
        $this->db->where('user_password', $password);

        $query = $this->db->get();
        if($query->num_rows() >= 1){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function deleteUser($id)
    {
        if (isset($id) && $id != null)
        {
            $this->db->where("user_id","$id");
            $this->db->delete($this->_table);
        }
    }

    public function getUserLimit($limit,$start)
    {
        $this->db->limit($limit,$start);
        return $this->db->get($this->_table)->result_array();
    }
    public  function sortUser($column,$type,$limit="",$start="")
    {
        if($column!="") $this->db->order_by($column,$type);
        if($limit) $this->db->limit($limit,$start);
        return $this->db->get($this->_table)->result_array();
    }

    public function get_user($id)
    {
        $this->db->where("user_id = $id");
        return $this->db->get($this->_table)->row_array();

    }

    public function update_user($id = "",$data)
    {
        $this->db->where("user_id = $id");
        $this->db->update($this->_table,$data);
    }
}